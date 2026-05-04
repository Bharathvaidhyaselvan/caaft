<?php
declare(strict_types=1);
$plcRequestPath = trim((string) (parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''), '/');
$plcCanonicalSlug = 'private-limited-company-registration';
$plcLegacyPaths = [
    'company-incorporation/private-limited-company',
    'private-limited-company',
    'company-incorporation/private-limited-registration',
    'private-limited-registration',
];
if (in_array($plcRequestPath, $plcLegacyPaths, true)) {
    $plcQs = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: /' . $plcCanonicalSlug . '/' . $plcQs, true, 301);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all, index, follow">
    <title>Private Limited Company Registration in India — Fast, Compliant, Expert-Led</title>
    <meta name="description" content="Private Limited Company registration in India — complete incorporation support covering documentation, ROC filing, compliance setup, and long-term statutory management.">
    <meta name="keywords" content="private limited company, private limited company registration, private limited company registration documents, Pvt Ltd registration India, ROC incorporation">
    <link rel="canonical" href="https://caaft.com/private-limited-company-registration/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Private Limited Company Registration in India — Fast, Compliant, Expert-Led">
    <meta property="og:description" content="Private Limited Company registration in India — complete incorporation support covering documentation, ROC filing, compliance setup, and long-term statutory management.">
    <meta property="og:url" content="https://caaft.com/private-limited-company-registration/">
    <meta property="og:site_name" content="CAAFT Consultancy Services">
    <meta property="og:image" content="https://caaft.com/assets/img/gst-registration-overview.jpg">
    <style>
        .page-private-limited-registration .caaft-ar-trust-indicators { background: #ffffff !important; }
        .page-private-limited-registration .bk-overview .bk-section-title {
            margin: 0 0 1.75rem;
            text-align: left;
        }
        .page-private-limited-registration .bk-overview .bk-overview-text {
            margin: 0 0 1.75rem;
            text-align: left;
            font-size: 1.02rem;
            line-height: 1.6;
            color: #2f2f2f;
        }
        .page-private-limited-registration .bk-overview .bk-overview-bullets {
            margin: 0 0 1.75rem;
            color: #2f2f2f;
        }
        .page-private-limited-registration .bk-overview-layout {
            align-items: center;
        }
        .page-private-limited-registration .bk-overview-image-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            align-self: center;
        }
        .page-private-limited-registration .bk-overview-image-wrap img {
            object-fit: contain;
            width: 100%;
            max-height: min(340px, 50vh);
            height: auto;
        }
        .page-private-limited-registration .plc-section-lead {
            margin: 0 0 1rem;
            color: #4d5868;
            line-height: 1.68;
            max-width: 900px;
        }
        .page-private-limited-registration .plc-needs-wrap {
            padding-top: 44px;
            padding-bottom: 44px;
        }
        .page-private-limited-registration .plc-needs-title,
        .page-private-limited-registration .plc-section-h2 {
            margin: 0 0 10px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-private-limited-registration .plc-needs-intro {
            margin: 0 0 20px;
            max-width: 900px;
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.65;
            font-weight: 500;
        }
        .page-private-limited-registration .plc-needs-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 20px;
            margin-top: 0;
        }
        .page-private-limited-registration .plc-needs-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-left: 4px solid var(--theme-color, #33b6ff);
            border-radius: 8px;
            padding: 18px 20px 18px 22px;
            box-shadow: none;
        }
        .page-private-limited-registration .plc-needs-card h3 {
            margin: 0 0 10px;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2c40;
            line-height: 1.35;
        }
        .page-private-limited-registration .plc-needs-card p {
            margin: 0;
            font-size: 0.97rem;
            line-height: 1.62;
            color: #6b7280;
        }
        .page-private-limited-registration .plc-bullet-list {
            margin: 12px 0 0;
            padding-left: 1.25rem;
            color: #2f3948;
            line-height: 1.65;
        }
        .page-private-limited-registration .plc-bullet-list li {
            margin-bottom: 8px;
        }
        .page-private-limited-registration .plc-legal-wrap {
            background: #f0f7ff;
            padding-top: 48px;
            padding-bottom: 48px;
        }
        .page-private-limited-registration .plc-legal-wrap .plc-section-h2 {
            margin-bottom: 10px;
        }
        .page-private-limited-registration .plc-legal-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 18px;
        }
        .page-private-limited-registration .plc-legal-card {
            position: relative;
            background: #ffffff;
            border-radius: 12px;
            padding: 22px 22px 24px;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.07);
            border: 1px solid rgba(226, 232, 240, 0.9);
            overflow: hidden;
            min-height: 0;
        }
        .page-private-limited-registration .plc-legal-card-num {
            position: absolute;
            top: 8px;
            right: 14px;
            font-size: clamp(2.25rem, 4.5vw, 3.25rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.02em;
            color: #e2e8f0;
            user-select: none;
            pointer-events: none;
        }
        .page-private-limited-registration .plc-legal-card h3 {
            position: relative;
            margin: 0 0 12px;
            padding-right: 4.5rem;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.35;
        }
        .page-private-limited-registration .plc-legal-card p {
            position: relative;
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.65;
            color: #4a5568;
            font-weight: 500;
        }
        .page-private-limited-registration .plc-docs-section {
            padding-top: 44px;
            padding-bottom: 44px;
            background: #ffffff;
        }
        .page-private-limited-registration .plc-docs-section .plc-docs-title {
            margin: 0 0 22px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-private-limited-registration .plc-docs-cards-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            align-items: stretch;
        }
        .page-private-limited-registration .plc-docs-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 22px 22px 20px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }
        .page-private-limited-registration .plc-docs-card-head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 14px;
            margin-bottom: 14px;
            border-bottom: 1px solid #e8edf2;
        }
        .page-private-limited-registration .plc-docs-card-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff;
            font-size: 1.05rem;
        }
        .page-private-limited-registration .plc-docs-card-icon--violet {
            background: #7c3aed;
        }
        .page-private-limited-registration .plc-docs-card-icon--green {
            background: #10b981;
        }
        .page-private-limited-registration .plc-docs-card-icon--amber {
            background: #f59e0b;
        }
        .page-private-limited-registration .plc-docs-card-icon--blue {
            background: #3b82f6;
        }
        .page-private-limited-registration .plc-docs-card h3 {
            margin: 0;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.35;
        }
        .page-private-limited-registration .plc-docs-card-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .page-private-limited-registration .plc-docs-card-list li {
            position: relative;
            padding: 6px 0 6px 0;
            font-size: 0.97rem;
            line-height: 1.55;
            font-weight: 500;
            color: #4a5568;
        }
        .page-private-limited-registration .plc-docs-card-list li + li {
            margin-top: 2px;
        }
        @media (max-width: 991.98px) {
            .page-private-limited-registration .plc-needs-grid {
                grid-template-columns: 1fr;
            }
            .page-private-limited-registration .plc-legal-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 767.98px) {
            .page-private-limited-registration .plc-docs-cards-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 575.98px) {
            .page-private-limited-registration .plc-legal-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <?php include "header-top.php"; ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "@id": "https://caaft.com/#organization",
          "name": "CAAFT Consultancy Services Private Limited",
          "url": "https://caaft.com",
          "logo": {
            "@type": "ImageObject",
            "url": "https://caaft.com/assets/img/caaft-logo-header.webp"
          },
          "description": "CAAFT Consultancy Services provides expert Accounting, Taxation, Business Incorporation, Management Consultancy, and Compliance Services to businesses across India.",
          "email": "info@caaft.com",
          "telephone": ["+91-8870078870", "+91-9944617891"],
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Office No: C304, 3rd Floor, Apeejay House, 39/12, Haddows Road, Nungambakkam",
            "addressLocality": "Chennai",
            "addressRegion": "Tamil Nadu",
            "postalCode": "600006",
            "addressCountry": "IN"
          },
          "areaServed": { "@type": "Country", "name": "India" }
        },
        {
          "@type": "LocalBusiness",
          "@id": "https://caaft.com/#localbusiness",
          "name": "CAAFT Consultancy Services Private Limited",
          "url": "https://caaft.com",
          "logo": "https://caaft.com/assets/img/caaft-logo-header.webp",
          "image": "https://caaft.com/assets/img/caaft-logo-header.webp",
          "description": "Professional company registration, tax, and compliance services for businesses across India.",
          "email": "info@caaft.com",
          "telephone": ["+91-8870078870", "+91-9944617891"],
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Office No: C304, 3rd Floor, Apeejay House, 39/12, Haddows Road, Nungambakkam",
            "addressLocality": "Chennai",
            "addressRegion": "Tamil Nadu",
            "postalCode": "600006",
            "addressCountry": "IN"
          },
          "geo": { "@type": "GeoCoordinates", "latitude": 13.0604, "longitude": 80.2496 },
          "openingHoursSpecification": [
            { "@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"], "opens": "09:30", "closes": "18:30" },
            { "@type": "OpeningHoursSpecification", "dayOfWeek": "Saturday", "opens": "09:30", "closes": "17:00" }
          ],
          "priceRange": "₹₹",
          "currenciesAccepted": "INR",
          "paymentAccepted": "Cash, Bank Transfer, UPI",
          "areaServed": { "@type": "Country", "name": "India" }
        },
        {
          "@type": "Service",
          "@id": "https://caaft.com/private-limited-company-registration/#service",
          "name": "Private Limited Company Registration",
          "alternateName": "Private Limited Company Registration Services India",
          "url": "https://caaft.com/private-limited-company-registration/",
          "description": "End-to-end Private Limited Company registration services in India including documentation, compliance, incorporation, and advisory support for startups and growing businesses.",
          "provider": { "@id": "https://caaft.com/#organization" },
          "areaServed": { "@type": "Country", "name": "India" },
          "serviceType": "Company Registration and Compliance Services",
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Private Limited Company Services",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Private Limited Company Registration", "description": "Complete incorporation support including name approval, DIN, DSC, MOA, AOA drafting, and ROC filing." } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Compliance and Regulatory Advisory", "description": "Guidance on post-incorporation statutory compliance, governance obligations, and regulatory requirements." } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Documentation and Filing Support", "description": "Preparation and submission of all private limited company registration documents required for incorporation." } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Post Registration Compliance", "description": "Ongoing support for annual filings, statutory audits, board meetings, and ROC compliance management." } }
            ]
          }
        },
        {
          "@type": "FAQPage",
          "@id": "https://caaft.com/private-limited-company-registration/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "Can a Private Limited Company be converted into a Public Limited Company later?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. The Companies Act, 2013 permits conversion from Private to Public Limited — but the process requires amendments to the MOA and AOA, shareholder and board approvals, ROC filings, and compliance with the minimum director and shareholder thresholds applicable to public companies. Structuring the company with this possibility in mind from the start avoids costly restructuring later."
              }
            },
            {
              "@type": "Question",
              "name": "Is a Company Secretary mandatory for a Private Limited Company immediately after incorporation?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Not immediately for all companies. The Companies Act mandates a full-time Company Secretary only when a Private Limited Company's paid-up share capital reaches ₹5 crore or above. However, certain ROC filings and certifications still require a practising Company Secretary — making early engagement with a CS advisable regardless of capital size."
              }
            },
            {
              "@type": "Question",
              "name": "What happens to a Private Limited Company if one of its two directors resigns?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "The Companies Act requires a Private Limited Company to maintain at least two directors at all times. If the number drops below this threshold, the company must appoint a replacement director within the prescribed timeline — failing which it faces compliance defaults. Every directorship change requires timely ROC filings through Form DIR-12."
              }
            },
            {
              "@type": "Question",
              "name": "Can foreign nationals or NRIs serve as directors or shareholders in an Indian Private Limited Company?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Foreign nationals and NRIs can hold shares or serve as directors in an Indian Private Limited Company — subject to FEMA regulations, RBI guidelines, and applicable FDI sectoral caps. The structure must include at least one Indian resident director at all times. Certain sectors restrict or prohibit foreign ownership entirely, requiring a sector-specific assessment before incorporation."
              }
            },
            {
              "@type": "Question",
              "name": "Does a Private Limited Company need GST registration separately from company incorporation?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. GST registration is a separate statutory obligation — the company incorporation process does not cover it. GST registration becomes mandatory once turnover crosses the applicable threshold, or immediately when the business involves inter-state supply of goods or services, e-commerce, or other notified activities. Businesses should typically complete GST registration within the first weeks of commencing operations."
              }
            }
          ]
        },
        {
          "@type": "BreadcrumbList",
          "@id": "https://caaft.com/private-limited-company-registration/#breadcrumb",
          "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://caaft.com" },
            { "@type": "ListItem", "position": 2, "name": "Private Limited Company Registration", "item": "https://caaft.com/private-limited-company-registration/" }
          ]
        }
      ]
    }
    </script>
