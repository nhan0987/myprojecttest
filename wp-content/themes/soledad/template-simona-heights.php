<?php
/**
 * Template Name: Simona Heights
 */
$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simona Heights Quy Nhơn | Căn hộ 2 mặt tiền phố cổ - Cách biển 300m | STND</title>
<meta name="description" content="Simona Heights - 626 căn hộ hạng sang tại trung tâm phố cổ Quy Nhơn, cách biển 300m. Nhận bảng giá, chính sách bán hàng ưu đãi & tư vấn 1-1 cùng STND - Đại lý phân phối F1.">
<meta name="keywords" content="Simona Heights, căn hộ Quy Nhơn, chung cư Quy Nhơn, Simona Heights Quy Nhơn, STND">
<meta name="robots" content="index,follow">
<!-- ⚠️ DEV: thay href bằng domain thật STND sẽ dùng để host trang này. KHÔNG được để simonaheights.vn — đó là domain của chủ đầu tư, không phải của bạn. -->
<link rel="canonical" href="https://[TEN-MIEN-CUA-BAN].vn/">
<meta property="og:type" content="website">
<meta property="og:title" content="Simona Heights Quy Nhơn | 2 mặt tiền phố cổ - Cách biển 300m">
<meta property="og:description" content="626 căn hộ hạng sang, 2 tòa The Harbour & The Sea. Nhận báo giá & chính sách bán hàng ưu đãi cùng STND.">
<meta property="og:image" content="<?php echo $theme_uri; ?>/images/simona-heights/hero-towers-sunset.jpg"><!-- QUAN TRỌNG: khi deploy lên domain thật, phải đổi thành URL tuyệt đối, VD: https://tenmien.vn/images/hero-towers-sunset.jpg — Facebook/Zalo không đọc được đường dẫn tương đối -->
<meta property="og:locale" content="vi_VN">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 fill=%22%230D2436%22/><path d=%22M50 15 L75 50 L50 85 L25 50 Z%22 fill=%22%23B8935A%22/></svg>">
<meta name="twitter:card" content="summary_large_image">

<!-- GTM Placeholder: Thay GTM-XXXXXXX bằng ID thật trước khi chạy ads -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-XXXXXXX');</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php 
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style('simona-heights-fonts', 'https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap', array(), null);
        wp_enqueue_style('simona-heights-style', get_template_directory_uri() . '/css/simona-heights.css', array(), '1.0.0');
        wp_enqueue_script('simona-heights-script', get_template_directory_uri() . '/js/simona-heights.js', array('jquery'), '1.0.0', true);
    });
    ?>
<?php wp_head(); ?>
</head>
<body>
<header class="site-header">
  <div class="wrap">
    <div class="brand">
      <img src="<?php echo $theme_uri; ?>/images/simona-heights/logo-stnd.png" alt="STND - Siêu Thị Nhà Đất" class="brand-logo">
      <div class="brand-text">
        <span class="brand-name">SIMONA HEIGHTS</span>
        <span class="brand-tag">Đại lý phân phối F1 · STND</span>
      </div>
    </div>
    <div class="header-cta">
      <div class="header-phone">
        <small>Hotline STND</small>
        <strong><a href="tel:0972991551">0972.991.551</a></strong>
      </div>
      <a href="#nhan-tu-van" class="btn btn-outline">Nhận báo giá</a>
    </div>
  </div>
</header>

<section class="hero" id="top">
  <div class="hero-media">
    <img class="hero-slide active" src="<?php echo $theme_uri; ?>/images/simona-heights/hero-towers-sunset.jpg" alt="Simona Heights - phối cảnh hoàng hôn" onerror="imgFallback(this,'SIMONA HEIGHTS')">
    <img class="hero-slide" src="<?php echo $theme_uri; ?>/images/simona-heights/location-towers-day.jpg" alt="Simona Heights - hai tòa tháp ban ngày" onerror="imgFallback(this,'SIMONA HEIGHTS')">
    <img class="hero-slide" src="<?php echo $theme_uri; ?>/images/simona-heights/amenity-retail.jpg" alt="Simona Heights - sảnh vào dự án" onerror="imgFallback(this,'SIMONA HEIGHTS')">
    <img class="hero-slide" src="<?php echo $theme_uri; ?>/images/simona-heights/amenity-pool.jpg" alt="Simona Heights - hồ bơi trên cao" onerror="imgFallback(this,'SIMONA HEIGHTS')">
    <div class="hero-dots" id="heroDots"></div>
  </div>
  <div class="hero-content">
    <div class="wrap">
      <div class="hero-kicker">Trung tâm phố cổ Quy Nhơn · Cách biển 300m</div>
      <h1>SIMONA<br>HEIGHT<span>S</span></h1>
      <p class="hero-sub">626 căn hộ hạng sang tọa lạc trên hai mặt tiền đắt giá bậc nhất Quy Nhơn — nơi báo chí quốc tế gọi tên là <strong>"Maldives của Việt Nam"</strong>. Hai tòa tháp The Harbour &amp; The Sea, thiết kế Art Décor, đã cất nóc.</p>
      <div class="hero-cta-row">
        <a href="#nhan-tu-van" class="btn btn-primary">Nhận bảng giá &amp; CSBH mới nhất</a>
        <a href="tel:0972991551" class="btn btn-outline">Gọi STND: 0972.991.551</a>
      </div>
      <a href="#chinh-sach" class="hero-promo-link">🎁 Ưu đãi The Harbour &amp; The Sea: tặng nội thất, chiết khấu đến 18% →</a>
      <div class="hero-towers">
        <div class="hero-tower"><small>Tòa chủ lực</small><strong>THE HARBOUR</strong></div>
        <div class="hero-tower"><small>Tòa B</small><strong>THE SEA</strong></div>
      </div>
    </div>
  </div>
</section>

<div class="trust-bar">
  <div class="wrap trust-grid">
    <div class="trust-item"><strong>7.071m²</strong><span>Tổng diện tích đất</span></div>
    <div class="trust-item"><strong>29 tầng</strong><span>2 tòa tháp, 2 tầng hầm</span></div>
    <div class="trust-item"><strong>626</strong><span>Căn hộ hạng sang</span></div>
    <div class="trust-item"><strong>300m</strong><span>Ra tới bờ biển</span></div>
  </div>
  <div class="legal-strip wrap">
    Chủ đầu tư: Công ty TNHH Đầu tư Xây dựng Phú Mỹ Quy Nhơn · MST 4101427606 · Mật độ xây dựng 44.86% · Địa chỉ dự án: 145A Trần Hưng Đạo, Phường Quy Nhơn, Tỉnh Gia Lai
  </div>
