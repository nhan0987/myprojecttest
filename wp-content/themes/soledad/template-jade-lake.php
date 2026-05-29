<?php
/**
 * Template Name: Jade Lake
 * 
 * Mô tả: Landing page template cao cấp cho Jade Lake.
 */

$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jade Lake Residence – Liền Kề Shophouse & Biệt Thự Ven Hồ Điều Hòa 8ha | Đại lý F1 STND</title>
  <meta name="description" content="Jade Lake Residence – 90 căn liền kề shophouse & biệt thự phong cách Tân cổ điển châu Âu, mặt đại lộ Tây Thăng Long 60m, cạnh hồ điều hòa 8ha. Giá từ 280 triệu/m². Đại lý F1 chính thức: STND.vn – Hotline: 0972.991.551" />

  <!-- Open Graph -->
  <meta property="og:title" content="Jade Lake Residence – 90 Căn Liền Kề & Biệt Thự Ven Hồ 8ha | Đại lý F1 STND" />
  <meta property="og:description" content="Chỉ 90 căn. Mặt đại lộ Tây Thăng Long 60m. Cạnh hồ điều hòa 8ha. Từ 280tr/m². Đại lý F1 STND.vn" />
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/jade-lake/z6424902540414_e6c44a4c06ef7c98e6118360d95057ac.jpg" />
  <meta property="og:image:width" content="1280" />
  <meta property="og:image:height" content="720" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="vi_VN" />
  <meta name="twitter:card" content="summary_large_image" />

  <!-- TODO: Replace GTM-XXXXXXX with client GTM ID -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-XXXXXXX');</script>

  <!-- TODO: Replace XXXXXXXXXXXXXXXXX with Facebook Pixel ID -->
  <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','XXXXXXXXXXXXXXXXX');fbq('track','PageView');</script>
  <noscript><img height="1" width="1" data-style="inline-cb4589" src="https://www.facebook.com/tr?id=XXXXXXXXXXXXXXXXX&ev=PageView&noscript=1"/></noscript>
    <?php 
    add_action('wp_enqueue_scripts', function() {
        // Enqueue Google Fonts
        wp_enqueue_style('jade-lake-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Mulish:wght@300;400;500;600;700;800&display=swap', array(), null);
        
        // Enqueue Custom CSS & JS
        wp_enqueue_style('jade-lake-style', get_template_directory_uri() . '/css/jade-lake.css', array(), '1.0.0');
        wp_enqueue_script('jade-lake-script', get_template_directory_uri() . '/js/jade-lake.js', array('jquery'), '1.0.0', true);
    });
    wp_head(); 
    ?>
</head>
<body <?php body_class(); ?>>
    <!-- GTM noscript fallback -->
<!-- TODO: Replace GTM-XXXXXXX -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX" height="0" width="0" data-style="inline-b3bfe1"></iframe></noscript>

<!-- ============================================
     HEADER
============================================ -->
<header id="site-header">
  <div class="header-inner">
    <div class="header-logos">
      <img src="https://stnd.vn/wp-content/uploads/2025/11/LOGO-01-1.png" alt="STND – Siêu Thị Nhà Đất" />
      <div class="logo-sep"></div>
      <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/logo-jade-lake-300x177-1.png" alt="Jade Lake Residence" />
    </div>
    <div class="header-right">
      <a href="tel:0972991551" class="header-hotline">
        <span class="h-icon">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.32.57 3.58.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.82 21 3 13.18 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.23 1.01L6.6 10.8z"/></svg>
        </span>
        0972.991.551
      </a>
      <a href="#register" class="btn-header-cta">Nhận Báo Giá</a>
    </div>
  </div>
</header>

<!-- ============================================
     HERO
============================================ -->
<section id="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="hero-inner">
    <!-- HERO COPY -->
    <div class="hero-copy">
      <div class="hero-eyebrow">
        <span class="eyebrow-dot"></span>
        Đại lý F1 Phân Phối Chính Thức
      </div>
      <h1 class="hero-title">
        Jade Lake<br>
        <em>Residence</em><br>
        Tây Thăng Long
      </h1>
      <p class="hero-lead">
        82 Liền kề Shophouse &amp; 8 Biệt thự phong cách <strong>Tân cổ điển châu Âu</strong> —
        mặt đại lộ <strong>60m huyết mạch</strong>, cạnh hồ điều hòa <strong>8 hecta xanh mát</strong>.
        Bất động sản an cư và đầu tư đẳng cấp bậc nhất Bắc Từ Liêm.
      </p>
      <div class="hero-kpis">
        <div class="hero-kpi">
          <div class="kpi-num">90</div>
          <div class="kpi-label">Căn giới hạn</div>
        </div>
        <div class="hero-kpi">
          <div class="kpi-num">280tr/m²</div>
          <div class="kpi-label">Giá khởi điểm</div>
        </div>
        <div class="hero-kpi">
          <div class="kpi-num">8ha</div>
          <div class="kpi-label">Hồ điều hòa</div>
        </div>
        <div class="hero-kpi">
          <div class="kpi-num">6 tầng</div>
          <div class="kpi-label">+ Hầm riêng</div>
        </div>
      </div>
    </div>

    <!-- HERO FORM -->
    <div class="hero-form-wrap">
      <div class="form-card">
        <div class="fc-title">Nhận Bảng Giá &amp; Ưu Đãi F1</div>
        <div class="fc-sub">Tư vấn miễn phí • Phản hồi trong 15 phút</div>
        <div class="urgency-bar">
          <span class="u-dot"></span>
          Chỉ còn <strong>&nbsp;7 suất&nbsp;</strong> ưu đãi F1 — Giới hạn đợt này
        </div>
        <form id="heroForm" novalidate>
          <div class="form-group" id="hg-name">
            <label for="hName">Họ và Tên *</label>
            <input type="text" id="hName" placeholder="Nguyễn Văn A" autocomplete="name" />
            <div class="err-msg">Vui lòng nhập họ và tên (ít nhất 2 ký tự)</div>
          </div>
          <div class="form-group" id="hg-phone">
            <label for="hPhone">Số Điện Thoại *</label>
            <input type="tel" id="hPhone" placeholder="09xx.xxx.xxx" autocomplete="tel" />
            <div class="err-msg">Vui lòng nhập số điện thoại Việt Nam hợp lệ</div>
          </div>
          <button type="submit" class="btn-cta-main" id="hSubmit">
            🔑 Nhận Ngay Bảng Giá &amp; Chiết Khấu F1
          </button>
          <div class="form-secure">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
            Thông tin được bảo mật tuyệt đối
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     HERO B — A/B VARIANT (Investment angle)
     JS randomly assigns visitor to A or B
