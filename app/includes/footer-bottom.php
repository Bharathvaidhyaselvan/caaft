<?php
$features = caaft_page_features();
$v = static function (string $path): string {
    return caaft_asset_version($path);
};
?>

<script src="assets/js/jquery-3.7.1.min.js?v=<?php echo $v('assets/js/jquery-3.7.1.min.js'); ?>" defer></script>
<script src="assets/js/bootstrap.bundle.min.js?v=<?php echo $v('assets/js/bootstrap.bundle.min.js'); ?>" defer></script>
<script src="assets/js/perf-image-loading.js?v=<?php echo $v('assets/js/perf-image-loading.js'); ?>" defer></script>
<script src="assets/js/mega-menu-click.js?v=<?php echo $v('assets/js/mega-menu-click.js'); ?>" defer></script>

<?php if ($features['carousel']) : ?>
<script src="assets/js/owl.carousel.min.js?v=<?php echo $v('assets/js/owl.carousel.min.js'); ?>" defer></script>
<script src="assets/js/jquery.appear.min.js?v=<?php echo $v('assets/js/jquery.appear.min.js'); ?>" defer></script>
<script src="assets/js/jquery.easing.min.js?v=<?php echo $v('assets/js/jquery.easing.min.js'); ?>" defer></script>
<script src="assets/js/wow.min.js?v=<?php echo $v('assets/js/wow.min.js'); ?>" defer></script>
<script src="assets/js/counter-up.js?v=<?php echo $v('assets/js/counter-up.js'); ?>" defer></script>
<?php endif; ?>

<script src="assets/js/main.js?v=<?php echo $v('assets/js/main.js'); ?>" defer></script>
<?php if ($features['carousel']) : ?>
<script src="assets/js/hero-slider-init.js?v=<?php echo $v('assets/js/hero-slider-init.js'); ?>" defer></script>
<?php endif; ?>
<script src="assets/js/header-sticky.js?v=<?php echo $v('assets/js/header-sticky.js'); ?>" defer></script>

<?php if ($features['gallery']) : ?>
<script src="assets/js/imagesloaded.pkgd.min.js?v=<?php echo $v('assets/js/imagesloaded.pkgd.min.js'); ?>" defer></script>
<script src="assets/js/jquery.magnific-popup.min.js?v=<?php echo $v('assets/js/jquery.magnific-popup.min.js'); ?>" defer></script>
<script src="assets/js/isotope.pkgd.min.js?v=<?php echo $v('assets/js/isotope.pkgd.min.js'); ?>" defer></script>
<?php endif; ?>

<?php if ($features['aos']) : ?>
<script src="assets/js/aos.js?v=<?php echo $v('assets/js/aos.js'); ?>" defer></script>
<?php endif; ?>

<script src="assets/js/jquery.nice-select.min.js?v=<?php echo $v('assets/js/jquery.nice-select.min.js'); ?>" defer></script>
<script src="assets/js/easyResponsiveTabs.js?v=<?php echo $v('assets/js/easyResponsiveTabs.js'); ?>" defer></script>

<?php include APP_ROOT . '/includes/analytics-deferred.php'; ?>

<script>
window.addEventListener('load', function () {
  window.setTimeout(function () {
    if (window.Tawk_API && window.Tawk_API.maximize) {
      return;
    }
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_LoadStart = new Date();
    var s1 = document.createElement('script');
    var s0 = document.getElementsByTagName('script')[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/67f51bc06e4a411911da033f/1ioan8qvt';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  }, 3500);
});
</script>