</div>

<section class="section section--sand" id="vi-tri">
  <div class="wrap">
    <div class="loc-grid">
      <div>
        <div class="eyebrow">Vị trí</div>
        <h2 style="font-size:clamp(30px,4.5vw,48px);margin-top:14px;color:var(--navy-deep);">Hai mặt tiền<br>trung tâm phố cổ</h2>
        <ul class="loc-list">
          <li><span class="loc-num">01</span><p><strong>Hai mặt tiền đắt giá bậc nhất Quy Nhơn</strong>Vị trí kép hiếm có tại trung tâm phố cổ, thuận tiện di chuyển hai hướng.</p></li>
          <li><span class="loc-num">02</span><p><strong>Cách biển chỉ 300m</strong>Ôm trọn tầm nhìn hướng biển và đầm Thị Nại — tài sản hiếm với view không thể tái lập.</p></li>
          <li><span class="loc-num">03</span><p><strong>Tâm điểm kết nối tiện ích</strong>Y tế, giáo dục, mua sắm, giải trí trong bán kính di chuyển ngắn.</p></li>
        </ul>
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:28px;">
          <a href="#nhan-tu-van" class="btn btn-outline-dark">Nhận sơ đồ vị trí chi tiết</a>
          <a href="https://www.google.com/maps/search/?api=1&query=145A+Tr%E1%BA%A7n+H%C6%B0ng+%C4%90%E1%BA%A1o+Quy+Nh%C6%A1n" target="_blank" rel="noopener" class="btn btn-outline-dark">Mở Google Maps</a>
        </div>
      </div>
      <div class="loc-media">
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/location-towers-day.jpg" alt="Simona Heights - hai tòa tháp cách biển 300m" onerror="imgFallback(this,'VỊ TRÍ DỰ ÁN')">
      </div>
    </div>
    <div class="map-embed">
      <video class="map-video" autoplay muted loop playsinline poster="<?php echo $theme_uri; ?>/images/simona-heights/location-map-poster.jpg">
        <source src="<?php echo $theme_uri; ?>/images/simona-heights/location-map-flyover.mp4" type="video/mp4">
      </video>
      <div class="map-video-tag">📍 145A Trần Hưng Đạo, Phường Quy Nhơn, Tỉnh Gia Lai</div>
    </div>
  </div>
</section>

