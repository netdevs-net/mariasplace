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
                <div class="col-md-6">
                    <div class="site-info text-left">
                        &copy; <?php echo date("Y"); ?> <?php echo '<a href="' .
   home_url() .
   '">' .
   get_bloginfo("name") .
   "</a>"; ?>
                        <small class="sep"> | </small> 
                        <a class="credits" href="/terms-and-conditions/" target="_blank" title="Terms & conditions"><small>Terms & Conditions</small></a> 

                    </div><!-- close .site-info -->
                </div>
                <div class="col-md-6"></div>
            </div>

        </div>
    </footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

 /**
 * Kim (Verified by Parth)
 * 02-24-22 (15-10-2022)
 **/<?php
/**
 * Kim (Verified by Parth)
 * 02-24-22 (15-10-2022)
 **/
?>if (is_category() || is_search() || is_single()) { ?>
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
                echo do_shortcode(
                  '[nextend_social_login redirect="' .
                    $_SERVER["HTTP_REFERER"] .
                    '"]'
                );
                echo '<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_sep_color_grey vc_custom_1667318198632 lgn-or vc_separator-has-text" style="display:flex;"><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><h4 style="padding: 0 0.8em;line-height:0px;">or</h4><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                </div>';
                echo do_shortcode(
                  '[user_registration_form id="34864" redirect_url="' .
                    $_SERVER["HTTP_REFERER"] .
                    '"]'
                );
                echo '<div class="sign-up-msg" style="text-align: center;">Already have an account? <a href="/login/">Log in here</a></div>';
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
                <?php echo do_shortcode(
                  '[loginform_single_page redirect="/welcome-back/"]'
                ); ?>
            </div>
        </div>
    </div>
</div> -->



<?php wp_footer(); ?>
<link rel="stylesheet" href="https://res.cloudinary.com/veseylab/raw/upload/v1613706377/magicmouse/magic-mouse-1.1.css" />
<script type="text/javascript" src="https://res.cloudinary.com/veseylab/raw/upload/v1613706377/magicmouse/magic_mouse-1.1.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!--
    * Kim
    * 08-31-22
    * This block is for the bio modal that could be seen on
    * https://mp46.wpengine.com/about-us/
-->
<?php if (!empty($_GET["url"])) { ?>
<script type="text/javascript">
jQuery(document).ready(function($){
var ref_ul="/<?php echo $_GET["url"]; ?>/";
$("input[name='ur-redirect-url']").val(ref_ul);
});
</script>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#teamMemberBio").click(function () {
            jQuery('#teamMemberBio').modal('hide');
            jQuery('#magicMouseCursor').remove();
            jQuery('#magicPointer').remove();
            jQuery('body').attr("style", "cursor: auto");
        });
        jQuery(document).on('click', 'div[id^=team-]', function () {
            jQuery('#teamMemberBio .team_member_details .bio-inner .team-desc').text('');
            options = {
                "cursorOuter": "circle-basic",
                "hoverEffect": "circle-move",
                "hoverItemMove": false,
                "defaultCursor": false,
                "outerWidth": 75,
                "outerHeight": 75
            };
            magicMouse(options);
            jQuery('#magicMouseCursor').addClass('fa fa-times');
            var curentimg = jQuery(this).find("div").children("img");
            var curentposition = jQuery(this).find("span").text();
            var curentname = jQuery(this).find("h3").html();
            var curentid = jQuery(this).attr("id");
            var tid = curentid.split("-")[1];
            var templatedir = jQuery(this).find("div").text();
            var curentimg = jQuery(this).find("div.pic").html();
            var content = jQuery(this).find('div.templatedir').html();
            jQuery('#teamMemberBio .team_member_details .bio-inner h1').text(curentname);
            jQuery('#teamMemberBio .team_member_details .bio-inner .title').text(curentposition);
            jQuery('#teamMemberBio div.team_member_picture div.team_member_image').empty();
            jQuery('#teamMemberBio div.team_member_picture div.team_member_image').append(curentimg);
            jQuery('#teamMemberBio .team_member_details .bio-inner .team-desc').html(content);
        });
    });
</script>
<?php if (!is_user_logged_in()) {
  $free1 = get_post_meta(get_the_ID(), "free_content");
  if (get_post_type() == "post") {
    // if($free1[0]==0 || $flag!=1){
    // if ($free_content == 1 || $flag == 1 || $post_type != 'post' || $um_id != 0) {
    //     if ( wp_redirect("/registration/") ) {
    //         exit;
    //     }
    // <script type="text/javascript">
    // jQuery(window).on('load', function() {
    //     jQuery('#Registeration').modal('show');
    // });
    // </script>
    // }
  }
} ?>
<script>
//   jQuery(document).ready(function(){
//     jQuery( "#vimeo-iframe" ).on("error",function() {
//     alert( "Handler for .error() called." );
//   })
// // });
// (function () {
//     var old = console.log;
//     var logger = document.getElementById('vimeo-iframe');
//     console.log = function (message) {
//         alert(message);
//         if (typeof message == 'object') {
//             alert(JSON && JSON.stringify ? JSON.stringify(message) : message);
//         } else {
//             alert(message);
//         }
//     }
// })();
</script>
<script>
    /* This looks like Quantity JS */
    jQuery(document).ready(function ($) {
        $(document).on('click', '.plus', function (e) {
            $input = $(this).prev('input.qty');
            var val = parseInt($input.val());
            var step = $input.attr('step');
            step = 'undefined' !== typeof (step) ? parseInt(step) : 1;
            $input.val(val + step).change();
        });

        $(document).on('click', '.minus', function (e) {
            $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            var step = $input.attr('step');
            step = 'undefined' !== typeof (step) ? parseInt(step) : 1;
            if (val > 0) {
                $input.val(val - step).change();
            }
        });
        $(document).on('click', '.paid_feature_img,.paid_title,.paid_video,.paid', function (e) {
            $('form input[name="redirect_to"]').val($(this).attr('data-url'));
        });

    });

    // Written by parth on 11th nov
    jQuery(document).ready(function ($) {
        $('#searchform').submit(function(e){
        if($('#s').val() == ''){
            $('#s').val("Activity");
        }  
        });
    });
    // <?php
// global $post;
// $post_slug = $post->post_name;
// if($post_slug=="checkout"){
//
?>
    // jQuery(document).ready(function ($) {
    //     jQuery(".get_custom_shiping-total span.woocommerce-Price-amount").text("Shipping Not Available");
    //     jQuery("#ship-to-different-address-checkbox").on("click",function(e){
    //         if(!$(this).is(':checked')){
    //             console.log(jQuery("#billing_country").val());
    //             if(jQuery("#billing_country").val()!="US"){
    //                 jQuery(".get_custom_shiping-total span.woocommerce-Price-amount").text("Shipping Not Available");
    //             }
    //         }
    //     });
    // });
    // <?php
// }
//
?>
</script>
<span class="back-top"><i class="fa fa-angle-up"></i></span>
<script src="//code.tidio.co/qvzhinj6jkno4j1ywrmo5nkw1wyuoppc.js" async></script>
</body>
</html>