============================================ -->
<section id="hero-b">
  <div class="hero-b-bg"></div>
  <div class="hero-b-overlay"></div>
  <div class="hero-b-inner">
    <!-- HERO B COPY -->
    <div class="hero-b-copy">
      <div class="hero-b-tag">
        <span class="eyebrow-dot"></span>
        Shophouse Đầu Tư Sinh Lời · Đại lý F1 STND
      </div>
      <h1 class="hero-b-title">
        Shophouse Mặt <em>Đại Lộ 60m</em><br>
        — Vừa Ở, Vừa<br>
        <em>Kinh Doanh & Cho Thuê</em>
      </h1>
      <p class="hero-b-lead">
        <strong>82 liền kề shophouse</strong> 6 tầng + hầm riêng, mặt đại lộ Tây Thăng Long huyết mạch — lượng khách vãng lai lớn nhất khu Tây Hà Nội. Tiềm năng cho thuê <strong>cao, ổn định dài hạn</strong>. Cạnh hồ điều hòa 8ha, giá trị tích lũy không ngừng tăng.
      </p>
      <!-- ROI highlight box -->
      <div class="hero-b-roi">
        <div class="roi-item">
          <div class="roi-num">280tr</div>
          <div class="roi-label">Giá/m² từ</div>
        </div>
        <div class="roi-sep"></div>
        <div class="roi-item">
          <div class="roi-num">1 tỷ</div>
          <div class="roi-label">TTĐC từ</div>
        </div>
        <div class="roi-sep"></div>
        <div class="roi-item">
          <div class="roi-num">6T+H</div>
          <div class="roi-label">Kết cấu</div>
        </div>
        <div class="roi-sep"></div>
        <div class="roi-item">
          <div class="roi-num">90</div>
          <div class="roi-label">Căn giới hạn</div>
        </div>
      </div>
      <ul class="hero-b-checklist">
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          Mặt tiền đại lộ 60m — 10 làn xe — lưu lượng cao nhất khu Tây
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          6 tầng nổi + 1 hầm — tối ưu cho thuê hoặc kinh doanh đa tầng
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          Đón đầu tuyến Metro 3 & 4 — giá trị BĐS tăng theo hạ tầng
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          Sổ đỏ lâu dài — Pháp lý minh bạch — CĐT uy tín
        </li>
      </ul>
    </div>

    <!-- HERO B FORM (reuses same form-card styles) -->
    <div data-style="inline-9ef5da">
      <div class="form-card">
        <div class="fc-title">Tính Toán Lợi Nhuận</div>
        <div class="fc-sub">Nhận phân tích đầu tư từ chuyên gia STND F1</div>
        <div class="urgency-bar">
          <span class="u-dot"></span>
          <strong>Còn 7 lô&nbsp;</strong> tầng 1 mặt đại lộ — Ưu tiên F1
        </div>
        <form id="heroBForm" novalidate>
          <div class="form-group" id="hbg-name">
            <label for="hbName">Họ và Tên *</label>
            <input type="text" id="hbName" placeholder="Nguyễn Văn A" autocomplete="name" />
            <div class="err-msg">Vui lòng nhập họ và tên</div>
          </div>
          <div class="form-group" id="hbg-phone">
            <label for="hbPhone">Số Điện Thoại *</label>
            <input type="tel" id="hbPhone" placeholder="09xx.xxx.xxx" autocomplete="tel" />
            <div class="err-msg">Vui lòng nhập số điện thoại hợp lệ</div>
          </div>
          <button type="submit" class="btn-cta-main" id="hbSubmit">
            📊 Nhận Phân Tích Đầu Tư Miễn Phí
          </button>
          <div class="form-secure">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
            Cam kết bảo mật — Không spam
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- A/B variant tracked via GTM/Pixel only — no visible badge -->

<!-- ============================================
     TRUST BAR
============================================ -->
<div id="trust-bar">
  <div class="trust-inner">
    <div class="trust-cell">
      <div class="trust-ic">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
      </div>
      <div>
        <div class="trust-lbl">Pháp lý</div>
        <div class="trust-val">Sổ đỏ lâu dài</div>
      </div>
    </div>
    <div class="trust-cell">
      <div class="trust-ic">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
      </div>
      <div>
        <div class="trust-lbl">Chủ đầu tư</div>
        <div class="trust-val">Xuân Trường Hoành Bồ</div>
      </div>
    </div>
    <div class="trust-cell">
      <div class="trust-ic">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      </div>
      <div>
        <div class="trust-lbl">Quy mô</div>
        <div class="trust-val">90 Căn — Giới hạn</div>
      </div>
    </div>
    <div class="trust-cell">
      <div class="trust-ic">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
      </div>
      <div>
        <div class="trust-lbl">Đại lý F1</div>
        <div class="trust-val">STND – stnd.vn</div>
      </div>
    </div>
  </div>
</div>

<!-- ============================================
     TỔNG QUAN DỰ ÁN
