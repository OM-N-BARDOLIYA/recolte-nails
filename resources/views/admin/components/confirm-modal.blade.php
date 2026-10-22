<!-- ── LUXURY ATELIER CMS CONFIRMATION MODAL ── -->
<div 
    x-data="cmsConfirmModal()" 
    x-show="isOpen" 
    x-cloak
    @keydown.escape.window="close()"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;"
    role="dialog"
    aria-modal="true"
>
    <!-- Dark Backdrop with subtle blur -->
    <div 
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-[#171412]/60 backdrop-blur-xs transition-opacity"
        @click="close()"
    ></div>

    <!-- Modal Box -->
    <div 
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        class="relative w-full max-w-md bg-white border border-[#ECE6DE] shadow-2xl p-6 sm:p-7 space-y-5 rounded-none z-10"
    >
        <!-- Top Tag / Badge -->
        <div class="flex items-center justify-between border-b border-[#ECE6DE] pb-3">
            <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.2em] text-[#8C7A6B]">
                <span class="text-[#A33B47]">✦</span>
                <span x-text="tagText">Atelier Action Confirmation</span>
            </div>
            <button 
                type="button" 
                @click="close()"
                class="text-[#8C7A6B] hover:text-[#171412] text-sm p-1 transition-colors cursor-pointer"
                title="Cancel"
            >
                ✕
            </button>
        </div>

        <!-- Content Area -->
        <div class="flex items-start gap-4">
            <!-- Icon -->
            <div 
                class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 border"
                :class="{
                    'bg-rose-50 text-[#A33B47] border-rose-200': type === 'danger',
                    'bg-amber-50 text-amber-700 border-amber-200': type === 'warning',
                    'bg-[#FAF8F5] text-[#171412] border-[#ECE6DE]': type === 'info'
                }"
            >
                <template x-if="type === 'danger'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </template>
                <template x-if="type === 'warning'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </template>
                <template x-if="type === 'info'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </template>
            </div>

            <!-- Text Content -->
            <div class="space-y-1.5 flex-1 min-w-0">
                <h3 class="font-serif text-base sm:text-lg font-bold text-[#171412] leading-snug" x-text="title">Confirm Action</h3>
                <p class="text-xs sm:text-[12.5px] text-[#6A625A] font-light leading-relaxed break-words" x-text="message">Are you sure you want to proceed with this action?</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-3 border-t border-[#ECE6DE] flex items-center justify-end gap-2.5">
            <button 
                type="button" 
                @click="close()"
                class="px-4 py-2 bg-white hover:bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE] text-xs font-bold uppercase tracking-wider transition-all cursor-pointer"
                x-text="cancelText"
            >
                Cancel
            </button>
            <button 
                type="button" 
                @click="confirmAction()"
                class="px-5 py-2 text-white text-xs font-bold uppercase tracking-wider transition-all shadow-xs cursor-pointer"
                :class="{
                    'bg-[#A33B47] hover:bg-[#882F3A]': type === 'danger',
                    'bg-amber-600 hover:bg-amber-700': type === 'warning',
                    'bg-[#171412] hover:bg-black': type === 'info'
                }"
                x-text="confirmText"
            >
                Confirm
            </button>
        </div>
    </div>
</div>

<script>
function cmsConfirmModal() {
    return {
        isOpen: false,
        title: 'Confirm Action',
        message: 'Are you sure you want to proceed?',
        confirmText: 'Confirm',
        cancelText: 'Cancel',
        tagText: 'Atelier Action Confirmation',
        type: 'danger',
        onConfirmCallback: null,

        init() {
            // Global helper method
            window.confirmModal = (options) => {
                this.title = options.title || 'Confirm Action';
                this.message = options.message || 'Are you sure you want to proceed?';
                this.confirmText = options.confirmText || (options.type === 'danger' ? 'Yes, Delete' : 'Confirm');
                this.cancelText = options.cancelText || 'Cancel';
                this.tagText = options.tagText || 'Atelier Action Confirmation';
                this.type = options.type || 'danger';
                this.onConfirmCallback = options.onConfirm || null;
                this.isOpen = true;
            };

            // Global interception for forms with data-confirm
            document.addEventListener('submit', (e) => {
                const form = e.target;
                if (form && form.hasAttribute('data-confirm')) {
                    if (form._confirmedByModal) {
                        form._confirmedByModal = false;
                        return; // Let it submit
                    }
                    e.preventDefault();
                    e.stopPropagation();
                    window.confirmModal({
                        title: form.getAttribute('data-confirm-title') || 'Confirm Deletion',
                        message: form.getAttribute('data-confirm') || 'Are you sure you want to delete this item?',
                        confirmText: form.getAttribute('data-confirm-btn') || 'Yes, Delete',
                        type: 'danger',
                        onConfirm: () => {
                            form._confirmedByModal = true;
                            form.submit();
                        }
                    });
                }
            }, true);
        },

        close() {
            this.isOpen = false;
            this.onConfirmCallback = null;
        },

        confirmAction() {
            const cb = this.onConfirmCallback;
            this.close();
            if (typeof cb === 'function') {
                cb();
            }
        }
    };
}
</script>
