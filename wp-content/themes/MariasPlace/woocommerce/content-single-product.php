<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
?>

<?php
if(get_the_ID() != 43116):
        $top_membership_option = get_field('top_membership_option', get_the_ID());
        if (!empty($top_membership_option)) :
        echo do_shortcode($top_membership_option);
        endif;
endif;

if(get_the_ID() != 43116 AND get_the_ID() != 46788) :
$product = wc_get_product(get_the_ID());
$args = array(
    'post_id' => get_the_ID(),
    'status' => 'approve',
    'post_status' => 'publish',
    'post_type' => 'product'
);

$comments = get_comments($args);
?>
<section class="single_digtal_sec bg-white" id="single_digtal_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h1 class="section-main-title font-weight-normal main-product-title"><?php echo $product->get_title(); ?></h1></div>
            <div class="col-12 mb-md-4 mb-3">
                <div class="digital_top_img">
                    <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="product">
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 col-lg-9 col-12">
                <div class="digi_short_desc"><?php echo wpautop($product->get_short_description()); ?> </div>
            </div>
            <div class="col-md-4 col-lg-3 col-12">
                <div class="digital_dec_right">
                    <div class="digi_rating">
                        <?php if ($average = $product->get_average_rating()) : ?>
                            <?php echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __('out of 5', 'woocommerce') . '</span></div>'; ?>
                        <?php endif; ?>
                        <?php if (count($comments) != 0) : ?>
                            <a href="#desc_review_sec"><span class="d-block"><?php echo count($comments); ?> Customer Reviews</span></a>
                        <?php endif; ?>
                    </div>
                    <p class="my-sm-3 my-2 product-price"><?php echo $product->get_price_html();?>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="cart_btn btn is-secondary">Add to cart</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$sample_booklet_title = get_field('sample_booklet_title', get_the_ID());