============================================ -->
<section id="tong-quan">
  <div class="sec-inner">
    <div class="tq-layout">
      <!-- Image stack -->
      <div class="tq-img-stack reveal">
        <div class="tq-img-main">
          <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/z6424902540415_fb7887855c548207c76cff193a0d7c5c.jpg" alt="Phối cảnh tổng thể Jade Lake Residence" loading="lazy" />
          <div class="tq-stamp">Jade Lake Residence · Hà Nội</div>
        </div>
        <div class="tq-img-float">
          <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/cong-vien-jade-lake-residence-2.jpg" alt="Công viên nội khu" loading="lazy" />
        </div>
      </div>

      <!-- Specs table -->
      <div class="reveal reveal-delay-1">
        <span class="sec-tag">Thông số kỹ thuật</span>
        <h2 class="sec-title">Tổng Quan <em>Dự Án</em></h2>
        <div class="gold-rule"></div>

        <div class="tq-table-wrap">
          <table class="tq-table">
            <tr>
              <td>Tên dự án</td>
              <td><strong>Jade Lake Residence Tây Thăng Long</strong></td>
            </tr>
            <tr>
              <td>Chủ đầu tư</td>
              <td>Công ty TNHH Xuân Trường Hoành Bồ</td>
            </tr>
            <tr>
              <td>Đại lý F1</td>
              <td><strong>STND – Siêu Thị Nhà Đất (stnd.vn)</strong></td>
            </tr>
            <tr>
              <td>Vị trí</td>
              <td>Lô TT-07 đường Tây Thăng Long, phường Tây Tựu, quận Bắc Từ Liêm, Hà Nội</td>
            </tr>
            <tr>
              <td>Tổng diện tích</td>
              <td>15.828 m²</td>
            </tr>
            <tr>
              <td>Mật độ xây dựng</td>
              <td>52,4%</td>
            </tr>
            <tr>
              <td>Tổng số căn</td>
              <td>
                <span class="tq-badge">82 Liền kề Shophouse</span>&nbsp;
                <span class="tq-badge gold">8 Biệt thự</span>
              </td>
            </tr>
            <tr>
              <td>Diện tích liền kề</td>
              <td>94 m² – 212 m²</td>
            </tr>
            <tr>
              <td>Diện tích biệt thự</td>
              <td>136 m² – 200 m²</td>
            </tr>
            <tr>
              <td>Kết cấu</td>
              <td><strong>6 tầng nổi + 1 tầng hầm riêng</strong></td>
            </tr>
            <tr>
              <td>Phong cách</td>
              <td>Tân cổ điển châu Âu</td>
            </tr>
            <tr>
              <td>Bàn giao</td>
              <td>Thô bên trong, hoàn thiện mặt ngoài</td>
            </tr>
            <tr>
              <td>Hạ tầng đặc biệt</td>
              <td>Mặt đại lộ 60m (10 làn xe) · Hồ điều hòa 8ha</td>
            </tr>
            <tr>
              <td>Pháp lý</td>
              <td><span class="tq-badge green">✓ Sổ đỏ lâu dài</span></td>
            </tr>
            <tr>
              <td>Giá khởi điểm</td>
              <td><strong data-style="inline-e95766">Từ 280 triệu/m²</strong></td>
            </tr>
            <tr>
              <td>Đặt cọc</td>
              <td><strong>1.000.000.000 VNĐ (1 tỷ đồng)</strong></td>
            </tr>
          </table>
        </div>

        <div class="tq-cta-row">
          <a class="btn-tq-primary" onclick="goRegister()">
            Nhận Bảng Giá Đầy Đủ
          </a>
          <a href="tel:0972991551" class="btn-tq-secondary">
            📞 Gọi Tư Vấn Ngay
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     USP — TẠI SAO JADE LAKE RESIDENCE
============================================ -->
<section id="usp">
  <div class="sec-inner">
    <div class="center-block reveal">
      <span class="sec-tag">Điểm khác biệt vượt trội</span>
      <h2 class="sec-title">Tại Sao Chọn <em>Jade Lake Residence?</em></h2>
      <div class="gold-rule"></div>
      <p class="sec-desc">
        Trong bối cảnh BĐS phía Tây Hà Nội tăng trưởng mạnh, Jade Lake Residence sở hữu 4 lợi thế cốt lõi mà không dự án nào trong khu vực có được đồng thời.
      </p>
    </div>
    <div class="usp-grid">
      <div class="usp-card reveal reveal-delay-1">
        <div class="usp-num-bg">01</div>
        <div class="usp-icon-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div class="usp-title">Đại lộ Tây Thăng Long 60m — Vị trí vàng</div>
        <div class="usp-body">
          Nằm trực diện trục đại lộ 10 làn xe, kết nối liền mạch StarLake Tây Hồ Tây, vành đai 3.5, tuyến Metro 3 &amp; 4 đang thi công. Đắc địa kinh doanh, tiếp cận 10+ tiện ích đô thị trong bán kính 5km.
        </div>
        <span class="usp-tag">6 phút đến StarLake &amp; Ngoại giao đoàn</span>
      </div>
      <div class="usp-card reveal reveal-delay-2">
        <div class="usp-num-bg">02</div>
        <div class="usp-icon-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
        </div>
        <div class="usp-title">Hồ điều hòa 8ha — Độc bản khu Tây Hà Nội</div>
        <div class="usp-body">
          Hồ điều hòa thiên nhiên 8 hecta kề sát dự án — kết hợp công viên cây xanh tạo không gian "xanh giữa lòng phố thị" cực hiếm. 8 căn biệt thự view hồ trực diện có giá trị tích lũy vượt trội dài hạn.
        </div>
        <span class="usp-tag">Biệt thự view hồ — Chỉ 8 căn độc bản</span>
      </div>
      <div class="usp-card reveal reveal-delay-3">
        <div class="usp-num-bg">03</div>
        <div class="usp-icon-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20M4 20V10l8-7 8 7v10M9 20v-5a3 3 0 016 0v5"/></svg>
        </div>
        <div class="usp-title">Shophouse Tân cổ điển — Ở &amp; Kinh doanh</div>
        <div class="usp-body">
          82 liền kề shophouse 6 tầng + hầm riêng, diện tích 94–212m², thiết kế Tân cổ điển châu Âu sang trọng. Công năng linh hoạt: an cư, văn phòng, kinh doanh hoặc cho thuê sinh lời bền vững.
        </div>
        <span class="usp-tag">94m² – 212m² · 6 tầng nổi + 1 hầm</span>
      </div>
      <div class="usp-card reveal reveal-delay-4">
        <div class="usp-num-bg">04</div>
        <div class="usp-icon-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
        </div>
        <div class="usp-title">Tiềm năng tăng giá — Đón đầu quy hoạch</div>
        <div class="usp-body">
          Bắc Từ Liêm đang đô thị hóa cao tốc, giá đất tăng đều hàng năm. Tuyến Metro 3, 4 + đại lộ Tây Thăng Long + các KĐT lớn lân cận là nền tảng vững chắc cho tăng trưởng giá trị dài hạn.
        </div>
        <span class="usp-tag">Tiếp giáp Avenue Garden · Đối diện Metro</span>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     PRODUCTS
