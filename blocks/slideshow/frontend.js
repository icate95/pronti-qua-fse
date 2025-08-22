/**
 * Frontend JavaScript for Pronti Qua Slideshow Block
 */

console.log('frontend . js')

document.addEventListener('DOMContentLoaded', function() {
	// Initialize all slideshows on the page
	const slideshows = document.querySelectorAll('.pronti-qua-slideshow .slideshow-container');

	slideshows.forEach(initializeSlideshow);
});

function initializeSlideshow(container) {
	const slides = container.querySelectorAll('.slide');
	const indicators = container.querySelectorAll('.slideshow-indicators .indicator');
	const autoplay = container.dataset.autoplay === 'true';
	const interval = parseInt(container.dataset.interval) || 4000;
	const showIndicators = container.dataset.showIndicators === 'true';

	let currentSlide = 0;
	let slideInterval;

	// Don't initialize if there's only one slide or no slides
	if (slides.length <= 1) {
		return;
	}

	function showSlide(index) {
		// Validate index
		if (index < 0 || index >= slides.length) {
			return;
		}

		// Hide all slides
		slides.forEach(slide => {
			slide.style.opacity = '0';
			slide.classList.remove('active');
		});

		// Show current slide
		slides[index].style.opacity = '1';
		slides[index].classList.add('active');

		// Update indicators if they exist
		if (showIndicators && indicators.length > 0) {
			indicators.forEach((indicator, i) => {
				if (i === index) {
					indicator.style.background = 'var(--wp--preset--color--verde-primario)';
					indicator.classList.add('active');
				} else {
					indicator.style.background = 'rgba(111,138,43,0.3)';
					indicator.classList.remove('active');
				}
			});
		}

		currentSlide = index;
	}

	function nextSlide() {
		const next = (currentSlide + 1) % slides.length;
		showSlide(next);
	}

	function previousSlide() {
		const prev = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
		showSlide(prev);
	}

	function startAutoplay() {
		if (autoplay && slides.length > 1) {
			slideInterval = setInterval(nextSlide, interval);
		}
	}

	function stopAutoplay() {
		if (slideInterval) {
			clearInterval(slideInterval);
			slideInterval = null;
		}
	}

	function restartAutoplay() {
		stopAutoplay();
		startAutoplay();
	}

	// Initialize first slide
	showSlide(0);

	// Start autoplay if enabled
	startAutoplay();

	// Add click handlers for indicators
	if (showIndicators && indicators.length > 0) {
		indicators.forEach((indicator, index) => {
			indicator.addEventListener('click', () => {
				showSlide(index);
				restartAutoplay(); // Restart autoplay after manual interaction
			});

			// Add hover effect
			indicator.addEventListener('mouseenter', () => {
				if (!indicator.classList.contains('active')) {
					indicator.style.background = 'var(--wp--preset--color--verde-primario)';
					indicator.style.transform = 'scale(1.3)';
				}
			});

			indicator.addEventListener('mouseleave', () => {
				if (!indicator.classList.contains('active')) {
					indicator.style.background = 'rgba(111,138,43,0.3)';
					indicator.style.transform = 'scale(1)';
				}
			});
		});
	}

	// Pause autoplay on hover (better UX)
	container.addEventListener('mouseenter', stopAutoplay);
	container.addEventListener('mouseleave', startAutoplay);

	// Keyboard navigation
	container.setAttribute('tabindex', '0');
	container.addEventListener('keydown', (e) => {
		switch(e.key) {
			case 'ArrowLeft':
				e.preventDefault();
				previousSlide();
				restartAutoplay();
				break;
			case 'ArrowRight':
				e.preventDefault();
				nextSlide();
				restartAutoplay();
				break;
			case ' ': // Spacebar
				e.preventDefault();
				if (slideInterval) {
					stopAutoplay();
				} else {
					startAutoplay();
				}
				break;
		}
	});

	// Touch/swipe support for mobile
	let touchStartX = 0;
	let touchEndX = 0;

	container.addEventListener('touchstart', (e) => {
		touchStartX = e.changedTouches[0].screenX;
	});

	container.addEventListener('touchend', (e) => {
		touchEndX = e.changedTouches[0].screenX;
		handleSwipe();
	});

	function handleSwipe() {
		const swipeThreshold = 50;
		const diff = touchStartX - touchEndX;

		if (Math.abs(diff) > swipeThreshold) {
			if (diff > 0) {
				// Swipe left - next slide
				nextSlide();
			} else {
				// Swipe right - previous slide
				previousSlide();
			}
			restartAutoplay();
		}
	}

	// Pause autoplay when page is not visible (performance optimization)
	document.addEventListener('visibilitychange', () => {
		if (document.hidden) {
			stopAutoplay();
		} else if (autoplay) {
			startAutoplay();
		}
	});

	// Clean up interval when element is removed (if using dynamic content)
	const observer = new MutationObserver((mutations) => {
		mutations.forEach((mutation) => {
			mutation.removedNodes.forEach((node) => {
				if (node.contains && node.contains(container)) {
					stopAutoplay();
					observer.disconnect();
				}
			});
		});
	});

	observer.observe(document.body, {
		childList: true,
		subtree: true
	});
}