<?php
/**
 * Template Name: Hinode Park
 * 
 * A premium landing page template for Hinode Park (Flame Vine).
 */
$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php 
    add_action('wp_enqueue_scripts', function() {
        // Enqueue Fonts from HTML template
        wp_enqueue_style('hp-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@400;500;600&display=swap', array(), null);
        
        // Custom Style & Scripts
        wp_enqueue_style('hinode-park-style', get_template_directory_uri() . '/css/hinode-park.css', array(), '1.1.0');
        wp_enqueue_script('hinode-park-script', get_template_directory_uri() . '/js/hinode-park.js', array('jquery'), '1.1.0', true);
    });

    wp_head(); 
    ?>
</head>

<body <?php body_class(); ?>>

<!-- TOP BAR -->
<div class="top-bar px-2! xl:px-[8px]! py-[7px]!">
  <div class="top-bar-inner">
    <div class="top-bar-brand text-[8px] xl:text-sm!">STND<span>.vn</span></div>
    <div class="top-bar-sep"></div>
    <div class="top-bar-text text-[6px] xl:text-sm!">Khám phá hệ sinh thái bất động sản đầy đủ tại trang chủ của chúng tôi</div>
    <a href="https://stnd.vn" class="top-bar-btn">
      <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
      <span class="text-[4px] xl:text-xs! uppercase xl:font-medium">Ghé thăm STND.VN</span>
    </a>
  </div>
  <span class="top-bar-close" onclick="this.parentElement.style.display='none'">✕</span>
</div>

<!-- HERO -->
<section class="hero h-full! xl:h-[977px]!" id="du-an">
  <img class="no-lazy hero-bg" src="<?php echo $theme_uri; ?>/images/hp-hero-bg.jpg" alt="The Flame Vine">
  <div class="hero-overlay"></div>

  <!-- Header nav -->
  <div class="hero-header flex flex-col xl:flex-row justify-between items-center gap-5 py-5! px-[20px]! xl:px-[100px]!">
    <div class="hero-header-left">
      <img class="hero-logo-main" src="<?php echo $theme_uri; ?>/images/hp-logo-main.png" alt="The Flame Vine">
      <div class="hero-sep"></div>
      <div class="hero-brand">
        <img class="hero-brand-logo" src="<?php echo $theme_uri; ?>/images/hp-stnd-logo.png" alt="STND">
        <div class="hero-brand-text">
          <div class="sub">Phân phối bởi</div>
          <div class="name">Siêu thị nhà đất</div>
        </div>
      </div>
    </div>
    <nav class="hero-nav flex flex-wrap justify-center">
      <div class="hero-nav-item active" onclick="hp_scroll_to('#du-an')">Dự án</div>
      <div class="hero-nav-item" onclick="hp_scroll_to('#vi-tri')">Vị trí</div>
      <div class="hero-nav-item" onclick="hp_scroll_to('#chinh-sach')">Chính sách</div>
      <div class="hero-nav-item" onclick="hp_scroll_to('#mat-bang')">Mặt bằng</div>
      <div class="hero-nav-item" onclick="hp_scroll_to('#tien-ich')">Tiện ích</div>
      <div class="hero-nav-item" onclick="hp_scroll_to('#faq')">FAQ</div>
    </nav>
    <a href="tel:0972991551" class="hero-cta-call">
      <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
      0972 991 551
    </a>
  </div>

  <!-- Hero body -->
  <div class="hero-body px-[12px]! xl:px-[100px]!">
    <div class="hero-tag">
      <div class="hero-tag-dot"></div>
      <div class="hero-tag-text">STND.VN · Phân Phối Chính Thức · Ra Mắt 2026</div>
    </div>
    <div class="hero-title">
      <span class="the">The</span>
      <span class="flame">Flame</span>
      <span class="vine">Vine</span>
    </div>
    <p class="hero-subtitle text-[11px]! xl:text-base!">
      Tổ hợp 1.380 căn hộ cao cấp · 4 tòa 35 tầng · Hinode Royal Park<br>
      Hoài Đức, Hà Nội · Bàn giao dự kiến Quý 4/2028
    </p>
    <div class="hero-buttons justify-between xl:justify-start">
      <button class="btn-primary w-[170px]! xl:w-[232px]! py-[12px]! px-[4px]! text-xs! xl:text-base! h-auto" onclick="document.getElementById('form-register').scrollIntoView({behavior:'smooth'})">Đăng ký tư vấn</button>
      <a href="tel:0972991551" class="btn-outline w-[170px]! xl:w-[232px]! py-[12px]! px-[4px]! text-xs! xl:text-base! h-auto">
        <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
        Khám phá dự án
      </a>
    </div>

    
  </div>

  <!-- Stats bar -->
    <div class="stats-bar">
      <div class="stat-item"><div class="stat-num">7x</div><div class="stat-label">Triệu/m² từ</div></div>
      <div class="stat-sep"></div>
      <div class="stat-item"><div class="stat-num">35</div><div class="stat-label">Tầng cao</div></div>
      <div class="stat-sep"></div>
      <div class="stat-item"><div class="stat-num">04</div><div class="stat-label">Tòa tháp</div></div>
      <div class="stat-sep"></div>
      <div class="stat-item"><div class="stat-num">146.8ha</div><div class="stat-label">Đại đô thị</div></div>
      <div class="stat-sep"></div>
      <div class="stat-item col-span-mobile-2"><div class="stat-num">Q4/28</div><div class="stat-label">Bàn giao</div></div>
    </div>
