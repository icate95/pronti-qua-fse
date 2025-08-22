(function() {
	'use strict';

	// Verifica disponibilità WordPress
	if (!wp || !wp.blocks || !wp.element) {
		return;
	}

	const { registerBlockType } = wp.blocks;
	const { createElement: el, useState, useEffect } = wp.element;
	const { InspectorControls } = wp.blockEditor || {};
	const { PanelBody, RangeControl, ToggleControl } = wp.components || {};

	// Registra un blocco funzionale con preview delle immagini
	registerBlockType('pronti-qua/slideshow', {
		title: 'Slideshow Pronti Qua',
		icon: 'slides',
		category: 'pronti-qua',
		description: 'Slideshow automatico per progetti e servizi',

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

			// Definisci le slide con le immagini (stesso array del PHP)
			const slides = [
				{
					title: 'I nostri volontari',
					content: 'Grazie ai volontari e a chi ci sostiene quotidianamente riusciamo ad ottenere grandi risultati',
					imageUrl: '/wp-content/themes/pronti-qua-fse/assets/img/slide-volontari.jpeg'
				},
				{
					title: 'Supporto psicologico specializzato',
					content: 'Professionisti qualificati accompagnano pazienti e famiglie nel percorso di cura',
					imageUrl: '/wp-content/themes/pronti-qua-fse/assets/img/slide-supporto.jpeg'
				},
				{
					title: 'Le nostre raccolte fondi',
					content: 'Eventi e mercatini per sostenere la ricerca e i progetti dell\'associazione',
					imageUrl: '/wp-content/themes/pronti-qua-fse/assets/img/slide-mercatini.jpeg'
				},
				{
					title: 'Collaborazione con l\'Ospedale Santa Chiara',
					content: 'Partnership strategica per migliorare l\'assistenza ai pazienti oncologici',
					imageUrl: '/wp-content/themes/pronti-qua-fse/assets/img/slide-medici.jpeg'
				},
				{
					title: 'Sempre pronti per nuovi progetti',
					content: 'Idee innovative al servizio di famiglie e pazienti in difficoltà',
					imageUrl: '/wp-content/themes/pronti-qua-fse/assets/img/slide-progetti.jpeg'
				}
			];

			// Auto-advance delle slide ogni 3 secondi (solo in preview)
			useEffect(() => {
				if (autoplay && slides.length > 1) {
					const timer = setInterval(() => {
						setCurrentSlide(prev => (prev + 1) % slides.length);
					}, 3000);
					return () => clearInterval(timer);
				}
			}, [autoplay, slides.length]);

			return el('div', {
					style: {
						border: '2px solid #6f8a2b',
						borderRadius: '8px',
						overflow: 'hidden'
					}
				},
				// Inspector Controls (se disponibili)
				InspectorControls && el(InspectorControls, null,
					el(PanelBody, {
							title: 'Impostazioni Slideshow'
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
							label: 'Autoplay',
							checked: autoplay,
							onChange: (value) => setAttributes({ autoplay: value })
						}),

						autoplay && el(RangeControl, {
							label: 'Intervallo (ms)',
							value: interval,
							onChange: (value) => setAttributes({ interval: value }),
							min: 1000,
							max: 10000,
							step: 500
						}),

						el(ToggleControl, {
							label: 'Mostra indicatori',
							checked: showIndicators,
							onChange: (value) => setAttributes({ showIndicators: value })
						})
					)
				),

				// Preview del slideshow con immagini reali
				el('div', {
						style: {
							position: 'relative',
							height: height + 'px',
							backgroundColor: '#f1f5f9',
							overflow: 'hidden'
						}
					},
					// Slide attuale
					el('div', {
							style: {
								position: 'absolute',
								top: 0,
								left: 0,
								width: '100%',
								height: '100%',
								backgroundImage: slides[currentSlide] ? `url(${slides[currentSlide].imageUrl})` : 'none',
								backgroundSize: 'cover',
								backgroundPosition: 'center',
								backgroundColor: slides[currentSlide] ? 'transparent' : '#e2e8f0',
								transition: 'all 0.5s ease'
							}
						},
						// Overlay per migliorare leggibilità dell'editor
						el('div', {
								style: {
									position: 'absolute',
									top: 0,
									left: 0,
									right: 0,
									bottom: 0,
									background: 'linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.3))',
									display: 'flex',
									alignItems: 'flex-end',
									padding: '20px'
								}
							},
							// Info slide corrente
							el('div', {
									style: {
										background: 'rgba(255,255,255,0.95)',
										padding: '12px 16px',
										borderRadius: '6px',
										maxWidth: '70%'
									}
								},
								el('h4', {
									style: {
										margin: '0 0 4px 0',
										fontSize: '14px',
										fontWeight: '600',
										color: '#1f2937'
									}
								}, slides[currentSlide] ? slides[currentSlide].title : 'Caricamento...'),

								el('p', {
									style: {
										margin: '0',
										fontSize: '12px',
										color: '#6b7280',
										lineHeight: '1.4'
									}
								}, slides[currentSlide] ? slides[currentSlide].content : '')
							)
						)
					),

					// Indicatori
					showIndicators && el('div', {
							style: {
								position: 'absolute',
								bottom: '12px',
								right: '12px',
								display: 'flex',
								gap: '6px',
								background: 'rgba(255,255,255,0.8)',
								padding: '6px 10px',
								borderRadius: '20px'
							}
						},
						slides.map((_, index) =>
							el('button', {
								key: index,
								onClick: () => setCurrentSlide(index),
								style: {
									width: '8px',
									height: '8px',
									borderRadius: '50%',
									border: 'none',
									backgroundColor: index === currentSlide ? '#6f8a2b' : '#d1d5db',
									cursor: 'pointer',
									transition: 'all 0.2s ease'
								}
							})
						)
					),

					// Info status
					el('div', {
						style: {
							position: 'absolute',
							top: '12px',
							left: '12px',
							background: 'rgba(111, 138, 43, 0.9)',
							color: 'white',
							padding: '4px 8px',
							borderRadius: '4px',
							fontSize: '11px',
							fontWeight: '600'
						}
					}, `${currentSlide + 1}/${slides.length}`)
				),

				// Info panel sotto
				el('div', {
						style: {
							padding: '12px 16px',
							backgroundColor: '#f8fafc',
							borderTop: '1px solid #e2e8f0',
							fontSize: '12px',
							color: '#6b7280'
						}
					},
					`📸 Slideshow con ${slides.length} immagini • `,
					autoplay ? `⏯️ Autoplay ${interval}ms` : '⏸️ Manuale',
					showIndicators ? ' • 🔵 Con indicatori' : ''
				)
			);
		},

		save: function() {
			// Rendering dinamico via PHP
			return null;
		}
	});

})();