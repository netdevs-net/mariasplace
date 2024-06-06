<?php

/**
 * Template name: Signup Lock
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
<title><?php echo esc_html(get_the_title($_GET["post"])); ?></title>
<?php get_header(); ?>

<div id="primary" class="content-area signup-lock">
	<main id="main" class="site-main">
		<div class="page has-text-centered">
            <section class="signup-section">
                <h1><?php echo get_the_title($_GET["post"]); ?></h1>
                <div class="signup-section-inner">
                    <div class="members-only">
                        <img src="/wp-content/uploads/2023/09/Group-7811.png" class="lfloating">
                        <img src="/wp-content/uploads/2023/09/Group-7812.png" class="rfloating">
                        <div class="lock-icon">
                            <div class="lock-icon-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="65" viewBox="0 0 48 65" fill="none">
                                    <path d="M41.6784 47.2249H36.3557V18.1407C36.3557 11.2992 30.8125 5.72271 23.9886 5.72271C17.1646 5.72271 11.6215 11.2887 11.6215 18.1407V47.2249H6.31982V18.1407C6.31982 8.35811 14.2461 0.388672 23.9991 0.388672C33.7521 0.388672 41.6784 8.35811 41.6784 18.1407V47.2249Z" fill="#210B04"/>
                                    <path d="M41.7315 27.4805H6.26802C2.89932 27.4805 0.168457 30.2226 0.168457 33.6051V58.8628C0.168457 62.2453 2.89932 64.9874 6.26802 64.9874H41.7315C45.1002 64.9874 47.8311 62.2453 47.8311 58.8628V33.6051C47.8311 30.2226 45.1002 27.4805 41.7315 27.4805Z" fill="#210B04"/>
                                </svg>
                            </div>
                            <div class="radial-gradient">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1089" height="185" viewBox="0 0 1089 185" fill="none">
                                    <path d="M0.766602 0.226562H1088.95V184.325H0.766602V0.226562Z" fill="url(#paint0_radial_9150_26226)"/>
                                    <defs>
                                        <radialGradient id="paint0_radial_9150_26226" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(544.072 93.6421) rotate(89.5338) scale(96.4616 410.46)">
                                            <stop offset="0.458333" stop-color="white"/>
                                            <stop offset="1" stop-color="white" stop-opacity="0"/>
                                        </radialGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="form-content">
                            <p class="form-top-title"><?php the_field('register_top_title'); ?></p>
                            <p class="form-title"><?php the_field('register_title'); ?></p>
                            <div class="form-content-desc">
                                <?php the_field('register_description'); ?>
                            </div>
                            <p class="register-text">
                                Register via
                            </p>
                            <div class="signup-options-container">
                                <div class="google-fb-option">
                                    <span class="recommended">Recommended</span>
                                    <?php echo do_shortcode( '[parth_register_sc]' ); ?>
                                </div>
                                <p class="or-text">or</p>
                                <div class="email-option">
                                    <p class="register-with-email">Register with Email</p>
                                    <a class="button is-primary" href="/registration">
                                        Register Now
                                    </a>
                                    <p class="login-here">Already have an account? <a href="/login">Login here.</a></p>
                                </div>
                            </div>
                            <div class="privacy-policy">
                                <?php the_field('privacy_text'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="bg-image">

                <div class="rectangle-radial"></div>

				<section class="free-library section">
					<div class="container">
						<div class="columns">
							<?php
							$browse = get_field('free_library_content');
							if ($browse) : ?>
								<div class="column is-half free-library-img">
									<div class="browser-header-mobile free-library-cont">
										<?php echo  $browse['browse_header']; ?>
                                        <span><?php echo  $browse['browse_text']; ?></span>
									</div>
									<img alt="<?php echo get_the_title($image_id);?>" src="<?php echo $browse['browse_image']; ?>">
								</div>
								<div class="column is-half free-library-cont">
									<?php echo  $browse['browse_header']; ?>
									<span><?php echo  $browse['browse_text']; ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</section>

				<section class="activities section">
					<div class="container">
                        <div class="activities-title">
                            <div class="activities-title-wrapper">
                                <?php the_field('activities_header'); ?>
                                <span><?php the_field('activities_text'); ?></span>
                            </div>
                        </div>
						<div class="columns act-wrapper">
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

                <section class="quote-section">
                    <p class="quote-text">
                        <?php the_field('quote_text'); ?>
                    </p>
                    <p class="quoter"><?php the_field('quoter_name'); ?></p>
                </section>   
                
                <section class="testimonial-section">
                    <div class="container">
						<div class="columns">
								<div class="column is-half">
                                    <p class="testimonial-title">
                                        <?php the_field('testimonial_title'); ?>
                                    </p>
                                </div>
                                <div class="column is-half">
                                    <div class="testimonial-content">
                                        <?php the_field('testimonial_content'); ?>
                                    </div>
                                    <p class="testimonial-user">
                                        <?php the_field('testimonial_name'); ?>
                                    </p>
                                </div>
                        </div>
                    </div>
                </section>
                
            </div>

            <section class="cta-section">
                <p class="cta-top-title"><?php the_field('cta_top_title'); ?></p>
                <p class="cta-title"><?php the_field('cta_title'); ?></p>
                <p class="cta-description"><?php the_field('cta_desc'); ?></p>
                <a href="/registration" class="cta-btn button is-secondary"> Join Now</a>
            </section>

            <div class="purplewave">
            </div>

        </div>
    </main>
</div>

<?php get_footer(); ?>