</section>

<!-- OVERVIEW -->
<section class="overview" id="tong-quan">
  <div class="overview-img">
    <img class=" " src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 1000'%3E%3C/svg%3E" data-src="<?php echo $theme_uri; ?>/images/hp-overview.jpg" alt="HH3 Hinode Royal Park">
    <div class="overview-img-badge">HH3<br><span style="font-size:12px">Hinode Royal Park</span></div>
  </div>
  <div class="overview-content">
    <div>
      <div class="sec-label"><span class="sec-label-text">Tổng Quan Dự Án</span><div class="sec-label-line"></div></div>
      <div class="overview-heading flex flex-col! gap-1!">
        <span class="">Căn hộ cao cấp</span>
        <span class="the-flame-vine">The Flame Vine</span>
      </div>
    </div>
    <p class="overview-desc">
      Nằm trong đại đô thị Hinode Royal Park rộng hơn 146ha tại Hoài Đức, The Flame Vine là tổ hợp căn hộ cao cấp gồm 4 tòa tháp 35 tầng và 3 tầng hầm. Dự án kế thừa toàn bộ không gian sống xanh, hệ tiện ích đặc quyền và hạ tầng giao thông đồng bộ của đại đô thị.
    </p>
    <div class="overview-grid">
      <div class="overview-grid-row">
        <div class="stat-card"><div class="stat-card-num">25.750m²</div><div class="stat-card-label">Tổng diện tích đất</div></div>
        <div class="stat-card"><div class="stat-card-num">1.380</div><div class="stat-card-label">Căn hộ</div></div>
      </div>
      <div class="overview-grid-row">
        <div class="stat-card"><div class="stat-card-num">70–118m²</div><div class="stat-card-label">Diện tích căn hộ</div></div>
        <div class="stat-card"><div class="stat-card-num">2PN–3PN</div><div class="stat-card-label">Loại căn hộ</div></div>
      </div>
      <div class="overview-grid-row">
        <div class="stat-card"><div class="stat-card-num">40.9–53%</div><div class="stat-card-label">Mật độ xây dựng</div></div>
        <div class="stat-card"><div class="stat-card-num">Q4/2028</div><div class="stat-card-label">Dự kiến bàn giao</div></div>
      </div>
    </div>
    <button class="btn-full" onclick="document.getElementById('form-register').scrollIntoView({behavior:'smooth'})">Nhận Bảng Giá Chi Tiết</button>
  </div>
</section>

