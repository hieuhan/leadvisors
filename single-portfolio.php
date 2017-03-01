<?php get_header(); ?> 

<div class='visible-phone' id='page-title'><?php _e('Portfolio','leadvisors'); ?></div>

<section id='case-study'>

	<div class='container'>

		<div class='row-fluid'>

			<a class='span6 case-study-logo-link'>

				<img alt='' class='case-study-logo' src='<?php if(has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

			</a>

			<div class='span6 case-study-title'>

				<h1><?php the_title() ?></h1>
				
				<strong><?php _e('Location:','leadvisors');?></strong>

				<?php echo get_post_meta( $post->ID, '_headquarters', true ); ?><br />

				<strong><?php _e('Region:','leadvisors');?></strong>

				<?php echo get_post_meta( $post->ID, '_regions', true ); ?><br />

				<strong><?php _e('Sector:','leadvisors');?></strong>

				<?php echo get_post_meta( $post->ID, '_sector', true ); ?><br />

				<a class='case-study-visit' href='<?php echo get_post_meta( $post->ID, '_website_url', true ); ?>' target='_blank'><?php _e('Visit Site','leadvisors'); ?></a>

			</div>

		</div>

		<div class='row-fluid'>

			<div class='span12'>

				<p>

					<p><?php echo apply_filters( 'the_content', $post->post_content ); ?></p>

				</p>

			</div>

		</div>



		<div class='row-fluid pad-bottom-50 no-pad-bottom-mobile'>        <div class='span12'>

		</div>

	</div>

	<div class='row-fluid'>

		<div class='span6 shrink-right hidden-phone'>

		</div>

		<?php 

		$People_Relationship_Portfolio = new WP_Query( array(

			'connected_type' => 'People_Relationship_Portfolio',

			'connected_items' => get_queried_object(),

			'nopaging' => false,

			) );


			if ( $People_Relationship_Portfolio->have_posts() ) { ?>

			<div class='span6 shrink-left'>

				<h2 class='pad-bottom-20'><span class="nowrap"><?php _e('General Atlantic','leadvisors');?></span> <?php _e('Board Members','leadvisors');?></h2>

				<div class='row-fluid border-top'>

					<?php $count_portfolio = 1;

					while ( $People_Relationship_Portfolio->have_posts() ) 

					{ 

						$People_Relationship_Portfolio->the_post(); ?>

						<a class='span4 case-study-board-member' href='<?php the_permalink(); ?>'>

							<img alt='' src='<?php if(has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

							<div class='case-study-board-member-title'>

								<div class='vertical-table'>

									<div class='vertical-middle'>

										<?php the_title() ?>

										<div class='visible-phone'><?php echo get_post_meta( $post->ID, '_chevron', true ); ?></div>

									</div>

								</div>

							</div>

						</a>

						<?php } ?>

					</div>

				</div>

				<?php } ?>

				<hr class='visible-phone pad-top-30 pad-bottom-20'>

				<div class='span6 visible-phone'>

				</div>

			</div>

		</div>

	</section>





	<?php get_footer(); ?>