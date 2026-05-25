<?php
/**
 * Template Name: Noble Palace
 * 
 * A premium landing page template for Noble Palace Tây Thăng Long.
 */
$theme_uri = get_template_directory_uri();

// Ensure the theme's Speed Optimizer (hpp) does not rewrite images we explicitly want to load immediately
add_filter('hpp_disallow_lazyload', function($ok, $tag){
    if (strpos($tag, 'penci-disable-lazy') !== false) {
        return 1;
    }
    return $ok;
}, 99, 2);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php 
  add_action('wp_enqueue_scripts', function() {
    // Enqueue Google Fonts
    wp_enqueue_style('np-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Playfair+Display+SC:wght@400;700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=Playball&family=Inter:wght@300;400;500&family=Ms+Madi&display=swap', array(), null);
    
    // Custom Style & Scripts
    wp_enqueue_style('noble-palace-style', get_template_directory_uri() . '/css/noble-palace.css', array(), '1.0.5');
    wp_enqueue_script('noble-palace-script', get_template_directory_uri() . '/js/noble-palace.js', array('jquery'), '1.0.5', true);
  }, 100);

  add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('tailwind');
    wp_dequeue_script('tailwind');
  }, 999);

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
  <p>Website: <span class="gold-text"><a href="https://stnd.vn" target="_blank">stnd.vn</a></span></p>
  <button class="close-btn" onclick="document.getElementById('top-bar').style.display='none'">✕</button>
</div>

