// Fallback: nếu ảnh từ simonaheights.vn bị chặn hotlink, thay bằng placeholder art-deco skyline (giữ layout không vỡ)
function imgFallback(el, label){
  el.onerror = null;
  var txt = encodeURIComponent(label || 'SIMONA HEIGHTS');
  el.src = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='800' height='600'><rect width='800' height='600' fill='%230D2436'/><polyline points='0,420 90,420 90,300 170,300 170,360 260,360 260,220 340,220 340,380 420,380 420,180 500,180 500,340 580,340 580,260 660,260 660,400 800,400' fill='none' stroke='%23B8935A' stroke-width='2'/><line x1='0' y1='420' x2='800' y2='420' stroke='%23B8935A' stroke-width='1'/><text x='400' y='500' font-family='sans-serif' font-size='22' fill='%23D4AF74' text-anchor='middle' letter-spacing='3'>" + txt + "</text></svg>";
  el.style.objectFit = 'cover';
}
// Scroll reveal
document.addEventListener('DOMContentLoaded', function(){
  initCalculator();

  // Tự động gắn hiệu ứng scroll-reveal cho các khối nội dung chính trong toàn trang.
  // Không áp dụng cho Hero (đã hiện sẵn khi tải trang, không cần cuộn mới thấy).
  (function tagRevealBlocks(){
    var groupSelectors = [
      '.trust-grid > .trust-item',
      '.loc-list > li',
      '.why-grid > .why-card',
      '.tower-split > .tower-card',
      '.compare-wrap',
      '.price-ref',
      '.calc2-grid > div > .calc2-card',
      '.calc2-loan-wide',
      '.calc2-loan-stats > .calc2-stat',
      '.calc2-table-wrap',
      '.aud-grid > .aud-card',
      '.plan-tabs',
      '.plan-viewer',
      '.amenity-grid > .amenity-item',
      '.progress-media',
      '.progress-list',
      '.map-embed',
      '.gal-tabs',
      '.gal-grid > .gal-item',
      '.faq-list > .faq-item',
      '.gift-grid > .gift-card',
      '.pay-grid > .pay-card',
      '.form-card',
      '.contact-box'
    ];
    // Tiêu đề mỗi section cũng hiện dần (trừ Hero)
    document.querySelectorAll('.section h2, .csbh-block h2, .cta-block h2').forEach(function(h2){
      h2.classList.add('reveal');
    });

    groupSelectors.forEach(function(sel){
      var group = document.querySelectorAll(sel);
      group.forEach(function(el, i){
        el.classList.add('reveal');
        var delay = Math.min(i, 5) * 90; // so le tối đa 5 phần tử đầu, tránh chờ quá lâu với danh sách dài (VD 12 ảnh gallery)
        el.style.transitionDelay = delay + 'ms';
      });
    });
  })();

  var els = document.querySelectorAll('.reveal, .skyline');
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(en){ if(en.isIntersecting){ en.target.classList.add('in-view'); } });
  }, {threshold:.15});
  els.forEach(function(el){ io.observe(el); });

  // Number count-up animation
  var counters = document.querySelectorAll('.counter');
  if (counters.length > 0) {
    var countObserver = new IntersectionObserver(function(entries, observer){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
          var targetEl = entry.target;
          var targetVal = parseInt(targetEl.getAttribute('data-target'), 10);
          if (!isNaN(targetVal)) {
            var duration = 1500;
            var startTime = null;
            function step(timestamp) {
              if (!startTime) startTime = timestamp;
              var progress = Math.min((timestamp - startTime) / duration, 1);
              var ease = 1 - Math.pow(1 - progress, 3);
              var current = Math.floor(ease * targetVal);
              targetEl.textContent = current;
              if (progress < 1) {
                window.requestAnimationFrame(step);
              } else {
                targetEl.textContent = targetVal;
              }
            }
            window.requestAnimationFrame(step);
          }
          observer.unobserve(targetEl);
        }
      });
    }, { threshold: 0.2 });

    counters.forEach(function(c){ countObserver.observe(c); });
  }

  // Gallery filter
  var tabs = document.querySelectorAll('.gal-tab');
  var items = document.querySelectorAll('.gal-item');
  tabs.forEach(function(tab){
    tab.addEventListener('click', function(){
      tabs.forEach(function(t){ t.classList.remove('active'); });
      tab.classList.add('active');
      var cat = tab.getAttribute('data-tab');
      items.forEach(function(it){
        it.hidden = (cat !== 'all' && it.getAttribute('data-cat') !== cat);
      });
    });
  });

  // Lightbox — chế độ slide: duyệt qua các ảnh đang hiển thị (theo tab đang lọc)
  var lb = document.getElementById('lightbox');
  var lbImg = document.getElementById('lightboxImg');
  var lbCounter = document.getElementById('lightboxCounter');
  var lbIndex = 0;
  var visibleItems = [];

  function getVisibleItems(){
    return Array.prototype.filter.call(items, function(it){ return !it.hidden; });
  }

  function showSlide(i){
    if(visibleItems.length === 0) return;
    lbIndex = (i + visibleItems.length) % visibleItems.length;
    var img = visibleItems[lbIndex].querySelector('img');
    lbImg.src = img.src; lbImg.alt = img.alt;
    lbCounter.textContent = (lbIndex + 1) + ' / ' + visibleItems.length;
  }

  items.forEach(function(it, idx){
    it.addEventListener('click', function(){
      visibleItems = getVisibleItems();
      lbIndex = visibleItems.indexOf(it);
      showSlide(lbIndex);
      lb.classList.remove('lightbox--single');
      lb.classList.add('open');
    });
  });

  document.getElementById('lightboxPrev').addEventListener('click', function(e){ e.stopPropagation(); showSlide(lbIndex - 1); });
  document.getElementById('lightboxNext').addEventListener('click', function(e){ e.stopPropagation(); showSlide(lbIndex + 1); });
  document.getElementById('lightboxClose').addEventListener('click', function(){ lb.classList.remove('open'); });
  lb.addEventListener('click', function(e){ if(e.target === lb){ lb.classList.remove('open'); } });
  document.addEventListener('keydown', function(e){
    if(!lb.classList.contains('open')) return;
    if(e.key === 'Escape'){ lb.classList.remove('open'); }
    if(e.key === 'ArrowLeft'){ showSlide(lbIndex - 1); }
    if(e.key === 'ArrowRight'){ showSlide(lbIndex + 1); }
  });
  // Vuốt trái/phải trên mobile
  var touchStartX = 0;
  lb.addEventListener('touchstart', function(e){ touchStartX = e.changedTouches[0].screenX; });
  lb.addEventListener('touchend', function(e){
    var dx = e.changedTouches[0].screenX - touchStartX;
    if(Math.abs(dx) > 40){ showSlide(dx > 0 ? lbIndex - 1 : lbIndex + 1); }
  });

  // Hero slider
  var slides = document.querySelectorAll('.hero-slide');
  var dotsWrap = document.getElementById('heroDots');
  if(slides.length > 1 && dotsWrap){
    slides.forEach(function(_, i){
      var dot = document.createElement('span');
      if(i === 0) dot.classList.add('active');
      dot.addEventListener('click', function(){ goToSlide(i); });
      dotsWrap.appendChild(dot);
    });
    var dots = dotsWrap.querySelectorAll('span');
    var current = 0, timer;
    function goToSlide(i){
      slides[current].classList.remove('active');
      dots[current].classList.remove('active');
      current = i;
      slides[current].classList.add('active');
      dots[current].classList.add('active');
    }
    function nextSlide(){ goToSlide((current + 1) % slides.length); }
    function startAutoplay(){ timer = setInterval(nextSlide, 5000); }
    startAutoplay();
    dotsWrap.addEventListener('click', function(){ clearInterval(timer); startAutoplay(); });
  }

  // UTM / attribution capture — persists across the session so the FIRST
  // ad click a visitor came from is credited, even if they browse a while
  // before submitting the form. Required for accurate CPL-by-campaign tracking.
  (function captureAttribution(){
    var params = new URLSearchParams(window.location.search);
    var keys = ['utm_source','utm_medium','utm_campaign','utm_content','utm_term','fbclid','gclid'];
    var stored = {};
    try { stored = JSON.parse(sessionStorage.getItem('simona_attr') || '{}'); } catch(e){ stored = {}; }

    var hasNewParams = keys.some(function(k){ return params.get(k); });
    if(hasNewParams || !stored.first_visit_at){
      keys.forEach(function(k){
        if(params.get(k)) stored[k] = params.get(k);
      });
      if(!stored.first_visit_at) stored.first_visit_at = new Date().toISOString();
      stored.landing_page_url = window.location.href;
      try { sessionStorage.setItem('simona_attr', JSON.stringify(stored)); } catch(e){}
    }

    keys.forEach(function(k){
      var el = document.getElementById(k);
      if(el) el.value = stored[k] || '';
    });
    var urlEl = document.getElementById('landing_page_url');
    if(urlEl) urlEl.value = stored.landing_page_url || window.location.href;
    var dateEl = document.getElementById('first_visit_at');
    if(dateEl) dateEl.value = stored.first_visit_at || new Date().toISOString();
  })();
});