</head>
<body class="home-3 page-accounting-reporting page-private-limited-registration">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQ559WPT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <div class="header-sections"><?php include "header.php"; ?></div>
    <main class="main">
        <?php
        $caaft_hero_id = 'plc-h1';
        $caaft_hero_h1 = 'Private Limited Company Registration Services';
        $caaft_hero_h2_before = 'From Incorporation to Ongoing Compliance — ';
        $caaft_hero_h2_highlight = 'Complete Private Limited Company Support.';
        $caaft_hero_h2_after = '';
        $caaft_hero_lead_paragraphs = [
            'A Private Limited Company stands as the most widely chosen business structure in India — combining limited liability protection, separate legal identity, and a governance framework that supports credible, scalable business growth.',
            'This structure restricts share transferability and caps shareholders at a maximum of 200 — making it the preferred choice for startups, growing enterprises, and businesses planning structured investment rounds. CAAFT manages end-to-end Private Limited Company registration and compliance — from name approval and ROC filing through to post-incorporation statutory management.',
        ];
        $caaft_hero_primary_cta_label = 'Setup Your Company';
        $caaft_hero_primary_cta_href = '/contact#contact_us';
        $caaft_hero_secondary_cta_label = 'Incorporate Today';
        $caaft_hero_secondary_cta_href = '/contact#contact_us';
        $caaft_hero_secondary_cta_icon = 'fas fa-arrow-right';
