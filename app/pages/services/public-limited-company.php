<?php
declare(strict_types=1);

$publicPath = trim((string) (parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''), '/');
if ($publicPath === 'public-limited-company') {
    $publicQs = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: /company-incorporation/public-limited-company/' . $publicQs, true, 301);
    exit;
}

$publicCanonical = 'https://caaft.com/company-incorporation/public-limited-company/';

$plcFaqSchema = [
    [
        '@type' => 'Question',
        'name' => 'Does registering as a Public Limited Company mean the business must list on a stock exchange immediately?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'No. A Public Limited Company can remain unlisted and still raise capital from a wider investor pool. Listing on BSE or NSE is a separate decision that happens only when the company actively pursues an IPO through the SEBI regulatory process — which can occur years after initial incorporation.',
        ],
    ],
    [
        '@type' => 'Question',
        'name' => 'How does Public Limited Company registration affect a promoter\'s control over the business?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'As shareholding widens and shares become freely transferable, promoter dilution becomes a real consideration. Founders should establish voting rights protections, board composition safeguards, and shareholder agreements before registering — not after growth makes restructuring complicated and costly.',
        ],
    ],
    [
        '@type' => 'Question',
        'name' => 'Can a Public Limited Company offer ESOPs more effectively than a Private Limited Company?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Yes. Fewer restrictions on ESOP issuance and the freely transferable nature of shares make ESOPs genuinely attractive to employees — because there is a realistic liquidity pathway, rather than an indefinite wait for a buyout or secondary transaction.',
        ],
    ],
    [
        '@type' => 'Question',
        'name' => 'What compliance burden should a business realistically expect after Public Limited Company incorporation?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'It is significant. Beyond ROC filings, businesses should expect mandatory statutory audits, a qualified Company Secretary, public financial disclosures, and SEBI obligations if listed. Dedicated compliance infrastructure must be budgeted before the switch to this structure — not after operational pressures mount.',
        ],
    ],
    [
        '@type' => 'Question',
        'name' => 'Is a Public Limited Company suitable for a family business planning generational succession?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'It can be — but free share transferability can dilute family control over time. Promoter families often use holding companies or preference shares with special voting rights to retain strategic control while still accessing public capital. This structure must be planned and documented at incorporation — retrofitting it later is significantly more complex and costly.',
        ],
    ],
];

$plcJsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => 'https://caaft.com/#organization',
            'name' => 'CAAFT Consultancy Services Private Limited',
            'url' => 'https://caaft.com',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => 'https://caaft.com/assets/img/caaft-logo-header.webp',
            ],
            'description' => 'CAAFT Consultancy Services provides expert Accounting, Taxation, Business Incorporation, Management Consultancy, and Compliance Services to businesses across India.',
            'email' => 'info@caaft.com',
            'telephone' => ['+91-8870078870', '+91-9944617891'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Office No: C304, 3rd Floor, Apeejay House, 39/12, Haddows Road, Nungambakkam',
                'addressLocality' => 'Chennai',
                'addressRegion' => 'Tamil Nadu',
                'postalCode' => '600006',
                'addressCountry' => 'IN',
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'India',
            ],
        ],
        [
            '@type' => 'LocalBusiness',
            '@id' => 'https://caaft.com/#localbusiness',
            'name' => 'CAAFT Consultancy Services Private Limited',
            'url' => 'https://caaft.com',
            'logo' => 'https://caaft.com/assets/img/caaft-logo-header.webp',
            'image' => 'https://caaft.com/assets/img/caaft-logo-header.webp',
            'description' => 'Professional company registration, tax, and compliance services for businesses across India.',
            'email' => 'info@caaft.com',
            'telephone' => ['+91-8870078870', '+91-9944617891'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Office No: C304, 3rd Floor, Apeejay House, 39/12, Haddows Road, Nungambakkam',
                'addressLocality' => 'Chennai',
                'addressRegion' => 'Tamil Nadu',
                'postalCode' => '600006',
                'addressCountry' => 'IN',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 13.0604,
                'longitude' => 80.2496,
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens' => '09:30',
                    'closes' => '18:30',
                ],
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => 'Saturday',
                    'opens' => '09:30',
                    'closes' => '17:00',
                ],
            ],
            'priceRange' => '₹₹',
            'currenciesAccepted' => 'INR',
            'paymentAccepted' => 'Cash, Bank Transfer, UPI',
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'India',
            ],
        ],
        [
            '@type' => 'Service',
            '@id' => $publicCanonical . '#service',
            'name' => 'Public Limited Company Registration',
            'alternateName' => 'Public Limited Company Registration Services India',
            'url' => $publicCanonical,
            'description' => 'End-to-end Public Limited Company registration services in India including documentation, compliance, incorporation, and advisory support for large-scale business growth.',
            'provider' => ['@id' => 'https://caaft.com/#organization'],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'India',
            ],
            'serviceType' => 'Company Registration and Compliance Services',
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Public Limited Company Services',
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Public Limited Company Registration',
                            'description' => 'Complete incorporation support including name approval, DIN, DSC, MOA, AOA, and ROC filing.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Compliance and Regulatory Advisory',
                            'description' => 'Guidance on post-incorporation compliance, governance, and regulatory requirements.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Documentation and Filing Support',
                            'description' => 'Preparation and submission of all statutory documents required for incorporation.',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Post Registration Compliance',
                            'description' => 'Ongoing support for filings, audits, board meetings, and statutory compliance.',
                        ],
                    ],
                ],
            ],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $publicCanonical . '#faq',
            'mainEntity' => $plcFaqSchema,
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $publicCanonical . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => 'https://caaft.com',
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Public Limited Company Registration',
                    'item' => $publicCanonical,
                ],
            ],
        ],
    ],
];
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
    <meta name="keywords" content="Public Limited Company, Public Limited Company Registration">
    <link rel="canonical" href="<?= htmlspecialchars($publicCanonical, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Public Limited Company Registration in India for Large-Scale Business Growth">
    <meta property="og:description" content="Public Limited Company registration in India for enterprises seeking public funding, compliance-led governance, and scalable growth.">
    <meta property="og:url" content="<?= htmlspecialchars($publicCanonical, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:site_name" content="CAAFT Consultancy Services">
    <style>
        .page-public-limited-company .caaft-ar-trust-indicators {
            background: #ffffff !important;
        }

        .page-public-limited-company .pub-who-needs {
            background: #f4fbff;
        }

        .page-public-limited-company .pub-who-needs-title {
            margin: 0 0 10px;
            font-family: var(--heading-font);
            font-size: clamp(1.6rem, 3vw, 2.35rem);
            font-weight: 700;
            line-height: 1.2;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-who-needs-intro {
            margin: 0 0 18px;
            max-width: 860px;
            color: #384b63;
            font-size: 1.02rem;
            line-height: 1.7;
        }

        .page-public-limited-company .pub-who-needs-list {
            margin: 0;
            padding-left: 18px;
            list-style: disc !important;
            list-style-position: outside;
            columns: 2;
            column-gap: 34px;
        }

        .page-public-limited-company .pub-who-needs-list li {
            display: list-item !important;
            list-style: disc !important;
            break-inside: avoid;
            margin: 0 0 12px;
            color: #23384f;
            line-height: 1.6;
        }

        .page-public-limited-company .pub-who-needs-list li::marker {
            color: #1ea8ff;
        }

        .page-public-limited-company .pub-why-choose {
            background: #f7fafc;
        }

        .page-public-limited-company .pub-why-eyebrow {
            margin: 0 0 6px;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            color: #728298;
        }

        .page-public-limited-company .pub-why-title {
            margin: 0 0 18px;
            font-family: var(--heading-font);
            font-size: clamp(1.5rem, 2.7vw, 2.05rem);
            line-height: 1.25;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-why-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .page-public-limited-company .pub-why-card {
            background: #fff;
            border: 1px solid #dbe5ef;
            border-radius: 12px;
            padding: 16px 14px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .page-public-limited-company .pub-why-icon {
            width: 24px;
            height: 24px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 0.78rem;
        }

        .page-public-limited-company .pub-why-icon--blue {
            background: #e8f2ff;
            color: #3377d6;
        }

        .page-public-limited-company .pub-why-icon--green {
            background: #edf8e8;
            color: #4b8d3b;
        }

        .page-public-limited-company .pub-why-icon--gold {
            background: #f8f2df;
            color: #8a6a18;
        }

        .page-public-limited-company .pub-why-card-title {
            margin: 0 0 6px;
            font-size: 1.04rem;
            line-height: 1.35;
            color: #1e2c3f;
        }

        .page-public-limited-company .pub-why-card-text {
            margin: 0;
            color: #4a5d76;
            line-height: 1.55;
        }

        .page-public-limited-company .pub-legal-req {
            background: #ffffff;
        }

        .page-public-limited-company .pub-legal-title {
            margin: 0 0 8px;
            font-family: var(--heading-font);
            font-size: clamp(1.45rem, 2.6vw, 2rem);
            line-height: 1.25;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-legal-intro {
            margin: 0 0 18px;
            color: #4b5c72;
            line-height: 1.65;
        }

        .page-public-limited-company .pub-legal-list {
            border-top: 1px solid #d8e1eb;
        }

        .page-public-limited-company .pub-legal-item {
            display: grid;
            grid-template-columns: 40px 1fr;
            gap: 0 10px;
            padding: 14px 0;
            border-bottom: 1px solid #d8e1eb;
        }

        .page-public-limited-company .pub-legal-num {
            margin-top: 2px;
            font-size: 0.85rem;
            font-weight: 700;
            color: #77879b;
        }

        .page-public-limited-company .pub-legal-item-title {
            margin: 0 0 4px;
            font-size: 1.08rem;
            line-height: 1.35;
            color: #1d2d40;
        }

        .page-public-limited-company .pub-legal-item-text {
            margin: 0;
            color: #44586f;
            line-height: 1.65;
        }

        .page-public-limited-company .pub-types-section {
            background: #fff;
        }

        .page-public-limited-company .pub-types-title {
            margin: 0 0 14px;
            font-family: var(--heading-font);
            font-size: clamp(1.45rem, 2.6vw, 2rem);
            line-height: 1.24;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-types-list {
            display: grid;
            gap: 10px;
        }

        .page-public-limited-company .pub-types-item {
            border: 1px solid #d9e2ec;
            border-radius: 10px;
            background: #fbfcfe;
            padding: 12px 14px;
        }

        .page-public-limited-company .pub-types-item-head {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .page-public-limited-company .pub-types-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 2px 10px;
            font-size: 0.78rem;
            font-weight: 700;
            line-height: 1.4;
        }

        .page-public-limited-company .pub-types-pill--green {
            background: #e8f6e8;
            color: #3d7c39;
        }

        .page-public-limited-company .pub-types-pill--amber {
            background: #fbf2df;
            color: #8a6b20;
        }

        .page-public-limited-company .pub-types-pill--blue {
            background: #e7f0ff;
            color: #2f69c5;
        }

        .page-public-limited-company .pub-types-pill--red {
            background: #fdeaea;
            color: #b25353;
        }

        .page-public-limited-company .pub-types-item-title {
            margin: 0;
            font-size: 1.08rem;
            color: #1d2d40;
            line-height: 1.35;
        }

        .page-public-limited-company .pub-types-item-text {
            margin: 0 0 0 52px;
            color: #455a72;
            line-height: 1.62;
        }

        .page-public-limited-company .pub-deliverables {
            background: #ecf8ff;
        }

        .page-public-limited-company .pub-deliverables-title {
            margin: 0 0 18px;
            font-family: var(--heading-font);
            font-size: clamp(1.5rem, 3vw, 2.3rem);
            font-weight: 700;
            line-height: 1.2;
            color: #0a1d43;
            text-transform: uppercase;
        }

        .page-public-limited-company .pub-deliverables-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .page-public-limited-company .pub-deliverable-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #dbe9f5;
            border-radius: 12px;
            padding: 16px 14px 14px;
            min-height: 180px;
            box-shadow: 0 8px 22px rgba(17, 24, 39, 0.05);
        }

        .page-public-limited-company .pub-deliverable-num {
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 2.35rem;
            font-weight: 700;
            line-height: 1;
            color: rgba(10, 29, 67, 0.08);
            pointer-events: none;
        }

        .page-public-limited-company .pub-deliverable-title {
            margin: 0 0 8px;
            max-width: calc(100% - 58px);
            font-size: 1.08rem;
            line-height: 1.35;
            color: #162b44;
        }

        .page-public-limited-company .pub-deliverable-text {
            margin: 0;
            color: #435975;
            line-height: 1.65;
        }

        .page-public-limited-company .pub-docs-section {
            background: #ffffff;
        }

        .page-public-limited-company .pub-docs-title {
            margin: 0 0 6px;
            font-family: var(--heading-font);
            font-size: clamp(1.45rem, 2.6vw, 2rem);
            line-height: 1.25;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-docs-intro {
            margin: 0 0 18px;
            color: #4c5f76;
            line-height: 1.65;
            max-width: 880px;
        }

        .page-public-limited-company .pub-docs-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .page-public-limited-company .pub-docs-card {
            border: 1px solid #d9e4ef;
            border-radius: 12px;
            background: #fbfdff;
            padding: 14px 14px 12px;
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.04);
        }

        .page-public-limited-company .pub-docs-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #dce5ef;
        }

        .page-public-limited-company .pub-docs-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.86rem;
        }

        .page-public-limited-company .pub-docs-icon--purple {
            background: #efedff;
            color: #6a5ad2;
        }

        .page-public-limited-company .pub-docs-icon--green {
            background: #e9f8ef;
            color: #2f9a67;
        }

        .page-public-limited-company .pub-docs-icon--orange {
            background: #fff1e9;
            color: #d36b42;
        }

        .page-public-limited-company .pub-docs-icon--blue {
            background: #e9f2ff;
            color: #3a7dd8;
        }

        .page-public-limited-company .pub-docs-card-title {
            margin: 0;
            font-size: 1.05rem;
            line-height: 1.35;
            color: #1d2d40;
        }

        .page-public-limited-company .pub-docs-list {
            margin: 0;
            padding-left: 18px;
        }

        .page-public-limited-company .pub-docs-list li {
            margin: 0 0 8px;
            color: #3f556f;
            line-height: 1.58;
        }

        .page-public-limited-company .pub-post-reg {
            background: #ffffff;
        }

        .page-public-limited-company .pub-post-reg-eyebrow {
            margin: 0 0 6px;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            color: #8a99ab;
        }

        .page-public-limited-company .pub-post-reg-title {
            margin: 0 0 18px;
            font-family: var(--heading-font);
            font-size: clamp(1.45rem, 2.5vw, 2rem);
            line-height: 1.24;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-post-reg-list {
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
            border-bottom: 1px solid #dbe5ef;
        }

        .page-public-limited-company .pub-post-reg-list::before {
            content: "";
            position: absolute;
            left: 1px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: #e2e8f0;
        }

        .page-public-limited-company .pub-post-reg-item {
            position: relative;
            padding: 0 0 14px 28px;
        }

        .page-public-limited-company .pub-post-reg-item::before {
            content: "";
            position: absolute;
            left: -2px;
            top: 6px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #c8d4e2;
            z-index: 1;
        }

        .page-public-limited-company .pub-post-reg-item:last-child {
            padding-bottom: 12px;
        }

        .page-public-limited-company .pub-post-reg-item-title {
            margin: 0 0 3px;
            font-size: 1.08rem;
            line-height: 1.35;
            color: #1c2d42;
        }

        .page-public-limited-company .pub-post-reg-item-text {
            margin: 0;
            color: #465b74;
            line-height: 1.62;
        }

        .page-public-limited-company .pub-advantages {
            background: #ffffff;
        }

        .page-public-limited-company .pub-advantages-title {
            margin: 0 0 14px;
            font-family: var(--heading-font);
            font-size: clamp(1.45rem, 2.6vw, 2rem);
            line-height: 1.24;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-advantages-list {
            margin: 0;
            padding: 0;
            list-style: none;
            border-top: 1px solid #d9e3ee;
        }

        .page-public-limited-company .pub-advantages-item {
            display: grid;
            grid-template-columns: 24px 1fr;
            gap: 0 10px;
            align-items: start;
            padding: 12px 0;
            border-bottom: 1px solid #d9e3ee;
        }

        .page-public-limited-company .pub-advantages-check {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            border-radius: 50%;
            background: #e9f7e6;
            color: #5c9f49;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.66rem;
            line-height: 1;
        }

        .page-public-limited-company .pub-advantages-item-title {
            margin: 0 0 2px;
            font-size: 1.08rem;
            line-height: 1.35;
            color: #1c2d42;
        }

        .page-public-limited-company .pub-advantages-item-text {
            margin: 0;
            color: #465b73;
            line-height: 1.62;
        }

        .page-public-limited-company .pub-challenges {
            background: #eef8ff;
        }

        .page-public-limited-company .pub-challenges-title {
            margin: 0 0 10px;
            font-family: var(--heading-font);
            font-size: clamp(1.6rem, 3.2vw, 2.55rem);
            font-weight: 700;
            line-height: 1.15;
            text-transform: uppercase;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-challenges-intro {
            margin: 0 0 16px;
            color: #4d6078;
            line-height: 1.65;
            max-width: 900px;
        }

        .page-public-limited-company .pub-challenges-list {
            margin: 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 7px;
        }

        .page-public-limited-company .pub-challenges-item {
            padding: 10px 12px;
            border: 1px solid #d9e5f1;
            border-left: 3px solid #27b2ff;
            background: #f6f9fd;
            color: #1f324b;
            line-height: 1.55;
            font-weight: 500;
        }

        .page-public-limited-company .pub-challenges-note {
            margin: 14px 0 0;
            color: #425974;
            line-height: 1.65;
        }

        .page-public-limited-company .pub-why-caaft {
            background: linear-gradient(145deg, #0a1f4f 0%, #153a88 52%, #0f2c66 100%);
        }

        .page-public-limited-company .pub-why-caaft-title {
            margin: 0 0 18px;
            font-family: var(--heading-font);
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 700;
            line-height: 1.18;
            text-transform: uppercase;
            color: #ffffff;
        }

        .page-public-limited-company .pub-why-caaft-grid-top {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0;
            border: 1px solid rgba(123, 157, 222, 0.32);
            border-bottom: 0;
        }

        .page-public-limited-company .pub-why-caaft-grid-bottom {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 66.67%;
            margin: 0 auto;
            border: 1px solid rgba(123, 157, 222, 0.32);
            border-top: 0;
        }

        .page-public-limited-company .pub-why-caaft-card {
            background: rgba(4, 25, 67, 0.82);
            padding: 18px 16px;
            min-height: 158px;
            border-right: 1px solid rgba(123, 157, 222, 0.28);
        }

        .page-public-limited-company .pub-why-caaft-grid-top .pub-why-caaft-card:last-child,
        .page-public-limited-company .pub-why-caaft-grid-bottom .pub-why-caaft-card:last-child {
            border-right: 0;
        }

        .page-public-limited-company .pub-why-caaft-card-title {
            margin: 0 0 8px;
            font-size: 1.12rem;
            color: #ffffff;
            line-height: 1.35;
        }

        .page-public-limited-company .pub-why-caaft-card-text {
            margin: 0;
            color: rgba(232, 242, 255, 0.92);
            line-height: 1.7;
        }

        .page-public-limited-company .pub-key-facts {
            background: #ffffff;
        }

        .page-public-limited-company .pub-key-facts-title {
            margin: 0 0 18px;
            font-family: var(--heading-font);
            font-size: clamp(1.55rem, 3vw, 2.3rem);
            font-weight: 700;
            line-height: 1.2;
            text-transform: uppercase;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-key-facts-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .page-public-limited-company .pub-key-facts-card {
            border: 1px solid #e0e7f0;
            border-radius: 12px;
            background: #fcfdff;
            text-align: center;
            padding: 26px 18px 22px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
        }

        .page-public-limited-company .pub-key-facts-metric {
            margin: 0 0 10px;
            font-family: var(--heading-font);
            font-size: clamp(2rem, 4.2vw, 3rem);
            font-weight: 700;
            line-height: 1;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-key-facts-text {
            margin: 0;
            color: #4a5d76;
            line-height: 1.7;
        }

        .page-public-limited-company .pub-launch-cta {
            background: #f5f7fb;
        }

        .page-public-limited-company .pub-launch-cta-card {
            width: 100%;
            margin: 0 auto;
            text-align: center;
            padding: clamp(34px, 5vw, 54px) clamp(22px, 4vw, 56px);
            border-radius: 14px;
            background: linear-gradient(140deg, #0b2359 0%, #123a8f 55%, #1a4fb8 100%);
            box-shadow: 0 16px 34px rgba(10, 29, 67, 0.3);
        }

        .page-public-limited-company .pub-launch-cta-title {
            margin: 0 0 14px;
            font-family: var(--heading-font);
            font-size: clamp(1.7rem, 3.4vw, 3rem);
            font-weight: 700;
            line-height: 1.14;
            color: #fff;
        }

        .page-public-limited-company .pub-launch-cta-copy {
            margin: 0 auto 22px;
            max-width: 760px;
            font-size: 1.05rem;
            line-height: 1.72;
            color: rgba(255, 255, 255, 0.92);
        }

        .page-public-limited-company .pub-launch-cta-btn.theme-btn {
            border: 0;
            border-radius: 10px;
            padding: 12px 24px;
            background: linear-gradient(90deg, #2eb4ff 0%, #27a6ff 100%);
            box-shadow: 0 10px 22px rgba(46, 180, 255, 0.35);
        }

        .page-public-limited-company .pub-what-is {
            background: #ffffff;
        }

        .page-public-limited-company .pub-what-is-card {
            border: 1px solid #dce6f0;
            border-radius: 12px;
            background: #fbfdff;
            padding: 14px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
        }

        .page-public-limited-company .pub-what-is-title {
            margin: 4px 0 10px;
            font-family: var(--heading-font);
            font-size: clamp(1.5rem, 2.7vw, 2.15rem);
            line-height: 1.24;
            color: #0a1d43;
        }

        .page-public-limited-company .pub-what-is-copy {
            margin: 0 0 12px;
            color: #445a73;
            line-height: 1.75;
        }

        .page-public-limited-company .pub-what-is-copy:last-child {
            margin-bottom: 0;
        }

        .page-public-limited-company .pub-what-is-image img {
            width: 100%;
            min-height: 320px;
            object-fit: cover;
            border-radius: 10px;
        }

        @media (max-width: 575.98px) {
            .page-public-limited-company .pub-types-item-text {
                margin-left: 0;
            }
        }

        @media (max-width: 991.98px) {
            .page-public-limited-company .pub-who-needs-list {
                columns: 1;
            }

            .page-public-limited-company .pub-why-grid {
                grid-template-columns: 1fr;
            }

            .page-public-limited-company .pub-deliverables-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .page-public-limited-company .pub-docs-grid {
                grid-template-columns: 1fr;
            }

            .page-public-limited-company .pub-why-caaft-grid-top {
                grid-template-columns: 1fr;
                border-bottom: 1px solid rgba(123, 157, 222, 0.32);
            }

            .page-public-limited-company .pub-why-caaft-grid-bottom {
                grid-template-columns: 1fr;
                max-width: 100%;
                border-top: 0;
            }

            .page-public-limited-company .pub-why-caaft-card {
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid rgba(123, 157, 222, 0.24);
            }

            .page-public-limited-company .pub-why-caaft-grid-top .pub-why-caaft-card:last-child,
            .page-public-limited-company .pub-why-caaft-grid-bottom .pub-why-caaft-card:last-child {
                border-bottom: 0;
            }

            .page-public-limited-company .pub-key-facts-grid {
                grid-template-columns: 1fr;
            }

            .page-public-limited-company .pub-what-is-image img {
                min-height: 220px;
            }
        }

        @media (max-width: 575.98px) {
            .page-public-limited-company .pub-deliverables-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <?php include "header-top.php"; ?>
    <script type="application/ld+json"><?= json_encode($plcJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="home-3 page-accounting-reporting page-public-limited-company">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQ559WPT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <div class="header-sections"><?php include "header.php"; ?></div>
    <main class="main">
        <section class="hero-section hs-3 caaft-ar-hero" aria-labelledby="pub-ltd-h1">
            <div class="hero-single singles_forms_frames caaft-ar-hero-single"><div class="container"><div class="row align-items-center g-4 g-xl-5 caaft-ar-hero-row">
                <div class="col-md-12 col-lg-6 caaft-ar-hero-inner">
                    <h1 id="pub-ltd-h1" class="caaft-ar-hero-h1">Public Limited Company Registration Services</h1>
                    <h2 class="caaft-ar-hero-h2">From Incorporation to Long-Term Compliance — Complete Public Limited Company Support.</h2>
                    <p class="caaft-ar-hero-lead">A Public Limited Company enables large-scale operations, public capital raising, and strong corporate credibility — with a governance structure built to support long-term expansion.</p>
                    <p class="caaft-ar-hero-lead">This business structure allows shares to be offered to the general public and traded on stock exchanges, provides limited liability to shareholders, and operates under the structured governance and disclosure standards of the Companies Act, 2013. CAAFT delivers end-to-end Public Limited Company registration and compliance support — from name approval and ROC filing through to post-incorporation statutory management.</p>
                    <div class="caaft-ar-hero-ctas">
                        <a href="/contact#contact_us" class="theme-btn caaft-ar-hero-btn-primary">Consult a Registration Expert <i class="fas fa-arrow-right"></i></a>
                        <a href="/contact#contact_us" class="theme-btn caaft-ar-hero-btn-primary">Get Started Today! <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6"><div class="hero-img-wrap caaft-ar-hero-img-wrap"><?php
$caaft_enquiry_service = 'Public Limited Company Registration';
$caaft_enquiry_action = '/business-registration-mail.php';
$caaft_enquiry_title = 'Let\'s Talk';
$caaft_enquiry_recaptcha = false;
$caaft_enquiry_honeypot_website = false;
include __DIR__ . '/../../includes/components/enquiry-hero-form.php';
?></div></div></div></div>
            </div></div></div>
        </section>

        <section class="caaft-ar-trust-indicators" aria-label="Trust indicators"><div class="container"><div class="caaft-ar-trust-grid caaft-ar-trust-grid--eq-4">
            <article class="caaft-ar-trust-item"><span class="caaft-ar-trust-icon"><i class="fas fa-star"></i></span><div class="caaft-ar-trust-content"><h3>Rated 4.8/5 ⭐</h3><p>on Google</p></div></article>
            <article class="caaft-ar-trust-item"><span class="caaft-ar-trust-icon"><i class="fas fa-building"></i></span><div class="caaft-ar-trust-content"><h3>500+</h3><p>Companies Registered</p></div></article>
            <article class="caaft-ar-trust-item"><span class="caaft-ar-trust-icon"><i class="fas fa-calendar-check"></i></span><div class="caaft-ar-trust-content"><h3>7-Day</h3><p>Registration Process</p></div></article>
            <article class="caaft-ar-trust-item"><span class="caaft-ar-trust-icon"><i class="fas fa-lock"></i></span><div class="caaft-ar-trust-content"><h3>100%</h3><p>Data Confidentiality</p></div></article>
        </div></div></section>

        <section class="pub-what-is py-90" aria-labelledby="pub-what-is-title">
            <div class="container">
                <div class="pub-what-is-card">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <h2 id="pub-what-is-title" class="pub-what-is-title">What Is a Public Limited Company?</h2>
                            <p class="pub-what-is-copy">A Public Limited Company (PLC) is a company incorporated under the Companies Act, 2013 that can offer shares to the public and, subject to approvals, raise capital through stock exchange listing. It is designed for businesses aiming long-term expansion, institutional participation, and stronger governance credibility.</p>
                            <p class="pub-what-is-copy">This structure provides limited liability to shareholders, establishes a legal identity separate from promoters and directors, and operates under formal disclosure, audit, and compliance requirements. For growth-stage enterprises, it creates a scalable framework for public funding, strategic partnerships, and transparent corporate control.</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="pub-what-is-image">
                                <img src="/assets/img/tax-planning-management.webp" alt="What is a Public Limited Company?" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pub-why-choose py-90" aria-labelledby="pub-why-title">
            <div class="container">
                <p class="pub-why-eyebrow">Why Businesses Choose It</p>
                <h2 id="pub-why-title" class="pub-why-title">Why Businesses Choose Public Limited Company Registration</h2>
                <div class="pub-why-grid">
                    <article class="pub-why-card">
                        <span class="pub-why-icon pub-why-icon--blue"><i class="fas fa-gem"></i></span>
                        <h3 class="pub-why-card-title">Public funding access</h3>
                        <p class="pub-why-card-text">Access to public funding markets and a wider investor base through share issuance and listing readiness.</p>
                    </article>
                    <article class="pub-why-card">
                        <span class="pub-why-icon pub-why-icon--green"><i class="fas fa-check-circle"></i></span>
                        <h3 class="pub-why-card-title">Corporate credibility</h3>
                        <p class="pub-why-card-text">Improved trust with banks, institutions, and large enterprise clients for growth-stage opportunities.</p>
                    </article>
                    <article class="pub-why-card">
                        <span class="pub-why-icon pub-why-icon--gold"><i class="fas fa-arrow-right"></i></span>
                        <h3 class="pub-why-card-title">Share transferability</h3>
                        <p class="pub-why-card-text">Easier transferability of shares supports liquidity, governance flexibility, and long-term market confidence.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-legal-req py-90" aria-labelledby="pub-legal-title">
            <div class="container">
                <h2 id="pub-legal-title" class="pub-legal-title">Legal Requirements for Public Limited Company Registration</h2>
                <p class="pub-legal-intro">Statutory conditions for incorporation</p>
                <div class="pub-legal-list">
                    <article class="pub-legal-item">
                        <div class="pub-legal-num">01</div>
                        <div>
                            <h3 class="pub-legal-item-title">Minimum directors</h3>
                            <p class="pub-legal-item-text">At least 3 directors are mandatory. One must be an Indian resident. Each director must hold a Director Identification Number (DIN).</p>
                        </div>
                    </article>
                    <article class="pub-legal-item">
                        <div class="pub-legal-num">02</div>
                        <div>
                            <h3 class="pub-legal-item-title">Minimum shareholders</h3>
                            <p class="pub-legal-item-text">A minimum of 7 shareholders is required at incorporation. There is no upper limit on shareholder count.</p>
                        </div>
                    </article>
                    <article class="pub-legal-item">
                        <div class="pub-legal-num">03</div>
                        <div>
                            <h3 class="pub-legal-item-title">Registered office address</h3>
                            <p class="pub-legal-item-text">A valid Indian address is required for official communication, legal notices, and regulatory filings with the ROC.</p>
                        </div>
                    </article>
                    <article class="pub-legal-item">
                        <div class="pub-legal-num">04</div>
                        <div>
                            <h3 class="pub-legal-item-title">Company name approval</h3>
                            <p class="pub-legal-item-text">The proposed name must follow MCA naming guidelines and must not resemble any existing registered company or trademark.</p>
                        </div>
                    </article>
                    <article class="pub-legal-item">
                        <div class="pub-legal-num">05</div>
                        <div>
                            <h3 class="pub-legal-item-title">Capital structure</h3>
                            <p class="pub-legal-item-text">No minimum paid-up capital requirement exists under the Companies Act, 2013. Authorised capital must be defined in incorporation documents.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-types-section py-90" aria-labelledby="pub-types-title">
            <div class="container">
                <h2 id="pub-types-title" class="pub-types-title">Types of Public Limited Company</h2>
                <div class="pub-types-list">
                    <article class="pub-types-item">
                        <div class="pub-types-item-head">
                            <span class="pub-types-pill pub-types-pill--green">Listed</span>
                            <h3 class="pub-types-item-title">Listed Public Company</h3>
                        </div>
                        <p class="pub-types-item-text">Shares traded on NSE or BSE. Must comply fully with SEBI regulations and ongoing disclosure norms.</p>
                    </article>
                    <article class="pub-types-item">
                        <div class="pub-types-item-head">
                            <span class="pub-types-pill pub-types-pill--amber">Unlisted</span>
                            <h3 class="pub-types-item-title">Unlisted Public Company</h3>
                        </div>
                        <p class="pub-types-item-text">Structured as a public entity but not listed on exchanges. Can offer shares to a wider investor pool with fewer listing obligations.</p>
                    </article>
                    <article class="pub-types-item">
                        <div class="pub-types-item-head">
                            <span class="pub-types-pill pub-types-pill--blue">By shares</span>
                            <h3 class="pub-types-item-title">Limited by shares</h3>
                        </div>
                        <p class="pub-types-item-text">Standard form where shareholder liability is limited to the unpaid value of shares held.</p>
                    </article>
                    <article class="pub-types-item">
                        <div class="pub-types-item-head">
                            <span class="pub-types-pill pub-types-pill--red">By guarantee</span>
                            <h3 class="pub-types-item-title">Limited by guarantee</h3>
                        </div>
                        <p class="pub-types-item-text">Liability limited by a guarantee amount rather than share capital. Used primarily by non-profit or charitable organisations.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-deliverables py-90" aria-labelledby="pub-deliverables-title">
            <div class="container">
                <h2 id="pub-deliverables-title" class="pub-deliverables-title">Public Limited Company Registration Services — What Gets Delivered</h2>
                <div class="pub-deliverables-grid">
                    <article class="pub-deliverable-card">
                        <span class="pub-deliverable-num">01</span>
                        <h3 class="pub-deliverable-title">Name reservation and approval</h3>
                        <p class="pub-deliverable-text">Company name reserved through MCA in compliance with naming guidelines, ensuring no conflicts with existing registrations or trademarks.</p>
                    </article>
                    <article class="pub-deliverable-card">
                        <span class="pub-deliverable-num">02</span>
                        <h3 class="pub-deliverable-title">Digital Signature Certificate (DSC) procurement</h3>
                        <p class="pub-deliverable-text">DSCs obtained for all proposed directors, required for all online filings with the ROC and MCA portal.</p>
                    </article>
                    <article class="pub-deliverable-card">
                        <span class="pub-deliverable-num">03</span>
                        <h3 class="pub-deliverable-title">Director Identification Number (DIN) application</h3>
                        <p class="pub-deliverable-text">DINs applied for all directors who do not already hold one before incorporation filings begin.</p>
                    </article>
                    <article class="pub-deliverable-card">
                        <span class="pub-deliverable-num">04</span>
                        <h3 class="pub-deliverable-title">MOA and AOA drafting</h3>
                        <p class="pub-deliverable-text">Memorandum and Articles drafted to accurately reflect business objectives and internal governance rules.</p>
                    </article>
                    <article class="pub-deliverable-card">
                        <span class="pub-deliverable-num">05</span>
                        <h3 class="pub-deliverable-title">ROC filing and incorporation</h3>
                        <p class="pub-deliverable-text">Incorporation forms and supporting documents filed with the Registrar of Companies within prescribed timelines.</p>
                    </article>
                    <article class="pub-deliverable-card">
                        <span class="pub-deliverable-num">06</span>
                        <h3 class="pub-deliverable-title">Certificate of Incorporation and compliance setup</h3>
                        <p class="pub-deliverable-text">Certificate obtained after ROC verification, followed by statutory registers, board meeting structure, and annual compliance framework setup.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-who-needs py-90" aria-labelledby="pub-who-needs-title">
            <div class="container">
                <h2 id="pub-who-needs-title" class="pub-who-needs-title">Who Needs Public Limited Company Registration?</h2>
                <p class="pub-who-needs-intro">Public Limited Company registration is relevant for businesses and promoters in specific situations:</p>
                <ul class="pub-who-needs-list">
                    <li>Large enterprises seeking to raise capital from public investors or institutional sources</li>
                    <li>Businesses planning an IPO or eventual listing on NSE or BSE</li>
                    <li>Promoters requiring a structure that supports free share transferability and wide shareholding</li>
                    <li>Companies planning to offer ESOPs with genuine liquidity pathways for employees</li>
                    <li>Family businesses planning structured generational succession with external investor participation</li>
                    <li>Enterprises requiring enhanced corporate credibility for large contracts, institutional partnerships, or bank financing</li>
                </ul>
            </div>
        </section>

        <section class="caaft-ar-how py-90"><div class="container"><header class="caaft-ar-how-header"><h2 class="caaft-ar-how-h2">Step-by-Step Process</h2></header>
            <ol class="caaft-ar-how-timeline">
                <li class="caaft-ar-how-step caaft-ar-how-step--line"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">1. Document and Information Collection</h3><p class="caaft-ar-how-step-text">Identity, address, and contact details of all proposed directors and shareholders are collected and verified before any filing begins.</p></div></li>
                <li class="caaft-ar-how-step caaft-ar-how-step--line"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">2. Digital Signature Certificate (DSC) Procurement</h3><p class="caaft-ar-how-step-text">DSCs are obtained for all proposed directors — a mandatory requirement for all online filings on the MCA portal.</p></div></li>
                <li class="caaft-ar-how-step caaft-ar-how-step--line"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">3. Director Identification Number (DIN) Application</h3><p class="caaft-ar-how-step-text">DINs are applied for all directors who do not already hold one — required before any incorporation application can be filed.</p></div></li>
                <li class="caaft-ar-how-step caaft-ar-how-step--line"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">4. Company Name Reservation</h3><p class="caaft-ar-how-step-text">A unique company name is reserved through the MCA portal — verified against existing registrations and trademarks to ensure approval without objection.</p></div></li>
                <li class="caaft-ar-how-step caaft-ar-how-step--line"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">5. MOA &amp; AOA Drafting</h3><p class="caaft-ar-how-step-text">The Memorandum of Association and Articles of Association are drafted — accurately defining business objectives, governance structure, and shareholder rights.</p></div></li>
                <li class="caaft-ar-how-step caaft-ar-how-step--line"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">6. ROC Filing</h3><p class="caaft-ar-how-step-text">Incorporation forms and all supporting documents are filed with the Registrar of Companies — with every field verified and every attachment confirmed before submission.</p></div></li>
                <li class="caaft-ar-how-step"><span class="caaft-ar-how-marker caaft-ar-how-marker--dot"></span><div class="caaft-ar-how-body"><h3 class="caaft-ar-how-step-title">7. Certificate of Incorporation</h3><p class="caaft-ar-how-step-text">The Certificate of Incorporation is received from the ROC after successful verification — officially confirming the company's legal existence and registration.</p></div></li>
            </ol>
        </div></section>

        <section class="pub-docs-section py-90" aria-labelledby="pub-docs-title">
            <div class="container">
                <h2 id="pub-docs-title" class="pub-docs-title">Documents Required for Public Limited Company Registration</h2>
                <p class="pub-docs-intro">Prepare these documents before initiating your Public Limited Company registration with MCA.</p>
                <div class="pub-docs-grid">
                    <article class="pub-docs-card">
                        <div class="pub-docs-head">
                            <span class="pub-docs-icon pub-docs-icon--purple"><i class="far fa-user"></i></span>
                            <h3 class="pub-docs-card-title">Directors &amp; Shareholders</h3>
                        </div>
                        <ul class="pub-docs-list">
                            <li>PAN Card of all directors and shareholders</li>
                            <li>Aadhaar Card, Passport, or Voter ID as identity proof</li>
                            <li>Bank statement or utility bill as address proof</li>
                            <li>Passport-size photograph of each director and shareholder</li>
                            <li>Email ID and mobile number for official communication</li>
                        </ul>
                    </article>
                    <article class="pub-docs-card">
                        <div class="pub-docs-head">
                            <span class="pub-docs-icon pub-docs-icon--green"><i class="fas fa-check-circle"></i></span>
                            <h3 class="pub-docs-card-title">Company Documents</h3>
                        </div>
                        <ul class="pub-docs-list">
                            <li>Memorandum of Association (MOA) defining business objectives</li>
                            <li>Articles of Association (AOA) outlining internal governance rules</li>
                            <li>Director Consent and Declaration for legal compliance confirmation</li>
                        </ul>
                    </article>
                    <article class="pub-docs-card">
                        <div class="pub-docs-head">
                            <span class="pub-docs-icon pub-docs-icon--orange"><i class="far fa-building"></i></span>
                            <h3 class="pub-docs-card-title">Registered Office</h3>
                        </div>
                        <ul class="pub-docs-list">
                            <li>Utility bill (electricity or water) for address confirmation</li>
                            <li>Rent Agreement or Sale Deed as ownership proof</li>
                            <li>No Objection Certificate (NOC) from the property owner</li>
                        </ul>
                    </article>
                    <article class="pub-docs-card">
                        <div class="pub-docs-head">
                            <span class="pub-docs-icon pub-docs-icon--blue"><i class="far fa-file-alt"></i></span>
                            <h3 class="pub-docs-card-title">Statutory &amp; Digital Requirements</h3>
                        </div>
                        <ul class="pub-docs-list">
                            <li>Digital Signature Certificate (DSC) for online filing authentication</li>
                            <li>Director Identification Number (DIN) for director verification</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-post-reg py-90" aria-labelledby="pub-post-reg-title">
            <div class="container">
                <p class="pub-post-reg-eyebrow">Post-Registration Compliance</p>
                <h2 id="pub-post-reg-title" class="pub-post-reg-title">Post-Registration Compliance for Public Limited Companies</h2>
                <ul class="pub-post-reg-list">
                    <li class="pub-post-reg-item">
                        <h3 class="pub-post-reg-item-title">Annual ROC filings</h3>
                        <p class="pub-post-reg-item-text">Financial statements, annual return, and board report filed with the Registrar of Companies each year.</p>
                    </li>
                    <li class="pub-post-reg-item">
                        <h3 class="pub-post-reg-item-title">Statutory audit</h3>
                        <p class="pub-post-reg-item-text">Conducted by a qualified Chartered Accountant every financial year without exception.</p>
                    </li>
                    <li class="pub-post-reg-item">
                        <h3 class="pub-post-reg-item-title">Board meetings</h3>
                        <p class="pub-post-reg-item-text">Minimum 4 board meetings per year with proper notice, agenda, and minutes documentation.</p>
                    </li>
                    <li class="pub-post-reg-item">
                        <h3 class="pub-post-reg-item-title">Annual General Meeting (AGM)</h3>
                        <p class="pub-post-reg-item-text">Shareholder meeting held within prescribed timelines each financial year.</p>
                    </li>
                    <li class="pub-post-reg-item">
                        <h3 class="pub-post-reg-item-title">Statutory registers</h3>
                        <p class="pub-post-reg-item-text">Maintenance of register of members, directors, charges, and related party transactions.</p>
                    </li>
                    <li class="pub-post-reg-item">
                        <h3 class="pub-post-reg-item-title">Corporate governance norms</h3>
                        <p class="pub-post-reg-item-text">Compliance with the Companies Act, and for listed companies, SEBI LODR requirements.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="pub-advantages py-90" aria-labelledby="pub-advantages-title">
            <div class="container">
                <h2 id="pub-advantages-title" class="pub-advantages-title">Advantages of a Public Limited Company</h2>
                <ul class="pub-advantages-list">
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Public capital access</h3>
                            <p class="pub-advantages-item-text">Raise funds from public investors through share issuance and stock market listing.</p>
                        </div>
                    </li>
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Limited liability protection</h3>
                            <p class="pub-advantages-item-text">Shareholder liability is capped to invested capital — personal assets remain fully protected.</p>
                        </div>
                    </li>
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Enhanced credibility</h3>
                            <p class="pub-advantages-item-text">Greater brand trust with banks, institutions, and large corporate clients.</p>
                        </div>
                    </li>
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Large-scale expansion</h3>
                            <p class="pub-advantages-item-text">Access to structured, public, and institutional funding for significant growth.</p>
                        </div>
                    </li>
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Free share transfer</h3>
                            <p class="pub-advantages-item-text">Improves liquidity for shareholders and employees through unrestricted transferability.</p>
                        </div>
                    </li>
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Perpetual succession</h3>
                            <p class="pub-advantages-item-text">The company continues regardless of changes in ownership or directorship.</p>
                        </div>
                    </li>
                    <li class="pub-advantages-item">
                        <span class="pub-advantages-check"><i class="fas fa-check"></i></span>
                        <div>
                            <h3 class="pub-advantages-item-title">Better financing terms</h3>
                            <p class="pub-advantages-item-text">Improved access to bank loans and institutional credit at competitive rates.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="pub-challenges py-90" aria-labelledby="pub-challenges-title">
            <div class="container">
                <h2 id="pub-challenges-title" class="pub-challenges-title">Common Challenges in Public Limited Company Registration CAAFT Solves</h2>
                <p class="pub-challenges-intro">Most businesses seek professional support for Public Limited Company registration when facing one or more of these:</p>
                <ul class="pub-challenges-list">
                    <li class="pub-challenges-item">Uncertainty about whether a Public Limited or Private Limited structure is more appropriate for the business stage and funding goals</li>
                    <li class="pub-challenges-item">Name reservation rejections due to similarity with existing companies or trademark conflicts</li>
                    <li class="pub-challenges-item">Incomplete or incorrectly drafted MOA and AOA that create governance issues post-incorporation</li>
                    <li class="pub-challenges-item">DIN or DSC procurement delays holding up the entire incorporation timeline</li>
                    <li class="pub-challenges-item">ROC filing errors causing rejection or requests for resubmission</li>
                    <li class="pub-challenges-item">Inadequate compliance infrastructure set up after incorporation — leading to filing defaults and ROC notices</li>
                    <li class="pub-challenges-item">Promoters unaware of voting rights protections, ESOP structuring, and shareholder agreement requirements that should be addressed before — not after — registration</li>
                </ul>
                <p class="pub-challenges-note">CAAFT's structured approach addresses each of these — delivering accurate, compliant Public Limited Company registrations with the governance and compliance foundation properly in place from day one.</p>
            </div>
        </section>

        <section class="pub-why-caaft py-90" aria-labelledby="pub-why-caaft-title">
            <div class="container">
                <h2 id="pub-why-caaft-title" class="pub-why-caaft-title">Why Choose CAAFT</h2>
                <div class="pub-why-caaft-grid-top">
                    <article class="pub-why-caaft-card">
                        <h3 class="pub-why-caaft-card-title">End-to-end incorporation expertise</h3>
                        <p class="pub-why-caaft-card-text">From name approval and ROC filing to obtaining the Certificate of Commencement, every step is managed with precision by qualified professionals.</p>
                    </article>
                    <article class="pub-why-caaft-card">
                        <h3 class="pub-why-caaft-card-title">Regulatory compliance at every stage</h3>
                        <p class="pub-why-caaft-card-text">CAAFT ensures adherence to SEBI, MCA, and Companies Act obligations from incorporation onwards.</p>
                    </article>
                    <article class="pub-why-caaft-card">
                        <h3 class="pub-why-caaft-card-title">Dedicated professionals — not junior staff</h3>
                        <p class="pub-why-caaft-card-text">Experienced Chartered Accountants and legal professionals handle each engagement with accountability.</p>
                    </article>
                </div>
                <div class="pub-why-caaft-grid-bottom">
                    <article class="pub-why-caaft-card">
                        <h3 class="pub-why-caaft-card-title">Transparent pricing and clear timelines</h3>
                        <p class="pub-why-caaft-card-text">No surprise costs and no vague timelines — every filing and milestone is clearly communicated.</p>
                    </article>
                    <article class="pub-why-caaft-card">
                        <h3 class="pub-why-caaft-card-title">Beyond incorporation — a long-term compliance partner</h3>
                        <p class="pub-why-caaft-card-text">From annual filings to governance and audit support, CAAFT stays with you as your business scales.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-key-facts py-90" aria-labelledby="pub-key-facts-title">
            <div class="container">
                <h2 id="pub-key-facts-title" class="pub-key-facts-title">Key Facts &amp; Figures</h2>
                <div class="pub-key-facts-grid">
                    <article class="pub-key-facts-card">
                        <h3 class="pub-key-facts-metric">28+ lakh</h3>
                        <p class="pub-key-facts-text">India registered over 28 lakh companies by early 2026, reflecting strong and growing corporate participation across sectors.</p>
                    </article>
                    <article class="pub-key-facts-card">
                        <h3 class="pub-key-facts-metric">29%</h3>
                        <p class="pub-key-facts-text">New incorporations surged year-on-year, driven by streamlined MCA processes through the SPICe+ platform.</p>
                    </article>
                    <article class="pub-key-facts-card">
                        <h3 class="pub-key-facts-metric">5.57 lakh</h3>
                        <p class="pub-key-facts-text">Maharashtra leads in registered firms, indicating a strong ecosystem for large-scale and public company structures.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="pub-launch-cta py-90" aria-labelledby="pub-launch-cta-title">
            <div class="container">
                <div class="pub-launch-cta-card">
                    <h2 id="pub-launch-cta-title" class="pub-launch-cta-title">Launch Your Public Limited<br>Company Today</h2>
                    <p class="pub-launch-cta-copy">A Public Limited Company registration opens access to public capital, broader investor credibility, and a governance structure built for large-scale growth. Whether planning an eventual IPO, raising institutional funding, or building the corporate infrastructure for long-term expansion, CAAFT delivers accurate, compliant incorporation with the compliance foundation properly established from day one.</p>
                    <a href="/contact#contact_us" class="theme-btn pub-launch-cta-btn">Start &amp; Scale Your Business Now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <div id="faq" class="faq-area are_sections_faq py-120 caaft-ar-faq-wrap" aria-labelledby="pub-ltd-faq-heading"><div class="container"><div class="site-heading text-center mb-3"><h2 id="pub-ltd-faq-heading" class="site-title my-3">Frequently Asked Questions</h2></div>
            <div class="frequent-question col-lg-10"><div class="accordion" id="accordionPubLtdFaq">
                <div class="accordion-item"><p class="accordion-header" id="pubLtdFaqHeading1"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pubLtdFaqCollapse1" aria-expanded="true">1. Does registering as a Public Limited Company mean the business must list on a stock exchange immediately?</button></p><div id="pubLtdFaqCollapse1" class="accordion-collapse collapse show" aria-labelledby="pubLtdFaqHeading1" data-bs-parent="#accordionPubLtdFaq"><div class="accordion-body">No. A Public Limited Company can remain unlisted and still raise capital from a wider investor pool. Listing on BSE or NSE is a separate decision that happens only when the company actively pursues an IPO through the SEBI regulatory process — which can occur years after initial incorporation.</div></div></div>
                <div class="accordion-item"><p class="accordion-header" id="pubLtdFaqHeading2"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pubLtdFaqCollapse2">2. How does Public Limited Company registration affect a promoter's control over the business?</button></p><div id="pubLtdFaqCollapse2" class="accordion-collapse collapse" aria-labelledby="pubLtdFaqHeading2" data-bs-parent="#accordionPubLtdFaq"><div class="accordion-body">As shareholding widens and shares become freely transferable, promoter dilution becomes a real consideration. Founders should establish voting rights protections, board composition safeguards, and shareholder agreements before registering — not after growth makes restructuring complicated and costly.</div></div></div>
                <div class="accordion-item"><p class="accordion-header" id="pubLtdFaqHeading3"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pubLtdFaqCollapse3">3. Can a Public Limited Company offer ESOPs more effectively than a Private Limited Company?</button></p><div id="pubLtdFaqCollapse3" class="accordion-collapse collapse" aria-labelledby="pubLtdFaqHeading3" data-bs-parent="#accordionPubLtdFaq"><div class="accordion-body">Yes. Fewer restrictions on ESOP issuance and the freely transferable nature of shares make ESOPs genuinely attractive to employees — because there is a realistic liquidity pathway, rather than an indefinite wait for a buyout or secondary transaction.</div></div></div>
                <div class="accordion-item"><p class="accordion-header" id="pubLtdFaqHeading4"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pubLtdFaqCollapse4">4. What compliance burden should a business realistically expect after Public Limited Company incorporation?</button></p><div id="pubLtdFaqCollapse4" class="accordion-collapse collapse" aria-labelledby="pubLtdFaqHeading4" data-bs-parent="#accordionPubLtdFaq"><div class="accordion-body">It is significant. Beyond ROC filings, businesses should expect mandatory statutory audits, a qualified Company Secretary, public financial disclosures, and SEBI obligations if listed. Dedicated compliance infrastructure must be budgeted before the switch to this structure — not after operational pressures mount.</div></div></div>
                <div class="accordion-item"><p class="accordion-header" id="pubLtdFaqHeading5"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pubLtdFaqCollapse5">5. Is a Public Limited Company suitable for a family business planning generational succession?</button></p><div id="pubLtdFaqCollapse5" class="accordion-collapse collapse" aria-labelledby="pubLtdFaqHeading5" data-bs-parent="#accordionPubLtdFaq"><div class="accordion-body">It can be — but free share transferability can dilute family control over time. Promoter families often use holding companies or preference shares with special voting rights to retain strategic control while still accessing public capital. This structure must be planned and documented at incorporation — retrofitting it later is significantly more complex and costly.</div></div></div>
            </div></div>
        </div></div>

    </main>
    <?php include "footer.php"; ?>
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <?php include "footer-bottom.php"; ?>
</body>
</html>
