document.addEventListener('DOMContentLoaded', function() {

// ====================================
// DONATION PAGE INTERACTIONS
// ====================================

// Gestione selezione importo donazione
	const donationAmountBtns = document.querySelectorAll('.donation-amount-btn');
	const customAmountInput = document.getElementById('custom-amount');

	donationAmountBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();

// Rimuovi selezione precedente
			donationAmountBtns.forEach(b => b.classList.remove('selected'));

// Aggiungi selezione corrente
			this.classList.add('selected');

// Aggiorna stili
			donationAmountBtns.forEach(b => {
				const link = b.querySelector('.wp-block-button__link');
				link.style.backgroundColor = 'var(--wp--preset--color--light)';
				link.style.color = 'var(--wp--preset--color--dark)';
			});

			const selectedLink = this.querySelector('.wp-block-button__link');
			selectedLink.style.backgroundColor = 'var(--wp--preset--color--verde-primario)';
			selectedLink.style.color = 'white';

// Pulisci input personalizzato
			if (customAmountInput) {
				customAmountInput.value = '';
			}
		});
	});

// Gestione importo personalizzato
	if (customAmountInput) {
		customAmountInput.addEventListener('input', function() {
			if (this.value) {
// Deseleziona tutti i bottoni predefiniti
				donationAmountBtns.forEach(btn => {
					btn.classList.remove('selected');
					const link = btn.querySelector('.wp-block-button__link');
					link.style.backgroundColor = 'var(--wp--preset--color--light)';
					link.style.color = 'var(--wp--preset--color--dark)';
				});
			}
		});
	}

// Gestione selezione metodo pagamento
	const paymentMethodBtns = document.querySelectorAll('.payment-method-btn');

	paymentMethodBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();

// Rimuovi selezione precedente
			paymentMethodBtns.forEach(b => b.classList.remove('selected'));

// Aggiungi selezione corrente
			this.classList.add('selected');

// Visual feedback
			this.style.transform = 'scale(1.05)';
			setTimeout(() => {
				this.style.transform = 'scale(1)';
			}, 150);
		});
	});

// Gestione bottone procedi donazione
	const proceedDonationBtn = document.getElementById('proceed-donation');

	if (proceedDonationBtn) {
		proceedDonationBtn.addEventListener('click', function(e) {
			e.preventDefault();

// Raccogli dati donazione
			const selectedAmount = document.querySelector('.donation-amount-btn.selected');
			const customAmount = customAmountInput ? customAmountInput.value : '';
			const selectedProject = document.getElementById('project-select')?.value || '';
			const selectedPayment = document.querySelector('.payment-method-btn.selected');

// Validazione
			if (!selectedAmount && !customAmount) {
				alert('Seleziona un importo per la donazione');
				return;
			}

			if (!selectedPayment) {
				alert('Seleziona un metodo di pagamento');
				return;
			}

// Determina importo finale
			let finalAmount = customAmount || selectedAmount?.dataset.amount || '0';

// Qui normalmente procederesti con il gateway di pagamento
			console.log('Donazione:', {
				amount: finalAmount,
				project: selectedProject,
				method: selectedPayment.dataset.method
			});

// Per ora, mostra un messaggio
			alert(`Donazione di €${finalAmount} in corso di elaborazione...`);
		});
	}

// ====================================
// PROJECT ARCHIVE FILTERS
// ====================================

// Gestione filtri progetti
	const filterBtns = document.querySelectorAll('.filter-btn');
	const projectCards = document.querySelectorAll('.project-card');

	filterBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();

// Rimuovi classe active da tutti i filtri
			filterBtns.forEach(b => {
				b.classList.remove('active');
				const link = b.querySelector('.wp-block-button__link');
				link.style.backgroundColor = 'transparent';
				link.style.color = 'var(--wp--preset--color--verde-primario)';
			});

// Aggiungi classe active al filtro corrente
			this.classList.add('active');
			const activeLink = this.querySelector('.wp-block-button__link');
			activeLink.style.backgroundColor = 'var(--wp--preset--color--verde-primario)';
			activeLink.style.color = 'white';

// Ottieni filtro selezionato
			const filter = this.querySelector('a').dataset.filter;

// Filtra progetti (simulazione - normalmente useresti AJAX)
			projectCards.forEach(card => {
				if (filter === 'all') {
					card.style.display = 'block';
					card.style.animation = 'fadeIn 0.3s ease';
				} else {
// Qui implementeresti la logica di filtro basata sui dati
// Per ora mostriamo tutti i progetti
					card.style.display = 'block';
				}
			});
		});
	});

// ====================================
// EVENT REGISTRATION
// ====================================

// Gestione iscrizione eventi
	const eventRegisterBtns = document.querySelectorAll('[href*="Iscriviti"]');

	eventRegisterBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();

// Simula processo di iscrizione
			const originalText = this.textContent;
			this.textContent = 'Iscrizione in corso...';
			this.style.backgroundColor = '#6b7280';

			setTimeout(() => {
				this.textContent = '✓ Iscritto!';
				this.style.backgroundColor = '#22c55e';

				setTimeout(() => {
					this.textContent = originalText;
					this.style.backgroundColor = '';
				}, 3000);
			}, 1500);
		});
	});

// ====================================
// CONTACT FORM ENHANCEMENTS
// ====================================

// Aggiungi validazione personalizzata ai form
	const contactForms = document.querySelectorAll('form');

	contactForms.forEach(form => {
		form.addEventListener('submit', function(e) {
			const requiredFields = form.querySelectorAll('[required]');
			let allValid = true;

			requiredFields.forEach(field => {
				if (!field.value.trim()) {
					field.style.borderColor = '#ef4444';
					allValid = false;
				} else {
					field.style.borderColor = '#22c55e';
				}
			});

			if (!allValid) {
				e.preventDefault();

// Scroll al primo campo non valido
				const firstInvalid = form.querySelector('[style*="border-color: rgb(239, 68, 68)"]');
				if (firstInvalid) {
					firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
					firstInvalid.focus();
				}
			}
		});
	});

// ====================================
// UTILITIES
// ====================================

// Animazione fade in per elementi
	const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.style.opacity = '1';
				entry.target.style.transform = 'translateY(0)';
			}
		});
	});

// Applica animazione a carte e sezioni
	document.querySelectorAll('.project-card, .wp-block-group').forEach(el => {
		el.style.opacity = '0';
		el.style.transform = 'translateY(20px)';
		el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
		observer.observe(el);
	});
});

// CSS Animations
const style = document.createElement('style');
style.textContent = `
@keyframes fadeIn {
from { opacity: 0; transform: translateY(20px); }
to { opacity: 1; transform: translateY(0); }
}

.donation-amount-btn, .payment-method-btn, .filter-btn {
transition: all 0.2s ease;
}

.donation-amount-btn:hover, .payment-method-btn:hover, .filter-btn:hover {
transform: translateY(-2px);
box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.project-card {
transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.project-card:hover {
transform: translateY(-4px);
box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}
`;
document.head.appendChild(style);