<?php
declare(strict_types=1);
$plcRequestPath = trim((string) (parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''), '/');
$plcCanonicalSlug = 'public-limited-company-registration';
$plcLegacyPaths = [
    'company-incorporation/public-limited-company',
    'public-limited-company',
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
    <title>Public Limited Company Registration in India for Large-Scale Business Growth</title>
    <meta name="description" content="Public Limited Company registration in India for enterprises seeking public funding, compliance-led governance, and scalable growth.">
    <meta name="keywords" content="Public Limited Company, Public Limited Company Registration, PLC registration India, public company incorporation, ROC filing">
    <link rel="canonical" href="https://caaft.com/public-limited-company-registration/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Public Limited Company Registration in India for Large-Scale Business Growth">
    <meta property="og:description" content="Public Limited Company registration in India for enterprises seeking public funding, compliance-led governance, and scalable growth.">
    <meta property="og:url" content="https://caaft.com/public-limited-company-registration/">
    <meta property="og:site_name" content="CAAFT Consultancy Services">
    <meta property="og:image" content="https://caaft.com/assets/img/gst-registration-overview.jpg">
    <style>
        .page-public-limited-registration .caaft-ar-trust-indicators { background: #ffffff !important; }
        .page-public-limited-registration .bk-overview .bk-section-title {
            margin: 0 0 1.75rem;
            text-align: left;
        }
        .page-public-limited-registration .bk-overview .bk-overview-text {
            margin: 0 0 1.75rem;
            text-align: left;
            font-size: 1.02rem;
            line-height: 1.6;
            color: #2f2f2f;
        }
        .page-public-limited-registration .bk-overview .bk-overview-bullets {
            margin: 0 0 1.75rem;
            color: #2f2f2f;
        }
        .page-public-limited-registration .bk-overview-layout {
            align-items: center;
        }
        .page-public-limited-registration .bk-overview-image-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            align-self: center;
        }
        .page-public-limited-registration .bk-overview-image-wrap img {
            object-fit: contain;
            width: 100%;
            max-height: min(340px, 50vh);
            height: auto;
        }
        .page-public-limited-registration .plc-section-lead {
            margin: 0 0 1rem;
            color: #4d5868;
            line-height: 1.68;
            max-width: 900px;
        }
        .page-public-limited-registration .plc-needs-wrap {
            padding-top: 44px;
            padding-bottom: 44px;
        }
        .page-public-limited-registration .plc-needs-title,
        .page-public-limited-registration .plc-section-h2 {
            margin: 0 0 10px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-public-limited-registration .plc-needs-intro {
            margin: 0 0 20px;
            max-width: 900px;
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.65;
            font-weight: 500;
        }
        .page-public-limited-registration .plc-needs-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 20px;
            margin-top: 0;
        }
        .page-public-limited-registration .plc-needs-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-left: 4px solid var(--theme-color, #33b6ff);
            border-radius: 8px;
            padding: 18px 20px 18px 22px;
            box-shadow: none;
        }
        .page-public-limited-registration .plc-needs-card h3 {
            margin: 0 0 10px;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2c40;
            line-height: 1.35;
        }
        .page-public-limited-registration .plc-needs-card p {
            margin: 0;
            font-size: 0.97rem;
            line-height: 1.62;
            color: #6b7280;
        }
        .page-public-limited-registration .plc-bullet-list {
            margin: 12px 0 0;
            padding-left: 1.25rem;
            color: #2f3948;
            line-height: 1.65;
        }
        .page-public-limited-registration .plc-bullet-list li {
            margin-bottom: 8px;
        }
        .page-public-limited-registration .plc-legal-wrap {
            background: #f0f7ff;
            padding-top: 48px;
            padding-bottom: 48px;
        }
        .page-public-limited-registration .plc-legal-wrap .plc-section-h2 {
            margin-bottom: 10px;
        }
        .page-public-limited-registration .plc-legal-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 18px;
        }
        .page-public-limited-registration .plc-legal-card {
            position: relative;
            background: #ffffff;
            border-radius: 12px;
            padding: 22px 22px 24px;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.07);
            border: 1px solid rgba(226, 232, 240, 0.9);
            overflow: hidden;
            min-height: 0;
        }
        .page-public-limited-registration .plc-legal-card-num {
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
        .page-public-limited-registration .plc-legal-card h3 {
            position: relative;
            margin: 0 0 12px;
            padding-right: 4.5rem;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.35;
        }
        .page-public-limited-registration .plc-legal-card p {
            position: relative;
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.65;
            color: #4a5568;
            font-weight: 500;
        }
        .page-public-limited-registration .plc-docs-section {
            padding-top: 44px;
            padding-bottom: 44px;
            background: #ffffff;
        }
        .page-public-limited-registration .plc-docs-section .plc-docs-title {
            margin: 0 0 22px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-public-limited-registration .plc-docs-cards-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            align-items: stretch;
        }
        .page-public-limited-registration .plc-docs-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 22px 22px 20px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }
        .page-public-limited-registration .plc-docs-card-head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 14px;
            margin-bottom: 14px;
            border-bottom: 1px solid #e8edf2;
        }
        .page-public-limited-registration .plc-docs-card-icon {
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
        .page-public-limited-registration .plc-docs-card-icon--violet {
            background: #7c3aed;
        }
        .page-public-limited-registration .plc-docs-card-icon--green {
            background: #10b981;
        }
        .page-public-limited-registration .plc-docs-card-icon--amber {
            background: #f59e0b;
        }
        .page-public-limited-registration .plc-docs-card-icon--blue {
            background: #3b82f6;
        }
        .page-public-limited-registration .plc-docs-card h3 {
            margin: 0;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.35;
        }
        .page-public-limited-registration .plc-docs-card-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .page-public-limited-registration .plc-docs-card-list li {
            position: relative;
            padding: 6px 0 6px 0;
            font-size: 0.97rem;
            line-height: 1.55;
            font-weight: 500;
            color: #4a5568;
        }
        .page-public-limited-registration .plc-docs-card-list li + li {
            margin-top: 2px;
        }
        @media (max-width: 991.98px) {
            .page-public-limited-registration .plc-needs-grid {
                grid-template-columns: 1fr;
            }
            .page-public-limited-registration .plc-legal-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 767.98px) {
            .page-public-limited-registration .plc-docs-cards-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 575.98px) {
            .page-public-limited-registration .plc-legal-grid {
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
          "@id": "https://caaft.com/public-limited-company-registration/#service",
          "name": "Public Limited Company Registration",
          "alternateName": "Public Limited Company Registration Services India",
          "url": "https://caaft.com/public-limited-company-registration/",
          "description": "End-to-end Public Limited Company registration services in India including documentation, compliance, incorporation, and advisory support for large-scale business growth.",
          "provider": { "@id": "https://caaft.com/#organization" },
          "areaServed": { "@type": "Country", "name": "India" },
          "serviceType": "Company Registration and Compliance Services",
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Public Limited Company Services",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Public Limited Company Registration", "description": "Complete incorporation support including name approval, DIN, DSC, MOA, AOA, and ROC filing." } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Compliance and Regulatory Advisory", "description": "Guidance on post-incorporation compliance, governance, and regulatory requirements." } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Documentation and Filing Support", "description": "Preparation and submission of all statutory documents required for incorporation." } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Post Registration Compliance", "description": "Ongoing support for filings, audits, board meetings, and statutory compliance." } }
            ]
          }
        },
        {
          "@type": "FAQPage",
          "@id": "https://caaft.com/public-limited-company-registration/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "Does registering as a Public Limited Company mean the business must list on a stock exchange immediately?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "No. A Public Limited Company can remain unlisted and still raise capital from a wider investor pool. Listing on BSE or NSE is a separate decision that happens only when the company actively pursues an IPO through the SEBI regulatory process — which can occur years after initial incorporation."
              }
            },
            {
              "@type": "Question",
              "name": "How does Public Limited Company registration affect a promoter's control over the business?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "As shareholding widens and shares become freely transferable, promoter dilution becomes a real consideration. Founders should establish voting rights protections, board composition safeguards, and shareholder agreements before registering — not after growth makes restructuring complicated and costly."
              }
            },
            {
              "@type": "Question",
              "name": "Can a Public Limited Company offer ESOPs more effectively than a Private Limited Company?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Fewer restrictions on ESOP issuance and the freely transferable nature of shares make ESOPs genuinely attractive to employees — because there is a realistic liquidity pathway, rather than an indefinite wait for a buyout or secondary transaction."
              }
            },
            {
              "@type": "Question",
              "name": "What compliance burden should a business realistically expect after Public Limited Company incorporation?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "It is significant. Beyond ROC filings, businesses should expect mandatory statutory audits, a qualified Company Secretary, public financial disclosures, and SEBI obligations if listed. Dedicated compliance infrastructure must be budgeted before the switch to this structure — not after operational pressures mount."
              }
            },
            {
              "@type": "Question",
              "name": "Is a Public Limited Company suitable for a family business planning generational succession?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "It can be — but free share transferability can dilute family control over time. Promoter families often use holding companies or preference shares with special voting rights to retain strategic control while still accessing public capital. This structure must be planned and documented at incorporation — retrofitting it later is significantly more complex and costly."
              }
            }
          ]
        },
        {
          "@type": "BreadcrumbList",
          "@id": "https://caaft.com/public-limited-company-registration/#breadcrumb",
          "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://caaft.com" },
            { "@type": "ListItem", "position": 2, "name": "Public Limited Company Registration", "item": "https://caaft.com/public-limited-company-registration/" }
          ]
        }
      ]
    }
    </script>
