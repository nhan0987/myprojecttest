<?php
/**
 * Template Name: Noble Palace
 * 
 * A premium landing page template for Noble Palace Tây Thăng Long.
 */
$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php 
  add_action('wp_enqueue_scripts', function() {
    // Enqueue Google Fonts
    wp_enqueue_style('np-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Playfair+Display+SC:wght@400;700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=Playball&family=Inter:wght@300;400;500&family=Ms+Madi&display=swap', array(), null);
    
    // Custom Style & Scripts
    wp_enqueue_style('noble-palace-style', get_template_directory_uri() . '/css/noble-palace.css', array(), '1.0.0');
    wp_enqueue_script('noble-palace-script', get_template_directory_uri() . '/js/noble-palace.js', array('jquery'), '1.0.0', true);
  });

  wp_head(); 
  ?>
</head>
<body <?php body_class(); ?>>

<!-- TOP BAR -->
<div class="top-bar" id="top-bar">
  <p>Đơn vị phân phối chính thức: <span class="gold-text">SIÊU THỊ NHÀ ĐẤT – STND</span></p>
  <div class="divider"></div>
  <p>Hotline: <span class="gold-text">0972 991 551</span></p>
  <div class="divider"></div>
  <p>Website: <span class="gold-text"><a href="https://stnd.vn" target="_blank" style="color:inherit;text-decoration:underline">stnd.vn</a></span></p>
  <button class="close-btn" onclick="document.getElementById('top-bar').style.display='none'">✕</button>
</div>

<!-- HEADER -->
<header class="header">
  <div class="header-logo">
    <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/logo.webp" alt="Noble Palace Logo" />
    <div class="logo-text">
      <span class="logo-name">Noble pLACE</span>
      <div class="logo-sub">Tây Thăng Long</div>
    </div>
  </div>
  <div class="header-right">
    <div class="header-phone">
      <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
      <span>0972 991 551</span>
    </div>
    <button class="header-cta" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Nhận Tư Vấn</button>
    <button class="mobile-menu-btn" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-badge">
        <div class="dot"></div>
        <span>Suất Ngoại Giao Độc Quyền · Còn 15 Căn</span>
      </div>
      <p class="hero-brand">Noble Group · Sunshine Group · Đan Phượng, Hà Nội</p>
      <div class="hero-title">
        <span class="line1">Noble Palace</span>
        <span class="line2">Tây Thăng Long</span>
      </div>
      <p class="hero-tagline">Khu đô thị shophouse hàng hiệu phong cách Châu Âu — cửa ngõ Tây Bắc Thủ Đô</p>
      <p class="hero-desc">77 ha kiến trúc Địa Trung Hải cổ điển, vận hành chuẩn WorldHotels 5 sao. 15 suất ngoại giao vị trí góc, mặt đại lộ được phân phối độc quyền — bàn giao hoàn thiện, ký HĐMB ngay.</p>
      <div class="hero-ctas">
        <button class="hero-cta-main" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Nhận Báo Giá &amp; Tư Vấn Ngay</button>
        <button class="hero-cta-secondary" onclick="document.getElementById('products').scrollIntoView({behavior:'smooth'})">Xem 15 suất ngoại giao ↓</button>
      </div>
    </div>

    <!-- Form Card -->
    <div class="hero-form-card" id="hero-form">
      <div class="form-tag">
        <div class="dot"></div>
        <span>Còn 15 suất ngoại giao vị trí đẹp nhất · Cập nhật hôm nay</span>
      </div>
      <p class="form-title">Nhận Báo Giá Ưu Đãi</p>
      <p class="form-sub">Chuyên viên STND liên hệ trong 15 phút</p>
      <div class="form-fields">
        <div class="form-field">
          <label class="form-label">Họ và tên <span class="req">*</span></label>
          <input type="text" class="form-input" placeholder="Nguyễn Văn A" />
        </div>
        <div class="form-field">
          <label class="form-label">Số điện thoại <span class="req">*</span></label>
          <input type="tel" class="form-input" placeholder="09XXX XXX XXX" />
        </div>
        <div class="form-field">
          <label class="form-label">Quan tâm đến</label>
          <div class="form-select-wrap">
            <select class="form-input">
              <option value="">Chọn loại sản phẩm</option>
              <option>Shophouse Elegant (Nội khu)</option>
              <option>Shophouse Grand (Đường 24m)</option>
              <option>Shophouse Mặt đại lộ 40m</option>
              <option>Căn mặt bể bơi</option>
              <option>Căn cạnh Clubhouse</option>
            </select>
          </div>
        </div>
      </div>
      <button class="form-submit">Nhận Báo Giá &amp; Tư Vấn Ngay</button>
      <p class="form-note">Bảo mật thông tin tuyệt đối · Miễn phí hoàn toàn · STND tư vấn ngay</p>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<div class="trust-bar">
  <div class="trust-bar-inner">
    <div class="trust-item">
      <div class="trust-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/trust-icon-1.svg" alt="" />
      </div>
      <div class="trust-item-text">
        <div class="trust-item-title">Pháp lý đầy đủ</div>
        <div class="trust-item-sub">Đủ điều kiện ký HĐMB · SB số 20/2025</div>
      </div>
    </div>
    <div class="trust-item">
      <div class="trust-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/trust-icon-2.svg" alt="" />
      </div>
      <div class="trust-item-text">
        <div class="trust-item-title">Vượt tiến độ 15 ngày</div>
        <div class="trust-item-sub">Tổng thầu SCG · Bàn giao Q2/2026</div>
      </div>
    </div>
    <div class="trust-item">
      <div class="trust-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/trust-icon-3.svg" alt="" />
      </div>
      <div class="trust-item-text">
        <div class="trust-item-title">Vay 70% · 0% / 18T</div>
        <div class="trust-item-sub">MB Bank · VPBank · Techcombank</div>
      </div>
    </div>
    <div class="trust-item">
      <div class="trust-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/trust-icon-4.svg" alt="" />
      </div>
      <div class="trust-item-text">
        <div class="trust-item-title">Sổ đỏ lâu dài</div>
        <div class="trust-item-sub">Người nước ngoài được sở hữu</div>
      </div>
    </div>
  </div>