<!-- LOCATION -->
<section class="location" id="vi-tri">
  <div class="location-header">
    <div class="sec-label"><span class="sec-label-text">Vị Trí Chiến Lược</span><div class="sec-label-line"></div></div>
    <h2 class="location-heading">
      Tọa Độ <span>Kim Cương</span><br>
      Phía Tây Hà Nội
    </h2>
    <p class="location-desc">
      Nằm ngay mặt tiền Vành đai 3.5 và tiếp giáp Quốc lộ 32 — cư dân chỉ mất 10–15 phút tới Mỹ Đình, Cầu Giấy.<br>Khu vực đô thị hóa nhanh nhất Hà Nội.
    </p>
  </div>
  <div class="location-body">
    <div class="location-map">
      <img src="<?php echo $theme_uri; ?>/images/hp-map.jpg" alt="Bản đồ vị trí The Flame Vine">
    </div>
    <div class="location-points">
      <div class="loc-point">
        <img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt="">
        <div>
          <div class="loc-point-title">2 Ga Metro Cận Kề</div>
          <div class="loc-point-desc">Kết nối nhanh tới trung tâm Hà Nội, giảm thiểu thời gian di chuyển đáng kể</div>
        </div>
      </div>
      <div class="loc-point">
        <img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-medical.png" alt="">
        <div>
          <div class="loc-point-title">Hệ Thống Y Tế – Bệnh Viện Lớn</div>
          <div class="loc-point-desc">Cụm bệnh viện, phòng khám đẳng cấp ngay trong khu vực lân cận</div>
        </div>
      </div>
      <div class="loc-point">
        <img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-edu.png" alt="">
        <div>
          <div class="loc-point-title">Trường Đại Học & Giáo Dục</div>
          <div class="loc-point-desc">Hệ thống đại học, trường quốc tế tập trung tại phía Tây Hà Nội</div>
        </div>
      </div>
      <div class="loc-point">
        <img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-road.png" alt="">
        <div>
          <div class="loc-point-title">Mặt Đường 3.5 – Vành Đai 4</div>
          <div class="loc-point-desc">Huyết mạch giao thông kết nối toàn vùng, gia tăng giá trị thương mại</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- POLICY -->
<section class="policy" id="chinh-sach">
  <div class="policy-bg"></div>
  <div class="policy-title-wrap">
    <div class="sec-label justify-center"><span class="sec-label-text">Chính Sách Bán Hàng</span><div class="sec-label-line"></div></div>
    <h2 class="policy-heading">Ưu Đãi <span>Đặc Quyền</span></h2>
    <p class="policy-desc">Hinode Royal Park – The Flame Vine mang đến những chính sách tài chính linh hoạt, tối ưu đòn bẩy đầu tư cho khách hàng thông thái.</p>
  </div>
  <div class="policy-main">
    <div class="policy-big-num">12%</div>
    <div class="policy-main-text">
      <div class="policy-main-label">Chiết Khấu Tối Đa · Kết Hợp Early Bird + Thanh Toán Sớm</div>
      <div class="policy-main-desc">Cơ hội vàng để tối ưu lợi nhuận ngay từ giai đoạn mở bán đầu tiên. Số lượng căn ưu đãi có hạn.</div>
    </div>
  </div>
  <div class="policy-cards">
    <div class="policy-card">
      <div class="policy-card-num">1%</div>
      <div class="policy-card-label">Booking Sớm</div>
      <div class="policy-card-desc">Dành cho khách đặt chỗ trước mở bán chính thức</div>
    </div>
    <div class="policy-card">
      <div class="policy-card-num">10.5%</div>
      <div class="policy-card-label">Thanh toán Sớm</div>
      <div class="policy-card-desc">Chiết khấu khi thanh toán sớm toàn bộ giá trị căn hộ</div>
    </div>
    <div class="policy-card">
      <div class="policy-card-num">2%</div>
      <div class="policy-card-label">Tiến Độ CĐT</div>
      <div class="policy-card-desc">Thanh toán theo tiến độ xây dựng chuẩn chủ đầu tư</div>
    </div>
    <div class="policy-card">
      <div class="policy-card-num">0,5%</div>
      <div class="policy-card-label">Từ Chối bảo lãnh</div>
      <div class="policy-card-desc">Khi từ chối cấp bảo lãnh nhà ở hình thành trong tương lai</div>
    </div>
    <div class="policy-card">
      <div class="policy-card-num">0%</div>
      <div class="policy-card-label">Lãi Suất / 24 tháng</div>
      <div class="policy-card-desc">Ân hạn gốc & lãi 0% trong 24 tháng kể từ ngày ký Hợp đồng mua bán</div>
    </div>
  </div>
</section>

