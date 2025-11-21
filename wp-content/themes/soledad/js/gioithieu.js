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
        this.initClickMapping();
        
    },
    /**
     * Module: Xử lý Click Mapping và nội dung chi tiết
     */
    initClickMapping: function() {
        // 1. Lấy danh sách (đặt tên biến số nhiều cho rõ nghĩa)
        const panes = document.querySelectorAll('.click-mapping-wrapper');
        
        // Nếu không có phần tử nào thì dừng
        if (panes.length === 0) return;

        // 2. Duyệt qua từng phần tử trong danh sách
        panes.forEach(pane => {
            
            // Bây giờ 'pane' là một Element cụ thể, nên có thể dùng querySelector
            const featuredContainer = pane.querySelector('.cut-the-top-left-corner-07-featured-container');
            if (!featuredContainer) return; // Trong vòng lặp forEach dùng return để skip qua item lỗi này

            const elements = {
                icon: featuredContainer.querySelector('.icons-container'),
                title: featuredContainer.querySelector('.tlc-title'),
                desc: featuredContainer.querySelector('.tlc-description'),
                items: pane.querySelectorAll('.item.cut-the-top-left-corner-07-container')
            };

            elements.items.forEach(item => {
                item.addEventListener('click', () => {
                    // Đảm bảo 'this' ở đây trỏ đúng vào NEPTUNE_UI nhờ arrow function, 
                    // hoặc dùng NEPTUNE_UI.config nếu context bị thay đổi.
                    // Nhưng trong object literal thì arrow function ở cấp này an toàn.
                    if (window.innerWidth < this.config.sliderBreakpoint) {
                        const source = {
                            icon: item.querySelector('.icons-container'),
                            title: item.querySelector('.tlc-title'),
                            desc: item.querySelector('.tlc-description')
                        };

                        // Copy nội dung
                        if (source.icon && elements.icon) elements.icon.innerHTML = source.icon.innerHTML;
                        if (source.title && elements.title) elements.title.innerHTML = source.title.innerHTML;
                        if (source.desc && elements.desc) elements.desc.innerHTML = source.desc.innerHTML;

                        // Hiển thị container
                        featuredContainer.style.display = 'flex';
                        featuredContainer.classList.remove('hidden');

                        // Cập nhật trạng thái active
                        elements.items.forEach(i => i.classList.remove('active', 'border-blue-500', 'bg-blue-50'));
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