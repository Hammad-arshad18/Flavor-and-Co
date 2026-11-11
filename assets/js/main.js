(function () {
    "use strict";

    document.documentElement.classList.add("js");

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    /* ---------- Header state ---------- */

    var header = document.querySelector("[data-header]");

    function updateHeader() {
        if (!header) return;
        header.classList.toggle("is-scrolled", window.scrollY > 24);
    }

    updateHeader();
    window.addEventListener("scroll", updateHeader, { passive: true });

    /* ---------- Mobile navigation ---------- */

    var toggle = document.querySelector("[data-nav-toggle]");
    var panel = document.getElementById("mobile-nav");
    var lastFocused = null;

    function navLabel(key, fallback) {
        var api = window.flavourI18n;
        if (api && api.lang() === "ar") return api.t(key) || fallback;
        return fallback;
    }

    function trapFocus(event) {
        if (event.key !== "Tab" || !header) return;

        var focusable = header.querySelectorAll(
            'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        var visible = Array.prototype.filter.call(focusable, function (node) {
            return node.offsetParent !== null;
        });
        if (!visible.length) return;

        var first = visible[0];
        var last = visible[visible.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    }

    function openNav() {
        if (!panel || !toggle) return;
        lastFocused = document.activeElement;
        panel.hidden = false;
        toggle.setAttribute("aria-expanded", "true");
        toggle.setAttribute("aria-label", navLabel("nav.close", "Close menu"));
        document.body.classList.add("nav-open");
        var firstLink = panel.querySelector("a");
        if (firstLink) firstLink.focus();
        document.addEventListener("keydown", onKeydown);
    }

    function closeNav(restoreFocus) {
        if (!panel || !toggle) return;
        panel.hidden = true;
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", navLabel("nav.open", "Open menu"));
        document.body.classList.remove("nav-open");
        document.removeEventListener("keydown", onKeydown);
        if (restoreFocus !== false && lastFocused) lastFocused.focus();
        updateHeader();
    }

    function onKeydown(event) {
        if (event.key === "Escape") {
            closeNav(true);
            return;
        }
        trapFocus(event);
    }

    if (toggle && panel) {
        toggle.addEventListener("click", function () {
            if (toggle.getAttribute("aria-expanded") === "true") {
                closeNav(true);
            } else {
                openNav();
            }
        });

        panel.addEventListener("click", function (event) {
            if (event.target.closest("a")) closeNav(false);
        });

        window.addEventListener("resize", function () {
            if (window.innerWidth > 1020 && toggle.getAttribute("aria-expanded") === "true") {
                closeNav(false);
            }
        });
    }

    /* ---------- Reveal on scroll ---------- */

    var revealItems = document.querySelectorAll("[data-reveal]");

    document.querySelectorAll("[data-reveal-delay]").forEach(function (el) {
        el.style.setProperty("--reveal-delay", el.getAttribute("data-reveal-delay") + "ms");
    });

    if (reduceMotion || !("IntersectionObserver" in window)) {
        revealItems.forEach(function (el) {
            el.classList.add("is-visible");
        });
    } else {
        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("is-visible");
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: "0px 0px -6% 0px" }
        );

        revealItems.forEach(function (el) {
            observer.observe(el);
        });
    }
})();
