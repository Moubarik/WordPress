<?php
if (!defined('ABSPATH'))
	exit; // Exit if accessed directly
/**
 * Template Product Categories
 *
 * Access original fields: $args['mod_settings']
 */
global $woocommerce_loop;

$fields_default = array(
	'mod_title' => '',
	'child_of' => 0,
	'columns' => 4,
	'orderby' => 'name',
	'order' => 'ASC',
	'exclude' => '',
	'number' => '',
	'hide_empty' => 'yes',
	'pad_counts' => 'yes',
	'cat_desc' => 'no',
	'display' => 'products',
	'latest_products' => 0,
	'subcategories_number' => '',
	'animation_effect' => '',
	'css_products' => '',
);
$fields_args = wp_parse_args($args['mod_settings'], $fields_default);
unset($args['mod_settings']);
$hide_empty = $fields_args['hide_empty'] === 'yes';

// get terms and workaround WP bug with parents/pad counts
$query_args = array(
	'orderby' => $fields_args['orderby'],
	'order' => $fields_args['order'],
	'hide_empty' => $hide_empty,
	'pad_counts' => true,
	'number' => $fields_args['number'],
);
if (0 != $fields_args['child_of']) {
	$query_args['child_of'] = $fields_args['child_of'];
} elseif ('top-level' === $fields_args['child_of']) {
	$query_args['parent'] = 0; /* show only top-level terms */
}

if ( ! empty( $fields_args['exclude'] ) ) {
	$query_args['exclude'] = $fields_args['exclude'];
}

// check if we have to query the slug, instead of ID
// keep option to query by ID, for backward compatibility
if ('top-level' !== $fields_args['child_of'] && preg_match('/\D/', $fields_args['child_of'])) {
	$term = get_term_by('slug', $fields_args['child_of'], 'product_cat');
	if ( ! is_wp_error( $term ) && isset( $term->term_id ) ) {
		$fields_args['child_of'] = $query_args['child_of'] = $term->term_id;
	}
}

$product_categories = get_terms('product_cat', $query_args);

if (empty($product_categories) && 'top-level' !== $fields_args['child_of'] && 0 != $fields_args['child_of']) {
	$query_args['child_of'] = false;
	$query_args['term_taxonomy_id'] = $fields_args['child_of'];
	$product_categories = get_terms('product_cat', $query_args);
}

if ($hide_empty===true) {
	foreach ($product_categories as $key => $category) {
		if ($category->count == 0) {
			unset($product_categories[$key]);
		}
	}
}
/* backward compatibility to handle how Latest Products option worked */
if ( $fields_args['display'] === 'products' && $fields_args['latest_products'] == 0 ) {
	$fields_args['display'] = 'none';
}

$container_class = apply_filters('themify_builder_module_classes', array(
	'module', 'module-' . $args['mod_name'], $args['module_ID'], $fields_args['css_products'], self::parse_animation_effect($fields_args['animation_effect'], $fields_args), 'shows_' . $fields_args['display']
	), $args['mod_name'], $args['module_ID'], $fields_args);
if(isset($args['element_id'])){
    $container_class[] = 'tb_'.$args['element_id'];
}
if(!empty($fields_args['global_styles']) && Themify_Builder::$frontedit_active===false){
    $container_class[] = $fields_args['global_styles'];
}
$container_props = apply_filters( 'themify_builder_module_container_props', array(
	'id' => $args['module_ID'],
	'class' => implode(' ', $container_class),
), $fields_args, $args['mod_name'], $args['module_ID'] );

$woocommerce_loop['columns'] = $fields_args['columns'];
?>
<!-- module product categories -->
<div <?php echo self::get_element_attributes(self::sticky_element_props($container_props,$fields_args)); ?>>
	<?php $container_props=$container_class=null;?>
	<?php if ($fields_args['mod_title'] !== ''): ?>
		<?php echo $fields_args['before_title'] . apply_filters('themify_builder_module_title', $fields_args['mod_title'], $args) . $fields_args['after_title']; ?>
	<?php endif; ?>

	<?php do_action('themify_builder_before_template_content_render'); ?>
	<div class="woocommerce columns-<?php echo $fields_args['columns']; ?>">
		<?php
		// Reset loop/columns globals when starting a new loop
		$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';
		if (!empty($product_categories)):
			// Store column count for displaying the grid
			if (empty($woocommerce_loop['columns'])) {
				$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);
			}
			?>
			<ul class="products">
				<?php foreach ( $product_categories as $category ) : ?>
					<?php
					// Increase loop count 
					++$woocommerce_loop['loop'];
					?>
					<li class="product-category product<?php
					if ((( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] === 0) || $woocommerce_loop['columns'] === 1)
						echo ' first';
					if ($woocommerce_loop['loop'] % $woocommerce_loop['columns'] === 0)
						echo ' last';
					?>">

						<?php woocommerce_template_loop_category_link_open($category); ?>
						<?php woocommerce_subcategory_thumbnail($category); ?>
						<?php woocommerce_template_loop_category_link_close(); ?>
						<?php
						if ( $fields_args['display'] === 'products' ) {
							$query = get_posts(array('post_type' => 'product', 'posts_per_page' => $fields_args['latest_products'], 'product_cat' => $category->slug));
							if (!empty($query)) :
								?>
								<div class="product-thumbs">
									<?php foreach ($query as $product) : ?>
										<div class="post">
											<a href="<?php echo get_permalink($product->ID); ?>">
												<?php echo get_the_post_thumbnail($product->ID, 'shop_catalog'); ?>
											</a>
										</div>
									<?php endforeach; ?>
								</div>
								<?php
							endif;
						}
						?>
						<?php woocommerce_template_loop_category_link_open($category); ?>
						<h3>
							<?php
							echo $category->name;

							if ('yes' === $fields_args['pad_counts'] && $category->count > 0)
								echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category);
							?>
						</h3>
						<?php woocommerce_template_loop_category_link_close(); ?>

						<?php if ( $fields_args['display'] === 'subcategories' ) {
							$sub_categories = get_terms( 'product_cat', array(
								'orderby' => $fields_args['orderby'],
								'order' => $fields_args['order'],
								'hide_empty' => $hide_empty,
								'pad_counts' => true,
								'number' => $fields_args['subcategories_number'],
								'parent' => $category->term_id,
							) );
							if ( ! empty( $sub_categories ) ) : ?>
								<ul>
									<?php foreach ( $sub_categories as $sub_category ) : ?>
										<li>
											<?php woocommerce_template_loop_category_link_open( $sub_category ); ?>
												<?php echo $sub_category->name;
													if ( 'yes' === $fields_args['pad_counts'] && $sub_category->count > 0 )
														echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . $sub_category->count . ')</mark>', $sub_category);
												?>
											<?php woocommerce_template_loop_category_link_close(); ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						<?php } ?>
                        <?php if ('yes' === $fields_args['cat_desc'] && $category->description != ''): ?>
                            <div><?php echo esc_attr($category->description); ?></div>
                        <?php endif ?>

					</li>
					<?php
				endforeach;
				?>
			</ul>
		<?php endif; ?>
		<?php woocommerce_reset_loop(); ?>
	</div>
	<?php do_action('themify_builder_after_template_content_render'); ?>
</div>
<!-- module product categories -->
