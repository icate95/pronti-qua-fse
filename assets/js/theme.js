// Main theme JavaScript
document.addEventListener('DOMContentLoaded', function() {
	console.log('Pronti Qua Theme Loaded');

	// Smooth scrolling for anchor links
	const anchorLinks = document.querySelectorAll('a[href^="#"]');
	anchorLinks.forEach(link => {
		link.addEventListener('click', function(e) {
			e.preventDefault();
			const target = document.querySelector(this.getAttribute('href'));
			if (target) {
				target.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		});
	});

	// Back to top button
	const backToTop = document.createElement('button');
	backToTop.innerHTML = '↑';
	backToTop.className = 'back-to-top';
	backToTop.setAttribute('aria-label', 'Torna su');
	document.body.appendChild(backToTop);

	window.addEventListener('scroll', function() {
		if (window.pageYOffset > 300) {
			backToTop.classList.add('visible');
		} else {
			backToTop.classList.remove('visible');
		}
	});

	backToTop.addEventListener('click', function() {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});
});