<!-- HEADER -->
<header class="header">
  <div class="header-logo">
    <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/logo.webp" alt="Noble Palace Logo" width="39" height="44" />
    <div class="logo-text">
      <span class="logo-name">Noble PALACE</span>
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
  <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/hero-bg.webp" 
       srcset="<?php echo get_template_directory_uri(); ?>/images/noble-palace/hero-bg-mobile.webp 768w, <?php echo get_template_directory_uri(); ?>/images/noble-palace/hero-bg.webp 1920w"
       sizes="100vw"
       alt="Noble Palace Background"
       class="hero-bg penci-disable-lazy skip-lazy no-lazy"
       data-skip-lazy="1"
       data-no-lazy="1"
       data-rocket-lazyload="ignore"
       fetchpriority="high"
       width="1920"
       height="1080" />
  <div class="hero-overlay"></div>
  <div class="hero-inner">
    <div class="hero-content fade-in-left">
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
    <div class="hero-form-card fade-in-right" id="hero-form">
      <div class="form-tag">
        <div class="dot"></div>
        <span>Còn 15 suất ngoại giao vị trí đẹp nhất · Cập nhật hôm nay</span>
      </div>
      <p class="form-title">Nhận Báo Giá Ưu Đãi</p>
      <p class="form-sub">Chuyên viên STND liên hệ trong 15 phút</p>
      <div class="form-cf7-wrap">
        <?php echo do_shortcode('[contact-form-7 id="3c72e7e" title="Noble Palace - Liên hệ"]'); ?>
      </div>
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
          <div class="card-urgency"><div class="dot"></div> Còn 5 căn · Vị trí đỉnh nhất dự án</div>
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
            <div class="card-finance">Full giá 34–36 tỷ · Giảm thẳng 2 tỷ khi ký HĐ</div>
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
<section class="policy-sec section bg-white" id="policy">
  <div class="section-inner">
    <div class="section-head">
      <span class="section-label">Chính Sách Bán Hàng · Áp dụng từ 13/05/2026</span>
      <h2 class="section-title">Ưu Đãi Vượt Trội —<br /><span class="gold">Gần 1,12 Tỷ Đồng</span></h2>
      <div class="section-rule"></div>
    </div>

    <!-- TỔNG QUAN CHÍNH SÁCH -->
    <div class="policy-overview">
      <div class="policy-overview-item">
        <div>
          <div class="policy-overview-label">Chiết khấu lên đến</div>
          <div class="policy-overview-val gold"><span class="counter" data-target="12.7" data-decimals="1" data-separator=",">0</span><span>%</span></div>
        </div>
      </div>
      <div class="policy-overview-item">
        <div>
          <div class="policy-overview-label">Chính sách ưu đãi lên đến gần</div>
          <div class="policy-overview-val gold"><span class="counter" data-target="1.12" data-decimals="2" data-separator=",">0</span><span> Tỷ</span></div>
        </div>
      </div>
    </div>

    <!-- 3 CHÍNH SÁCH CHÍNH -->
    <div class="policy-grid mt-1">
      <!-- LỢI NHUẬN KIM CƯƠNG -->
      <div class="pol-card kim-cuong">
        <div class="pol-card-header">
          <div class="pol-num">01</div>
          <div class="pol-title-1">Lợi Nhuận Kim Cương</div>
        </div>
        <div class="pol-card-benefits">
          <div class="pol-benefit-left">
            <div class="pol-card-benefit-val">720 <span>triệu</span></div>
            <div class="pol-card-benefit-lbl">Lợi nhuận trong 24 tháng</div>
          </div>
          <div class="pol-benefit-right">
            <div class="pol-card-benefit-val">500 <span>triệu</span></div>
            <div class="pol-card-benefit-lbl">Quà tặng nội thất</div>
          </div>
        </div>
      </div>

      <!-- LÃI SUẤT + VAY -->
      <div class="pol-card">
        <div class="pol-num">02</div>
        <div class="pol-title">Hỗ Trợ Vay Tới <span class="counter" data-target="70">0</span>%</div>
        <div class="pol-desc">Nhận nhà trước, áp lực trả nợ tính sau Tận hưởng lộ trình giãn tiến độ, an tâm tuyệt đối suốt 3 năm đầu</div>
        <div class="pol-val">36 tháng ưu đãi lãi suất</div>
      </div>

      <!-- QUÀ TÀI LỘC -->
      <div class="pol-card">
        <div class="pol-num">03</div>
        <div class="pol-title">BÙNG NỔ QUÀ TẶNG: NHẬN NGAY COMBO TÀI LỘC</div>
        <div class="pol-desc">Tặng kèm thẻ KLB trị giá <strong>250 triệu</strong> . Nhân đôi niềm vui với quà tặng an cư thêm 150 TRIỆU.Nhận thêm chiết khấu 1 - 1,5% hỗ trợ hoàn thiện tổ ấm trong mơ.</div>
        <div class="pol-val">150 triệu</div>
      </div>
    </div>

    <!-- 4 ƯU ĐÃI PHỤ -->
    <div class="policy-extras">
      <div class="pe-item">
        <div class="pe-val"><span class="counter" data-target="10">0</span>%</div>
        <div class="pe-label">Chiết khấu TTS thanh toán sớm</div>
      </div>
      <div class="pe-item">
        <div class="pe-val">24T</div>
        <div class="pe-label">Miễn phí quản lý vận hành 5 sao</div>
      </div>
      <div class="pe-item">
        <div class="pe-val"><span class="counter" data-target="250">0</span>tr</div>
        <div class="pe-label">Thẻ KLB tặng kèm tất cả sản phẩm</div>
      </div>
      <div class="pe-item">
        <div class="pe-val"><span class="counter" data-target="8">0</span>%</div>
        <div class="pe-label">Quà Noble HOME+ trên 15% giá trị BĐS</div>
      </div>
    </div>

    <!-- TIẾN ĐỘ THANH TOÁN -->
    <div class="payment-grid-mob">
      <!-- VAY NGÂN HÀNG -->
      <div class="payment-block">
        <div class="payment-block-title">Thanh Toán Vay Ngân Hàng</div>
        <div class="payment-list">
          <div class="payment-row">
            <span class="payment-row-lbl">Đặt cọc</span>
            <span class="payment-row-val">500 tr</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Ký TTĐC</span>
            <span class="payment-row-val">15%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 1 - Ký HĐMB (7 ngày)</span>
            <span class="payment-row-val">10%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 2 (7 ngày)</span>
            <span class="payment-row-val gold">70%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 3 - 100% KPBT (30 ngày)</span>
            <span class="payment-row-val">còn lại</span>
          </div>
          <div class="payment-row last">
            <span class="payment-row-lbl">Đợt 4 - GCN (khấu trừ từ đợt 4)</span>
            <span class="payment-row-val">5%</span>
          </div>
        </div>
      </div>

      <!-- TIẾN ĐỘ -->
      <div class="payment-block">
        <div class="payment-block-title">Thanh Toán Tiến Độ</div>
        <div class="payment-list">
          <div class="payment-row">
            <span class="payment-row-lbl">Đặt cọc</span>
            <span class="payment-row-val">500 tr</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Ký TTĐC</span>
            <span class="payment-row-val">15%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 1 - Ký HĐMB (7 ngày)</span>
            <span class="payment-row-val">10%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 2 (7 ngày)</span>
            <span class="payment-row-val">20%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 3 (30 ngày)</span>
            <span class="payment-row-val">25%</span>
          </div>
          <div class="payment-row">
            <span class="payment-row-lbl">Đợt 4 - 100% KPBT (60 ngày)</span>
            <span class="payment-row-val gold">30%</span>
          </div>
          <div class="payment-row last">
            <span class="payment-row-lbl">Đợt 5 TTBS + Đợt 6 GCN</span>
            <span class="payment-row-val">5%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="policy-banner">
      <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/banner_mer_01.webp" alt="Bốc thăm xe Mercedes" />
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
          <div class="timeline-date">Q3/2024</div>
          <div class="timeline-connector"><div class="timeline-dot"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Khởi công phân khu Legacy · 450 căn lên tầng 2</div>
            <div class="timeline-status">✓ Hoàn thành</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Q1/2025</div>
          <div class="timeline-connector"><div class="timeline-dot"></div></div>
          <div class="timeline-content">
            <div class="timeline-title">Nhà mẫu hoàn thiện · Mở cửa đón khách 15/01/2025</div>
            <div class="timeline-status">✓ Hoàn thành</div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="timeline-date">Hiện tại</div>
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
          <div class="timeline-date">12/2027</div>
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
      <div class="section-head mb-24">
        <span class="section-label">Chính Sách Bán Hàng</span>
        <h2 class="section-title">Thành Phố Không Ngủ<br /><span class="gold italic">All-in-One 365 Ngày</span></h2>
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
            <span class="time"> <span class="unit">Tiếp giáp trực tiếp</span></span>
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

  <!-- <div id="iframe-container">
      <p class="iframe-loading-text">Đang cuộn đến vùng bản đồ 360...</p>
  </div> -->


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
        <div class="agent-motto">Mang đến những Giá trị &amp; Trải nghiệm tuyệt vời cho khách hàng</div>
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
    <p class="footer-copyright">© 2026 STND. All rights reserved.</p>
  </div>