// Mặt bằng — bấm vào 1 loại hình sẽ tự chọn đúng mục trong form rồi cuộn tới
// Chuyển tab CSBH giữa The Harbour / The Sea
function switchTower(tower){
  document.querySelectorAll('.tower-tab').forEach(function(btn){
    btn.classList.toggle('active', btn.getAttribute('data-tower') === tower);
  });
  document.querySelectorAll('.tower-panel').forEach(function(panel){
    panel.hidden = panel.getAttribute('data-panel') !== tower;
  });
  if(typeof dataLayer !== 'undefined'){ dataLayer.push({event:'csbh_tower_switch', tower:tower}); }
}

// Mặt bằng — bấm vào ảnh để xem full màn hình (dùng lại lightbox có sẵn)
// Mặt bằng — chuyển tab giữa các loại hình
// ===== Bảng tính tiến độ thanh toán =====
// Toàn bộ % và mốc thời gian lấy đúng theo văn bản CSBH chính thức từng tòa (không tự suy diễn số liệu).
// "kh" = % khách hàng tự thanh toán. "kpbt" = khoản KPBT (2%, tính riêng ngoài % HĐMB). "nh" = % ngân hàng giải ngân (không phải khách trả).
var C2_UNITS = {
  '1pn': {name:'1PN+1', sub:'First Heights', area:44.62, priceLow:46, priceHigh:52},
  '2pn': {name:'2PN', sub:'Profit Heights', area:65.01, priceLow:43, priceHigh:54},
  '3pn': {name:'3PN', sub:'Profit Heights', area:87.54, priceLow:43, priceHigh:53}
};

