<meta name="google-site-verification" content="MJT4gBxcLeTzhaKPpQm-4yphgWGBiS_IS_vwJNjtzzA" />
<base href="/" />
<link rel="icon" type="image/x-icon" href="assets/img/caaft-icon.webp">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<?php
$styleVersion = caaft_asset_version('assets/css/style.css');
$features = caaft_page_features();
if ($features['home']) {
    echo '<link rel="preload" as="image" href="assets/img/support-slider-banner.webp" fetchpriority="high">' . "\n";
}
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"></noscript>

<link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo caaft_asset_version('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="assets/css/style.css?v=<?php echo htmlspecialchars($styleVersion, ENT_QUOTES, 'UTF-8'); ?>">

<?php
caaft_defer_stylesheet('assets/css/all-fontawesome.min.css?v=' . caaft_asset_version('assets/css/all-fontawesome.min.css'));
if ($features['carousel']) {
    caaft_defer_stylesheet('assets/css/owl.carousel.min.css?v=' . caaft_asset_version('assets/css/owl.carousel.min.css'));
    caaft_defer_stylesheet('assets/css/animate.min.css?v=' . caaft_asset_version('assets/css/animate.min.css'));
    caaft_defer_stylesheet('assets/css/animation.min.css?v=' . caaft_asset_version('assets/css/animation.min.css'));
}
caaft_defer_stylesheet('assets/css/aos.css?v=' . caaft_asset_version('assets/css/aos.css'));
if ($features['gallery']) {
    caaft_defer_stylesheet('assets/css/magnific-popup.min.css?v=' . caaft_asset_version('assets/css/magnific-popup.min.css'));
}
caaft_defer_stylesheet('assets/css/nice-select.min.css?v=' . caaft_asset_version('assets/css/nice-select.min.css'));
if ($features['tabs']) {
    caaft_defer_stylesheet('assets/css/easy-responsive-tabs.css?v=' . caaft_asset_version('assets/css/easy-responsive-tabs.css'));
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
  padding-top: var(--caaft-navbar-height, 72px);
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
  /* style.css sets navbar position:absolute — overlaps hero; relative until sticky */
  .main-navigation {
    min-height: 0;
  }

  .main-navigation .navbar.navbar-expand-lg:not(.fixed-top) {
    position: relative !important;
    top: auto !important;
    left: auto !important;
    right: auto !important;
    width: 100%;
  }

  .main-navigation .navbar.navbar-expand-lg.fixed-top {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1030;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
  }

  /* Homepage mobile: dark nav; service pages stay white (rule above) */
  body.home-3:not(.page-accounting-reporting) .main-navigation .navbar.navbar-expand-lg {
    background: #101010 !important;
  }

  .navbar-brand img { max-width: 130px; max-height: 72px; }
  .navbar.fixed-top .navbar-brand.fixed_logo img { max-width: 140px; max-height: 44px; }
  body.navbar-is-sticky { padding-top: var(--caaft-navbar-height, 64px); }

  .home-3 .hero-slider.hs-3 {
    margin-top: 0;
    padding-top: 0;
    background-color: #0a1020;
  }

  .page-accounting-reporting .caaft-ar-hero-single.hero-single {
    padding-top: 2rem !important;
    padding-bottom: 2.5rem !important;
  }

  .home-3:not(.page-accounting-reporting) .hero-slider .hero-single {
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
