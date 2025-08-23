/**
 * JavaScript per gestire scroll mobile su singolo container
 */

document.addEventListener('DOMContentLoaded', function() {

	// Solo su mobile
	if (window.innerWidth <= 768) {
		initMobileScroll();
	}

	// Re-inizializza al resize
	window.addEventListener('resize', function() {
		if (window.innerWidth <= 768) {
			initMobileScroll();
		} else {
			removeMobileScroll();
		}
	});

	function initMobileScroll() {
		const scrollContainers = document.querySelectorAll('.projects-grid-desktop, .events-grid-desktop');

		scrollContainers.forEach(container => {
			addScrollIndicators(container);
			addTouchSupport(container);
		});
	}

	function removeMobileScroll() {
		// Rimuovi indicatori su desktop
		const indicators = document.querySelectorAll('.scroll-indicator');
		indicators.forEach(indicator => indicator.remove());
	}

	function addScrollIndicators(container) {
		const wrapper = container.parentElement;

		// Evita duplicati
		if (wrapper.querySelector('.scroll-indicator')) return;

		// Crea indicatori
		const leftIndicator = document.createElement('div');
		leftIndicator.className = 'scroll-indicator scroll-left hidden';
		leftIndicator.innerHTML = '←';
		leftIndicator.setAttribute('aria-label', 'Scorri a sinistra');

		const rightIndicator = document.createElement('div');
		rightIndicator.className = 'scroll-indicator scroll-right';
		rightIndicator.innerHTML = '→';
		rightIndicator.setAttribute('aria-label', 'Scorri a destra');

		wrapper.appendChild(leftIndicator);
		wrapper.appendChild(rightIndicator);

		// Aggiorna visibilità indicatori
		const updateIndicators = () => {
			const { scrollLeft, scrollWidth, clientWidth } = container;

			if (scrollLeft > 10) {
				leftIndicator.classList.remove('hidden');
			} else {
				leftIndicator.classList.add('hidden');
			}

			if (scrollLeft < scrollWidth - clientWidth - 10) {
				rightIndicator.classList.remove('hidden');
			} else {
				rightIndicator.classList.add('hidden');
			}
		};

		container.addEventListener('scroll', updateIndicators);
		updateIndicators();

		// Click handlers
		leftIndicator.addEventListener('click', () => {
			container.scrollBy({ left: -300, behavior: 'smooth' });
		});

		rightIndicator.addEventListener('click', () => {
			container.scrollBy({ left: 300, behavior: 'smooth' });
		});
	}

	function addTouchSupport(container) {
		let startX = 0;
		let scrollLeft = 0;
		let isDown = false;

		container.addEventListener('touchstart', (e) => {
			isDown = true;
			startX = e.touches[0].pageX - container.offsetLeft;
			scrollLeft = container.scrollLeft;
		});

		container.addEventListener('touchmove', (e) => {
			if (!isDown) return;
			e.preventDefault();
			const x = e.touches[0].pageX - container.offsetLeft;
			const walk = (x - startX) * 2;
			container.scrollLeft = scrollLeft - walk;
		});

		container.addEventListener('touchend', () => {
			isDown = false;
		});
	}
});