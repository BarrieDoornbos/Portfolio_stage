function initSite() {
  startClock();
  mobileMenuToggle();
  typewriterEffect();
  mobileCarousel();
  desktopCarouselScroll();
  desktopCarouselHover();
  cards();
}

document.addEventListener('DOMContentLoaded', initSite);

function startClock() {
  const update = () => {
    const localTime = document.getElementById('local-time');
    if (!localTime) {
      return;
    }

    const now = new Date();
    const time = now.toLocaleTimeString('nl-NL', {
      hour: '2-digit',
      minute: '2-digit'
    });

    localTime.textContent = time;

    const msUntilNextMinute =
      (60 - now.getSeconds()) * 1000 - now.getMilliseconds();

    setTimeout(update, msUntilNextMinute);
  };

  update();
}

function mobileMenuToggle() {
    const menuButton = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const menuItems = document.querySelectorAll(".menu-item");
    menuButton.addEventListener("click", function() {
        menuButton.classList.toggle("change");
        mobileMenu.classList.toggle("-right-full");
        mobileMenu.classList.toggle("right-0");
    });
    menuItems.forEach(item => {
        item.addEventListener("click", function() {
            menuButton.classList.remove("change");
            mobileMenu.classList.add("-right-full");
            mobileMenu.classList.remove("right-0");
        });
    });
}

function typewriterEffect() {
  const el = document.querySelector('.typewriter');
  const texts = JSON.parse(el.dataset.texts);

  let textIndex = 0;
  let charIndex = 0;
  let deleting = false;

  const typingSpeed = 100;
  const deletingSpeed = 60;
  const pauseAfterType = 1500;
  const pauseAfterDelete = 400;

  function type() {
    const currentText = texts[textIndex];

    if (!deleting) {
      el.textContent = currentText.slice(0, charIndex);
      charIndex++;

      if (charIndex > currentText.length) {
        setTimeout(() => deleting = true, pauseAfterType);
      }

      setTimeout(type, typingSpeed);
      return;
    }

    el.textContent = currentText.slice(0, charIndex);
    charIndex--;

    if (charIndex < 0) {
      deleting = false;
      charIndex = 0;
      textIndex = (textIndex + 1) % texts.length;

      setTimeout(type, pauseAfterDelete);
      return;
    }

    setTimeout(type, deletingSpeed);
  }

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (reducedMotion) {
    el.textContent = texts[0];
  } else {
    type();
  }
}

function mobileCarousel() {
  const carousel = document.querySelector('.carousel');
  const items = document.querySelectorAll('.mobile-item');
  const texts = document.querySelectorAll('.item-info');

  function updateActiveItem() {
  const carouselRect = carousel.getBoundingClientRect();
  let closestItem = null;
  let closestDistance = Infinity;

  items.forEach(item => {
    const rect = item.getBoundingClientRect();
    const itemCenter = rect.left + rect.width / 2;
    const carouselCenter = carouselRect.left + carouselRect.width / 2;
    const distance = Math.abs(carouselCenter - itemCenter);
    const diff = itemCenter - window.innerWidth / 2;

    if (distance < closestDistance) {
    closestDistance = distance;
    closestItem = item;
    }

    if (Math.abs(diff) < rect.width / 2)
    {
        item.classList.remove('rotate-3', '-rotate-3', 'mt-10');
    } else if (diff > 0) {
        item.classList.add('rotate-3', 'mt-10');
    } else {
        item.classList.add('-rotate-3', 'mt-10');
    }
  });

  items.forEach(item => item.classList.remove('md:px-10', 'rotate-0'));
  texts.forEach(text => text.classList.replace('opacity-100', 'opacity-0'));


  if (closestItem) {
      closestItem.classList.add('md:px-10');
      const activeTexts = closestItem.querySelectorAll('.item-info');
      activeTexts.forEach(t => t.classList.replace('opacity-0', 'opacity-100'));
  }
  }

  let scrollTimeout;
  carousel.addEventListener('scroll', () => {
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(updateActiveItem);
  });

  updateActiveItem();
}

function desktopCarouselScroll() {
  const carousel = document.querySelector('[data-carousel]');
  const nextBtn  = document.querySelector('[data-carousel-next]');
  const prevBtn  = document.querySelector('[data-carousel-prev]');

  if (carousel && nextBtn && prevBtn) {
    const scrollAmount = carousel.offsetWidth * 0.2;

    nextBtn.addEventListener('click', () => {
      carousel.scrollBy({
        left: scrollAmount,
        behavior: 'smooth',
      });
    });

    prevBtn.addEventListener('click', () => {
      carousel.scrollBy({
        left: -scrollAmount,
        behavior: 'smooth',
      });
    });
  }
}

function desktopCarouselHover() {
  const desktopItem = document.querySelectorAll('.desktop-item');

  if (desktopItem && desktopItem.length) {
    desktopItem.forEach(item => {
      item.addEventListener('mouseover', () => {
        desktopInfo = item.querySelector('.item-info');
        desktopInfo.classList.remove('opacity-0');
        item.classList.replace('min-w-1/10', 'min-w-3/12')

        desktopItem.forEach((otherItem) => {
            if (otherItem !== item) {
                otherItem.classList.replace('min-w-1/10', 'min-w-1/12');
            }
        });
      })

      item.addEventListener('mouseleave', () => {
        desktopInfo = item.querySelector('.item-info');
        desktopInfo.classList.add('opacity-0');
        item.classList.replace('min-w-3/12', 'min-w-1/10')

        desktopItem.forEach((otherItem) => {
            if (otherItem !== item) {
                otherItem.classList.replace('min-w-1/12', 'min-w-1/10');
            }
        });
      })
    })
  }
}

function cards() {
  const overlay = document.getElementById('card-overlay');
  const card = document.getElementById('card');
  const slots = document.querySelectorAll('#card [data-card]');

  function openCard(type, data = {}) {
    slots.forEach(s => s.hidden = true);

    const slot = document.querySelector(`#card [data-card="${type}"]`);
    if (!slot) {
      return;
    }
    slot.hidden = false;

    if (type === 'project' && data.image && data.title) {
      document.getElementById('card-image').src = data.image;
      document.getElementById('card-title').textContent = data.title;
      document.getElementById('card-description').innerHTML = data.description;
      document.getElementById('card-link').href = data.link;
    }

    overlay.classList.remove('hidden');
    requestAnimationFrame(() => {
      card.classList.remove('translate-y-full');
    });
  }

  function closeCard() {
    card.classList.add('translate-y-full');
    setTimeout(() => {
      overlay.classList.add('hidden');
    }, 300);
  }

  document.getElementById('card-close').addEventListener('click', closeCard);

  overlay.addEventListener('click', (e) => {
    if (!card.contains(e.target)) {
      closeCard();
    }
  });

  document.querySelectorAll('[data-card="project"]').forEach(item => {
    item.addEventListener('click', () => {
      openCard('project', {
        image: item.dataset.image,
        title: item.dataset.title,
        description: item.dataset.description,
        link: item.dataset.link
      });
    });
  });

  document.querySelectorAll('[data-card="contact"]').forEach(item => {
    item.addEventListener('click', () => {
      openCard('contact');
    });
  });
}
