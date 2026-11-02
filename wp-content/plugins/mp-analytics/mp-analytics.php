<?php
/**
 * Plugin Name: MP Analytics
 * Description: GA4 enrichment on top of Site Kit's tag — content groups, plus print/download, contact-form, sign-up and login events. Fully local, no extra network requests.
 * Version: 1.0.0
 * Author: NetDevs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MPA_EVENT_COOKIE', 'mp_ga_evt' );

/**
 * One label per page for GA4's built-in "Content group" dimension. Posts use
 * Yoast's primary category (falls back to the first category), so reports can
 * compare Quizzes vs Word Searches vs Coloring instead of hundreds of titles.
 */
function mpa_content_group() {
	if ( is_front_page() ) {
		return 'Home';
	}
	if ( is_singular( 'post' ) ) {
		$post_id = get_queried_object_id();
		$term    = null;
		$primary = (int) get_post_meta( $post_id, '_yoast_wpseo_primary_category', true );
		if ( $primary ) {
			$term = get_term( $primary, 'category' );
		}
		if ( ! $term || is_wp_error( $term ) ) {
			$cats = get_the_category( $post_id );
			$term = $cats ? $cats[0] : null;
		}
		return $term ? html_entity_decode( $term->name, ENT_QUOTES ) : 'Posts';
	}
	if ( is_category() ) {
		return html_entity_decode( single_cat_title( '', false ), ENT_QUOTES );
	}
	if ( is_search() ) {
		return 'Search';
	}
	if ( is_404() ) {
		return '404';
	}
	if ( is_page() ) {
		return 'Pages';
	}
	return 'Archives';
}

/**
 * Passed as a gtag('config') parameter via Site Kit's filter, so it rides on
 * the automatic page_view. (A standalone gtag('set', {...}) before config was
 * not picked up by the page_view hit in testing.)
 */
add_filter( 'googlesitekit_gtag_opt', 'mpa_add_content_group' );
function mpa_add_content_group( $opt ) {
	$opt['content_group'] = mpa_content_group();
	return $opt;
}

/**
 * Sign-up and login happen in AJAX/redirect flows (User Registration Pro,
 * Nextend Social Login), so the event can't be sent on the spot. Drop a
 * short-lived cookie and fire the event on the next page view instead.
 */
function mpa_queue_event( $name ) {
	if ( headers_sent() ) {
		return;
	}
	$queued   = isset( $_COOKIE[ MPA_EVENT_COOKIE ] ) ? explode( ',', sanitize_text_field( wp_unslash( $_COOKIE[ MPA_EVENT_COOKIE ] ) ) ) : array();
	$queued[] = $name;
	$value    = implode( ',', array_unique( $queued ) );
	setcookie( MPA_EVENT_COOKIE, $value, time() + 600, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, is_ssl(), false );
	$_COOKIE[ MPA_EVENT_COOKIE ] = $value;
}

add_action( 'user_register', function () {
	mpa_queue_event( 'sign_up' );
} );

add_action( 'wp_login', function () {
	mpa_queue_event( 'login' );
} );

/**
 * Footer listeners. Runs after Site Kit's config, so events have a target.
 * - print_activity: "Click here to Print" buttons (Google Drive/Docs) and
 *   Download Monitor links (/download/...) or direct PDFs.
 * - generate_lead: Contact Form 7 successful send (wpcf7mailsent).
 * - sign_up / login: flushed from the cookie queue above.
 */
add_action( 'wp_footer', 'mpa_print_listeners', 99 );
function mpa_print_listeners() {
	$allowed = array( 'sign_up', 'login' );
	$pending = array();
	if ( isset( $_COOKIE[ MPA_EVENT_COOKIE ] ) ) {
		$pending = array_values( array_intersect( $allowed, explode( ',', sanitize_text_field( wp_unslash( $_COOKIE[ MPA_EVENT_COOKIE ] ) ) ) ) );
	}
	?>
<script id="mp-analytics-events">
(function () {
	if (!window.gtag) return;
	var pending = <?php echo wp_json_encode( $pending ); ?>;
	if (pending.length) {
		pending.forEach(function (name) { gtag('event', name); });
		document.cookie = '<?php echo esc_js( MPA_EVENT_COOKIE ); ?>=;max-age=0;path=<?php echo esc_js( COOKIEPATH ? COOKIEPATH : '/' ); ?>';
	}

	var title = document.title.replace(/\s+-\s+Marias Place$/i, '');
	var host = location.hostname.replace(/^www\./, '');

	// Capture phase: Download Monitor's XHR handler may stop the click.
	document.addEventListener('click', function (e) {
		var a = e.target && e.target.closest ? e.target.closest('a[href]') : null;
		if (!a) return;
		var url;
		try { url = new URL(a.href, location.href); } catch (err) { return; }
		var method = null;
		if (/^(drive|docs)\.google\.com$/.test(url.hostname)) {
			method = 'google_drive';
		} else if (url.hostname.replace(/^www\./, '') === host && /^\/download\/[^/]+/.test(url.pathname)) {
			method = 'download_monitor';
		} else if (/\.pdf$/i.test(url.pathname)) {
			method = 'pdf';
		}
		if (!method) return;
		gtag('event', 'print_activity', {
			method: method,
			activity_title: title,
			link_url: url.href,
			link_text: (a.textContent || '').trim().slice(0, 100)
		});
	}, true);

	document.addEventListener('wpcf7mailsent', function (e) {
		gtag('event', 'generate_lead', {
			form_id: e.detail && e.detail.contactFormId ? String(e.detail.contactFormId) : '',
			page_title: title
		});
	});
})();
</script>
	<?php
}
