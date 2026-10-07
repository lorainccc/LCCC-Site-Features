<?php
/**
 * Render callback for the Post Categories Block.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 */

$lc_post_categories_post_id = isset( $block->context['postId'] )
	? absint( $block->context['postId'] )
	: get_the_ID();

if ( ! $lc_post_categories_post_id ) {
	return;
}

$lc_post_categories_categories = get_the_category( $lc_post_categories_post_id );

$lc_post_categories_label      = isset( $attributes['label'] ) ? sanitize_text_field( $attributes['label'] ) : '';
$lc_post_categories_layout     = isset( $attributes['layout'] ) ? sanitize_text_field( $attributes['layout'] ) : 'list';
$lc_post_categories_show_count = ! empty( $attributes['showCount'] );
$lc_post_categories_separator  = isset( $attributes['separator'] ) ? sanitize_text_field( $attributes['separator'] ) : ', ';

$lc_post_categories_wrapper_attributes = get_block_wrapper_attributes();
?>
<div <?php echo $lc_post_categories_wrapper_attributes; ?>>
	<?php if ( $lc_post_categories_label ) : ?>
		<span class="wp-block-lc-post-categories__label"><?php echo esc_html( $lc_post_categories_label ); ?> </span>
	<?php endif; ?>

	<?php if ( empty( $lc_post_categories_categories ) || is_wp_error( $lc_post_categories_categories ) ) : ?>
		<span class="wp-block-lc-post-categories__empty">
			<?php esc_html_e( 'No categories assigned.', 'telex-post-categories' ); ?>
		</span>
	<?php elseif ( 'list' === $lc_post_categories_layout ) : ?>
		<ul class="wp-block-lc-post-categories__list">
			<?php foreach ( $lc_post_categories_categories as $lc_post_categories_cat ) : ?>
				<li class="wp-block-lc-post-categories__item">
					<a href="<?php echo esc_url( get_category_link( $lc_post_categories_cat->term_id ) ); ?>">
						<?php echo esc_html( $lc_post_categories_cat->name ); ?>
						<?php if ( $lc_post_categories_show_count ) : ?>
							<span class="wp-block-lc-post-categories__count">(<?php echo absint( $lc_post_categories_cat->count ); ?>)</span>
						<?php endif; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<span class="wp-block-lc-post-categories__inline">
			<?php
			$lc_post_categories_total = count( $lc_post_categories_categories );
			foreach ( $lc_post_categories_categories as $lc_post_categories_index => $lc_post_categories_cat ) :
				?>
				<span>
					<a href="<?php echo esc_url( get_category_link( $lc_post_categories_cat->term_id ) ); ?>">
						<?php echo esc_html( $lc_post_categories_cat->name ); ?>
						<?php if ( $lc_post_categories_show_count ) : ?>
							<span class="wp-block-lc-post-categories__count">(<?php echo absint( $lc_post_categories_cat->count ); ?>)</span>
						<?php endif; ?>
					</a>
					<?php if ( $lc_post_categories_index < $lc_post_categories_total - 1 ) : ?>
						<span class="wp-block-lc-post-categories__separator"><?php echo esc_html( $lc_post_categories_separator ); ?></span>
					<?php endif; ?>
				</span>
			<?php endforeach; ?>
		</span>
	<?php endif; ?>
</div>
