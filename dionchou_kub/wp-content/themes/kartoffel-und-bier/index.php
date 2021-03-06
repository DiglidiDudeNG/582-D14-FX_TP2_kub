<?php
/**
 * index.php
 * Project: kartoffel-und-bier
 * User:    Félix Dion Robidoux
 * Date:    02/12/2014
 * Time:    7:59 PM
 */

get_header();

?>
	<!--INDEX.PHP-->
	<main role="main">
		<div class="container">
			<div id="masonery" class="row">
				<div class="box-sizer col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
				<?php
				$args = array(
					'post_type' => 'product',
					'meta_query' => array(
						'relation' => 'OR',
						array( // Simple products type
							'key' => '_sale_price',
							'value' => 0,
							'compare' => '>',
							'type' => 'numeric'
						),
						array( // Variable products type
							'key' => '_min_variation_sale_price',
							'value' => 0,
							'compare' => '>',
							'type' => 'numeric'
						)
					)
				);
				$onsale = new WP_Query( $args );

				if($onsale->have_posts()) {

				?>
				<div class="box full">
					<div id="myCarousel" class="carousel slide" data-interval="true">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php
							$active = true;
							for($count = 0 ; $count < $onsale->post_count; $count++) {
								?>
								<li data-target="#myCarousel" data-slide-to="<?=$count?>"<?=$active ? ' class="active"' : ''?>></li>
								<?php
								$active = false;
							}
							?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<?php
							$active = true;
							while($onsale->have_posts()) {

								$onsale->the_post();
								?>

								<div class="product-content item<?= $active ? ' active' : ''?>">
									<div class="row">
									<div class="onsale">Promo!</div>
									<a href="<?=$product->get_permalink();?>">
										<div class="cos-xs-12 col-sm-6 col-md-6 col-lg-6">
											<div class="thumbnail">
											<?=woocommerce_get_product_thumbnail('shop_single');?>
											</div>
										</div>
										<div class="infos col-xs-12 col-sm-6 col-md-6 col-lg-6">
											<?php the_title( '<h2>', '</h2>' ); ?>
											<div class="price clearfix"><?=$product->get_price_html();?></div>
											<div class="row">
												<div class="col-xs-10">
													<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
												</div>
											</div>
										</div>
									</a>
									</div>
								</div>
								<?php
								$active = false;
							}
							?>
						</div>
						<!-- Controls -->
						<a class="left carousel-control fui-arrow-left" href="#myCarousel" data-slide="prev"></a>
						<a class="right carousel-control fui-arrow-right" href="#myCarousel" data-slide="next"></a>
					</div>
				</div>
				<?php
				}

				$args = array(
					'post_type' => 'accueil',
				);
				$home_posts = new WP_Query( $args );


				if ( $home_posts->have_posts()){

					while($home_posts->have_posts()){

						$home_posts->the_post();

				?>
				<div class="box <?=get_post_meta( $id, '_kub_dispwidth', true );?> <?= implode(' ',get_post_class()); ?>">
					<article class="clearfix">
						<?php the_post_thumbnail();?>
						<header>
							<h2><?php the_title(); ?></h2>
							<time datetime="<?php echo get_the_date('Y-m-d')?>"><?php echo get_the_date(get_option('date_format'))?></time>
						</header>
						<?php the_content(); ?>
						<footer>
						</footer>
					</article>
				</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</main>
<?php
get_footer();
?>