$sample_booklet_image = get_field('sample_booklet_image', get_the_ID());
$sample_booklet_description = get_field('sample_booklet_description', get_the_ID());
$sample_booklet_radio = get_field('sample_booklet_radio', get_the_ID());
$sample_booklet_pdf_shortcode = get_field('sample_booklet_pdf_shortcode', get_the_ID());
if (!empty($sample_booklet_image) || !empty($sample_booklet_title) || !empty($sample_booklet_description)) :
    ?>
    <section class="single_booklet_sec" id="single_booklet_sec">
        <div class="container">
            <div class="row gx-10">
                <?php if (!empty($sample_booklet_title) || !empty($sample_booklet_description)) : ?> 
                    <div class="col-lg-6 text-center text-lg-right col-12">
                        <div class="booklet_dec">
                            <h2 class="section-main-title mb-3"><?php echo $sample_booklet_title; ?></h2>
                            <?php echo $sample_booklet_description; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($sample_booklet_image) || !empty($sample_booklet_pdf_shortcode)) : ?>
                    <div class="col-lg-6 col-12">
                        <div class="mt-3 mt-lg-0">
                            <?php if ($sample_booklet_radio == "PDF"): ?>
                                <?php echo do_shortcode($sample_booklet_pdf_shortcode, $ignore_html = false); ?>
                            <?php else : ?>
                                <img src="<?php echo $sample_booklet_image['url']; ?>" alt="booklet">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="desc_review_sec" id="desc_review_sec">
    <div class="container">
        <div class="row">
            <div class="col-12 bg-white">
                <div class="single_prod_tab">
                    <?php do_action('woocommerce_after_single_product_summary'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$booklet_section_title = get_field('booklet_section_title', get_the_ID());
$booklet_section_description = get_field('booklet_section_description', get_the_ID());
$booklet_section_button = get_field('booklet_section_button', get_the_ID());
if (!empty($booklet_section_title) || !empty($booklet_section_description) || !empty($booklet_section_button)) :
    ?>
    <section class="monthly_booklet_sec">
        <div class="container">
            <div class="row">
                <div class="col-12 monthly_booklet_inner text-center">
                    <?php echo ($booklet_section_title) ? '<h2 class="font-36 mb-3 text-white">' . $booklet_section_title . '</h2>' : ''; ?>
                    <?php echo ($booklet_section_description) ? '<p class="mb-4">' . $booklet_section_description . '</p>' : ''; ?>
                    <?php echo ($booklet_section_button) ? '<a href="' . $booklet_section_button['url'] . '" class="booklet_cart_btn btn is-secondary">' . $booklet_section_button['title'] . '</a>' : ''; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php
$bottom_membership_option = get_field('bottom_membership_option', get_the_ID());
if (!empty($bottom_membership_option)) :
    echo do_shortcode($bottom_membership_option);
endif;
?>
<?php 
        elseif(get_the_ID() == 46788):
                $cinco_id = 46788; 
        ?>
        
        <section class="cinco-banner">
                <div class="container">
                        <div class="row">
                                <div class="col-md-6 offset-md-6">
                                        <div class="cinco-banner__content">
                                                <?php if(get_field("pre_banner_image")): ?>
                                                        <img src="<?= get_field("pre_banner_image")?>" class="cinco-banner__content__pre-banner" alt="Maria's Place">
                                                <?php endif; ?>
                                                <?php if(get_field("banner_image")): ?>
                                                        <img src="<?= get_field("banner_image") ?>" class="cinco-banner__content__banner-image" alt="Cinco De Mayo">
                                                <?php endif; ?>        
                                        </div>                                        
                                </div>
                        </div>
                </div>
        </section>

        <section class="cinco-cols text-center">
                <div class="container">
                        <div class="row">
                                <div class="col cinco-cols__heading">
                                        <h2><?= get_field("2nd_heading") ?></h2>
                                        <?= get_field("2nd_sub_heading") ?>
                                </div>
                        </div>
                        <div class="row">
                                <?php while( have_rows('2nd_items') ) : the_row(); ?>
                                        <div class="col-md-4 col-6">
                                                <?php if(get_sub_field("item_url")): ?>
                                                        <a href="<?= get_sub_field("item_url") ?>" >
                                                <?php endif; ?>
                                                        <div class="cinco-cols__item">
                                                                <img src="<?= get_sub_field('item_img') ?>" >
                                                                <h4><?= get_sub_field('item_title') ?></h4>
                                                        </div>                  
                                                <?php if(get_sub_field("item_url")): ?>
                                                        </a>
                                                <?php endif; ?>                                                                      
                                        </div>
                                <?php endwhile; ?>
                        </div>
                        <div class="row">
                                <div class="col cinco-cols__post-item">
                                        <div class="cinco-cols__post-item__text">
                                                <?= get_field("2nd_pre_button_content") ?>
                                        </div>
                                        <?php if(get_field("2nd_button")): ?>
                                                <a class="btn is-secondary" href="<?= get_field("2nd_button")["url"] ?>" ><?= get_field("2nd_button")["title"] ?></a>
                                        <?php endif; ?>                                        
                                 </div>                                
                        </div>
                </div>
        </section>        

        <section class="cinco-book">
                <div class="container">
                        <div class="row align-items-center">
                                <div class="col-md-6">
                                        <div class="cinco-book__pdf">
                                                <img src="<?= get_field("ebook") ?>" alt="EBook">  
                                        </div>                                        
                                </div>
                                <div class="col-md-6">
                                        <div class="cinco-book__content">
                                                <?= wpautop(get_field("right_section")) ?>    
                                                <a href="<?= get_field("button")["url"] ?>" class="btn is-primary"><?= get_field("button")["title"] ?></a>
                                        </div>                                        
                                </div>                                
                        </div>
                </div>
        </section>  
        
        <section class="cinco-reviews">
                <div class="container">
                        <div class="row">
                                <div class="col">
                                        <?php do_action('woocommerce_after_single_product_summary'); ?>
                                </div>
                        </div>
                </div>
        </section>
        <section class="cinco-spotlight">
                <div class="container">
                        <div class="row">
                                <div class="col text-center">
                                        <h2><?= get_field("spotlight_heading") ?></h2>
                                </div>
                        </div>
                        <div class="row cinco-spotlight__cover">
                                <div class="col-6 cinco-spotlight__cover__1">
                                        <img src="<?= get_field("book_cover1") ?>">
                                </div>
                                <div class="col-6 cinco-spotlight__cover__2">
                                        <img src="<?= get_field("book_cover2") ?>">
                                </div>
                        </div>      
                        <div class="row">
                                <div class="mx-auto col-md-9 col-sm-12 text-center">
                                        <div class="cinco-spotlight__text">
                                                <?= wpautop(get_field("spotlight_description")) ?>
                                        </div>
                                </div>
                        </div>                                          
                </div>
        </section>

        <section class="cinco-membership member_top_sec explore_membership">
                <div class="membership_top">
                        <div class="container">
                                <div class="row">
                                        <div class="col-12">
                                                <h2 class="section-main-title text-center py-md-5 py-3" style="font-weight: 700" ><?= get_field("membership_heading") ?></h2>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="membership_bottom">
                        <div class="container">
                                <div class="row justify-content-center">
                                        <?php while( have_rows('membersip_items') ) : the_row(); ?>
                                                <div class="col-lg-3 col-sm-4 col-12">
                                                        <div class="membership_box">
                                                                <div class="image_box text-center d-flex justify-content-center align-items-center">
                                                                        <a href="<?= get_sub_field("item_url") ?>" class="d-block"><img src="<?= get_sub_field("item_image") ?>" alt=""></a>
                                                                </div>
                                                                <p class="font-36 text-center mt-md-4 my-sm-3 my-2 mb-sm-0"><?= get_sub_field("item_title") ?></p>
                                                        </div>
                                                </div>
                                        <?php endwhile; ?>
                                </div>
                        </div>
                </div>
        </section>   

<?php 
        else :
        $product = wc_get_product(get_the_ID());                
?>
        <section class="christmas-act section" style="padding-bottom:32rem;">
                <div class="container">
                        <div class="columns">
                                <div class="column is-6 is-offset-6 is-12-mobile ca-content">
                                        <img src="<?= get_template_directory_uri() ."/inc/assets/images/Mask-group-svg.png"; ?>" class="rbbg">
                                        <div class="ca-header">
                                                <?= get_field("ca_heading", 42681) ?>
                                        </div>
                                        <div class="ca-desc">
                                                <p>
                                                        <?= get_field("ca_content", 42681) ?> 										
                                                </p>
                                                <!-- <a href="<?= get_field("section1_button", get_the_ID()) ?>" class="splash-cta-btn button is-primary"><?= get_field("section1_button_label", get_the_ID()) ?></a>									 -->
                                        </div>
                                </div>
                        </div>
                </div>
        </section>    
        <!-- <section class="wavebg">
                <img src="/wp-content/themes/MariasPlace/inc/assets/images/in.svg" style="">
        </section>         -->
        
        <section class="act-info section" style="background:url(/wp-content/themes/MariasPlace/inc/assets/images/Homepage_Wave.svg);background-size:cover;background-position:top;margin-top: -28rem !important;">
                <div class="container" style="padding-top:15rem;padding-bottom:5rem;">
                        <div class="columns">
                                <div class="column is-8 is-offset-2 is-12-mobile">
                                        <h2 class="ai-heading">
                                                Christmas Activities
                                        </h2>
                                        <h3 class="ai-postheading">
                                                Christmas is coming and you want to make this the best one yet!
                                        </h3>
                                        <p>
                                                Well, we have the perfect solution for you. Our digital downloadable booklet has everything you need to get into the Holiday Spirit. You'll find
                                                <ul class="xmas-info-box">
                                                 <li><img src="/wp-content/uploads/2022/12/1.png">Brain Teasers</li>
                                                 <li><img src="/wp-content/uploads/2022/12/2.png">Christmas recipes</li>
                                                 <li><img src="/wp-content/uploads/2022/12/6.png">3 Christmas Crafts</li>
                                                 <li><img src="/wp-content/uploads/2022/12/4.png">Guided Yoga with Video</li>
                                                 <li><img src="/wp-content/uploads/2022/12/5.png">Lettering and Doodling with Positive Affirmations</li>
                                                 <li><img src="/wp-content/uploads/2022/12/3.png">Mandala Coloring</li>
                                                </ul>
                                                <!-- <div class="xmas-info-box">
                                                        <div class="xmas-info-box-inner">
                                                                <div class="xmas-box-1">Brain Teasers</div>
                                                                <div class="xmas-box-2">Christmas recipes</div>
                                                        </div>
                                                        <div class="xmas-info-box-inner">
                                                                <div class="xmas-box-3">3 Christmas Crafts</div>
                                                                <div class="xmas-box-4">Guided Yoga with Video</div>
                                                        </div>
                                                        <div class="xmas-info-box-inner">
                                                                <div class="xmas-box-5">Lettering and Doodling with Positive Affirmations</div>
                                                                <div class="xmas-box-6">Mandala Coloring</div>
                                                        </div>
                                                </div> -->
                                                <p>- all designed to bring happiness and joy to you and your loved one.</p>                                                
                                        </p>
<style>
.xmas-info-box {
        font-size: 1.4rem;
    text-align: left;
    max-width: 40rem;
    margin: 1rem auto;
}
.xmas-info-box li {
    padding: 1rem;
    border-radius: 15px;
    border-bottom: 1px solid #ff3434;
    color:#000;
    font-weight:bold;
}
.xmas-info-box img{
        height: 60px;
    vertical-align: middle;
    margin-right: 1.5rem;
}
/* .xmas-info-box-inner{
min-width:12rem;
display:flex;
}
.xmas-info-box-inner>div {
    min-width: 12rem;
    width: 100%;
    margin: 0.5rem;
    padding: 3rem 0.5rem;
    border-radius:5px;
}
.xmas-box-1{background:#A68BE5;color:#fff;}
.xmas-box-2{background:#b8f2e6;}
.xmas-box-3{background:#faf3dd;}
.xmas-box-4{background:#ffa69e;}
.xmas-box-5{background:#ed3d60;color:#fff;}
.xmas-box-6{background:#84ff84;} */
</style>
                                        <a href="/cart/<?= $product->add_to_cart_url() ?>" class="button is-primary">
                                                Get Activities
                                        </a>
                                </div>
                        </div>
                </div>
        </section>   
        <section class="xmas-ebook section">
                <div class="container">
                        <div class="columns">
                                <div class="column is-10 is-offset-1 is-12-mobile">
                                        <?php 
                                                // echo do_shortcode('[dflip id="25408"][/dflip]');
                                        ?>
                                        <img src="/wp-content/uploads/2022/12/christmas_activity.jpg" class="w-100">
                                </div>
                        </div>
                        <div class="columns">
                                <div class="column is-8 is-offset-2 is-12-mobile">
                                        <p>
                                        Imagine all of the amazing memories that you'll make together as you do these fun activities. The <strong>Christmas Holiday Printable Gift</strong> is the perfect way to spend some quality time with your loved one.                                                
                                        </p>
                                </div>                                
                        </div>
                </div>
        </section> 
        <section class="xmas-cta section">
                <div class="container">
                        <div class="columns">
                                <div class="column is-8 is-offset-2 is-12mobile">
                                        <h2>
                                                Purchase our digital downloadable booklet today!
                                        </h2>
                                        <div class="xcta-btn">
                                                <a href="/cart/<?= $product->add_to_cart_url() ?>" class="button is-primary">
                                                        Add to Cart
                                                </a>                                                
                                        </div>
                                </div>
                        </div>
                </div>
        </section>
        <section class="xcta-bg">
                <img src="https://mpnewstaging.wpengine.com/wp-content/uploads/2022/12/Purple-Wave-footer.png" >
        </section>    
        <section class="xmas-tabs section">
                <div class="container">
                     <div class="columns">
                        <div class="column">
                                <?php do_action('woocommerce_after_single_product_summary'); ?>                                
                        </div>
                     </div>
                </div>
        </section>
        <section class="xmas-after-tabs section">
                <div class="container">
                     <div class="columns">
                        <div class="column">

                        </div>
                     </div>
                </div>
        </section>
        <section class="member_top_sec explore_membership">
                <div class="membership_top">
                        <div class="container">
                                <div class="row">
                                        <div class="col-12">
                                                <h2 class="section-main-title text-center py-md-5 py-3" style="font-weight: 700" >Explore our Membership Options</h2>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="membership_bottom">
                        <div class="container">
                                <div class="row justify-content-center">
                                        <div class="col-lg-3 col-sm-4 col-12">
                                                <div class="membership_box">
                                                        <div class="image_box text-center d-flex justify-content-center align-items-center">
                                                                <a href="#single_digtal_sec" class="d-block"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/member1.png" alt=""></a>
                                                        </div>
                                                        <p class="font-36 text-center mt-md-4 my-sm-3 my-2 mb-sm-0">Activities Club</p>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-4 col-12">
                                                <div class="membership_box">
                                                        <div class="image_box text-center d-flex justify-content-center align-items-center">
                                                                <a href="#single_booklet_sec" class="d-block"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/member2.png" alt=""></a>
                                                        </div>
                                                        <p class="font-36 text-center mt-md-4 my-sm-3 my-2 mb-sm-0">Activities Club+</p>
                                                </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-4 col-12">
                                                <div class="membership_box">
                                                        <div class="image_box text-center d-flex justify-content-center align-items-center">
                                                                <a href="" class="d-block"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/member1.png" alt=""></a>
                                                        </div>
                                                        <p class="font-36 text-center mt-md-4 my-sm-3 my-2 mb-sm-0">Activities Box</p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </section>        
<?php 
        endif;
?>