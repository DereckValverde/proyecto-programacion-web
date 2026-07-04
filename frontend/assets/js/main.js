document.addEventListener('DOMContentLoaded', function () {

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

});
