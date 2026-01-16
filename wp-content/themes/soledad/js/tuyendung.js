jQuery(document).ready(function ($) {

    $('.accordion-collapse').on('show.bs.collapse', function () {

        var accordionItem = $(this).closest('.accordion-item');


        accordionItem.addClass('bg-gray-900');
    });

    $('.accordion-collapse').on('hide.bs.collapse', function () {

        var accordionItem = $(this).closest('.accordion-item');

        accordionItem.removeClass('bg-gray-900 ');
    });

});

const NEPTUNE_UI = {
    /**
     * Module: Khởi tạo Tabs/Content Switcher Tái Sử Dụng
     * @param {Object} options - Cấu hình selectors và logic
     */
    setupTabs: function(options = {}) {
        // 1. Cấu hình mặc định (Dựa trên class cũ của Oniichan)
        const defaults = {
            // Container bao quanh MỘT nhóm tabs
            wrapperSelector: '.tab-pane', 
            
            // Khu vực hiển thị nội dung lớn (Featured)
            featuredSelector: '.cut-the-top-left-corner-09-featured-container',
            
            // Các item nhỏ để bấm vào
            itemSelector: '.item.cut-the-top-left-corner-09-container',

            // Các thành phần con cần lấy dữ liệu (Icon, Title, Desc)
            // Neptune dùng object để gom nhóm cho gọn
            elements: {
                icon: '.icons-container',
                title: '.tlc-title',
                desc: '.tlc-description'
            },

            // Class CSS để style trạng thái Active (đang chọn)
            activeClasses: ['active', 'border-blue-500', 'bg-blue-50'],

            // Logic: Chỉ hoạt động dưới breakpoint này? (Mặc định 1280 như cũ)
            // Nếu muốn chạy trên mọi màn hình thì set là 99999
            mobileBreakpoint: 1280
        };

        // 2. Merge Config
        const config = { ...defaults, ...options };

        // 3. Tìm tất cả các wrapper (Vì một trang có thể có nhiều khu vực tabs)
        const tabWrappers = document.querySelectorAll(config.wrapperSelector);

        if (tabWrappers.length === 0) {
            console.warn(`Neptune: ⚠️ Không tìm thấy wrapper nào khớp với "${config.wrapperSelector}"`);
            return;
        }

        // 4. Duyệt qua từng wrapper để khởi tạo logic riêng biệt
        tabWrappers.forEach((wrapper, index) => {
            const featuredContainer = wrapper.querySelector(config.featuredSelector);
            const items = wrapper.querySelectorAll(config.itemSelector);

            // Validate nhẹ cái
            if (!featuredContainer || items.length === 0) {
                console.warn(`Neptune: Bỏ qua wrapper thứ ${index} vì thiếu Featured hoặc Items.`);
                return;
            }

            // Cache các element đích trong Featured Container để đỡ phải query lại nhiều lần
            const targetElements = {
                icon: featuredContainer.querySelector(config.elements.icon),
                title: featuredContainer.querySelector(config.elements.title),
                desc: featuredContainer.querySelector(config.elements.desc)
            };

            // 5. Gắn sự kiện cho từng Item
            items.forEach(item => {
                item.addEventListener('click', () => {
                    // Check Breakpoint (Logic cũ của Oniichan)
                    if (window.innerWidth >= config.mobileBreakpoint) {
                        return; // Nếu màn hình to hơn quy định thì không làm gì cả
                    }

                    // --- A. Lấy dữ liệu từ Item vừa bấm ---
                    const source = {
                        icon: item.querySelector(config.elements.icon),
                        title: item.querySelector(config.elements.title),
                        desc: item.querySelector(config.elements.desc)
                    };

                    // --- B. Copy nội dung sang Featured Container ---
                    // (Chỉ copy nếu cả nguồn và đích đều tồn tại)
                    if (source.icon && targetElements.icon) 
                        targetElements.icon.innerHTML = source.icon.innerHTML;
                    
                    if (source.title && targetElements.title) 
                        targetElements.title.innerHTML = source.title.innerHTML;
                    
                    if (source.desc && targetElements.desc) 
                        targetElements.desc.innerHTML = source.desc.innerHTML;

                    // --- C. Hiển thị Featured Container (nếu nó đang ẩn) ---
                    featuredContainer.style.display = 'flex';
                    featuredContainer.classList.remove('hidden');

                    // --- D. Xử lý Active Class ---
                    // Xóa class active ở TẤT CẢ items trong wrapper này
                    items.forEach(i => {
                        if (config.activeClasses.length > 0) {
                            i.classList.remove(...config.activeClasses);
                        }
                    });

                    // Thêm class active cho item ĐƯỢC CHỌN
                    if (config.activeClasses.length > 0) {
                        item.classList.add(...config.activeClasses);
                    }
                });
            });
        });

        console.log(`Neptune: Đã khởi tạo ${tabWrappers.length} cụm Tabs thành công! 📂`);
    },

    /**
     * Module: Khởi tạo Slider "Tự Giác"
     * @param {Object} options - Chứa selectors, cấu hình slider VÀ trạng thái
     */
    setupSlider: function(options = {}) {
        // 1. Cấu hình mặc định (Bao gồm cả Selectors, Settings và State)
        const defaults = {
            // --- SELECTORS ---
            sliderSelector: '#stnd-slider-wrapper', 
            dotsSelector: '#dotsContainer',
            itemSelector: '.slider-item',

            // --- SETTINGS (Cài đặt) ---
            sliderBreakpoint: 1280,
            autoplay: true,
            autoplaySpeed: 5000,
            resumeDelay: 5000,

            // --- STATE (Trạng thái chạy - Mặc định ban đầu) ---
            
            autoplayInterval: null,
            resumeTimeout: null,
            isDown: false,
            startX: 0,
            scrollLeft: 0
        };

        // 2. Merge config: Tạo ra một object "Quyền lực" chứa tất cả
        const config = { ...defaults, ...options };

        // 3. Tự đi tìm Elements
        const sliderWrapper = document.querySelector(config.sliderSelector);
        const dotsWrapper = document.querySelector(config.dotsSelector);
        
        if (!sliderWrapper || !dotsWrapper) {
            console.warn(`Neptune: ⚠️ Không tìm thấy Slider (${config.sliderSelector}) hoặc Dots (${config.dotsSelector})!`);
            return;
        }

        const slideItems = sliderWrapper.querySelectorAll(config.itemSelector);
        
        if (slideItems.length === 0) {
            console.warn(`Neptune: ⚠️ Có khung nhưng không có item nào class là "${config.itemSelector}"!`);
            return;
        }

        // --- LOGIC XỬ LÝ (Dùng trực tiếp biến config) ---

        // Helpers
        const isSliderMode = () => window.innerWidth < config.sliderBreakpoint;

        // Logic Autoplay
        const stopAutoplay = () => {
            if (config.autoplayInterval) {
                clearInterval(config.autoplayInterval);
                config.autoplayInterval = null; // Cập nhật trực tiếp vào config
            }
        };

        const nextSlide = () => {
            if (!isSliderMode()) {
                stopAutoplay();
                return;
            }
            
            const currentScroll = sliderWrapper.scrollLeft;
            const itemWidth = slideItems[0].offsetWidth + 16; // + gap
            
            let nextIndex = Math.round(currentScroll / itemWidth) + 1;
            if (nextIndex >= slideItems.length) nextIndex = 0;

            sliderWrapper.scrollTo({
                left: nextIndex * itemWidth,
                behavior: 'smooth'
            });
        };

        const startAutoplay = () => {
            if (!isSliderMode() || !config.autoplay) {
                stopAutoplay();
                return;
            }
            stopAutoplay();
            // Gán interval ID vào config
            config.autoplayInterval = setInterval(nextSlide, config.autoplaySpeed);
        };

        const pauseAndResume = () => {
            if (!config.autoplay) return;
            stopAutoplay();
            clearTimeout(config.resumeTimeout);
            // Gán timeout ID vào config
            config.resumeTimeout = setTimeout(startAutoplay, config.resumeDelay);
        };

        // Logic Dots
        const updateDots = () => {
            if (!isSliderMode()) return;

            const dots = dotsWrapper.querySelectorAll('.dot');
            const itemWidth = slideItems[0].offsetWidth + 16;
            const activeIndex = Math.round(sliderWrapper.scrollLeft / itemWidth);

            dots.forEach((dot, index) => {
                if (index === activeIndex) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        };

        const createDots = () => {
            if (!isSliderMode()) {
                dotsWrapper.innerHTML = '';
                dotsWrapper.style.display = 'none';
                stopAutoplay();
                return;
            }

            dotsWrapper.innerHTML = '';
            dotsWrapper.style.display = 'flex';

            slideItems.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'dot transition-transform duration-400 ease-out';
                dot.dataset.index = index;
                
                dot.addEventListener('click', () => {
                    const itemWidth = slideItems[0].offsetWidth + 16;
                    sliderWrapper.scrollTo({
                        left: index * itemWidth,
                        behavior: 'smooth'
                    });
                    pauseAndResume();
                });
                
                dotsWrapper.appendChild(dot);
            });

            updateDots();
            startAutoplay();
        };

        // Logic Drag Scroll (Sử dụng config thay vì state)
        const handleMouseDown = (e) => {
            if (!isSliderMode()) return;
            config.isDown = true; // Update config
            sliderWrapper.classList.add('is-dragging');
            sliderWrapper.classList.remove('scroll-smooth');
            
            config.startX = e.pageX - sliderWrapper.offsetLeft; // Update config
            config.scrollLeft = sliderWrapper.scrollLeft;       // Update config
            
            pauseAndResume();
        };

        const handleMouseLeave = () => {
            if (!config.isDown) return;
            config.isDown = false;
            sliderWrapper.classList.remove('is-dragging');
            sliderWrapper.classList.add('scroll-smooth');
        };

        const handleMouseUp = () => {
            config.isDown = false;
            sliderWrapper.classList.remove('is-dragging');
            sliderWrapper.classList.add('scroll-smooth');
        };

        const handleMouseMove = (e) => {
            if (!config.isDown || !isSliderMode()) return;
            e.preventDefault();
            const x = e.pageX - sliderWrapper.offsetLeft;
            const walk = (x - config.startX) * 2; // Tốc độ kéo
            sliderWrapper.scrollLeft = config.scrollLeft - walk;
        };

        // Gắn Event Listeners
        sliderWrapper.addEventListener('scroll', updateDots);
        sliderWrapper.addEventListener('mousedown', handleMouseDown);
        sliderWrapper.addEventListener('mouseleave', handleMouseLeave);
        sliderWrapper.addEventListener('mouseup', handleMouseUp);
        sliderWrapper.addEventListener('mousemove', handleMouseMove);
        window.addEventListener('resize', createDots);
        
        // Kích hoạt
        createDots(); 

        console.log(`Neptune: Slider [${config.sliderSelector}] đã sẵn sàng chiến đấu! ⚔️`);
    }
};

document.addEventListener('DOMContentLoaded', function() {
    
    NEPTUNE_UI.setupSlider({
        sliderBreakpoint: 3000,
        autoplay: true,
        autoplaySpeed: 5000
    });

     NEPTUNE_UI.setupTabs({
        
        featuredSelector: '.cut-the-top-left-corner-09-01-featured-container',
        itemSelector: '.item.cut-the-top-left-corner-09-01-container',

    });
});