<section class="section csbh-block" id="chinh-sach">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold-bright);">Chính sách bán hàng</div>
    <div class="csbh-badge">⏱ Ưu đãi áp dụng theo giỏ hàng đợt mở bán này</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:#fff;max-width:640px;">Chọn tòa để xem chính sách áp dụng</h2>

    <div class="tower-tabs">
      <button class="tower-tab active" data-tower="harbour" onclick="switchTower('harbour')">THE HARBOUR</button>
      <button class="tower-tab" data-tower="sea" onclick="switchTower('sea')">THE SEA</button>
    </div>

    <!-- ===== THE HARBOUR ===== -->
    <div class="tower-panel" data-panel="harbour">
      <p class="csbh-note">Áp dụng từ 15/08/2026 cho đến khi có thông báo thay thế.</p>
      <div class="gift-grid">
        <div class="gift-card"><div class="gift-ic"></div><b>Full nội thất<br>cao cấp</b><span>Gói hoàn thiện toàn bộ</span></div>
        <div class="gift-card gift-hot"><span class="hot-tag">Chỉ 50 suất</span><div class="gift-ic"></div><b>iPhone 17 Pro</b><span>Trị giá 30.000.000đ/GDTC · 50 giao dịch đầu tiên</span></div>
        <div class="gift-card"><div class="gift-ic"></div><b>Miễn phí quản lý<br>vận hành 3 năm</b><span>Không phát sinh phí dịch vụ</span></div>
      </div>

      <div class="pay-grid">
        <div class="pay-card">
          <h4>Hỗ trợ lãi suất</h4>
          <div class="pay-stat">70%<small>HTLS 24 tháng, lãi vay tham chiếu 11,5%/năm</small></div>
          <ol>
            <li>Đặt cọc<b>100 triệu</b></li>
            <li>Đợt 1 (7 ngày ký HĐMB)<b>15%</b></li>
            <li>Đợt 2 (90 ngày)<b>5%</b></li>
            <li>Đợt 3 (90 ngày)<b>5%</b></li>
          </ol>
          <p style="font-size:14px;color:var(--ivory-text);opacity:.7;margin-top:12px;">Hoặc: vay 50% — HTLS 36 tháng (đợt 2 &amp; 3 nâng lên 15%/đợt). Ân hạn nợ gốc tối đa 36 tháng (vay tại MB Bank).</p>
        </div>
        <div class="pay-card">
          <h4>Tiến độ tiêu chuẩn</h4>
          <div class="pay-stat">70%<small>Thanh toán trong 28 tháng (vốn tự có)</small></div>
          <ol>
            <li>Đặt cọc<b>100 triệu</b></li>
            <li>Đợt 1 (7 ngày ký HĐMB)<b>15%</b></li>
            <li>Đợt 2-4 (90 ngày/đợt)<b>5%+5%+5%</b></li>
  </ol>
            <div class="pay-milestone"><b>30%</b> nhận nhà</div>
          <ol>
            <li>Đợt 5-12 (90 ngày/đợt)<b>5%/đợt</b></li>
            <li>Đợt 13 (bàn giao căn hộ)<b>25%+2%</b></li>
            <li>Đợt 14 (bàn giao GCN)<b>5%</b></li>
          </ol>
        </div>
        <div class="pay-card pay-card--highlight">
          <span class="best-tag">Ưu đãi cao nhất</span>
          <h4>Thanh toán sớm 95%</h4>
          <div class="pay-stat pay-stat--coral">18%<small>Chiết khấu giá trị căn hộ (chưa gồm VAT)</small></div>
          <ol>
            <li>Đặt cọc<b>100 triệu</b></li>
            <li>Đợt 1 (7 ngày ký HĐMB)<b>95%</b></li>
            <li>Đợt 2 (bàn giao căn hộ)<b>2%</b></li>
            <li>Đợt 3 (bàn giao GCN)<b>5%</b></li>
          </ol>
        </div>
      </div>
    </div>

    <!-- ===== THE SEA ===== -->
    <div class="tower-panel" data-panel="sea" hidden>
      <p class="csbh-note">Áp dụng từ 11/06/2026 cho đến khi có thông báo thay thế.</p>
      <div class="gift-grid">
        <div class="gift-card"><div class="gift-ic"></div><b>Full nội thất<br>cao cấp</b><span>Gói hoàn thiện toàn bộ</span></div>
        <div class="gift-card gift-hot"><span class="hot-tag">Sea only</span><div class="gift-ic"></div><b>Chạm biển xanh</b><span>Chiết khấu thêm 1% giá trị HĐMB</span></div>
        <div class="gift-card"><div class="gift-ic"></div><b>Miễn phí quản lý<br>vận hành 3 năm</b><span>Không phát sinh phí dịch vụ</span></div>
      </div>

      <div class="pay-grid">
        <div class="pay-card">
          <h4>Hỗ trợ lãi suất</h4>
          <div class="pay-stat">70%<small>CĐT hỗ trợ 0% đến hết 30/06/2027, lãi vay tham chiếu 10%/năm</small></div>
          <ol>
            <li>Đặt cọc<b>100 triệu</b></li>
            <li>Đợt 1 (7 ngày ký HĐMB)<b>15%</b></li>
            <li>Đợt 2 (30 ngày)<b>15%</b></li>
            <li>Đợt 3 (bàn giao căn hộ)<b>2%/KPBT</b></li>
          </ol>
          <p style="font-size:14px;color:var(--ivory-text);opacity:.7;margin-top:12px;">Ngân hàng giải ngân 70% (40% + 25% + 5%) qua các đợt 3-5. Ân hạn nợ gốc tối đa 36 tháng.</p>
        </div>
        <div class="pay-card">
          <h4>Tiến độ tiêu chuẩn</h4>
          <div class="pay-stat">7%<small>Chiết khấu, thanh toán bằng vốn tự có</small></div>
          <ol>
            <li>Đặt cọc<b>100 triệu</b></li>
            <li>Đợt 1 (7 ngày ký HĐMB)<b>50%</b></li>
            <li>Đợt 2 (180 ngày)<b>20%</b></li>
            <li>Đợt 3 (bàn giao căn hộ)<b>25%+2%</b></li>
            <li>Đợt 4 (bàn giao GCN)<b>5%</b></li>
          </ol>
          <p style="font-size:14px;color:var(--ivory-text);opacity:.7;margin-top:12px;">Hoặc: tiến độ giãn 12 tháng (7 đợt) — chiết khấu 5%.</p>
        </div>
        <div class="pay-card pay-card--highlight">
          <span class="best-tag">Ưu đãi cao nhất</span>
          <h4>Thanh toán sớm 95%</h4>
          <div class="pay-stat pay-stat--coral">9%<small>Chiết khấu giá trị căn hộ (chưa gồm VAT)</small></div>
          <ol>
            <li>Đặt cọc<b>100 triệu</b></li>
            <li>Đợt 1 (7 ngày ký HĐMB)<b>95%</b></li>
            <li>Đợt 2 (bàn giao căn hộ)<b>2%</b></li>
            <li>Đợt 3 (bàn giao GCN)<b>5%</b></li>
          </ol>
        </div>
      </div>
    </div>

    <p style="margin-top:24px;font-size:10px;color:var(--ivory-text);opacity:.75;max-width:680px;font-style: italic;">* Mỗi tòa có chính sách bán hàng riêng, có thể thay đổi theo từng đợt mở bán và số lượng căn còn lại. Số liệu theo văn bản CSBH chính thức do chủ đầu tư Phú Mỹ Quy Nhơn phát hành, đóng dấu và ký xác nhận.</p>
    <a href="#nhan-tu-van" class="btn btn-primary" style="margin-top:20px;">Nhận bảng tính chi tiết theo từng căn</a>
  </div>
</section>

<section class="section section--navy">
  <div class="wrap">
    <div class="eyebrow">Vì sao Quy Nhơn</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;max-width:680px;color:#fff;">Thị trường du lịch đang ở điểm bùng nổ</h2>
    <div class="why-grid">
      <div class="why-card"><strong>Top <span class="counter" data-target="25">0</span></strong><p>Điểm đến xu hướng hàng đầu thế giới năm 2026, theo bình chọn quốc tế.</p></div>
      <div class="why-card"><strong><span class="counter" data-target="9">0</span> triệu+</strong><p>Lượt khách du lịch mỗi năm — nguồn cầu thuê lưu trú ngắn hạn ổn định.</p></div>
      <div class="why-card"><strong>"Maldives<br>Việt Nam"</strong><p>Danh xưng báo chí quốc tế dành cho các bãi biển đẹp nhất Việt Nam tại đây.</p></div>
    </div>
  </div>
</section>

