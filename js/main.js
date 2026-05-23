document.addEventListener('DOMContentLoaded', function() {
    // Navbar Background on Scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Fade In Animation on Scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const suffix = element.textContent.includes('+') ? '+' : element.textContent.includes('%') ? '%' : '';
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + suffix;
        }, 20);
    }

    // Trigger counter animation when visible
    const counters = document.querySelectorAll('.counter-number');
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                entry.target.classList.add('counted');
                animateCounter(entry.target);
            }
        });
    }, observerOptions);

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('videoCarousel');
    const wrapper = carousel.parentElement;
    const prevBtn = document.getElementById('videoPrev');
    const nextBtn = document.getElementById('videoNext');
    const dotsContainer = document.getElementById('carouselDots');

    const cards = carousel.querySelectorAll('.video-carousel-card');
    const totalCards = cards.length;

    /* ===== Helpers ===== */
    function getVisibleCards() {
        const w = window.innerWidth;
        if (w >= 1200) return 4;
        if (w >= 992) return 3;
        if (w >= 576) return 2;
        return 1;
    }

    function getScrollAmount() {
        const card = carousel.querySelector('.video-carousel-card');
        if (!card) return 280;
        const style = window.getComputedStyle(card);
        const gap = parseFloat(style.marginRight) || 24;
        return card.offsetWidth + gap;
    }

    /* ===== Dots ===== */
    function createDots() {
        dotsContainer.innerHTML = '';
        const pages = Math.ceil(totalCards / getVisibleCards());

        for (let i = 0; i < pages; i++) {
            const dot = document.createElement('span');
            dot.className = 'carousel-dot';
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => scrollToPage(i));
            dotsContainer.appendChild(dot);
        }
    }

    function scrollToPage(page) {
        wrapper.scrollTo({
            left: getScrollAmount() * getVisibleCards() * page,
            behavior: 'smooth'
        });
    }

    function updateActiveDot() {
        const pageWidth = getScrollAmount() * getVisibleCards();
        const currentPage = Math.round(wrapper.scrollLeft / pageWidth);
        dotsContainer.querySelectorAll('.carousel-dot').forEach((dot, i) => {
            dot.classList.toggle('active', i === currentPage);
        });
    }

    /* ===== Buttons ===== */
    prevBtn.addEventListener('click', () => {
        wrapper.scrollBy({
            left: -getScrollAmount() * getVisibleCards(),
            behavior: 'smooth'
        });
    });

    nextBtn.addEventListener('click', () => {
        wrapper.scrollBy({
            left: getScrollAmount() * getVisibleCards(),
            behavior: 'smooth'
        });
    });

    function updateButtons() {
        prevBtn.disabled = wrapper.scrollLeft <= 5;
        nextBtn.disabled =
            wrapper.scrollLeft >= wrapper.scrollWidth - wrapper.clientWidth - 5;
        updateActiveDot();
    }

    wrapper.addEventListener('scroll', updateButtons);

    /* ===== Auto Scroll ===== */
    let autoScrollInterval;
    const AUTO_SCROLL_DELAY = 3500;

    function startAutoScroll() {
        stopAutoScroll();
        autoScrollInterval = setInterval(() => {
            if (
                wrapper.scrollLeft >=
                wrapper.scrollWidth - wrapper.clientWidth - 10
            ) {
                wrapper.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                wrapper.scrollBy({
                    left: getScrollAmount() * getVisibleCards(),
                    behavior: 'smooth'
                });
            }
        }, AUTO_SCROLL_DELAY);
    }

    function stopAutoScroll() {
        if (autoScrollInterval) clearInterval(autoScrollInterval);
    }

    wrapper.addEventListener('mouseenter', stopAutoScroll);
    wrapper.addEventListener('mouseleave', startAutoScroll);

    /* ===== Resize ===== */
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            createDots();
            updateButtons();
        }, 200);
    });

    /* ===== Init ===== */
    createDots();
    updateButtons();
    startAutoScroll();
});
// =============navbar============//
    window.addEventListener("scroll", function() {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 30) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
    // ============testimonial slider============//
         document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".testiSwiper", {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        });
        // ============ back to top button ============//
         const backToTop = document.getElementById("backToTop");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 350) {
      backToTop.classList.add("show");
    } else {
      backToTop.classList.remove("show");
    }
  });

  backToTop.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });

//   ==============faqs================//
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach(item => {
      const question = item.querySelector(".faq-question");

      question.addEventListener("click", () => {
        const openItem = document.querySelector(".faq-item.active");

        if (openItem && openItem !== item) {
          openItem.classList.remove("active");
        }

        item.classList.toggle("active");
      });
    });