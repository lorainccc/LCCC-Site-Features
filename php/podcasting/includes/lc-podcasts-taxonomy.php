<?php

if ( ! function_exists( 'lc_podcast_feeds' ) ) {

	// Register Custom Taxonomy
	function lc_podcast_feeds() {
	
		$labels = array(
			'name'                       => _x( 'LCCC Podcasts', 'Taxonomy General Name', 'lorainccc' ),
			'singular_name'              => _x( 'LCCC Podcast', 'Taxonomy Singular Name', 'lorainccc' ),
			'menu_name'                  => __( 'LCCC Podcast Feeds', 'lorainccc' ),
			'all_items'                  => __( 'All LCCC Podcast Items', 'lorainccc' ),
			'parent_item'                => __( 'LCCC Podcast Parent Item', 'lorainccc' ),
			'parent_item_colon'          => __( 'LCCC Podcast Parent Item:', 'lorainccc' ),
			'new_item_name'              => __( 'New LCCC Podcast', 'lorainccc' ),
			'add_new_item'               => __( 'Add New LCCC Podcast', 'lorainccc' ),
			'edit_item'                  => __( 'Edit LCCC Podcast', 'lorainccc' ),
			'update_item'                => __( 'Update LCCC Podcast', 'lorainccc' ),
			'view_item'                  => __( 'View LCCC Podcast', 'lorainccc' ),
			'separate_items_with_commas' => __( 'Separate LCCC Podcast with commas', 'lorainccc' ),
			'add_or_remove_items'        => __( 'Add or remove LCCC Podcast', 'lorainccc' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'lorainccc' ),
			'popular_items'              => __( 'Popular LCCC Podcast', 'lorainccc' ),
			'search_items'               => __( 'Search LCCC Podcast', 'lorainccc' ),
			'not_found'                  => __( 'Not Found', 'lorainccc' ),
			'no_terms'                   => __( 'No LCCC Podcasts', 'lorainccc' ),
			'items_list'                 => __( 'LCCC Podcast List', 'lorainccc' ),
			'items_list_navigation'      => __( 'LCCC Podcast list navigation', 'lorainccc' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'show_in_rest'               => true,
			'rewrite'					 => array( 'slug' => 'podcasts' ),
		);
		register_taxonomy( 'lcpodcasts', array( 'lccc_podcasts' ), $args );
	
	}
	add_action( 'init', 'lc_podcast_feeds', 0 );
	
	}

 /**
  * Register Term Meta for LCCC Podcasts
  */

  function lc_register_term_meta() {
	$podcastfeed_meta_fields = lc_get_meta_fields();

	foreach ( $podcastfeed_meta_fields as $field ) {
		register_meta(
			'term',
			$field['slug'],
			array(
				'sanitize_callback'	=> 'sanitize_my_meta_key',
				'type'				=> $field['type'],
				'description'		=> $field['title'],
				'single'			=> true,
				'show_in_rest'		=> false,
			)
		);
	}
}

add_action( 'init', 'lc_register_term_meta' );

/**
 * Add podcasting fields to the term screen.
 *
 * @param WP_Term $term The term object.
 */
function lc_add_podcasting_term_edit_meta_fields( $term ) {
	$podcasting_meta_fields = lc_get_meta_fields();
	?>
	<table class="form-table">
		<tbody><tr class="form-field term-name-wrap">
	<?php
	foreach ( $podcasting_meta_fields as $field ) {
		$value = get_term_meta( $term->term_id, $field['slug'], true );
		$value = $value ? $value : '';
		?>
		<tr class="form-field term-name-wrap">
			<th scope="row">
				<label
					for="name"
				><?php echo esc_html( $field['title'] ); ?></label>
			</th>
			<td>
				<?php lc_the_field( $field, $value, $term->term_id ); ?>
			</td>
		</tr>
		<?php
	}
	?>
	<tbody>
	</table>
		<tbody><tr class="form-field term-name-wrap">
	<?php
}

/**
 * Add podcasting nonce to the term screen.
 *
 * @param \WP_Term $term     The term object.
 * @param bool     $taxonomy Is this a taxonomy.
 */
function lc_add_podcasting_term_meta_nonce( $term, $taxonomy = false ) {
	echo '<style>
	.term-description-wrap{
		display: none;
	} </style>';

	wp_nonce_field( 'lcpodcasts_edit', 'lc_podcasts_nonce' );
	wp_enqueue_media();

	if ( $taxonomy ) {
		$url = get_term_feed_link( $term->term_id, 'lcpodcasts' );
		__( 'Your Podcast Feed:', 'ads-txt' );
		echo '<a href="' . esc_url( $url ) . '" target="_blank">' . esc_url( $url ) . '</a><br />';
		esc_html_e( 'This is the URL you submit to iTunes or podcasting service.', 'lorainccc' );
	}
}
add_action( 'lcpodcasts_add_form_fields', 'lc_add_podcasting_term_meta_nonce' );
add_action( 'lcpodcasts_edit_form_fields', 'lc_add_podcasting_term_meta_nonce', 99, 2 );

add_action( 'lcpodcasts_edit_form', 'lc_add_podcasting_term_edit_meta_fields' );
add_action( 'lcpodcasts_add_form_fields', 'lc_add_podcasting_term_add_meta_fields' );

/**
 * Save podcasting fields from the term screen to term meta.
 *
 * @param int $term_id The term is being saved.
 */
function lc_save_podcasting_term_meta( $term_id ) {
	$tax = get_taxonomy( 'lcpodcasts' );

	if ( ! current_user_can( $tax->cap->edit_terms ) ) {
		return;
	}

	if ( empty( $_POST['lc_podcasts_nonce'] ) || ! wp_verify_nonce( $_POST['lc_podcasts_nonce'], 'lcpodcasts_edit' ) ) {
		return;
	}

	$podcasting_meta_fields = lc_get_meta_fields();
	foreach ( $podcasting_meta_fields as $field ) {
		$slug = $field['slug'];

		if ( isset( $_POST[ $slug ] ) ) {
			$sanitized_value = sanitize_text_field( wp_unslash( $_POST[ $slug ] ) );

			// If the field is an image field, store the image URL along with the slug.
			if ( strpos( $slug, '_image' ) ) {
				$image_url = wp_get_attachment_url( (int) $sanitized_value );
				update_term_meta( $term_id, $slug . '_url', $image_url );
			}
			update_term_meta( $term_id, $slug, $sanitized_value );
		}
	}
}
add_action( 'edited_lcpodcasts', 'lc_save_podcasting_term_meta' );
add_action( 'created_lcpodcasts', 'lc_save_podcasting_term_meta' );

/**
 * Add a feed link to the podcasting term table.
 *
 * @param string $string      Blank string.
 * @param string $column_name Name of the column.
 * @param int    $term_id     Term ID.
 *
 * @return string
 */
function lc_add_podcasting_term_feed_link_column( $string, $column_name, $term_id ) {

	if ( 'feedurl' === $column_name ) {
		$url = get_term_feed_link( $term_id, 'lcpodcasts' );
		echo '<a href="' . esc_url( $url ) . '" target="_blank">' . esc_url( $url ) . '</a>';
	}
	return $string;
}
add_filter( 'manage_lcpodcasts_custom_column', 'lc_add_podcasting_term_feed_link_column', 10, 3 );

/**
 * Add a custom column for the podcast feed link.
 *
 * @param array $columns An array of columns
 *
 * @return array
 */
function lc_add_custom_term_columns( $columns ) {
	$columns['feedurl'] = 'Feed URL';
	unset( $columns['description'] );
	unset( $columns['author'] );
	return $columns;
}
add_filter( 'manage_edit-lcpodcasts_columns', 'lc_add_custom_term_columns', 99 );


/**
 * Display some help for next steps on the podcast taxonomy screen.
 */

function lc_add_podcasting_taxonomy_help_message() {
	echo '<div class="notice notice-info"><p>';
	esc_html_e( 'Once at least one podcast exists, you can add episodes by creating a post, assigning it to the appropriate podcast, and inserting an audio player or podcast block into the content of the post.  You can then submit the feed URL to podcast directories.  For more information please contact Lori Martin or Joe Querin.', 'lorainccc' );
	echo '</p></div>';
}
add_action( 'after-lcpodcasts-table', 'lc_add_podcasting_taxonomy_help_message' );

/**
 * Add fields to the add term screen.
 * 
 * @param \WP_Term $term The term object.
 */

function lc_add_podcasting_term_add_meta_fields( $term ) {
$lc_podcasting_meta_fields = lc_get_meta_fields();

	foreach ( $lc_podcasting_meta_fields as $field ) {
		?>
		<div class="form-field">
			<label for="name" ><?php echo esc_html( $field['title'] ); ?></label>
			<?php lc_the_field( $field, '' ); ?>
		</div>
		<?php
	}
}

/**
 * Generate and output a single field.
 *
 * @param  array   $field   The field data.
 * @param  string  $value   The existing field value.
 * @param  boolean $term_id The term id, or false for the new term form.
 */
function lc_the_field( $field, $value = '', $term_id = false ) {
	switch ( $field['type'] ) {
		case 'language':
			echo wp_kses(
				$field['data'],
				array(
					'select'   => array(
						'name' => array(),
						'id'   => array(),
					),
					'optgroup' => array(
						'label' => array(),
					),
					'option'   => array(
						'value'          => array(),
						'lang'           => array(),
						'data-installed' => array(),
						'selected'       => array(),
					),
				)
			);
			break;
		case 'textfield':
			?>
			<input
				name="<?php echo esc_attr( $field['slug'] ); ?>"
				id="<?php echo esc_attr( $field['slug'] ); ?>"
				type="text"
				value="<?php echo esc_attr( $value ); ?>"
				size="40"
			>
			<?php
			break;
		case 'textarea':
			?>
			<textarea name="<?php echo esc_attr( $field['slug'] ); ?>" id="<?php echo esc_attr( $field['slug'] ); ?>" rows="5" cols="40"><?php echo esc_textarea( $value ); ?></textarea>
			<?php
			break;
		case 'select':
			?>
			<select
				name="<?php echo esc_attr( $field['slug'] ); ?>"
				id="<?php echo esc_attr( $field['slug'] ); ?>"
				class="postform"
			>
			<?php
			$options = $field['options'];
			foreach ( $options as $key => $label ) {
				?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $value ); ?>>
					<?php echo esc_html( $label ); ?>
				</option>
				<?php
			}
			?>
			</select>
			<?php
			break;
		case 'image':
			$image_url = get_term_meta( $term_id, $field['slug'] . '_url', true );
			?>
			<div class="media-wrapper">
				<?php
				$has_image = ( '' === $value );
				?>
				<div class="podasting-existing-image <?php echo ( $has_image ? 'hidden' : '' ); ?>">
					<a href="#" >
						<img
						src="<?php echo esc_url( $image_url ); ?>"
						alt=""
						class="podcast-image-thumbnail"
					>
					</a>
					<input
						type="hidden"
						id="<?php echo esc_attr( $field['slug'] ); ?>"
						name="<?php echo esc_attr( $field['slug'] ); ?>"
						value="<?php echo esc_attr( $value ); ?>"
					>
					<br />
					<a href="#" class="podcast-media-remove" data-media-id="<?php echo esc_attr( $value ); ?>">
						remove image
					</a>
				</div>
				<div class="podcasting-upload-image <?php echo ( ! $has_image ? 'hidden' : '' ); ?>">
					<input
						type="button"
						class="podcasting-media-button button-secondary"
						id="image-<?php echo esc_attr( $field['slug'] ); ?>"
						value="<?php esc_attr_e( 'Select Image', 'simple-podcasting' ); ?>"
						data-slug="<?php echo esc_attr( $field['slug'] ); ?>"
						data-choose="<?php esc_attr_e( 'Podcast Image', 'simple-podcasting' ); ?>"
						data-update="<?php esc_attr_e( 'Choose Selected Image', 'simple-podcasting' ); ?>"
						data-preview-size="thumbnail"
						data-mime-type="image"
					>
				</div>
			</div>
			<?php
			break;

	}
	if ( isset( $field['description'] ) ) {
		?>
		<p class="description"><?php echo esc_html( $field['description'] ); ?></p>
		<?php
	}
}

