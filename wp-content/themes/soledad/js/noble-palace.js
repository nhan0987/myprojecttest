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

    setTimeout(function () {

        const promoPopup = document.getElementById('np-promo-popup');
        const formPopup = document.getElementById('np-form-popup');
        const promoClose = document.getElementById('np-promo-close');
        const formClose = document.getElementById('np-form-close');
        const promoImg = document.getElementById('np-promo-img');

        // Hiển thị popup
        if (promoPopup) {
            requestAnimationFrame(() => {
                promoPopup.classList.add('active');
            });

            // Tự động tắt sau 10s nếu người dùng không tương tác/click
            let autoCloseTimeout = setTimeout(function () {
                promoPopup.classList.remove('active');
            }, 1000000);

            // Xóa timeout khi người dùng chủ động tương tác
            function clearAutoClose() {
                if (autoCloseTimeout) {
                    clearTimeout(autoCloseTimeout);
                    autoCloseTimeout = null;
                }
            }

            // Tắt popup khuyến mãi
            if (promoClose) {
                promoClose.addEventListener('click', function () {
                    clearAutoClose();
                    promoPopup.classList.remove('active');
                });
            }

            // Click ảnh mở form
            if (promoImg) {
                promoImg.addEventListener('click', function () {
                    clearAutoClose();
                    promoPopup.classList.remove('active');
                    if (formPopup) formPopup.classList.add('active');
                });
            }

            // Click ra ngoài để tắt
            promoPopup.addEventListener('click', function (e) {
                if (e.target === promoPopup) {
                    clearAutoClose();
                    promoPopup.classList.remove('active');
                }
            });
        }

        if (formPopup) {
            // Tắt popup form
            if (formClose) {
                formClose.addEventListener('click', function () {
                    formPopup.classList.remove('active');
                });
            }

            formPopup.addEventListener('click', function (e) {
                if (e.target === formPopup) formPopup.classList.remove('active');
            });
            
            // Xử lý nút Trở Về trong màn hình thành công
            const returnBtn = document.getElementById('np-form-return');
            if (returnBtn) {
                returnBtn.addEventListener('click', function() {
                    formPopup.classList.remove('active');
                    // Reset lại form trạng thái ban đầu sau khi tắt
                    setTimeout(() => {
                        document.getElementById('np-form-cf7-inner').style.display = 'block';
                        document.getElementById('np-form-cf7-success').style.display = 'none';
                    }, 300);
                });
            }
        }

        // Lắng nghe sự kiện Contact Form 7 gửi thành công
        document.addEventListener('wpcf7mailsent', function(event) {
            // Kiểm tra xem có phải form trong popup không (có thể kiểm tra ID event.detail.contactFormId nếu cần)
            // Tạm thời áp dụng cho form đang mở trong popup
            if (formPopup && formPopup.classList.contains('active')) {
                const inner = document.getElementById('np-form-cf7-inner');
                const success = document.getElementById('np-form-cf7-success');
                if (inner && success) {
                    inner.style.display = 'none';
                    success.style.display = 'block';
                }
            }
        }, false);

    }, 4000); // 4 giây
}
