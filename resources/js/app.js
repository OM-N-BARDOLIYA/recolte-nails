import Alpine from 'alpinejs';
import Lenis from 'lenis';
import 'lenis/dist/lenis.css';

// ── 1. LUXURY BUTTERY-SMOOTH INERTIA SCROLLING (LENIS) ──
const lenis = new Lenis({
    duration: 1.25,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 0.95,
    touchMultiplier: 1.2,
    infinite: false,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);
window.lenis = lenis;

// Realtime Luxury Scroll Progress Bar Tracker
lenis.on('scroll', (e) => {
    const progressBar = document.getElementById('scroll-progress-bar');
    if (progressBar) {
        const progress = Math.min(100, Math.max(0, (e.progress || 0) * 100));
        progressBar.style.width = `${progress}%`;
        progressBar.style.opacity = progress > 0.5 ? '1' : '0';
    }
});

// ── 2. PERFECT SHIFT + MOUSEWHEEL HORIZONTAL SCROLLING ──
// Allows instant horizontal scrolling when Shift is held over horizontal containers, tabs, tables & carousels
document.addEventListener('wheel', (e) => {
    if (e.shiftKey) {
        let el = e.target;
        while (el && el !== document.body && el !== document.documentElement) {
            if (el.scrollWidth > el.clientWidth) {
                const maxScrollLeft = el.scrollWidth - el.clientWidth;
                if (maxScrollLeft > 0) {
                    el.scrollLeft += (e.deltaY || e.deltaX);
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
            }
            el = el.parentElement;
        }
    }
}, { passive: false });

// ── 3. GLOBAL ALPINE CART & SEARCH STORES ──
document.addEventListener('alpine:init', () => {
    Alpine.store('search', {
        isOpen: false,
        open() {
            this.isOpen = true;
        },
        close() {
            this.isOpen = false;
        },
        toggle() {
            this.isOpen = !this.isOpen;
        }
    });

    Alpine.store('cart', {
        items: JSON.parse(localStorage.getItem('recolte_cart') || '[]'),
        isOpen: false,
        toastMessage: '',
        toastVisible: false,

        save() {
            try {
                localStorage.setItem('recolte_cart', JSON.stringify(this.items));
            } catch (e) {
                console.error('Error saving cart to localStorage:', e);
            }
        },

        addItem(product) {
            const qty = Math.max(1, parseInt(product.quantity) || 1);
            const shade = product.shade ? String(product.shade).trim() : '';
            const size = product.size ? String(product.size).trim() : '';

            const existingIndex = this.items.findIndex(item =>
                String(item.id) === String(product.id) &&
                item.shade === shade &&
                item.size === size
            );

            if (existingIndex > -1) {
                this.items[existingIndex].quantity += qty;
            } else {
                this.items.push({
                    id: product.id,
                    title: product.title,
                    slug: product.slug || '',
                    price: parseFloat(product.price) || 0,
                    original_price: parseFloat(product.original_price) || parseFloat(product.price) || 0,
                    image: product.image || '',
                    shade: shade,
                    size: size,
                    quantity: qty
                });
            }

            this.save();
            this.showToast(`Added "${product.title}" to Bag`);
            this.isOpen = true;
        },

        removeItem(index) {
            if (index >= 0 && index < this.items.length) {
                const title = this.items[index].title;
                this.items.splice(index, 1);
                this.save();
                this.showToast(`Removed "${title}" from Bag`);
            }
        },

        updateQuantity(index, delta) {
            if (!this.items[index]) return;
            const newQty = this.items[index].quantity + delta;
            if (newQty <= 0) {
                this.removeItem(index);
            } else {
                this.items[index].quantity = newQty;
                this.save();
            }
        },

        clearCart() {
            this.items = [];
            this.save();
            this.showToast('Bag has been cleared');
        },

        get totalCount() {
            return this.items.reduce((sum, item) => sum + (parseInt(item.quantity) || 0), 0);
        },

        get subtotal() {
            return this.items.reduce((sum, item) => sum + ((parseFloat(item.price) || 0) * (parseInt(item.quantity) || 0)), 0);
        },

        get subtotalOriginal() {
            return this.items.reduce((sum, item) => sum + ((parseFloat(item.original_price) || parseFloat(item.price) || 0) * (parseInt(item.quantity) || 0)), 0);
        },

        showToast(msg) {
            this.toastMessage = msg;
            this.toastVisible = true;
            if (this._toastTimer) clearTimeout(this._toastTimer);
            this._toastTimer = setTimeout(() => {
                this.toastVisible = false;
            }, 3200);
        },

        getWhatsAppUrl() {
            if (this.items.length === 0) return '#';

            let message = '✨ *HAUTE NAIL MULTI-ITEM ORDER | RECOLTE NAILS* ✨\n\n';
            message += 'Hello Recolte Nails Studio! 🌸\n';
            message += `I would like to place an order for the following ${this.totalCount} item(s) in my bag:\n\n`;
            message += '────────────────────────\n';

            this.items.forEach((item, idx) => {
                message += `${idx + 1}️⃣ *${item.title}*\n`;
                if (item.shade) message += `   • Shade: ${item.shade}\n`;
                if (item.size) message += `   • Size / Volume: ${item.size}\n`;
                message += `   • Qty: ${item.quantity}\n`;
                if (item.image) message += `   • Photo: ${item.image}\n`;
                message += '\n';
            });

            message += '────────────────────────\n';
            message += `📦 *TOTAL ITEMS:* ${this.totalCount}\n\n`;
            message += 'Please confirm order availability, custom sizing, and dispatch timeline. Thank you! 💕';

            return 'https://wa.me/917016266727?text=' + encodeURIComponent(message);
        }
    });

    // ── 4. LENIS & BODY SCROLL LOCK FOR CART DRAWER & SEARCH MODAL ──
    // Stop Lenis from intercepting scroll events when drawer or search modal is open
    Alpine.effect(() => {
        const isCartOpen = Alpine.store('cart')?.isOpen;
        const isSearchOpen = Alpine.store('search')?.isOpen;
        if (isCartOpen || isSearchOpen) {
            window.lenis?.stop();
            document.body.classList.add('overflow-hidden');
        } else {
            window.lenis?.start();
            document.body.classList.remove('overflow-hidden');
        }
    });

    // Global keyboard shortcut (Ctrl+K or Cmd+K) to toggle search
    window.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            Alpine.store('search')?.toggle();
        }
    });
});

