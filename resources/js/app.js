import Alpine from 'alpinejs';
import Lenis from 'lenis';
import 'lenis/dist/lenis.css';

// ── 1. LUXURY BUTTERY-SMOOTH INERTIA SCROLLING (LENIS) ──
const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 1,
    touchMultiplier: 1.5,
    infinite: false,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);
window.lenis = lenis;

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

// ── 3. GLOBAL ALPINE CART STORE ──
document.addEventListener('alpine:init', () => {
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
            
            let message = '✨ *HAUTE NAIL MULTI-ITEM ORDER | RÉCOLTE NAILS* ✨\n\n';
            message += 'Hello Récolte Nails Studio! 🌸\n';
            message += `I would like to place an order for the following ${this.totalCount} item(s) in my bag:\n\n`;
            message += '────────────────────────\n';

            this.items.forEach((item, idx) => {
                const itemSubtotal = ((item.price || 0) * item.quantity).toLocaleString('en-IN');
                message += `${idx + 1}️⃣ *${item.title}*\n`;
                if (item.shade) message += `   • Shade: ${item.shade}\n`;
                if (item.size) message += `   • Size / Volume: ${item.size}\n`;
                message += `   • Qty: ${item.quantity} × ₹${Number(item.price).toLocaleString('en-IN')} = ₹${itemSubtotal}\n`;
                if (item.image) message += `   • Photo: ${item.image}\n`;
                message += '\n';
            });

            message += '────────────────────────\n';
            message += `💵 *TOTAL ESTIMATED AMOUNT:* ₹${this.subtotal.toLocaleString('en-IN')}\n\n`;
            message += 'Please confirm order availability, custom sizing, and dispatch timeline. Thank you! 💕';

            return 'https://wa.me/917016266727?text=' + encodeURIComponent(message);
        }
    });
});

window.Alpine = Alpine;
Alpine.start();
