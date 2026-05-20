document.addEventListener("DOMContentLoaded", function () {
    initScrollFadeIn();
    initStickyHeaderAndSidebar();
    initIframeObserver();
});

function initScrollFadeIn() {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.card, .policy-card, .mini-card, .timeline-item, .trust-item').forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });
}

function initStickyHeaderAndSidebar() {
    window.addEventListener('scroll', () => {
        const h = document.querySelector('.header');
        if (h) {
            if (window.scrollY > 60) { h.style.boxShadow = '0 2px 16px rgba(26,45,66,.12)'; }
            else { h.style.boxShadow = 'none'; }
        }

        // Show/hide scroll-to-top
        const sidebar = document.getElementById('float-sidebar');
        if (sidebar) {
            sidebar.style.opacity = window.scrollY > 400 ? '1' : '0';
            sidebar.style.pointerEvents = window.scrollY > 400 ? 'all' : 'none';
            sidebar.style.transition = 'opacity .3s ease';
        }
    });
}

function initIframeObserver() {
    // 1. Nhắm vào phần tử khung chứa iframe trên giao diện
    const iframeContainer = document.getElementById("iframe-container");
    if (!iframeContainer) return;
    
    const targetUrl = "https://360tour.online/NobleTayThangLong/";

    // 2. Kiểm tra xem trình duyệt có hỗ trợ IntersectionObserver không (hầu hết trình duyệt hiện đại đều hỗ trợ)
    if ("IntersectionObserver" in window) {
        // Cấu hình bộ theo dõi: Khi khung chứa xuất hiện khoảng 10% trong màn hình sẽ kích hoạt
        const iframeObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                // Nếu phần tử đã lọt vào vùng nhìn thấy (Viewport)
                if (entry.isIntersecting) {
                    // Xóa nội dung chữ chờ bên trong khung
                    iframeContainer.innerHTML = "";

                    // Tạo một phần tử <iframe> mới toanh bằng JS
                    const iframe = document.createElement("iframe");
                    iframe.src = targetUrl;
                    iframe.style.width = "100%";
                    iframe.style.height = "500px"; // Oniichan tự chỉnh lại chiều cao theo ý muốn nhé
                    iframe.style.border = "none";
                    iframe.allowFullscreen = true;

                    // Nhúng iframe vào khung chứa
                    iframeContainer.appendChild(iframe);

                    // Đã tải xong rồi thì hủy theo dõi phần tử này để tiết kiệm tài nguyên hệ thống
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: "0px 0px 200px 0px" }); // Tải trước khi người dùng cuộn tới hẳn 200px cho mượt mà

        // Bắt đầu theo dõi khung chứa
        iframeObserver.observe(iframeContainer);
    } else {
        // Phương án dự phòng (Fallback): Nếu trình duyệt quá cũ không hỗ trợ Observer, tải trực tiếp luôn sau 3 giây
        setTimeout(function() {
            iframeContainer.innerHTML = `<iframe src="${targetUrl}" style="width:100%; height:500px; border:none;" allowfullscreen></iframe>`;
        }, 3000);
    }
}
