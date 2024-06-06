<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */
?>

<?php if (
  !is_page_template("blank-page.php") &&
  !is_page_template("blank-page-with-container.php")
): ?>
    <?php if (!is_product()): ?>
    </div><!-- .row -->
    </div><!-- .container -->
    <?php endif; ?>
    </div><!-- #content -->
    <?php get_template_part("footer-widget"); ?>
    <footer id="colophon" class="site-footer bg-light">
        <div class="container pt-3 pb-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info text-center">
                        &copy; <?php echo date("Y"); ?> <?php echo '<a href="'.home_url().'/about-us">'.get_bloginfo("name").'</a>'; ?>
                        <small class="sep"> | </small> 
                        <a class="credits" href="/terms-and-conditions/" target="_blank" title="Terms & conditions"><small>Terms & Conditions</small></a> 

                    </div><!-- close .site-info -->
                </div>
            </div>

        </div>
    </footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php
if (is_category() || is_search() || is_single()) { ?>
<div id="Registeration" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Signupform" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <h5 class="modal-title">Register Here</h5>
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <p style="text-align: center;" class="mt-4">Registration is 100% Free.
                        We believe everyone deserves access
                        to activities and resources.</p>
                    </div>
                </div>
                <div class="wpb_text_column wpb_content_element  lgn-recommended">
                    <div class="wpb_wrapper">
                        <p style="text-align: right; font-size: 10px; margin: 0px; padding: 0px;">Recommended</p>

                    </div>
                </div>
                <?php
                /**
                 * Parth
                 * 15-10-2022
                 * Used User Registration Form
                 * echo do_shortcode(' [pmpro_signup submit_button="Unlock this Post Now!" level="26" redirect="referer"] ');
                 * */
                echo do_shortcode('[nextend_social_login redirect="'.$_SERVER['HTTP_REFERER'].'"]');
                echo '<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_sep_color_grey vc_custom_1667318198632 lgn-or vc_separator-has-text" style="display:flex;"><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><h4 style="padding: 0 0.8em;line-height:0px;">or</h4><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span></div>';
                echo do_shortcode('[user_registration_form id="34864"]');
                $ref_url = $_SERVER["REQUEST_URI"];
                echo '<div class="sign-up-msg" style="text-align: center;">Already have an account? <a href="/login/?redirect_url='.$ref_url.'">Log in here</a></div>';
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- 
<div id="Login" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginform" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <h3 class="modal-title">Login</h3>
                <?php
                // echo do_shortcode(
                //   '[loginform_single_page redirect="/'.$_SERVER['REQUEST_URI'].'/"]'
                // );
                ?>
            </div>
        </div>
    </div>
</div> -->



<?php wp_footer(); ?>
<link rel="stylesheet" href="https://res.cloudinary.com/veseylab/raw/upload/v1613706377/magicmouse/magic-mouse-1.1.css" />
<script src="https://res.cloudinary.com/veseylab/raw/upload/v1613706377/magicmouse/magic_mouse-1.1.js"></script>
<!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<?php
if(!empty($_GET["url"])){
?>
<script type="text/javascript">
jQuery(document).ready(function($){
var ref_ul="/<?php echo $_GET["url"]?>/";
$("input[name='ur-redirect-url']").val(ref_ul);
$("input[name='_wp_http_referer']").val(ref_ul);
});
</script>
<?php
}
?>
<script type="text/javascript">
jQuery(document).ready(function () {
    <?php if(isset($_GET['url'])){ ?>
        const urlParam = "<?php echo htmlspecialchars($_GET['url'], ENT_QUOTES, 'UTF-8'); ?>";
        const ref_ul = `/${urlParam}/`;
        jQuery("input[name='ur-redirect-url']").val(window.location.pathname);
        jQuery("input[name='_wp_http_referer']").val(ref_ul);
    <?php }?>

    jQuery("#teamMemberBio").click(function () {
        jQuery('#teamMemberBio').modal('hide');
        jQuery('#magicMouseCursor').remove();
        jQuery('#magicPointer').remove();
        jQuery('body').css("cursor", "auto");
    });

    jQuery(document).on('click', 'div[id^=team-]', function () {
        const teamBio = jQuery('#teamMemberBio .team_member_details .bio-inner .team-desc');
        teamBio.text('');

        const options = {
            "cursorOuter": "circle-basic",
            "hoverEffect": "circle-move",
            "hoverItemMove": false,
            "defaultCursor": false,
            "outerWidth": 75,
            "outerHeight": 75
        };
        magicMouse(options);

        jQuery('#magicMouseCursor').addClass('fa fa-times');

        const currentElement = jQuery(this);
        const currentImg = currentElement.find("div.pic").html();
        const currentPosition = currentElement.find("span").text();
        const currentName = currentElement.find("h3").text(); // Using text() to avoid XSS
        const currentId = currentElement.attr("id");
        const tid = currentId.split("-")[1];
        const templateDir = currentElement.find("div.templatedir").text(); // Assuming this is safe
        const content = currentElement.find('div.templatedir').html(); // Ensure content is sanitized before this

        jQuery('#teamMemberBio .team_member_details .bio-inner h1').text(currentName);
        jQuery('#teamMemberBio .team_member_details .bio-inner .title').text(currentPosition);
        const teamImage = jQuery('#teamMemberBio div.team_member_picture div.team_member_image');
        teamImage.empty();
        teamImage.append(currentImg); // Ensure this HTML is safe
        teamBio.html(content); // Ensure content is sanitized before this
    });
});

jQuery(document).ready(function ($) {

    $(document).on('click', '.plus', function (e) {
        const $input = $(this).prev('input.qty');
        if ($input.length) {
            const val = parseInt($input.val(), 10) || 0;
            const step = parseInt($input.attr('step'), 10) || 1;
            $input.val(val + step).change();
        }
    });

    $(document).on('click', '.minus', function (e) {
        const $input = $(this).next('input.qty');
        if ($input.length) {
            const val = parseInt($input.val(), 10) || 0;
            const step = parseInt($input.attr('step'), 10) || 1;
            if (val > 0) {
                $input.val(Math.max(0, val - step)).change();
            }
        }
    });

    $(document).on('click', '.paid_feature_img, .paid_title, .paid_video, .paid', function (e) {
        const dataUrl = $(this).attr('data-url');
        if (dataUrl) {
            $('form input[name="redirect_to"]').val(dataUrl);
        }
    });

    $('#searchform').submit(function (e) {
        const searchInput = $('#s');
        if (searchInput.length && searchInput.val().trim() === '') {
            searchInput.val("Activity");
        }
    });

    if ($(".subscription-details").length) {
        const subDetails = $('.subscription-details');
        const detailsText = subDetails.html().split('with')[0];
        subDetails.html(detailsText);
    }
});

</script>
<span class="back-top"><i class="fa fa-angle-up"></i></span>
<?php
// if (!is_front_page()){
    ?>
    <!-- <script src="//code.tidio.co/qvzhinj6jkno4j1ywrmo5nkw1wyuoppc.js" async></script> -->
    <?php
// }
/*
<!-- Start of HubSpot Embed Code -->
// <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/23906868.js"></script>
<!-- End of HubSpot Embed Code -->
	*/ 
	?>
</body>
</html>