</div>

<!-- SECTION 1: TỔNG QUAN + QUỸ CĂN -->
<section class="section bg-gold" id="products">
  <div class="section-inner">
    <div class="section-head">
      <span class="section-label">Tổng Quan Dự Án</span>
      <h2 class="section-title">Khu Đô Thị Hàng Hiệu<br /><span class="gold">Tiên Phong Tây Hà Nội</span></h2>
      <div class="section-rule"></div>
    </div>

    <div class="product-meta">
      <p class="product-desc">Căn góc · Mặt đại lộ · Cận công viên — thương mại cao nhất dự án, phân phối trực tiếp trước hàng đại trà. Không bán lại lần 2.</p>
      <div class="product-counter">
          <div class="counter-sup">Suất ngoại giao còn lại</div>
          <div class="num">15</div>
          <div class="label">căn · Cập nhật 21/04/2026</div>
        </div>
    </div>

    <div class="cards-grid">
      <!-- Card 1 -->
      <div class="card">
        <div class="card-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/product-1.webp" alt="Căn Góc Cạnh Công Viên" />
          <div class="card-image-overlay"></div>
        </div>
        <div class="card-body">
          <div class="card-tag">Elegant · Nội Khu</div>
          <div class="card-urgency"><div class="dot"></div> Còn 4 căn · Phân khu Legacy</div>
          <div>
            <div class="card-title">Căn Góc Cạnh Công Viên</div>
            <div class="card-loc">Dãy L7 · Đối diện công viên 8.3 ha</div>
          </div>
          <div class="card-specs">
            <span class="tag-item">4 tầng</span>
            <span class="tag-item">50–67 m²</span>
            <span class="tag-item">3 mặt tiền</span>
            <span class="tag-item">Hoàn thiện mặt ngoài</span>
          </div>
          <div class="card-price-block">
            <div class="card-price">Từ 11 tỷ</div>
            <div class="card-finance">Vốn từ 2.75 tỷ (25%) · Lãi suất 0% / 18 tháng</div>
          </div>
          <div class="card-features">
            <div class="card-feature"><span class="dash">–</span> Vị trí góc, 3 mặt khai thác kinh doanh tối ưu</div>
            <div class="card-feature"><span class="dash">–</span> View thẳng công viên, lưu lượng người đông</div>
            <div class="card-feature"><span class="dash">–</span> Phù hợp café, showroom, văn phòng, spa</div>
            <div class="card-feature"><span class="dash">–</span> Bàn giao hoàn thiện mặt ngoài Q4/2025</div>
          </div>
          <button class="card-btn" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Yêu Cầu Báo Giá Chi Tiết</button>
        </div>
      </div>

      <!-- Card 2 (Featured) -->
      <div class="card featured">
        <div class="card-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/product-2.webp" alt="Shophouse 5 Tầng Đường Lớn" />
          <div class="card-image-overlay"></div>
        </div>
        <div class="card-body">
          <div class="card-tag">Grand · Mặt Đường 24m</div>
          <div class="card-urgency"><div class="dot"></div> Grand · Mặt Đường 24m</div>
          <div>
            <div class="card-title">Shophouse 5 Tầng Đường Lớn</div>
            <div class="card-loc">Nội khu 24m · Giao lộ chính phân khu</div>
          </div>
          <div class="card-specs">
            <span class="tag-item">5 tầng</span>
            <span class="tag-item">62–75 m²</span>
            <span class="tag-item">Đường 24m</span>
            <span class="tag-item">Thiết bị Gessi</span>
          </div>
          <div class="card-price-block">
            <div class="card-price">Từ 18 tỷ</div>
            <div class="card-finance">CK 12% · Tặng thêm 200 triệu trừ thẳng giá</div>
          </div>
          <div class="card-features">
            <div class="card-feature"><span class="dash">–</span> Mặt tiền đường 24m, hướng Đông Nam</div>
            <div class="card-feature"><span class="dash">–</span> Dòng tiền cho thuê ước tính 30–40 tr/tháng</div>
            <div class="card-feature"><span class="dash">–</span> Bàn giao thiết bị Gessi, Kohler, Duravit</div>
            <div class="card-feature"><span class="dash">–</span> Chiết khấu 10% nhanh + thêm 2% ngoại giao</div>
          </div>
          <button class="card-btn gold" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Yêu Cầu Báo Giá Chi Tiết</button>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <div class="card-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/product-3.webp" alt="Mặt Đại Lộ 40m" />
          <div class="card-image-overlay"></div>
        </div>
        <div class="card-body">
          <div class="card-tag">Elegant · Nội Khu</div>
          <div class="card-urgency"><div class="dot"></div> Còn 4 căn · Phân khu Legacy</div>
          <div>
            <div class="card-title">Mặt Đại Lộ 40m</div>
            <div class="card-loc">Trục Hoàng Quốc Việt kéo dài · Góc giao lộ</div>
          </div>
          <div class="card-specs">
            <span class="tag-item">5 tầng</span>
            <span class="tag-item">70–90 m²</span>
            <span class="tag-item">Đường 40m</span>
            <span class="tag-item">Góc giao lộ</span>
          </div>
          <div class="card-price-block">
            <div class="card-price">Từ 30 tỷ</div>
            <div class="card-finance">Fullgiá 34–36 tỷ · Giảm thẳng 2 tỷ khi ký HĐ</div>
          </div>
          <div class="card-features">
            <div class="card-feature"><span class="dash">–</span> Vị trí đắc địa nhất — mặt đường 40m</div>
            <div class="card-feature"><span class="dash">–</span> Tiềm năng cho thuê thương hiệu lớn quốc tế</div>
            <div class="card-feature"><span class="dash">–</span> Tăng giá mạnh khi Vành đai 3.5 thông xe</div>
            <div class="card-feature"><span class="dash">–</span> Phù hợp ngân hàng, showroom cao cấp</div>
          </div>
          <button class="card-btn" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Yêu Cầu Báo Giá Chi Tiết</button>
        </div>
      </div>
    </div>

    <div class="more-banner">
      <p>Ngoài 3 nhóm trên, STND còn quỹ căn: <strong>mặt bể bơi · cạnh trường học · cạnh Clubhouse</strong></p>
      <button onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Tìm Căn Phù Hợp Với Tôi</button>
    </div>
  </div>
