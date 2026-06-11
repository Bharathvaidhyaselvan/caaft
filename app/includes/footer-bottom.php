<?php
$features = caaft_page_features();
$asset = static function (string $path): string {
    return htmlspecialchars(caaft_public_asset_url($path), ENT_QUOTES, 'UTF-8');
};
?>

<script src="<?php echo $asset('assets/js/jquery-3.7.1.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/bootstrap.bundle.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/perf-image-loading.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/mega-menu-click.js'); ?>" defer></script>

<?php if ($features['carousel']) : ?>
<script src="<?php echo $asset('assets/js/owl.carousel.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/jquery.appear.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/jquery.easing.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/wow.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/wow-deferred-init.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/counter-up.js'); ?>" defer></script>
<?php endif; ?>

<?php if ($features['gallery']) : ?>
<script src="<?php echo $asset('assets/js/imagesloaded.pkgd.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/jquery.magnific-popup.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/isotope.pkgd.min.js'); ?>" defer></script>
<?php endif; ?>

<?php if ($features['aos']) : ?>
<script src="<?php echo $asset('assets/js/aos.js'); ?>" defer></script>
<?php endif; ?>

<script src="<?php echo $asset('assets/js/jquery.nice-select.min.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/nice-select-init.js'); ?>" defer></script>
<?php if ($features['tabs']) : ?>
<script src="<?php echo $asset('assets/js/easyResponsiveTabs.js'); ?>" defer></script>
<?php endif; ?>

<script src="<?php echo $asset('assets/js/main.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/accessibility-enhancements.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/form-hash-focus.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/form-page-url.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/lazy-recaptcha.js'); ?>" defer></script>
<script src="<?php echo $asset('assets/js/form-inline-validation.js'); ?>" defer></script>
<?php if ($features['carousel']) : ?>
<script src="<?php echo $asset('assets/js/hero-slider-init.js'); ?>" defer></script>
<?php endif; ?>
<script src="<?php echo $asset('assets/js/header-sticky.js'); ?>" defer></script>

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
