<?php

// Check for WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
	if ( is_cart() || is_checkout() || is_account_page() ) {
		return;
	}
}

$slider_columns 	= (int)ashe_options( 'featured_slider_columns' );
$slider_autoplay 	= (int)ashe_options( 'featured_slider_autoplay' );
$slider_navigation 	= ashe_options( 'featured_slider_navigation' );
$slider_pagination 	= ashe_options( 'featured_slider_pagination' );
$slider_desktop  	= 3;
$slider_tablet  	= 2;

if ( $slider_columns === 1 ) {
	$slider_desktop	= 1;
	$slider_tablet 	= 1;
}

if ( $slider_columns === 2 ) {
	$slider_desktop  = 2;
}

$slider_data = '{';

	$slider_data .= '"slidesToShow": '.$slider_columns;

	if ( $slider_autoplay > 0 ) {
		$slider_data .= ', "autoplay": true, "autoplaySpeed": '. $slider_autoplay;
	}

	if ( !$slider_navigation ) {
		$slider_data .= ', "arrows": false';
	} 

	if ( $slider_pagination ) {
		$slider_data .= ', "dots": true';
	}

	if ( $slider_columns === 1 ) {
	  	$slider_data .= ', "fade": true';
	}


	$slider_data .= ', "responsive": [{"breakpoint":1250,"settings":{"slidesToShow": '.$slider_desktop.'}},{"breakpoint":980,"settings":{"slidesToShow": '.$slider_tablet.'}},{"breakpoint":769,"settings":{"slidesToShow": 1}}]';

$slider_data .= '}';

?>

<!-- Wrap Slider Area -->
<div class="featured-slider-area<?php echo ashe_options( 'general_slider_width' ) === 'boxed' ? ' boxed-wrapper': ''; ?>">

<!-- Featured Slider -->
<div id="featured-slider" class="<?php echo ashe_options( 'general_slider_width' ) === 'boxed' ? 'boxed-wrapper': ''; ?>" data-slider-columns="<?php echo esc_attr( $slider_columns ); ?>" data-slick="<?php echo esc_attr( $slider_data ); ?>">
	
	<?php
	
	$slider_repeater_encoded = get_theme_mod( 'featured_slider_repeater', json_encode( array(
		array(
			'image_url' => '',
			'title' => 'Slide 1 Title',
			'text' => 'Slide 1 Description. Some lorem ipsum dolor sit amet text',
			'link' => '',
			'btn_text' => 'Button 1',
	         'checkbox' => '0',
			'id' => 'customizer_repeater_56d7ea7f40a1'
		),
		array(
			'image_url' => '',
			'title' => 'Slide 2 Title',
			'text' => 'Slide 2 Description. Some lorem ipsum dolor sit amet text',
			'link' => '',
			'btn_text' => 'Button 2',
	         'checkbox' => '0',
			'id' => 'customizer_repeater_56d7ea7f40a2'
		),
		array(
			'image_url' => '',
			'title' => 'Slide 3 Title',
			'text' => 'Slide 3 Description. Some lorem ipsum dolor sit amet text',
			'link' => '',
			'btn_text' => 'Button 3',
	         'checkbox' => '0',
			'id' => 'customizer_repeater_56d7ea7f40a3'
		),
	) ) );

	$slider_repeater = json_decode( $slider_repeater_encoded );
	
	// Loop Start
	foreach( $slider_repeater as $repeater_item ) : ?>

	<div class="slider-item">

		<?php if ( $slider_columns === 1 ) : ?>
			<div class="slider-item-bg" style="background-image:url( <?php echo wp_get_attachment_image_src( $repeater_item->image_url, 'full' )[0]; ?>);"></div>
		<?php else : ?>
			<img src="<?php  echo wp_get_attachment_image_src( $repeater_item->image_url, 'ashe-slider-grid-thumbnail' )[0]; ?>" alt="">
		<?php endif; ?>

		<div class="cv-container image-overlay">
			<div class="cv-outer">
				<div class="cv-inner">
					<div class="slider-info">

						<?php

						$target = '1' === $repeater_item->checkbox ? '_blank' : '_self';

						if ( $repeater_item->btn_text === '' && $repeater_item->link !== '' ) {
							echo '<a class="slider-image-link" href="'. esc_url( $repeater_item->link ) .'" target="'. $target .'"></a>';
						}

						?>

						<?php if( $repeater_item->title !== '' ) : ?>
							<?php if ( $repeater_item->link !== '' ) : ?>
								<h2 class="slider-title">
									<a href="<?php echo esc_url( $repeater_item->link ); ?>"><?php echo $repeater_item->title; ?></a>	
								</h2>
							<?php else: ?>
								<h2 class="slider-title"><?php echo $repeater_item->title; ?></h2>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( $repeater_item->text !== '' ): ?>							
						<div class="slider-content"><?php echo $repeater_item->text; ?></div>
						<?php endif; ?>

						<?php if ( $repeater_item->btn_text !== '' ) : ?>
						<div class="slider-read-more">
							<a href="<?php echo esc_url( $repeater_item->link ); ?>" target="<?php echo $target; ?>"><?php echo $repeater_item->btn_text; ?></a>
						</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>

	</div>

	<?php endforeach; // Loop end ?>

</div><!-- #featured-slider -->

</div><!-- .featured-slider-area -->