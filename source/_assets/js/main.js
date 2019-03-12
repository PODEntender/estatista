window.toggleMenu = () => document
  .querySelector('.side-menu')
  .classList
  .toggle('side-menu--visible');

if (typeof IntersectionObserver != 'undefined') {
  window.imagesObserver = new IntersectionObserver((entries, observer) => {
    entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
      const target = entry.target;
      target.setAttribute('src', target.getAttribute('data-src'));
      target.classList.remove('lazy-image');

      observer.unobserve(target);
    });
  }, {
    rootMargin: '-20px',
  });

  document.querySelectorAll('img.lazy-image').forEach((img) => window.imagesObserver.observe(img));

  const commentsSection = document.querySelector('.episode__comments');
  if (commentsSection) {
    window.commentsObserver = new IntersectionObserver((entries, observer) => {
      entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
        if (window.initDisqus) {
          window.initDisqus();
        }

        observer.unobserve(entry.target);
      });
    });

    window.commentsObserver.observe(commentsSection);
  }
} else {
  setTimeout(() => {
    document.querySelectorAll('img[data-src]').forEach((img) => img.setAttribute('src', img.getAttribute('data-src')));
  }, 400);
}