<!-- FLOORPLAN -->
<section class="floorplan" id="mat-bang">
  <div class="floorplan-inner">
    <div class="floorplan-left">
      <div class="sec-label"><span class="sec-label-text">Mặt Bằng Tháp F1 – HH3</span><div class="sec-label-line"></div></div>
      <h2 class="floorplan-heading">Thiết Kế<br><em>Tối Ưu Công Năng</em></h2>
      <p class="floorplan-desc">Chủ đầu tư WTO đặc biệt chú trọng sự tinh tế. Các căn hộ bố trí khoa học để tối ưu hóa diện tích và đón tối đa ánh sáng tự nhiên. Mỗi căn hộ có ít nhất 2 ban công cây xanh.</p>
      <div class="apt-cards">
        <div class="apt-card-row">
          <div class="apt-card">
            <div class="apt-card-type">2PN</div>
            <div class="apt-card-size">~74 m²</div>
            <p class="apt-card-desc">Phù hợp gia đình trẻ, tối ưu diện tích, công năng hoàn hảo</p>
          </div>
          <div class="apt-card">
            <div class="apt-card-type">2PN</div>
            <div class="apt-card-size">~115 m²</div>
            <ul class="apt-card-list">
              <li>Rộng rãi gia đình đa thế hệ, đảm bảo sự riêng tư</li>
            </ul>
          </div>
        </div>
        <div class="apt-interior">
          <div class="apt-interior-title">Nội Thất Bàn Giao Dự Kiến</div>
          <ul>
            <li>Khóa cửa thông minh – Panasonic hoặc tương đương</li>
            <li>Thiết bị điện – Schneider</li>
            <li>Sàn gỗ cao cấp, trần thạch cao giật cấp</li>
            <li>Điều hòa âm trần</li>
            <li>Bếp & phòng tắm – bàn giao đầu chờ, tự do cá nhân hóa</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="floorplan-right">
      <div class="floor-tabs">
        <div class="floor-tab active" onclick="setTab(this)">Tầng 3</div>
        <div class="floor-tab" onclick="setTab(this)">Tầng 4–19</div>
        <div class="floor-tab" onclick="setTab(this)">Tầng 21–35</div>
        <div class="floor-tab" onclick="setTab(this)">2PN 74m²</div>
        <div class="floor-tab" onclick="setTab(this)">3PN 115m²</div>
      </div>
      <div class="floor-img">
        <img src="<?php echo $theme_uri; ?>/images/hp-floorplan.jpg" alt="Mặt bằng tầng 3">
      </div>
    </div>
  </div>
</section>

<!-- HIGHLIGHTS -->
<section class="highlights" id="diem-noi-bat">
  <div class=" mb-10">
    <div class="sec-label"><span class="sec-label-text">Điểm Nổi Bật</span><div class="sec-label-line"></div></div>
    <h2 class="highlights-heading">Lý Do Chọn <br class="xl:hidden"><span>The Flame Vine</span></h2>
  </div>
  <div class="gallery-grid">
    <div class="gallery-row">
      <div class="gallery-item">
        <img src="<?php echo $theme_uri; ?>/images/hp-gallery-1.jpg" alt="Tọa Độ Kim Cương">
        <div class="gallery-overlay"></div>
        
      </div>
      <div class="gallery-item">
        <img src="<?php echo $theme_uri; ?>/images/hp-gallery-3.jpg" alt="">
        <div class="gallery-overlay"></div>
      </div>
      <div class="gallery-item">
        <img src="<?php echo $theme_uri; ?>/images/hp-gallery-2.jpg" alt="">
        <div class="gallery-overlay"></div>
      </div>
    </div>
    <div class="gallery-row">
      <div class="gallery-item">
        <img src="<?php echo $theme_uri; ?>/images/hp-gallery-4.jpg" alt="">
        <div class="gallery-overlay"></div>
      </div>
      <div class="gallery-item">
        <img src="<?php echo $theme_uri; ?>/images/hp-gallery-5.jpg" alt="">
        <div class="gallery-overlay"></div>
      </div>
      <div class="gallery-item">
        <img src="<?php echo $theme_uri; ?>/images/hp-gallery-6.jpg" alt="">
        <div class="gallery-overlay"></div>
      </div>
    </div>
  </div>
</section>

