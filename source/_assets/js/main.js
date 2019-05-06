import share from './functions/share';

window.share = share;

window.toggleMenu = () => document
  .querySelector('.side-menu')
  .classList
  .toggle('side-menu--visible');

const loadImage = (img) => img.setAttribute('src', img.getAttribute('data-src'));
const removeClass = (className) => (elm) => elm.classList.remove(className);

if (typeof window.IntersectionObserver == 'undefined') {
  window.initDisqus && window.initDisqus();

  setTimeout(() => {
    const images = document.querySelectorAll('img.lazy-image');
    images.forEach(loadImage);
    images.forEach(removeClass('lazy-image'));
  }, 300);
}

if (typeof window.IntersectionObserver != 'undefined') {
  window.imagesObserver = new window.IntersectionObserver((entries, observer) => {
    entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
      const target = entry.target;
      loadImage(target);
      removeClass('lazy-image')(target);

      observer.unobserve(target);
    });
  }, {
    rootMargin: '-20px',
  });

  document.querySelectorAll('img.lazy-image').forEach((img) => window.imagesObserver.observe(img));

  const commentsSection = document.querySelector('.episode__comments');
  if (commentsSection) {
    window.commentsObserver = new window.IntersectionObserver((entries, observer) => {
      entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
        window.initDisqus && window.initDisqus();

        observer.unobserve(entry.target);
      });
    });

    window.commentsObserver.observe(commentsSection);
  }
}