var C2_PLANS = {
  harbour: {
    htls70: {
      label:'Hỗ trợ lãi suất 70% (HTLS 24 tháng)', discount:0, supportMonths:24, rate:10.5,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:15},
        {stage:'Đợt 2', desc:'Trong 90 ngày kể từ ký HĐMB', kh:5},
        {stage:'Đợt 3', desc:'Trong 90 ngày kể từ Đợt 2', kh:5},
        {stage:'Đợt 4', desc:'Khi bàn giao căn hộ — 7 ngày', kh:2, kpbt:true, nh:70},
        {stage:'Đợt 5', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    },
    htls50: {
      label:'Hỗ trợ lãi suất 50% (HTLS 36 tháng)', discount:0, supportMonths:36, rate:11.5,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:15},
        {stage:'Đợt 2', desc:'Trong 90 ngày kể từ ký HĐMB', kh:15},
        {stage:'Đợt 3', desc:'Trong 90 ngày kể từ Đợt 2', kh:15},
        {stage:'Đợt 4', desc:'Khi bàn giao căn hộ — 7 ngày', kh:2, kpbt:true, nh:50},
        {stage:'Đợt 5', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    },
    standard: {
      label:'Tiến độ tiêu chuẩn — 28 tháng (vốn tự có)', discount:0, supportMonths:0, rate:11.5,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:15},
        {stage:'Đợt 2', desc:'Trong 90 ngày kể từ ký HĐMB', kh:5},
        {stage:'Đợt 3', desc:'Trong 90 ngày kể từ Đợt 2', kh:5},
        {stage:'Đợt 4', desc:'Trong 90 ngày kể từ Đợt 3 (30% khi nhận nhà)', kh:5},
        {stage:'Đợt 5-12', desc:'8 đợt, mỗi đợt trong 90 ngày', kh:40},
        {stage:'Đợt 13', desc:'Khi bàn giao căn hộ — 7 ngày', kh:25, kpbt:true},
        {stage:'Đợt 14', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    },
    early95: {
      label:'Thanh toán sớm 95% (chiết khấu 18%)', discount:18, supportMonths:0, rate:11.5,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:95},
        {stage:'Đợt 2', desc:'Khi bàn giao căn hộ — 7 ngày', kh:2, kpbt:true},
        {stage:'Đợt 3', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    }
  },
  sea: {
    htls: {
      label:'Hỗ trợ lãi suất (CĐT hỗ trợ 0% đến 30/06/2027)', discount:0, supportMonths:18, rate:10,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:15},
        {stage:'Đợt 2', desc:'Trong 30 ngày kể từ ký HĐMB', kh:15},
        {stage:'Đợt 3', desc:'Trong 5 ngày kể từ Đợt 2 — Ngân hàng giải ngân', nh:40},
        {stage:'Đợt 4', desc:'Khi bàn giao căn hộ — 7 ngày', kh:2, kpbt:true, nh:25},
        {stage:'Đợt 5', desc:'Khi bàn giao GCN — 7 ngày — Ngân hàng giải ngân', nh:5}
      ]
    },
    standard7: {
      label:'Tiến độ tiêu chuẩn (chiết khấu 7%)', discount:7, supportMonths:0, rate:10,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:50},
        {stage:'Đợt 2', desc:'Trong 180 ngày kể từ ký HĐMB', kh:20},
        {stage:'Đợt 3', desc:'Khi bàn giao căn hộ — 7 ngày', kh:25, kpbt:true},
        {stage:'Đợt 4', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    },
    giai12: {
      label:'Giãn 12 tháng (chiết khấu 5%)', discount:5, supportMonths:0, rate:10,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:15},
        {stage:'Đợt 2', desc:'Trong 60 ngày kể từ ký HĐMB', kh:15},
        {stage:'Đợt 3', desc:'Trong 60 ngày kể từ Đợt 2', kh:15},
        {stage:'Đợt 4', desc:'Trong 90 ngày kể từ Đợt 3', kh:15},
        {stage:'Đợt 5', desc:'Trong 90 ngày kể từ Đợt 4', kh:10},
        {stage:'Đợt 6', desc:'Khi bàn giao căn hộ — 7 ngày', kh:25, kpbt:true},
        {stage:'Đợt 7', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    },
    early95: {
      label:'Thanh toán sớm 95% (chiết khấu 9%)', discount:9, supportMonths:0, rate:10,
      rows:[
        {stage:'Đợt 1', desc:'Ký HĐMB — trong 7 ngày (đã gồm cọc)', kh:95},
        {stage:'Đợt 2', desc:'Khi bàn giao căn hộ — 7 ngày', kh:2, kpbt:true},
        {stage:'Đợt 3', desc:'Khi bàn giao GCN — 7 ngày', kh:5}
      ]
    }
  }
};