</section>

<!-- SECTION 2: CHÍNH SÁCH BÁN HÀNG -->
<section class="section bg-white" id="policy">
  <div class="section-inner">
    <div class="section-head">
      <span class="section-label">Chính Sách Bán Hàng</span>
      <h2 class="section-title">Ưu Đãi Vượt Trội —<br /><span class="gold">Mua Sớm Lợi Nhiều</span></h2>
      <div class="section-rule"></div>
    </div>

    <div class="policy-grid">
      <div class="policy-card">
        <div class="policy-num">01</div>
        <div class="policy-title">Chiết Khấu Thanh Toán Sớm</div>
        <div class="policy-desc">Chiết khấu 10% tổng giá trị sản phẩm khi thanh toán sớm. Suất ngoại giao được cộng thêm 2% đặc biệt.</div>
        <div class="policy-highlight">10–12% CK</div>
      </div>
      <div class="policy-card">
        <div class="policy-num">02</div>
        <div class="policy-title">Lãi Suất Ưu Đãi Ngân Hàng</div>
        <div class="policy-desc">Vay vốn đến 70% giá trị căn. Lãi suất 0% trong 18 tháng đầu. Hỗ trợ hồ sơ vay miễn phí qua MB Bank, VPBank.</div>
        <div class="policy-highlight">0% / 18 tháng</div>
      </div>
      <div class="policy-card">
        <div class="policy-num">03</div>
        <div class="policy-title">Lợi Nhuận Vượt Tiến Độ</div>
        <div class="policy-desc">Nhận 9%/năm cho khoản tiền thanh toán vượt tiến độ. Sinh lời ngay từ khi chưa nhận nhà.</div>
        <div class="policy-highlight">9%/năm</div>
      </div>
    </div>

    <div class="mini-cards" style="margin-top:4px">
      <div class="mini-card">
        <div class="val">300tr</div>
        <div class="lbl">Thẻ Debit tặng kèm từ CĐT</div>
      </div>
      <div class="mini-card">
        <div class="val">24T</div>
        <div class="lbl">Miễn phí quản lý WorldHotels</div>
      </div>
      <div class="mini-card">
        <div class="val">1%</div>
        <div class="lbl">CK thêm cho KH ĐKTT Đan Phượng</div>
      </div>
      <div class="mini-card">
        <div class="val">2 tỷ</div>
        <div class="lbl">Hỗ trợ vay qua Noble App</div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3: TIẾN ĐỘ THI CÔNG -->
