const NEPTUNE_UI = {
            
    // Cấu hình chung
    config: {
        sliderBreakpoint: 1280,      // Điểm gãy để chuyển chế độ slider/grid
        autoplay: true,              // Bật/tắt tự động chạy
        autoplaySpeed: 5000,         // Tốc độ chuyển slide (ms)
        resumeDelay: 5000            // Thời gian chờ sau khi tương tác (ms)
    },

    /**
     * Khởi tạo tất cả các module
     */
    init: function() {
        this.initTabs();
        this.initSlider();
        // this.initAutoHover();
    },

    /**
     * Module: Xử lý Tabs và nội dung chi tiết
     */
    initTabs: function() {
        const tabPanes = document.querySelectorAll('.tab-pane');

        console.log("initTabs -> Running Neptune Logic 🔱");
            if (tabPanes.length === 0) return;

        tabPanes.forEach((pane) => {
            const featuredContainer = pane.querySelector('.cut-the-top-left-corner-09-featured-container');
            // Lấy danh sách items (Neptune đã gom vào biến cho gọn)
            const items = pane.querySelectorAll('.item.cut-the-top-left-corner-09-container');

            if (!featuredContainer || items.length === 0) return;

            // --- 1. SETUP MẶC ĐỊNH (Khi mới tải trang) ---
            // Logic: Vào Desktop thì item đầu sáng kiểu Hover, vào Mobile thì item đầu sáng kiểu Active + hiện nội dung
            if (window.innerWidth >= this.config.sliderBreakpoint) {
                // DESKTOP: Add class giả hover
                items[0].classList.add('is-hover');
            } else {
                // MOBILE: Add class active & Load nội dung ngay lập tức
                items[0].classList.add('active', 'border-blue-500', 'bg-blue-50');

                // Copy nội dung từ item đầu tiên sang container hiển thị
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

            // --- 2. GẮN SỰ KIỆN (Event Listeners) ---
            items.forEach(item => {
                
                // --- A. DESKTOP: FAKE HOVER ---
                item.addEventListener('mouseenter', () => {
                    if (window.innerWidth >= this.config.sliderBreakpoint) {
                        // Xóa is-hover ở thằng cũ
                        const currentHover = pane.querySelector('.item.cut-the-top-left-corner-09-container.is-hover');
                        if (currentHover) currentHover.classList.remove('is-hover');
                        
                        // Thêm is-hover cho thằng mới
                        item.classList.add('is-hover');
                    }
                });

                // --- B. MOBILE: CLICK & ACTIVE ---
                item.addEventListener('click', () => {
                    // Chỉ thực thi khi màn hình nhỏ hơn breakpoint (Mobile/Tablet)
                    if (window.innerWidth < this.config.sliderBreakpoint) {
                        const source = {
                            icon: item.querySelector('.icons-container'),
                            title: item.querySelector('.tlc-title'),
                            desc: item.querySelector('.tlc-description')
                        };
                        
                        // Lấy lại elements đích (để đảm bảo scope)
                        const elements = {
                            icon: featuredContainer.querySelector('.icons-container'),
                            title: featuredContainer.querySelector('.tlc-title'),
                            desc: featuredContainer.querySelector('.tlc-description')
                        };

                        // Copy nội dung
                        if (source.icon && elements.icon) elements.icon.innerHTML = source.icon.innerHTML;
                        if (source.title && elements.title) elements.title.innerHTML = source.title.innerHTML;
                        if (source.desc && elements.desc) elements.desc.innerHTML = source.desc.innerHTML;

                        // Hiển thị container
                        featuredContainer.style.display = 'flex';
                        featuredContainer.classList.remove('hidden');

                        // Cập nhật trạng thái active (Reset hết rồi active thằng được click)
                        items.forEach(i => i.classList.remove('active', 'border-blue-500', 'bg-blue-50'));
                        item.classList.add('active', 'border-blue-500', 'bg-blue-50');
                    }
                });
            });
        });
    },
    /**
     * Module: Tự động active/hover
     */
    initAutoHover: function() {
        console.log("Neptune: Kích hoạt module Auto Hover/Active...");
        
        const targetClass = '.cut-the-top-left-corner-09-container';
        const hoverClass = 'is-hover'; // Class cho Desktop
        const activeClasses = ['active', 'border-blue-500', 'bg-blue-50']; // Classes cho Mobile
        const intervalTime = 5000;

        const elements = document.querySelectorAll(targetClass);
        if (elements.length === 0) return;

        let currentIndex = 0;

        const activateHover = () => {
            const currentItem = elements[currentIndex];
            const isMobile = window.innerWidth < this.config.sliderBreakpoint;

            // 1. DỌN DẸP: Xóa sạch cả 2 loại class ở TẤT CẢ phần tử
            elements.forEach(el => {
                el.classList.remove(hoverClass);
                el.classList.remove(...activeClasses);
            });

            if (currentItem) {
                if (isMobile) {
                    // --- LOGIC MOBILE (< 1280px) ---
                    // Áp dụng logic của initTabs: Add active class
                    currentItem.classList.add(...activeClasses);
                    console.log(`Mobile Logic: Active item ${currentIndex + 1}`);

                    // Logic update Featured Container (Copy từ initTabs)
                    // Tìm cha là .tab-pane gần nhất
                    const pane = currentItem.closest('.tab-pane');
                    if (pane) {
                        const featuredContainer = pane.querySelector('.cut-the-top-left-corner-09-featured-container');
                        if (featuredContainer) {
                            const source = {
                                icon: currentItem.querySelector('.icons-container'),
                                title: currentItem.querySelector('.tlc-title'),
                                desc: currentItem.querySelector('.tlc-description')
                            };
                            const target = {
                                icon: featuredContainer.querySelector('.icons-container'),
                                title: featuredContainer.querySelector('.tlc-title'),
                                desc: featuredContainer.querySelector('.tlc-description')
                            };

                            // Copy dữ liệu an toàn (kiểm tra tồn tại)
                            if (source.icon && target.icon) target.icon.innerHTML = source.icon.innerHTML;
                            if (source.title && target.title) target.title.innerHTML = source.title.innerHTML;
                            if (source.desc && target.desc) target.desc.innerHTML = source.desc.innerHTML;

                            // Hiển thị box
                            featuredContainer.style.display = 'flex';
                            featuredContainer.classList.remove('hidden');
                        }
                    }

                } else {
                    // --- LOGIC DESKTOP (>= 1280px) ---
                    // Logic cũ: Add is-hover class
                    currentItem.classList.add(hoverClass);
                    console.log(`Desktop Logic: Hover item ${currentIndex + 1}`);
                }
            }

            // Tăng index
            currentIndex++;
            if (currentIndex >= elements.length) {
                currentIndex = 0;
            }
        };

        // Chạy ngay
        activateHover();

        // Lặp lại
        setInterval(activateHover, intervalTime);
    },
    /**
     * Module: Xử lý Slider (Dots, Autoplay, Drag)
     */
    initSlider: function() {
        const slider = document.getElementById('stnd-slider-wrapper');
        const dotsContainer = document.getElementById('dotsContainer');
        
        if (!slider || !dotsContainer) return;

        const items = slider.querySelectorAll('.slider-item');
        if (items.length === 0) return;

        // Trạng thái nội bộ của Slider
        const state = {
            autoplayInterval: null,
            resumeTimeout: null,
            isDown: false,
            startX: 0,
            scrollLeft: 0
        };

        // Helpers
        const isSliderMode = () => window.innerWidth < this.config.sliderBreakpoint;

        // --- Logic Autoplay ---
        const stopAutoplay = () => {
            if (state.autoplayInterval) {
                clearInterval(state.autoplayInterval);
                state.autoplayInterval = null;
            }
        };

        const startAutoplay = () => {
            if (!isSliderMode() || !this.config.autoplay) {
                stopAutoplay();
                return;
            }
            stopAutoplay();
            state.autoplayInterval = setInterval(nextSlide, this.config.autoplaySpeed);
        };

        const pauseAndResume = () => {
            if (!this.config.autoplay) return;
            stopAutoplay();
            clearTimeout(state.resumeTimeout);
            state.resumeTimeout = setTimeout(startAutoplay, this.config.resumeDelay);
        };

        const nextSlide = () => {
            if (!isSliderMode()) {
                stopAutoplay();
                return;
            }
            
            const currentScroll = slider.scrollLeft;
            // Tính width item + gap (16px của gap-4)
            // offsetWidth sẽ lấy kích thước thực tế (đã là 50% trên mobile)
            const itemWidth = items[0].offsetWidth + 16;
            
            let nextIndex = Math.round(currentScroll / itemWidth) + 1;
            if (nextIndex >= items.length) nextIndex = 0;

            slider.scrollTo({
                left: nextIndex * itemWidth,
                behavior: 'smooth'
            });
        };

        // --- Logic Dots ---
        const createDots = () => {
            if (!isSliderMode()) {
                dotsContainer.innerHTML = '';
                dotsContainer.style.display = 'none';
                stopAutoplay();
                return;
            }

            dotsContainer.innerHTML = '';
            dotsContainer.style.display = 'flex';

            items.forEach((_, index) => {
                const dot = document.createElement('div');
                // Thêm class Tailwind cho transition
                dot.className = 'dot transition-transform duration-400 ease-out';
                dot.dataset.index = index;
                
                dot.addEventListener('click', () => {
                    const itemWidth = items[0].offsetWidth + 16;
                    slider.scrollTo({
                        left: index * itemWidth,
                        behavior: 'smooth'
                    });
                    pauseAndResume();
                });
                
                dotsContainer.appendChild(dot);
            });

            updateDots();
            startAutoplay();
        };

        const updateDots = () => {
            if (!isSliderMode()) return;

            const dots = dotsContainer.querySelectorAll('.dot');
            const itemWidth = items[0].offsetWidth + 16;
            const activeIndex = Math.round(slider.scrollLeft / itemWidth);

            dots.forEach((dot, index) => {
                if (index === activeIndex) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        };

        // --- Logic Drag Scroll ---
        const handleMouseDown = (e) => {
            if (!isSliderMode()) return;
            state.isDown = true;
            slider.classList.add('is-dragging');
            slider.classList.remove('scroll-smooth'); // Tắt smooth để kéo mượt hơn
            state.startX = e.pageX - slider.offsetLeft;
            state.scrollLeft = slider.scrollLeft;
            pauseAndResume();
        };

        const handleMouseLeave = () => {
            if (!state.isDown) return;
            state.isDown = false;
            slider.classList.remove('is-dragging');
            slider.classList.add('scroll-smooth');
        };

        const handleMouseUp = () => {
            state.isDown = false;
            slider.classList.remove('is-dragging');
            slider.classList.add('scroll-smooth');
        };

        const handleMouseMove = (e) => {
            if (!state.isDown || !isSliderMode()) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - state.startX) * 2; // Tốc độ kéo
            slider.scrollLeft = state.scrollLeft - walk;
        };

        // --- Event Listeners ---
        slider.addEventListener('scroll', updateDots);
        slider.addEventListener('mousedown', handleMouseDown);
        slider.addEventListener('mouseleave', handleMouseLeave);
        slider.addEventListener('mouseup', handleMouseUp);
        slider.addEventListener('mousemove', handleMouseMove);

        // Window Events
        window.addEventListener('resize', createDots);
        window.addEventListener('load', createDots);

        // Khởi tạo lần đầu
        createDots();
    }
};

// --- Main Execution ---
document.addEventListener('DOMContentLoaded', () => {
    NEPTUNE_UI.init();
});