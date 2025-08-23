/**
 * Fixed Header & Navigation JavaScript
 * Handles scroll behavior and mobile menu interactions
 */

document.addEventListener('DOMContentLoaded', function() {

	// ==========================================================================
	// SCROLL DETECTION & HEADER BEHAVIOR
	// ==========================================================================

	const header = document.querySelector('.site-header.fixed-header');
	const body = document.body;
	let lastScrollTop = 0;
	let scrollTimeout;

	if (header) {
		// Update header on scroll
		function handleScroll() {
			const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

			// Add scrolled class when scrolling down
			if (scrollTop > 50) {
				header.classList.add('scrolled');
			} else {
				header.classList.remove('scrolled');
			}

			// Hide header on scroll down, show on scroll up (optional)
			if (window.innerWidth > 768) { // Only on desktop
				if (scrollTop > lastScrollTop && scrollTop > 100) {
					// Scrolling down
					header.style.transform = 'translateY(-100%)';
				} else {
					// Scrolling up
					header.style.transform = 'translateY(0)';
				}
			}

			lastScrollTop = scrollTop;

			// Clear existing timeout
			clearTimeout(scrollTimeout);

			// Set timeout to show header after scroll stops
			scrollTimeout = setTimeout(() => {
				header.style.transform = 'translateY(0)';
			}, 150);
		}

		// Throttled scroll listener for better performance
		let ticking = false;
		window.addEventListener('scroll', function() {
			if (!ticking) {
				// requestAnimationFrame(function() {
				// 	handleScroll();
				// 	ticking = false;
				// });
				// ticking = true;
			}
		});
	}

	// ==========================================================================
	// NAVIGATION MENU ENHANCEMENTS
	// ==========================================================================

	const navigation = document.querySelector('.main-navigation');

	if (navigation) {
		// Enhanced hover effects for dropdown menus
		const menuItemsWithSubmenus = navigation.querySelectorAll('.wp-block-navigation-item.has-child');

		menuItemsWithSubmenus.forEach(menuItem => {
			const submenu = menuItem.querySelector('.wp-block-navigation__submenu-container');
			let hoverTimeout;

			if (submenu) {
				// Show submenu with delay
				menuItem.addEventListener('mouseenter', () => {
					clearTimeout(hoverTimeout);
					submenu.style.display = 'block';
					setTimeout(() => {
						submenu.classList.add('show');
					}, 10);
				});

				// Hide submenu with delay
				menuItem.addEventListener('mouseleave', () => {
					submenu.classList.remove('show');
					hoverTimeout = setTimeout(() => {
						submenu.style.display = 'none';
					}, 300);
				});
			}
		});

		// Keyboard navigation support
		navigation.addEventListener('keydown', function(e) {
			const focusedElement = document.activeElement;
			const menuItems = Array.from(navigation.querySelectorAll('.wp-block-navigation-item__content'));
			const currentIndex = menuItems.indexOf(focusedElement);

			switch(e.key) {
				case 'ArrowRight':
					e.preventDefault();
					if (currentIndex < menuItems.length - 1) {
						menuItems[currentIndex + 1].focus();
					} else {
						menuItems[0].focus(); // Loop to first
					}
					break;

				case 'ArrowLeft':
					e.preventDefault();
					if (currentIndex > 0) {
						menuItems[currentIndex - 1].focus();
					} else {
						menuItems[menuItems.length - 1].focus(); // Loop to last
					}
					break;

				case 'ArrowDown':
					e.preventDefault();
					const submenu = focusedElement.nextElementSibling;
					if (submenu && submenu.classList.contains('wp-block-navigation__submenu-container')) {
						const firstSubmenuItem = submenu.querySelector('.wp-block-navigation-item__content');
						if (firstSubmenuItem) firstSubmenuItem.focus();
					}
					break;

				case 'Escape':
					// Close mobile menu if open
					const mobileMenuContainer = document.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
					if (mobileMenuContainer) {
						const closeButton = mobileMenuContainer.querySelector('.wp-block-navigation__responsive-container-close');
						if (closeButton) closeButton.click();
					}
					break;
			}
		});
	}

	// ==========================================================================
	// MOBILE MENU ENHANCEMENTS
	// ==========================================================================

	const mobileMenuToggle = document.querySelector('.wp-block-navigation__responsive-dialog-button');
	const mobileMenuContainer = document.querySelector('.wp-block-navigation__responsive-container');

	if (mobileMenuToggle && mobileMenuContainer) {
		// Prevent body scroll when mobile menu is open
		const observer = new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
					if (mobileMenuContainer.classList.contains('is-menu-open')) {
						body.classList.add('mobile-menu-open');
						body.style.overflow = 'hidden';
					} else {
						body.classList.remove('mobile-menu-open');
						body.style.overflow = '';
					}
				}
			});
		});

		observer.observe(mobileMenuContainer, {
			attributes: true,
			attributeFilter: ['class']
		});

		// Close mobile menu on outside click
		document.addEventListener('click', function(e) {
			if (mobileMenuContainer.classList.contains('is-menu-open')) {
				if (!mobileMenuContainer.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
					const closeButton = mobileMenuContainer.querySelector('.wp-block-navigation__responsive-container-close');
					if (closeButton) closeButton.click();
				}
			}
		});

		// Close mobile menu on escape key
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && mobileMenuContainer.classList.contains('is-menu-open')) {
				const closeButton = mobileMenuContainer.querySelector('.wp-block-navigation__responsive-container-close');
				if (closeButton) closeButton.click();
			}
		});
	}

	// ==========================================================================
	// DYNAMIC HEADER HEIGHT CALCULATION
	// ==========================================================================

	function updateBodyPaddingTop() {
		if (header) {
			const headerHeight = header.offsetHeight;
			body.style.paddingTop = headerHeight + 'px';
		}
	}

	// Update on load and resize
	updateBodyPaddingTop();
	window.addEventListener('resize', updateBodyPaddingTop);

	// ==========================================================================
	// SMOOTH SCROLL FOR ANCHOR LINKS
	// ==========================================================================

	const anchorLinks = document.querySelectorAll('a[href*="#"]');

	anchorLinks.forEach(link => {
		link.addEventListener('click', function(e) {
			const href = this.getAttribute('href');

			// Check if it's an anchor link on the same page
			if (href.startsWith('#') || href.includes(window.location.pathname + '#')) {
				const targetId = href.split('#')[1];
				const targetElement = document.getElementById(targetId);

				if (targetElement) {
					e.preventDefault();

					const headerOffset = header ? header.offsetHeight + 20 : 80;
					const elementPosition = targetElement.getBoundingClientRect().top;
					const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

					window.scrollTo({
						top: offsetPosition,
						behavior: 'smooth'
					});

					// Update URL
					history.pushState(null, null, '#' + targetId);
				}
			}
		});
	});

	// ==========================================================================
	// LOADING ANIMATION
	// ==========================================================================

	// Add loaded class after slight delay for animations
	setTimeout(() => {
		body.classList.add('header-loaded');
	}, 100);

	// ==========================================================================
	// UTILITY FUNCTIONS
	// ==========================================================================

	// Debounce function for performance
	function debounce(func, wait, immediate) {
		let timeout;
		return function executedFunction() {
			const context = this;
			const args = arguments;
			const later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			const callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	}

	// Throttle function for scroll events
	function throttle(func, limit) {
		let lastFunc;
		let lastRan;
		return function() {
			const context = this;
			const args = arguments;
			if (!lastRan) {
				func.apply(context, args);
				lastRan = Date.now();
			} else {
				clearTimeout(lastFunc);
				lastFunc = setTimeout(function() {
					if ((Date.now() - lastRan) >= limit) {
						func.apply(context, args);
						lastRan = Date.now();
					}
				}, limit - (Date.now() - lastRan));
			}
		};
	}
});

// ==========================================================================
// ADDITIONAL NAVIGATION FEATURES
// ==========================================================================

// Add active class to current page menu item
document.addEventListener('DOMContentLoaded', function() {
	const currentPath = window.location.pathname;
	const menuLinks = document.querySelectorAll('.wp-block-navigation-item__content');

	menuLinks.forEach(link => {
		const linkPath = new URL(link.href, window.location.origin).pathname;
		if (linkPath === currentPath) {
			link.closest('.wp-block-navigation-item').classList.add('current-menu-item');
		}
	});
});