<section class="section section--sand" id="san-pham">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold);">Sản phẩm</div>
    <h2 style="font-size:clamp(30px,4.5vw,48px);margin-top:14px;color:var(--navy-deep);max-width:680px;line-height: normal;">Hai tòa tháp,<br>một đẳng cấp sống mới</h2>

    <div class="tower-split">
      <div class="tower-card harbour">
        <div class="tower-eyebrow">Tòa chủ lực</div>
        <h3>THE HARBOUR</h3>
        <div class="tower-sub">Tháp Thiên Cảng Hạng Sang</div>
        <ul class="tower-specs">
          <li>Hướng view <b>Cảng Quy Nhơn · Đầm Thị Nại</b></li>
          <li>Loại hình <b>2PN · 3PN · Duplex · Dual-key*</b></li>
          <li>Định vị <b>An cư · Đầu tư dài hạn</b></li>
        </ul>
        <a href="#nhan-tu-van" class="btn btn-outline">Nhận mặt bằng The Harbour</a>
      </div>
      <div class="tower-card sea">
        <div class="tower-eyebrow">Tòa B</div>
        <h3>THE SEA</h3>
        <div class="tower-sub">Tháp Tâm Vịnh Cao Cấp</div>
        <ul class="tower-specs">
          <li>Hướng view <b>Hướng biển</b></li>
          <li>Loại hình <b>1PN · 2PN · 3PN*</b></li>
          <li>Định vị <b>Nghỉ dưỡng · Cho thuê</b></li>
        </ul>
        <a href="#nhan-tu-van" class="btn btn-outline">Nhận mặt bằng The Sea</a>
      </div>
    </div>

    <div class="compare-wrap">
      <table class="compare">
        <thead>
          <tr><th>Loại hình</th><th>Diện tích thông thủy</th><th>Đặc điểm</th><th>Phù hợp với</th><th></th></tr>
        </thead>
        <tbody>
          <tr><td><strong>1PN+1</strong><br><span style="font-size:14px;color:var(--gold);">First Heights</span></td><td>44,62 m²</td><td>Compact, tối ưu chi phí sở hữu</td><td>Cho thuê ngắn hạn, dòng tiền nhanh</td><td><span class="tag invest">Đầu tư</span></td></tr>
          <tr><td><strong>2PN</strong><br><span style="font-size:14px;color:var(--gold);">Profit Heights</span></td><td>65,01 m²</td><td>Cân bằng công năng & ngân sách</td><td>Vừa ở vừa cho thuê linh hoạt</td><td><span class="tag invest">Đầu tư</span> <span class="tag resort">Nghỉ dưỡng</span></td></tr>
          <tr><td><strong>3PN</strong><br><span style="font-size:14px;color:var(--gold);">Profit Heights</span></td><td>87,54 m²</td><td>Không gian rộng cho gia đình</td><td>An cư lâu dài, second home</td><td><span class="tag resort">Nghỉ dưỡng</span></td></tr>
          <tr><td><strong>3PN Dual-key</strong><br><span style="font-size:14px;color:var(--gold);">Triple Key</span></td><td>86,69 m²</td><td>Tách biệt 2 lối đi — ở kết hợp cho thuê</td><td>Vừa ở vừa khai thác cho thuê độc lập</td><td><span class="tag invest">Đầu tư</span> <span class="tag resort">Nghỉ dưỡng</span></td></tr>
          <tr><td><strong>Duplex</strong></td><td>Đang cập nhật*</td><td>Thông tầng, sân vườn riêng (tầng 26)</td><td>Khẳng định vị thế, tiếp khách</td><td><span class="tag resort">Nghỉ dưỡng</span></td></tr>
          <tr><td><strong>Pent Heights</strong></td><td>Đang cập nhật*</td><td>Tầng cao nhất, view toàn cảnh</td><td>Tài sản để lại, tích lũy giá trị</td><td><span class="tag resort">Nghỉ dưỡng</span></td></tr>
        </tbody>
      </table>
    </div>
    <p style="margin-top:14px;font-size:10px;color:var(--ink-soft);font-style: italic;">* Diện tích theo mặt bằng chính thức từ chủ đầu tư (thông thủy). Duplex xác nhận thuộc The Harbour theo mặt bằng tầng; phân bổ 1PN/2PN/3PN/Dual-key theo từng tòa suy luận từ đối chiếu diện tích trên mặt bằng tầng, đang chờ STND xác nhận chính xác theo bảng hàng. Duplex/Pent Heights đang chờ STND cung cấp mặt bằng chi tiết. Số lượng căn còn lại sẽ được STND cập nhật theo giỏ hàng thực tế.</p>

    <div class="price-ref">
      <span class="price-ref-label">Mức giá tham khảo (đơn giá/m² thông thủy)</span>
      <div class="price-ref-grid">
        <div><span class="price-ref-type">1PN</span><b>46 – 52</b> <span class="price-ref-unit">tr/m²</span></div>
        <div><span class="price-ref-type">2PN</span><b>43 – 54</b> <span class="price-ref-unit">tr/m²</span></div>
        <div><span class="price-ref-type">3PN</span><b>43 – 53</b> <span class="price-ref-unit">tr/m²</span></div>
      </div>
      <p class="price-ref-note">*Mức giá tham khảo, có thể thay đổi theo giỏ hàng và thời điểm mở bán — STND sẽ báo giá chính xác theo từng căn cụ thể.</p>
    </div>
  </div>
</section>



