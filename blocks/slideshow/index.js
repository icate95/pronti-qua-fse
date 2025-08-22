(function() {
	'use strict';

	// Verifica dependencies WordPress
	if (!wp || !wp.blocks || !wp.element || !wp.components || !wp.blockEditor) {
		console.error('WordPress dependencies missing');
		return;
	}

	const { registerBlockType } = wp.blocks;
	const { __ } = wp.i18n || (str => str);
	const {
		useBlockProps,
		InspectorControls,
		MediaUpload,
		MediaUploadCheck
	} = wp.blockEditor;
	const {
		PanelBody,
		TextControl,
		TextareaControl,
		ToggleControl,
		RangeControl,
		Button,
		SelectControl,
		Flex,
		FlexItem
	} = wp.components;
	const { useState, createElement: el } = wp.element;

	const COLOR_OPTIONS = [
		{ label: 'Verde Primario', value: 'verde-primario' },
		{ label: 'Azzurro Secondario', value: 'azzurro-secondario' },
		{ label: 'Rosa Accento', value: 'rosa-accento' },
		{ label: 'Giallo Highlight', value: 'giallo-highlight' }
	];

	// Default slides
	const getDefaultSlides = () => [
		{
			title: 'La nostra storia',
			content: 'In memoria di Roberto e della sua determinazione',
			backgroundColor: 'verde-primario',
			imageId: null,
			imageUrl: '',
			imageAlt: ''
		},
		{
			title: 'Supporto psicologico',
			content: 'Specialisti dedicati per pazienti e famiglie',
			backgroundColor: 'rosa-accento',
			imageId: null,
			imageUrl: '',
			imageAlt: ''
		},
		{
			title: 'Onde di Speranza',
			content: 'Raccolta fondi per strumentazione medica',
			backgroundColor: 'azzurro-secondario',
			imageId: null,
			imageUrl: '',
			imageAlt: ''
		},
		{
			title: 'BussoLà',
			content: 'Rete territoriale per l\'assistenza oncologica',
			backgroundColor: 'giallo-highlight',
			imageId: null,
			imageUrl: '',
			imageAlt: ''
		}
	];

	registerBlockType('pronti-qua/slideshow', {
		title: 'Slideshow Pronti Qua',
		icon: 'slides',
		category: 'pronti-qua',
		description: 'Slideshow personalizzabile per l\'associazione',
		keywords: ['slideshow', 'slider', 'carousel'],

		attributes: {
			slides: {
				type: 'array',
				default: getDefaultSlides()
			},
			height: {
				type: 'number',
				default: 400
			},
			autoplay: {
				type: 'boolean',
				default: true
			},
			interval: {
				type: 'number',
				default: 4000
			},
			showIndicators: {
				type: 'boolean',
				default: true
			}
		},

		edit: function(props) {
			const { attributes, setAttributes } = props;
			const { slides, height, autoplay, interval, showIndicators } = attributes;
			const [currentSlide, setCurrentSlide] = useState(0);

			// Safe block props
			const blockProps = useBlockProps({
				className: 'pronti-qua-slideshow-editor',
				style: {
					border: '2px dashed #e2e8f0',
					borderRadius: '8px',
					padding: '20px',
					backgroundColor: '#f8fafc'
				}
			});

			// Ensure slides is always an array
			const validSlides = Array.isArray(slides) && slides.length > 0 ? slides : getDefaultSlides();

			// Update slide function
			const updateSlide = (index, field, value) => {
				const newSlides = [...validSlides];
				if (newSlides[index]) {
					newSlides[index] = {
						...newSlides[index],
						[field]: value
					};
					setAttributes({ slides: newSlides });
				}
			};

			// Add slide function
			const addSlide = () => {
				const newSlides = [...validSlides, {
					title: 'Nuova Slide',
					content: 'Contenuto della nuova slide',
					backgroundColor: 'verde-primario',
					imageId: null,
					imageUrl: '',
					imageAlt: ''
				}];
				setAttributes({ slides: newSlides });
				setCurrentSlide(newSlides.length - 1);
			};

			// Remove slide function
			const removeSlide = (index) => {
				if (validSlides.length > 1 && validSlides[index]) {
					const newSlides = validSlides.filter((_, i) => i !== index);
					setAttributes({ slides: newSlides });
					setCurrentSlide(Math.min(currentSlide, newSlides.length - 1));
				}
			};

			// Safe current slide
			const safeCurrentSlide = Math.min(currentSlide, validSlides.length - 1);
			const currentSlideData = validSlides[safeCurrentSlide];

			return el('div', blockProps,

				// Inspector Controls
				el(InspectorControls, null,
					el(PanelBody, {
							title: 'Impostazioni Slideshow',
							initialOpen: true
						},
						el(RangeControl, {
							label: 'Altezza (px)',
							value: height,
							onChange: (value) => setAttributes({ height: value }),
							min: 200,
							max: 800,
							step: 50
						}),

						el(ToggleControl, {
							label: 'Riproduzione automatica',
							checked: autoplay,
							onChange: (value) => setAttributes({ autoplay: value }),
							help: 'Le slide cambieranno automaticamente'
						}),

						autoplay && el(RangeControl, {
							label: 'Intervallo (millisecondi)',
							value: interval,
							onChange: (value) => setAttributes({ interval: value }),
							min: 1000,
							max: 10000,
							step: 500,
							help: 'Tempo tra le slide in autoplay'
						}),

						el(ToggleControl, {
							label: 'Mostra indicatori',
							checked: showIndicators,
							onChange: (value) => setAttributes({ showIndicators: value }),
							help: 'Punti di navigazione in basso'
						})
					),

					el(PanelBody, {
							title: 'Gestione Slide',
							initialOpen: false
						},
						el('p', { style: { marginBottom: '10px' } },
							el('strong', null, `Slide totali: ${validSlides.length}`)
						),

						el(Button, {
							isPrimary: true,
							onClick: addSlide,
							style: { width: '100%', marginBottom: '10px' }
						}, '+ Aggiungi Slide')
					)
				),

				// Preview Area
				el('div', {
						className: 'slideshow-preview',
						style: {
							height: height + 'px',
							position: 'relative',
							border: '2px solid #e0e0e0',
							borderRadius: '8px',
							overflow: 'hidden',
							backgroundColor: '#fff',
							marginBottom: '20px'
						}
					},
					// Slide Navigation Tabs
					el('div', {
							className: 'slide-navigation',
							style: {
								display: 'flex',
								gap: '5px',
								padding: '10px',
								backgroundColor: 'rgba(255,255,255,0.95)',
								borderBottom: '1px solid #e0e0e0',
								flexWrap: 'wrap'
							}
						},
						validSlides.map((slide, index) =>
							el(Button, {
								key: index,
								variant: safeCurrentSlide === index ? 'primary' : 'secondary',
								onClick: () => setCurrentSlide(index),
								style: {
									padding: '6px 12px',
									fontSize: '12px',
									minHeight: '32px'
								}
							}, `${index + 1}`)
						)
					),

					// Current Slide Display
					currentSlideData && el('div', {
							style: {
								position: 'absolute',
								top: '50px',
								left: 0,
								right: 0,
								bottom: 0,
								display: 'flex',
								alignItems: 'center',
								justifyContent: 'center',
								background: currentSlideData.imageUrl
									? `linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url(${currentSlideData.imageUrl})`
									: `linear-gradient(135deg, var(--wp--preset--color--${currentSlideData.backgroundColor}, #6f8a2b), var(--wp--preset--color--${currentSlideData.backgroundColor}, #6f8a2b)90)`,
								backgroundSize: 'cover',
								backgroundPosition: 'center',
								color: currentSlideData.imageUrl ? 'white' : '#333'
							}
						},
						el('div', {
								style: {
									textAlign: 'center',
									padding: '2rem',
									maxWidth: '90%',
									backgroundColor: currentSlideData.imageUrl ? 'rgba(0,0,0,0.3)' : 'transparent',
									borderRadius: currentSlideData.imageUrl ? '8px' : '0'
								}
							},
							el('h4', {
								style: {
									margin: '0 0 1rem',
									fontSize: '1.5rem',
									fontWeight: '600',
									textShadow: currentSlideData.imageUrl ? '2px 2px 4px rgba(0,0,0,0.8)' : 'none'
								}
							}, currentSlideData.title || 'Titolo Slide'),
							el('p', {
								style: {
									margin: '0',
									fontSize: '1rem',
									lineHeight: '1.5',
									textShadow: currentSlideData.imageUrl ? '1px 1px 2px rgba(0,0,0,0.8)' : 'none'
								}
							}, currentSlideData.content || 'Contenuto della slide')
						)
					),

					// Indicators Preview
					showIndicators && validSlides.length > 1 && el('div', {
							style: {
								position: 'absolute',
								bottom: '16px',
								left: '50%',
								transform: 'translateX(-50%)',
								display: 'flex',
								gap: '8px'
							}
						},
						validSlides.map((_, index) =>
							el('div', {
								key: index,
								style: {
									width: '12px',
									height: '12px',
									borderRadius: '50%',
									backgroundColor: index === safeCurrentSlide ? '#6f8a2b' : 'rgba(255,255,255,0.5)',
									cursor: 'pointer',
									border: '2px solid rgba(255,255,255,0.8)',
									transition: 'all 0.3s ease'
								},
								onClick: () => setCurrentSlide(index)
							})
						)
					)
				),

				// Slide Editor
				currentSlideData && el('div', {
						className: 'slide-editor',
						style: {
							padding: '20px',
							border: '1px solid #e0e0e0',
							borderRadius: '8px',
							backgroundColor: '#fff'
						}
					},
					el('h4', {
						style: {
							margin: '0 0 20px 0',
							fontSize: '16px',
							fontWeight: '600',
							color: '#1f2937',
							borderBottom: '1px solid #e5e7eb',
							paddingBottom: '10px'
						}
					}, `Modifica Slide ${safeCurrentSlide + 1} di ${validSlides.length}`),

					// Title input
					el(TextControl, {
						label: 'Titolo',
						value: currentSlideData.title || '',
						onChange: (value) => updateSlide(safeCurrentSlide, 'title', value),
						placeholder: 'Inserisci il titolo della slide'
					}),

					// Content input
					el(TextareaControl, {
						label: 'Contenuto',
						value: currentSlideData.content || '',
						onChange: (value) => updateSlide(safeCurrentSlide, 'content', value),
						rows: 3,
						placeholder: 'Inserisci il contenuto della slide'
					}),

					// Image upload
					el('div', {
							style: { marginBottom: '20px' }
						},
						el('label', {
							style: {
								display: 'block',
								marginBottom: '8px',
								fontWeight: '600',
								fontSize: '14px'
							}
						}, 'Immagine di sfondo'),

						el(MediaUploadCheck, null,
							el(MediaUpload, {
								onSelect: (media) => {
									updateSlide(safeCurrentSlide, 'imageId', media.id);
									updateSlide(safeCurrentSlide, 'imageUrl', media.url);
									updateSlide(safeCurrentSlide, 'imageAlt', media.alt || '');
								},
								allowedTypes: ['image'],
								value: currentSlideData.imageId,
								render: ({ open }) => el('div', null,
									currentSlideData.imageUrl && el('div', {
											style: { marginBottom: '10px' }
										},
										el('img', {
											src: currentSlideData.imageUrl,
											alt: currentSlideData.imageAlt || '',
											style: {
												maxWidth: '200px',
												height: 'auto',
												borderRadius: '4px',
												border: '1px solid #e0e0e0'
											}
										})
									),

									el(Flex, { gap: 2, style: { marginTop: '10px' } },
										el(Button, {
											onClick: open,
											variant: 'secondary'
										}, currentSlideData.imageUrl ? 'Cambia Immagine' : 'Seleziona Immagine'),

										currentSlideData.imageUrl && el(Button, {
											onClick: () => {
												updateSlide(safeCurrentSlide, 'imageId', null);
												updateSlide(safeCurrentSlide, 'imageUrl', '');
												updateSlide(safeCurrentSlide, 'imageAlt', '');
											},
											variant: 'secondary',
											isDestructive: true
										}, 'Rimuovi')
									)
								)
							})
						)
					),

					// Background color
					el(SelectControl, {
						label: 'Colore di sfondo',
						value: currentSlideData.backgroundColor || 'verde-primario',
						options: COLOR_OPTIONS,
						onChange: (value) => updateSlide(safeCurrentSlide, 'backgroundColor', value),
						help: 'Usato quando non c\'è immagine di sfondo'
					}),

					// Slide actions
					el('div', {
							style: {
								marginTop: '20px',
								paddingTop: '20px',
								borderTop: '1px solid #e5e7eb',
								display: 'flex',
								justifyContent: 'space-between',
								alignItems: 'center'
							}
						},
						el('div', {
							style: { fontSize: '14px', color: '#6b7280' }
						}, `Slide ${safeCurrentSlide + 1} di ${validSlides.length}`),

						validSlides.length > 1 && el(Button, {
							onClick: () => removeSlide(safeCurrentSlide),
							variant: 'secondary',
							isDestructive: true,
							style: { marginLeft: '10px' }
						}, 'Elimina Slide')
					)
				)
			);
		},

		save: function() {
			// Dynamic rendering tramite PHP
			return null;
		}
	});

})();