============================================ -->
<section id="products">
  <div class="sec-inner">
    <div class="reveal">
      <span class="sec-tag">Sản phẩm dự án</span>
      <h2 class="sec-title">Lựa Chọn <em>Dòng Sản Phẩm</em></h2>
      <div class="gold-rule"></div>
      <p class="sec-desc">Tổng 90 căn thấp tầng cao cấp, chia thành 2 dòng sản phẩm — thiết kế Tân cổ điển châu Âu, bàn giao hoàn thiện mặt ngoài.</p>
    </div>
    <div class="product-grid reveal">
      <!-- Liền kề Shophouse -->
      <div class="product-card">
        <div class="prod-img-wrap">
          <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/phoi-canh-jade-lake-residence-1.jpg" alt="Liền kề Shophouse Jade Lake Residence" loading="lazy" />
          <div class="prod-badge">82 Căn Liền Kề</div>
        </div>
        <div class="prod-body">
          <div class="prod-name">Liền kề Shophouse</div>
          <div class="prod-price">Từ 280 triệu/m² · Ưu đãi theo đợt F1</div>
          <ul class="prod-specs">
            <li><strong>Diện tích:</strong> 94m² – 212m²</li>
            <li><strong>Kết cấu:</strong> 6 tầng nổi + 1 tầng hầm</li>
            <li><strong>Bàn giao:</strong> Thô bên trong, hoàn thiện mặt ngoài</li>
            <li><strong>Đặt cọc:</strong> 1.000.000.000 VNĐ (TTĐC)</li>
            <li><strong>Công năng:</strong> Ở + Kinh doanh + Cho thuê</li>
            <li><strong>Vị trí:</strong> Mặt đại lộ Tây Thăng Long 60m</li>
          </ul>
          <button class="btn-prod" onclick="goRegister()">Đăng Ký Xem Nhà Mẫu</button>
        </div>
      </div>
      <!-- Biệt thự -->
      <div class="product-card">
        <div class="prod-img-wrap">
          <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/biet-thu-jade-lake-residence-view-ho-1.jpg" alt="Biệt thự view hồ Jade Lake Residence" loading="lazy" />
          <div class="prod-badge">8 Căn — Độc Bản</div>
        </div>
        <div class="prod-body">
          <div class="prod-name">Biệt thự View Hồ Điều Hòa</div>
          <div class="prod-price">Giá liên hệ · Đặt chỗ ưu tiên sớm</div>
          <ul class="prod-specs">
            <li><strong>Diện tích:</strong> 136m² – 200m²</li>
            <li><strong>Kết cấu:</strong> 6 tầng nổi + 1 tầng hầm</li>
            <li><strong>Đặc quyền:</strong> View trực diện hồ điều hòa 8ha</li>
            <li><strong>Bàn giao:</strong> Thô bên trong, hoàn thiện mặt ngoài</li>
            <li><strong>Số lượng:</strong> Chỉ 8 căn — Cực kỳ khan hiếm</li>
            <li><strong>Giá trị:</strong> Tích lũy dài hạn, tăng giá vượt trội</li>
          </ul>
          <button class="btn-prod" onclick="goRegister()">Tư Vấn Ngay Hôm Nay</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     CHÍNH SÁCH BÁN HÀNG & THANH TOÁN
