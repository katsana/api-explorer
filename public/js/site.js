(function () {
  'use strict';

  function onReady(fn) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', fn);
      return;
    }
    fn();
  }

  onReady(function () {
    var scrollUp = document.getElementById('scroll-up');
    if (scrollUp) {
      scrollUp.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    // Offcanvas toggle (mobile sidebar).
    var offcanvasBtn = document.querySelector('[data-toggle="offcanvas"]');
    if (offcanvasBtn) {
      offcanvasBtn.addEventListener('click', function () {
        document.body.classList.toggle('open-sidebar');
        document.documentElement.style.overflow =
          document.body.classList.contains('open-sidebar') ? 'hidden' : 'visible';
      });
    }

    // Sidebar dropdown.
    var sidenav = document.querySelector('.sidenav.dropable');
    if (sidenav) {
      sidenav.querySelectorAll(':scope > li > ul').forEach(function (ul) {
        var a = ul.previousElementSibling;
        if (a && a.tagName === 'A') {
          a.classList.add('has-child');
        }
      });

      // Auto-open section that matches current URL/path/hash.
      var currentUrl = new URL(window.location.href);
      var currentPath = currentUrl.pathname.replace(/\/+$/, '');
      var currentHash = currentUrl.hash || '';
      var bestMatch = null;

      sidenav.querySelectorAll(':scope > li > a').forEach(function (topLink) {
        var submenu = topLink.nextElementSibling;
        if (!submenu || submenu.tagName !== 'UL') {
          return;
        }

        var topMatch = false;
        var topHref = topLink.getAttribute('href');
        if (topHref) {
          try {
            var topUrl = new URL(topHref, window.location.href);
            topMatch = topUrl.pathname.replace(/\/+$/, '') === currentPath;
          } catch (_err) {}
        }

        var childMatch = null;
        submenu.querySelectorAll('a').forEach(function (childLink) {
          var href = childLink.getAttribute('href');
          if (!href) {
            return;
          }

          try {
            var linkUrl = new URL(href, window.location.href);
            var samePath = linkUrl.pathname.replace(/\/+$/, '') === currentPath;
            if (!samePath) {
              return;
            }

            if (currentHash && linkUrl.hash === currentHash) {
              childMatch = childLink;
            } else if (!childMatch && !currentHash && !linkUrl.hash) {
              childMatch = childLink;
            }
          } catch (_err) {}
        });

        if (childMatch || topMatch) {
          bestMatch = { topLink: topLink, submenu: submenu, childLink: childMatch };
        }
      });

      if (bestMatch) {
        bestMatch.topLink.classList.add('open');
        bestMatch.submenu.style.display = 'block';
        if (bestMatch.childLink) {
          bestMatch.childLink.classList.add('active');
        }
      }

      sidenav.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link || !sidenav.contains(link)) {
          return;
        }

        var parentLi = link.parentElement;
        if (!parentLi || parentLi.parentElement !== sidenav) {
          return;
        }

        var submenu = link.nextElementSibling;
        if (!submenu || submenu.tagName !== 'UL') {
          return;
        }

        var href = link.getAttribute('href');
        var isSamePage = false;
        if (href) {
          try {
            var targetUrl = new URL(href, window.location.href);
            var currentUrl = new URL(window.location.href);
            isSamePage =
              targetUrl.origin === currentUrl.origin &&
              targetUrl.pathname.replace(/\/+$/, '') === currentUrl.pathname.replace(/\/+$/, '') &&
              (!targetUrl.hash || targetUrl.hash === currentUrl.hash);
          } catch (_err) {}
        }

        // Navigate to section page when it's a different page.
        if (!isSamePage) {
          return;
        }

        e.preventDefault();

        var isOpen = link.classList.contains('open');
        sidenav.querySelectorAll(':scope > li > a.open').forEach(function (a) {
          a.classList.remove('open');
        });
        sidenav.querySelectorAll(':scope > li > ul').forEach(function (ul) {
          ul.style.display = 'none';
        });

        if (!isOpen) {
          link.classList.add('open');
          submenu.style.display = 'block';
        }
      });
    }

    var headerOffset = 110;

    function scrollToHash(hash, smooth) {
      if (!hash) {
        return false;
      }

      var target = document.querySelector(hash);
      if (!target) {
        return false;
      }

      var top = Math.max(0, target.getBoundingClientRect().top + window.scrollY - headerOffset);
      window.scrollTo({ top: top, behavior: smooth ? 'smooth' : 'auto' });
      return true;
    }

    // Give native hash jumps enough top space under fixed header.
    document.querySelectorAll('[id]').forEach(function (el) {
      el.style.scrollMarginTop = headerOffset + 'px';
    });

    // Smooth scroll for in-page and same-page hash links.
    document.querySelectorAll('.toc a, .sidenav.nav a').forEach(function (link) {
      link.addEventListener('click', function (e) {
        var href = link.getAttribute('href');
        if (!href || href.indexOf('#') === -1) {
          return;
        }

        var url;
        try {
          url = new URL(href, window.location.href);
        } catch (_err) {
          return;
        }

        if (url.origin !== window.location.origin || url.pathname !== window.location.pathname) {
          return;
        }

        if (!url.hash) {
          return;
        }

        if (scrollToHash(url.hash, true)) {
          e.preventDefault();
          if (window.location.hash !== url.hash) {
            history.pushState(null, '', url.hash);
          }
        }
      });
    });

    // Fix initial page load with hash (e.g. /v1/vehicles#single-vehicle).
    if (window.location.hash) {
      setTimeout(function () {
        scrollToHash(window.location.hash, false);
      }, 0);
    }

    // Sticky sidebar behavior.
    var stickySidenav = document.querySelector('.sidenav.sticky');
    var sidebar = document.querySelector('.sidebar');
    if (stickySidenav && sidebar) {
      var initialWidth = stickySidenav.getBoundingClientRect().width;
      var stickyTop = 0;
      var sidebarTop = sidebar.getBoundingClientRect().top + window.scrollY;
      var stickyGap = 20;
      var stickyStartY = sidebarTop;

      var recalculateStickyMetrics = function () {
        var wasFixed = stickySidenav.style.position === 'fixed';
        if (wasFixed) {
          stickySidenav.style.position = 'static';
          stickySidenav.style.top = '';
          stickySidenav.style.width = '';
        }

        initialWidth = stickySidenav.getBoundingClientRect().width;
        var initialTop = Math.max(0, Math.round(stickySidenav.getBoundingClientRect().top));
        var header = document.querySelector('.site-header');
        if (header) {
          var minTop = Math.max(0, Math.round(header.getBoundingClientRect().height + stickyGap));
          stickyTop = Math.max(minTop, initialTop);
        } else {
          stickyTop = Math.max(stickyGap, initialTop);
        }
        sidebarTop = sidebar.getBoundingClientRect().top + window.scrollY;
        stickyStartY = Math.max(0, sidebarTop - stickyTop);
      };

      var applySticky = function () {
        if (window.innerWidth < 768) {
          stickySidenav.style.position = 'static';
          stickySidenav.style.top = '';
          stickySidenav.style.width = '';
          return;
        }

        if (window.scrollY > stickyStartY) {
          stickySidenav.style.position = 'fixed';
          stickySidenav.style.top = stickyTop + 'px';
          stickySidenav.style.width = initialWidth + 'px';
        } else {
          stickySidenav.style.position = 'static';
          stickySidenav.style.top = '';
          stickySidenav.style.width = '';
        }
      };

      window.addEventListener('scroll', applySticky, { passive: true });
      window.addEventListener('resize', function () {
        recalculateStickyMetrics();
        applySticky();
      });
      recalculateStickyMetrics();
      applySticky();
    }
  });
})();