<!-- AMENITIES -->
<section class="amenities" id="tien-ich">
  <div class="amenities-header">
    <div class="sec-label justify-center"><span class="sec-label-text">Hệ Tiện Ích 5 Sao</span><div class="sec-label-line"></div></div>
    <h2 class="amenities-heading">Nghệ Thuật <span>Sống Đẳng Cấp</span></h2>
    <p class="amenities-desc">Kế thừa toàn bộ hệ tiện ích đặc quyền của đại đô thị Hinode Royal Park — trải nghiệm sống xứng tầm thượng lưu.</p>
  </div>
  <div class="amenities-grid">
    <div class="amenity-main">
      <img class=" " src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 854 548'%3E%3C/svg%3E" data-src="<?php echo $theme_uri; ?>/images/hp-amenity-main.jpg" alt="Cảnh Quan">
      <div class="amenity-main-overlay"></div>
      <div class="gallery-label">
        <div class="gallery-cat text-[8px] xl:text-[14px] font-semibold">Cảnh Quan</div>
        <div class="gallery-name">Nghệ Thuật Cảnh Quan Độc Đáo</div>
      </div>
    </div>
    <div class="amenity-side">
      <div class="amenity-side-row">
        <div class="amenity-item">
          <img class=" " src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 420 270'%3E%3C/svg%3E" data-src="<?php echo $theme_uri; ?>/images/hp-amenity-1.jpg" alt="Xanh">
          <div class="amenity-item-overlay"></div>
          <div class="gallery-label">
            <div class="gallery-cat">Xanh</div>
            <div class="gallery-name">Không Gian Sống Xanh</div>
          </div>
        </div>
        <div class="amenity-item">
          <img class=" " src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 420 270'%3E%3C/svg%3E" data-src="<?php echo $theme_uri; ?>/images/hp-amenity-2.jpg" alt="Vui Chơi">
          <div class="amenity-item-overlay"></div>
          <div class="gallery-label">
            <div class="gallery-cat">Vui Chơi</div>
            <div class="gallery-name">Khu Vui Chơi Tiện Nghi</div>
          </div>
        </div>
      </div>
      <div class="amenity-side-row">
        <div class="amenity-item">
          <img class=" " src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 420 270'%3E%3C/svg%3E" data-src="<?php echo $theme_uri; ?>/images/hp-amenity-3.jpg" alt="Gym">
          <div class="amenity-item-overlay"></div>
          <div class="gallery-label">
            <div class="gallery-cat">Thể Thao</div>
            <div class="gallery-name">Gym & Bể Bơi Đẳng Cấp</div>
          </div>
        </div>
        <div class="amenity-item">
          <img class=" " src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 420 270'%3E%3C/svg%3E" data-src="<?php echo $theme_uri; ?>/images/hp-amenity-4.jpg" alt="Kiến Trúc">
          <div class="amenity-item-overlay"></div>
          <div class="gallery-label">
            <div class="gallery-cat">Kiến Trúc</div>
            <div class="gallery-name">Phong Cách Nhật – Đông Dương</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="why" id="ly-do">
  <div class="why-header">
    <div class="sec-label justify-center "><span class="sec-label-text">9 Lý Do</span><div class="sec-label-line"></div></div>
    <h2 class="why-heading">Vì Sao Chọn <br class="xl:hidden"><span>The Flame Vine</span></h2>
    <p class="why-desc">Chủ đầu tư WTO đặc biệt chú trọng sự tinh tế. Các căn hộ bố trí khoa học để tối ưu hóa diện tích và đón tối đa ánh sáng tự nhiên.</p>
  </div>
  <div class="why-grid">
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Tọa Độ Kim Cương</div>
        <div class="why-card-desc">Vị trí thuận tiện kết nối với trung tâm Hà Nội và các khu vực lân cận</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Pháp Lý Minh Bạch</div>
        <div class="why-card-desc">Sổ đỏ lâu dài, an tâm tuyệt đối, mua trực tiếp từ CĐT WTO</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Trực Thuộc Đại Đô Thị</div>
        <div class="why-card-desc">Nằm trong KĐT Hinode Royal Park được đầu tư đồng bộ hạ tầng và tiện ích</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Thiên Nhiên Giao Hòa</div>
        <div class="why-card-desc">Mỗi căn có ít nhất 2 ban công cây xanh, ánh sáng và gió tự nhiên</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Thiết Kế Tối Ưu</div>
        <div class="why-card-desc">Tính toán tỉ mỉ, tối ưu diện tích sử dụng, kết nối hài hòa các không gian</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Đa Dạng Loại Hình</div>
        <div class="why-card-desc">2PN (74m²) và 3PN (115m²) đáp ứng nhiều nhu cầu sống khác nhau</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Chiết Khấu Ưu Đãi</div>
        <div class="why-card-desc">Chiết khấu tối đa 12%, lãi 0% / 24 tháng, vay đến 70% giá trị căn</div>
      </div>
      <div class="why-card">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Chủ Đầu Tư Uy Tín</div>
        <div class="why-card-desc">WTO (Vietracimex) thâm niên hàng chục năm, quỹ đất lớn tại Hà Nội & TP.HCM</div>
      </div>
      <div class="why-card col-span-mobile-2">
        <div class="why-card-icon"><img class="loc-point-icon" src="<?php echo $theme_uri; ?>/images/hp-icon-metro.png" alt=""></div>
        <div class="why-card-title">Tiềm Năng Tăng Giá</div>
        <div class="why-card-desc">Đón đầu hạ tầng Metro & Vành đai 3.5 — thanh khoản cao, gia tăng bền vững</div>
      </div>
  </div>