============================================ -->
<section id="payment">
  <div class="sec-inner">
    <div class="center-block reveal">
      <span class="sec-tag">Chính sách bán hàng chính thức — 04/2026</span>
      <h2 class="sec-title">Tiến Độ <em>Thanh Toán</em></h2>
      <div class="gold-rule"></div>
      <p class="sec-desc" data-style="inline-9c362a">
        2 phương thức thanh toán linh hoạt — Vốn tự có hưởng chiết khấu 4.5% hoặc vay ngân hàng với hỗ trợ lãi suất 0% trong 12 tháng.
      </p>
    </div>

    <!-- Quà tặng Tài Lộc Banner -->
    <div class="tailoc-banner reveal">
      <div class="tailoc-icon">🏆</div>
      <div class="tailoc-body">
        <div class="tailoc-label">Ưu đãi có hạn · 01/04/2026 – 30/06/2026</div>
        <div class="tailoc-title">Quà Tặng "Tài Lộc" — 1 Lượng Vàng SJC</div>
        <div class="tailoc-desc">
          Giao dịch thành công trong thời gian khuyến mãi, nhận ngay 01 lượng vàng SJC quy theo tỷ giá tại thời điểm đặt cọc — trừ trực tiếp vào giá hợp đồng chuyển nhượng.
        </div>
      </div>
      <button class="tailoc-cta" onclick="goRegister()">Nhận Ưu Đãi Ngay</button>
    </div>

    <!-- 2-Track Payment Grid -->
    <div class="pay-grid reveal">

      <!-- Track 1: Vốn tự có -->
      <div class="pay-track">
        <div class="pay-track-label">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/></svg>
          Phương thức 1 — Vốn Tự Có
        </div>
        <div class="pay-track-title">Thanh Toán Nhanh<br>Chiết Khấu 4.5%</div>
        <div class="pay-track-rows">
          <div class="pay-row">
            <div class="pay-row-dot">A</div>
            <div class="pay-row-body">
              <div class="pay-row-name">Tiền đặt cọc (TTĐC)</div>
              <div class="pay-row-val">1.000.000.000 đ</div>
              <div class="pay-row-sub">Tại thời điểm ký Thỏa thuận đặt cọc</div>
            </div>
          </div>
          <div class="pay-row">
            <div class="pay-row-dot">B</div>
            <div class="pay-row-body">
              <div class="pay-row-name">Đợt 1 — Ký HĐ chuyển nhượng</div>
              <div class="pay-row-val">100% Giá trị BĐS</div>
              <div class="pay-row-sub">Trong vòng 10 ngày kể từ ngày ký TTĐC · Đã bao gồm tiền cọc</div>
            </div>
          </div>
        </div>
        <div class="pay-highlight-badge">
          ✦ Chiết khấu ngay 4.5% tổng giá trị BĐS (đã VAT)
        </div>
      </div>

      <!-- Track 2: Vay ngân hàng -->
      <div class="pay-track">
        <div class="pay-track-label">
          <svg viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="3" width="20" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2"/><line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2"/></svg>
          Phương thức 2 — Vay Ngân Hàng
        </div>
        <div class="pay-track-title">Hỗ Trợ Lãi Suất 0%<br>Trong 12 Tháng</div>
        <div class="pay-track-rows">
          <div class="pay-row">
            <div class="pay-row-dot">A</div>
            <div class="pay-row-body">
              <div class="pay-row-name">Tiền đặt cọc (TTĐC)</div>
              <div class="pay-row-val">1.000.000.000 đ</div>
              <div class="pay-row-sub">Tại thời điểm ký Thỏa thuận đặt cọc</div>
            </div>
          </div>
          <div class="pay-row">
            <div class="pay-row-dot">B</div>
            <div class="pay-row-body">
              <div class="pay-row-name">Đợt 1 — Khách hàng tự trả</div>
              <div class="pay-row-val">30% Giá trị BĐS</div>
              <div class="pay-row-sub">Trong 10 ngày từ ký TTĐC · Đã bao gồm tiền cọc</div>
            </div>
          </div>
          <div class="pay-row">
            <div class="pay-row-dot">C</div>
            <div class="pay-row-body">
              <div class="pay-row-name">Ngân hàng giải ngân</div>
              <div class="pay-row-val">Đến đủ 100%</div>
              <div class="pay-row-sub">Vay tối đa 70% giá trị BĐS · HTLS 0% khoản vay ≤50% trong 12 tháng</div>
            </div>
          </div>
        </div>
        <div class="pay-highlight-badge">
          ✦ HTLS 0% — 12 tháng · Vay tối đa 70% giá trị BĐS
        </div>
      </div>

    </div><!-- /.pay-grid -->

    <!-- Legal note -->
    <div class="pay-note reveal">
      <div class="pay-note-icon">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
      </div>
      <div class="pay-note-text">
        <strong>Chính sách áp dụng từ 01/04/2026.</strong> Tổng giá trị BĐS = Giá niêm yết sau khi trừ Quà tặng &amp; chiết khấu. Tỷ lệ thanh toán có thể thay đổi tùy từng căn và ngân hàng. Chi tiết chính sách &amp; phiếu tính giá: <strong>0972.991.551</strong> (STND F1).
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     MẶT BẰNG DỰ ÁN
============================================ -->
<section id="mat-bang">
  <div class="sec-inner">
    <div class="center-block reveal">
      <span class="sec-tag">Mặt bằng dự án</span>
      <h2 class="sec-title">Layout &amp; <em>Mặt Bằng</em></h2>
      <div class="gold-rule"></div>
      <p class="sec-desc">3 loại mặt bằng linh hoạt — từ liền kề nhỏ đến liền kề lớn và biệt thự view hồ. Click vào từng tab để xem chi tiết.</p>
    </div>

    <!-- TAB NAVIGATION -->
    <div class="mb-tabs reveal">
      <button class="mb-tab active" data-tab="tong-the" onclick="switchTab(this,'tong-the')">
        <span class="mb-tab-icon">🗺️</span>
        <span class="mb-tab-label">Tổng thể &amp; Giá</span>
      </button>
      <button class="mb-tab" data-tab="lien-ke-nho" onclick="switchTab(this,'lien-ke-nho')">
        <span class="mb-tab-icon">🏠</span>
        <span class="mb-tab-label">Liền kề Nhỏ</span>
        <span class="mb-tab-sub">94–130m²</span>
      </button>
      <button class="mb-tab" data-tab="lien-ke-lon" onclick="switchTab(this,'lien-ke-lon')">
        <span class="mb-tab-icon">🏢</span>
        <span class="mb-tab-label">Liền kề Lớn</span>
        <span class="mb-tab-sub">130–212m²</span>
      </button>
      <button class="mb-tab" data-tab="biet-thu" onclick="switchTab(this,'biet-thu')">
        <span class="mb-tab-icon">🏛️</span>
        <span class="mb-tab-label">Biệt thự</span>
        <span class="mb-tab-sub">136–200m²</span>
      </button>
      <button class="mb-tab" data-tab="tang-ham" onclick="switchTab(this,'tang-ham')">
        <span class="mb-tab-icon">🅿️</span>
        <span class="mb-tab-label">Tầng hầm</span>
        <span class="mb-tab-sub">Để xe riêng</span>
      </button>
    </div>

    <!-- TAB PANELS -->
    <div class="mb-panels">

      <!-- Panel: Tổng thể -->
      <div class="mb-panel active" id="tab-tong-the">
        <div class="mb-panel-layout">
          <div class="mb-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/gia-du-kien-jade-lake-residence.jpg"
              alt="Phối cảnh tổng thể và giá Jade Lake Residence"
              class="mb-main-img" onclick="openLightbox(this.src, this.alt)" loading="lazy" />
            <div class="mb-zoom-hint">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              Click để phóng to
            </div>
          </div>
          <div class="mb-specs">
            <div class="mb-specs-title">Tổng Quan Mặt Bằng Dự Án</div>
            <div class="mb-spec-grid">
              <div class="mb-spec-item">
                <div class="mb-spec-num">90</div>
                <div class="mb-spec-lbl">Tổng số căn</div>
              </div>
              <div class="mb-spec-item">
                <div class="mb-spec-num">82</div>
                <div class="mb-spec-lbl">Liền kề Shophouse</div>
              </div>
              <div class="mb-spec-item">
                <div class="mb-spec-num">8</div>
                <div class="mb-spec-lbl">Biệt thự View Hồ</div>
              </div>
              <div class="mb-spec-item">
                <div class="mb-spec-num">52.4%</div>
                <div class="mb-spec-lbl">Mật độ xây dựng</div>
              </div>
            </div>
            <div class="mb-spec-list">
              <div class="mb-spec-row">
                <span class="mb-spec-key">Tổng diện tích khu đất</span>
                <span class="mb-spec-val">15.828 m²</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Mặt tiền đại lộ</span>
                <span class="mb-spec-val">Đại lộ Tây Thăng Long 60m</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Kết cấu tất cả căn</span>
                <span class="mb-spec-val">6 tầng nổi + 1 tầng hầm</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Bàn giao</span>
                <span class="mb-spec-val">Thô trong, hoàn thiện ngoài</span>
              </div>
              <div class="mb-spec-row highlight">
                <span class="mb-spec-key">Giá khởi điểm</span>
                <span class="mb-spec-val" data-style="inline-102a89">Từ 280 triệu/m²</span>
              </div>
            </div>
            <button class="btn-mb-cta" onclick="goRegister()">Nhận Bảng Giá Chi Tiết Từng Lô</button>
          </div>
        </div>
      </div>

      <!-- Panel: Liền kề nhỏ -->
      <div class="mb-panel" id="tab-lien-ke-nho">
        <div class="mb-panel-layout">
          <div class="mb-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/layout-lien-ke-nho-jade-lake-residence.jpg"
              alt="Layout liền kề nhỏ Jade Lake Residence"
              class="mb-main-img" onclick="openLightbox(this.src, this.alt)" loading="lazy" />
            <div class="mb-zoom-hint">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              Click để phóng to
            </div>
          </div>
          <div class="mb-specs">
            <div class="mb-specs-title">Liền Kề Nhỏ — Shophouse</div>
            <div class="mb-spec-list">
              <div class="mb-spec-row">
                <span class="mb-spec-key">Loại sản phẩm</span>
                <span class="mb-spec-val">Liền kề Shophouse</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Diện tích đất</span>
                <span class="mb-spec-val"><strong>94m² – 130m²</strong></span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Kết cấu</span>
                <span class="mb-spec-val">6 tầng nổi + 1 tầng hầm</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Mặt tiền</span>
                <span class="mb-spec-val">Tiếp giáp đường nội khu</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Công năng</span>
                <span class="mb-spec-val">Ở + Kinh doanh + Cho thuê</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Phong cách</span>
                <span class="mb-spec-val">Tân cổ điển châu Âu</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Bàn giao</span>
                <span class="mb-spec-val">Thô bên trong, hoàn thiện ngoài</span>
              </div>
              <div class="mb-spec-row highlight">
                <span class="mb-spec-key">Giá dự kiến</span>
                <span class="mb-spec-val" data-style="inline-102a89">Từ 280 triệu/m²</span>
              </div>
            </div>
            <div class="mb-note">💡 Phù hợp cho gia đình trẻ, nhà đầu tư ngân sách linh hoạt, hoặc mở văn phòng tầng 1.</div>
            <button class="btn-mb-cta" onclick="goRegister()">Tư Vấn Ngay Loại Này</button>
          </div>
        </div>
      </div>

      <!-- Panel: Liền kề lớn -->
      <div class="mb-panel" id="tab-lien-ke-lon">
        <div class="mb-panel-layout">
          <div class="mb-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/layout-lien-ke-lon-jade-lake-residence.jpg"
              alt="Layout liền kề lớn Jade Lake Residence"
              class="mb-main-img" onclick="openLightbox(this.src, this.alt)" loading="lazy" />
            <div class="mb-zoom-hint">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              Click để phóng to
            </div>
          </div>
          <div class="mb-specs">
            <div class="mb-specs-title">Liền Kề Lớn — Shophouse Premium</div>
            <div class="mb-spec-list">
              <div class="mb-spec-row">
                <span class="mb-spec-key">Loại sản phẩm</span>
                <span class="mb-spec-val">Liền kề Shophouse Premium</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Diện tích đất</span>
                <span class="mb-spec-val"><strong>130m² – 212m²</strong></span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Kết cấu</span>
                <span class="mb-spec-val">6 tầng nổi + 1 tầng hầm</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Mặt tiền</span>
                <span class="mb-spec-val">Rộng, tiếp giáp đường nội khu lớn</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Ưu điểm</span>
                <span class="mb-spec-val">Diện tích lớn, không gian sống rộng rãi</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Công năng</span>
                <span class="mb-spec-val">Ở + Kinh doanh lớn + Cho thuê cao cấp</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Phong cách</span>
                <span class="mb-spec-val">Tân cổ điển châu Âu</span>
              </div>
              <div class="mb-spec-row highlight">
                <span class="mb-spec-key">Giá dự kiến</span>
                <span class="mb-spec-val" data-style="inline-102a89">Liên hệ tư vấn</span>
              </div>
            </div>
            <div class="mb-note">💡 Lý tưởng cho doanh nghiệp, showroom, nhà hàng hoặc gia đình nhiều thế hệ cần không gian lớn.</div>
            <button class="btn-mb-cta" onclick="goRegister()">Tư Vấn Ngay Loại Này</button>
          </div>
        </div>
      </div>

      <!-- Panel: Biệt thự -->
      <div class="mb-panel" id="tab-biet-thu">
        <div class="mb-panel-layout">
          <div class="mb-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/layout-biet-thu-jade-lake-residence.jpg"
              alt="Layout biệt thự Jade Lake Residence"
              class="mb-main-img" onclick="openLightbox(this.src, this.alt)" loading="lazy" />
            <div class="mb-zoom-hint">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              Click để phóng to
            </div>
          </div>
          <div class="mb-specs">
            <div class="mb-specs-title">Biệt Thự View Hồ — Độc Bản</div>
            <div class="mb-spec-list">
              <div class="mb-spec-row">
                <span class="mb-spec-key">Loại sản phẩm</span>
                <span class="mb-spec-val"><strong>Biệt thự đơn lập</strong></span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Số lượng</span>
                <span class="mb-spec-val"><strong data-style="inline-f8caff">Chỉ 8 căn — Khan hiếm tuyệt đối</strong></span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Diện tích đất</span>
                <span class="mb-spec-val"><strong>136m² – 200m²</strong></span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Kết cấu</span>
                <span class="mb-spec-val">6 tầng nổi + 1 tầng hầm</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Đặc quyền</span>
                <span class="mb-spec-val">View trực diện hồ điều hòa 8ha</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Phong cách</span>
                <span class="mb-spec-val">Tân cổ điển châu Âu sang trọng</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Bàn giao</span>
                <span class="mb-spec-val">Thô bên trong, hoàn thiện mặt ngoài</span>
              </div>
              <div class="mb-spec-row highlight">
                <span class="mb-spec-key">Giá</span>
                <span class="mb-spec-val" data-style="inline-102a89">Liên hệ để nhận ưu đãi F1</span>
              </div>
            </div>
            <div class="mb-note">🏆 Sản phẩm đặc biệt — Giá trị tích lũy vượt trội dài hạn nhờ view hồ độc quyền.</div>
            <button class="btn-mb-cta" onclick="goRegister()">Đặt Chỗ Ưu Tiên Ngay</button>
          </div>
        </div>
      </div>

      <!-- Panel: Tầng hầm -->
      <div class="mb-panel" id="tab-tang-ham">
        <div class="mb-panel-layout">
          <div class="mb-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/mat-bang-lien-ke-jade-lake-residence-tang-ham.jpg"
              alt="Mặt bằng tầng hầm liền kề Jade Lake Residence"
              class="mb-main-img" onclick="openLightbox(this.src, this.alt)" loading="lazy" />
            <div class="mb-zoom-hint">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              Click để phóng to
            </div>
          </div>
          <div class="mb-specs">
            <div class="mb-specs-title">Mặt Bằng Tầng Hầm</div>
            <div class="mb-spec-list">
              <div class="mb-spec-row">
                <span class="mb-spec-key">Tầng hầm</span>
                <span class="mb-spec-val"><strong>Riêng biệt từng căn</strong></span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Công năng chính</span>
                <span class="mb-spec-val">Gara ô tô + xe máy riêng tư</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Diện tích hầm</span>
                <span class="mb-spec-val">Tương ứng diện tích lô đất</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Lối vào</span>
                <span class="mb-spec-val">Cổng riêng, hệ thống cửa tự động</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Áp dụng</span>
                <span class="mb-spec-val">Toàn bộ 90 căn (LK + BT)</span>
              </div>
              <div class="mb-spec-row">
                <span class="mb-spec-key">Tiêu chuẩn</span>
                <span class="mb-spec-val">Chống thấm · Thông gió · PCCC</span>
              </div>
            </div>
            <div class="mb-note">🚗 Mỗi căn có 1 tầng hầm riêng — Tiện ích cao cấp hiếm thấy ở phân khúc liền kề thông thường.</div>
            <button class="btn-mb-cta" onclick="goRegister()">Tư Vấn &amp; Nhận Bảng Giá</button>
          </div>
        </div>
      </div>

    </div><!-- /.mb-panels -->
  </div>
