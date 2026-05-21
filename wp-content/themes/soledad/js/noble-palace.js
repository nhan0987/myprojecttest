document.addEventListener("DOMContentLoaded", function () {
    initScrollFadeIn();
    initStickyHeaderAndSidebar();
    // initIframeObserver();
    initPopupOverlay();
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
        setTimeout(function () {
            iframeContainer.innerHTML = `<iframe src="${targetUrl}" style="width:100%; height:500px; border:none;" allowfullscreen></iframe>`;
        }, 3000);
    }
}

function initPopupOverlay() {
    console.log("initPopupOverlay");
    setTimeout(function () {

        console.log("startPopupOverlay");
        // Chỉ hiện popup nếu chưa đăng ký/chưa đóng (nếu cần có thể lưu localStorage, hiện tại luôn hiện để test)
        const popupHTML = `
            <div id="np-promo-popup" class="np-popup-overlay">
                <div class="np-popup-content">
                    <button class="np-popup-close" id="np-promo-close">&times;</button>
                    <picture class="np-popup-img" id="np-promo-img">
                        <source media="(max-width: 768px)" srcset="/wp-content/themes/soledad/images/noble-palace/popup_mercedes%20-%20mobile.webp">
                        <img src="/wp-content/themes/soledad/images/noble-palace/popup_mercedes.webp" alt="Khuyến mãi Mercedes">
                    </picture>
                </div>
            </div>
            <div id="np-form-popup" class="np-popup-overlay">
                <div class="np-popup-content np-form-content">
                    <button class="np-popup-close" id="np-form-close">&times;</button>
                    <div class="np-form-inner">
                        <h3 class="np-form-title">Đăng ký nhận thông tin</h3>
                        <input type="text" class="np-form-input" placeholder="Họ và tên">
                        <input type="tel" class="np-form-input" placeholder="Số điện thoại">
                        <button class="np-form-submit">Gửi Đăng Ký</button>
                    </div>
                </div>
            </div>
        `;

        console.log("middlePopupOverlay");
        document.body.insertAdjacentHTML('beforeend', popupHTML);
        console.log("middle2PopupOverlay");

        const promoPopup = document.getElementById('np-promo-popup');
        const formPopup = document.getElementById('np-form-popup');
        const promoClose = document.getElementById('np-promo-close');
        const formClose = document.getElementById('np-form-close');
        const promoImg = document.getElementById('np-promo-img');

        // Hiển thị popup
        requestAnimationFrame(() => {
            promoPopup.classList.add('active');
        });

        // Tự động tắt sau 10s nếu người dùng không tương tác/click
        let autoCloseTimeout = setTimeout(function () {
            promoPopup.classList.remove('active');
        }, 10000);

        // Xóa timeout khi người dùng chủ động tương tác
        function clearAutoClose() {
            if (autoCloseTimeout) {
                clearTimeout(autoCloseTimeout);
                autoCloseTimeout = null;
            }
        }

        // Tắt popup khuyến mãi
        promoClose.addEventListener('click', function () {
            clearAutoClose();
            promoPopup.classList.remove('active');
        });

        // Tắt popup form
        formClose.addEventListener('click', function () {
            formPopup.classList.remove('active');
        });

        // Click ảnh mở form
        promoImg.addEventListener('click', function () {
            clearAutoClose();
            promoPopup.classList.remove('active');
            formPopup.classList.add('active');
        });

        // Click ra ngoài để tắt
        promoPopup.addEventListener('click', function (e) {
            if (e.target === promoPopup) {
                clearAutoClose();
                promoPopup.classList.remove('active');
            }
        });
        formPopup.addEventListener('click', function (e) {
            if (e.target === formPopup) formPopup.classList.remove('active');
        });

        console.log("endPopupOverlay");

    }, 4000); // 4 giây
}