function c2FmtVND(n){
  if(isNaN(n) || n === null) return '0 đ';
  return Math.round(n).toLocaleString('vi-VN') + ' đ';
}
function c2FmtInput(n){
  return Math.round(n).toLocaleString('vi-VN');
}
function c2ParseNum(str){
  // Giá VNĐ luôn là số nguyên — bỏ hết dấu chấm phân cách hàng nghìn, khoảng trắng, ký tự chữ trước khi đọc số.
  // Lưu ý: KHÔNG dùng parseFloat trực tiếp vì "1.200.000.000" sẽ bị hiểu nhầm thành 1.2 (dừng ở dấu chấm thứ 2).
  var cleaned = String(str).replace(/[^\d-]/g, '');
  var n = parseInt(cleaned, 10);
  return isNaN(n) ? 0 : n;
}
function c2ParseDecimal(str){
  // Dùng riêng cho ô lãi suất (%) — CÓ số thập phân thật (VD 10.5), khác với giá VNĐ ở trên.
  var n = parseFloat(String(str).replace(/[^\d.-]/g, ''));
  return isNaN(n) ? 0 : n;
}
function c2State(){
  var tower = document.querySelector('#c2TowerRow .calc2-btn.active').getAttribute('data-tower');
  var unit = document.querySelector('#c2UnitRow .calc2-btn.active').getAttribute('data-unit');
  return {tower:tower, unit:unit};
}

