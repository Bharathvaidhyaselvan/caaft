<?php
declare(strict_types=1);

$f = dirname(__DIR__) . '/app/pages/core/index.php';
$c = file_get_contents($f);
if ($c === false) {
    fwrite(STDERR, "Cannot read index.php\n");
    exit(1);
}

$start = strpos($c, '        <!-- ===== 4. PRICING PLANS SECTION ===== -->');
$end = strpos($c, '        <!-- ===== 5. OUR ACHIEVEMENTS SECTION ===== -->');
if ($start === false || $end === false) {
    fwrite(STDERR, "Pricing or achievements marker not found\n");
    exit(1);
}

$pricing = substr($c, $start, $end - $start);
$pricing = str_replace(
    '        <!-- ===== 4. PRICING PLANS SECTION ===== -->',
    '        <!-- ===== PRICING PLANS SECTION ===== -->',
    $pricing
);

$c = substr($c, 0, $start) . substr($c, $end);

$insert = strpos($c, '        <div class="process-area"');
if ($insert === false) {
    fwrite(STDERR, "process-area not found\n");
    exit(1);
}

$c = substr($c, 0, $insert) . $pricing . substr($c, $insert);
file_put_contents($f, $c);
echo "OK\n";