/**
 * Returns array of Meta Fields
 */
function lc_get_meta_fields() {
	return array(
		array(
			'slug'				=> 'lc_podcasting_subtitle',
			'title'				=> __( 'Subtitle', 'lorainccc' ),
			'type'				=> 'textfield',
		),
		array(
			'slug'				=> 'lc_podcasting_talent_name',
			'title'				=> __( 'Artist / Author name', 'lorainccc' ),
			'type'				=> 'textfield',
		),
		array(
			'slug'				=> 'lc_podcasting_email',
			'title'				=> __( 'Podcast email', 'lorainccc' ),
			'type'				=> 'textfield',
		),
		array(
			'slug'				=> 'lc_podcasting_summary',
			'title'				=> __( 'Summary', 'lorainccc' ),
			'type'				=> 'textarea',
		),
		array(
			'slug'				=> 'lc_podcasting_copyright',
			'title'				=> __( 'Copyright / License Information', 'lorainccc' ),
			'type'				=> 'textfield',
		),
		array(
			'slug'				=> 'lc_podcasting_explicit',
			'title'				=> __( 'Mark as explicit', 'lorainccc' ),
			'type'				=> 'select',
			'options'			=> array(
				'No',
				'Yes',
				'Clean'
			),
		),
		array(
			'slug'				=> 'lc_podcasting_language',
			'title'				=> __( 'Language', 'lorainccc' ),
			'type'				=> 'language',
			'data'				=> lc_get_podcasting_lang_options(),
		),
		array(
			'slug'				=> 'lc_podcasting_image',
			'title'				=> __( 'Cover image', 'lorainccc' ),
			'type'				=> 'image',
			'description'		=> __( 'Minimum size: 1400px x 1400px - Maximum size: 2048px x 2048px', 'lorainccc' ),
		),
		array(
			'slug'				=> 'lc_podcasting_keywords',
			'title'				=> __( 'Keywords', 'lorainccc' ),
			'type'				=> 'textfield',
			'description'		=> __( 'Comma-separated keywords to help people find your podcast', 'lorainccc' ),
		),
		array(
			'slug'				=> 'lc_podcasting_category_1',
			'title'				=> __( 'Category 1', 'lorainccc' ),
			'type'				=> 'select',
			'options'			=> lc_get_podcasting_categories_options(),
		),		
		array(
			'slug'				=> 'lc_podcasting_category_2',
			'title'				=> __( 'Category 2', 'lorainccc' ),
			'type'				=> 'select',
			'options'			=> lc_get_podcasting_categories_options(),
		),
		array(
			'slug'				=> 'lc_podcasting_category_3',
			'title'				=> __( 'Category 3', 'lorainccc' ),
			'type'				=> 'select',
			'options'			=> lc_get_podcasting_categories_options(),
		),
	);
}

