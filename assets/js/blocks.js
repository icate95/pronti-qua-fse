document.addEventListener('DOMContentLoaded', function() {
    // Animazione contatori impatto
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                animateCounter(counter);
                observer.unobserve(counter);
            }
        });
    }, observerOptions);

    // Osserva tutti i contatori
    document.querySelectorAll('.impact-number[data-target]').forEach(counter => {
        observer.observe(counter);
    });

    // Funzione animazione contatore
    function animateCounter(element) {
        const target = parseInt(element.dataset.target);
        const duration = parseInt(element.dataset.duration) || 2000;
        const suffix = element.dataset.suffix || '';
        const start = 0;
        const startTime = performance.now();

        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function (ease-out)
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(start + (target - start) * easeProgress);

            element.textContent = current.toLocaleString() + suffix;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString() + suffix;
            }
        }

        requestAnimationFrame(updateCounter);
    }

    // Funzionalità copia codice 5x1000
    document.querySelectorAll('.codice-copy-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const codice = this.dataset.copyText || this.parentElement.querySelector('.codice-number').textContent;

            // Copia negli appunti
            if (navigator.clipboard) {
                navigator.clipboard.writeText(codice).then(() => {
                    showCopySuccess(this);
                });
            } else {
                // Fallback per browser più vecchi
                const textArea = document.createElement('textarea');
                textArea.value = codice;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showCopySuccess(this);
            }
        });
    });

    function showCopySuccess(button) {
        const originalText = button.textContent;
        button.classList.add('copied');
        button.textContent = '✓ Copiato!';

        setTimeout(() => {
            button.classList.remove('copied');
            button.textContent = originalText;
        }, 2000);
    }

    // Chiusura alert dismissibili
    document.querySelectorAll('.alert-close').forEach(closeBtn => {
        closeBtn.addEventListener('click', function() {
            const alertBanner = this.closest('.pronti-qua-alert-banner');

            alertBanner.style.animation = 'slideUp 0.3s ease-out forwards';

            setTimeout(() => {
                alertBanner.remove();
            }, 300);
        });
    });

    // Progress bar animation on scroll
    const progressBars = document.querySelectorAll('.progress-bar-fill');

    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.style.width;

                progressBar.style.width = '0%';

                setTimeout(() => {
                    progressBar.style.width = width;
                }, 100);

                progressObserver.unobserve(progressBar);
            }
        });
    }, { threshold: 0.3 });

    progressBars.forEach(bar => {
        progressObserver.observe(bar);
    });
});

// CSS per animazioni
const style = document.createElement('style');
style.textContent = `
    @keyframes slideUp {
        to {
            opacity: 0;
            transform: translateY(-20px);
            max-height: 0;
            margin: 0;
            padding: 0;
        }
    }
    
    .impact-number {
        transition: transform 0.3s ease;
    }
    
    .progress-bar-fill {
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
`;
document.head.appendChild(style);

// Funzionalità copia codice 5x1000 (migliorata)
document.addEventListener('DOMContentLoaded', function() {

    // Funzione per gestire la copia del codice fiscale
    function initializeCopyButtons() {
        document.querySelectorAll('.codice-copy-btn').forEach(button => {
            // Rimuovi eventuali listener esistenti
            button.removeEventListener('click', handleCopyClick);
            // Aggiungi il nuovo listener
            button.addEventListener('click', handleCopyClick);
        });
    }

    async function handleCopyClick(e) {
        e.preventDefault();

        const button = e.currentTarget;
        const codice = button.dataset.copyText ||
            button.parentElement.querySelector('.codice-number').textContent.trim();

        try {
            // Tenta di usare l'API Clipboard moderna
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(codice);
                showCopySuccess(button, 'Copiato!');
            } else {
                // Fallback per browser più vecchi o contesti non sicuri
                const textArea = document.createElement('textarea');
                textArea.value = codice;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    showCopySuccess(button, 'Copiato!');
                } catch (err) {
                    showCopyError(button, 'Errore nella copia');
                }

                document.body.removeChild(textArea);
            }

            // Analytics tracking (opzionale)
            if (typeof gtag !== 'undefined') {
                gtag('event', 'copy_codice_fiscale', {
                    'event_category': 'engagement',
                    'event_label': '5x1000'
                });
            }

        } catch (err) {
            console.error('Errore nella copia:', err);
            showCopyError(button, 'Errore nella copia');
        }
    }

    function showCopySuccess(button, message) {
        const originalText = button.textContent;
        const originalBg = button.style.backgroundColor;

        // Stato di successo
        button.classList.add('copied');
        button.textContent = `✓ ${message}`;
        button.style.backgroundColor = '#22c55e';

        // Vibrazione su dispositivi mobili (se supportata)
        if (navigator.vibrate) {
            navigator.vibrate(100);
        }

        // Ripristina dopo 2.5 secondi
        setTimeout(() => {
            button.classList.remove('copied');
            button.textContent = originalText;
            button.style.backgroundColor = originalBg;
        }, 2500);
    }

    function showCopyError(button, message) {
        const originalText = button.textContent;
        const originalBg = button.style.backgroundColor;

        // Stato di errore
        button.style.backgroundColor = '#ef4444';
        button.textContent = `❌ ${message}`;

        // Ripristina dopo 2 secondi
        setTimeout(() => {
            button.textContent = originalText;
            button.style.backgroundColor = originalBg;
        }, 2000);
    }

    // Inizializza i pulsanti al caricamento
    initializeCopyButtons();

    // Reinizializza quando vengono aggiunti nuovi blocchi (per editor)
    if (typeof wp !== 'undefined' && wp.data) {
        wp.data.subscribe(() => {
            // Delay per permettere al DOM di aggiornarsi
            setTimeout(initializeCopyButtons, 100);
        });
    }

    // Gestione keyboard per accessibilità
    document.addEventListener('keydown', function(e) {
        if (e.target.classList.contains('codice-copy-btn')) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                e.target.click();
            }
        }
    });

    // Auto-selezione del codice quando si clicca sul numero
    document.querySelectorAll('.codice-number').forEach(codeElement => {
        codeElement.addEventListener('click', function() {
            if (window.getSelection && document.createRange) {
                const selection = window.getSelection();
                const range = document.createRange();
                range.selectNodeContents(this);
                selection.removeAllRanges();
                selection.addRange(range);
            }
        });

        // Tooltip al hover
        codeElement.setAttribute('title', 'Clicca per selezionare il codice');
    });
});