$caaft_enquiry_service = 'Private Limited Company Registration';
$caaft_enquiry_action = '/business-registration-mail.php';
$caaft_enquiry_title = 'Let\'s Talk';
$caaft_enquiry_recaptcha = false;
$caaft_enquiry_honeypot_website = false;
        include __DIR__ . '/../../includes/components/service-hero-with-enquiry.php';
        ?>

        <?php
        $caaft_trust_items = [
            ['icon_class' => 'fas fa-star', 'title' => 'Rated 4.8/5 ⭐', 'description' => 'on Google'],
            ['icon_class' => 'fas fa-building', 'title' => '500+', 'description' => 'Companies Registered'],
            ['icon_class' => 'fas fa-calendar-check', 'title' => '7-Day', 'description' => 'Registration Process'],
            ['icon_class' => 'fas fa-lock', 'title' => '100%', 'description' => 'Data Confidentiality'],
        ];
        include __DIR__ . '/../../includes/components/service-trust-indicators.php';
        ?>

        <?php
        $caaft_overview_heading_id = 'plc-what-heading';
        $caaft_overview_title = 'What Is a Private Limited Company?';
        $caaft_overview_paragraphs = [
            'A Private Limited Company (Pvt Ltd) is a legally registered business entity incorporated under the Companies Act, 2013 — holding a separate legal identity, extending limited liability to its shareholders, and operating under a defined governance structure that restricts public share transfers.',
            'Key characteristics of a Private Limited Company:',
        ];
        $caaft_overview_bullets = [
            'The Articles of Association restrict share transferability — shares cannot be freely offered to the public',
            'Shareholders bear liability only to the extent of their shareholding — personal assets stay protected',
            'The company holds an independent legal identity, separate from its founders and directors',
            'The Companies Act, 2013 governs all filings, audits, and meetings under a structured compliance framework',
            'Startups, SMEs, and growth-stage enterprises use this structure to establish investor readiness and operational credibility',
        ];
        $caaft_overview_closing = '';
        $caaft_overview_image_src = '/assets/img/gst-registration-overview.jpg';
        $caaft_overview_image_alt = 'Private limited company incorporation and business registration support';
        include __DIR__ . '/../../includes/components/caaft-overview-card.php';
        ?>

        <section class="plc-needs-wrap" aria-labelledby="plc-needs-heading">
            <div class="container">
                <h2 id="plc-needs-heading" class="plc-needs-title">Who Needs Private Limited Company Registration?</h2>
                <p class="plc-needs-intro">Private Limited Company registration serves businesses and founders across a range of situations:</p>
                <div class="plc-needs-grid">
                    <article class="plc-needs-card"><h3>Startups and Early-Stage Ventures</h3><p>Establishes a credible legal structure before approaching investors or accelerators.</p></article>
                    <article class="plc-needs-card"><h3>Small and Medium Enterprises</h3><p>Provides limited liability protection and a formal corporate identity for growing businesses.</p></article>
                    <article class="plc-needs-card"><h3>Entrepreneurs Seeking Equity Funding</h3><p>Preferred structure by angel investors and venture capital firms before committing capital.</p></article>
                    <article class="plc-needs-card"><h3>Businesses with Multiple Founders</h3><p>Enables structured internal governance, defined shareholding, and clear profit distribution among co-founders.</p></article>
                    <article class="plc-needs-card"><h3>Freelancers and Service Providers</h3><p>Allows independent professionals to operate under a recognised corporate entity for better client trust.</p></article>
                    <article class="plc-needs-card"><h3>Professionals Pursuing Institutional Work</h3><p>Supports formal contracts, government tenders, and enterprise client relationships that require a registered company.</p></article>
                </div>
            </div>
        </section>

        <?php
        $caaft_benefits_heading_id = 'plc-why-biz-heading';
        $caaft_benefits_title = 'Why Businesses Choose Private Limited Company Registration';
        $caaft_benefits_intro = 'Founders and promoters choose Private Limited Company registration when they need a credible, legally protected structure that supports growth without exposing personal assets. Key reasons include:';
        $caaft_benefits_items = [
            [
                'lead' => 'Investor-ready structure',
                'text' => 'Angel investors and VCs require a Pvt Ltd structure before committing capital — making it the strongest investor-ready choice.',
                'icon_class' => 'fas fa-chart-line',
                'tone' => 'green',
            ],
            [
                'lead' => 'Limited liability protection',
                'text' => 'The structure clearly separates personal and business liability — founders do not bear personal responsibility for company debts.',
                'icon_class' => 'fas fa-shield-alt',
                'tone' => 'violet',
            ],
            [
                'lead' => 'Separate legal identity',
                'text' => 'A defined legal identity enables the company to sign contracts, enter agreements, and build institutional relationships.',
                'icon_class' => 'fas fa-file-contract',
                'tone' => 'amber',
            ],
            [
                'lead' => 'Structured shareholding',
                'text' => 'A structured shareholding framework supports equity distribution, vesting schedules, and co-founder arrangements.',
                'icon_class' => 'fas fa-users-cog',
                'tone' => 'blue',
            ],
            [
                'lead' => 'Bank and lender confidence',
                'text' => 'Banks and lenders extend credit more readily to registered private limited companies.',
                'icon_class' => 'fas fa-university',
                'tone' => 'pink',
            ],
            [
                'lead' => 'Tenders and enterprise clients',
                'text' => 'Government bodies and enterprise clients require a registered company for tenders and formal procurement.',
                'icon_class' => 'fas fa-landmark',
                'tone' => 'teal',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-benefits.php';
        ?>

        <section class="plc-legal-wrap" aria-labelledby="plc-legal-heading">
            <div class="container">
                <h2 id="plc-legal-heading" class="plc-section-h2">Legal Requirements for Private Limited Company Registration</h2>
                <p class="plc-section-lead">Specific statutory conditions must be satisfied before incorporation can proceed:</p>
                <div class="plc-legal-grid" role="list">
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">01</span>
                        <h3>Minimum Directors</h3>
                        <p>The company must appoint at least two directors — one of whom must be an Indian resident. Every director must hold a valid Director Identification Number (DIN). The structure permits a maximum of fifteen directors.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">02</span>
                        <h3>Minimum Shareholders</h3>
                        <p>The company must have at least two shareholders at the time of incorporation. The structure caps shareholders at a maximum of 200 — a defining restriction of the private company framework.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">03</span>
                        <h3>Registered Office Address</h3>
                        <p>The company must maintain a valid Indian address for official correspondence, legal notices, and all regulatory filings with the Registrar of Companies (ROC).</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">04</span>
                        <h3>Company Name Approval</h3>
                        <p>The proposed name must comply with MCA naming guidelines and must not resemble any existing registered company or protected trademark. The name must carry &quot;Private Limited&quot; as a suffix.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">05</span>
                        <h3>Capital Structure</h3>
                        <p>The Companies Act, 2013 sets no minimum paid-up capital requirement. The incorporation documents must define the authorised capital — with the government levying fees based on the declared authorised capital amount.</p>
                    </article>
                </div>
            </div>
        </section>

        <?php
        $caaft_benefits_heading_id = 'plc-types-heading';
        $caaft_benefits_title = 'Types of Private Limited Company';
        $caaft_benefits_intro = '';
        $caaft_benefits_items = [
            [
                'lead' => 'Company Limited by Shares',
                'text' => 'The most common form. The Articles of Association restrict shareholder liability to the unpaid value of shares held. Startups, SMEs, and mainstream businesses widely use this structure.',
                'icon_class' => 'fas fa-chart-pie',
                'tone' => 'green',
            ],
            [
                'lead' => 'Company Limited by Guarantee',
                'text' => 'Members commit to a predetermined guarantee amount in place of share capital. Non-profit organisations, charitable bodies, and professional associations primarily adopt this form.',
                'icon_class' => 'fas fa-hands-helping',
                'tone' => 'violet',
            ],
            [
                'lead' => 'Unlimited Company',
                'text' => 'Members carry no cap on liability. Businesses rarely use this form — it applies only in specific financial or trust-related structures that require unlimited member liability.',
                'icon_class' => 'fas fa-expand-arrows-alt',
                'tone' => 'amber',
            ],
            [
                'lead' => 'One Person Company (OPC)',
                'text' => 'A single Indian resident incorporates and operates the company with full limited liability protection. This structure sits within the private company framework under the Companies Act, 2013.',
                'icon_class' => 'fas fa-user',
                'tone' => 'blue',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-benefits.php';
        ?>

        <?php
        $caaft_delivered_heading_id = 'plc-delivered-heading';
        $caaft_delivered_title = 'Private Limited Company Registration Services — What Gets Delivered';
        $caaft_delivered_items = [
            ['name' => 'Name reservation and approval', 'text' => 'CAAFT reserves the company name through MCA in compliance with naming guidelines — confirming no conflict with existing registrations or trademarks before any filing begins.'],
            ['name' => 'Digital Signature Certificate (DSC) procurement', 'text' => 'DSCs are obtained for all proposed directors — a mandatory requirement for all online filings with the ROC and MCA portal.'],
            ['name' => 'Director Identification Number (DIN) application', 'text' => 'DINs are applied for all directors who do not already hold one — a prerequisite before the incorporation application moves forward.'],
            ['name' => 'Drafting of MOA and AOA', 'text' => 'The Memorandum of Association and Articles of Association are prepared to precisely represent the business goals, ownership structure, and internal governance regulations.'],
            ['name' => 'ROC filing and incorporation', 'text' => 'Incorporation forms and all supporting documents are filed with the Registrar of Companies — accurately, completely, and within prescribed timelines.'],
            ['name' => 'Certificate of Incorporation', 'text' => 'The official Certificate of Incorporation is obtained after ROC verification — confirming the company\'s legal existence along with the allotted CIN (Corporate Identity Number).'],
            ['name' => 'Post-incorporation compliance setup', 'text' => 'Statutory registers, first board meeting structure, annual filing calendar, and compliance framework are established from day one to prevent defaults.'],
        ];
        include __DIR__ . '/../../includes/components/caaft-get-delivered.php';
        ?>

        <?php
        $caaft_steps_heading_id = 'plc-steps-heading';
        $caaft_steps_title = 'Step-by-Step Process';
        $caaft_steps_numbered = true;
        $caaft_steps_items = [
            ['title' => 'Document and Information Collection', 'text' => 'All identity, address, and contact details of proposed directors and shareholders are collected and verified before any filing begins. Accuracy at this stage prevents rejections and delays downstream.'],
            ['title' => 'Digital Signature Certificate (DSC) Procurement', 'text' => 'DSCs are obtained for all proposed directors — a mandatory requirement for every online submission on the MCA portal.'],
            ['title' => 'Director Identification Number (DIN) Application', 'text' => 'DINs are applied for all directors who do not already hold one — a required step before the incorporation application can be filed.'],
            ['title' => 'Company Name Reservation', 'text' => 'A unique company name is reserved through the MCA portal — verified against existing registrations and trademarks to secure approval without objection.'],
            ['title' => 'MOA & AOA Drafting', 'text' => 'The Memorandum of Association and Articles of Association are drafted — accurately defining business objectives, share transfer restrictions, governance structure, and shareholder rights.'],
            ['title' => 'ROC Filing', 'text' => 'Incorporation forms and all supporting documents are filed with the Registrar of Companies — every field verified and every attachment confirmed before submission.'],
            ['title' => 'Certificate of Incorporation', 'text' => 'The ROC issues the Certificate of Incorporation after successful verification — officially confirming the company\'s legal existence, registration number, and PAN.'],
        ];
        include __DIR__ . '/../../includes/components/caaft-step-by-step.php';
        ?>

        <section class="plc-docs-section" aria-labelledby="plc-docs-heading">
            <div class="container">
                <h2 id="plc-docs-heading" class="plc-docs-title">Documents Required for Private Limited Company Registration</h2>
                <div class="plc-docs-cards-grid">
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--violet" aria-hidden="true"><i class="fas fa-user"></i></span>
                            <h3>Directors &amp; Shareholders</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>PAN Card of all directors and shareholders</li>
                            <li>Aadhaar Card, Passport, or Voter ID as identity proof</li>
                            <li>Bank statement or utility bill (not older than two months) as address proof</li>
                            <li>Passport-size photograph of each director and shareholder</li>
                            <li>Email ID and mobile number for official communication and OTP verification</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--green" aria-hidden="true"><i class="fas fa-check"></i></span>
                            <h3>Company Documents</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Memorandum of Association (MOA) defining the business objectives and scope</li>
                            <li>Articles of Association (AOA) outlining internal governance, shareholding rules, and meeting procedures</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--amber" aria-hidden="true"><i class="fas fa-building"></i></span>
                            <h3>Registered Office</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Utility bill (electricity or water) for address confirmation</li>
                            <li>Rent Agreement or Sale Deed as ownership or tenancy proof</li>
                            <li>No Objection Certificate (NOC) from the property owner if premises are rented</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--blue" aria-hidden="true"><i class="fas fa-file-alt"></i></span>
                            <h3>Statutory &amp; Digital Requirements</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Director Consent and Declaration confirming legal eligibility and compliance readiness</li>
                            <li>Digital Signature Certificate (DSC) for online filing authentication on the MCA portal</li>
                            <li>Director Identification Number (DIN) for director identity verification with the ROC</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <?php
        $caaft_llc_heading_id = 'plc-post-heading';
        $caaft_llc_title = 'Post-Registration Compliance for Private Limited Companies';
        $caaft_llc_lead = 'Compliance obligations begin immediately after incorporation and continue throughout the company\'s existence:';
        $caaft_llc_items = [
            [
                'label' => 'Annual financial filings with the ROC',
                'text' => 'Audited financial statements, Annual Return (MGT-7), and Board Report must be filed within prescribed due dates every year.',
            ],
            [
                'label' => 'Statutory audit',
                'text' => 'A qualified Chartered Accountant must conduct the audit at the close of every financial year, regardless of turnover.',
            ],
            [
                'label' => 'Board meetings',
                'text' => 'The company must hold a minimum of two board meetings per year — with no gap exceeding 120 days — maintaining proper notice, agenda, and minutes for each.',
            ],
            [
                'label' => 'Annual General Meeting (AGM)',
                'text' => 'The company must conduct the AGM within six months of the close of each financial year.',
            ],
            [
                'label' => 'Maintenance of statutory registers',
                'text' => 'The company must keep updated registers of members, directors, charges, related party transactions, and share transfers.',
            ],
            [
                'label' => 'Income Tax Return filing',
                'text' => 'The company must file returns annually — meeting applicable advance tax, TDS, and GST obligations based on business activity.',
            ],
            [
                'label' => 'Event-based filings',
                'text' => 'Any change to directors, registered office, share capital, or company structure triggers mandatory ROC filings.',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-labeled-list-card.php';
        ?>

        <?php
        $caaft_llc_heading_id = 'plc-adv-heading';
        $caaft_llc_title = 'Advantages of a Private Limited Company';
        $caaft_llc_lead = '';
        $caaft_llc_section_class = 'caaft-labeled-list-card-section caaft-labeled-list-card-section--tint py-90';
        $caaft_llc_items = [
            [
                'label' => 'Limited liability',
                'text' => 'Shareholder liability stays limited to invested capital — personal assets remain fully protected from business debts and obligations.',
            ],
            [
                'label' => 'Separate legal identity',
                'text' => 'The company holds a separate legal identity — enabling it to own assets, sign contracts, and pursue legal action independently of its founders.',
            ],
            [
                'label' => 'Equity investment readiness',
                'text' => 'The structure positions the business for equity investment — angel investors, venture capital firms, and institutions consistently prefer the Pvt Ltd format.',
            ],
            [
                'label' => 'Corporate credibility',
                'text' => 'Corporate credibility improves with banks, enterprise clients, and government entities — supporting contracts, credit facilities, and procurement opportunities.',
            ],
            [
                'label' => 'Structured equity distribution',
                'text' => 'Structured equity distribution becomes possible — covering co-founder arrangements, investor shareholding, and employee stock options (ESOPs).',
            ],
            [
                'label' => 'Perpetual succession',
                'text' => 'Perpetual succession ensures the company continues operating regardless of changes in directors, shareholders, or ownership.',
            ],
            [
                'label' => 'Long-term planning and exit',
                'text' => 'The structure provides a recognised foundation for long-term business planning, expansion, and eventual restructuring or exit.',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-labeled-list-card.php';
        ?>

        <?php
        $caaft_challenges_heading_id = 'plc-challenges-heading';
        $caaft_challenges_title = 'Common Challenges in Private Limited Company Registration CAAFT Solves';
        $caaft_challenges_intro = 'Most founders seek professional support for Private Limited Company registration when they encounter one or more of these situations:';
        $caaft_challenges_items = [
            'Uncertainty about whether a Private Limited Company, LLP, or OPC suits the current business stage and funding goals',
            'Name reservation rejections arising from similarity with existing company names or trademark conflicts',
            'Incorrectly or incompletely drafted MOA and AOA that create operational, governance, or investor-related problems post-incorporation',
            'DIN or DSC procurement delays that stall the entire incorporation timeline',
            'ROC filing errors that trigger rejections, resubmission requests, or compliance flags',
            'No compliance framework established after incorporation — resulting in missed filings, late fees, and ROC notices',
            'Founders proceeding without addressing co-founder agreements, vesting schedules, and shareholder rights at incorporation — issues that become far more complex and costly to resolve after the business grows',
        ];
        $caaft_challenges_outro = 'CAAFT\'s structured approach resolves each of these — delivering accurate, compliant Private Limited Company registrations with the governance and compliance foundation properly in place from day one.';
        include __DIR__ . '/../../includes/components/caaft-challenges.php';
        ?>

        <?php
        $why_choose_caaft_heading_id = 'plc-why-caaft-heading';
        $why_choose_caaft_title = 'Why Choose CAAFT';
        $why_choose_caaft_show_intro = true;
        $why_choose_caaft_link_desc = true;
        $why_choose_caaft_intro = 'Founders and growing businesses rely on CAAFT for Pvt Ltd incorporation that is filing-accurate, timeline-clear, and backed by ongoing statutory support.';
        $why_choose_caaft_section_class = 'why-choose-caaft py-90';
        $why_choose_caaft_items = [
            [
                'icon_class' => 'fas fa-briefcase',
                'title' => 'End-to-end incorporation expertise',
                'text' => 'Qualified professionals manage every step of the private limited company formation process — from name approval and DSC procurement to ROC filing and Certificate of Incorporation — with precision and accountability.',
            ],
            [
                'icon_class' => 'fas fa-balance-scale',
                'title' => 'Regulatory compliance at every stage',
                'text' => 'Private limited companies carry ongoing statutory obligations under the Companies Act, 2013, Income Tax Act, and applicable GST provisions. CAAFT ensures the company meets every compliance requirement from the point of incorporation onwards.',
            ],
            [
                'icon_class' => 'fas fa-user-tie',
                'title' => 'Dedicated professionals — not junior staff',
                'text' => 'Experienced Chartered Accountants and legal professionals handle every client engagement — professionals who understand the nuances, obligations, and long-term implications that come with the private company structure.',
            ],
            [
                'icon_class' => 'fas fa-file-invoice-dollar',
                'title' => 'Transparent pricing and clear timelines',
                'text' => 'No surprise charges. No vague timelines. Clients receive a structured roadmap covering every filing, approval, and compliance milestone — so the incorporation status stays clear at every stage.',
            ],
            [
                'icon_class' => 'fas fa-handshake',
                'title' => 'Beyond incorporation — a long-term compliance partner',
                'text' => 'The engagement does not end at registration. From board meeting compliance and annual ROC filings to shareholder documentation and audit coordination — CAAFT supports the business as it scales.',
            ],
        ];
        include __DIR__ . '/../../includes/components/why-choose-caaft.php';
        ?>

        <?php
        $caaft_key_facts_heading_id = 'plc-facts-heading';
        $caaft_key_facts_title = 'Key Facts & Figures';
        $caaft_key_facts_items = [
            [
                'stat' => '28+ lakh',
                'text' => 'companies registered in India by early 2026 — Private Limited Companies account for the majority of active incorporations',
            ],
            [
                'stat' => '29%',
                'text' => 'YoY growth in new incorporations — SPICe+ cuts registration timelines to as few as 7 business days',
            ],
            [
                'stat' => '5.57 lakh',
                'text' => 'companies in Maharashtra — followed by Delhi, Karnataka, and Tamil Nadu as India\'s top incorporation hubs',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-key-facts.php';
        ?>

        <?php
        $caaft_cta_section_id = 'get-in-touch';
        $caaft_cta_heading_id = 'plc-cta-heading';
        $caaft_cta_title = 'Register a Private Limited Company Today';
        $caaft_cta_text = 'Private Limited Company registration builds the legal foundation for credible operations, investor-ready governance, and long-term business growth — whether the goal is raising early-stage funding, securing enterprise contracts, or establishing a structured corporate entity. CAAFT delivers accurate, compliant incorporation with the compliance framework properly established from day one.';
        $caaft_cta_button_label = 'Start & Scale Your Business Now';
        $caaft_cta_button_href = '/contact#contact_us';
        include __DIR__ . '/../../includes/components/caaft-cta.php';
        ?>

        <?php
        $caaft_faq_heading_id = 'plc-faq-heading';
        $caaft_faq_title = 'Frequently Asked Questions';
        $caaft_faq_accordion_id = 'accordionPlcFaq';
        $caaft_faq_prefix = 'plcFaq';
        $caaft_faq_items = [
            [
                'question' => 'Can a Private Limited Company be converted into a Public Limited Company later?',
                'answer' => 'Yes. The Companies Act, 2013 permits conversion from Private to Public Limited — but the process requires amendments to the MOA and AOA, shareholder and board approvals, ROC filings, and compliance with the minimum director and shareholder thresholds applicable to public companies. Structuring the company with this possibility in mind from the start avoids costly restructuring later.',
            ],
            [
                'question' => 'Is a Company Secretary mandatory for a Private Limited Company immediately after incorporation?',
                'answer' => 'Not immediately for all companies. The Companies Act mandates a full-time Company Secretary only when a Private Limited Company\'s paid-up share capital reaches ₹5 crore or above. However, certain ROC filings and certifications still require a practising Company Secretary — making early engagement with a CS advisable regardless of capital size.',
            ],
            [
                'question' => 'What happens to a Private Limited Company if one of its two directors resigns?',
                'answer' => 'The Companies Act requires a Private Limited Company to maintain at least two directors at all times. If the number drops below this threshold, the company must appoint a replacement director within the prescribed timeline — failing which it faces compliance defaults. Every directorship change requires timely ROC filings through Form DIR-12.',
            ],
            [
                'question' => 'Can foreign nationals or NRIs serve as directors or shareholders in an Indian Private Limited Company?',
                'answer' => 'Yes. Foreign nationals and NRIs can hold shares or serve as directors in an Indian Private Limited Company — subject to FEMA regulations, RBI guidelines, and applicable FDI sectoral caps. The structure must include at least one Indian resident director at all times. Certain sectors restrict or prohibit foreign ownership entirely, requiring a sector-specific assessment before incorporation.',
            ],
            [
                'question' => 'Does a Private Limited Company need GST registration separately from company incorporation?',
                'answer' => 'Yes. GST registration is a separate statutory obligation — the company incorporation process does not cover it. GST registration becomes mandatory once turnover crosses the applicable threshold, or immediately when the business involves inter-state supply of goods or services, e-commerce, or other notified activities. Businesses should typically complete GST registration within the first weeks of commencing operations.',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-faq.php';
        ?>

    </main>
    <?php include "footer.php"; ?>
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <?php include "footer-bottom.php"; ?>
</body>
</html>
