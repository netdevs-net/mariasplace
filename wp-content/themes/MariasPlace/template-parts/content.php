<?php
global $current_user;

// FREE MEMBERSHIP LEVEL IDs ARRAY
$freememberplanids = array(18, 26, 29, 31, 36);
?>
<?php
// Checking Post Format
$post_format = get_post_format();
// Check if user is Logged In
if (is_user_logged_in()) {
    $um_id = $current_user->ID;
} else {
    $um_id = 0;
}
$category_detail = get_the_category(get_the_id()); //$post->ID
foreach ($category_detail as $cd) {
    $free_category = $cd->slug;
}
$free_content = get_post_meta(get_the_ID(), 'free_content', true);


if (has_post_thumbnail()) {
    $feature_image_url = get_the_post_thumbnail_url(get_the_id(), 'full');
    $feature_image = '<div class="post-thumbnail mb-4"><div class="img-overlay" style="background-image:url(' . $feature_image_url . ');background-size: contain;background-position: center;background-repeat: no-repeat;background-color: rgba(50,40,118, 0.33);"></div></div>';
} else {
    $feature_image_url = get_template_directory_uri() . '/inc/assets/images/default-feature.png';
    $feature_image = '<div class="post-thumbnail mb-4"><div class="img-overlay" style="background-image:url(' . $feature_image_url . ');background-size: contain;background-position: center;min-height:450px;background-repeat: no-repeat;background-color: rgba(50,40,118, 0.33);"></div></div>';
}

$html_out = '';
if ($post_format == 'video') {

    $video_option = get_field('video_option', get_the_id());
    if ($video_option == 'Youtube' || $video_option == 'youtube') {
        $youtube_id = get_field('youtube_id', get_the_id());
        $VideoIframe = '<iframe class="video-player" src="https://www.youtube.com/embed/' . $youtube_id . '" allowfullscreen></iframe>';
    }
    if ($video_option == 'Vimeo' || $video_option == 'vimeo') {
        $vimeo_id = get_field('vimeo_id', get_the_id());
        $VideoIframe = '<iframe class="video-player" id="vimeo-iframe" src="https://player.vimeo.com/video/'. $vimeo_id .'" allowfullscreen></iframe>';
            //$VideoIframe = '<iframe src="https://player.vimeo.com/video/'.$vimeo_id.'/?dnt=1&app_id=122963" width="1170" height="658" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>';
        //$VideoIframe = '<object width="425" height="350" data="https://player.vimeo.com/video/'. $vimeo_id .'" type="application/x-shockwave-flash"><param name="src" value="https://player.vimeo.com/video/'. $vimeo_id .'" /></object>';
    }

    if (!empty($memberPlan)) {
        //echo ' <div class="post-thumbnail h-auto mb-4">'.$memberPlan.'</div>';
    }


    //echo '<div class="video-play-button"><i class="fa fa-play"></i></div>';
} else {
    $VideoIframe = $feature_image;
}
//CHECK IF PDF IS ATTCHED
if (!empty(get_field('pdf_url', get_the_id()))) {
        $PDFbutton = '<div class="w-100 d-block mt-2 mb-5"><a class="btn btn-lg btn-navyblue button is-primary" href="' . str_replace('/preview', '/edit', get_field('pdf_url', get_the_id())) . '" target="_blank">Click here to Print</a></div>';
        $pdf_Iframe = '<div class="col-12 py-5 mx-auto mb-5 bg-light"><div class="col-12 col-md-8 text-center mx-auto post-pdf-iframe"><iframe id="printf" class="pdf-iframe" src="' . get_field('pdf_url', get_the_id()) . '?usp=drivesdk" title="' . get_field('pdf_url', get_the_id()) . '"></iframe>' . $PDFbutton . '</div></div>';
    } else {
        $pdf_Iframe = '';
    }


/**
 * Kim
 * 02-24022
 * Declare $flag with value of 0 as default
 * */
$flag = 0;

//custom code to allow specific urls with params
//if gogole bot then allow
if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")) {
    $flag = 1;
}
//allow user only from these sites
$domains_allowed = array(
    "facebook.com", "google.co.in", "google.com", "pinterest.com",
    "instagram.com", "linkedin.com", "twitter.com", "t.co",
    "bing.com", "yahoo.com", "aarp.org", "alz.org"
);