<section class="section section--sand">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold);">Bảng tính tiến độ thanh toán</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:var(--navy-deep);max-width:640px;">Nhập giá sản phẩm, xem chi tiết từng đợt thanh toán</h2>
    <p style="color:var(--ink-soft);font-size:14.5px;max-width:600px;margin-top:8px;">Chọn tòa và loại căn để lấy giá tham khảo, hoặc tự nhập giá bạn đã được báo. Đây <strong>là bảng mô phỏng tham khảo, không phải báo giá/hợp đồng chính thức</strong>.</p>

    <div class="calc2-grid">
      <!-- CỘT TRÁI: input + tóm tắt -->
      <div>
        <div class="calc2-card">
          <span class="calc2-label">Tòa</span>
          <div class="calc2-btn-row" id="c2TowerRow">
            <button class="calc2-btn active" data-tower="harbour">The Harbour</button>
            <button class="calc2-btn" data-tower="sea">The Sea</button>
          </div>
          <span class="calc2-label">Loại căn</span>
          <div class="calc2-btn-row" id="c2UnitRow">
            <button class="calc2-btn active" data-unit="1pn">1PN+1</button>
            <button class="calc2-btn" data-unit="2pn">2PN</button>
            <button class="calc2-btn" data-unit="3pn">3PN</button>
          </div>
          <span class="calc2-label">Giá sản phẩm — <span id="c2PriceHint"></span></span>
          <div class="calc2-input-row">
            <span>VNĐ</span>
            <input type="text" id="c2Price" inputmode="numeric">
          </div>
          <span class="calc2-label">Phương thức thanh toán</span>
          <select class="calc2-select" id="c2Plan"></select>
        </div>

        <div class="calc2-card">
          <div class="calc2-summary-title"><h4>Tóm tắt tài chính</h4><span class="calc2-badge" id="c2Badge"></span></div>
          <div class="calc2-line"><span>Giá niêm yết</span><b id="c2ListPrice"></b></div>
          <div class="calc2-line negative"><span>Số tiền chiết khấu</span><b id="c2DiscountAmt"></b></div>
          <div class="calc2-final">
            <span class="calc2-final-label">Giá sau chiết khấu</span>
            <div class="calc2-final-value" id="c2FinalPrice"></div>
          </div>
          <p class="calc2-hint">Đặt cọc giữ chỗ 100 triệu được tính vào Đợt 1, không cộng thêm ngoài giá sản phẩm.</p>
        </div>
      </div>

      <!-- CỘT PHẢI: bảng tiến độ chi tiết -->
      <div class="calc2-table-wrap">
        <div class="calc2-table-head">
          <h4>Tiến độ thanh toán dự kiến</h4>
          <span id="c2TableSub"></span>
        </div>
        <table class="calc2-table">
          <thead><tr><th>Đợt</th><th>Bên thanh toán</th><th>Số tiền</th><th>Tỷ lệ</th></tr></thead>
          <tbody id="c2ScheduleBody"></tbody>
        </table>
        <p class="calc2-legal">*Bảng tính chỉ mang tính tham khảo. Chiết khấu áp dụng khi thanh toán đúng hạn theo hợp đồng; chưa bao gồm VAT, KPBT và các chi phí khác nếu có. Phần vay ngân hàng tính độc lập theo giá đã nhập, không áp dụng chiết khấu thanh toán. Kết quả có thể thay đổi theo hồ sơ, thời điểm giải ngân và phê duyệt thực tế của ngân hàng — STND sẽ gửi bảng tính chính xác theo từng căn cụ thể.</p>
      </div>
    </div>

    <!-- MÔ PHỎNG VAY NGÂN HÀNG — full-width, tránh nhồi nhiều dòng vào cột hẹp -->
    <div class="calc2-loan-wide">
      <div class="calc2-loan-head">
        <h4>Mô phỏng vay ngân hàng</h4>
        <span class="calc2-badge" id="c2BankName"></span>
      </div>
      <p class="calc2-loan-note">Phần này tính độc lập theo giá sản phẩm đã nhập ở trên, không áp dụng chiết khấu của phương thức thanh toán.</p>

      <div class="calc2-loan-inputs">
        <div><span class="calc2-label">Lãi suất tham khảo (%/năm)</span><div class="calc2-static-val" id="c2Rate"></div></div>
        <div><span class="calc2-label">Thời hạn vay (năm)</span><div class="calc2-static-val" id="c2Term">20</div></div>
        <div><span class="calc2-label">Tỷ lệ vay tối đa</span><div class="calc2-static-val" id="c2LoanPct"></div></div>
        <div><span class="calc2-label">Thời gian hỗ trợ gốc/lãi</span><div class="calc2-static-val" id="c2SupportMonths"></div> (tháng)</div>
      </div>

      <div class="calc2-loan-stats">
        <div class="calc2-stat calc2-stat--highlight"><span>Khoản vay dự kiến</span><b id="c2LoanAmount"></b></div>
        <div class="calc2-stat"><span>Gốc bình quân/tháng</span><b id="c2MonthlyPrincipal"></b></div>
        <div class="calc2-stat"><span>Tháng đầu sau hỗ trợ</span><b id="c2FirstMonth"></b></div>
        <div class="calc2-stat"><span>TB mỗi tháng sau hỗ trợ</span><b id="c2AvgMonth"></b></div>
        <div class="calc2-stat"><span>Tổng lãi dự kiến</span><b id="c2TotalInterest"></b></div>
        <div class="calc2-stat"><span>Tổng gốc + lãi</span><b id="c2TotalPayback"></b></div>
      </div>

      <div class="calc2-loan-bottom">
        <div class="calc2-perk-box" id="c2PerkNote"></div>
        <div class="calc2-mb-box">
          <span class="calc2-mb-label">📄 Thư chào lãi suất chính thức — MB Bank CN Thái Thịnh (08/2026)</span>
          <div class="calc2-mb-grid">
            <div><b>9,5%</b><span>Cố định 12 tháng</span></div>
            <div><b>10%</b><span>Cố định 18 tháng</span></div>
            <div><b>10,5%</b><span>Cố định 24 tháng</span></div>
          </div>
          <p>• Biên độ các năm sau: 3,5%/năm. Ân hạn gốc tối đa 36 tháng (dự án có CĐT hỗ trợ lãi suất) hoặc 48 tháng (vay thông thường).</p> 
          <p>• Phí trả nợ trước hạn: 2,5% (năm 1-3) → 1,5% (năm 4) → 1% (năm 5) → miễn phí (từ năm 6).</p>
          <p>• Thời hạn vay tối đa 35 năm.</p>
        </div>
      </div>
      <p class="calc2-hint">Mô phỏng theo dư nợ giảm dần, gốc chia đều trong số tháng còn lại sau thời gian hỗ trợ. Lãi suất, thời gian hỗ trợ và ngân hàng giải ngân thực tế do ngân hàng thẩm định và phê duyệt theo hồ sơ. Kết quả chỉ mang tính tham khảo.</p>
    </div>

    <a href="#nhan-tu-van" class="btn btn-primary" style="margin-top:24px;" onclick="requestPlan('Bảng tính tiến độ thanh toán')">Nhận bảng tính chính xác theo căn →</a>
  </div>
</section>



