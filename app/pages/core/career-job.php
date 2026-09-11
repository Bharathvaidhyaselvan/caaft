<?php
declare(strict_types=1);

$GLOBALS['caaft_active_page'] = 'careers';
$caaft_careers = require dirname(__DIR__, 2) . '/includes/data/caaft-careers.php';

$requestedPath = trim((string) (parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''), '/');
$jobSlug = '';
if (preg_match('#^careers/([a-z0-9-]+)$#', $requestedPath, $matches)) {
    $jobSlug = $matches[1];
} elseif (!empty($_GET['__route']) && preg_match('#^careers/([a-z0-9-]+)$#', trim((string) $_GET['__route'], '/'), $matches)) {
    $jobSlug = $matches[1];
}

$job = $caaft_careers[$jobSlug] ?? null;
if ($job === null) {
    http_response_code(404);
    include APP_ROOT . '/pages/utility/default.php';
    return;
}

$jobTitle = $job['title'];
$jobOpen = !empty($job['open']);
$jobCanonical = 'https://caaft.com/careers/' . $job['slug'];
$otherJobs = array_filter(
    $caaft_careers,
    static fn(array $item): bool => ($item['slug'] ?? '') !== $job['slug']
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all, index, follow">
    <title><?php echo htmlspecialchars($jobTitle, ENT_QUOTES, 'UTF-8'); ?> | Careers at CAAFT</title>
    <meta name="Description" content="<?php echo htmlspecialchars($job['summary'], ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($jobCanonical, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo htmlspecialchars($jobTitle . ' | Careers at CAAFT', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($job['summary'], ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($jobCanonical, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="CAAFT Consultancy Services">
    <meta property="og:image" content="https://caaft.com/assets/img/about-caaft-banner.webp">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($jobTitle . ' | Careers at CAAFT', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:creator" content="@CaaftServices">
    <meta name="twitter:site" content="@CaaftServices">
    <meta name="twitter:image" content="https://caaft.com/assets/img/about-caaft-banner.webp">

    <?php include "header-top.php"; ?>
    <?php include dirname(__DIR__, 2) . '/includes/components/caaft-schema-organization.php'; ?>
    <?php if ($jobOpen) : ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "JobPosting",
      "title": <?php echo json_encode($jobTitle, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,
      "description": <?php echo json_encode($job['summary'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>,
      "hiringOrganization": {
        "@type": "Organization",
        "name": "CAAFT Consultancy Services",
        "sameAs": "https://caaft.com/"
      },
      "jobLocation": {
        "@type": "Place",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": <?php echo json_encode($job['location'], JSON_UNESCAPED_UNICODE); ?>,
          "addressCountry": "IN"
        }
      },
      "employmentType": "FULL_TIME",
      "url": <?php echo json_encode($jobCanonical, JSON_UNESCAPED_SLASHES); ?>
    }
    </script>
    <?php endif; ?>
</head>

<body class="home-3 page-careers-job">
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
        <section class="caaft-job-hero" aria-labelledby="caaft-job-hero-title">
            <div class="container">
                <a class="caaft-job-back" href="/careers"><i class="far fa-arrow-left" aria-hidden="true"></i> Careers</a>
                <p class="caaft-job-hero-dept"><?php echo htmlspecialchars($job['department'], ENT_QUOTES, 'UTF-8'); ?></p>
                <h1 id="caaft-job-hero-title" class="caaft-job-hero-title"><?php echo htmlspecialchars($jobTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="caaft-job-hero-loc"><?php echo htmlspecialchars($job['location'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </section>

        <?php if ($jobOpen) : ?>
        <div class="caaft-job-tabs-bar">
            <div class="container">
                <div class="caaft-job-tabs" role="tablist" aria-label="Job sections">
                    <button type="button" class="caaft-job-tab is-active" role="tab" id="tab-overview" aria-selected="true" aria-controls="panel-overview" data-caaft-job-tab="overview">Role overview</button>
                    <button type="button" class="caaft-job-tab" role="tab" id="tab-application" aria-selected="false" aria-controls="panel-application" data-caaft-job-tab="application">Application</button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <section class="caaft-job-body">
            <div class="container">
                <div class="caaft-job-panels">
                    <div class="caaft-job-panel is-active" id="panel-overview" role="tabpanel" aria-labelledby="tab-overview">
                        <div class="row g-5">
                            <div class="col-lg-8">
                                <?php if ($jobOpen) : ?>
                                    <button type="button" class="theme-btn caaft-job-apply-top" data-caaft-job-tab-trigger="application">Apply Now</button>
                                <?php else : ?>
                                    <span class="theme-btn caaft-job-closed caaft-job-apply-top" aria-disabled="true">Closed</span>
                                <?php endif; ?>

                                <div class="caaft-job-prose">
                                    <h2>Job Summary</h2>
                                    <p><?php echo htmlspecialchars($job['summary'], ENT_QUOTES, 'UTF-8'); ?></p>

                                    <h2>Responsibilities and Accountabilities</h2>
                                    <ul>
                                        <?php foreach ($job['responsibilities'] as $item) : ?>
                                            <li><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <h2>Tools &amp; Resources required</h2>
                                    <ul>
                                        <?php foreach ($job['tools'] as $item) : ?>
                                            <li><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <h2>Your Expertise</h2>
                                    <ul>
                                        <li><strong>Qualification(s):</strong> <?php echo htmlspecialchars($job['qualification'], ENT_QUOTES, 'UTF-8'); ?></li>
                                        <li><strong>Nature of Experience:</strong> <?php echo htmlspecialchars($job['experience_nature'], ENT_QUOTES, 'UTF-8'); ?></li>
                                        <?php if (!empty($job['experience_length'])) : ?>
                                            <li><strong>Length of Experience:</strong> <?php echo htmlspecialchars($job['experience_length'], ENT_QUOTES, 'UTF-8'); ?></li>
                                        <?php endif; ?>
                                    </ul>

                                    <h2>Skill Set &amp; Personality Traits</h2>
                                    <ul>
                                        <?php foreach ($job['skills'] as $item) : ?>
                                            <li><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="caaft-job-apply-footer">
                                    <?php if ($jobOpen) : ?>
                                        <button type="button" class="theme-btn" data-caaft-job-tab-trigger="application">Apply Now</button>
                                    <?php else : ?>
                                        <span class="theme-btn caaft-job-closed" aria-disabled="true">Closed</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <aside class="col-lg-4">
                                <div class="caaft-job-sidebar">
                                    <div class="caaft-job-side-card">
                                        <h3>Role details</h3>
                                        <dl class="caaft-job-side-list">
                                            <?php
                                            $jobDetails = $job['details'] ?? [
                                                'Department' => (string) ($job['department'] ?? ''),
                                                'Location' => (string) ($job['location'] ?? ''),
                                                'Experience' => (string) ($job['experience_length'] ?? ''),
                                            ];
                                            if (!empty($job['age_group']) && !isset($jobDetails['Age group'])) {
                                                $jobDetails['Age group'] = (string) $job['age_group'];
                                            }
                                            foreach ($jobDetails as $detailLabel => $detailValue) :
                                                $detailValue = trim((string) $detailValue);
                                                if ($detailValue === '') {
                                                    continue;
                                                }
                                                ?>
                                            <div>
                                                <dt><?php echo htmlspecialchars((string) $detailLabel, ENT_QUOTES, 'UTF-8'); ?></dt>
                                                <dd><?php echo htmlspecialchars($detailValue, ENT_QUOTES, 'UTF-8'); ?></dd>
                                            </div>
                                            <?php endforeach; ?>
                                        </dl>
                                        <?php if ($jobOpen) : ?>
                                            <button type="button" class="theme-btn caaft-job-side-btn" data-caaft-job-tab-trigger="application">Apply Now</button>
                                        <?php else : ?>
                                            <span class="theme-btn caaft-job-closed caaft-job-side-btn" aria-disabled="true">Closed</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="caaft-job-side-card">
                                        <h3>Join CAAFT</h3>
                                        <p>Work with Chartered Accountants and advisors supporting businesses across incorporation, taxation, compliance, and growth.</p>
                                        <a class="caaft-job-side-link" href="/about">About CAAFT <i class="far fa-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>

                    <?php if ($jobOpen) : ?>
                    <div class="caaft-job-panel" id="panel-application" role="tabpanel" aria-labelledby="tab-application" hidden>
                        <div class="caaft-job-apply-panel" id="apply">
                            <?php include dirname(__DIR__, 2) . '/includes/components/careers-apply-form.php'; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php if ($otherJobs !== []) : ?>
            <section class="caaft-job-more" aria-labelledby="caaft-job-more-heading">
                <div class="container">
                    <div class="caaft-job-more-head">
                        <h2 id="caaft-job-more-heading">More open positions</h2>
                        <a class="caaft-job-more-all" href="/careers">View all jobs <i class="far fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    <div class="caaft-job-more-grid">
                        <?php foreach ($otherJobs as $other) : ?>
                            <a class="caaft-job-more-card" href="/careers/<?php echo htmlspecialchars($other['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                                <span class="caaft-job-more-dept"><?php echo htmlspecialchars($other['department'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <strong><?php echo htmlspecialchars($other['title'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                <span class="caaft-job-more-loc"><?php echo htmlspecialchars($other['location'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php include "footer.php"; ?>
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <?php include "footer-bottom.php"; ?>
    <?php if ($jobOpen) : ?>
    <script>
    (function () {
        var tabs = document.querySelectorAll('[data-caaft-job-tab]');
        var panels = {
            overview: document.getElementById('panel-overview'),
            application: document.getElementById('panel-application')
        };

        function activate(name) {
            if (!panels[name]) return;
            tabs.forEach(function (tab) {
                var on = tab.getAttribute('data-caaft-job-tab') === name;
                tab.classList.toggle('is-active', on);
                tab.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            Object.keys(panels).forEach(function (key) {
                var panel = panels[key];
                var on = key === name;
                panel.classList.toggle('is-active', on);
                if (on) {
                    panel.removeAttribute('hidden');
                } else {
                    panel.setAttribute('hidden', 'hidden');
                }
            });
            if (name === 'application') {
                var formTop = document.getElementById('quote-content') || document.getElementById('apply');
                if (formTop) {
                    formTop.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                activate(tab.getAttribute('data-caaft-job-tab'));
            });
        });

        document.querySelectorAll('[data-caaft-job-tab-trigger]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                activate(btn.getAttribute('data-caaft-job-tab-trigger'));
            });
        });

        if (window.location.hash === '#apply' || window.location.hash === '#application') {
            activate('application');
        }
    })();
    </script>
    <?php endif; ?>
</body>
</html>