/**
 * Get array of podcasting categories.
 *
 * Podcasting category names are not translated because they need to be provided in English.
 *
 * @return array Array of podcasting categories.
 */
function lc_get_podcasting_categories() {
	return array(
		'arts' => array(
			'name' => 'Arts',
			'subcategories' => array(
				'design'          => 'Design',
				'fashion-beauty'  => 'Fashion & Beauty',
				'food'            => 'Food',
				'literature'      => 'Literature',
				'performing-arts' => 'Performing Arts',
				'visual-arts'     => 'Visual Arts',
			),
		),
		'business' => array(
			'name' => 'Business',
			'subcategories' => array(
				'business-news'        => 'Business News',
				'careers'              => 'Careers',
				'investing'            => 'Investing',
				'management-marketing' => 'Management & Marketing',
				'shopping'             => 'Shopping',
			),
		),
		'comedy' => array(
			'name' => 'Comedy',
		),
		'education' => array(
			'name' => 'Education',
			'subcategories' => array(
				'educational-technology' => 'Educational Technology',
				'higher-education'       => 'Higher Education',
				'k-12'                   => 'K-12',
				'language-courses'       => 'Language Courses',
				'training'               => 'Training',
			),
		),
		'games-hobbies' => array(
			'name' => 'Games & Hobbies',
			'subcategories' => array(
				'automotive'  => 'Automotive',
				'aviation'    => 'Aviation',
				'hobbies'     => 'Hobbies',
				'other-games' => 'Other Games',
				'video-games' => 'Video Games',
			),
		),
		'government-organizations' => array(
			'name' => 'Government & Organizations',
			'subcategories' => array(
				'local'      => 'Local',
				'national'   => 'National',
				'non-profit' => 'Non-Profit',
				'regional'   => 'Regional',
			),
		),
		'health' => array(
			'name' => 'Health',
			'subcategories' => array(
				'alternative-health' => 'Alternative Health',
				'fitness-nutrition'  => 'Fitness & Nutrition',
				'self-help'          => 'Self-Help',
				'sexuality'          => 'Sexuality',
			),
		),
		'kids-family' => array(
			'name' => 'Kids & Family',
		),
		'music' => array(
			'name' => 'Music',
		),
		'news-politics' => array(
			'name' => 'News & Politics',
		),
		'religion-spirituality' => array(
			'name' => 'Religion & Spirituality',
			'subcategories' => array(
				'buddhism'     => 'Buddhism',
				'christianity' => 'Christianity',
				'hinduism'     => 'Hinduism',
				'islam'        => 'Islam',
				'judaism'      => 'Judaism',
				'other'        => 'Other',
				'spirituality' => 'Spirituality',
			),
		),
		'science-medicine' => array(
			'name' => 'Science & Medicine',
			'subcategories' => array(
				'medicine'         => 'Medicine',
				'natural-sciences' => 'Natural Sciences',
				'social-sciences'  => 'Social Sciences',
			),
		),
		'society-culture' => array(
			'name' => 'Society & Culture',
			'subcategories' => array(
				'history'           => 'History',
				'personal-journals' => 'Personal Journals',
				'philosophy'        => 'Philosophy',
				'places-travel'     => 'Places & Travel',
			),
		),
		'sports-recreation' => array(
			'name' => 'Sports & Recreation',
			'subcategories' => array(
				'amateur'             => 'Amateur',
				'college-high-school' => 'College & High School',
				'outdoor'             => 'Outdoor',
				'professional'        => 'Professional',
			),
		),
		'technology' => array(
			'name' => 'Technology',
			'subcategories' => array(
				'gadgets'         => 'Gadgets',
				'tech-news'       => 'Tech News',
				'podcasting'      => 'Podcasting',
				'software-how-to' => 'Software How-To',
			),
		),
		'tv-film' => array(
			'name' => 'TV & Film',
		),
	);
}

