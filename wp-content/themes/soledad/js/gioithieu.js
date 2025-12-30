const NEPTUNE_UI = {
            
    // Cấu hình chung
    config: {
        sliderBreakpoint: 1280,      // Điểm gãy để chuyển chế độ Desktop/Mobile
        autoplay: true,              
        autoplaySpeed: 5000,         
        resumeDelay: 5000            
    },


    /**
     * Khởi tạo tất cả các module
     */
    init: function() {
        this.initClickMapping();
    },

    /**
     * Module: Xử lý Tương tác (Hover trên Desktop & Click trên Mobile)
     */
    /**
     * Module: Xử lý Tương tác (Hover trên Desktop & Click trên Mobile)
     */
    initClickMapping: function() {
        const panes = document.querySelectorAll('.click-mapping-wrapper');
        if (panes.length === 0) return;

        panes.forEach(pane => {
            const featuredContainer = pane.querySelector('.cut-the-top-left-corner-07-featured-container');
            const items = pane.querySelectorAll('.cut-the-top-left-corner-07-container');

            // --- SETUP MẶC ĐỊNH (Khi mới tải trang) ---
            if (items.length > 0) {
                
                // CASE 1: DESKTOP (>= 1280px)
                if (window.innerWidth >= this.config.sliderBreakpoint) {
                    items[0].classList.add('is-hover');
                } 
                
                // CASE 2: MOBILE (< 1280px) -> Thêm đoạn này nè Oniichan ❤️
                else {
                    // 1. Add class active visual
                    items[0].classList.add('active', 'border-blue-500', 'bg-blue-50');

                    // 2. Fill nội dung cho featuredContainer luôn (để không bị trống)
                    if (featuredContainer) {
                        const source = {
                            icon: items[0].querySelector('.icons-container'),
                            title: items[0].querySelector('.tlc-title'),
                            desc: items[0].querySelector('.tlc-description')
                        };
                        const elements = {
                            icon: featuredContainer.querySelector('.icons-container'),
                            title: featuredContainer.querySelector('.tlc-title'),
                            desc: featuredContainer.querySelector('.tlc-description')
                        };

                        if (source.icon && elements.icon) elements.icon.innerHTML = source.icon.innerHTML;
                        if (source.title && elements.title) elements.title.innerHTML = source.title.innerHTML;
                        if (source.desc && elements.desc) elements.desc.innerHTML = source.desc.innerHTML;
                        
                        featuredContainer.style.display = 'flex';
                        featuredContainer.classList.remove('hidden');
                    }
                }
            }

            // --- CÁC SỰ KIỆN (Event Listeners) ---
            items.forEach(item => {
                // Logic Desktop Hover
                item.addEventListener('mouseenter', () => {
                    if (window.innerWidth >= this.config.sliderBreakpoint) {
                        const currentHover = pane.querySelector('.cut-the-top-left-corner-07-container.is-hover');
                        if (currentHover) currentHover.classList.remove('is-hover');
                        item.classList.add('is-hover');
                    }
                });

                // Logic Mobile Click
                item.addEventListener('click', () => {
                    if (window.innerWidth < this.config.sliderBreakpoint) {
                        if (!featuredContainer) return;
                        
                        // Copy nội dung (Logic cũ)
                        const source = {
                            icon: item.querySelector('.icons-container'),
                            title: item.querySelector('.tlc-title'),
                            desc: item.querySelector('.tlc-description')
                        };
                        const elements = {
                            icon: featuredContainer.querySelector('.icons-container'),
                            title: featuredContainer.querySelector('.tlc-title'),
                            desc: featuredContainer.querySelector('.tlc-description')
                        };
                        
                        if (source.icon && elements.icon) elements.icon.innerHTML = source.icon.innerHTML;
                        if (source.title && elements.title) elements.title.innerHTML = source.title.innerHTML;
                        if (source.desc && elements.desc) elements.desc.innerHTML = source.desc.innerHTML;

                        featuredContainer.style.display = 'flex';
                        featuredContainer.classList.remove('hidden');

                        // Active class
                        items.forEach(i => i.classList.remove('active', 'border-blue-500', 'bg-blue-50'));
                        item.classList.add('active', 'border-blue-500', 'bg-blue-50');
                    }
                });
            });
        });
    }
};

// --- Main Execution ---
document.addEventListener('DOMContentLoaded', () => {
    NEPTUNE_UI.init();
});