</section>

<!-- FAQ -->
<section class="faq" id="faq">
  <div class="faq-inner">
    <div class="faq-left">
      <div class="sec-label"><span class="sec-label-text">Giải Đáp Thắc Mắc</span><div class="sec-label-line"></div></div>
      <h2 class="faq-heading">Câu Hỏi <br><span>Thường Gặp</span></h2>
      <p class="faq-desc">Mọi thông tin chi tiết về dự án The Flame Vine – Hinode Royal Park đều được STND.VN cập nhật chính xác và minh bạch.</p>
      <div class="faq-hotline">
        <div class="faq-hotline-icon">
          <svg width="20" height="20" viewBox="0 0 16 16" fill="white"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
        </div>
        <div>
          <div class="faq-hotline-num"><a href="tel:0972991551" class="text-white!">0972 991 551</a></div>
          <div class="faq-hotline-label">Hotline STND.VN - Hỗ Trợ 24/7</div>
        </div>
      </div>
    </div>
    <div class="faq-right">
      <div class="faq-item open" onclick="toggleFaq(this)">
        <div class="faq-item-header">
          <div class="faq-q">Chung cư The Flame Vine có đáng mua không?</div>
          <div class="faq-toggle"></div>
        </div>
        <div class="faq-a">Đáng mua. Dự án nằm trong đại đô thị Hinode Royal Park đã đồng bộ, pháp lý an toàn (sổ đỏ lâu dài), CĐT WTO (Vietracimex) uy tín. Hạ tầng Vành đai 3.5 và Metro số 3 là đòn bẩy tăng giá mạnh.</div>
      </div>
      <div class="faq-item" onclick="toggleFaq(this)">
        <div class="faq-item-header">
          <div class="faq-q">Giá chung cư The Flame Vine bao nhiêu?</div>
          <div class="faq-toggle"></div>
        </div>
        <div class="faq-a">Giá từ 7x triệu/m², tùy theo tầng, hướng và loại căn. Liên hệ STND.VN để nhận bảng giá cập nhật mới nhất và được tư vấn căn phù hợp ngân sách.</div>
      </div>
      <div class="faq-item" onclick="toggleFaq(this)">
        <div class="faq-item-header">
          <div class="faq-q">Chủ đầu tư WTO (Vietracimex) có uy tín không?</div>
          <div class="faq-toggle"></div>
        </div>
        <div class="faq-a">WTO (Vietracimex) là doanh nghiệp nhà nước với hàng chục năm kinh nghiệm, sở hữu quỹ đất lớn tại Hà Nội và TP.HCM. Đây là chủ đầu tư của Hinode Royal Park — đại đô thị đã có tiến độ xây dựng rõ ràng và được tin tưởng.</div>
      </div>
      <div class="faq-item" onclick="toggleFaq(this)">
        <div class="faq-item-header">
          <div class="faq-q">Khi nào dự án The Flame Vine bàn giao?</div>
          <div class="faq-toggle"></div>
        </div>
        <div class="faq-a">Dự kiến bàn giao Quý 4/2028. Đây là mốc thời gian theo kế hoạch của chủ đầu tư WTO. Thông tin chính xác sẽ được xác nhận theo Hợp đồng mua bán.</div>
      </div>
      <div class="faq-item" onclick="toggleFaq(this)">
        <div class="faq-item-header">
          <div class="faq-q">Vay ngân hàng mua The Flame Vine như thế nào?</div>
          <div class="faq-toggle"></div>
        </div>
        <div class="faq-a">Có thể vay lên đến 70% giá trị căn hộ, lãi suất 0% trong 24 tháng đầu từ ngày ký HĐMB. STND.VN hỗ trợ thủ tục vay trọn gói tại các ngân hàng đối tác.</div>
      </div>
      <div class="faq-item" onclick="toggleFaq(this)">
        <div class="faq-item-header">
          <div class="faq-q">Căn hộ bàn giao kèm những nội thất gì?</div>
          <div class="faq-toggle"></div>
        </div>
        <div class="faq-a">Căn hộ bàn giao hoàn thiện cao cấp: khóa cửa thông minh Panasonic, thiết bị điện Schneider, sàn gỗ, trần thạch cao giật cấp, điều hòa âm trần. Bếp và phòng tắm bàn giao đầu chờ để khách tự do cá nhân hóa.</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA FORM -->
