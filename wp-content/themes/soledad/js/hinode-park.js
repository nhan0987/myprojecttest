/*
    Hinode Park Landing Page JS
    Extracted from the-flame-vine-landing.html
*/

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
function scrollTo(id) {
  const el = document.querySelector(id);
  if (el) el.scrollIntoView({behavior:'smooth'});
}

// Nav highlight on scroll
const sections = {
  '#du-an': document.getElementById('du-an'), 
  '#vi-tri': document.getElementById('vi-tri'), 
  '#chinh-sach': document.getElementById('chinh-sach'), 
  '#mat-bang': document.getElementById('mat-bang'), 
  '#tien-ich': document.getElementById('tien-ich'), 
  '#faq': document.getElementById('faq')
};