<section class="section section--navy" id="mat-bang">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold-bright);">Mặt bằng dự án</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:#fff;max-width:640px;">Mặt bằng chính thức từ chủ đầu tư</h2>
    <p style="color:var(--ivory-text);opacity:.8;font-size:14.5px;max-width:560px;margin-top:10px;">Chọn loại hình để xem mặt bằng. Bấm vào ảnh để phóng to. Bản PDF đầy đủ (kích thước gốc, đủ ghi chú kỹ thuật) được STND gửi qua tư vấn 1-1.</p>

    <div class="plan-tabs">
      <button class="plan-tab active" data-plan="site" onclick="showPlanTab('site')">Mặt bằng tầng</button>
      <button class="plan-tab" data-plan="1pn" onclick="showPlanTab('1pn')">1PN+1</button>
      <button class="plan-tab" data-plan="2pn" onclick="showPlanTab('2pn')">2PN</button>
      <button class="plan-tab" data-plan="3pn" onclick="showPlanTab('3pn')">3PN</button>
      <button class="plan-tab" data-plan="dualkey" onclick="showPlanTab('dualkey')">Dual-key</button>
      <button class="plan-tab" data-plan="duplex" onclick="showPlanTab('duplex')">Duplex</button>
    </div>

    <div class="plan-viewer">
      <div class="plan-panel" data-panel="site">
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/plan-site-typical-floor.jpg" alt="Mặt bằng tầng điển hình Simona Heights" onclick="openPlanLightbox(this)">
        <div class="plan-info">
          <div><span class="plan-line">Mặt bằng tầng điển hình</span><b>The Harbour &amp; The Sea</b><span class="plan-area">The Harbour hướng Cảng &amp; Đầm Thị Nại · The Sea hướng biển Quy Nhơn</span></div>
          <div class="plan-cta" onclick="requestPlan('Tổng mặt bằng dự án')">📄 Tải PDF đầy đủ →</div>
        </div>
      </div>
      <div class="plan-panel" data-panel="1pn" hidden>
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/plan-1pn-first-heights.jpg" alt="Mặt bằng căn hộ 1PN+1 First Heights" onclick="openPlanLightbox(this)">
        <div class="plan-info">
          <div><span class="plan-line">First Heights</span><b>1PN+1</b><span class="plan-area">44,62 m² thông thủy</span></div>
          <div class="plan-cta" onclick="requestPlan('Mặt bằng 1PN')">📄 Tải PDF đầy đủ →</div>
        </div>
      </div>
      <div class="plan-panel" data-panel="2pn" hidden>
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/plan-2pn-profit-heights.jpg" alt="Mặt bằng căn hộ 2PN Profit Heights" onclick="openPlanLightbox(this)">
        <div class="plan-info">
          <div><span class="plan-line">Profit Heights</span><b>2PN</b><span class="plan-area">65,01 m² thông thủy</span></div>
          <div class="plan-cta" onclick="requestPlan('Mặt bằng 2PN')">📄 Tải PDF đầy đủ →</div>
        </div>
      </div>
      <div class="plan-panel" data-panel="3pn" hidden>
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/plan-3pn-profit-heights.jpg" alt="Mặt bằng căn hộ 3PN Profit Heights" onclick="openPlanLightbox(this)">
        <div class="plan-info">
          <div><span class="plan-line">Profit Heights</span><b>3PN</b><span class="plan-area">87,54 m² thông thủy</span></div>
          <div class="plan-cta" onclick="requestPlan('Mặt bằng 3PN')">📄 Tải PDF đầy đủ →</div>
        </div>
      </div>
      <div class="plan-panel" data-panel="dualkey" hidden>
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/plan-dualkey-3br.jpg" alt="Mặt bằng căn hộ Dual-key 3 phòng ngủ" onclick="openPlanLightbox(this)">
        <div class="plan-info">
          <div><span class="plan-line">Profit Heights · Triple Key</span><b>3PN Dual-key</b><span class="plan-area">86,69 m² thông thủy</span></div>
          <div class="plan-cta" onclick="requestPlan('Mặt bằng Dual-key')">📄 Tải PDF đầy đủ →</div>
        </div>
      </div>
      <div class="plan-panel" data-panel="duplex" hidden>
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/plan-duplex-f26.jpg" alt="Mặt bằng căn hộ Duplex tầng 26" onclick="openPlanLightbox(this)">
        <div class="plan-info">
          <div><span class="plan-line">Tầng 26 · The Harbour</span><b>Duplex</b><span class="plan-area">Có sân vườn riêng · diện tích đang cập nhật</span></div>
          <div class="plan-cta" onclick="requestPlan('Mặt bằng Duplex')">📄 Tải PDF đầy đủ →</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--navy" style="border-top:1px solid var(--navy-line);">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold-bright);">Chọn đúng mục tiêu sở hữu</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:#fff;max-width:640px;">Bạn mua Simona Heights để làm gì?</h2>
    <div class="aud-grid">
      <div class="aud-card">
        <span class="tag invest">Đầu tư dòng tiền</span>
        <h3>Khai thác cho thuê</h3>
        <ul>
          <li>Nguồn khách du lịch 9 triệu lượt/năm tạo cầu thuê ổn định quanh năm</li>
          <li>Vị trí trung tâm phố cổ, cách biển 300m — lợi thế cho thuê ngắn hạn khó sao chép</li>
          <li>Loại hình 1PN+/2PN tối ưu chi phí sở hữu, tỷ suất khai thác tốt</li>
          <li>Quy Nhơn lọt Top 25 điểm đến xu hướng thế giới 2026 — tiềm năng tăng giá theo hạ tầng du lịch</li>
        </ul>
      </div>
      <div class="aud-card">
        <span class="tag resort">Second home nghỉ dưỡng</span>
        <h3>An cư & tận hưởng</h3>
        <ul>
          <li>Thiết kế Art Décor tinh tế, tiện ích nội khu đầy đủ cho gia đình nhiều thế hệ</li>
          <li>Tầm nhìn hướng biển và đầm Thị Nại — không gian sống khó tìm ở khu trung tâm</li>
          <li>Loại hình 3PN/Duplex/Pent Heights phù hợp không gian sống rộng rãi; riêng Dual-key giữ được sự riêng tư cho gia đình nhiều thế hệ</li>
          <li>Tài sản để lại, tích lũy giá trị dài hạn cho thế hệ sau</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<div class="skyline-wrap"><div class="skyline reveal" data-skyline>
  <svg viewBox="0 0 1200 64" preserveAspectRatio="none"><polyline points="0,50 120,50 120,20 220,20 220,38 320,38 320,10 420,10 420,44 540,44 540,16 640,16 640,50 1200,50"/></svg>
</div></div>

<section class="section section--sand" id="tien-ich">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold);">Tiện ích nội khu</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:var(--navy-deep);max-width:640px;">Trải nghiệm thượng hạng, nâng niu thể chất &amp; tinh thần</h2>
    <div class="amenity-grid">
      <div class="amenity-item"><img src="<?php echo $theme_uri; ?>/images/simona-heights/amenity-pool.jpg" alt="Hồ bơi vô cực Simona Heights" onerror="imgFallback(this,'HỒ BƠI')"><span>Hồ bơi vô cực</span></div>
      <div class="amenity-item"><img src="<?php echo $theme_uri; ?>/images/simona-heights/amenity-lounge.jpg" alt="Sky Lounge Simona Heights" onerror="imgFallback(this,'SKY LOUNGE')"><span>Sky Lounge trên cao</span></div>
      <div class="amenity-item"><img src="<?php echo $theme_uri; ?>/images/simona-heights/amenity-yoga-garden.jpg" alt="Vườn Yoga Simona Heights" onerror="imgFallback(this,'VƯỜN YOGA')"><span>Vườn Yoga &amp; Thiền</span></div>
      <div class="amenity-item"><img src="<?php echo $theme_uri; ?>/images/simona-heights/amenity-retail.jpg" alt="Phố thương mại nội khu Simona Heights" onerror="imgFallback(this,'PHỐ THƯƠNG MẠI')"><span>Phố thương mại nội khu</span></div>
    </div>
  </div>
