/**
 * Slideshow Block Ultra-Semplificato - Solo Immagini
 * Sostituisce il contenuto di blocks/slideshow/index.js
 */

(function() {
	'use strict';

	// Verifica disponibilità WordPress
	if (!wp || !wp.blocks || !wp.element) {
		console.warn('WordPress components non disponibili');
		return;
	}

	const { registerBlockType } = wp.blocks;
	const { createElement: el, useState, useEffect } = wp.element;
	const { InspectorControls } = wp.blockEditor || {};
	const { PanelBody, RangeControl, ToggleControl } = wp.components || {};

	// Slide predefinite con percorsi corretti .jpeg
	const DEFAULT_SLIDES = [
		{
			imageUrl: '/prontiqua/wp-content/themes/pronti-qua-fse/assets/img/slide-volontari.jpeg',
			backgroundColor: 'verde-primario'
		},
		{
			imageUrl: '/prontiqua/wp-content/themes/pronti-qua-fse/assets/img/slide-supporto.jpeg',
			backgroundColor: 'azzurro-secondario'
		},
		{
			imageUrl: '/prontiqua/wp-content/themes/pronti-qua-fse/assets/img/slide-mercatini.jpeg',
			backgroundColor: 'rosa-accento'
		},
		{
			imageUrl: '/prontiqua/wp-content/themes/pronti-qua-fse/assets/img/slide-medici.jpeg',
			backgroundColor: 'giallo-highlight'
		},
		{
			imageUrl: '/prontiqua/wp-content/themes/pronti-qua-fse/assets/img/slide-crav.jpeg',
			backgroundColor: 'verde-primario'
		}
	];

	registerBlockType('pronti-qua/slideshow', {
		title: 'Slideshow Pronti Qua',
		icon: 'slides',
		category: 'pronti-qua',
		description: 'Slideshow automatico - Solo immagini',

		attributes: {
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
			const { height, autoplay, interval, showIndicators } = attributes;
			const [currentSlide, setCurrentSlide] = useState(0);

			// Auto-advance delle slide (più veloce nell'editor)
			useEffect(() => {
				if (autoplay && DEFAULT_SLIDES.length > 1) {
					const timer = setInterval(() => {
						setCurrentSlide(prev => (prev + 1) % DEFAULT_SLIDES.length);
					}, 2500); // 2.5 secondi per l'editor
					return () => clearInterval(timer);
				}
			}, [autoplay]);

			const currentSlideData = DEFAULT_SLIDES[currentSlide];

			return el('div', {
					style: {
						border: '2px solid #6f8a2b',
						borderRadius: '8px',
						overflow: 'hidden',
						position: 'relative'
					}
				},
				// Inspector Controls
				InspectorControls && el(InspectorControls, null,
					el(PanelBody, {
							title: '⚙️ Impostazioni Slideshow'
						},
						el(RangeControl, {
							label: 'Altezza (px)',
							value: height,
							onChange: (value) => setAttributes({ height: value }),
							min: 250,
							max: 600,
							step: 25
						}),

						el(ToggleControl, {
							label: 'Autoplay attivo',
							checked: autoplay,
							onChange: (value) => setAttributes({ autoplay: value })
						}),

						autoplay && el(RangeControl, {
							label: 'Intervallo (millisecondi)',
							value: interval,
							onChange: (value) => setAttributes({ interval: value }),
							min: 2000,
							max: 8000,
							step: 500
						}),

						el(ToggleControl, {
							label: 'Mostra indicatori',
							checked: showIndicators,
							onChange: (value) => setAttributes({ showIndicators: value })
						})
					)
				),

				// Preview del slideshow - SOLO IMMAGINI
				el('div', {
						className: 'slideshow-preview',
						style: {
							position: 'relative',
							height: height + 'px',
							backgroundColor: '#f1f5f9',
							backgroundImage: currentSlideData.imageUrl ? `url(${currentSlideData.imageUrl})` : 'none',
							backgroundSize: 'cover',
							backgroundPosition: 'center',
							backgroundRepeat: 'no-repeat',
							transition: 'all 0.8s ease'
						}
					},

					// Indicatori
					showIndicators && DEFAULT_SLIDES.length > 1 && el('div', {
							className: 'slideshow-indicators',
							style: {
								position: 'absolute',
								bottom: '20px',
								left: '50%',
								transform: 'translateX(-50%)',
								display: 'flex',
								gap: '8px',
								zIndex: 10
							}
						},
						DEFAULT_SLIDES.map((_, index) =>
							el('button', {
								key: index,
								className: index === currentSlide ? 'indicator active' : 'indicator',
								onClick: () => setCurrentSlide(index),
								style: {
									width: '12px',
									height: '12px',
									background: index === currentSlide ? 'white' : 'rgba(255,255,255,0.4)',
									borderRadius: '50%',
									cursor: 'pointer',
									transition: 'all 0.3s ease',
									border: 'none',
									padding: 0,
									transform: index === currentSlide ? 'scale(1.2)' : 'scale(1)'
								}
							})
						)
					),

					// Badge editor (piccolo e discreto)
					el('div', {
						style: {
							position: 'absolute',
							top: '10px',
							right: '10px',
							background: 'rgba(111, 138, 43, 0.85)',
							color: 'white',
							padding: '4px 8px',
							borderRadius: '4px',
							fontSize: '10px',
							fontWeight: '600',
							zIndex: 15
						}
					}, 'PREVIEW')
				)
			);
		},

		save: function() {
			// Rendering dinamico via PHP
			return null;
		}
	});

})();