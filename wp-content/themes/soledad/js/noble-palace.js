document.addEventListener("DOMContentLoaded", function () {
    initScrollFadeIn();
    initStickyHeaderAndSidebar();
    // initIframeObserver();
    initPopupOverlay();
    initCounters();
});

function initScrollFadeIn() {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.card, .policy-card, .mini-card, .timeline-item, .trust-item, .payment-block-title, .pol-benefit-left, .pol-benefit-right, .policy-banner, .payment-list, .amenity-img-row, .amenity-strip-item').forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });

    document.querySelectorAll('.pol-title-1, .pol-title').forEach(el => {
        el.classList.add('fade-in-left-scroll');
        observer.observe(el);
    });

    document.querySelectorAll('.amenity-img-top').forEach(el => {
        el.classList.add('fade-in-simple');
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

    // Cấu hình hiển thị Popup Khuyến Mãi
    const popupConfig = {
        enableCookie: true, // Bật/tắt tính năng chỉ hiển thị 1 lần theo cookie
        cookieName: 'np_promo_shown_1', // Tên cookie
        cookieHours: 24 // Thời gian tồn tại của cookie (tính bằng giờ)
    };

    // Hàm set Cookie
    function setCookie(name, value, hours) {
        let expires = "";
        if (hours) {
            let date = new Date();
            date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Hàm get Cookie
    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    setTimeout(function () {

        const promoPopup = document.getElementById('np-promo-popup');
        const formPopup = document.getElementById('np-form-popup');
        const promoClose = document.getElementById('np-promo-close');
        const formClose = document.getElementById('np-form-close');
        const promoImg = document.getElementById('np-promo-img');

        // Khởi tạo các sự kiện cho popup khuyến mãi
        if (promoPopup) {
            let autoCloseTimeout;

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

            // Kiểm tra Cookie và Hiển thị popup
            let shouldShow = true;
            if (popupConfig.enableCookie) {
                if (getCookie(popupConfig.cookieName)) {
                    shouldShow = false;
                }
            }

            if (shouldShow) {
                requestAnimationFrame(() => {
                    promoPopup.classList.add('active');

                    // Ghi nhận đã xem popup
                    if (popupConfig.enableCookie) {
                        setCookie(popupConfig.cookieName, '1', popupConfig.cookieHours);
                    }
                });

                // Tự động tắt sau một thời gian dài (nếu người dùng không thao tác)
                autoCloseTimeout = setTimeout(function () {
                    promoPopup.classList.remove('active');
                }, 1000000);
            }
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
                returnBtn.addEventListener('click', function () {
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
        document.addEventListener('wpcf7mailsent', function (event) {
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

function initCounters() {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.counter').forEach(el => {
        observer.observe(el);
    });
}

function animateCounter(el) {
    const target = parseFloat(el.getAttribute('data-target'));
    const decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
    const separator = el.getAttribute('data-separator') || '.';
    const duration = 1000; // 1.5 seconds
    const startTime = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Premium deceleration effect (easeOutExpo)
        const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
        const currentVal = easeProgress * target;

        let formattedVal = currentVal.toFixed(decimals);
        if (separator !== '.') {
            formattedVal = formattedVal.replace('.', separator);
        }

        el.textContent = formattedVal;

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            let finalVal = target.toFixed(decimals);
            if (separator !== '.') {
                finalVal = finalVal.replace('.', separator);
            }
            el.textContent = finalVal;
        }
    }

    requestAnimationFrame(update);
}