<section class="section bg-gold" id="progress">
  <div class="section-inner">
    <div class="section-head">
      <span class="section-label">Tiến Độ Thi Công</span>
      <h2 class="section-title">Thi Công Thần Tốc —<br /><span class="gold">Vượt Kế Hoạch 15 Ngày</span></h2>
      <div class="section-rule"></div>
    </div>

    <div class="construction-layout">
      <div class="construction-img">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/progress.webp" alt="Tiến độ thi công Noble Palace" />
      </div>
      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-date">Q4/2023</div>
          <div class="timeline-connector"><div class="timeline-dot"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Khởi công · San lấp mặt bằng hoàn tất 15/12/2023</div>
            <div class="timeline-status">✓ Hoàn thành</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q1/2024</div>
          <div class="timeline-connector"><div class="timeline-dot"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">90% hạ tầng kỹ thuật · Hệ thống thoát nước nội khu</div>
            <div class="timeline-status">✓ Hoàn thành</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q2/2024</div>
          <div class="timeline-connector"><div class="timeline-dot"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Khởi công phân khu Legacy · 450 căn lên tầng 2</div>
            <div class="timeline-status">✓ Hoàn thành</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q3/2024</div>
          <div class="timeline-connector"><div class="timeline-dot"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Nhà mẫu hoàn thiện · Mở cửa đón khách 15/01/2025</div>
            <div class="timeline-status">✓ Hoàn thành</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q4/2024</div>
          <div class="timeline-connector"><div class="timeline-dot active"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Ốp đá mặt ngoài · Tháo giáo · Sẵn sàng ký HĐMB · Vượt kế hoạch 15 ngày</div>
            <div class="timeline-status active">● Đang triển khai</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q4/25–Q2/26</div>
          <div class="timeline-connector"><div class="timeline-dot future"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Bàn giao phân khu Legacy · Khởi công Victory</div>
            <div class="timeline-status future">Dự kiến</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q2/2025</div>
          <div class="timeline-connector"><div class="timeline-dot future"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Bàn giao toàn bộ · Cấp sổ đỏ đợt đầu 30/12/2027</div>
            <div class="timeline-status future">Dự kiến</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3.5: THÀNH PHỐ KHÔNG NGỦ — Figma Frame 207 -->
