<!-- ── ULTRA-CLEAN LUXURY ATELIER CMS FLOATING TOASTER ── -->
<style>
@keyframes toastShrink {
    from { width: 100%; }
    to { width: 0%; }
}
.toast-progress-bar {
    animation: toastShrink 4.2s cubic-bezier(0.25, 1, 0.5, 1) forwards;
}
.toast-card:hover .toast-progress-bar {
    animation-play-state: paused;
}
</style>

<div 
    x-data="cmsToaster()"
    class="fixed top-6 right-6 z-50 flex flex-col gap-3 max-w-sm sm:max-w-md w-full pointer-events-none"
    role="region"
    aria-label="Notifications"
>
    <template x-for="t in toasts" :key="t.id">
        <div 
            x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-400 transform"
            x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-[cubic-bezier(0.4,0,0.2,1)] duration-250 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-x-0"
            x-transition:leave-end="opacity-0 scale-95 translate-x-6"
            @mouseenter="pauseToast(t)"
            @mouseleave="resumeToast(t)"
            class="toast-card pointer-events-auto relative overflow-hidden bg-white/98 backdrop-blur-md text-[#171412] p-4 pr-3.5 border border-[#E5DFD7] shadow-[0_16px_40px_-6px_rgba(23,20,18,0.12),0_2px_8px_rgba(0,0,0,0.03)] flex items-start gap-3.5 group cursor-default transition-all"
            role="alert"
        >
            <!-- Refined Circular Status Icon Badge -->
            <div class="shrink-0 mt-0.5">
                <template x-if="t.type === 'success'">
                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200/80 flex items-center justify-center shadow-2xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                    </div>
                </template>
                <template x-if="t.type === 'error'">
                    <div class="w-8 h-8 rounded-full bg-rose-50 text-[#A33B47] border border-rose-200/80 flex items-center justify-center shadow-2xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </template>
                <template x-if="t.type === 'warning'">
                    <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-600 border border-amber-200/80 flex items-center justify-center shadow-2xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                </template>
                <template x-if="t.type === 'info'">
                    <div class="w-8 h-8 rounded-full bg-[#FAF8F5] text-[#8C7A6B] border border-[#ECE6DE] flex items-center justify-center shadow-2xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                </template>
            </div>

            <!-- Toast Content Body -->
            <div class="flex-grow min-w-0 pr-1">
                <div class="flex items-center gap-2 mb-0.5">
                    <span 
                        class="text-[10px] font-bold uppercase tracking-[0.2em]"
                        :class="{
                            'text-emerald-700': t.type === 'success',
                            'text-[#A33B47]': t.type === 'error',
                            'text-amber-700': t.type === 'warning',
                            'text-[#8C7A6B]': t.type === 'info'
                        }"
                        x-text="t.title"
                    ></span>
                </div>
                <p class="text-[12.5px] text-[#2C2723] font-medium leading-snug break-words" x-text="t.message"></p>
            </div>

            <!-- Clean Minimal Dismiss Button -->
            <button 
                type="button" 
                @click="removeToast(t.id)"
                class="shrink-0 w-6 h-6 rounded-full flex items-center justify-center text-[#A89F97] hover:text-[#171412] hover:bg-stone-100 transition-all cursor-pointer -mr-1 -mt-0.5"
                aria-label="Dismiss notification"
            >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Ultra-Smooth Animated Hardware-Accelerated Progress Line -->
            <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-stone-100 overflow-hidden">
                <div 
                    class="h-full toast-progress-bar"
                    :class="{
                        'bg-emerald-500': t.type === 'success',
                        'bg-[#A33B47]': t.type === 'error',
                        'bg-amber-500': t.type === 'warning',
                        'bg-[#C5A880]': t.type === 'info'
                    }"
                ></div>
            </div>
        </div>
    </template>
</div>

<script>
function cmsToaster() {
    return {
        toasts: [],
        init() {
            // Register global JS helper functions
            window.showToast = (message, type = 'success', title = '') => {
                this.pushToast(message, type, title);
            };
            window.toast = window.showToast;

            // Global CustomEvent listener
            window.addEventListener('cms-toast', (e) => {
                const detail = e.detail || {};
                const message = detail.message || '';
                const type = detail.type || 'success';
                const title = detail.title || '';
                if (message) this.pushToast(message, type, title);
            });

            // Server-flashed session messages from Laravel controllers
            @if(session('success'))
                this.pushToast(@json(session('success')), 'success', 'Saved Successfully');
            @endif
            @if(session('error'))
                this.pushToast(@json(session('error')), 'error', 'Action Failed');
            @endif
            @if(session('status'))
                this.pushToast(@json(session('status')), 'info', 'Notice');
            @endif
            @if(session('warning'))
                this.pushToast(@json(session('warning')), 'warning', 'Attention');
            @endif
        },
        pushToast(message, type = 'success', title = '') {
            const id = Date.now() + Math.random();
            const duration = 4200;
            const defaultTitles = {
                success: 'Saved Successfully',
                error: 'Action Failed',
                warning: 'Notice',
                info: 'Studio Notification'
            };
            const toast = {
                id: id,
                message: message,
                type: type,
                title: title || defaultTitles[type] || 'Notification',
                duration: duration,
                timer: null,
                startTime: Date.now(),
                remaining: duration
            };

            // Auto-dismiss timer
            toast.timer = setTimeout(() => {
                this.removeToast(toast.id);
            }, duration);

            this.toasts.push(toast);
        },
        pauseToast(toast) {
            if (toast.timer) {
                clearTimeout(toast.timer);
                toast.timer = null;
                toast.remaining -= (Date.now() - toast.startTime);
            }
        },
        resumeToast(toast) {
            if (!toast.timer && toast.remaining > 0) {
                toast.startTime = Date.now();
                toast.timer = setTimeout(() => {
                    this.removeToast(toast.id);
                }, toast.remaining);
            }
        },
        removeToast(id) {
            const idx = this.toasts.findIndex(t => t.id === id);
            if (idx > -1) {
                if (this.toasts[idx].timer) clearTimeout(this.toasts[idx].timer);
                this.toasts.splice(idx, 1);
            }
        }
    };
}
</script>
