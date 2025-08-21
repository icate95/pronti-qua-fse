import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl, ToggleControl, ColorPicker } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/project-progress', {
	edit: ({ attributes, setAttributes }) => {
		const {
			projectTitle,
			currentAmount,
			targetAmount,
			currency,
			showPercentage,
			barColor,
			backgroundColor
		} = attributes;

		const blockProps = useBlockProps({
			className: `pronti-qua-codice-5x1000 codice-style-${style}`
		});

		const styleOptions = [
			{ label: __('Card', 'pronti-qua'), value: 'card' },
			{ label: __('Banner', 'pronti-qua'), value: 'banner' },
			{ label: __('Minimale', 'pronti-qua'), value: 'minimal' }
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
						/>
						<SelectControl
							label={__('Stile', 'pronti-qua')}
							value={style}
							options={styleOptions}
							onChange={(value) => setAttributes({ style: value })}
						/>
						<ToggleControl
							label={__('Mostra Pulsante Copia', 'pronti-qua')}
							checked={showCopyButton}
							onChange={(value) => setAttributes({ showCopyButton: value })}
						/>
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="codice-5x1000-container">
						<div className="codice-header">
							<RichText
								tagName="h3"
								placeholder={__('Titolo...', 'pronti-qua')}
								value={title}
								onChange={(value) => setAttributes({ title: value })}
								className="codice-title"
							/>

							<RichText
								tagName="p"
								placeholder={__('Descrizione...', 'pronti-qua')}
								value={description}
								onChange={(value) => setAttributes({ description: value })}
								className="codice-description"
							/>
						</div>

						<div className="codice-display">
							<div className="codice-label">Codice Fiscale:</div>
							<div className="codice-number">{codiceFiscale}</div>

							{showCopyButton && (
								<button
									className="codice-copy-btn"
									onClick={(e) => e.preventDefault()}
								>
									📋 Copia
								</button>
							)}
						</div>

						{style !== 'minimal' && (
							<div className="codice-instructions">
								<p>Inserisci questo codice nel riquadro <strong>"Sostegno del volontariato"</strong> della tua dichiarazione dei redditi</p>
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
			style
		} = attributes;

		const blockProps = useBlockProps.save({
			className: `pronti-qua-codice-5x1000 codice-style-${style}`
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
						<div className="codice-label">Codice Fiscale:</div>
						<div className="codice-number" data-codice={codiceFiscale}>{codiceFiscale}</div>

						{showCopyButton && (
							<button
								className="codice-copy-btn"
								data-copy-text={codiceFiscale}
							>
								📋 Copia
							</button>
						)}
					</div>

					{style !== 'minimal' && (
						<div className="codice-instructions">
							<p>Inserisci questo codice nel riquadro <strong>"Sostegno del volontariato"</strong> della tua dichiarazione dei redditi</p>
						</div>
					)}
				</div>
			</div>
		);
	}
});