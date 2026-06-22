<meta name="google-site-verification" content="MJT4gBxcLeTzhaKPpQm-4yphgWGBiS_IS_vwJNjtzzA" />
<base href="/" />
<link rel="icon" type="image/x-icon" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/img/caaft-icon.webp'), ENT_QUOTES, 'UTF-8'); ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<?php
$styleVersion = caaft_asset_version('assets/css/style.css');
$features = caaft_page_features();
$fontDisplay = $features['home'] ? 'optional' : 'swap';
$fontCss = 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Roboto:wght@400;500;700&display=' . $fontDisplay;
if ($features['home']) {
    echo '<link rel="preload" as="image" href="' . htmlspecialchars(caaft_public_asset_url('assets/img/support-slider-banner-mobile.webp'), ENT_QUOTES, 'UTF-8') . '" fetchpriority="high" media="(max-width: 767px)">' . "\n";
    echo '<link rel="preload" as="image" href="' . htmlspecialchars(caaft_public_asset_url('assets/img/support-slider-banner.webp'), ENT_QUOTES, 'UTF-8') . '" fetchpriority="high" media="(min-width: 768px)">' . "\n";
}
?>

<link rel="stylesheet" href="<?php echo htmlspecialchars($fontCss, ENT_QUOTES, 'UTF-8'); ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?php echo htmlspecialchars($fontCss, ENT_QUOTES, 'UTF-8'); ?>"></noscript>

<link rel="stylesheet" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/css/critical-shell.css'), ENT_QUOTES, 'UTF-8'); ?>">
<link rel="stylesheet" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/css/bootstrap.min.css'), ENT_QUOTES, 'UTF-8'); ?>">
<link rel="stylesheet" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/css/all-fontawesome.min.css'), ENT_QUOTES, 'UTF-8'); ?>">
<?php if ($features['home']) : ?>
<link rel="stylesheet" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/css/home-critical.css'), ENT_QUOTES, 'UTF-8'); ?>">
<link rel="stylesheet" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/css/style.css'), ENT_QUOTES, 'UTF-8'); ?>">
<?php else : ?>
<link rel="stylesheet" href="<?php echo htmlspecialchars(caaft_public_asset_url('assets/css/style.css'), ENT_QUOTES, 'UTF-8'); ?>">
<?php endif; ?>

<?php
if ($features['carousel']) {
    caaft_defer_stylesheet(caaft_public_asset_url('assets/css/owl.carousel.min.css'));
    caaft_defer_stylesheet(caaft_public_asset_url('assets/css/animate.min.css'));
    caaft_defer_stylesheet(caaft_public_asset_url('assets/css/animation.min.css'));
}
caaft_defer_stylesheet(caaft_public_asset_url('assets/css/aos.css'));
if ($features['gallery']) {
    caaft_defer_stylesheet(caaft_public_asset_url('assets/css/magnific-popup.min.css'));
}
caaft_defer_stylesheet(caaft_public_asset_url('assets/css/nice-select.min.css'));
if ($features['tabs']) {
    caaft_defer_stylesheet(caaft_public_asset_url('assets/css/easy-responsive-tabs.css'));
}
?>

<style>
/* Reserve logo space without distorting aspect ratio (source logos are ~1510×1333) */
.navbar-brand img,
.navbar-brand img.img-fluid {
  width: auto !important;
  max-width: 150px;
  height: auto !important;
  max-height: 120px;
  object-fit: contain;
}
.navbar.fixed-top .navbar-brand.fixed_logo img {
  max-width: 160px;
  max-height: 50px;
}
.hero-img img { width: 100%; height: auto; aspect-ratio: 600 / 500; object-fit: contain; }
<?php if ($features['home']) : ?>
/* Owl hides .owl-carousel until .owl-loaded; show first slide until JS runs */
.home-3 .hero-slider.owl-carousel:not(.owl-loaded) {
  display: block !important;
}
.home-3 .hero-slider.owl-carousel:not(.owl-loaded) > .hero-single {
  display: none;
}
.home-3 .hero-slider.owl-carousel:not(.owl-loaded) > .hero-single:first-child,
.home-3 .hero-slider.hero-slider-fallback > .hero-single:first-child {
  display: flex !important;
}
.home-3 .hero-slider .hero-img-wrap.wow {
  visibility: visible !important;
}
/* Pull hero under header (style.css default -6rem); margin-top:0 left a white body gap */
.home-3 .main {
  margin-top: 0;
  padding-top: 0;
}
@media (min-width: 992px) {
  .home-3 .hero-slider.hs-3 {
    margin-top: -6rem;
    padding-top: 0;
    background-color: #0a1020;
  }
}
<?php endif; ?>
body.navbar-is-sticky {
  padding-top: 0;
}

form.contact .caaft-field-error {
  color: #dc3545;
  font-size: 0.875rem;
  line-height: 1.4;
  margin: 0.35rem 0 0.75rem;
}
form.contact .form-control.is-invalid,
form.contact .form-select.is-invalid {
  border-color: #dc3545;
}
form.contact .g-recaptcha.caaft-is-invalid {
  outline: 2px solid #dc3545;
  outline-offset: 2px;
}

/* hs-3 in style.css uses margin-top:-6rem — OK for home carousel only */
.hero-section.hs-3.caaft-ar-hero,
.hs-3.caaft-ar-hero:not(.hero-slider) {
  margin-top: 0 !important;
}