// ── 5. INTELLIGENT LUXURY TEXT & ELEMENT SCROLL REVEAL ENGINE ──
function initScrollAnimations() {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                obs.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.08
    });

    // 1. Observe any manually tagged elements
    document.querySelectorAll('.scroll-reveal, .scroll-reveal-text, .scroll-reveal-card, .scroll-reveal-left, .scroll-reveal-right').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top <= window.innerHeight * 0.9) {
            el.classList.add('is-revealed');
        } else {
            observer.observe(el);
        }
    });

    // 2. Automatically discover and animate headings, lead text, product cards, features, and grid items
    const textSelectors = [
        'main h1:not(.no-anim)',
        'main h2:not(.no-anim)',
        'main h3:not(.no-anim)',
        'main h4:not(.no-anim)',
        'main .section-header',
        'main .section-title',
        'main .section-subtitle'
    ];

    document.querySelectorAll(textSelectors.join(', ')).forEach(el => {
        // Skip hero slider slide titles to avoid interfering with slider transitions
        if (el.closest('.hero-slider, [x-data*="heroSlides"], header, footer')) return;

        const rect = el.getBoundingClientRect();
        if (rect.top <= window.innerHeight * 0.88) {
            el.classList.add('is-revealed');
        } else {
            el.classList.add('scroll-reveal-text');
            observer.observe(el);
        }
    });

    // 3. Automatically animate product cards, trust items, categories, and testimonial cards with cascading stagger
    const cardContainers = document.querySelectorAll(
        '.grid, [class*="grid-cols-"], .divide-y, .divide-x'
    );

    cardContainers.forEach(container => {
        if (container.closest('.hero-slider, [x-data*="heroSlides"], header')) return;

        const cards = Array.from(container.children).filter(child => {
            return child.matches('div, a, article') && 
                   !child.matches('style, script, template') &&
                   child.offsetWidth > 60 && child.offsetHeight > 40;
        });

        cards.forEach((card, idx) => {
            const rect = card.getBoundingClientRect();
            if (rect.top <= window.innerHeight * 0.88) {
                card.classList.add('is-revealed');
            } else {
                card.classList.add('scroll-reveal-card');
                // Apply cascading stagger delay up to 6 items per row
                const delayIndex = (idx % 6) + 1;
                card.classList.add(`delay-${delayIndex}`);
                observer.observe(card);
            }
        });
    });

    // 4. Also observe key content sections
    document.querySelectorAll('main section:not(.hero-section, .no-anim)').forEach(sec => {
        const rect = sec.getBoundingClientRect();
        if (rect.top > window.innerHeight * 0.9) {
            if (!sec.classList.contains('scroll-reveal')) {
                sec.classList.add('scroll-reveal');
                observer.observe(sec);
            }
        } else {
            sec.classList.add('is-revealed');
        }
    });
}

// Initialize on DOM load and after navigation/tab changes
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollAnimations);
} else {
    initScrollAnimations();
}

window.addEventListener('reinit-scroll-animations', initScrollAnimations);

window.Alpine = Alpine;
Alpine.start();

