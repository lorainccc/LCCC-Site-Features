
/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Block props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Function to update attributes.
 * @param {Object}   props.context       Block context.
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes, context } ) {
	const { label, layout, showCount, separator } = attributes;
	const blockProps = useBlockProps();

	const postId = context?.postId || useSelect( ( select ) => {
		return select( 'core/editor' )?.getCurrentPostId?.();
	}, [] );

	const postType = context?.postType || useSelect( ( select ) => {
		return select( 'core/editor' )?.getCurrentPostType?.();
	}, [] );

	const [ categories ] = useEntityProp( 'postType', postType, 'categories', postId );

	const categoryObjects = useSelect(
		( select ) => {
			if ( ! categories || categories.length === 0 ) {
				return [];
			}
			const { getEntityRecords } = select( 'core' );
			return getEntityRecords( 'taxonomy', 'category', {
				include: categories,
				per_page: categories.length,
				context: 'view',
			} ) || [];
		},
		[ categories ]
	);

	const isLoading = categories && categories.length > 0 && categoryObjects.length === 0;

	const renderCategories = () => {
		if ( isLoading ) {
			return (
				<span className="wp-block-lc-post-categories__loading">
					{ __( 'Loading categories…', 'lc-post-categories' ) }
				</span>
			);
		}

		if ( ! categoryObjects || categoryObjects.length === 0 ) {
			return (
				<span className="wp-block-lc-post-categories__empty">
					{ __( 'No categories assigned.', 'lc-post-categories' ) }
				</span>
			);
		}

		if ( layout === 'list' ) {
			return (
				<ul className="wp-block-lc-post-categories__list">
					{ categoryObjects.map( ( cat ) => (
						<li key={ cat.id } className="wp-block-lc-post-categories__item">
							<a href={ cat.link } onClick={ ( e ) => e.preventDefault() }>
								{ cat.name }
								{ showCount && (
									<span className="wp-block-lc-post-categories__count">
										({ cat.count })
									</span>
								) }
							</a>
						</li>
					) ) }
				</ul>
			);
		}

		return (
			<span className="wp-block-lc-post-categories__inline">
				{ categoryObjects.map( ( cat, index ) => (
					<span key={ cat.id }>
						<a href={ cat.link } onClick={ ( e ) => e.preventDefault() }>
							{ cat.name }
							{ showCount && (
								<span className="wp-block-lc-post-categories__count">
									({ cat.count })
								</span>
							) }
						</a>
						{ index < categoryObjects.length - 1 && (
							<span className="wp-block-lc-post-categories__separator">
								{ separator }
							</span>
						) }
					</span>
				) ) }
			</span>
		);
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Display Settings', 'lc-post-categories' ) }>
					<TextControl
						label={ __( 'Label', 'lc-post-categories' ) }
						help={ __( 'Text displayed before the category list. Leave empty for no label.', 'lorainccc' ) }
						value={ label }
						onChange={ ( value ) => setAttributes( { label: value } ) }
					/>
					<SelectControl
						label={ __( 'Layout', 'lc-post-categories' ) }
						value={ layout }
						options={ [
							{ label: __( 'Inline', 'lc-post-categories' ), value: 'inline' },
							{ label: __( 'List', 'lc-post-categories' ), value: 'list' },
						] }
						onChange={ ( value ) => setAttributes( { layout: value } ) }
					/>
					{ layout === 'inline' && (
						<TextControl
							label={ __( 'Separator', 'lc-post-categories' ) }
							help={ __( 'Character(s) used between category names in inline layout.', 'lorainccc' ) }
							value={ separator }
							onChange={ ( value ) => setAttributes( { separator: value } ) }
						/>
					) }
					<ToggleControl
						label={ __( 'Show post count', 'lc-post-categories' ) }
						help={ __( 'Display the number of posts in each category.', 'lorainccc' ) }
						checked={ showCount }
						onChange={ ( value ) => setAttributes( { showCount: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				{ label && (
					<span className="wp-block-lc-post-categories__label">
						{ label }{ ' ' }
					</span>
				) }
				{ renderCategories() }
			</div>
		</>
	);
}