function c2FillDefaultPrice(){
  var st = c2State();
  var u = C2_UNITS[st.unit];
  var mid = Math.round(u.area * (u.priceLow + u.priceHigh) / 2) * 1000000 / 1; // triệu -> đồng, làm tròn
  mid = Math.round(u.area * (u.priceLow + u.priceHigh) / 2) * 1000000;
  document.getElementById('c2Price').value = c2FmtInput(mid);
  document.getElementById('c2PriceHint').textContent = u.name + ' (' + u.sub + ') · ' + u.area.toLocaleString('vi-VN') + ' m² · tham khảo ' + u.priceLow + '–' + u.priceHigh + ' tr/m²';
}

function c2RenderPlans(){
  var tower = c2State().tower;
  var sel = document.getElementById('c2Plan');
  sel.innerHTML = '';
  Object.keys(C2_PLANS[tower]).forEach(function(id){
    var opt = document.createElement('option');
    opt.value = id; opt.textContent = C2_PLANS[tower][id].label;
    sel.appendChild(opt);
  });
}

function c2CurrentPlan(){
  var tower = c2State().tower;
  var id = document.getElementById('c2Plan').value;
  return C2_PLANS[tower][id];
}

function c2RenderSummaryAndSchedule(){
  var price = c2ParseNum(document.getElementById('c2Price').value);
  var plan = c2CurrentPlan();
  var discountAmt = price * (plan.discount / 100);
  var finalPrice = price - discountAmt;

  document.getElementById('c2Badge').textContent = plan.discount > 0 ? ('Chiết khấu ' + plan.discount + '%') : 'Không chiết khấu';
  document.getElementById('c2ListPrice').textContent = c2FmtVND(price);
  document.getElementById('c2DiscountAmt').textContent = discountAmt > 0 ? ('- ' + c2FmtVND(discountAmt)) : '0 đ';
  document.getElementById('c2FinalPrice').textContent = c2FmtVND(finalPrice);
  document.getElementById('c2TableSub').textContent = plan.label;

  var DEPOSIT = 100000000; // 100 triệu, cố định mọi phương thức theo văn bản CSBH
  var body = document.getElementById('c2ScheduleBody');
  var rowsHtml = '';

  rowsHtml += '<tr><td><span class="calc2-stage-badge">Đặt cọc</span><div class="calc2-stage-desc">Giữ chỗ, tính vào Đợt 1</div></td><td>Khách hàng</td><td class="calc2-amount">' + c2FmtVND(DEPOSIT) + '</td><td class="calc2-percent">—</td></tr>';

  var hasNhRow = false;
  plan.rows.forEach(function(r){
    var khAmt = r.kh ? finalPrice * (r.kh/100) : 0;
    if(r.stage === 'Đợt 1' && r.kh){ khAmt = khAmt - DEPOSIT; }
    var whoLabel = 'Khách hàng';
    var amtLabel = r.kh ? c2FmtVND(khAmt) : '';
    var pctLabel = r.kh ? (r.kh + '%' + (r.kpbt ? ' (KPBT)' : '')) : '';
    if(r.kh){
      rowsHtml += '<tr><td><span class="calc2-stage-badge">' + r.stage + '</span><div class="calc2-stage-desc">' + r.desc + (r.stage==='Đợt 1' ? ' — đã trừ tiền cọc' : '') + '</div></td><td>' + whoLabel + '</td><td class="calc2-amount">' + amtLabel + '</td><td class="calc2-percent">' + pctLabel + '</td></tr>';
    }
    if(r.nh){
      hasNhRow = true;
      var nhAmt = finalPrice * (r.nh/100);
      rowsHtml += '<tr><td><span class="calc2-stage-badge" style="background:#E4EEEC;color:#2C5750;">' + r.stage + '</span><div class="calc2-stage-desc">' + r.desc.replace(' — Ngân hàng giải ngân','') + '</div></td><td>Ngân hàng giải ngân</td><td class="calc2-amount" style="color:#2C5750;">' + c2FmtVND(nhAmt) + '</td><td class="calc2-percent">' + r.nh + '%</td></tr>';
    }
  });

  rowsHtml += '<tr class="calc2-total"><td colspan="2"><b>TỔNG GIÁ SAU CHIẾT KHẤU</b></td><td class="calc2-amount">' + c2FmtVND(finalPrice) + '</td><td class="calc2-percent">100%</td></tr>';
  body.innerHTML = rowsHtml;

  var nhNoteEl = document.querySelector('.calc2-nh-note');
  if(hasNhRow && !nhNoteEl){
    var note = document.createElement('div');
    note.className = 'calc2-nh-note';
    note.textContent = 'Dòng "Ngân hàng giải ngân" là phần ngân hàng chuyển thẳng cho chủ đầu tư theo gói hỗ trợ lãi suất — không phải số tiền khách hàng tự thanh toán.';
    body.parentElement.parentElement.insertBefore(note, body.parentElement.parentElement.querySelector('.calc2-legal'));
  } else if(!hasNhRow && nhNoteEl){
    nhNoteEl.remove();
  }

  c2RenderLoan();
}