</section>


<section class="section section--sand" id="tien-do">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold);">Tiến độ dự án</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:var(--navy-deep);max-width:640px;">Đã cất nóc — xem video thực tế công trường</h2>
    <div class="progress-block">
      <div class="progress-media">
        <img src="<?php echo $theme_uri; ?>/images/simona-heights/gallery-towers-sunset.jpg" alt="Phối cảnh minh họa Simona Heights" onerror="imgFallback(this,'PHỐI CẢNH MINH HỌA')">
        <a class="play" href="https://www.youtube.com/watch?v=HvUft336grM" target="_blank" rel="noopener"><span class="play-btn">▶</span></a>
      </div>
      <ul class="progress-list">
        <li><b>Đã cất nóc</b> — Xem video hành trình cất nóc thực tế tại công trường (bấm nút play).</li>
        <li><b>Video tiến độ định kỳ</b> — STND cập nhật hình ảnh thi công mới nhất theo tháng.</li>
        <li><b>Bàn giao</b> — Thời gian dự kiến sẽ được STND cung cấp cụ thể theo hợp đồng.</li>
      </ul>
      <p style="font-size:10px;color:var(--ink-soft);font-style:italic;">*Ảnh minh họa là phối cảnh dự án (CGI), không phải ảnh công trường thực tế. Ảnh thi công thật xem tại video bên dưới.</p>
      <a href="https://www.youtube.com/watch?v=OLBRjwqBQCw" target="_blank" rel="noopener" class="btn btn-outline-dark" style="width:fit-content;">Xem video tiến độ thực tế</a>
    </div>
  </div>
</section>

<section class="section section--sand" id="thu-vien">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold);">Thư viện ảnh</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:var(--navy-deep);">Không gian sống &amp; phối cảnh dự án</h2>
    <div class="gal-tabs">
      <button class="gal-tab active" data-tab="all">Tất cả</button>
      <button class="gal-tab" data-tab="ext">Phối cảnh</button>
      <button class="gal-tab" data-tab="int">Nội thất</button>
    </div>
    <div class="gal-grid" id="galGrid">
      <div class="gal-item" data-cat="ext"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-towers-dusk.jpg" alt="Simona Heights phối cảnh hoàng hôn"></div>
      <div class="gal-item" data-cat="ext"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-pool-lounge-1.jpg" alt="Hồ bơi vô cực hướng biển"></div>
      <div class="gal-item" data-cat="ext"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-pool-lounge-2.jpg" alt="Sky Lounge về đêm"></div>
      <div class="gal-item" data-cat="ext"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-skywalk.jpg" alt="Skywalk kết nối hai tòa tháp"></div>
      <div class="gal-item" data-cat="ext"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-courtyard-garden.jpg" alt="Công viên nội khu"></div>
      <div class="gal-item" data-cat="ext"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-kid-playground.jpg" alt="Khu vui chơi trẻ em trên cao"></div>
      <div class="gal-item" data-cat="int"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-int-bedroom-tub.jpg" alt="Phòng ngủ master có bồn tắm"></div>
      <div class="gal-item" data-cat="int"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-int-kitchen-living.jpg" alt="Không gian bếp và phòng khách"></div>
      <div class="gal-item" data-cat="int"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-int-lounge-nook.jpg" alt="Góc thư giãn trong căn hộ"></div>
      <div class="gal-item" data-cat="int"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-int-bedroom-styled.jpg" alt="Phòng ngủ phong cách hiện đại"></div>
      <div class="gal-item" data-cat="int"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-plan-3br-iso.jpg" alt="Phối cảnh mặt bằng 3 phòng ngủ"></div>
      <div class="gal-item" data-cat="int"><img src="<?php echo $theme_uri; ?>/images/simona-heights/gal-plan-1br-iso.jpg" alt="Phối cảnh mặt bằng 1 phòng ngủ"></div>
    </div>
  </div>
</section>

<div class="lightbox" id="lightbox">
  <span class="lightbox-close" id="lightboxClose">&times;</span>
  <span class="lightbox-nav lightbox-prev" id="lightboxPrev">&#10094;</span>
  <img id="lightboxImg" src="" alt="">
  <span class="lightbox-nav lightbox-next" id="lightboxNext">&#10095;</span>
  <span class="lightbox-counter" id="lightboxCounter"></span>
</div>


<section class="section section--navy" id="faq">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold-bright);">Giải đáp nhanh</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:#fff;max-width:640px;">Câu hỏi thường gặp</h2>
    <div class="faq-list">
      <details class="faq-item" open>
        <summary>Simona Heights sở hữu lâu dài hay có thời hạn?</summary>
        <p><span class="faq-pending">Đang chờ STND xác nhận bằng văn bản chính thức từ chủ đầu tư.</span> Đây là thông tin quan trọng — vui lòng liên hệ hotline để được xác nhận trước khi đặt cọc.</p>
      </details>
      <details class="faq-item">
        <summary>Căn hộ bàn giao thô hay đã hoàn thiện nội thất?</summary>
        <p>Căn hộ bàn giao kèm <strong>full nội thất rời</strong> theo tiêu chuẩn chủ đầu tư (không phải bàn giao thô). Ngoài ra, chương trình "Tổ ấm đủ đầy" còn tặng thêm gói hoàn thiện nội thất cao cấp khi đáp ứng điều kiện giao dịch — xem chi tiết ở mục Chính sách bán hàng.</p>
      </details>
      <details class="faq-item">
        <summary>Chính sách bán hàng có áp dụng cho cả The Sea không?</summary>
        <p>Có. Mỗi tòa có chính sách riêng — <strong>The Harbour</strong> áp dụng từ 15/08/2026, <strong>The Sea</strong> áp dụng từ 11/06/2026. Xem chi tiết đầy đủ (mức chiết khấu, quà tặng riêng từng tòa) ở mục Chính sách bán hàng, chọn tab tương ứng.</p>
      </details>
      <details class="faq-item">
        <summary>Thời điểm dự kiến bàn giao căn hộ?</summary>
        <p>Dự án đã cất nóc. Thời gian bàn giao cụ thể sẽ được STND cung cấp theo hợp đồng mua bán chính thức.</p>
      </details>
      <details class="faq-item">
        <summary>STND có phải là chủ đầu tư dự án không?</summary>
        <p>Không. Chủ đầu tư là Công ty TNHH Đầu tư Xây dựng Phú Mỹ Quy Nhơn. STND là đơn vị phân phối chính thức (F1), đại diện tư vấn và hỗ trợ khách hàng trong suốt quá trình giao dịch.</p>
      </details>
      <details class="faq-item">
        <summary>Đặt cọc giữ chỗ cần bao nhiêu?</summary>
        <p>Theo CSBH hiện tại của The Harbour, mức đặt cọc giữ chỗ là <strong>100 triệu đồng</strong>, sau đó thanh toán theo 1 trong 3 phương án tiến độ đã nêu ở phần Chính sách bán hàng.</p>
      </details>
    </div>
  </div>