<section class="amenity-section" id="amenities">
  <!-- Watermark logo bg -->
  <div class="amenity-watermark">
    <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-watermark.webp" alt="" aria-hidden="true" />
  </div>

  <!-- Top: Left text + Right image grid -->
  <div class="amenity-top">
    <!-- Left -->
    <div class="amenity-left">
      <div class="section-head" style="margin-bottom:24px">
        <span class="section-label">Chính Sách Bán Hàng</span>
        <h2 class="section-title">Thành Phố Không Ngủ<br /><span class="gold" style="font-style:italic">All-in-One 365 Ngày</span></h2>
        <div class="section-rule"></div>
      </div>
      <p class="amenity-desc">Hơn 100 tiện ích nội khu chuẩn quốc tế — bệnh viện 5 sao, trường quốc tế, công viên 190 ha, tất cả ngay trước cửa nhà.</p>
      <div class="amenity-grid">
        <div class="amenity-item">
          <div class="amenity-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-icon-1.webp" alt="Sunshine Hospital" /></div>
          <div class="amenity-text">
            <div class="amenity-name">Sunshine Hospital</div>
            <div class="amenity-sub">80,000m² · 220 giường · Chuẩn 5 sao</div>
          </div>
        </div>
        <div class="amenity-item">
          <div class="amenity-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-icon-2.webp" alt="Sunshine School" /></div>
          <div class="amenity-text">
            <div class="amenity-name">Sunshine School</div>
            <div class="amenity-sub">Liên cấp · Chương trình Cambridge</div>
          </div>
        </div>
        <div class="amenity-item">
          <div class="amenity-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-icon-3.webp" alt="Infinity Oasis" /></div>
          <div class="amenity-text">
            <div class="amenity-name">Infinity Oasis</div>
            <div class="amenity-sub">Ốc đảo nhiệt đới · Bể bơi 4 mùa</div>
          </div>
        </div>
        <div class="amenity-item">
          <div class="amenity-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-icon-4.webp" alt="4 Công Viên" /></div>
          <div class="amenity-text">
            <div class="amenity-name">4 Công Viên Chuyên Đề</div>
            <div class="amenity-sub">Tổng 200 ha · Cạnh dự án</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right image mosaic -->
    <div class="amenity-right">
      <div class="amenity-img-top">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-img-1.webp" alt="Công nghệ AI Noble Palace" />
      </div>
      <div class="amenity-img-row">
        <div class="amenity-img-half"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-img-2.webp" alt="Smart Home" /></div>
        <div class="amenity-img-half"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-img-3.webp" alt="Cửa hàng thông minh" /></div>
      </div>
    </div>
  </div>

  <!-- Bottom 3-col full-width image strip -->
  <div class="amenity-strip">
    <div class="amenity-strip-item"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-strip-1.webp" alt="Đô thị mở" /></div>
    <div class="amenity-strip-item"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-strip-2.webp" alt="Ngôi nhà thông minh" /></div>
    <div class="amenity-strip-item"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/amenity-strip-3.webp" alt="Giải pháp tài chính" /></div>
  </div>

  <!-- Navy legal bar -->
  <div class="legal-bar">
    <div class="legal-item">
      <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/legal-icon-1.svg" alt="✓" class="legal-icon" />
      <span>Thông báo đủ điều kiện bán nhà số 20/2025/CV-DIA · Sở Xây Dựng</span>
    </div>
    <div class="legal-item">
      <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/legal-icon-check.svg" alt="✓" class="legal-icon" />
      <span>Đủ điều kiện bán cho tổ chức, cá nhân nước ngoài</span>
    </div>
    <div class="legal-item">
      <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/legal-icon-check.svg" alt="✓" class="legal-icon" />
      <span>Sổ đỏ lâu dài · Cấp đợt đầu dự kiến 30/12/2027</span>
    </div>
    <div class="legal-item">
      <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/legal-icon-check.svg" alt="✓" class="legal-icon" />
      <span>Tổng thầu SCG · Vượt tiến độ 15 ngày</span>
    </div>
  </div>
