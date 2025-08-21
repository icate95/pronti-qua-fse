import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('pronti-qua/team-member', {
	edit: ({ attributes, setAttributes }) => {
		const {
			name,
			role,
			bio,
			imageUrl,
			email,
			phone,
			showContacts,
			cardStyle
		} = attributes;

		const blockProps = useBlockProps({
			className: `pronti-qua-team-member team-card-${cardStyle}`
		});

		const styleOptions = [
			{ label: __('Standard', 'pronti-qua'), value: 'standard' },
			{ label: __('Compatto', 'pronti-qua'), value: 'compact' },
			{ label: __('Dettagliato', 'pronti-qua'), value: 'detailed' }
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title={__('Informazioni Persona', 'pronti-qua')}>
						<TextControl
							label={__('Nome', 'pronti-qua')}
							value={name}
							onChange={(value) => setAttributes({ name: value })}
						/>
						<TextControl
							label={__('Ruolo', 'pronti-qua')}
							value={role}
							onChange={(value) => setAttributes({ role: value })}
						/>
						<SelectControl
							label={__('Stile Card', 'pronti-qua')}
							value={cardStyle}
							options={styleOptions}
							onChange={(value) => setAttributes({ cardStyle: value })}
						/>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) => setAttributes({ imageUrl: media.url })}
								allowedTypes={['image']}
								value={imageUrl}
								render={({ open }) => (
									<div>
										<Button onClick={open} isPrimary>
											{imageUrl ? __('Cambia Foto', 'pronti-qua') : __('Aggiungi Foto', 'pronti-qua')}
										</Button>
										{imageUrl && (
											<div style={{ marginTop: '10px' }}>
												<img src={imageUrl} alt="" style={{ maxWidth: '100px', height: 'auto', borderRadius: '50%' }} />
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
					</PanelBody>

					<PanelBody title={__('Contatti', 'pronti-qua')} initialOpen={false}>
						<ToggleControl
							label={__('Mostra Contatti', 'pronti-qua')}
							checked={showContacts}
							onChange={(value) => setAttributes({ showContacts: value })}
						/>
						{showContacts && (
							<>
								<TextControl
									label={__('Email', 'pronti-qua')}
									value={email}
									onChange={(value) => setAttributes({ email: value })}
									type="email"
								/>
								<TextControl
									label={__('Telefono', 'pronti-qua')}
									value={phone}
									onChange={(value) => setAttributes({ phone: value })}
									type="tel"
								/>
							</>
						)}
					</PanelBody>
				</InspectorControls>

				<div {...blockProps}>
					<div className="team-member-card">
						{imageUrl && (
							<div className="member-photo">
								<img src={imageUrl} alt={name} />
							</div>
						)}

						<div className="member-info">
							<h3 className="member-name">{name}</h3>
							<div className="member-role">{role}</div>

							{cardStyle !== 'compact' && (
								<div className="member-bio">
									<RichText
										tagName="p"
										placeholder={__('Breve biografia...', 'pronti-qua')}
										value={bio}
										onChange={(value) => setAttributes({ bio: value })}
										allowedFormats={['core/bold', 'core/italic']}
									/>
								</div>
							)}

							{showContacts && (email || phone) && (
								<div className="member-contacts">
									{email && (
										<div className="contact-item">
											<span className="contact-icon">📧</span>
											<a href={`mailto:${email}`}>{email}</a>
										</div>
									)}
									{phone && (
										<div className="contact-item">
											<span className="contact-icon">📞</span>
											<a href={`tel:${phone}`}>{phone}</a>
										</div>
									)}
								</div>
							)}
						</div>
					</div>
				</div>
			</>
		);
	},

	save: ({ attributes }) => {
		const {
			name,
			role,
			bio,
			imageUrl,
			email,
			phone,
			showContacts,
			cardStyle
		} = attributes;

		const blockProps = useBlockProps.save({
			className: `pronti-qua-team-member team-card-${cardStyle}`
		});

		return (
			<div {...blockProps}>
				<div className="team-member-card">
					{imageUrl && (
						<div className="member-photo">
							<img src={imageUrl} alt={name} />
						</div>
					)}

					<div className="member-info">
						<h3 className="member-name">{name}</h3>
						<div className="member-role">{role}</div>

						{cardStyle !== 'compact' && bio && (
							<div className="member-bio">
								<RichText.Content tagName="p" value={bio} />
							</div>
						)}

						{showContacts && (email || phone) && (
							<div className="member-contacts">
								{email && (
									<div className="contact-item">
										<span className="contact-icon">📧</span>
										<a href={`mailto:${email}`}>{email}</a>
									</div>
								)}
								{phone && (
									<div className="contact-item">
										<span className="contact-icon">📞</span>
										<a href={`tel:${phone}`}>{phone}</a>
									</div>
								)}
							</div>
						)}
					</div>
				</div>
			</div>
		);
	}
});