</section>




<section class="section cta-block" id="nhan-tu-van">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--gold);">Nhận tư vấn</div>
    <h2 style="font-size:clamp(28px,4vw,42px);margin-top:14px;color:var(--navy-deep);max-width:600px;">Nhận bảng giá, chính sách bán hàng & mặt bằng chi tiết</h2>
    <div class="form-grid">
      <div class="form-card">
        <h3>Đăng ký nhận thông tin</h3>
        <p>STND phản hồi trong vòng 15 phút trong giờ làm việc.</p>
        <form id="leadForm" onsubmit="return handleLeadSubmit(event)">
          <input type="hidden" name="utm_source" id="utm_source">
          <input type="hidden" name="utm_medium" id="utm_medium">
          <input type="hidden" name="utm_campaign" id="utm_campaign">
          <input type="hidden" name="utm_content" id="utm_content">
          <input type="hidden" name="utm_term" id="utm_term">
          <input type="hidden" name="fbclid" id="fbclid">
          <input type="hidden" name="gclid" id="gclid">
          <input type="hidden" name="landing_page_url" id="landing_page_url">
          <input type="hidden" name="first_visit_at" id="first_visit_at">
          <div class="form-row"><label for="fname">Họ và tên *</label><input id="fname" name="name" required></div>
          <div class="form-row"><label for="fphone">Số điện thoại *</label><input id="fphone" name="phone" type="tel" required></div>
          <div class="form-row">
            <label for="finterest">Quan tâm loại hình</label>
            <select id="finterest" name="interest">
              <option>The Harbour — 2PN/3PN/Duplex/Dual-key/Pent Heights</option>
              <option>Chính sách bán hàng &amp; ưu đãi The Harbour</option>
              <option>The Sea — 1PN+/2PN/3PN</option>
              <option>Chính sách bán hàng &amp; ưu đãi The Sea</option>
              <option>Đầu tư cho thuê</option>
              <option>Second home nghỉ dưỡng</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;">Gửi yêu cầu tư vấn</button>
        </form>
      </div>
      <div class="contact-box">
        <div class="eyebrow">Đại lý phân phối F1</div>
        <div class="contact-brand-row">
          <img src="<?php echo $theme_uri; ?>/images/simona-heights/logo-stnd.png" alt="STND - Siêu Thị Nhà Đất" class="contact-logo">
          <h3 style="font-size:28px;color:#fff;margin:0;">STND — Siêu Thị Nhà Đất</h3>
        </div>
        <div class="contact-item"><div><b>Hotline</b><span><a href="tel:0972991551">0972.991.551</a></span></div></div>
        <div class="contact-item"><div><b>Văn phòng</b><span>262 Tây Sơn, Đống Đa, Hà Nội</span></div></div>
        <div class="contact-item"><div><b>Website</b><span><a href="https://stnd.vn" target="_blank" rel="noopener">stnd.vn</a></span></div></div>
        <div class="contact-cta-row">
          <a href="tel:0972991551" class="btn btn-outline">Gọi ngay</a>
          <a href="https://zalo.me/0972991551" target="_blank" rel="noopener" class="btn btn-outline">
            Chat Zalo
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="wrap">
    <p class="footer-legal">
      Thông tin dự án Simona Heights tại trang này thuộc quyền sở hữu của Công ty TNHH Đầu tư Xây dựng Phú Mỹ Quy Nhơn (MST 4101427606). Chính sách bán hàng The Harbour và The Sea căn cứ theo văn bản CSBH chính thức do chủ đầu tư phát hành, có thể thay đổi theo từng đợt mở bán và số lượng căn còn lại. Hình ảnh, sơ đồ kỹ thuật, bố trí nội ngoại thất chỉ nhằm mục đích minh họa, không phải cam kết pháp lý. Thông tin chính thức căn cứ theo hợp đồng mua bán và tài liệu ký kết chính thức với khách hàng. STND là đơn vị phân phối chính thức (F1), không phải chủ đầu tư.
    </p>
    <div class="footer-bottom">
      <span>© 2026 STND — Đại lý phân phối chính thức Simona Heights</span>
      <span>262 Tây Sơn, Đống Đa, Hà Nội · 0972.991.551</span>
    </div>
  </div>
</footer>

<div class="sticky-bar">
  <a href="tel:0972991551"><span class="ic">☎</span>Gọi ngay</a>
  <a href="https://zalo.me/0972991551" target="_blank" rel="noopener"><img src="<?php echo get_template_directory_uri(); ?>/icons/icons-zalo.svg" alt="Zalo" class="fl-zalo-img">Zalo</a>
  <a href="#nhan-tu-van"><span class="ic">📩</span>Nhận báo giá</a>
</div>

<div class="side-fab">
  <a href="tel:0972991551" class="fab-call" aria-label="Gọi STND"><span class="fab-label">Gọi 0972.991.551</span>☎</a>
  <a href="https://zalo.me/0972991551" target="_blank" rel="noopener" class="fab-zalo" aria-label="Chat Zalo">
    <img src="<?php echo get_template_directory_uri(); ?>/icons/icons-zalo.svg" alt="Zalo" class="fl-zalo-img">
  </a>
</div>
<!-- Facebook Pixel Placeholder: Thay YOUR_PIXEL_ID bằng Pixel thật trước khi chạy ads -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', 'YOUR_PIXEL_ID');
fbq('track', 'PageView');
</script>

<?php wp_footer(); ?>
</body>
</html>