</section>

<!-- SECTION 4: VỊ TRÍ & GIAO THÔNG -->
<section class="section bg-white" id="location">
  <div class="section-inner">
    <div class="section-head">
      <span class="section-label">Vị Trí & Giao Thông</span>
      <h2 class="section-title">Cửa Ngõ Tây Bắc Hà Nội —<br /><span class="gold">5 Trục Giao Thông Huyết Mạch</span></h2>
      <div class="section-rule"></div>
    </div>

    <div class="location-layout">
      <div class="location-left">
        <div class="location-img">
          <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/location-map.webp" alt="Vị trí Noble Palace" />
        </div>
        <div class="location-tags">
          <span class="location-tag">Vành đai 4 · Cách 1km</span>
          <span class="location-tag">Vành đai 3.5 · Thông xe 2026</span>
          <span class="location-tag">Đại lộ Tây Thăng Long · 10 làn</span>
          <span class="location-tag">Metro số 2 · Đang xây dựng</span>
          <span class="location-tag">Quốc lộ 32 · Kết nối nội đô</span>
        </div>
        <div class="market-note">
          <div class="market-note-title">Phân Tích Thị Trường 2025</div>
          <div class="market-note-body">Giá BĐS Hà Nội đạt 79 triệu/m² đầu 2025 — tăng 32% so với năm trước. Noble Palace đang ở "vùng trũng giá" — 70% quỹ căn dưới 20 tỷ. Khi Vành đai 3.5 + 4 thông xe 2026–2027, mặt bằng giá Đan Phượng sẽ thiết lập đỉnh mới.</div>
        </div>
      </div>

      <div class="location-right">
        <div class="distance-table">
          <div class="distance-row">
            <span class="place">Hồ Tây · Cầu Giấy</span>
            <span class="time">15 <span class="unit">phút</span></span>
          </div>
          <div class="distance-row">
            <span class="place">Sân bay Nội Bài</span>
            <span class="time">20 <span class="unit">phút qua Nhật Tân</span></span>
          </div>
          <div class="distance-row">
            <span class="place">Trung tâm Hà Nội</span>
            <span class="time">25 <span class="unit">phút</span></span>
          </div>
          <div class="distance-row">
            <span class="place">Khu đô thị Ciputra</span>
            <span class="time">10 <span class="unit">phút</span></span>
          </div>
          <div class="distance-row">
            <span class="place">2 công viên 190 ha</span>
            <span class="time">0 <span class="unit">Tiếp giáp trực tiếp</span></span>
          </div>
        </div>

        <div class="info-box">
          <div class="info-box-title">Thông Tin Dự Án</div>
          <div class="info-row">
            <span class="k">Chủ đầu tư</span>
            <span class="v">Sunshine Group · Noble</span>
          </div>
          <div class="info-row">
            <span class="k">Vị trí</span>
            <span class="v">Tân Lập, Đan Phượng, HN</span>
          </div>
          <div class="info-row">
            <span class="k">Sản phẩm</span>
            <span class="v">Grand &amp; Elegant Shophouse</span>
          </div>
          <div class="info-row">
            <span class="k">Phong cách</span>
            <span class="v">Địa Trung Hải cổ điển</span>
          </div>
          <div class="info-row">
            <span class="k">Vận hành</span>
            <span class="v">WorldHotels 5 sao</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: ĐƠN VỊ PHÂN PHỐI -->