</footer>

<!-- FLOATING SIDEBAR — Figma: Frame 263 (Desktop only) -->
<div class="float-sidebar" id="float-sidebar">
  <!-- Zalo -->
  <a class="float-sidebar-item" href="https://zalo.me/0972991551" target="_blank" rel="noopener" title="Chat Zalo">
    <div class="icon-wrap">
      <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo" />
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



<!-- POPUP KHUYẾN MÃI -->
<div id="np-promo-popup" class="np-popup-overlay">
    <div class="np-popup-content">
        <button class="np-popup-close" id="np-promo-close">&times;</button>
        <picture class="np-popup-img" id="np-promo-img">
            <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/images/noble-palace/popup_mercedes%20-%20mobile.webp">
            <img src="<?php echo get_template_directory_uri(); ?>/images/noble-palace/popup_mercedes.webp" alt="Khuyến mãi Mercedes">
        </picture>
    </div>
</div>

<!-- POPUP FORM ĐĂNG KÝ -->
<div id="np-form-popup" class="np-popup-overlay np-popup-cf7">
    <div class="np-popup-content np-form-content">
        <button class="np-popup-close" id="np-form-close">&times;</button>
        
        <!-- Form Content -->
        <div class="np-form-inner" id="np-form-cf7-inner">
            <div class="np-form-header">
                <img  src="<?php echo site_url('/wp-content/uploads/2025/11/LOGO-01-1.png'); ?>" alt="STND Logo" class="stnd-logo-popup penci-mainlogo" />
                <h3 class="np-form-title">ĐĂNG KÝ ĐẶT CỌC SỚM</h3>
                <p class="np-form-sub">Chuyên viên STND sẽ liên hệ với bạn trong<br>15 phút làm việc.</p>
            </div>
            
            <div class="np-form-body">
                <?php echo do_shortcode('[contact-form-7  title="Noble Place - Liên hệ 2"]'); ?>
            </div>
            
            <div class="np-form-footer">
                <p>Không mất bất kỳ phí nào · Hoàn toàn miễn phí</p>
            </div>
        </div>
        
        <!-- Success Content (Hidden by default) -->
        <div class="np-form-success" id="np-form-cf7-success">
            <div class="success-icon-wrap">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M24 2L28.8 6.8L35.6 6.8L35.6 13.6L40.4 18.4L37.4 24L40.4 29.6L35.6 34.4L35.6 41.2L28.8 41.2L24 46L19.2 41.2L12.4 41.2L12.4 34.4L7.6 29.6L10.6 24L7.6 18.4L12.4 13.6L12.4 6.8L19.2 6.8L24 2Z" fill="white" stroke="#c9a355" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M16 24L22 30L32 18" stroke="#c9a355" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3 class="np-form-title">ĐĂNG KÝ THÀNH CÔNG!</h3>
            <p class="np-form-sub">Chuyên viên STND sẽ liên hệ với bạn trong<br>15 phút làm việc.</p>
            <div class="success-phone">
                <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
                0972 991 551
            </div>
            <button class="success-return-btn" id="np-form-return">TRỞ VỀ</button>
        </div>
    </div>
</div>

    <?php wp_footer(); ?>
</body>
</html>
