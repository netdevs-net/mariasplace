<?php

/**
 * Template name: Splash
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Scops_UX
 */
?>
<?php get_header(); ?>
<div id="primary" class="content-area landing">
	<main id="main" class="site-main">
		<div class="page has-text-centered">
			<div class="bg-image">
				<section class="free-library section">
					<div class="container">
						<div class="columns">
							<?php
							$browse = get_field('free_library_content');
							if ($browse) : ?>
								<div class="column is-half free-library-img">
									<div class="browser-header-mobile free-library-cont">
										<?php echo  $browse['browse_header']; ?>
									</div>
									<img alt="<?php echo get_the_title($image_id);?>" src="<?php echo $browse['browse_image']; ?>">
								</div>
								<div class="column is-half free-library-cont">
									<?php echo  $browse['browse_header']; ?>
									<span><?php echo  $browse['browse_text']; ?></span>
									<div class="buttons is-justify-content-center">
										<a class="button outline-btn is-primary" href="<?php echo  $browse['learn_more_button']; ?>">
											<?php echo  $browse['learn_more_text']; ?>
										</a>
							
										<a class="button is-primary sign-up" href="<?php echo  $browse['sign_up_button']; ?>">
											<?php echo  $browse['sign_up_text']; ?>
										</a>
										
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</section>



				<section class="activities section">
					<div class="container">
						<div class="columns act-wrapper">
							<div class="column activities-title is-3">
								<div class="activities-title-wrapper">
									<?php the_field('activities_header'); ?>
									<span><?php the_field('activities_text'); ?></span>
								</div>
							</div>
							<div class="column is-9">
								<div class="columns is-multiline">
									<?php if (have_rows('activities_row')) : ?>
										<?php while (have_rows('activities_row')) : the_row(); 
											$class=str_replace(' ', '-', strtolower(get_sub_field('activity_title')));
										?>
											<div class="column is-4 is-6-mobile">
												<a href="<?php print the_sub_field('activity_link') ?>">											
												<div class="activity <?php print(str_replace(' ', '-', strtolower(get_sub_field('activity_title')))); ?>">
													<div class="activity-title-img">
														<img alt="<?php the_sub_field('activity_title'); ?>" src="<?php the_sub_field('activity_icon'); ?>">
														<span><?php the_sub_field('activity_title'); ?></span>
													</div>
													<p><?php the_sub_field('activity_description'); ?></p>
												</div>
												</a>
											</div>
											<style>
												<?php echo '.'.$class ?> {
													border-color: <?php the_sub_field('border_color') ?> !important;
												}
												<?php echo '.'.$class.':hover' ?> {
													background: <?php the_sub_field('activity_background_color') ?> !important;
												}
											</style>
										<?php endwhile; ?>
									<?php endif; ?>	
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- <section class="bulk-order-splash">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
							<img src="/wp-content/uploads/2023/03/sunshine_box_bulk.svg" class="vc_single_image-img attachment-full" alt="Sunshine Box Bulk" decoding="async" title="sunshine_box_bulk">
							</div>
							<div class="col-md-6">
							<div class="wpb_wrapper">
								<p class="vc_custom_heading section-sub-title d-none d-md-block">We do</p>
								<h1 class="vc_custom_heading section-main-title d-none d-md-block mb-3">Bulk<br>Orders</h1>
							<div class="mb-3">
								<p class="section-content">For organizations, agencies, and communities who want to provide our offerings to their clients, residents, and members. We collaborate to create custom activity gift boxes that drive clients to specific outcomes relevant to the organization’s goals and objectives.</p>
							</div>
							<div class="button-bulk">
								<a class="button is-primary sign-up section-button" target="_blank" href="/bulk-orders/" title="Learn More">Learn More</a>
							</div>
							</div>
						</div>
					</div>
				</div>
				</section> -->
				<!-- <section class="cinco-home">
                <div class="container">
                        <div class="row">
                                <div class="col-sm-12 col-md-6 offset-md-6 col-lg-7 offset-lg-5">
                                        <div class="cinco-banner__content">
                                                <?php //if(get_field("pre_banner_image")): ?>
                                                    <img src="/wp-content/uploads/2023/03/Logo.svg" class="cinco-pre-banner" alt="Maria's Place">
                                                <?php //endif; ?>
                                                <?php //if(get_field("banner_image")): ?>
                                                    <img src="/wp-content/themes/MariasPlace/inc/assets/images/CD-happy-cinco.svg" class="cinco-content-image" alt="Cinco De Mayo">
                                                <?php //endif; ?>
												<h3>Feliz Cinco De Mayo</h3>
						<a class="button is-secondary sign-up" href="/product/cinco-de-mayo/">Actividades en Español</a>
                                        </div>                                        
                                </div>
                        </div>
                </div>
        		</section> -->
				<!-- 
				<section class="christmas-act section">
					<div class="container">
						<div class="columns">
							<div class="column is-6 is-offset-6 is-12-mobile ca-content">
								<img alt="image" src="<?= get_template_directory_uri() ."/inc/assets/images/Mask-group-svg.png"; ?>" class="rbbg">
								<div class="ca-header">
									<?= get_field("ca_heading") ?>
								</div>
								<div class="ca-desc">
									<p>
										<?= get_field("ca_content") ?> 										
									</p>
									<a href="<?= get_field("ca_button")["url"] ?>" class="splash-cta-btn button is-secondary"><?= get_field("ca_button")["title"] ?></a>									
								</div>
							</div>
						</div>
					</div>
				</section> -->
