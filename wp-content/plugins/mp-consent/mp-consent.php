<?php
/**
 * Plugin Name: MP Consent
 * Description: Minimal, fully local Google Consent Mode + cookie banner. No external CDN, no geo-lookup API, no quota — region comes straight from Cloudflare's CF-IPCountry header.
 * Version: 1.0.0
 * Author: NetDevs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MPC_COOKIE_NAME', 'mp_consent' );
define( 'MPC_COOKIE_MAX_AGE', 180 * DAY_IN_SECONDS );

/**
 * EEA + UK + CH + NO + IS — same bundle Google's own Consent Mode templates use.
 */
function mpc_regulated_countries() {
	return array( 'AT', 'BE', 'BG', 'CH', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GB', 'GR', 'HR', 'HU', 'IE', 'IS', 'IT', 'LI', 'LT', 'LU', 'LV', 'MT', 'NL', 'NO', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK' );
}

/**
 * Cloudflare adds this header on every proxied request — no lookup needed.
 * Falls back to "unknown" (treated as regulated, the safe default) if absent.
 */
function mpc_visitor_country() {
	if ( ! empty( $_SERVER['HTTP_CF_IPCOUNTRY'] ) ) {
		return strtoupper( sanitize_text_field( wp_unslash( $_SERVER['HTTP_CF_IPCOUNTRY'] ) ) );
	}
	return 'XX';
}

function mpc_is_regulated_region() {
	$country = mpc_visitor_country();
	return 'XX' === $country || in_array( $country, mpc_regulated_countries(), true );
}

/**
 * Print the consent default BEFORE any other script (priority 0, ahead of
 * Site Kit's gtag snippet) so Google's Consent Mode sees it as the very
 * first command. Inline only — no network request, so nothing to block on.
 */
add_action( 'wp_head', 'mpc_print_consent_default', 0 );
function mpc_print_consent_default() {
	$regulated = mpc_is_regulated_region();
	$existing  = isset( $_COOKIE[ MPC_COOKIE_NAME ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ MPC_COOKIE_NAME ] ) ) : '';

	if ( 'granted' === $existing ) {
		$analytics_state = 'granted';
	} elseif ( 'denied' === $existing ) {
		$analytics_state = 'denied';
	} else {
		// No prior choice: default per region. Non-regulated = granted (matches
		// how the site behaved for US traffic before); regulated = denied until accept.
		$analytics_state = $regulated ? 'denied' : 'granted';
	}
	?>
<script id="mp-consent-default">
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('consent', 'default', {
	'analytics_storage': '<?php echo esc_js( $analytics_state ); ?>',
	'ad_storage': 'denied',
	'ad_user_data': 'denied',
	'ad_personalization': 'denied'
});
</script>
	<?php
}

/**
 * Banner only for regulated visitors who haven't chosen yet. Everyone else
 * (already granted by default, or already chose) gets nothing extra.
 */
add_action( 'wp_footer', 'mpc_maybe_render_banner' );
function mpc_maybe_render_banner() {
	if ( ! mpc_is_regulated_region() ) {
		return;
	}
	if ( isset( $_COOKIE[ MPC_COOKIE_NAME ] ) ) {
		return;
	}
	?>
<div id="mp-consent-banner" role="dialog" aria-label="Cookie consent" style="position:fixed;left:0;right:0;bottom:0;z-index:99999;background:#322876;color:#fff;padding:16px 20px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;justify-content:space-between;font:14px/1.4 -apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;">
	<div style="flex:1;min-width:240px;">
		We use cookies for analytics to understand how visitors use this site. You can accept or decline.
	</div>
	<div style="display:flex;gap:8px;flex-shrink:0;">
		<button id="mp-consent-decline" style="background:transparent;color:#fff;border:1px solid #ffffff88;border-radius:4px;padding:8px 16px;cursor:pointer;">Decline</button>
		<button id="mp-consent-accept" style="background:#DE005D;color:#fff;border:none;border-radius:4px;padding:8px 16px;cursor:pointer;font-weight:600;">Accept</button>
	</div>
</div>
<script>
(function () {
	function setChoice(choice) {
		document.cookie = '<?php echo esc_js( MPC_COOKIE_NAME ); ?>=' + choice + ';max-age=<?php echo (int) MPC_COOKIE_MAX_AGE; ?>;path=/;SameSite=Lax';
		if (window.gtag) {
			gtag('consent', 'update', { 'analytics_storage': choice === 'granted' ? 'granted' : 'denied' });
		}
		var banner = document.getElementById('mp-consent-banner');
		if (banner) banner.remove();
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?php echo esc_url_raw( admin_url( 'admin-ajax.php' ) ); ?>', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send('action=mpc_log_consent&choice=' + encodeURIComponent(choice));
	}
	document.getElementById('mp-consent-accept').addEventListener('click', function () { setChoice('granted'); });
	document.getElementById('mp-consent-decline').addEventListener('click', function () { setChoice('denied'); });
})();
</script>
	<?php
}

/**
 * Minimal consent log for GDPR record-keeping — hashed IP, no raw PII.
 */
add_action( 'plugins_loaded', 'mpc_maybe_create_log_table' );
function mpc_maybe_create_log_table() {
	if ( get_option( 'mpc_log_table_version' ) === '1' ) {
		return;
	}
	global $wpdb;
	$table_name      = $wpdb->prefix . 'mp_consent_log';
	$charset_collate = $wpdb->get_charset_collate();
	$sql             = "CREATE TABLE {$table_name} (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		ip_hash CHAR(64) NOT NULL,
		country VARCHAR(2) NOT NULL,
		choice VARCHAR(10) NOT NULL,
		created_at DATETIME NOT NULL,
		PRIMARY KEY (id)
	) {$charset_collate};";
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
	update_option( 'mpc_log_table_version', '1' );
}

add_action( 'wp_ajax_mpc_log_consent', 'mpc_log_consent' );
add_action( 'wp_ajax_nopriv_mpc_log_consent', 'mpc_log_consent' );
function mpc_log_consent() {
	global $wpdb;
	$choice = isset( $_POST['choice'] ) && 'granted' === $_POST['choice'] ? 'granted' : 'denied';
	$ip     = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$wpdb->insert(
		$wpdb->prefix . 'mp_consent_log',
		array(
			'ip_hash'    => hash( 'sha256', $ip . wp_salt() ),
			'country'    => mpc_visitor_country(),
			'choice'     => $choice,
			'created_at' => current_time( 'mysql' ),
		)
	);
	wp_die();
}
