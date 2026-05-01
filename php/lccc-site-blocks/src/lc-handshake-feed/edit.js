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
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { Panel, PanelBody, SelectControl, TextControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
//import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { lcHandshakeFeedUrl, lcNumberOfItems, lcHandshakeFeedName } = attributes;

	function onChangeFeedURL( newValue ){
		setAttributes( { lcHandshakeFeedUrl: newValue } );
	}

	function onChangeNumberOfItems( newValue ){
		setAttributes( { lcNumberOfItems: newValue } );
	}

	function onChangeFeedName( newValue ){
		setAttributes( { lcHandshakeFeedName: newValue } );
	}

	return (
		<>
		<InspectorControls>
			<PanelBody title={ __( 'Settings', 'lccc-site-blocks' ) }>
				<TextControl
					__nextHasNoMarginBottom
					__next40pxDefaultSize
					label={ __(
						'Handshake Feed URL',
						'lccc-site-blocks'
					) }
					value={ lcHandshakeFeedUrl || '' }
					onChange={ onChangeFeedURL }
				/>
				<SelectControl
					__nextHasNoMarginBottom
					label="Number of Items"
					value={ lcNumberOfItems }
					options={ [
						{value: '0', label: '-- Please Select --' },
						{value: '5', label: '5' },
						{value: '10', label: '10' },
						{value: '15', label: '15' },
					] }
					onChange={ onChangeNumberOfItems }
				/>
				<TextControl
					__nextHasNoMarginBottom
					__next40pxDefaultSize
					label={ __(
						'Handshake Feed Name',
						'lccc-site-blocks'
					) }
					value={ lcHandshakeFeedName || '' }
					onChange={ onChangeFeedName }
				/>
			</PanelBody>
		</InspectorControls>
			<div { ...useBlockProps() }>
				{ __('Handshake Feed Block', 'lccc-site-blocks')	}
			</div>
		</>
	);
}
