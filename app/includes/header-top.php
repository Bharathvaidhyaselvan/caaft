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
.home-3 .hero-slider.hs-3 {
  margin-top: -6rem;
  padding-top: 0;
  background-color: #0a1020;
}
<?php endif; ?>
body.navbar-is-sticky {
  padding-top: var(--caaft-navbar-height, 72px);
}
@media (max-width: 991px) {
  .navbar-brand img { max-width: 130px; max-height: 100px; }
  .navbar.fixed-top .navbar-brand.fixed_logo img { max-width: 140px; max-height: 44px; }
  body.navbar-is-sticky { padding-top: var(--caaft-navbar-height, 64px); }
}
</style>