function c2RenderLoan(){
  var plan = c2CurrentPlan();
  var price = c2ParseNum(document.getElementById('c2Price').value); // giá gốc, KHÔNG áp chiết khấu cho phần vay
  var rate = plan.rate / 100;
  var termYears = 20;
  var supportMonths = plan.supportMonths;
  var loanPct = 70; // tối đa 70% giá trị HĐMB theo CSBH cả 2 tòa

  document.getElementById('c2BankName').textContent = c2State().tower === 'harbour' ? 'MB Bank CN Thái Thịnh' : 'Có thể là MB Bank (chưa xác nhận riêng The Sea)';
  document.getElementById('c2LoanPct').textContent = loanPct + '%';

  var loanAmount = price * (loanPct/100);
  document.getElementById('c2LoanAmount').textContent = c2FmtVND(loanAmount);

  var termMonths = termYears * 12;
  var remainMonths = Math.max(termMonths - supportMonths, 1);
  var monthlyPrincipal = loanAmount / remainMonths;
  var interestDuringSupport = supportMonths > 0 ? (loanAmount * rate * (supportMonths/12)) : 0;
  var firstMonthInterest = loanAmount * (rate/12);
  var firstMonthTotal = monthlyPrincipal + firstMonthInterest;
  var lastMonthInterest = monthlyPrincipal * (rate/12);
  var lastMonthTotal = monthlyPrincipal + lastMonthInterest;

  // Tổng lãi sau hỗ trợ: dư nợ giảm dần, gốc chia đều — Σ (dư nợ còn lại mỗi tháng × lãi suất/12)
  var totalInterestAfterSupport = monthlyPrincipal * (rate/12) * (remainMonths * (remainMonths+1) / 2);
  var totalPayback = loanAmount + totalInterestAfterSupport;
  var avgMonth = totalPayback / remainMonths;

  document.getElementById('c2MonthlyPrincipal').textContent = c2FmtVND(monthlyPrincipal) + '/tháng';
  document.getElementById('c2FirstMonth').textContent = c2FmtVND(firstMonthTotal) + '/tháng';
  document.getElementById('c2AvgMonth').textContent = c2FmtVND(avgMonth) + '/tháng';
  document.getElementById('c2TotalInterest').textContent = c2FmtVND(totalInterestAfterSupport);
  document.getElementById('c2TotalPayback').textContent = c2FmtVND(totalPayback);

  var perkEl = document.getElementById('c2PerkNote');
  if(supportMonths > 0){
    perkEl.style.display = 'block';
    perkEl.innerHTML = 'Quyền lợi: Chủ đầu tư hỗ trợ lãi suất trong ' + supportMonths + ' tháng đầu theo chính sách ' + plan.label + '. Khoản vay, tài sản bảo đảm và lịch giải ngân do ngân hàng thẩm định và phê duyệt theo hồ sơ thực tế.';
  } else {
    perkEl.style.display = 'none';
  }
}

function c2SyncLoanDefaults(){
  var plan = c2CurrentPlan();
  document.getElementById('c2Rate').textContent = plan.rate;
  document.getElementById('c2SupportMonths').textContent = plan.supportMonths;
}