</section>

<!-- Lightbox for floor plans -->
<div id="mb-lightbox" class="mb-lightbox" onclick="closeLightbox()">
  <div class="mb-lb-inner" onclick="event.stopPropagation()">
    <button class="mb-lb-close" onclick="closeLightbox()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <img id="mb-lb-img" src="" alt="" />
    <div id="mb-lb-caption" class="mb-lb-caption"></div>
  </div>
</div>

<!-- ============================================
     LOCATION
============================================ -->
<section id="location">
  <div class="sec-inner">
    <div class="loc-layout">
      <div class="loc-img-wrap reveal">
        <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/vi-tri-du-an-jade-lake-residence-1.jpg" alt="Vị trí chiến lược Jade Lake Residence" loading="lazy" />
        <div class="loc-stamp">Bắc Từ Liêm · Hà Nội</div>
      </div>
      <div class="reveal">
        <span class="sec-tag">Kết nối đô thị</span>
        <h2 class="sec-title">Vị Trí <em>Chiến Lược</em></h2>
        <div class="gold-rule"></div>
        <div class="loc-points">
          <div class="loc-point">
            <div class="loc-num">60m</div>
            <div class="loc-text">
              <strong>Đại lộ Tây Thăng Long — 10 làn xe</strong>
              <span>Trục đường huyết mạch, kết nối toàn bộ phía Tây Hà Nội nhanh chóng, thông suốt</span>
            </div>
          </div>
          <div class="loc-point">
            <div class="loc-num">6'</div>
            <div class="loc-text">
              <strong>KĐT StarLake Tây Hồ Tây &amp; Ngoại giao đoàn</strong>
              <span>Qua đường Phạm Văn Đồng, Văn Tiến Dũng, Vành đai 3.5</span>
            </div>
          </div>
          <div class="loc-point">
            <div class="loc-num">15'</div>
            <div class="loc-text">
              <strong>Hồ Tây &amp; Trung tâm thành phố Hà Nội</strong>
              <span>Kết hợp tuyến Metro số 3 &amp; 4 đang triển khai song song</span>
            </div>
          </div>
        </div>
        <div class="dist-grid">
          <div class="dist-card">
            <div class="dist-time">5km</div>
            <div class="dist-place">StarLake · Vinhomes Đan Phượng · AEON MALL · Ga Nhổn</div>
          </div>
          <div class="dist-card">
            <div class="dist-time">8km</div>
            <div class="dist-place">Keangnam Landmark72 · SVĐ Mỹ Đình</div>
          </div>
          <div class="dist-card">
            <div class="dist-time">10km</div>
            <div class="dist-place">TT Hội nghị Quốc gia · Lăng Chủ tịch HCM</div>
          </div>
          <div class="dist-card">
            <div class="dist-time">13km</div>
            <div class="dist-place">Hồ Hoàn Kiếm · Phố cổ Hà Nội</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================
     AMENITIES