/* Service pages: white navbar (overrides global .navbar #101010 and home-3 dark) */
.page-accounting-reporting .main-navigation .navbar.navbar-expand-lg {
  background: #fff !important;
}

/* Inner pages (.header-sections): white nav — dark logo (#submenu), not white caaft-logo-header.webp */
.header-sections .navbar a#manimaenu,
.header-sections .navbar a#manimaenu.hides {
  display: none !important;
}
.header-sections .navbar a#manimaenu img,
.header-sections .navbar a#manimaenu.hides img.img-fluid {
  display: none !important;
}
.header-sections .navbar a#submenu {
  display: block !important;
}
.header-sections .navbar a#submenu img.img-fluid {
  display: block !important;
}
.header-sections .navbar.fixed-top a#submenu {
  display: none !important;
}
.header-sections .navbar.fixed-top a.navbar-brand.fixed_logo {
  display: block !important;
}

/* Homepage: compact horizontal logo (same as inner pages) — not the tall white header mark */
body.home-3:not(:has(.header-sections)) .navbar a#manimaenu,
body.home-3:not(:has(.header-sections)) .navbar a.navbar-brand.static-logo,
body.home-3:not(:has(.header-sections)) .navbar a#submenu {
  display: none !important;
}

body.home-3:not(:has(.header-sections)) .navbar a.navbar-brand.fixed_logo,
body.home-3:not(:has(.header-sections)) .navbar.fixed-top a.navbar-brand.fixed_logo {
  display: block !important;
}

body.home-3:not(:has(.header-sections)) .navbar a.navbar-brand.fixed_logo img {
  max-width: 148px;
  max-height: 48px;
  width: auto !important;
  height: auto !important;
  object-fit: contain;
}

@media (min-width: 992px) {
  /* Restore original service hero spacing (not clamp 16vw which grows too large) */
  .page-accounting-reporting .caaft-ar-hero-single.hero-single.singles_forms_frames {
    padding-top: 120px !important;
    padding-bottom: 80px !important;
  }

  .page-accounting-reporting .navbar .nav-item .nav-link,
  .page-accounting-reporting .navbar .nav-item .nav-link.active,
  .page-accounting-reporting .nav-right .search-btn .nav-right-link,
  .page-accounting-reporting .mobile-menu-right .nav-right-link,
  .page-accounting-reporting .navbar-toggler-mobile-icon {
    color: var(--color-dark) !important;
  }

  .page-accounting-reporting .navbar .nav-item .nav-link:hover {
    color: var(--theme-color) !important;
  }
}

@media (max-width: 991.98px) {
  .main-navigation {
    min-height: 0;
  }

  body.home-3,
  body.navbar-is-sticky {
    padding-top: 0 !important;
  }

  /* Fixed navbar — all mobile pages */
  body.home-3 .main-navigation .navbar.navbar-expand-lg.fixed-top {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1030;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
  }

  body.home-3:not(:has(.header-sections)) .main-navigation .navbar.navbar-expand-lg {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1030;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    background: #101010 !important;
  }

  body.home-3:has(.header-sections) .main-navigation .navbar.navbar-expand-lg {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1030;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
  }

  /* Homepage only: hide top contact strip; content starts under fixed nav */
  body.home-3:not(:has(.header-sections)) .header-top {
    display: none;
  }

  body.home-3:not(:has(.header-sections)) .header {
    min-height: 0;
  }

  body.home-3:not(:has(.header-sections)) main.main {
    padding-top: var(--caaft-navbar-height, 72px);
  }

  /* Homepage mobile: dark nav + compact logo + visible menu icon */
  body.home-3:not(:has(.header-sections)) .main-navigation .navbar.navbar-expand-lg,
  body.home-3:not(:has(.header-sections)) .main-navigation .navbar.navbar-expand-lg.fixed-top {
    background: #101010 !important;
  }

  body.home-3:not(:has(.header-sections)) .navbar-toggler-mobile-icon,
  body.home-3:not(:has(.header-sections)) .navbar.fixed-top .navbar-toggler-mobile-icon {
    color: #33b6ff !important;
  }

  /* Inner pages: contact strip flush under fixed nav — no empty shell */
  body.home-3:has(.header-sections) .header-top {
    margin-top: var(--caaft-navbar-height, 72px);
  }

  body.home-3:has(.header-sections) .main-navigation {
    min-height: 0;
    height: 0;
    overflow: visible;
  }

  .main-navigation .navbar.navbar-expand-lg:not(.fixed-top) {
    position: relative !important;
    top: auto !important;
    left: auto !important;
    right: auto !important;
    width: 100%;
  }

  .navbar-brand img { max-width: 130px; max-height: 72px; }
  .navbar.fixed-top .navbar-brand.fixed_logo img { max-width: 140px; max-height: 44px; }

  .home-3 .hero-slider.hs-3 {
    margin-top: 0;
    padding-top: 0;
    background-color: #0a1020;
  }

  .page-accounting-reporting .caaft-ar-hero-single.hero-single {
    padding-top: 2rem !important;
    padding-bottom: 2.5rem !important;
  }

  .home-3:not(:has(.header-sections)) .hero-slider .hero-single {
    padding-top: 2.5rem !important;
    padding-bottom: 2rem !important;
  }

  .home-3 .hero-slider .hero-single .hero-content {
    margin-top: 0;
  }

  .page-accounting-reporting .caaft-ar-hero {
    margin-top: 0 !important;
  }
}
</style>
