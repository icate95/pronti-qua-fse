import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps, RichText } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/alert-banner', {
	edit: ({ attributes, setAttributes }) => {
		const {
			title,
			content,
			alertType,
			showIcon,
			isDismissible,
			buttonText,
			buttonUrl
		} = attributes;

		const blockProps = useBlockProps({
			className: `pronti-qua-alert-banner alert-type-${alertType}`
		});

		const alertTypeOptions = [
			{ label: __('Informazione', 'pronti-qua'), value: 'info' },
			{ label: __('Attenzione', 'pronti-qua'), value: 'warning' },
			{ label: __('Successo', 'pronti-qua'), value: 'success' },
			{ label: __('Errore', 'pronti-qua'), value: 'error' },
			{ label: __('Emergenza', 'pronti-qua'), value: 'emergency' }
		];

		const getIcon = (type) => {
			const icons = {
				info: 'ℹ️',
				warning: '⚠️',
				success: '✅',
				error: '❌',
				emergency: '🚨'
			};
			return icons[type] || '📢';
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Impostazioni Alert', 'pronti-qua')}>
						<SelectControl
							label={__('Tipo Alert', 'pronti-qua')}
							value={alertType}
							options={alertTypeOptions}
							onChange={(value) => setAttributes({ alertType: value })}
						/>
						<ToggleControl
							label={__('Mostra Icona', 'pronti-qua')}
							checked={showIcon}
							onChange={(value) => setAttributes({ showIcon: value })}
						/>
						<ToggleControl
							label={__('Chiudibile', 'pronti-qua')}
							checked={isDismissible}
							onChange={(value) => setAttributes({ isDismissible: value })}
						/>
						<TextControl
							label={__('Testo Pulsante', 'pronti-qua')}
							value={buttonText}
							onChange={(value) => setAttributes({ buttonText: value })}
							help={__('Lascia vuoto per non mostrare il pulsante', 'pronti-qua')}
						/>
						{buttonText && (
							<TextControl
								label={__('URL Pulsante', 'pronti-qua')}
								value={buttonUrl}
								onChange={(value) => setAttributes({ buttonUrl: value })}
								type="url"
							/>
						)}
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="alert-banner-container">
						<div className="alert-content">
							{showIcon && (
								<div className="alert-icon">
									{getIcon(alertType)}
								</div>
							)}

							<div className="alert-text">
								<RichText
									tagName="h4"
									placeholder={__('Titolo alert...', 'pronti-qua')}
									value={title}
									onChange={(value) => setAttributes({ title: value })}
									className="alert-title"
									allowedFormats={['core/bold']}
								/>

								<RichText
									tagName="p"
									placeholder={__('Messaggio alert...', 'pronti-qua')}
									value={content}
									onChange={(value) => setAttributes({ content: value })}
									className="alert-message"
									allowedFormats={['core/bold', 'core/italic', 'core/link']}
								/>
							</div>
						</div>

						<div className="alert-actions">
							{buttonText && (
								<a
									href={buttonUrl || '#'}
									className="alert-button"
									onClick={(e) => e.preventDefault()}
								>
									{buttonText}
								</a>
							)}

							{isDismissible && (
								<button className="alert-close" aria-label={__('Chiudi', 'pronti-qua')}>
									✕
								</button>
							)}
						</div>
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			title,
			content,
			alertType,
			showIcon,
			isDismissible,
			buttonText,
			buttonUrl
		} = attributes;

		const blockProps = useBlockProps.save({
			className: `pronti-qua-alert-banner alert-type-${alertType}`
		});

		const getIcon = (type) => {
			const icons = {
				info: 'ℹ️',
				warning: '⚠️',
				success: '✅',
				error: '❌',
				emergency: '🚨'
			};
			return icons[type] || '📢';
		};

		return (
			<div {...blockProps}>
				<div className="alert-banner-container">
					<div className="alert-content">
						{showIcon && (
							<div className="alert-icon">
								{getIcon(alertType)}
							</div>
						)}

						<div className="alert-text">
							<RichText.Content
								tagName="h4"
								value={title}
								className="alert-title"
							/>

							<RichText.Content
								tagName="p"
								value={content}
								className="alert-message"
							/>
						</div>
					</div>

					<div className="alert-actions">
						{buttonText && buttonUrl && (
							<a
								href={buttonUrl}
								className="alert-button"
							>
								{buttonText}
							</a>
						)}

						{isDismissible && (
							<button className="alert-close" aria-label="Chiudi">
								✕
							</button>
						)}
					</div>
				</div>
			</div>
		);
	}
});