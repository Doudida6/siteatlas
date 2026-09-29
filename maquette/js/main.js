// Menu mobile
const toggle = document.querySelector('[data-nav-toggle]');
const menu = document.querySelector('[data-nav-menu]');
toggle?.addEventListener('click', () => {
  const open = menu.classList.toggle('is-open');
  toggle.setAttribute('aria-expanded', open);
});

// Apparition douce des blocs au scroll
const io = new IntersectionObserver((entries) => {
  entries.forEach((e) => {
    if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
  });
}, { threshold: .12 });
document.querySelectorAll('.reveal').forEach((el) => io.observe(el));

// Formulaires (maquette) : affiche le message de confirmation sans envoi réel
document.querySelectorAll('[data-form]').forEach((form) => {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    form.hidden = true;
    form.parentElement.querySelector('.form_success')?.classList.add('is-visible');
  });
});
