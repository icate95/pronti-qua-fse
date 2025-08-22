/**
 * Frontend JavaScript for Pronti Qua Slideshow Block
 */


document.addEventListener('DOMContentLoaded', function() {
	console.log('frontend.js loaded')
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
	let isTransitioning = false;

	// Don't initialize if there's only one slide or no slides
	if (slides.length <= 1) {
		if (slides.length === 1) {
			slides[0].classList.add('active');
		}
		return;
	}

	function showSlide(index, direction = 'next') {
		// Validate index
		if (index < 0 || index >= slides.length || isTransitioning) {
			return;
		}

		isTransitioning = true;

		// Hide all slides
		slides.forEach(slide => {
			slide.style.opacity = '0';
			slide.classList.remove('active');
		});

		// Show current slide with a small delay for smooth transition
		setTimeout(() => {
			slides[index].style.opacity = '1';
			slides[index].classList.add('active');

			// Update indicators if they exist
			if (showIndicators && indicators.length > 0) {
				indicators.forEach((indicator, i) => {
					if (i === index) {
						indicator.classList.add('active');
						indicator.style.background = 'white';
					} else {
						indicator.classList.remove('active');
						indicator.style.background = 'rgba(255,255,255,0.4)';
					}
				});
			}

			currentSlide = index;
			isTransitioning = false;
		}, 50);
	}

	function nextSlide() {
		const next = (currentSlide + 1) % slides.length;
		showSlide(next, 'next');
	}

	function previousSlide() {
		const prev = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
		showSlide(prev, 'prev');
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
		setTimeout(startAutoplay, 100); // Small delay to prevent conflicts
	}

	// Initialize first slide
	showSlide(0);

	// Start autoplay if enabled
	startAutoplay();

	// Add click handlers for indicators
	if (showIndicators && indicators.length > 0) {
		indicators.forEach((indicator, index) => {
			indicator.addEventListener('click', (e) => {
				e.preventDefault();
				if (index !== currentSlide) {
					showSlide(index);
					restartAutoplay();
				}
			});

			// Add hover effect
			indicator.addEventListener('mouseenter', () => {
				if (!indicator.classList.contains('active')) {
					indicator.style.background = 'rgba(255,255,255,0.8)';
					indicator.style.transform = 'scale(1.2)';
				}
			});

			indicator.addEventListener('mouseleave', () => {
				if (!indicator.classList.contains('active')) {
					indicator.style.background = 'rgba(255,255,255,0.4)';
					indicator.style.transform = 'scale(1)';
				}
			});

			// Accessibility
			indicator.setAttribute('role', 'button');
			indicator.setAttribute('aria-label', `Vai alla slide ${index + 1}`);
			indicator.setAttribute('tabindex', '0');
		});
	}

	// Pause autoplay on hover (better UX)
	container.addEventListener('mouseenter', stopAutoplay);
	container.addEventListener('mouseleave', () => {
		if (autoplay) startAutoplay();
	});

	// Keyboard navigation
	container.setAttribute('tabindex', '0');
	container.setAttribute('role', 'region');
	container.setAttribute('aria-label', 'Slideshow');

	container.addEventListener('keydown', (e) => {
		switch(e.key) {
			case 'ArrowLeft':
			case 'ArrowUp':
				e.preventDefault();
				previousSlide();
				restartAutoplay();
				break;
			case 'ArrowRight':
			case 'ArrowDown':
				e.preventDefault();
				nextSlide();
				restartAutoplay();
				break;
			case ' ': // Spacebar
			case 'Enter':
				e.preventDefault();
				if (slideInterval) {
					stopAutoplay();
					// Visual feedback that autoplay is paused
					container.style.opacity = '0.8';
					setTimeout(() => {
						container.style.opacity = '1';
					}, 200);
				} else {
					startAutoplay();
				}
				break;
			case 'Home':
				e.preventDefault();
				showSlide(0);
				restartAutoplay();
				break;
			case 'End':
				e.preventDefault();
				showSlide(slides.length - 1);
				restartAutoplay();
				break;
		}
	});

	// Touch/swipe support for mobile
	let touchStartX = 0;
	let touchEndX = 0;
	let touchStartY = 0;
	let touchEndY = 0;

	container.addEventListener('touchstart', (e) => {
		touchStartX = e.changedTouches[0].screenX;
		touchStartY = e.changedTouches[0].screenY;
	}, { passive: true });

	container.addEventListener('touchend', (e) => {
		touchEndX = e.changedTouches[0].screenX;
		touchEndY = e.changedTouches[0].screenY;
		handleSwipe();
	}, { passive: true });

	function handleSwipe() {
		const swipeThreshold = 50;
		const diffX = touchStartX - touchEndX;
		const diffY = Math.abs(touchStartY - touchEndY);

		// Only handle horizontal swipes (not vertical scrolling)
		if (Math.abs(diffX) > swipeThreshold && diffY < 100) {
			if (diffX > 0) {
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

	// Handle window focus/blur for better performance
	window.addEventListener('blur', stopAutoplay);
	window.addEventListener('focus', () => {
		if (autoplay) startAutoplay();
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

	// Preload next slide images for smoother transitions
	function preloadImages() {
		slides.forEach((slide, index) => {
			const bgImage = slide.style.backgroundImage;
			if (bgImage && bgImage !== 'none') {
				const img = new Image();
				const url = bgImage.slice(4, -1).replace(/"/g, "");
				img.src = url;
			}
		});
	}

	preloadImages();

	// Add loading class removal after initialization
	container.classList.remove('loading');
}