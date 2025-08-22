import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	PanelColorSettings,
	MediaUpload,
	MediaUploadCheck
} from '@wordpress/block-editor';
import {
	PanelBody,
	PanelRow,
	TextControl,
	TextareaControl,
	ToggleControl,
	RangeControl,
	Button,
	SelectControl,
	Flex,
	FlexItem
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import { upload } from '@wordpress/icons';

import './editor.scss';

const COLOR_OPTIONS = [
	{ name: 'Verde Primario', slug: 'verde-primario', color: '#6f8a2b' },
	{ name: 'Azzurro Secondario', slug: 'azzurro-secondario', color: '#379db2' },
	{ name: 'Rosa Accento', slug: 'rosa-accento', color: '#e66395' },
	{ name: 'Giallo Highlight', slug: 'giallo-highlight', color: '#ded771' }
];

registerBlockType('pronti-qua/slideshow', {
	edit({ attributes, setAttributes }) {
		const { slides, height, autoplay, interval, showIndicators, backgroundColor } = attributes;
		const [currentSlide, setCurrentSlide] = useState(0);

		const blockProps = useBlockProps({
			className: 'pronti-qua-slideshow-editor'
		});

		const updateSlide = (index, field, value) => {
			const newSlides = [...slides];
			newSlides[index] = {
				...newSlides[index],
				[field]: value
			};
			setAttributes({ slides: newSlides });
		};

		const addSlide = () => {
			const newSlides = [...slides, {
				title: 'Nuova Slide',
				content: 'Contenuto della slide',
				backgroundColor: 'verde-primario',
				imageId: null,
				imageUrl: '',
				imageAlt: ''
			}];
			setAttributes({ slides: newSlides });
		};

		const removeSlide = (index) => {
			if (slides.length > 1) {
				const newSlides = slides.filter((_, i) => i !== index);
				setAttributes({ slides: newSlides });
				setCurrentSlide(Math.min(currentSlide, newSlides.length - 1));
			}
		};

		const getBackgroundColor = (colorSlug) => {
			const colorObj = COLOR_OPTIONS.find(c => c.slug === colorSlug);
			return colorObj ? colorObj.color : '#6f8a2b';
		};

		return (
			<div {...blockProps}>
				<InspectorControls>
					<PanelBody title={__('Impostazioni Slideshow', 'pronti-qua')} initialOpen={true}>
						<PanelRow>
							<RangeControl
								label={__('Altezza (px)', 'pronti-qua')}
								value={height}
								onChange={(value) => setAttributes({ height: value })}
								min={200}
								max={600}
								step={10}
							/>
						</PanelRow>

						<PanelRow>
							<ToggleControl
								label={__('Riproduzione automatica', 'pronti-qua')}
								checked={autoplay}
								onChange={(value) => setAttributes({ autoplay: value })}
							/>
						</PanelRow>

						{autoplay && (
							<PanelRow>
								<RangeControl
									label={__('Intervallo (ms)', 'pronti-qua')}
									value={interval}
									onChange={(value) => setAttributes({ interval: value })}
									min={2000}
									max={10000}
									step={500}
								/>
							</PanelRow>
						)}

						<PanelRow>
							<ToggleControl
								label={__('Mostra indicatori', 'pronti-qua')}
								checked={showIndicators}
								onChange={(value) => setAttributes({ showIndicators: value })}
							/>
						</PanelRow>
					</PanelBody>

					<PanelColorSettings
						title={__('Colore di sfondo', 'pronti-qua')}
						colorSettings={[
							{
								value: backgroundColor,
								onChange: (value) => setAttributes({ backgroundColor: value }),
								label: __('Sfondo slideshow', 'pronti-qua')
							}
						]}
					/>

					<PanelBody title={__('Gestione Slide', 'pronti-qua')} initialOpen={false}>
						<PanelRow>
							<Flex>
								<FlexItem>
									<Button
										variant="primary"
										onClick={addSlide}
									>
										{__('Aggiungi Slide', 'pronti-qua')}
									</Button>
								</FlexItem>
								<FlexItem>
									<span>{slides.length} slide totali</span>
								</FlexItem>
							</Flex>
						</PanelRow>
					</PanelBody>
				</InspectorControls>

				{/* Preview Slideshow */}
				<div
					className="slideshow-preview"
					style={{
						height: `${height}px`,
						backgroundColor: backgroundColor,
						position: 'relative',
						overflow: 'hidden',
						border: '1px solid #ddd'
					}}
				>
					{/* Slide Navigation */}
					<div className="slide-navigation" style={{
						position: 'absolute',
						top: '10px',
						left: '10px',
						zIndex: 10,
						display: 'flex',
						gap: '5px'
					}}>
						{slides.map((_, index) => (
							<Button
								key={index}
								variant={currentSlide === index ? 'primary' : 'secondary'}
								onClick={() => setCurrentSlide(index)}
								style={{ padding: '4px 8px', fontSize: '12px' }}
							>
								{index + 1}
							</Button>
						))}
					</div>

					{/* Current Slide Display */}
					{slides[currentSlide] && (
						<div
							style={{
								position: 'absolute',
								width: '100%',
								height: '100%',
								display: 'flex',
								alignItems: 'center',
								justifyContent: 'center',
								background: slides[currentSlide].imageUrl
									? `linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url(${slides[currentSlide].imageUrl})`
									: `linear-gradient(135deg, ${getBackgroundColor(slides[currentSlide].backgroundColor)}20, ${getBackgroundColor(slides[currentSlide].backgroundColor)}10)`,
								backgroundSize: 'cover',
								backgroundPosition: 'center'
							}}
						>
							<div style={{ textAlign: 'center', padding: '2rem', color: 'white' }}>
								<h4 style={{
									margin: '0 0 1rem',
									fontSize: '1.5rem',
									fontWeight: '600',
									color: slides[currentSlide].imageUrl ? 'white' : '#1f2937',
									textShadow: slides[currentSlide].imageUrl ? '2px 2px 4px rgba(0,0,0,0.8)' : 'none'
								}}>
									{slides[currentSlide].title}
								</h4>
								<p style={{
									margin: '0',
									fontSize: '1rem',
									color: slides[currentSlide].imageUrl ? '#f3f4f6' : '#6b7280',
									textShadow: slides[currentSlide].imageUrl ? '1px 1px 2px rgba(0,0,0,0.8)' : 'none'
								}}>
									{slides[currentSlide].content}
								</p>
							</div>
						</div>
					)}
				</div>

				{/* Slide Editor */}
				{slides[currentSlide] && (
					<div className="slide-editor" style={{ marginTop: '20px', padding: '20px', border: '1px solid #ddd', borderRadius: '4px' }}>
						<h4>{__('Modifica Slide', 'pronti-qua')} {currentSlide + 1}</h4>

						<TextControl
							label={__('Titolo', 'pronti-qua')}
							value={slides[currentSlide].title}
							onChange={(value) => updateSlide(currentSlide, 'title', value)}
						/>

						<TextareaControl
							label={__('Contenuto', 'pronti-qua')}
							value={slides[currentSlide].content}
							onChange={(value) => updateSlide(currentSlide, 'content', value)}
							rows={3}
						/>

						<div style={{ marginBottom: '15px' }}>
							<label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>
								{__('Immagine di sfondo', 'pronti-qua')}
							</label>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(media) => {
										updateSlide(currentSlide, 'imageId', media.id);
										updateSlide(currentSlide, 'imageUrl', media.url);
										updateSlide(currentSlide, 'imageAlt', media.alt || '');
									}}
									allowedTypes={['image']}
									value={slides[currentSlide].imageId}
									render={({ open }) => (
										<div>
											{slides[currentSlide].imageUrl ? (
												<div style={{ marginBottom: '10px' }}>
													<img
														src={slides[currentSlide].imageUrl}
														alt={slides[currentSlide].imageAlt}
														style={{ maxWidth: '200px', height: 'auto', display: 'block', marginBottom: '10px' }}
													/>
													<Button
														variant="secondary"
														isDestructive
														onClick={() => {
															updateSlide(currentSlide, 'imageId', null);
															updateSlide(currentSlide, 'imageUrl', '');
															updateSlide(currentSlide, 'imageAlt', '');
														}}
													>
														{__('Rimuovi immagine', 'pronti-qua')}
													</Button>
												</div>
											) : null}
											<Button
												variant="primary"
												onClick={open}
												icon={upload}
											>
												{slides[currentSlide].imageUrl ? __('Cambia immagine', 'pronti-qua') : __('Seleziona immagine', 'pronti-qua')}
											</Button>
										</div>
									)}
								/>
							</MediaUploadCheck>
						</div>

						<SelectControl
							label={__('Colore di sfondo', 'pronti-qua')}
							value={slides[currentSlide].backgroundColor}
							options={COLOR_OPTIONS.map(color => ({
								label: color.name,
								value: color.slug
							}))}
							onChange={(value) => updateSlide(currentSlide, 'backgroundColor', value)}
							help={__('Il colore verrà utilizzato se non è impostata un\'immagine', 'pronti-qua')}
						/>

						{slides.length > 1 && (
							<Button
								variant="secondary"
								isDestructive
								onClick={() => removeSlide(currentSlide)}
								style={{ marginTop: '10px' }}
							>
								{__('Rimuovi questa slide', 'pronti-qua')}
							</Button>
						)}
					</div>
				)}
			</div>
		);
	},

	save({ attributes }) {
		const { slides, height, autoplay, interval, showIndicators, backgroundColor } = attributes;
		const blockProps = useBlockProps.save({
			className: 'pronti-qua-slideshow'
		});

		return (
			<div {...blockProps}>
				<div
					className="slideshow-container"
					data-autoplay={autoplay}
					data-interval={interval}
					data-show-indicators={showIndicators}
					style={{
						position: 'relative',
						height: `${height}px`,
						backgroundColor: backgroundColor,
						overflow: 'hidden'
					}}
				>
					{slides.map((slide, index) => (
						<div
							key={index}
							className={`slide ${index === 0 ? 'active' : ''}`}
							style={{
								position: 'absolute',
								width: '100%',
								height: '100%',
								display: 'flex',
								alignItems: 'center',
								justifyContent: 'center',
								opacity: index === 0 ? 1 : 0,
								transition: 'opacity 0.8s ease-in-out',
								background: `linear-gradient(135deg, var(--wp--preset--color--${slide.backgroundColor})20, var(--wp--preset--color--${slide.backgroundColor})10)`
							}}
						>
							<div style={{ textAlign: 'center', padding: '2rem' }}>
								<div style={{
									width: '100px',
									height: '100px',
									background: `var(--wp--preset--color--${slide.backgroundColor})`,
									margin: '0 auto 1.5rem',
									display: 'flex',
									alignItems: 'center',
									justifyContent: 'center',
									fontSize: '3rem',
									color: slide.backgroundColor === 'giallo-highlight' ? '#2d3748' : 'white'
								}}>
									{slide.icon}
								</div>
								<h4 style={{
									color: 'var(--wp--preset--color--dark)',
									margin: '0 0 0.5rem',
									fontSize: '1.5rem',
									fontWeight: '600'
								}}>
									{slide.title}
								</h4>
								<p style={{
									color: 'var(--wp--preset--color--gray-700)',
									margin: '0',
									fontSize: '1rem'
								}}>
									{slide.content}
								</p>
							</div>
						</div>
					))}

					{showIndicators && (
						<div className="slideshow-indicators" style={{
							position: 'absolute',
							bottom: '16px',
							left: '50%',
							transform: 'translateX(-50%)',
							display: 'flex',
							gap: '8px'
						}}>
							{slides.map((_, index) => (
								<div
									key={index}
									className={`indicator ${index === 0 ? 'active' : ''}`}
									style={{
										width: '12px',
										height: '12px',
										background: index === 0 ? 'var(--wp--preset--color--verde-primario)' : 'rgba(111,138,43,0.3)',
										cursor: 'pointer',
										transition: 'all 0.3s ease'
									}}
								/>
							))}
						</div>
					)}
				</div>
			</div>
		);
	}
});