<section class="section bg-gold" id="agent">
  <div class="section-inner">
    <div class="section-head">
      <span class="section-label">Đơn Vị Phân Phối Chính Thức</span>
      <h2 class="section-title">Thông Tin <span class="gold">Đại Lý STND</span> &amp;<br />Chuyên Viên Tư Vấn</h2>
      <div class="section-rule"></div>
    </div>

    <div class="agent-box">
      <div class="agent-card-left">
        <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/stnd-logo-agent.webp" alt="STND Logo" />
        <div class="agent-brand-name">SIÊU THỊ NHÀ ĐẤT – <span>STND</span></div>
        <div class="agent-auth">✓ Ủy quyền Noble Group · Sunshine Group</div>
        <div class="agent-divider"></div>
        <div class="agent-motto">Mang đến những Giá trị &amp; Trải nghiệm</div>
        <a class="agent-link" href="https://stnd.vn" target="_blank">stnd.vn →</a>
      </div>

      <div class="agent-right">
        <div class="agent-info-grid">
          <div class="agent-field">
            <div class="agent-field-label">Địa chỉ văn phòng</div>
            <div class="agent-field-value">262 Tây Sơn, Đống Đa, Hà Nội</div>
          </div>
          <div class="agent-field">
            <div class="agent-field-label">Hotline tư vấn</div>
            <div class="agent-field-value"><a href="tel:0972991551">0972 991 551</a></div>
          </div>
          <div class="agent-field">
            <div class="agent-field-label">Người phụ trách</div>
            <div class="agent-field-value">Mr. Hoàng Thái · 0972 991 551</div>
          </div>
          <div class="agent-field">
            <div class="agent-field-label">Giờ làm việc</div>
            <div class="agent-field-value">T2 – CN · 8h00 – 20h00</div>
          </div>
        </div>

        <div class="agent-services">
          <div class="service-card">
            <div class="service-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/moi-gioi.webp" alt="Môi giới" /></div>
            <div class="service-title">Môi giới</div>
            <div class="service-sub">Kết nối mua bán minh bạch</div>
          </div>
          <div class="service-card">
            <div class="service-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/ky-gui.webp" alt="Ký gửi" /></div>
            <div class="service-title">Ký gửi</div>
            <div class="service-sub">Quản lý &amp; phân phối ký gửi</div>
          </div>
          <div class="service-card">
            <div class="service-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/tu-van-dau-tu.webp" alt="Tư vấn đầu tư" /></div>
            <div class="service-title">Tư vấn đầu tư</div>
            <div class="service-sub">Chiến lược sinh lời dài hạn</div>
          </div>
        </div>

        <div class="market-note">
          <div class="market-note-title">Cam Kết Từ STND</div>
          <div class="market-note-body">STND cam kết cung cấp giá trực tiếp từ Noble Group, không phụ thu bất kỳ phí nào. Tôn chỉ: "Uy tín là nền tảng – Chuyên nghiệp là phương pháp – Hiệu quả là mục tiêu".</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FINAL CTA — Figma: Frame 248 "Giữ Chỗ Suất Ngoại Giao" -->
