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
import { PanelBody, TextControl, SelectControl, Spinner, Notice } from '@wordpress/components';

import { useState, useEffect, useCallback } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';

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
 * @param {Object}		props				Block props.
 * @param {Object}		props.attributes	Block attributes.
 * @param {Function}	props.setAttributes	Function to update attributes.
 * 
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { lcHandshakeFeedUrl, lcNumberOfItems, lcHandshakeFeedName, lcFeedCategory } = attributes;
	const blockProps = useBlockProps();

	const [ feedItems, setFeedItems ] = useState( [] );
	const [ isLoading, setIsLoading ] = useState( false );
	const [ error, setError ] = useState( '' );

	const fetchFeed = useCallback( () => {
		if( ! lcHandshakeFeedUrl ) {
			setFeedItems( [] );
			setError( '' );
			return;
		}

		setIsLoading( true );
		setError( '' );

		apiFetch( {
			path: addQueryArgs( '/lc-handshake-feed/v1/fetch' {
				feed_url: lcHandshakeFeedUrl,
				number_of_items: lcNumberOfItems,
			} ),
		})
			.then( ( items ) => {
				setFeedItems( items );
				setIsLoading( false );
			})
			.catch( () => {
				setError(
					__( 
						'Unable to fetch feed. Please check the URL, and try again.',
						'lorainccc'
					)
				);
				setFeedItems( [] );
				setIsLoading( false );
			} );
		}, [lcHandshakeFeedUrl, lcNumberOfItems]);
	useEffect( () => {
		const timer = setTimeout( () => {
			fetchFeed();
		}, 800 );

		return () => clearTimeout( timer );
	}, [ fetchFeed ] );		

	/**
	 * Returns a category-specific CSS class suffix.
	 * 
	 * @param {string}	category	The feed category
	 * @return {string}	CSS	modifier class
	 */

	const lc_getCategoryClass = ( lc_category ) => {
		switch ( lc_category ) {
			case 'jobs':
				return 'lc-handshake-feed--jobs';
			case 'fairs':
				return 'lc-handshake-feed--fairs';
			case 'events':
			default:
				return 'lc-handshaked-feed--events';
		}
	};

	const categoryClass = getCategoryClass( lcFeedCategory );

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Feed Settings', 'lorainccc' ) }
					initialOpen={ true }
				>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Feed URL', 'lorainccc' ) }
						help={ __( 
							'Enter the Handshake RSS Feed URL.',
							'lorainccc'
						) }
						value={ lcHandshakeFeedUrl }
						onChange={ ( value ) =>
							setAttributes( { lcHandshakeFeedUrl: value } )
						 }
						 type="url"
					/>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Feed Label', 'lorainccc' ) }
						help={ __( 
							'A heading displayed above the feed content.',
							'lorainccc'
						) }
						value={ lcHandshakeFeedName }
						onChange={ ( value ) =>
							setAttributes( { lcHandshakeFeedName: value } )
						 }
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 
							'Number of Items',
							'lorainccc'
						) }
						value={ lcNumberOfItems }
						options={ [ 
							{ label: '5', value: 5 },
							{ label: '10', value: 10 },
							{ label: '15', value: 15 },
						] }
						onChange={ ( value ) =>
							setAttributes( { 
								lcNumberOfItems: parseInt( value, 10 ),
							} )
						}
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 
							'Feed Category',
							'lorainccc'
						) }
						help={ __( 
							'Controls the display format of the feed items.',
							'lorainccc
						) }
						value={ lcFeedCategory }
						options={ [ 
							{
								label: __( 'Events', 'lorainccc' ),
								value: 'events',
							},
														{
								label: __( 'Jobs', 'lorainccc' ),
								value: 'jobs',
							},
							{
								label: __( 'Fairs', 'lorainccc' ),
								value: 'fairs',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { lcFeedCategory: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>	

			<div { ...blockProps }>
				<div className={ 'lc-handshake-feed'}>
					{ lcHandshakeFeedName && (
						<h2 className="lc-handshake-feed__label">
							{ lcHandshakeFeedName }
						</h2>
					) }

					{ ! lcHandshakeFeedUrl && (
						<p className="lc-handshake-feed__placeholder">
							{ __( 
								'Enter a Handshake RSS Feed URL in the block settings to display items.',
								'lorainccc'
							)}
						</p>
					) }

					{ isLoading && (
						<div className="lc-handshake-feed__loading">
							<Spinner />
							<span>
								{ __(
									'Loading Feed...',
									'lorainccc'
								) }
							</span>
						</div>
					) }

					{ error && (
						<Notice status="error" isDismissible={ false }>'
							{ error }
						</Notice>
					) }

					{ ! isLoading && 
						! error && 
						feedItems.length > 0 && 
						feedItems.map( ( item, index ) => (
							<div
								key={ index }
								className="lc-handshake-feed-item"
							>
								<h3 className="lc-handshake-feed-item__title">
									<a
										href={ item.link }
										target="_blank"
										rel="noopener noreferrer"
									>
										{ item.title }
									</a>
								</h3>
								<div
									className="lc-handshake-feed-item__description"
									dangerouslySetInnerHTML={ { 
										__html: item.description,
									} }
								/>
							</div>
						) ) }

					{ ! isLoading && 
						! error && 
						lcHandshakeFeedUrl &&
						feedItems.length === 0 && (
							<p className="lc-handshake-feed__empty">
								{ __( 
									'No items found in this feed.',
									'lorainccc'
								) }
							</p>
						) }
				</div>
			</div>
		</>
	);
}