/**
 * Transform podcasting categories into dropdown options
 */
function lc_get_podcasting_categories_options() {
	$to_return  = array( '' => __( 'None' ) );
	$categories = lc_get_podcasting_categories();

	foreach ( $categories as $key => $category ) {
		$to_return[ $key ] = $category['name'];

		if ( ! empty( $category['subcategories'] ) ) {
			foreach ( $category['subcategories'] as $subkey => $subcategory ) {
				$to_return[ "$key:$subkey" ] = '&mdash; ' . $subcategory;
			}
		}
	}

	return $to_return;
}

/**
 * Return the list of available languages.
 *
 * @see wp_dropdown_languages()
 *
 * @return string
 */
function lc_get_podcasting_lang_options() {
	$lang = '';
	if ( is_admin() ) {
		global $tag_ID; // WPCS: @codingStandardsIgnoreLine - we can't control WP global names.
		// Are we on the term edit screen?
		$term_id = $tag_ID; // WPCS: @codingStandardsIgnoreLine - we can't control WP global names.
		if ( $term_id ) {
			$lang = get_term_meta( $term_id, 'podcasting_language', true );
		}
	}
	return wp_dropdown_languages(
		array(
			'echo'     => false,
			'name'     => 'podcasting_language',
			'selected' => $lang,
		)
	);
}