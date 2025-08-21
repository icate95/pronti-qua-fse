import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl, ColorPicker, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/impact-counter', {
	edit: ({ attributes, setAttributes }) => {
		const {
			number,
			label,
			suffix,
			textColor,
			animationDuration,
			fontSize
		} = attributes;

		const blockProps = useBlockProps({
			className: 'pronti-qua-impact-counter'
		});

		const fontSizeOptions = [
			{ label: __('Piccolo', 'pronti-qua'), value: 'large' },
			{ label: __('Medio', 'pronti-qua'), value: 'x-large' },
			{ label: __('Grande', 'pronti-qua'), value: 'xx-large' },
			{ label: __('Extra Grande', 'pronti-qua'), value: 'xxx-large' }
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Impostazioni Contatore', 'pronti-qua')}>
						<RangeControl
							label={__('Numero', 'pronti-qua')}
							value={number}
							onChange={(value) => setAttributes({ number: value })}
							min={1}
							max={10000}
							step={1}
						/>
						<TextControl
							label={__('Etichetta', 'pronti-qua')}
							value={label}
							onChange={(value) => setAttributes({ label: value })}
						/>
						<TextControl
							label={__('Suffisso', 'pronti-qua')}
							value={suffix}
							onChange={(value) => setAttributes({ suffix: value })}
							help={__('Es: +, %, K, etc.', 'pronti-qua')}
						/>
						<SelectControl
							label={__('Dimensione Font', 'pronti-qua')}
							value={fontSize}
							options={fontSizeOptions}
							onChange={(value) => setAttributes({ fontSize: value })}
						/>
						<RangeControl
							label={__('Durata Animazione (ms)', 'pronti-qua')}
							value={animationDuration}
							onChange={(value) => setAttributes({ animationDuration: value })}
							min={500}
							max={5000}
							step={100}
						/>
					</PanelBody>

					<PanelBody title={__('Colore', 'pronti-qua')} initialOpen={false}>
						<ColorPicker
							color={textColor}
							onChange={(value) => setAttributes({ textColor: value })}
						/>
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="impact-counter-container">
						<div
							className={`impact-number has-${fontSize}-font-size`}
							style={{ color: textColor }}
						>
							{number.toLocaleString()}{suffix}
						</div>
						<div className="impact-label">
							{label}
						</div>
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			number,
			label,
			suffix,
			textColor,
			animationDuration,
			fontSize
		} = attributes;

		const blockProps = useBlockProps.save({
			className: 'pronti-qua-impact-counter'
		});

		return (
			<div {...blockProps}>
				<div className="impact-counter-container">
					<div
						className={`impact-number has-${fontSize}-font-size`}
						style={{ color: textColor }}
						data-target={number}
						data-duration={animationDuration}
						data-suffix={suffix}
					>
						0{suffix}
					</div>
					<div className="impact-label">
						{label}
					</div>
				</div>
			</div>
		);
	}
});