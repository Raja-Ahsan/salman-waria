/**
 * World in 2050 — flip preview (PDF.js 3.x + St PageFlip)
 */
(function () {
  'use strict';

  var A4_RATIO = 1.414;
  var FREE_PAGES_LIMIT = 15;

  var St = window.St;
  if (!St || !St.PageFlip) {
    console.error('St.PageFlip not loaded');
    return;
  }

  var pdfjsLib = window.pdfjsLib;
  if (!pdfjsLib) {
    console.error('pdfjsLib not found');
  }

  var pdfDocumentCache = { doc: null, key: null };

  function getOutputScale() {
    var dpr = window.devicePixelRatio || 1;
    if (dpr < 1) dpr = 1;
    if (dpr > 3) dpr = 3;
    return dpr;
  }

  function getDims() {
    var w = window.innerWidth;
    var mobile = w < 768;
    var pageW = mobile
      ? Math.min(w - 24, 450)
      : Math.min((w - 120) / 2, 550);
    pageW = Math.max(200, Math.floor(pageW));
    var pageH = Math.floor(pageW * A4_RATIO);
    return { width: pageW, height: pageH, isMobile: mobile };
  }

  function el(tag, cls) {
    var n = document.createElement(tag);
    if (cls) n.className = cls;
    return n;
  }

  function buildCoverPage(coverUrl) {
    var page = el('div', 'flip-page flip-page--cover');
    page.setAttribute('data-density', 'hard');
    var content = el('div', 'flip-page-content flip-page-content--cover');
    var inner = el('div', 'flip-cover-inner');
    var img = document.createElement('img');
    img.className = 'flip-cover-img';
    img.src = coverUrl;
    img.alt = 'World in 2050 — book cover';
    img.setAttribute('loading', 'eager');
    img.setAttribute('decoding', 'async');
    img.setAttribute('fetchpriority', 'high');
    inner.appendChild(img);
    content.appendChild(inner);
    content.appendChild(el('div', 'flip-page-shadow'));
    page.appendChild(content);
    return page;
  }

  function buildPdfPage(canvas) {
    var page = el('div', 'flip-page');
    page.setAttribute('data-density', 'soft');
    var content = el('div', 'flip-page-content flip-page-content--pdf');
    canvas.className = 'flip-pdf-canvas';
    content.appendChild(canvas);
    content.appendChild(el('div', 'flip-page-shadow'));
    page.appendChild(content);
    return page;
  }

  function buildBuyPage(amazonUrl) {
    var page = el('div', 'flip-page flip-page--buy');
    page.setAttribute('data-density', 'soft');
    var content = el('div', 'flip-page-content flip-page-content--buy');
    var inner = el('div', 'flip-buy-inner');
    var p = el('p', 'flip-buy-text');
    p.textContent =
      'Enjoyed the preview? Get the full book to continue reading.';
    var a = el('a', 'btn-primary flip-buy-btn');
    a.href = amazonUrl;
    a.target = '_blank';
    a.rel = 'noopener noreferrer';
    a.textContent = 'Buy on Amazon';
    inner.appendChild(p);
    inner.appendChild(a);
    content.appendChild(inner);
    content.appendChild(el('div', 'flip-page-shadow'));
    page.appendChild(content);
    return page;
  }

  var state = {
    pageFlip: null,
    lastAllowed: 0,
    mount: null,
    cfg: { pdf: null, cover: null, amazon: null },
  };

  function ensureCfgFromDom() {
    var el = document.getElementById('stf-book');
    if (el) {
      state.cfg.pdf = el.getAttribute('data-pdf');
      state.cfg.cover = el.getAttribute('data-cover');
      state.cfg.amazon = el.getAttribute('data-amazon') || '#';
    }
  }

  function readOrRestoreMount() {
    var shell = document.getElementById('book-flip-shell');
    var el = document.getElementById('stf-book');
    if (el) return el;
    if (!shell || !state.cfg.pdf) return null;
    el = document.createElement('div');
    el.id = 'stf-book';
    el.className = 'book-flip-mount';
    el.setAttribute('role', 'region');
    el.setAttribute('aria-label', 'Interactive book preview');
    el.setAttribute('data-pdf', state.cfg.pdf);
    el.setAttribute('data-cover', state.cfg.cover);
    el.setAttribute('data-amazon', state.cfg.amazon);
    shell.appendChild(el);
    return el;
  }

  function setNavState() {
    var pf = state.pageFlip;
    var prev = document.getElementById('book-flip-prev');
    var next = document.getElementById('book-flip-next');
    var counter = document.getElementById('book-flip-counter');
    if (!pf || !prev || !next) return;
    var cur = pf.getCurrentPageIndex();
    var total = pf.getPageCount();
    prev.disabled = cur <= 0;
    next.disabled = cur >= state.lastAllowed;
    if (counter) {
      counter.hidden = false;
      counter.textContent = 'Page ' + (cur + 1) + ' / ' + total;
    }
  }

  function destroyFlip() {
    if (state.pageFlip) {
      try {
        state.pageFlip.destroy();
      } catch (e) {}
      state.pageFlip = null;
    }
  }

  async function run() {
    ensureCfgFromDom();
    destroyFlip();
    state.mount = readOrRestoreMount();
    if (!state.mount) return;

    var pdfUrl = state.mount.getAttribute('data-pdf');
    var coverUrl = state.mount.getAttribute('data-cover');
    var amazonUrl = state.mount.getAttribute('data-amazon') || '#';
    var loader = document.getElementById('book-flip-loader');
    var errEl = document.getElementById('book-flip-error');
    var nav = document.getElementById('book-flip-nav');

    if (!pdfjsLib) {
      if (errEl) {
        errEl.hidden = false;
        errEl.textContent = 'PDF engine not loaded. Check your network or script tags.';
      }
      if (loader) loader.hidden = true;
      return;
    }

    pdfjsLib.GlobalWorkerOptions.workerSrc =
      'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    if (errEl) {
      errEl.hidden = true;
      errEl.textContent = '';
    }
    if (loader) {
      loader.hidden = false;
      loader.textContent = 'Opening book…';
    }
    if (nav) nav.hidden = true;

    var dims = getDims();
    var w = dims.width;
    var h = dims.height;

    var pdf;
    try {
      if (!pdfDocumentCache.doc || pdfDocumentCache.key !== pdfUrl) {
        var task = pdfjsLib.getDocument({ url: pdfUrl });
        pdfDocumentCache.doc = await task.promise;
        pdfDocumentCache.key = pdfUrl;
      }
      pdf = pdfDocumentCache.doc;
    } catch (e) {
      pdfDocumentCache.doc = null;
      pdfDocumentCache.key = null;
      if (loader) loader.hidden = true;
      if (errEl) {
        errEl.hidden = false;
        errEl.textContent =
          'Could not open the PDF. Add assests/book.pdf to this project and reload.';
      }
      return;
    }

    var freeCount = Math.min(pdf.numPages, FREE_PAGES_LIMIT);
    var pageNodes = [];

    pageNodes.push(buildCoverPage(coverUrl));

    var dpr = getOutputScale();

    for (var p = 1; p <= freeCount; p++) {
      var pdfPage = await pdf.getPage(p);
      var base = pdfPage.getViewport({ scale: 1 });
      var fitScale = Math.min(w / base.width, h / base.height) * 0.96;
      var vpDisplay = pdfPage.getViewport({ scale: fitScale });
      var vpRender = pdfPage.getViewport({ scale: fitScale * dpr });
      var canvas = document.createElement('canvas');
      var ctx = canvas.getContext('2d', { alpha: false });
      if (ctx) {
        if ('imageSmoothingEnabled' in ctx) ctx.imageSmoothingEnabled = true;
        if ('imageSmoothingQuality' in ctx) ctx.imageSmoothingQuality = 'high';
      }
      canvas.width = Math.max(1, Math.floor(vpRender.width));
      canvas.height = Math.max(1, Math.floor(vpRender.height));
      canvas.style.width = Math.floor(vpDisplay.width) + 'px';
      canvas.style.height = Math.floor(vpDisplay.height) + 'px';
      await pdfPage
        .render({ canvasContext: ctx, viewport: vpRender })
        .promise;
      pageNodes.push(buildPdfPage(canvas));
    }

    pageNodes.push(buildBuyPage(amazonUrl));

    var totalPages = pageNodes.length;
    state.lastAllowed = totalPages - 1;

    var pf = new St.PageFlip(state.mount, {
      width: w,
      height: h,
      minWidth: 200,
      maxWidth: 800,
      minHeight: 280,
      maxHeight: 1130,
      size: 'fixed',
      startPage: 0,
      drawShadow: false,
      flippingTime: dims.isMobile ? 600 : 800,
      usePortrait: dims.isMobile,
      startZIndex: 0,
      maxShadowOpacity: 0,
      showCover: true,
      autoSize: true,
      mobileScrollSupport: true,
      clickEventForward: true,
      useMouseEvents: true,
      swipeDistance: dims.isMobile ? 15 : 30,
      showPageCorners: !dims.isMobile,
      disableFlipByClick: false,
    });

    pf.loadFromHTML(pageNodes);
    state.pageFlip = pf;

    pf.on('init', function () {
      if (loader) loader.hidden = true;
      if (nav) nav.hidden = false;
      setNavState();
    });

    pf.on('flip', function (e) {
      if (e.data > state.lastAllowed) {
        pf.turnToPage(state.lastAllowed);
        return;
      }
      setNavState();
    });

    var prevBtn = document.getElementById('book-flip-prev');
    var nextBtn = document.getElementById('book-flip-next');
    if (prevBtn) {
      prevBtn.onclick = function () {
        if (state.pageFlip) state.pageFlip.flipPrev('top');
      };
    }
    if (nextBtn) {
      nextBtn.onclick = function () {
        if (!state.pageFlip) return;
        var cur = state.pageFlip.getCurrentPageIndex();
        if (cur < state.lastAllowed) state.pageFlip.flipNext('top');
      };
    }

    setNavState();
  }

  var resizeT;
  function schedule() {
    clearTimeout(resizeT);
    resizeT = setTimeout(function () {
      run();
    }, 250);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', run);
  } else {
    run();
  }

  window.addEventListener('resize', schedule);
})();