</head>
<body class="home-3 page-accounting-reporting page-public-limited-registration">
<?php include dirname(__DIR__, 2) . '/includes/gtm-noscript.php'; ?>
    <div class="header-sections"><?php include "header.php"; ?></div>
    <main class="main">
        <?php
        $caaft_hero_id = 'pub-h1';
        $caaft_hero_h1 = 'Public Limited Company Registration Services';
        $caaft_hero_h2_before = 'From Incorporation to Long-Term Compliance — ';
        $caaft_hero_h2_highlight = 'Complete Public Limited Company Support.';
        $caaft_hero_h2_after = '';
        $caaft_hero_lead_paragraphs = [
            'A Public Limited Company enables large-scale operations, public capital raising, and strong corporate credibility — with a governance structure built to support long-term expansion.',
            'This business structure allows shares to be offered to the general public and traded on stock exchanges, provides limited liability to shareholders, and operates under the structured governance and disclosure standards of the Companies Act, 2013. CAAFT delivers end-to-end Public Limited Company registration and compliance support — from name approval and ROC filing through to post-incorporation statutory management.',
        ];
        $caaft_hero_primary_cta_label = 'Consult a Registration Expert';
        $caaft_hero_primary_cta_href = '/contact';
        $caaft_hero_secondary_cta_icon = 'fas fa-arrow-right';
        $caaft_enquiry_service = 'Public Limited Company Registration';
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
        $caaft_overview_heading_id = 'pub-what-heading';
        $caaft_overview_title = 'What Is a Public Limited Company?';
        $caaft_overview_paragraphs = [
            'A Public Limited Company (PLC) is a legally registered business entity incorporated under the Companies Act, 2013 in India — with the ability to offer shares to the public and list them on recognised stock exchanges, subject to regulatory approvals.',
            'Key characteristics of a Public Limited Company:',
        ];
        $caaft_overview_bullets = [
            'Shares can be offered to the general public and traded on stock exchanges',
            'Shareholders are liable only to the extent of their shareholding — personal assets remain protected',
            'The company has an independent legal identity separate from its promoters and directors',
            'Governed by strict disclosure, governance, and compliance standards under Indian company law',
            'Suitable for enterprises planning public investment, institutional funding, and long-term large-scale expansion',
        ];
        $caaft_overview_closing = '';
        $caaft_overview_image_src = '/assets/img/gst-registration-overview.jpg';
        $caaft_overview_image_alt = 'Public limited company incorporation and large-scale business registration support';
        include __DIR__ . '/../../includes/components/caaft-overview-card.php';
        ?>

        <section class="plc-needs-wrap" aria-labelledby="pub-needs-heading">
            <div class="container">
                <h2 id="pub-needs-heading" class="plc-needs-title">Who Needs Public Limited Company Registration?</h2>
                <p class="plc-needs-intro">Public Limited Company registration is relevant for businesses and promoters in specific situations:</p>
                <div class="plc-needs-grid">
                    <article class="plc-needs-card"><h3>Large enterprises</h3><p>Seeking to raise capital from public investors or institutional sources.</p></article>
                    <article class="plc-needs-card"><h3>IPO or stock exchange listing</h3><p>Businesses planning an IPO or eventual listing on NSE or BSE.</p></article>
                    <article class="plc-needs-card"><h3>Free share transferability</h3><p>Promoters requiring a structure that supports free share transferability and wide shareholding.</p></article>
                    <article class="plc-needs-card"><h3>ESOPs with liquidity</h3><p>Companies planning to offer ESOPs with genuine liquidity pathways for employees.</p></article>
                    <article class="plc-needs-card"><h3>Family businesses &amp; succession</h3><p>Structured generational succession with external investor participation.</p></article>
                    <article class="plc-needs-card"><h3>Enterprise credibility at scale</h3><p>Requiring enhanced corporate credibility for large contracts, institutional partnerships, or bank financing.</p></article>
                </div>
            </div>
        </section>

        <?php
        $caaft_benefits_heading_id = 'pub-why-biz-heading';
        $caaft_benefits_title = 'Why Businesses Choose Public Limited Company Registration';
        $caaft_benefits_intro = 'Enterprises select Public Limited Company registration when long-term expansion requires structured governance and significant capital investment. Major reasons include:';
        $caaft_benefits_items = [
            [
                'lead' => 'Public funding access',
                'text' => 'Access to public funding markets and a wider investor base.',
                'icon_class' => 'fas fa-chart-line',
                'tone' => 'green',
            ],
            [
                'lead' => 'Corporate credibility',
                'text' => 'Improved corporate credibility with banks, institutions, and large enterprise clients.',
                'icon_class' => 'fas fa-building',
                'tone' => 'violet',
            ],
            [
                'lead' => 'Share transferability',
                'text' => 'Easier share transferability compared to private company structures.',
                'icon_class' => 'fas fa-exchange-alt',
                'tone' => 'amber',
            ],
            [
                'lead' => 'Brand trust & visibility',
                'text' => 'Enhanced brand trust and market visibility at scale.',
                'icon_class' => 'fas fa-bullhorn',
                'tone' => 'blue',
            ],
            [
                'lead' => 'Credit & financing',
                'text' => 'Greater access to bank loans, institutional credit, and structured financing.',
                'icon_class' => 'fas fa-university',
                'tone' => 'pink',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-benefits.php';
        ?>

        <section class="plc-legal-wrap" aria-labelledby="pub-legal-heading">
            <div class="container">
                <h2 id="pub-legal-heading" class="plc-section-h2">Legal Requirements for Public Limited Company Registration</h2>
                <p class="plc-section-lead">Registration involves specific statutory conditions designed to ensure governance stability and investor protection:</p>
                <div class="plc-legal-grid" role="list">
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">01</span>
                        <h3>Minimum Directors</h3>
                        <p>At least three directors are mandatory — with one director required to be an Indian resident. Each director must hold a Director Identification Number (DIN).</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">02</span>
                        <h3>Minimum Shareholders</h3>
                        <p>A minimum of seven shareholders is required at the time of incorporation. There is no upper limit on the number of shareholders.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">03</span>
                        <h3>Registered Office Address</h3>
                        <p>A valid Indian address is compulsory for official communication, legal notices, and regulatory filings with the ROC.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">04</span>
                        <h3>Company Name Approval</h3>
                        <p>The proposed name must follow MCA naming guidelines and must not resemble any existing registered company or trademark.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">05</span>
                        <h3>Capital Structure</h3>
                        <p>No minimum paid-up capital requirement currently exists under the Companies Act, 2013. Authorised capital must be defined in the incorporation documents.</p>
                    </article>
                </div>
            </div>
        </section>

        <?php
        $caaft_benefits_heading_id = 'pub-types-heading';
        $caaft_benefits_title = 'Types of Public Limited Company';
        $caaft_benefits_intro = '';
        $caaft_benefits_items = [
            [
                'lead' => 'Listed Public Companies',
                'text' => 'Shares are traded on stock exchanges such as NSE or BSE. Must comply fully with SEBI regulations and ongoing disclosure norms.',
                'icon_class' => 'fas fa-chart-line',
                'tone' => 'green',
            ],
            [
                'lead' => 'Unlisted Public Companies',
                'text' => 'Not listed on exchanges but structured as public entities. Can offer shares to a wider investor pool with fewer listing obligations.',
                'icon_class' => 'fas fa-layer-group',
                'tone' => 'violet',
            ],
            [
                'lead' => 'Public Company Limited by Shares',
                'text' => 'Standard form where shareholder liability is limited to the unpaid value of shares held.',
                'icon_class' => 'fas fa-chart-pie',
                'tone' => 'amber',
            ],
            [
                'lead' => 'Public Company Limited by Guarantee',
                'text' => 'Liability is limited by a guarantee amount rather than share capital. Primarily used by non-profit or charitable organisations.',
                'icon_class' => 'fas fa-hands-helping',
                'tone' => 'blue',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-benefits.php';
        ?>

        <?php
        $caaft_delivered_heading_id = 'pub-delivered-heading';
        $caaft_delivered_title = 'Public Limited Company Registration Services — What Gets Delivered';
        $caaft_delivered_items = [
            ['name' => 'Name reservation and approval', 'text' => 'Company name reserved through MCA in compliance with naming guidelines, ensuring no conflicts with existing registrations or trademarks.'],
            ['name' => 'Digital Signature Certificate (DSC) procurement', 'text' => 'DSCs obtained for all proposed directors — required for all online filings with the ROC and MCA portal.'],
            ['name' => 'Director Identification Number (DIN) application', 'text' => 'DINs applied for all directors who do not already hold one.'],
            ['name' => 'MOA & AOA drafting', 'text' => 'Memorandum of Association and Articles of Association drafted to accurately reflect business objectives and internal governance rules.'],
            ['name' => 'ROC filing and incorporation', 'text' => 'Incorporation forms and all supporting documents filed with the Registrar of Companies accurately and within prescribed timelines.'],
            ['name' => 'Certificate of Incorporation', 'text' => 'Official Certificate of Incorporation obtained after ROC verification — confirming legal existence of the company.'],
            ['name' => 'Post-incorporation compliance setup', 'text' => 'Statutory registers, board meeting structure, annual filing calendar, and compliance framework established from day one.'],
        ];
        include __DIR__ . '/../../includes/components/caaft-get-delivered.php';
        ?>

        <?php
        $caaft_steps_heading_id = 'pub-steps-heading';
        $caaft_steps_title = 'Step-by-Step Process';
        $caaft_steps_numbered = true;
        $caaft_steps_items = [
            ['title' => 'Document and Information Collection', 'text' => 'Identity, address, and contact details of all proposed directors and shareholders are collected and verified before any filing begins.'],
            ['title' => 'Digital Signature Certificate (DSC) Procurement', 'text' => 'DSCs are obtained for all proposed directors — a mandatory requirement for all online filings on the MCA portal.'],
            ['title' => 'Director Identification Number (DIN) Application', 'text' => 'DINs are applied for all directors who do not already hold one — required before any incorporation application can be filed.'],
            ['title' => 'Company Name Reservation', 'text' => 'A unique company name is reserved through the MCA portal — verified against existing registrations and trademarks to ensure approval without objection.'],
            ['title' => 'MOA & AOA Drafting', 'text' => 'The Memorandum of Association and Articles of Association are drafted — accurately defining business objectives, governance structure, and shareholder rights.'],
            ['title' => 'ROC Filing', 'text' => 'Incorporation forms and all supporting documents are filed with the Registrar of Companies — with every field verified and every attachment confirmed before submission.'],
            ['title' => 'Certificate of Incorporation', 'text' => 'The Certificate of Incorporation is received from the ROC after successful verification — officially confirming the company\'s legal existence and registration.'],
        ];
        include __DIR__ . '/../../includes/components/caaft-step-by-step.php';
        ?>

        <section class="plc-docs-section" aria-labelledby="pub-docs-heading">
            <div class="container">
                <h2 id="pub-docs-heading" class="plc-docs-title">Documents Required for Public Limited Company Registration</h2>
                <div class="plc-docs-cards-grid">
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--violet" aria-hidden="true"><i class="fas fa-user"></i></span>
                            <h3>Directors &amp; Shareholders</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>PAN Card of all directors and shareholders</li>
                            <li>Aadhaar Card, Passport, or Voter ID as identity proof</li>
                            <li>Bank statement or utility bill as address proof</li>
                            <li>Passport-size photograph of each director and shareholder</li>
                            <li>Email ID and mobile number for official communication</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--amber" aria-hidden="true"><i class="fas fa-building"></i></span>
                            <h3>Registered Office</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Utility bill (electricity or water) for address confirmation</li>
                            <li>Rent Agreement or Sale Deed as ownership proof</li>
                            <li>No Objection Certificate (NOC) from the property owner</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--green" aria-hidden="true"><i class="fas fa-check"></i></span>
                            <h3>Company Documents</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Memorandum of Association (MOA) defining business objectives</li>
                            <li>Articles of Association (AOA) outlining internal governance rules</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--blue" aria-hidden="true"><i class="fas fa-file-alt"></i></span>
                            <h3>Statutory &amp; Digital Requirements</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Director Consent and Declaration for legal compliance confirmation</li>
                            <li>Digital Signature Certificate (DSC) for online filing authentication</li>
                            <li>Director Identification Number (DIN) for director verification</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <?php
        $caaft_llc_heading_id = 'pub-post-heading';
        $caaft_llc_title = 'Post-Registration Compliance for Public Limited Companies';
        $caaft_llc_lead = 'Compliance obligations for Public Limited Companies are ongoing and significantly more demanding than for private entities:';
        $caaft_llc_items = [
            [
                'label' => 'Annual financial filings with the ROC',
                'text' => 'Including financial statements, annual return, and board report.',
            ],
            [
                'label' => 'Statutory audits',
                'text' => 'Conducted by a qualified Chartered Accountant every financial year.',
            ],
            [
                'label' => 'Board meetings',
                'text' => 'Minimum four per year with proper notice, agenda, and minutes documentation.',
            ],
            [
                'label' => 'Shareholder meetings',
                'text' => 'Annual General Meeting (AGM) held within prescribed timelines.',
            ],
            [
                'label' => 'Maintenance of statutory registers',
                'text' => 'Including register of members, directors, charges, and related party transactions.',
            ],
            [
                'label' => 'Corporate governance compliance',
                'text' => 'Applicable governance norms under the Companies Act and, for listed companies, SEBI Listing Obligations and Disclosure Requirements (LODR).',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-labeled-list-card.php';
        ?>

        <?php
        $caaft_llc_heading_id = 'pub-adv-heading';
        $caaft_llc_title = 'Advantages of a Public Limited Company';
        $caaft_llc_lead = '';
        $caaft_llc_section_class = 'caaft-labeled-list-card-section caaft-labeled-list-card-section--tint py-90';
        $caaft_llc_items = [
            [
                'label' => 'Public capital raising',
                'text' => 'Allows raising capital from public investors through share issuance and stock market listing.',
            ],
            [
                'label' => 'Limited liability',
                'text' => 'Limits shareholder liability to invested capital — personal assets remain fully protected.',
            ],
            [
                'label' => 'Credibility & trust',
                'text' => 'Enhances business credibility and brand trust with banks, institutions, and large corporate clients.',
            ],
            [
                'label' => 'Large-scale expansion',
                'text' => 'Supports large-scale business expansion through access to structured, public, and institutional funding.',
            ],
            [
                'label' => 'Share liquidity',
                'text' => 'Enables free transfer of company shares — improving liquidity for shareholders and employees.',
            ],
            [
                'label' => 'Perpetual succession',
                'text' => 'Ensures perpetual succession of the business — the company continues regardless of changes in ownership.',
            ],
            [
                'label' => 'Financing access',
                'text' => 'Improves access to bank loans, institutional credit, and structured financing at competitive terms.',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-labeled-list-card.php';
        ?>

        <?php
        $caaft_challenges_heading_id = 'pub-challenges-heading';
        $caaft_challenges_title = 'Common Challenges in Public Limited Company Registration CAAFT Solves';
        $caaft_challenges_intro = 'Most businesses seek professional support for Public Limited Company registration when facing one or more of these:';
        $caaft_challenges_items = [
            'Uncertainty about whether a Public Limited or Private Limited structure is more appropriate for the business stage and funding goals',
            'Name reservation rejections due to similarity with existing companies or trademark conflicts',
            'Incomplete or incorrectly drafted MOA and AOA that create governance issues post-incorporation',
            'DIN or DSC procurement delays holding up the entire incorporation timeline',
            'ROC filing errors causing rejection or requests for resubmission',
            'Inadequate compliance infrastructure set up after incorporation — leading to filing defaults and ROC notices',
            'Promoters unaware of voting rights protections, ESOP structuring, and shareholder agreement requirements that should be addressed before — not after — registration',
        ];
        $caaft_challenges_outro = 'CAAFT\'s structured approach addresses each of these — delivering accurate, compliant Public Limited Company registrations with the governance and compliance foundation properly in place from day one.';
        include __DIR__ . '/../../includes/components/caaft-challenges.php';
        ?>

        <?php
        $why_choose_caaft_heading_id = 'pub-why-caaft-heading';
        $why_choose_caaft_title = 'Why Choose CAAFT';
        $why_choose_caaft_show_intro = true;
        $why_choose_caaft_link_desc = true;
        $why_choose_caaft_intro = 'Enterprises rely on CAAFT for public limited incorporation that meets MCA and governance expectations — with a compliance foundation suited to post-incorporation reporting, disclosures, and controls.';
        $why_choose_caaft_section_class = 'why-choose-caaft py-90';
        $why_choose_caaft_items = [
            [
                'icon_class' => 'fas fa-briefcase',
                'title' => 'End-to-end incorporation expertise',
                'text' => 'From name approval and ROC filing to obtaining the Certificate of Commencement — every step of the public limited company formation process is managed with precision by qualified professionals.',
            ],
            [
                'icon_class' => 'fas fa-balance-scale',
                'title' => 'Regulatory compliance at every stage',
                'text' => 'Public limited companies face stringent SEBI, MCA, and Companies Act requirements. CAAFT ensures full compliance with all statutory obligations from the point of incorporation onwards.',
            ],
            [
                'icon_class' => 'fas fa-user-tie',
                'title' => 'Dedicated professionals — not junior staff',
                'text' => 'Every client engagement is handled by experienced Chartered Accountants and legal professionals who understand the complexity and accountability that comes with public company structures.',
            ],
            [
                'icon_class' => 'fas fa-file-invoice-dollar',
                'title' => 'Transparent pricing and clear timelines',
                'text' => 'No surprise charges and no vague timelines. A structured roadmap of every filing, approval, and compliance milestone is provided — so the incorporation status is always clear.',
            ],
            [
                'icon_class' => 'fas fa-handshake',
                'title' => 'Beyond incorporation — a long-term compliance partner',
                'text' => 'Support does not end at registration. From board meeting compliance and annual filings to shareholder documentation and audit coordination — CAAFT remains available as the business scales.',
            ],
        ];
        include __DIR__ . '/../../includes/components/why-choose-caaft.php';
        ?>

        <?php
        $caaft_key_facts_heading_id = 'pub-facts-heading';
        $caaft_key_facts_title = 'Key Facts & Figures';
        $caaft_key_facts_items = [
            [
                'stat' => '28+ lakh',
                'text' => 'companies registered in India by early 2026 — with 65% (18+ lakh) actively operating nationwide, reflecting strong and growing corporate participation across sectors',
            ],
            [
                'stat' => '29%',
                'text' => 'YoY surge in new incorporations — driven by streamlined MCA processes through the SPICe+ platform, reducing registration time to as little as 7 business days',
            ],
            [
                'stat' => '5.57 lakh',
                'text' => 'registered firms in Maharashtra — reflecting a strong ecosystem for large-scale and public limited company structures in India\'s most commercially active state',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-key-facts.php';
        ?>

        <?php
        $caaft_cta_section_id = 'get-in-touch';
        $caaft_cta_heading_id = 'pub-cta-heading';
        $caaft_cta_title = 'Launch Your Public Limited Company Today';
        $caaft_cta_text = 'A Public Limited Company registration opens access to public capital, broader investor credibility, and a governance structure built for large-scale growth. Whether planning an eventual IPO, raising institutional funding, or building the corporate infrastructure for long-term expansion — CAAFT delivers accurate, compliant incorporation with the compliance foundation properly established from day one.';
        $caaft_cta_button_label = 'Start & Scale Your Business Now';
        $caaft_cta_button_href = '/contact#contact_us';
        include __DIR__ . '/../../includes/components/caaft-cta.php';
        ?>

        <?php
        $caaft_faq_heading_id = 'pub-faq-heading';
        $caaft_faq_title = 'Frequently Asked Questions';
        $caaft_faq_accordion_id = 'accordionPubPlcFaq';
        $caaft_faq_prefix = 'pubPlcFaq';
        $caaft_faq_items = [
            [
                'question' => 'Does registering as a Public Limited Company mean the business must list on a stock exchange immediately?',
                'answer' => 'No. A Public Limited Company can remain unlisted and still raise capital from a wider investor pool. Listing on BSE or NSE is a separate decision that happens only when the company actively pursues an IPO through the SEBI regulatory process — which can occur years after initial incorporation.',
            ],
            [
                'question' => 'How does Public Limited Company registration affect a promoter\'s control over the business?',
                'answer' => 'As shareholding widens and shares become freely transferable, promoter dilution becomes a real consideration. Founders should establish voting rights protections, board composition safeguards, and shareholder agreements before registering — not after growth makes restructuring complicated and costly.',
            ],
            [
                'question' => 'Can a Public Limited Company offer ESOPs more effectively than a Private Limited Company?',
                'answer' => 'Yes. Fewer restrictions on ESOP issuance and the freely transferable nature of shares make ESOPs genuinely attractive to employees — because there is a realistic liquidity pathway, rather than an indefinite wait for a buyout or secondary transaction.',
            ],
            [
                'question' => 'What compliance burden should a business realistically expect after Public Limited Company incorporation?',
                'answer' => 'It is significant. Beyond ROC filings, businesses should expect mandatory statutory audits, a qualified Company Secretary, public financial disclosures, and SEBI obligations if listed. Dedicated compliance infrastructure must be budgeted before the switch to this structure — not after operational pressures mount.',
            ],
            [
                'question' => 'Is a Public Limited Company suitable for a family business planning generational succession?',
                'answer' => 'It can be — but free share transferability can dilute family control over time. Promoter families often use holding companies or preference shares with special voting rights to retain strategic control while still accessing public capital. This structure must be planned and documented at incorporation — retrofitting it later is significantly more complex and costly.',
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