function initCalculator(){
  var towerRow = document.getElementById('c2TowerRow');
  if(!towerRow) return;
  var unitRow = document.getElementById('c2UnitRow');
  var planSel = document.getElementById('c2Plan');
  var priceInput = document.getElementById('c2Price');
  var rateInput = document.getElementById('c2Rate');
  var termInput = document.getElementById('c2Term');
  var supportInput = document.getElementById('c2SupportMonths');

  towerRow.querySelectorAll('.calc2-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      towerRow.querySelectorAll('.calc2-btn').forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      c2RenderPlans();
      c2SyncLoanDefaults();
      c2FillDefaultPrice();
      c2RenderSummaryAndSchedule();
    });
  });
  unitRow.querySelectorAll('.calc2-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      unitRow.querySelectorAll('.calc2-btn').forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      c2FillDefaultPrice();
      c2RenderSummaryAndSchedule();
    });
  });
  planSel.addEventListener('change', function(){
    c2SyncLoanDefaults();
    c2RenderSummaryAndSchedule();
  });
  priceInput.addEventListener('input', function(){
    var raw = c2ParseNum(priceInput.value);
    priceInput.value = raw ? c2FmtInput(raw) : '';
    c2RenderSummaryAndSchedule();
  });
  // Removed event listeners for rateInput, termInput, supportInput as they are now static divs

  c2RenderPlans();
  c2SyncLoanDefaults();
  c2FillDefaultPrice();
  c2RenderSummaryAndSchedule();
}


function showPlanTab(plan){
  document.querySelectorAll('.plan-tab').forEach(function(btn){
    btn.classList.toggle('active', btn.getAttribute('data-plan') === plan);
  });
  document.querySelectorAll('.plan-panel').forEach(function(panel){
    panel.hidden = panel.getAttribute('data-panel') !== plan;
  });
  if(typeof dataLayer !== 'undefined'){ dataLayer.push({event:'plan_tab_switch', plan:plan}); }
}

function openPlanLightbox(imgEl){
  var lb = document.getElementById('lightbox');
  var lbImg = document.getElementById('lightboxImg');
  lbImg.src = imgEl.src;
  lbImg.alt = imgEl.alt;
  lb.classList.add('open');
  lb.classList.add('lightbox--single');
  if(typeof dataLayer !== 'undefined'){ dataLayer.push({event:'plan_zoom_view', plan:imgEl.alt}); }
}

function requestPlan(label){
  var select = document.getElementById('finterest');
  if(select){
    var matched = false;
    for(var i = 0; i < select.options.length; i++){
      if(select.options[i].text.indexOf(label.replace('Mặt bằng ', '')) !== -1 || label.indexOf('Tổng mặt bằng') !== -1){
        select.selectedIndex = i;
        matched = true;
        break;
      }
    }
  }
  if(typeof dataLayer !== 'undefined'){ dataLayer.push({event:'plan_request_click', plan_type:label}); }
  document.getElementById('nhan-tu-van').scrollIntoView({behavior:'smooth', block:'start'});
}

// Lead form submit handler
function handleLeadSubmit(e){
  e.preventDefault();
  var name = document.getElementById('fname').value;
  var phone = document.getElementById('fphone').value;
  var interest = document.getElementById('finterest').value;
  var attribution = {
    utm_source: document.getElementById('utm_source').value,
    utm_medium: document.getElementById('utm_medium').value,
    utm_campaign: document.getElementById('utm_campaign').value,
    utm_content: document.getElementById('utm_content').value,
    utm_term: document.getElementById('utm_term').value,
    fbclid: document.getElementById('fbclid').value,
    gclid: document.getElementById('gclid').value
  };
  // TODO (dev): gửi { name, phone, interest, ...attribution } tới CRM/Sheet/webhook thật tại đây
  if(typeof fbq !== 'undefined'){ fbq('track','Lead', {content_name: interest}); }
  if(typeof dataLayer !== 'undefined'){
    dataLayer.push(Object.assign({event:'lead_submit', form_name:'simona_heights_lp', interest: interest}, attribution));
  }
  alert('Cảm ơn ' + name + '! STND sẽ liên hệ số ' + phone + ' trong thời gian sớm nhất.');
  e.target.reset();
  return false;
}
