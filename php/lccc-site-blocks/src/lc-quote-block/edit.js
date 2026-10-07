/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps,	RichText, BlockControls, AlignmentToolbar, InspectorControls, } from '@wordpress/block-editor';
import { PanelBody,	RangeControl, ColorPalette, } from '@wordpress/components';

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
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { quoteText, citation, textAlign, borderColor, borderWidth } = attributes;

	const blockProps = useBlockProps( {
		style: {
			borderLeftColor: borderColor,
			borderLeftWidth: borderWidth + 'px',
			borderLeftStyle: 'solid',
			textAlign: textAlign,
		},
	} );

	return (
		<>
			<BlockControls>
				<AlignmentToolbar
					value={ textAlign }
					onChange={ ( value ) => setAttributes( { textAlign: value } ) }
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody title={ __( 'Border Settings', 'lorainccc' ) }>
					<RangeControl
						label={ __( 'Border Width', 'lorainccc' ) }
						value={ borderWidth }
						onChange={ ( value ) => setAttributes( { borderWith: value } ) }
						min={ 0 }
						max={ 12 }
					/>
					<p style={ { marginBottom: '8px' } }>
						{ __( 'Border Color', 'lorainccc' ) }
					</p>
					<ColorPalette 
						value={ borderColor }
						onChange={ ( value ) => setAttributes( { borderColor: value || '#0055a5' } ) }
					/>
				</PanelBody>
			</InspectorControls>
		<blockquote { ...blockProps }>
			<RichText
				tagName="p"
				className="lc-stories-quote"
				value={ quoteText }
				onChange={ ( value ) => setAttributes( { quoteText: value } ) }
				placeholder={ __( 'Write the quote…', 'lorainccc' ) }
			/>
			<RichText
				tagName="cite"
				className="lc-stories-quote-author"
				value={ citation }
				onChange={ ( value ) => setAttributes( { citation: value } ) }
				placeholder={ __( '— Author Name', 'lorainccc' ) }
			/>
		</blockquote>
		</>
	);
}
