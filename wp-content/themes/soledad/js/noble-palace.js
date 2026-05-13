// Scroll fade-in
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.card, .policy-card, .mini-card, .timeline-item, .trust-item').forEach(el => {
  el.classList.add('fade-in');
  observer.observe(el);
});

// Sticky header shadow
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
