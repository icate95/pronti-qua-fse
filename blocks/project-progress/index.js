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
			className: 'pronti-qua-project-progress'
		});

		const percentage = targetAmount > 0 ? Math.round((currentAmount / targetAmount) * 100) : 0;

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Impostazioni Progetto', 'pronti-qua')}>
						<TextControl
							label={__('Titolo Progetto', 'pronti-qua')}
							value={projectTitle}
							onChange={(value) => setAttributes({ projectTitle: value })}
						/>
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
						<ToggleControl
							label={__('Mostra Percentuale', 'pronti-qua')}
							checked={showPercentage}
							onChange={(value) => setAttributes({ showPercentage: value })}
						/>
					</PanelBody>

					<PanelBody title={__('Colori', 'pronti-qua')} initialOpen={false}>
						<label>{__('Colore Barra', 'pronti-qua')}</label>
						<ColorPicker
							color={barColor}
							onChange={(value) => setAttributes({ barColor: value })}
						/>
						<br /><br />
						<label>{__('Colore Sfondo', 'pronti-qua')}</label>
						<ColorPicker
							color={backgroundColor}
							onChange={(value) => setAttributes({ backgroundColor: value })}
						/>
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="project-progress-header">
						<h3 className="project-title">{projectTitle}</h3>
						{showPercentage && (
							<span className="project-percentage">{percentage}%</span>
						)}
					</div>

					<div className="project-amounts">
                        <span className="current-amount">
                            {currency}{currentAmount.toLocaleString()}
                        </span>
						<span className="target-amount">
                            {__('di', 'pronti-qua')} {currency}{targetAmount.toLocaleString()}
                        </span>
					</div>

					<div
						className="progress-bar-container"
						style={{ backgroundColor }}
					>
						<div
							className="progress-bar-fill"
							style={{
								width: `${Math.min(percentage, 100)}%`,
								backgroundColor: barColor
							}}
						/>
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			projectTitle,
			currentAmount,
			targetAmount,
			currency,
			showPercentage,
			barColor,
			backgroundColor
		} = attributes;

		const blockProps = useBlockProps.save({
			className: 'pronti-qua-project-progress'
		});

		const percentage = targetAmount > 0 ? Math.round((currentAmount / targetAmount) * 100) : 0;

		return (
			<div {...blockProps}>
				<div className="project-progress-header">
					<h3 className="project-title">{projectTitle}</h3>
					{showPercentage && (
						<span className="project-percentage">{percentage}%</span>
					)}
				</div>

				<div className="project-amounts">
                    <span className="current-amount">
                        {currency}{currentAmount.toLocaleString()}
                    </span>
					<span className="target-amount">
                        di {currency}{targetAmount.toLocaleString()}
                    </span>
				</div>

				<div
					className="progress-bar-container"
					style={{ backgroundColor }}
				>
					<div
						className="progress-bar-fill"
						style={{
							width: `${Math.min(percentage, 100)}%`,
							backgroundColor: barColor
						}}
					/>
				</div>
			</div>
		);
	}
});