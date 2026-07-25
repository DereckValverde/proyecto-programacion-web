document.addEventListener('DOMContentLoaded', function () {

    /* Navegación suave y scroll spy */
    const navLinks = document.querySelectorAll('.navbar .nav-link');
    const sections = document.querySelectorAll('section[id]');
    const navbar = document.getElementById('mainNavbar');

    navLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            if (targetSection) {

                targetSection.scrollIntoView({ behavior: 'smooth' });

                const navbarCollapse = document.getElementById('navbarNav');
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {

                navLinks.forEach(function (link) {
                    link.classList.remove('active');
                });

                const activeLink = document.querySelector(
                    '.navbar .nav-link[data-section="' + entry.target.id + '"]'
                );
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });
    }, {

        threshold: 0.3
    });

    sections.forEach(function (section) {
        observer.observe(section);
    });

    window.addEventListener('scroll', function () {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    const yearSpan = document.getElementById('year');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }

    /* US-04: Contadores animados con Intersection Observer + setInterval */
    function animateCounter(element, target, duration) {
        var start = 0;
        var startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = Math.floor(eased * target);
            element.textContent = current.toLocaleString('es-CR');
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                element.textContent = target.toLocaleString('es-CR');
            }
        }

        requestAnimationFrame(step);
    }

    var countersSection = document.getElementById('impacto');
    var countersAnimated = false;

    if (countersSection) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !countersAnimated) {
                    countersAnimated = true;
                    var counterNumbers = countersSection.querySelectorAll('.counter-number');
                    counterNumbers.forEach(function (counter) {
                        var target = parseInt(counter.getAttribute('data-target'), 10);
                        animateCounter(counter, target, 2000);
                    });
                }
            });
        }, {
            threshold: 0.4
        });

        counterObserver.observe(countersSection);
    }

});