============================================ -->
<section id="amenities">
  <div class="sec-inner">
    <div class="center-block reveal" data-style="inline-2753a3">
      <span class="sec-tag">Tiện ích nội khu</span>
      <h2 class="sec-title">Trải Nghiệm <em>Đẳng Cấp</em> Mỗi Ngày</h2>
      <div class="gold-rule"></div>
    </div>
    <div class="amen-grid reveal">
      <div class="amen-card"><div class="amen-icon">🏞️</div><div class="amen-label">Hồ điều hòa 8ha</div></div>
      <div class="amen-card"><div class="amen-icon">🌳</div><div class="amen-label">Công viên cây xanh</div></div>
      <div class="amen-card"><div class="amen-icon">🏛️</div><div class="amen-label">Quảng trường &amp; Cổng chào</div></div>
      <div class="amen-card"><div class="amen-icon">🏊</div><div class="amen-label">Bể bơi ngoài trời</div></div>
      <div class="amen-card"><div class="amen-icon">🏫</div><div class="amen-label">Trường học liên cấp</div></div>
      <div class="amen-card"><div class="amen-icon">🍽️</div><div class="amen-label">Nhà hàng cao cấp</div></div>
      <div class="amen-card"><div class="amen-icon">🏥</div><div class="amen-label">Bệnh viện lân cận</div></div>
      <div class="amen-card"><div class="amen-icon">🔐</div><div class="amen-label">An ninh 24/7</div></div>
    </div>
  </div>
</section>

<!-- ============================================
     GALLERY
============================================ -->
<section id="gallery" data-style="inline-ff4fc9">
  <div class="sec-inner">
    <div class="center-block reveal" data-style="inline-60417c">
      <span class="sec-tag">Thư viện ảnh dự án</span>
      <h2 class="sec-title">Khám Phá <em>Không Gian Sống</em></h2>
      <div class="gold-rule"></div>
    </div>
    <div class="gallery-grid reveal">
      <div class="gal-item big">
        <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/biet-thu-jade-lake-residence-view-ho-1.jpg" alt="Biệt thự view hồ điều hòa 8ha" loading="lazy" />
        <div class="gal-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <div class="gal-caption">Biệt thự view hồ điều hòa 8ha</div>
      </div>
      <div class="gal-item">
        <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/cong-vien-jade-lake-residence-2.jpg" alt="Công viên cây xanh nội khu" loading="lazy" />
        <div class="gal-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <div class="gal-caption">Công viên cây xanh nội khu</div>
      </div>
      <div class="gal-item">
        <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/z6424902540415_fb7887855c548207c76cff193a0d7c5c.jpg" alt="Phối cảnh dự án" loading="lazy" />
        <div class="gal-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <div class="gal-caption">Phối cảnh khu đô thị</div>
      </div>
      <div class="gal-item">
        <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/ban-cong-jade-lake-residence-view-ho-1.jpg" alt="Ban công view hồ" loading="lazy" />
        <div class="gal-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <div class="gal-caption">Ban công view hồ điều hòa</div>
      </div>
      <div class="gal-item">
        <img src="<?php echo get_template_directory_uri(); ?>/images/jade-lake/phoi-canh-jade-lake-residence-1.jpg" alt="Shophouse liền kề" loading="lazy" />
        <div class="gal-overlay"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <div class="gal-caption">Liền kề shophouse Tân cổ điển</div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================
     REGISTER CTA SECTION
