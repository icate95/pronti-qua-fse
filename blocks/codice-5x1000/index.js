import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps, RichText, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/codice-5x1000', {
	edit: ({ attributes, setAttributes }) => {
		const {
			codiceFiscale,
			title,
			description,
			showCopyButton,
			showInstructions,
			style,
			backgroundColor,
			textColor
		} = attributes;

		const blockProps = useBlockProps({
			className: `pronti-qua-codice-5x1000 codice-style-${style}`,
			style: {
				backgroundColor: style === 'card' || style === 'banner' ? backgroundColor : undefined,
				color: style === 'card' || style === 'banner' ? textColor : undefined
			}
		});

		const styleOptions = [
			{ label: __('Card', 'pronti-qua'), value: 'card' },
			{ label: __('Banner', 'pronti-qua'), value: 'banner' },
			{ label: __('Minimale', 'pronti-qua'), value: 'minimal' }
		];

		const themeColors = [
			{ name: __('Verde Primario', 'pronti-qua'), color: '#6f8a2b' },
			{ name: __('Azzurro Secondario', 'pronti-qua'), color: '#379db2' },
			{ name: __('Rosa Accento', 'pronti-qua'), color: '#e66395' },
			{ name: __('Giallo Highlight', 'pronti-qua'), color: '#ded771' },
			{ name: __('Scuro', 'pronti-qua'), color: '#1f2937' },
			{ name: __('Chiaro', 'pronti-qua'), color: '#f8fafc' },
			{ name: __('Bianco', 'pronti-qua'), color: '#ffffff' }
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Impostazioni 5x1000', 'pronti-qua')}>
						<TextControl
							label={__('Codice Fiscale', 'pronti-qua')}
							value={codiceFiscale}
							onChange={(value) => setAttributes({ codiceFiscale: value })}
							help={__('Inserisci il codice fiscale dell\'associazione', 'pronti-qua')}
							pattern="[0-9]{11}"
							maxLength="11"
						/>

						<SelectControl
							label={__('Stile Visualizzazione', 'pronti-qua')}
							value={style}
							options={styleOptions}
							onChange={(value) => setAttributes({ style: value })}
						/>

						<ToggleControl
							label={__('Mostra Pulsante Copia', 'pronti-qua')}
							checked={showCopyButton}
							onChange={(value) => setAttributes({ showCopyButton: value })}
						/>

						<ToggleControl
							label={__('Mostra Istruzioni', 'pronti-qua')}
							checked={showInstructions}
							onChange={(value) => setAttributes({ showInstructions: value })}
						/>
					</PanelBody>

					{(style === 'card' || style === 'banner') && (
						<PanelBody title={__('Colori', 'pronti-qua')} initialOpen={false}>
							<div style={{ marginBottom: '16px' }}>
								<label style={{ fontWeight: '600', marginBottom: '8px', display: 'block' }}>
									{__('Colore Sfondo', 'pronti-qua')}
								</label>
								<ColorPalette
									colors={themeColors}
									value={backgroundColor}
									onChange={(value) => setAttributes({ backgroundColor: value || '#ded771' })}
								/>
							</div>

							<div>
								<label style={{ fontWeight: '600', marginBottom: '8px', display: 'block' }}>
									{__('Colore Testo', 'pronti-qua')}
								</label>
								<ColorPalette
									colors={themeColors}
									value={textColor}
									onChange={(value) => setAttributes({ textColor: value || '#1f2937' })}
								/>
							</div>
						</PanelBody>
					)}
				</InspectorControls>

				<div {...blockProps}>
					<div className="codice-5x1000-container">
						<div className="codice-header">
							<RichText
								tagName="h3"
								placeholder={__('Titolo sezione 5x1000...', 'pronti-qua')}
								value={title}
								onChange={(value) => setAttributes({ title: value })}
								className="codice-title"
								allowedFormats={['core/bold', 'core/italic']}
							/>

							<RichText
								tagName="p"
								placeholder={__('Descrizione breve...', 'pronti-qua')}
								value={description}
								onChange={(value) => setAttributes({ description: value })}
								className="codice-description"
								allowedFormats={['core/bold', 'core/italic']}
							/>
						</div>

						<div className="codice-display">
							<div className="codice-label">
								{__('Codice Fiscale:', 'pronti-qua')}
							</div>
							<div className="codice-number">{codiceFiscale}</div>

							{showCopyButton && (
								<button
									className="codice-copy-btn"
									onClick={(e) => e.preventDefault()}
								>
									📋 {__('Copia', 'pronti-qua')}
								</button>
							)}
						</div>

						{showInstructions && style !== 'minimal' && (
							<div className="codice-instructions">
								<p>
									{__('Inserisci questo codice nel riquadro', 'pronti-qua')} <strong>"{__('Sostegno del volontariato', 'pronti-qua')}"</strong> {__('della tua dichiarazione dei redditi', 'pronti-qua')}
								</p>
							</div>
						)}

						{style === 'banner' && (
							<div className="codice-benefits">
								<div className="benefit-item">
									<span className="benefit-icon">✓</span>
									<span>{__('Non costa nulla', 'pronti-qua')}</span>
								</div>
								<div className="benefit-item">
									<span className="benefit-icon">✓</span>
									<span>{__('100% trasparente', 'pronti-qua')}</span>
								</div>
								<div className="benefit-item">
									<span className="benefit-icon">✓</span>
									<span>{__('Impatto reale', 'pronti-qua')}</span>
								</div>
							</div>
						)}
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			codiceFiscale,
			title,
			description,
			showCopyButton,
			showInstructions,
			style,
			backgroundColor,
			textColor
		} = attributes;

		const blockProps = useBlockProps.save({
			className: `pronti-qua-codice-5x1000 codice-style-${style}`,
			style: {
				backgroundColor: style === 'card' || style === 'banner' ? backgroundColor : undefined,
				color: style === 'card' || style === 'banner' ? textColor : undefined
			}
		});

		return (
			<div {...blockProps}>
				<div className="codice-5x1000-container">
					<div className="codice-header">
						<RichText.Content
							tagName="h3"
							value={title}
							className="codice-title"
						/>

						<RichText.Content
							tagName="p"
							value={description}
							className="codice-description"
						/>
					</div>

					<div className="codice-display">
						<div className="codice-label">
							Codice Fiscale:
						</div>
						<div className="codice-number" data-codice={codiceFiscale}>
							{codiceFiscale}
						</div>

						{showCopyButton && (
							<button
								className="codice-copy-btn"
								data-copy-text={codiceFiscale}
								aria-label={`Copia codice fiscale ${codiceFiscale}`}
							>
								📋 Copia
							</button>
						)}
					</div>

					{showInstructions && style !== 'minimal' && (
						<div className="codice-instructions">
							<p>
								Inserisci questo codice nel riquadro <strong>"Sostegno del volontariato"</strong> della tua dichiarazione dei redditi
							</p>
						</div>
					)}

					{style === 'banner' && (
						<div className="codice-benefits">
							<div className="benefit-item">
								<span className="benefit-icon">✓</span>
								<span>Non costa nulla</span>
							</div>
							<div className="benefit-item">
								<span className="benefit-icon">✓</span>
								<span>100% trasparente</span>
							</div>
							<div className="benefit-item">
								<span className="benefit-icon">✓</span>
								<span>Impatto reale</span>
							</div>
						</div>
					)}
				</div>
			</div>
		);
	}
});