// Get the referrer domain
$referrer_domain = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : '';
$referrer_domain = str_replace("https://", "", $referrer_domain);
$referrer_domain = str_replace("www.", "", $referrer_domain);
// Allow based on referrer
if (in_array($referrer_domain, $domains_allowed)) {
    $flag = 1;
}

// 24 oct new code testing
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (str_contains($user_agent, 'facebook') !== false) {
    $flag = 1;
}
if (str_contains($user_agent, 'twitter') !== false) {
    $flag = 1;
} 


// 24 oct new code testing
if (isset($_GET['referrer']) || isset($_GET['social'])  || isset($_GET['fbclid'])) {
    $flag = 1;
}

//New Code added for facebook 
// $current_url = $_SERVER['REQUEST_URI'];
// if (strpos($HTTP_SERVER_VARS['HTTP_REFERER'], 'facebook.com') !== false || strpos($HTTP_SERVER_VARS['HTTP_REFERER'], 'twitter.com') !== false) {
//     $flag = 1;
// }

// ------------------------- 9/26/2022 ----- ryan@wpsuperheroes.com -------  Testing why Paid Content is not showing the PDF

$post_type = get_post_type(get_the_ID());
//if ($free_content == 1 || $flag == 1 || $post_type != 'post') {
if ($free_content == 1 || $flag == 1 || $post_type != 'post' || $um_id != 0) {
    $html_out .= '<div class="wpb_video_widget wpb_content_element vc_clearfix   vc_video-aspect-ratio-169 vc_video-el-width-100 vc_video-align-left" ><div class="wpb_wrapper"><div class="wpb_video_wrapper">';
    $html_out .= $VideoIframe;
    $html_out .= '</div></div></div>';
    
   
    $html_out .= '<div class="post-item-content">';
    $html_out .= '<div class="post-inner-content col-12 p-0">';
    $html_out .= '<div class="row additional-details">';

    $suppliers_or_short = get_field('suppliers_or_short', get_the_id());
    if ($suppliers_or_short == 'Supplies' && !empty(get_field('supply_list', get_the_id()))) {
        $html_out .= '<div class="col-md-6 supply-list pb-4"> ';
        $html_out .= '<h3 class="additional-details-header">Supply List:</h3>';
        $html_out .= '<div class="supply-list-content">';
        if (have_rows('supply_list')):
            $html_out .= '<ul class="list-styled">';
            while (have_rows('supply_list')) : the_row();
                $sub_value = get_sub_field('list_item');
                $html_out .= '<li>' . $sub_value . '</li>';
            endwhile;
            $html_out .= '</ul>';
        else :
        endif;
        $html_out .= '</div>';
        $html_out .= '</div>';
    }
    elseif ($suppliers_or_short == 'Short Description' && !empty(get_field('short_description', get_the_id()))) {
        $html_out .= '<div class="col-md-6 short-description pb-4"> ';
        $html_out .= '<h3 class="additional-details-header">Short Description:</h3>';
        $html_out .= '<div class="supply-list-content">';
        $html_out .= get_field('short_description', get_the_id());
        $html_out .= '</div>';
        $html_out .= '</div>';
    }
    if (!empty(get_field('1-on-1', get_the_id())) || !empty(get_field('group', get_the_id())) || !empty(get_field('alzheimers_dementia', get_the_id()))) {
        $html_out .= '<div class="col-md-6 pb-4"><h3 class="additional-details-header">Directions for Caregivers:</h3>';
        $html_out .= '<div class="col-md-12 p-0  pb-4">';
        $html_out .= '<div class="accordion" id="directionForCaregivers">';
        $options = array('1-on-1' => '1 on 1', 'group' => 'Group', 'alzheimers_dementia' => "Alzheimer's & Dementia");
        foreach ($options as $key => $value) {
            $option = get_field($key, get_the_id()) ? get_field($key, get_the_id()) : array(false);

// ------------------------- 9/26/2022 ----- paul@wpsuperheroes.com -------  Warning: Undefined array key 0 in /nas/content/live/mp46/wp-content/themes/MariasPlace/template-parts/content.php on line 145 //
           // Fixed the issue by adding a false value to null variable //

            if ($option[0] == 'Yes' || $option[0] == 'yes' || $option[0] == 'YES') {
            	$acc_id = $key == "1-on-1" ? "test" : $key;
                $html_out .= '<div class="accordion-item">';
                $html_out .= '<h2 class="accordion-header card-header bg-white p-3 mb-0" id="' . $acc_id . '">';
                $html_out .= '<button class="btn btn-link-navyblue btn-block text-left p-0 accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $acc_id . '_description" aria-expanded="true" aria-controls="' . $acc_id . '_description">';
                $html_out .= $value;
                $html_out .= '</button>';
                $html_out .= '</h2>';
                $html_out .= '</div>';
                $html_out .= '<div id="' . $acc_id . '_description" class="accordion-collapse collapse" aria-labelledby="' . $acc_id . '" data-bs-parent="#directionForCaregivers">';
                $html_out .= '<div class="accordion-body">';
                $html_out .= get_field($key . '_description', get_the_id());
                $html_out .= '</div>';
                $html_out .= '</div>';
            }
        }
        $html_out .= '</div>';
        $html_out .= '</div>';
        $html_out .= '</div>';
    }
    $html_out .= '</div>';
    $html_out .= '</div>';
    $post_content = apply_filters('the_content', get_the_content());
            $html_out .= $pdf_Iframe;
    if (!empty(get_the_content())) {
        $html_out .= '<div class="col-12 p-0 text-center">';
        $html_out .= '<h3 class="additional-details-header">About this Activity</h3>';
        $html_out .= '</div>';
    }

    $html_out .= '<div class="col-12 p-0 post-content-text">';
    if (!empty(get_field('force_pin_image', get_the_id()))) {
        $ptClass= ' with-pinterest-image';
        $html_out .= '<div class="row ww">';
        if (!empty(get_the_content())) {
            $html_out .= '<div class="col-md-12 post-content-text">';
            $html_out .= do_shortcode(wpautop(get_the_content(), $ignore_html = false));
            $html_out .= '</div>';
            $html_out .= '<div class="col-md-4 post-pin-image mx-auto">';
            $html_out .= '<img src="' . get_field('force_pin_image', get_the_id()) . '" alt="' . get_the_title() . '" class="img-fluid" />';
            $html_out .= '</div>';
        } else {
            $html_out .= '<div class="col-md-4 post-pin-image mx-auto">';
            $html_out .= '<img src="' . get_field('force_pin_image', get_the_id()) . '" alt="' . get_the_title() . '" class="img-fluid" />';
            $html_out .= '</div>';
        }
        $html_out .= '</div>';
    } else {
          $ptClass = ' without-pinterest-image';
        $html_out .= '<div class="col-12 col-md-10 mx-auto p-0 post-content-text'.$ptClass.'">';
        $html_out .= do_shortcode(wpautop(get_the_content(), $ignore_html = false));
        $html_out .= '</div>';
    }
    $html_out .= '</div>';
} else {
    /* This is redirection for registration page */
    // if ( wp_redirect("/registration/") ) {
    //     exit;
    // }

    /* This is redirection to the locked page */
    if ( wp_redirect("/locked-content/?post=" . get_the_id()) ) {
        exit;
    }

//     if (!$um_id || $um_id == 0) {

//         $html_out .= '<div class="post-thumbnail mt-5 locked-content" data-bs-toggle="modal" data-bs-target="#Registeration">';
//         $html_out .= '<div class="post-item-header text-center">';
//         $html_out .= '<h1 class="section-main-title mb-3">' . get_the_title() . '</h1>';
//         if (!empty(get_field('heading_1', get_the_id()))) {
//             $html_out .= '<div class="col-12 col-md-10 mx-auto mb-3"><div class="font-36">' . get_field('heading_1', get_the_id()) . '</div></div>';
//         }
//         if (!empty(get_field('heading_2', get_the_id()))) {
//             $html_out .= '<div class="col-12 col-md-10 mx-auto mb-3 d-none"><div class="font-24">' . get_field('heading_2', get_the_id()) . '</div></div>';
//         }
//         $html_out .= '<i class="fa fa-lock"></i>';
//         $html_out .= '</div>';
//         $html_out .= '</div>';
//         $html_out .= '<div id="lock-msg">';
//         $html_out .= '<i class="fa fa-exclamation-circle fa-lg mr-1 mr-md-3"></i> Login or register to view this content and more!';
//         $html_out .= '</div>';
//         $html_out .= '<div id="locked-content" class="post-item-content locked-content mb-5">';
//         $html_out .= '<div class="row no-gutters">';
//         $html_out .= '<div id="col-login" class="col-md-6 custom-design-login-form">';
//         // Start - Parth Kadecha - 26-10-2022 added nextend short code for login
//         $html_out .= do_shortcode('[nextend_social_login provider="facebook" redirect="'.$_SERVER['HTTP_REFERER'].'"]');
//         $html_out .= do_shortcode('[nextend_social_login provider="google" redirect="'.$_SERVER['HTTP_REFERER'].'"]');
//         $html_out .= do_shortcode('[user_registration_my_account redirect_url="'.$_SERVER['HTTP_REFERER'].'"]');
//         $html_out .= '</div>';
//         $html_out .= '<div id="col-register" class="col-md-6">';
//         $html_out .= '<p class="text-center font-36 text-white my-3">Register</p>';
//         $html_out .= '<p class="text-center font-24 text-white mb-4">Unlock the unlimited access of our content, resources, and join the community!</p>';
//         $html_out .= '<div class="row d-flex justify-content-center text-center text-white mb-3">';
//         $html_out .= '<div class="col-4 px-3">';
//         $html_out .= '<strong class="font-36 mb-3">600+</strong>';
//         $html_out .= '<p class="font-24 mb-3">Activities</p>';
//         $html_out .= '</div>';
//         $html_out .= '<div class="col-4 px-3">';
//         $html_out .= '<strong class="font-36 mb-3">250+</strong>';
//         $html_out .= '<p class="font-24 mb-3">Videos</p>';
//         $html_out .= '</div>';
//         $html_out .= '</div>';
//         $html_out .= '<div class="row d-flex justify-content-center text-center text-white">';
//         $html_out .= '<div class="col-12 px-3">';
//         $html_out .= '<a id="locked-btn-register" class="button btn is-primary" href="/registration/?level=26">Register for Free Membership</a>';
//         $html_out .= ' </div>';
//         $html_out .= '</div>';
//         $html_out .= '</div>';
//         $html_out .= '</div>';
//         $html_out .= '</div>';
//     } else {
//         if (in_array($um_id, $freememberplanids)) {
//             $html_out .= '<div class="wpb_video_widget wpb_content_element vc_clearfix   vc_video-aspect-ratio-169 vc_video-el-width-100 vc_video-align-left" ><div class="wpb_wrapper"><div class="wpb_video_wrapper">';
//             $html_out .= $VideoIframe;
//             $html_out .= '</div></div></div>';
//             $html_out .= '<div class="post-item-content 2">';
         
//             $html_out .= '<div class="post-inner-content col-12 p-0">';
//             $html_out .= '<div class="row additional-details">';

//             $suppliers_or_short = get_field('suppliers_or_short', get_the_id());
// //            SUPPLY LIST
//             $supply_list = '';
//             if (!empty(get_field('supply_list', get_the_id()))) {
//                 $supply_list .= '<div class="col-md-6 supply-list pb-4"> ';
//                 $supply_list .= '<h3 class="additional-details-header">Supply List:</h3>';
//                 $supply_list .= '<div class="supply-list-content">';
//                 if (have_rows('supply_list')):
//                     $supply_list .= '<ul class="list-styled">';
//                     while (have_rows('supply_list')) : the_row();
//                         $sub_value = get_sub_field('list_item');
//                         $supply_list .= '<li>' . $sub_value . '</li>';
//                     endwhile;
//                     $supply_list .= '</ul>';
//                 else :
//                 endif;
//                 $supply_list .= '</div>';
//                 $supply_list .= '</div>';
//             }
// //            SUPPLY LIST
//             if ($suppliers_or_short == 'Supplies') {
//                 $html_out .= $supply_list;
//             }
// //            SHORT DESCRIPTION
//             $short_description = '';
//             if (!empty(get_field('short_description', get_the_id()))) {
//                 $short_description .= '<div class="col-md-6 short-description pb-4 pr-md-3"> ';
//                 $short_description .= '<h3 class="additional-details-header">Short Description:</h3>';
//                 $short_description .= '<div class="supply-list-content">';
//                 $short_description .= get_field('short_description', get_the_id());
//                 $short_description .= '</div>';
//                 $short_description .= '</div>';
//             }
// //            SHORT DESCRIPTION
//             if ($suppliers_or_short == 'Short Description') {
//                 $html_out .= $short_description;
//             }

//             $dfc_out = '';
//             if (!empty(get_field('1-on-1', get_the_id())) || !empty(get_field('group', get_the_id())) || !empty(get_field('alzheimers_dementia', get_the_id()))) {
//                 $dfc_out .= '<div class="col-md-6 pb-4"><h3 class="additional-details-header">Directions for Caregivers:</h3>';
//                 $dfc_out .= '<div class="col-md-12 p-0  pb-4">';
//                 $dfc_out .= '<div class="accordion" id="directionForCaregivers">';
//                 $options = array('1-on-1' => '1 on 1', 'group' => 'Group', 'alzheimers_dementia' => "Alzheimer's & Dementia");
//                 foreach ($options as $key => $value) {
//                     $option = get_field($key, get_the_id());
//                     if ($option[0] == 'Yes' || $option[0] == 'yes' || $option[0] == 'YES') {
// 		            	$acc_id = $key == "1-on-1" ? "test" : $key;
// 		                $dfc_out .= '<div class="accordion-item">';
// 		                $dfc_out .= '<h2 class="accordion-header card-header bg-white p-3 mb-0" id="' . $acc_id . '">';
// 		                $dfc_out .= '<button class="btn btn-link-navyblue btn-block text-left p-0 accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $acc_id . '_description" aria-expanded="true" aria-controls="' . $acc_id . '_description">';
// 		                $dfc_out .= $value;
// 		                $dfc_out .= '</button>';
// 		                $dfc_out .= '</h2>';
// 		                $dfc_out .= '</div>';
// 		                $dfc_out .= '<div id="' . $acc_id . '_description" class="accordion-collapse collapse" aria-labelledby="' . $acc_id . '" data-bs-parent="#directionForCaregivers">';
// 		                $dfc_out .= '<div class="accordion-body">';
// 		                $dfc_out .= get_field($key . '_description', get_the_id());
// 		                $dfc_out .= '</div>';
// 		                $dfc_out .= '</div>';                        
//                     }
//                 }

//                 $dfc_out .= '</div>';
//                 $dfc_out .= '</div>';
//                 $dfc_out .= '</div>';
//             }
//             $html_out .= $dfc_out;

//             $html_out .= '</div>';
//             $html_out .= '</div>';
//             $html_out .= $pdf_Iframe;
//             $post_content = apply_filters('the_content', get_the_content());
//             if (!empty(get_the_content())) {
//                 $html_out .= '<div class="col-12 p-0 text-center">';
//                 $html_out .= '<h3 class="additional-details-header">About this Activity</h3>';
//                 $html_out .= '</div>';
//             }

//             if (!empty(get_field('force_pin_image', get_the_id()))) {
//                 $html_out .= '<div class="row">';
//                 if (!empty(get_the_content())) {
//                     $html_out .= '<div class="col-md-12 col-lg-12 post-content-text IMHERE">';
//                     $html_out .= do_shortcode(wpautop(get_the_content(), $ignore_html = false));
//                     $html_out .= '</div>';
//                     $html_out .= '<div class="col-md-6 col-lg-4 post-pin-image mt-2 mb-4 mx-auto">';
//                     $html_out .= '<img src="' . get_field('force_pin_image', get_the_id()) . '" alt="' . get_the_title() . '" class="img-fluid" />';
//                     $html_out .= '</div>';
//                 } else {
//                     $html_out .= '<div class="col-md-6 col-lg-4 post-pin-image mx-auto">';
//                     $html_out .= '<img src="' . get_field('force_pin_image', get_the_id()) . '" alt="' . get_the_title() . '" class="img-fluid" />';
//                     $html_out .= '</div>';
//                 }
//                 $html_out .= '</div>';
//             } else {
//                 $html_out .= '<div class="col-12 col-md-10 mx-auto p-0 post-content-text">';
//                 $html_out .= do_shortcode(wpautop(get_the_content(), $ignore_html = false));
//                 $html_out .= '</div>';
//             }

//             $html_out .= '</div>';
//         }
//     }
}
?>


<div class="grid-item single-post-item">
    <div class="post-item h-100 <?= $post_format; ?>">
        <?php
        echo '<div class="post-item-header text-center my-4">';
        echo '<h1 class="section-main-title">' . get_the_title() . '</h1>';
        if (!empty(get_field('heading_1', get_the_id()))) {
            echo '<div class="col-12 col-md-10 mx-auto"><div class="font-36">' . get_field('heading_1', get_the_id()) . '</div></div>';
        }
        if (!empty(get_field('heading_2', get_the_id()))) {
            echo '<div class="col-12 col-md-10 mx-auto"><div class="font-24">' . get_field('heading_2', get_the_id()) . '</div></div>';
        }
        echo '</div>';
        //echo sharethis_inline_buttons();
        ?>
        <div class="post-item-body">
            <?php echo $html_out; ?>
        </div>
    </div>
</div>