<section class="cta-form" id="form-register">
  <div class="cta-form-bg" style="background-image:url('<?php echo $theme_uri; ?>/images/hp-hero-bg.jpg')"></div>
  <div class="cta-grad"></div>
  <div class="cta-form-inner">
    <div class="cta-form-left">
      <div class="sec-label"><span class="sec-label-text">Chính Sách Bán Hàng</span><div class="sec-label-line"></div></div>
      <h2 class="cta-form-heading">Nhận Ngay<br><span>Báo Giá Tốt Nhất</span></h2>
      <p class="cta-form-desc">Những thắc mắc phổ biến nhất từ khách hàng quan tâm The Flame Vine. Liên hệ STND.VN để được tư vấn 1:1 chuyên sâu.</p>
      <div class="cta-checklist">
        <div class="cta-check"><span>✓</span> Chiết khấu tối đa 12% – Early Bird + TT Sớm</div>
        <div class="cta-check"><span>✓</span> Hỗ trợ vay 70%, lãi suất 0% trong 24 tháng</div>
        <div class="cta-check"><span>✓</span> Ân hạn gốc & lãi 24 tháng từ ngày ký HĐMB</div>
        <div class="cta-check"><span>✓</span> Sổ đỏ lâu dài, mua trực tiếp CĐT WTO</div>
        <div class="cta-check"><span>✓</span> Ưu tiên chọn căn đẹp, tầng cao view thoáng</div>
      </div>
    </div>
    <div class="cta-form-right">
      <div>
        <div class="form-title">Đăng Ký Nhận Tư Vấn</div>
        <div class="form-subtitle">Miễn phí · Bảo mật tuyệt đối · Phản hồi trong 30 phút</div>
      </div>
      <div class="form-row">
        <div class="form-field">
          <label class="form-label">Họ và tên <span class="req">*</span></label>
          <input class="form-input" type="text" placeholder="Nguyễn Văn A">
        </div>
        <div class="form-field">
          <label class="form-label">Số điện thoại <span class="req">*</span></label>
          <input class="form-input" type="tel" placeholder="Số điện thoại">
        </div>
      </div>
      <div class="form-field">
        <label class="form-label">Email</label>
        <input class="form-input" type="email" placeholder="Email@example.com">
      </div>
      <div class="form-row">
        <div class="form-field">
          <label class="form-label">Loại Căn Hộ</label>
          <select class="form-select">
            <option value="">Chọn loại căn</option>
            <option>2PN – 74m²</option>
            <option>3PN – 115m²</option>
          </select>
        </div>
        <div class="form-field">
          <label class="form-label">Ngân Sách</label>
          <select class="form-select">
            <option value="">Chọn ngân sách</option>
            <option>Dưới 3 tỷ</option>
            <option>3 – 5 tỷ</option>
            <option>Trên 5 tỷ</option>
          </select>
        </div>
      </div>
      <div class="form-field">
        <label class="form-label">Ghi chú</label>
        <textarea class="form-textarea" placeholder="Tôi quan tâm đến căn hộ..."></textarea>
      </div>
      <button class="btn-submit" onclick="handleSubmit()">Gửi Đăng Ký – Nhận Tư Vấn Ngay</button>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="footer-logos">
        <img class="footer-logo-main" src="<?php echo $theme_uri; ?>/images/hp-footer-logo-main.png" alt="The Flame Vine">
        <div class="footer-logo-sep"></div>
        <div class="footer-brand-combo">
          <img class="footer-brand-logo" src="<?php echo $theme_uri; ?>/images/hp-footer-stnd-logo.png" alt="STND">
          <div>
            <div class="footer-brand-name">Phân phối bởi</div>
            <div class="footer-brand-fullname">Siêu thị nhà đất</div>
          </div>
        </div>
      </div>
      <p class="footer-brand-desc">Đơn vị phân phối chính thức <strong>The Flame Vine – HH3 Hinode Royal Park.</strong> Tư vấn chuyên sâu, đồng hành đến khi bạn nhận chìa khóa.</p>
    </div>
    <div class="footer-col">
      <div class="footer-col-title">Dự án</div>
      <ol>
        <li onclick="hp_scroll_to('#tong-quan')" class="cursor-pointer">Tổng quan The Flame Vine</li>
        <li onclick="hp_scroll_to('#vi-tri')" class="cursor-pointer">Vị trí & kết nối</li>
        <li onclick="hp_scroll_to('#mat-bang')" class="cursor-pointer">Mặt bằng căn hộ</li>
        <li onclick="hp_scroll_to('#tien-ich')" class="cursor-pointer">Tiện ích nội khu</li>
        <li onclick="hp_scroll_to('#chinh-sach')" class="cursor-pointer">Chính sách bán hàng</li>
      </ol>
    </div>
    <div class="footer-col">
      <div class="footer-col-title">Liên hệ</div>
      <ul class="footer-contact-list">
        <li class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="white"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/></svg>
          </div>
          <div><div class="footer-contact-label">Hotline tư vấn</div><div class="footer-contact-val"><a href="tel:0972991551" class="text-gray-950!">0972 991 551</a></div></div>
        </li>
        <li class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="white"><rect x="1" y="3" width="14" height="10" rx="1.5"/><path d="M1 4l7 5 7-5" stroke="white" stroke-width="1"/></svg>
          </div>
          <div><div class="footer-contact-label">Email</div><div class="footer-contact-val">info@stnd.vn</div></div>
        </li>
        <li class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="white"><path d="M8 1C5.24 1 3 3.24 3 6c0 3.94 5 9 5 9s5-5.06 5-9c0-2.76-2.24-5-5-5zm0 6.75A1.75 1.75 0 1 1 8 4.25a1.75 1.75 0 0 1 0 3.5z"/></svg>
          </div>
          <div><div class="footer-contact-label">Địa chỉ dự án</div><div class="footer-contact-val">KĐT Hinode Royal Park, Hoài Đức</div></div>
        </li>
        <li class="footer-contact-item">
          <div class="footer-contact-icon">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="white"><circle cx="8" cy="8" r="6.5"/><path d="M8 4v4l3 2" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div><div class="footer-contact-label">Thời gian</div><div class="footer-contact-val">T2–CN: 8:00–20:00</div></div>
        </li>
      </ul>
    </div>
    <div class="footer-hinode-col">
      <div class="footer-hinode-title">Hinode Royal Park</div>
      <div class="footer-hinode-list">
        <div>146,8ha tổng quy mô</div>
        <div>7.494 đơn vị nhà ở</div>
        <div>16,7ha diện tích xanh</div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 STND.VN · Phân Phối Chính Thức <span class="brand">The Flame Vine</span> · Hinode Royal Park</span>
    <span class="disclaimer">Nội dung chỉ mang tính tham khảo.<br>Thông tin chính thức theo HĐMB với CĐT.</span>
  </div>
</footer>

<!-- Back to top -->
<div class="back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="4 11 8 6 12 11"/></svg>
</div>

<script>
function setTab(el) {
  el.parentElement.querySelectorAll('.floor-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}
function toggleFaq(el) {
  const isOpen = el.classList.contains('open');
  document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
  if (!isOpen) el.classList.add('open');
}
function handleSubmit() {
  const name = document.querySelector('.cta-form-right input[type="text"]').value;
  const phone = document.querySelector('.cta-form-right input[type="tel"]').value;
  if (!name || !phone) { alert('Vui lòng điền đầy đủ họ tên và số điện thoại.'); return; }
  alert('Cảm ơn '+ name +'! STND.VN sẽ liên hệ với bạn trong vòng 30 phút.');
}
// Scroll helper
function hp_scroll_to(id) {
  const el = document.querySelector(id);
  if (el) el.scrollIntoView({behavior:'smooth'});
}
</script>

    <?php wp_footer(); ?>
</body>
</html>