<section class="final-cta" id="contact">
  <div class="final-cta-inner">
    <p class="final-cta-label">Chính Sách Bán Hàng</p>
    <h2 class="final-cta-title">
      Giữ Chỗ Suất Ngoại Giao
      <span class="final-cta-title-gold">Trước Khi Hết Quỹ Căn</span>
    </h2>
    <div class="final-cta-rule"></div>
    <p class="final-cta-desc">15 suất ngoại giao vị trí đẹp nhất — không bán lại lần 2. Liên hệ ngay để nhận bảng giá chi tiết và tư vấn chọn căn phù hợp.</p>
    <div class="final-cta-btns">
      <a class="final-cta-btn-phone" href="tel:0972991551">
        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
        0972 991 551
      </a>
      <button class="final-cta-btn-register" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'})">Đăng Ký Ngay</button>
    </div>
    <p class="final-cta-note">Nhà mẫu: 8h30 – 17h30 hàng ngày · Tân Lập, Đan Phượng, Hà Nội</p>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-watermark watermark-left">
    <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/logo.webp" alt="" />
  </div>
  <div class="footer-watermark watermark-right">
    <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/logo.webp" alt="" />
  </div>
  <div class="footer-inner">
    <div class="footer-logo-block">
      <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/logo.webp" alt="Noble Palace" class="footer-logo-img" />
      <div class="footer-logo-sub">Tây Thăng Long</div>
    </div>
    <p class="footer-disclaimer">
      Mọi thông tin trên trang web này do đại lý phân phối chính thức <strong>SIÊU THỊ NHÀ ĐẤT – STND</strong> cung cấp. Địa chỉ: 262 Tây Sơn, Đống Đa, Hà Nội · Hotline: 0972 991 551 · Website: stnd.vn. Giá bán, chính sách và thông tin dự án có thể thay đổi theo từng thời điểm, vui lòng liên hệ trực tiếp để xác nhận. Noble Palace Tây Thăng Long được phát triển bởi Tập đoàn Sunshine Group và Công ty CP Kinh doanh BĐS Noble. Trang web này vận hành bởi đại lý phân phối — không phải website chính thức của chủ đầu tư.
    </p>
    <p style="font-size:11px;color:rgba(255,255,255,.25);margin-top:4px">© 2026 STND. All rights reserved.</p>
  </div>
</footer>

<!-- FLOATING SIDEBAR — Figma: Frame 263 (Desktop only) -->
<div class="float-sidebar" id="float-sidebar">
  <!-- Zalo -->
  <a class="float-sidebar-item" href="https://zalo.me/0972991551" target="_blank" rel="noopener" title="Chat Zalo">
    <div class="icon-wrap" style="border-radius:10px;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo" style="width:48px;height:48px;object-fit:cover;border-radius:10px;" />
    </div>
    <span>Chat Zalo</span>
  </a>
  <!-- Gọi ngay -->
  <a class="float-sidebar-item" href="tel:0972991551" title="Gọi ngay">
    <div class="icon-wrap phone-icon">
      <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
    </div>
    <span>Gọi ngay</span>
  </a>
  <!-- Scroll to top -->
  <button class="float-scroll-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Lên đầu trang" aria-label="Lên đầu trang">
    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>
  </button>
</div>

<!-- FLOATING BAR (Mobile only) -->
<div class="floating-cta">
  <a href="tel:0972991551">📞 Gọi Ngay</a>
  <a href="#hero-form" onclick="document.getElementById('hero-form').scrollIntoView({behavior:'smooth'});return false;">Nhận Báo Giá</a>
</div>

    <?php wp_footer(); ?>
</body>
</html>
