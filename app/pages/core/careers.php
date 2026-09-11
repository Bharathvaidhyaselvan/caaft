<?php
declare(strict_types=1);

$GLOBALS['caaft_active_page'] = 'careers';
$caaft_careers = require dirname(__DIR__, 2) . '/includes/data/caaft-careers.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all, index, follow">
    <title>Careers at CAAFT | Open Positions in Chennai</title>
    <meta name="Description" content="Explore open positions at CAAFT Consultancy Services in Chennai. Join our accounting, taxation, and business advisory teams.">
    <link rel="canonical" href="https://caaft.com/careers">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Careers at CAAFT | Open Positions in Chennai">
    <meta property="og:description" content="Explore open positions at CAAFT Consultancy Services in Chennai. Join our accounting, taxation, and business advisory teams.">
    <meta property="og:url" content="https://caaft.com/careers">
    <meta property="og:site_name" content="CAAFT Consultancy Services">
    <meta property="og:image" content="https://caaft.com/assets/img/about-caaft-banner.webp">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Careers at CAAFT | Open Positions in Chennai">
    <meta name="twitter:creator" content="@CaaftServices">
    <meta name="twitter:site" content="@CaaftServices">
    <meta name="twitter:image" content="https://caaft.com/assets/img/about-caaft-banner.webp">

    <?php include "header-top.php"; ?>
    <?php include dirname(__DIR__, 2) . '/includes/components/caaft-schema-organization.php'; ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "CollectionPage",
      "@id": "https://caaft.com/careers/#webpage",
      "url": "https://caaft.com/careers",
      "name": "Careers at CAAFT | Open Positions in Chennai",
      "description": "Explore open positions at CAAFT Consultancy Services in Chennai.",
      "isPartOf": {"@id": "https://caaft.com/#organization"}
    }
    </script>
    <style>
        .caaft-careers-list {
            max-width: 920px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 28px rgba(16, 24, 40, 0.08);
            overflow: hidden;
        }
        .caaft-careers-item {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 0.7fr) auto;
            gap: 24px;
            align-items: center;
            padding: 28px 32px;
            border-bottom: 1px solid #e8edf2;
            text-decoration: none;
            color: inherit;
            transition: background-color .2s ease;
        }
        .caaft-careers-item:last-child {
            border-bottom: 0;
        }
        .caaft-careers-item:hover {
            background: #f8fafc;
        }
        .caaft-careers-dept {
            display: block;
            margin-bottom: 6px;
            color: var(--theme-color, #33b6ff);
            font-size: 0.92rem;
            font-weight: 500;
        }
        .caaft-careers-title {
            margin: 0;
            color: #1f2c40;
            font-size: clamp(1.15rem, 1.8vw, 1.45rem);
            font-weight: 700;
            line-height: 1.3;
        }
        .caaft-careers-loc-label {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.92rem;
            font-weight: 500;
        }
        .caaft-careers-loc-value {
            margin: 0;
            color: #1f2c40;
            font-weight: 600;
        }
        .caaft-careers-more {
            color: #1f2c40;
            font-weight: 600;
            white-space: nowrap;
        }
        .caaft-careers-more i {
            margin-left: 6px;
            color: var(--theme-color, #33b6ff);
        }
        .caaft-careers-item:hover .caaft-careers-more {
            color: var(--theme-color, #33b6ff);
        }
        @media (max-width: 767px) {
            .caaft-careers-item {
                grid-template-columns: 1fr;
                gap: 12px;
                padding: 22px 20px;
            }
            .caaft-careers-more {
                justify-self: start;
            }
        }
    </style>
</head>

<body class="home-3">
<?php include dirname(__DIR__, 2) . '/includes/gtm-noscript.php'; ?>
    <div class="header-sections">
        <?php include "header.php"; ?>
    </div>

    <div class="search-popup">
        <button class="close-search" type="button" aria-label="Close search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" class="form-control" placeholder="Search Here..." required>
                <button type="submit" aria-label="Submit search"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>

    <main class="main">
        <div class="site-breadcrumb" style="background: url(assets/img/about-caaft-banner.webp)">
            <div class="container">
                <h1 class="breadcrumb-title">Careers</h1>
            </div>
        </div>

        <section class="section-py-70" aria-labelledby="caaft-open-positions-heading">
            <div class="container">
                <div class="site-heading text-center mb-40">
                    <h2 id="caaft-open-positions-heading" class="site-title">Open Positions</h2>
                </div>

                <div class="caaft-careers-list">
                    <?php foreach ($caaft_careers as $job) : ?>
                        <a class="caaft-careers-item" href="/careers/<?php echo htmlspecialchars($job['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                            <div>
                                <span class="caaft-careers-dept"><?php echo htmlspecialchars($job['department'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <h3 class="caaft-careers-title"><?php echo htmlspecialchars($job['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            </div>
                            <div>
                                <span class="caaft-careers-loc-label">Location</span>
                                <p class="caaft-careers-loc-value"><?php echo htmlspecialchars($job['location'], ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                            <span class="caaft-careers-more">Know More <i class="far fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <?php include "footer-bottom.php"; ?>
</body>
</html>
