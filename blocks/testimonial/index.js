import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/testimonial', {
	edit: ({ attributes, setAttributes }) => {
		const {
			content,
			authorName,
			authorRole,
			isAnonymous,
			imageUrl,
			style
		} = attributes;

		const blockProps = useBlockProps({
			className: `pronti-qua-testimonial testimonial-style-${style}`
		});

		const styleOptions = [
			{ label: __('Card', 'pronti-qua'), value: 'card' },
			{ label: __('Citazione', 'pronti-qua'), value: 'quote' },
			{ label: __('Minimale', 'pronti-qua'), value: 'minimal' }
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Impostazioni Testimonianza', 'pronti-qua')}>
						<SelectControl
							label={__('Stile', 'pronti-qua')}
							value={style}
							options={styleOptions}
							onChange={(value) => setAttributes({ style: value })}
						/>
						<ToggleControl
							label={__('Testimonianza Anonima', 'pronti-qua')}
							checked={isAnonymous}
							onChange={(value) => setAttributes({ isAnonymous: value })}
						/>
						{!isAnonymous && (
							<>
								<TextControl
									label={__('Nome Autore', 'pronti-qua')}
									value={authorName}
									onChange={(value) => setAttributes({ authorName: value })}
								/>
								<TextControl
									label={__('Ruolo/Relazione', 'pronti-qua')}
									value={authorRole}
									onChange={(value) => setAttributes({ authorRole: value })}
									help={__('Es: Paziente, Familiare, Volontario', 'pronti-qua')}
								/>
								<MediaUploadCheck>
									<MediaUpload
										onSelect={(media) => setAttributes({ imageUrl: media.url })}
										allowedTypes={['image']}
										value={imageUrl}
										render={({ open }) => (
											<div>
												<Button onClick={open} isPrimary>
													{imageUrl ? __('Cambia Immagine', 'pronti-qua') : __('Seleziona Immagine', 'pronti-qua')}
												</Button>
												{imageUrl && (
													<div style={{ marginTop: '10px' }}>
														<img src={imageUrl} alt="" style={{ maxWidth: '100px', height: 'auto' }} />
														<br />
														<Button
															onClick={() => setAttributes({ imageUrl: '' })}
															isDestructive
															isSmall
														>
															{__('Rimuovi', 'pronti-qua')}
														</Button>
													</div>
												)}
											</div>
										)}
									/>
								</MediaUploadCheck>
							</>
						)}
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="testimonial-content">
						<RichText
							tagName="blockquote"
							placeholder={__('Inserisci qui il testo della testimonianza...', 'pronti-qua')}
							value={content}
							onChange={(value) => setAttributes({ content: value })}
							className="testimonial-text"
						/>
					</div>

					<div className="testimonial-author">
						{imageUrl && !isAnonymous && (
							<div className="author-image">
								<img src={imageUrl} alt={authorName} />
							</div>
						)}
						<div className="author-info">
							<div className="author-name">
								{isAnonymous ? __('Testimonianza Anonima', 'pronti-qua') : authorName}
							</div>
							{!isAnonymous && (
								<div className="author-role">{authorRole}</div>
							)}
						</div>
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			content,
			authorName,
			authorRole,
			isAnonymous,
			imageUrl,
			style
		} = attributes;

		const blockProps = useBlockProps.save({
			className: `pronti-qua-testimonial testimonial-style-${style}`
		});

		return (
			<div {...blockProps}>
				<div className="testimonial-content">
					<RichText.Content
						tagName="blockquote"
						value={content}
						className="testimonial-text"
					/>
				</div>

				<div className="testimonial-author">
					{imageUrl && !isAnonymous && (
						<div className="author-image">
							<img src={imageUrl} alt={authorName} />
						</div>
					)}
					<div className="author-info">
						<div className="author-name">
							{isAnonymous ? 'Testimonianza Anonima' : authorName}
						</div>
						{!isAnonymous && (
							<div className="author-role">{authorRole}</div>
						)}
					</div>
				</div>
			</div>
		);
	}
});