============================================ -->
<section id="register">
  <div class="sec-inner">
    <div class="reg-text reveal">
      <span class="sec-tag">Đăng ký tư vấn miễn phí</span>
      <h2 class="sec-title">Nhận Ngay <br> <em>Bảng Giá &amp; Chiết Khấu F1</em></h2>
      <div class="gold-rule"></div>
      <p class="reg-lead">
        Là Đại lý F1 chính thức được Chủ đầu tư ủy quyền, STND cam kết cung cấp thông tin chính xác nhất, giá tốt nhất thị trường và hỗ trợ toàn diện từ đặt cọc đến nhận sổ đỏ.
      </p>
      <ul class="reg-perks">
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          Nhận bảng giá chi tiết từng lô — cập nhật mới nhất
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          <strong data-style="inline-cf62eb">Chiết khấu 4.5%</strong>&nbsp;thanh toán vốn tự có — không qua trung gian
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          <strong data-style="inline-cf62eb">HTLS 0% · 12 tháng</strong>&nbsp;— vay tối đa 70% giá trị BĐS
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          🏆 Quà tặng <strong data-style="inline-cf62eb">"Tài Lộc" 1 lượng vàng SJC</strong> — hết 30/06/2026
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          Đồng hành pháp lý từ đặt cọc → nhận GCN sổ đỏ
        </li>
      </ul>
    </div>
    <div class="reg-form-card reveal reveal-delay-1">
      <div class="fc-title">Đăng Ký Nhận Thông Tin</div>
      <div class="fc-sub">Tư vấn viên liên hệ trong 15 phút</div>
      <form id="regForm" novalidate>
        <div class="form-group" id="rg-name">
          <label for="rName">Họ và Tên *</label>
          <input type="text" id="rName" placeholder="Nguyễn Văn A" autocomplete="name" />
          <div class="err-msg">Vui lòng nhập họ và tên</div>
        </div>
        <div class="form-group" id="rg-phone">
          <label for="rPhone">Số Điện Thoại *</label>
          <input type="tel" id="rPhone" placeholder="09xx.xxx.xxx" autocomplete="tel" />
          <div class="err-msg">Vui lòng nhập số điện thoại hợp lệ</div>
        </div>
        <div class="form-group">
          <label for="rInterest">Quan tâm sản phẩm</label>
          <select id="rInterest" data-style="inline-ea2ace">
            <option value="">— Chọn loại sản phẩm —</option>
            <option value="lien-ke">Liền kề Shophouse (từ 280tr/m²)</option>
            <option value="biet-thu">Biệt thự View Hồ (8 căn độc bản)</option>
            <option value="ca-hai">Đang cân nhắc cả hai</option>
          </select>
        </div>
        <button type="submit" class="btn-cta-main" id="rSubmit">
          Đăng Ký Nhận Báo Giá Ngay
        </button>
        <div class="form-secure">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
          Cam kết bảo mật thông tin — Không spam
        </div>
      </form>
    </div>
  </div>
</section>

<!-- ============================================
     FOOTER
============================================ -->
<footer>
  <div class="foot-inner">
    <div class="foot-grid">
      <div class="foot-logo">
        <img src="https://stnd.vn/wp-content/uploads/2025/11/LOGO-01-1.png" alt="STND – Siêu Thị Nhà Đất" />
        <p class="foot-about">Đại lý F1 phân phối chính thức dự án Jade Lake Residence Tây Thăng Long. Cam kết thông tin chính xác, tư vấn chuyên nghiệp, đồng hành trọn vẹn trong mỗi giao dịch bất động sản.</p>
      </div>
      <div class="foot-col">
        <h5>Thông tin đại lý</h5>
        <p><strong>Siêu Thị Nhà Đất – STND</strong></p>
        <p>262 Tây Sơn, Đống Đa, Hà Nội</p>
        <a href="tel:0972991551">📞 Hotline: 0972.991.551</a>
        <a href="https://zalo.me/0972991551" target="_blank">💬 Zalo: 0972.991.551</a>
        <a href="https://stnd.vn" target="_blank">🌐 www.stnd.vn</a>
      </div>
      <div class="foot-col">
        <h5>Dự án Jade Lake Residence</h5>
        <p><strong>Chủ đầu tư:</strong> Cty TNHH Xuân Trường Hoành Bồ</p>
        <p><strong>Địa chỉ:</strong> Lô TT-07 đường Tây Thăng Long, Tây Tựu, Bắc Từ Liêm, Hà Nội</p>
        <p><strong>Quy mô:</strong> 90 căn · 15.828m² tổng thể</p>
        <p><strong>Mật độ XD:</strong> 52.4%</p>
        <p><strong>Giá từ:</strong> 280 triệu/m²</p>
      </div>
    </div>
    <div class="foot-disclaimer">
      ⚠️ Thông tin trên trang này do Đại lý F1 STND.vn cung cấp dựa trên tài liệu của Chủ đầu tư. Hình ảnh mang tính chất minh họa. Thông số kỹ thuật, giá bán và chính sách có thể thay đổi theo quyết định của Chủ đầu tư tại từng thời điểm. Vui lòng liên hệ tư vấn viên để xác nhận thông tin chính thức trước khi ra quyết định đầu tư.
    </div>
    <div class="foot-bottom">
      <span>© 2025 STND.vn — Siêu Thị Nhà Đất. All rights reserved.</span>
      <span>Đại lý F1 phân phối độc quyền Jade Lake Residence Tây Thăng Long</span>
    </div>
  </div>
</footer>

<!-- ============================================
     FLOATING BUTTONS
============================================ -->
<div class="floating-wrap">
  <a href="https://zalo.me/0972991551" class="fl-btn fl-zalo" title="Chat Zalo ngay" target="_blank" rel="noopener">Z</a>
  <a href="tel:0972991551" class="fl-btn fl-phone" title="Gọi ngay">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.32.57 3.58.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.82 21 3 13.18 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.23 1.01L6.6 10.8z"/></svg>
  </a>
</div>

<!-- ============================================
     MOBILE STICKY CTA
============================================ -->
<div id="m-cta">
  <a href="tel:0972991551" class="m-cta-call">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.32.57 3.58.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.82 21 3 13.18 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.23 1.01L6.6 10.8z"/></svg>
    Gọi Tư Vấn Ngay
  </a>
  <a href="https://zalo.me/0972991551" class="m-cta-zalo" target="_blank">
    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
    Chat Zalo
  </a>
</div>

<!-- ============================================
     SUCCESS MODAL
============================================ -->
<div class="modal-bg" id="successModal" role="dialog" aria-modal="true">
  <div class="modal-box">
    <div class="modal-ic">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div class="modal-h">Đăng Ký Thành Công!</div>
    <p class="modal-p">
      Cảm ơn bạn đã quan tâm đến <strong>Jade Lake Residence</strong>.<br/>
      Tư vấn viên <strong>STND</strong> sẽ liên hệ với bạn <strong>trong vòng 15 phút</strong> để cung cấp bảng giá chi tiết và chính sách ưu đãi F1 tốt nhất.
    </p>
    <button class="modal-btn" id="closeModal">Đã Hiểu — Cảm Ơn!</button>
  </div>
</div>

<!-- ============================================
     JAVASCRIPT
============================================ -->

    <?php wp_footer(); ?>
</body>
</html>
