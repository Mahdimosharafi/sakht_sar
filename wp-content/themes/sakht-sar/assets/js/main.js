document.addEventListener('DOMContentLoaded', () => {
  const hero = document.querySelector('.hero');

  // Subtle desktop parallax — disabled for touch devices and reduced-motion users.
  if (hero && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const move = (event) => {
      if (window.innerWidth < 900 || window.matchMedia('(pointer: coarse)').matches) return;
      const x = (event.clientX / window.innerWidth - 0.5) * 7;
      const y = (event.clientY / window.innerHeight - 0.5) * 3.5;
      hero.style.backgroundPosition = `calc(50% + ${x}px) calc(50% + ${y}px)`;
    };
    window.addEventListener('mousemove', move, { passive: true });
  }

  // Search keeps the experience friendly instead of submitting an empty query.
  document.querySelectorAll('.hero-search').forEach((form) => {
    form.addEventListener('submit', (event) => {
      const input = form.querySelector('input[name="s"]');
      if (input && !input.value.trim()) {
        event.preventDefault();
        input.focus();
      }
    });
  });

  // Smooth horizontal place carousel.
  document.querySelectorAll('.carousel-btn').forEach((button) => {
    button.addEventListener('click', () => {
      const grid = button.closest('.places-wrap')?.querySelector('.places-grid');
      if (!grid) return;
      const direction = button.classList.contains('left') ? -1 : 1;
      grid.scrollBy({ left: direction * 310, behavior: 'smooth' });
    });
  });

  // Lightweight reveal motion without an animation library.
  if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const style = document.createElement('style');
    style.textContent = '.ss-reveal{opacity:0;transform:translateY(14px);transition:opacity .55s ease,transform .55s ease}.ss-reveal-visible{opacity:1;transform:none}';
    document.head.appendChild(style);
    const revealItems = document.querySelectorAll('.service-card, .place-card, .trip-card, .panel, .video-banner');
    revealItems.forEach((item) => item.classList.add('ss-reveal'));
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('ss-reveal-visible');
        obs.unobserve(entry.target);
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -30px' });
    revealItems.forEach((item) => observer.observe(item));
  }
});
