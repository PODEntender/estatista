window.toggleMenu = () => document
  .querySelector('.side-menu')
  .classList
  .toggle('side-menu--visible');

if (typeof IntersectionObserver != 'undefined') {
  window.imagesObserver = new IntersectionObserver((entries, observer) => {
    entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
      const target = entry.target;
      target.setAttribute('src', target.getAttribute('data-src'));

      observer.unobserve(target);
    });
  }, {
    rootMargin: '-30px',
  });

  document.querySelectorAll('img[data-src]').forEach((img) => window.imagesObserver.observe(img));
} else {
  setTimeout(() => {
    document.querySelectorAll('img[data-src]').forEach((img) => img.setAttribute('src', img.getAttribute('data-src')));
  }, 300);
}
