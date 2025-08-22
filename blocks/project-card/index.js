import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/project-card', {
	edit: ({ attributes, setAttributes }) => {
		const {
			projectTitle,
			projectDescription,
			imageUrl,
			currentAmount,
			targetAmount,
			currency,
			projectUrl,
			category,
			status
		} = attributes;

		const blockProps = useBlockProps({
			className: 'pronti-qua-project-card'
		});

		const percentage = targetAmount > 0 ? Math.round((currentAmount / targetAmount) * 100) : 0;

		const categoryOptions = [
			{ label: __('Raccolta Fondi', 'pronti-qua'), value: 'raccolta-fondi' },
			{ label: __('Supporto', 'pronti-qua'), value: 'supporto' },
			{ label: __('Assistenza', 'pronti-qua'), value: 'assistenza' },
			{ label: __('Ricerca', 'pronti-qua'), value: 'ricerca' }
		];

		const statusOptions = [
			{ label: __('Attivo', 'pronti-qua'), value: 'attivo' },
			{ label: __('Completato', 'pronti-qua'), value: 'completato' },
			{ label: __('In Pausa', 'pronti-qua'), value: 'in-pausa' }
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Impostazioni Progetto', 'pronti-qua')}>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) => setAttributes({ imageUrl: media.url })}
								allowedTypes={['image']}
								value={imageUrl}
								render={({ open }) => (
									<div>
										<Button onClick={open} isPrimary>
											{imageUrl ? __('Cambia Immagine', 'pronti-qua') : __('Aggiungi Immagine', 'pronti-qua')}
										</Button>
										{imageUrl && (
											<div style={{ marginTop: '10px' }}>
												<img src={imageUrl} alt="" style={{ maxWidth: '100%', height: 'auto' }} />
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

						<TextControl
							label={__('URL Progetto', 'pronti-qua')}
							value={projectUrl}
							onChange={(value) => setAttributes({ projectUrl: value })}
							type="url"
						/>

						<SelectControl
							label={__('Categoria', 'pronti-qua')}
							value={category}
							options={categoryOptions}
							onChange={(value) => setAttributes({ category: value })}
						/>

						<SelectControl
							label={__('Stato', 'pronti-qua')}
							value={status}
							options={statusOptions}
							onChange={(value) => setAttributes({ status: value })}
						/>
					</PanelBody>

					<PanelBody title={__('Raccolta Fondi', 'pronti-qua')} initialOpen={false}>
						<RangeControl
							label={__('Importo Raccolto', 'pronti-qua')}
							value={currentAmount}
							onChange={(value) => setAttributes({ currentAmount: value })}
							min={0}
							max={targetAmount || 100000}
							step={100}
						/>

						<RangeControl
							label={__('Obiettivo', 'pronti-qua')}
							value={targetAmount}
							onChange={(value) => setAttributes({ targetAmount: value })}
							min={1000}
							max={500000}
							step={1000}
						/>

						<TextControl
							label={__('Valuta', 'pronti-qua')}
							value={currency}
							onChange={(value) => setAttributes({ currency: value })}
						/>
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="project-card-container">
						{imageUrl && (
							<div className="project-image">
								<img src={imageUrl} alt={projectTitle} />
								<div className={`project-status status-${status}`}>
									{status === 'attivo' && '✅ Attivo'}
									{status === 'completato' && '🎉 Completato'}
									{status === 'in-pausa' && '⏸️ In Pausa'}
								</div>
							</div>
						)}

						<div className="project-content">
							<div className="project-category">{category.replace('-', ' ')}</div>

							<RichText
								tagName="h3"
								placeholder={__('Titolo progetto...', 'pronti-qua')}
								value={projectTitle}
								onChange={(value) => setAttributes({ projectTitle: value })}
								className="project-title"
								allowedFormats={['core/bold']}
							/>

							<RichText
								tagName="p"
								placeholder={__('Descrizione del progetto...', 'pronti-qua')}
								value={projectDescription}
								onChange={(value) => setAttributes({ projectDescription: value })}
								className="project-description"
								allowedFormats={['core/bold', 'core/italic']}
							/>

							{category === 'raccolta-fondi' && (
								<div className="project-funding">
									<div className="funding-amounts">
										<span className="current">{currency}{currentAmount.toLocaleString()}</span>
										<span className="target">di {currency}{targetAmount.toLocaleString()}</span>
									</div>
									<div className="progress-bar">
										<div
											className="progress-fill"
											style={{ width: `${Math.min(percentage, 100)}%` }}
										></div>
									</div>
									<div className="percentage">{percentage}% raggiunto</div>
								</div>
							)}

							<div className="project-actions">
								<a
									href={projectUrl || '#'}
									className="project-link"
									onClick={(e) => e.preventDefault()}
								>
									Scopri di più
								</a>
							</div>
						</div>
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			projectTitle,
			projectDescription,
			imageUrl,
			currentAmount,
			targetAmount,
			currency,
			projectUrl,
			category,
			status
		} = attributes;

		const blockProps = useBlockProps.save({
			className: 'pronti-qua-project-card'
		});

		const percentage = targetAmount > 0 ? Math.round((currentAmount / targetAmount) * 100) : 0;

		return (
			<div {...blockProps}>
				<div className="project-card-container">
					{imageUrl && (
						<div className="project-image">
							<img src={imageUrl} alt={projectTitle} />
							<div className={`project-status status-${status}`}>
								{status === 'attivo' && '✅ Attivo'}
								{status === 'completato' && '🎉 Completato'}
								{status === 'in-pausa' && '⏸️ In Pausa'}
							</div>
						</div>
					)}

					<div className="project-content">
						<div className="project-category">{category.replace('-', ' ')}</div>

						<RichText.Content
							tagName="h3"
							value={projectTitle}
							className="project-title"
						/>

						<RichText.Content
							tagName="p"
							value={projectDescription}
							className="project-description"
						/>

						{category === 'raccolta-fondi' && (
							<div className="project-funding">
								<div className="funding-amounts">
									<span className="current">{currency}{currentAmount.toLocaleString()}</span>
									<span className="target">di {currency}{targetAmount.toLocaleString()}</span>
								</div>
								<div className="progress-bar">
									<div
										className="progress-fill"
										style={{ width: `${Math.min(percentage, 100)}%` }}
									></div>
								</div>
								<div className="percentage">{percentage}% raggiunto</div>
							</div>
						)}

						<div className="project-actions">
							{projectUrl && (
								<a href={projectUrl} className="project-link">
									Scopri di più
								</a>
							)}
						</div>
					</div>
				</div>
			</div>
		);
	}
});