<!-- 
				<section class="maria-place section">
					<div class="container">
						<div class="columns">
							<div class="column is-6 maria-place-content">
								<?php $mp = get_field('marias_place_content') ?>
								<h2><?php echo $mp["maria_title"] ?></h2>
								<span><?php echo $mp["maria_text"] ?></span>
								<div class="buttons">
									<div class="buttons	 is-justify-content-center">
										<a class="button is-primary is-inverted learn-more" href="<?php echo $mp["website_tour_button"]["url"] ?>">
											<?php echo $mp["website_tour_button"]["title"] ?>
										</a>
										<a class="button is-primary sign-up" href="<?php echo $mp["sign_up_button"]["url"] ?>">
											<?php echo $mp["sign_up_button"]["title"] ?>
										</a>
									</div>
								</div>
							</div>
							<div class="column is-6">
								<img alt="image" src="<?php echo $mp['right_image'] ?>">
							</div>
						</div>
					</div>
				</section> -->

				<section class="award-winning section">
					<div class="container">
						<div class="columns">
							<div class="column">
								<div class="award-winning-title">
									<span><?php the_field("pre_heading") ?></span>
									<h2><?php the_field("heading") ?></h2>
								</div>
								<div class="columns">
									<div class="column is-half award-winning-img">
										<img alt="<?php the_field("left_image") ?>" src="<?php the_field("left_image") ?>">
									</div>
									<div class="column is-half award-winning-text">
										<?php the_field("right_content") ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<div class="splash-cta section" id="splash-cta">
					<div class="container">
						<div class="columns">
							<div class="column">
								<a href="<?php echo get_field("link")["url"] ?>" class="splash-cta-btn button is-secondary"> <?php echo get_field("link")["title"] ?></a>
							</div>
						</div>
					</div>
				</div>


			</div>
			<section class="last-section" style="padding:5rem 0 16rem 0;">
				<h3><?php the_field("recommended_text") ?></h3>
				<a href="https://naap.info/" target="_blank"><img alt="<?php the_field("recommended_image") ?>" style="width:420px;max-width:100%;padding-left:3rem;padding-right:3rem;" src="<?php the_field("recommended_image") ?>"></a>
			</section>
			<!--  -->
			<!-- <section>
				<h3><?php //echo get_field["recommended_text"];?></h3>
				<img src="<?php //echo get_field["recommended_image"]; ?>" style="max-width:300px;"/>
			</section> -->

		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>