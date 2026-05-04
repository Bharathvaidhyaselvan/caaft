<?php
declare(strict_types=1);
$plcRequestPath = trim((string) (parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: ''), '/');
$plcCanonicalSlug = 'one-person-company-registration';
$plcLegacyPaths = [
    'company-incorporation/one-person-company-registration',
    'one-person-company-registration-online',
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
    <title>One Person Company Registration | OPC Full Form, Benefits &amp; Process</title>
    <meta name="description" content="Apply for one person company registration with an easy step-by-step process. Learn OPC full form, eligibility, benefits, documents required, and registration procedure for starting your OPC in India.">
    <meta name="keywords" content="one person company registration, how to register one person company, opc registration process, OPC India, SPICe+ incorporation">
    <link rel="canonical" href="https://caaft.com/one-person-company-registration/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="One Person Company Registration | OPC Full Form, Benefits &amp; Process">
    <meta property="og:description" content="Apply for one person company registration with an easy step-by-step process. Learn OPC full form, eligibility, benefits, documents required, and registration procedure for starting your OPC in India.">
    <meta property="og:url" content="https://caaft.com/one-person-company-registration/">
    <meta property="og:site_name" content="CAAFT Consultancy Services">
    <meta property="og:image" content="https://caaft.com/assets/img/gst-registration-overview.jpg">
    <style>
        .page-opc-registration .caaft-ar-trust-indicators { background: #ffffff !important; }
        .page-opc-registration .bk-overview .bk-section-title {
            margin: 0 0 1.75rem;
            text-align: left;
        }
        .page-opc-registration .bk-overview .bk-overview-text {
            margin: 0 0 1.75rem;
            text-align: left;
            font-size: 1.02rem;
            line-height: 1.6;
            color: #2f2f2f;
        }
        .page-opc-registration .bk-overview .bk-overview-bullets {
            margin: 0 0 1.75rem;
            color: #2f2f2f;
        }
        .page-opc-registration .bk-overview-layout {
            align-items: center;
        }
        .page-opc-registration .bk-overview-image-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            align-self: center;
        }
        .page-opc-registration .bk-overview-image-wrap img {
            object-fit: contain;
            width: 100%;
            max-height: min(340px, 50vh);
            height: auto;
        }
        .page-opc-registration .plc-section-lead {
            margin: 0 0 1rem;
            color: #4d5868;
            line-height: 1.68;
            max-width: 900px;
        }
        .page-opc-registration .plc-needs-wrap {
            padding-top: 44px;
            padding-bottom: 44px;
        }
        .page-opc-registration .plc-needs-title,
        .page-opc-registration .plc-section-h2 {
            margin: 0 0 10px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-opc-registration .plc-needs-intro {
            margin: 0 0 20px;
            max-width: 900px;
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.65;
            font-weight: 500;
        }
        .page-opc-registration .plc-needs-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 20px;
            margin-top: 0;
        }
        .page-opc-registration .plc-needs-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-left: 4px solid var(--theme-color, #33b6ff);
            border-radius: 8px;
            padding: 18px 20px 18px 22px;
            box-shadow: none;
        }
        .page-opc-registration .plc-needs-card h3 {
            margin: 0 0 10px;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2c40;
            line-height: 1.35;
        }
        .page-opc-registration .plc-needs-card p {
            margin: 0;
            font-size: 0.97rem;
            line-height: 1.62;
            color: #6b7280;
        }
        .page-opc-registration .plc-bullet-list {
            margin: 12px 0 0;
            padding-left: 1.25rem;
            color: #2f3948;
            line-height: 1.65;
        }
        .page-opc-registration .plc-bullet-list li {
            margin-bottom: 8px;
        }
        .page-opc-registration .plc-legal-wrap {
            background: #f0f7ff;
            padding-top: 48px;
            padding-bottom: 48px;
        }
        .page-opc-registration .plc-legal-wrap .plc-section-h2 {
            margin-bottom: 10px;
        }
        .page-opc-registration .plc-legal-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-top: 18px;
        }
        .page-opc-registration .plc-legal-card {
            position: relative;
            background: #ffffff;
            border-radius: 12px;
            padding: 22px 22px 24px;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.07);
            border: 1px solid rgba(226, 232, 240, 0.9);
            overflow: hidden;
            min-height: 0;
        }
        .page-opc-registration .plc-legal-card-num {
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
        .page-opc-registration .plc-legal-card h3 {
            position: relative;
            margin: 0 0 12px;
            padding-right: 4.5rem;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.35;
        }
        .page-opc-registration .plc-legal-card p {
            position: relative;
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.65;
            color: #4a5568;
            font-weight: 500;
        }
        .page-opc-registration .plc-docs-section {
            padding-top: 44px;
            padding-bottom: 44px;
            background: #ffffff;
        }
        .page-opc-registration .plc-docs-section .plc-docs-title {
            margin: 0 0 22px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-opc-registration .plc-docs-cards-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            align-items: stretch;
        }
        .page-opc-registration .plc-docs-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 22px 22px 20px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }
        .page-opc-registration .plc-docs-card-head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 14px;
            margin-bottom: 14px;
            border-bottom: 1px solid #e8edf2;
        }
        .page-opc-registration .plc-docs-card-icon {
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
        .page-opc-registration .plc-docs-card-icon--violet {
            background: #7c3aed;
        }
        .page-opc-registration .plc-docs-card-icon--green {
            background: #10b981;
        }
        .page-opc-registration .plc-docs-card-icon--amber {
            background: #f59e0b;
        }
        .page-opc-registration .plc-docs-card-icon--blue {
            background: #3b82f6;
        }
        .page-opc-registration .plc-docs-card h3 {
            margin: 0;
            font-size: 1.08rem;
            font-weight: 700;
            color: #1a202c;
            line-height: 1.35;
        }
        .page-opc-registration .plc-docs-card-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .page-opc-registration .plc-docs-card-list li {
            position: relative;
            padding: 6px 0 6px 1.15rem;
            font-size: 0.97rem;
            line-height: 1.55;
            font-weight: 500;
            color: #4a5568;
        }
        .page-opc-registration .plc-docs-card-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.62em;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--theme-color, #33b6ff);
        }
        .page-opc-registration .plc-docs-card-list li + li {
            margin-top: 2px;
        }
        /* Compliance rows (icon + title + body), theme blue */
        .page-opc-registration .opc-compliance-rows {
            padding-top: 44px;
            padding-bottom: 48px;
            background: #ffffff;
        }
        .page-opc-registration .opc-compliance-title {
            margin: 0 0 10px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-opc-registration .opc-compliance-title-em {
            font-style: italic;
            font-weight: 700;
            color: var(--theme-color, #33b6ff);
        }
        .page-opc-registration .opc-compliance-lead {
            margin: 0 0 22px;
            max-width: 900px;
            font-size: 1.02rem;
            line-height: 1.65;
            font-weight: 500;
            color: #6b7280;
        }
        .page-opc-registration .opc-compliance-list {
            margin: 0;
            padding: 0;
            list-style: none;
            border: 1px solid #e8edf2;
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }
        .page-opc-registration .opc-compliance-list > li {
            list-style: none;
        }
        .page-opc-registration .opc-compliance-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid #e8edf2;
        }
        .page-opc-registration .opc-compliance-item:last-child {
            border-bottom: 0;
        }
        .page-opc-registration .opc-compliance-icon-wrap {
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(51, 182, 255, 0.14);
            color: var(--theme-color, #33b6ff);
            font-size: 1.05rem;
        }
        .page-opc-registration .opc-compliance-body h3 {
            margin: 0 0 6px;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2c40;
            line-height: 1.35;
        }
        .page-opc-registration .opc-compliance-body p {
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.62;
            font-weight: 500;
            color: #4a5568;
        }
        .page-opc-registration .opc-industries-section {
            padding-top: 44px;
            padding-bottom: 48px;
            background: #f8fafc;
        }
        .page-opc-registration .opc-industries-title {
            margin: 0 0 10px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-opc-registration .opc-industries-title-em {
            font-style: normal;
            font-weight: 700;
            color: var(--theme-color, #33b6ff);
        }
        .page-opc-registration .opc-industries-intro {
            margin: 0 0 22px;
            max-width: 900px;
            font-size: 1.02rem;
            line-height: 1.65;
            color: #4b5768;
        }
        .page-opc-registration .opc-industries-list {
            margin: 0;
            padding: 0;
            list-style: none;
            background: #ffffff;
            border: 1px solid #e8edf2;
            border-radius: 12px;
            overflow: hidden;
        }
        .page-opc-registration .opc-industries-list > li {
            list-style: none;
        }
        .page-opc-registration .opc-industries-row {
            display: flex;
            align-items: center;
            gap: 14px 18px;
            padding: 14px 18px;
            border-bottom: 1px solid #e8edf2;
            flex-wrap: wrap;
        }
        .page-opc-registration .opc-industries-row:last-child {
            border-bottom: 0;
        }
        .page-opc-registration .opc-industries-num {
            flex: 0 0 auto;
            font-style: italic;
            font-size: 0.92rem;
            font-weight: 600;
            color: #64748b;
            min-width: 1.15rem;
        }
        .page-opc-registration .opc-industries-text {
            flex: 1 1 auto;
            min-width: 120px;
            font-size: 1rem;
            line-height: 1.5;
            font-weight: 500;
            color: #334155;
        }
        .page-opc-registration .opc-industries-tag {
            flex: 0 0 auto;
            margin-left: auto;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(51, 182, 255, 0.12);
            color: var(--theme-color, #33b6ff);
            border: 1px solid rgba(51, 182, 255, 0.35);
        }
        @media (max-width: 575.98px) {
            .page-opc-registration .opc-industries-row {
                align-items: flex-start;
            }
            .page-opc-registration .opc-industries-tag {
                margin-left: 0;
                width: 100%;
                text-align: center;
            }
        }
        /* Benefits: check in theme-blue circle, title + description, row dividers */
        .page-opc-registration .opc-benefits-section {
            padding-top: 44px;
            padding-bottom: 48px;
            background: #f8fafc;
        }
        .page-opc-registration .opc-benefits-title {
            margin: 0 0 22px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-opc-registration .opc-benefits-list {
            margin: 0;
            padding: 0;
            list-style: none;
            background: #ffffff;
            border: 1px solid #e8edf2;
            border-radius: 12px;
            overflow: hidden;
        }
        .page-opc-registration .opc-benefits-list > li {
            list-style: none;
        }
        .page-opc-registration .opc-benefits-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid #e8edf2;
        }
        .page-opc-registration .opc-benefits-item:last-child {
            border-bottom: 0;
        }
        .page-opc-registration .opc-benefits-check-wrap {
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--theme-color, #33b6ff);
            color: #ffffff;
            font-size: 0.88rem;
            line-height: 1;
        }
        .page-opc-registration .opc-benefits-body {
            flex: 1 1 auto;
            min-width: 0;
        }
        .page-opc-registration .opc-benefits-item-title {
            margin: 0 0 6px;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2c40;
            line-height: 1.35;
        }
        .page-opc-registration .opc-benefits-item-text {
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.62;
            font-weight: 500;
            color: #4a5568;
        }
        /* Common mistakes: stacked cards, cream bg, theme-blue left accent */
        .page-opc-registration .opc-mistakes-section {
            padding-top: 44px;
            padding-bottom: 48px;
            background: #ffffff;
        }
        .page-opc-registration .opc-mistakes-title {
            margin: 0 0 10px;
            color: #1f2c40;
            font-size: clamp(1.5rem, 2.2vw, 2.1rem);
            line-height: 1.2;
            font-weight: 700;
        }
        .page-opc-registration .opc-mistakes-intro {
            margin: 0 0 22px;
            max-width: 900px;
            font-size: 1.02rem;
            line-height: 1.65;
            font-weight: 500;
            color: #4b5768;
        }
        .page-opc-registration .opc-mistakes-list {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .page-opc-registration .opc-mistakes-list > li {
            list-style: none;
        }
        .page-opc-registration .opc-mistakes-card {
            margin: 0;
            padding: 18px 20px 18px 22px;
            background: #f9f9f4;
            border-radius: 8px;
            border: 1px solid #ecece4;
            border-left: 5px solid var(--theme-color, #33b6ff);
        }
        .page-opc-registration .opc-mistakes-card-title {
            margin: 0 0 8px;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1f2c40;
            line-height: 1.35;
        }
        .page-opc-registration .opc-mistakes-card-text {
            margin: 0;
            font-size: 0.98rem;
            line-height: 1.62;
            font-weight: 500;
            color: #4a5568;
        }
        @media (max-width: 991.98px) {
            .page-opc-registration .plc-needs-grid {
                grid-template-columns: 1fr;
            }
            .page-opc-registration .plc-legal-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 767.98px) {
            .page-opc-registration .plc-docs-cards-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 575.98px) {
            .page-opc-registration .plc-legal-grid {
                grid-template-columns: 1fr;
            }
        }
        .page-opc-registration .opc-vs-section {
            padding-top: 44px;
            padding-bottom: 48px;
            background: #ffffff;
        }
        .page-opc-registration .opc-vs-section .table-responsive {
            margin-top: 8px;
        }
        .page-opc-registration .opc-vs-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.98rem;
        }
        .page-opc-registration .opc-vs-table th,
        .page-opc-registration .opc-vs-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 14px;
            vertical-align: top;
            line-height: 1.5;
        }
        .page-opc-registration .opc-vs-table thead th {
            background: #f0f7ff;
            color: #1f2c40;
            font-weight: 700;
        }
        .page-opc-registration .opc-vs-table tbody td:first-child {
            font-weight: 600;
            color: #1f2c40;
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
          "@id": "https://caaft.com/one-person-company-registration/#service",
          "name": "One Person Company Registration",
          "alternateName": "OPC Registration Services India",
          "url": "https://caaft.com/one-person-company-registration/",
          "description": "Complete one person company registration services including DSC, DIN, name approval, SPICe+ filing, MOA/AOA drafting, and compliance support for entrepreneurs, freelancers, and professionals across India.",
          "provider": { "@id": "https://caaft.com/#organization" },
          "areaServed": { "@type": "Country", "name": "India" },
          "serviceType": "Company Registration and Compliance Services"
        },
        {
          "@type": "FAQPage",
          "@id": "https://caaft.com/one-person-company-registration/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "Can an OPC be incorporated with a residential property as the registered office address?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. A residential address is permitted as the registered office of a One Person Company under the Companies Act, 2013 — provided a valid utility bill and NOC from the property owner are submitted. This makes OPC registration accessible to home-based founders without requiring commercial premises."
              }
            },
            {
              "@type": "Question",
              "name": "Can the nominee of an OPC be changed after incorporation?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. The nominee can be changed at any time after incorporation with the written consent of both the existing and incoming nominee. The change must be intimated to the MCA by filing the prescribed form within the stipulated timeline."
              }
            },
            {
              "@type": "Question",
              "name": "What happens if an OPC owner becomes a Non-Resident Indian (NRI) after incorporation?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "If the sole member ceases to be a resident of India — defined as staying in India for fewer than 182 days in the preceding calendar year — the OPC becomes ineligible to continue in its current structure and must convert into another company form within the prescribed period."
              }
            },
            {
              "@type": "Question",
              "name": "Can an OPC have employees even though it has only one shareholder?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. The restriction on a One Person Company applies to the number of shareholders — not the number of employees. An OPC can hire any number of employees and operate with a full workforce while maintaining single-shareholder ownership."
              }
            },
            {
              "@type": "Question",
              "name": "Is it possible to convert an OPC directly into an LLP?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "The Companies Act, 2013 provides a conversion pathway from OPC to Private Limited Company but does not provide a direct conversion mechanism from OPC to LLP. Conversion to LLP would require first converting the OPC to a Private Limited Company and then following the LLP conversion procedure — making it a two-stage process that should be planned in advance."
              }
            }
          ]
        },
        {
          "@type": "BreadcrumbList",
          "@id": "https://caaft.com/one-person-company-registration/#breadcrumb",
          "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://caaft.com" },
            { "@type": "ListItem", "position": 2, "name": "One Person Company Registration", "item": "https://caaft.com/one-person-company-registration/" }
          ]
        }
      ]
    }
    </script>
</head>
<body class="home-3 page-accounting-reporting page-opc-registration">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQ559WPT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <div class="header-sections"><?php include "header.php"; ?></div>
    <main class="main">
        <?php
        $caaft_hero_id = 'opc-h1';
        $caaft_hero_h1 = 'One Person Company (OPC) Registration Services';
        $caaft_hero_h2_before = 'One Founder. One Company. Complete Legal Protection — ';
        $caaft_hero_h2_highlight = 'Built Right From Day One.';
        $caaft_hero_h2_after = '';
        $caaft_hero_lead_paragraphs = [
            'A One Person Company gives solo entrepreneurs what a sole proprietorship never could — a separate legal identity, limited liability protection, and the credibility of a registered corporate structure, all under single ownership.',
            'Understanding how to register a One Person Company and navigating the OPC registration process correctly from the start ensures faster incorporation, cleaner compliance, and a stronger legal foundation. CAAFT manages the complete One Person Company registration for individual founders, freelancers, and independent professionals across India — from DSC procurement and name approval through to Certificate of Incorporation and post-registration compliance.',
        ];
        $caaft_hero_primary_cta_label = 'Start Your OPC Now';
        $caaft_hero_primary_cta_href = '/contact#contact_us';
        $caaft_hero_secondary_cta_label = 'Register in Minutes';
        $caaft_hero_secondary_cta_href = '/contact#contact_us';
        $caaft_hero_secondary_cta_icon = 'fas fa-arrow-right';
        $caaft_enquiry_service = 'One Person Company (OPC) Registration';
        $caaft_enquiry_action = '/business-registration-mail.php';
        $caaft_enquiry_title = 'Let\'s Talk';
        $caaft_enquiry_recaptcha = false;
        $caaft_enquiry_honeypot_website = false;
        include __DIR__ . '/../../includes/components/service-hero-with-enquiry.php';
        ?>

        <?php
        $caaft_trust_items = [
            ['icon_class' => 'fas fa-star', 'title' => 'Rated 4.8/5 ⭐', 'description' => 'on Google'],
            ['icon_class' => 'fas fa-building', 'title' => '500+', 'description' => 'OPCs Registered'],
            ['icon_class' => 'fas fa-bolt', 'title' => 'Fast', 'description' => 'Hassle-Free Process'],
            ['icon_class' => 'fas fa-lock', 'title' => '100%', 'description' => 'Data Confidentiality'],
        ];
        include __DIR__ . '/../../includes/components/service-trust-indicators.php';
        ?>

        <?php
        $caaft_overview_heading_id = 'opc-what-heading';
        $caaft_overview_title = 'What is a One Person Company (OPC)?';
        $caaft_overview_paragraphs = [
            'A One Person Company (OPC), introduced under the Companies Act, 2013, allows a single individual to incorporate and run a company with full limited liability protection. Unlike a sole proprietorship, an OPC is a separate legal entity — keeping the owner\'s personal assets protected from business liabilities at all times.',
            'Designed specifically for solo entrepreneurs, an OPC offers the legal credibility of a private limited company without requiring multiple shareholders or directors. The owner can serve as both sole shareholder and director — retaining complete control under a formally recognised corporate framework.',
        ];
        $caaft_overview_bullets = [];
        $caaft_overview_closing = '';
        $caaft_overview_image_src = '/assets/img/gst-registration-overview.jpg';
        $caaft_overview_image_alt = 'One Person Company registration and OPC incorporation support';
        include __DIR__ . '/../../includes/components/caaft-overview-card.php';
        ?>

        <section class="plc-needs-wrap" aria-labelledby="opc-needs-heading">
            <div class="container">
                <h2 id="opc-needs-heading" class="plc-needs-title">Who Needs One Person Company Registration?</h2>
                <p class="plc-needs-intro">OPC registration is the right structure for a specific category of founders and independent professionals:</p>
                <div class="plc-needs-grid">
                    <article class="plc-needs-card"><h3>Solo entrepreneurs</h3><p>Starting a business without co-founders or multiple investors.</p></article>
                    <article class="plc-needs-card"><h3>Freelancers &amp; consultants</h3><p>Seeking limited liability and corporate credibility.</p></article>
                    <article class="plc-needs-card"><h3>IT, design &amp; digital marketing</h3><p>Practitioners formalising their operations.</p></article>
                    <article class="plc-needs-card"><h3>E-commerce &amp; online retail</h3><p>Separating personal and business finances.</p></article>
                    <article class="plc-needs-card"><h3>Financial &amp; tax professionals</h3><p>Advisors and professional service providers.</p></article>
                    <article class="plc-needs-card"><h3>Early-stage startups</h3><p>Validating ideas before scaling to a Private Limited structure.</p></article>
                    <article class="plc-needs-card"><h3>Home-based businesses</h3><p>A registered corporate structure without commercial premises.</p></article>
                    <article class="plc-needs-card"><h3>Import–export</h3><p>Small businesses needing corporate registration for trade documentation.</p></article>
                </div>
            </div>
        </section>

        <section class="plc-legal-wrap" aria-labelledby="opc-eligibility-heading">
            <div class="container">
                <h2 id="opc-eligibility-heading" class="plc-section-h2">Eligibility Criteria for One Person Company Registration</h2>
                <p class="plc-section-lead">Before initiating the OPC registration process, the following eligibility conditions must be confirmed:</p>
                <div class="plc-legal-grid" role="list">
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">01</span>
                        <h3>Single shareholder</h3>
                        <p>Only one shareholder is permitted in a One Person Company.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">02</span>
                        <h3>Indian citizen &amp; resident</h3>
                        <p>The shareholder must be an Indian citizen and a resident of India (present for at least 182 days in the preceding calendar year).</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">03</span>
                        <h3>Nominee appointment</h3>
                        <p>Appointment of a nominee is mandatory at the time of incorporation.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">04</span>
                        <h3>Minimum one director</h3>
                        <p>A minimum of one director is required — the owner can serve as director.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">05</span>
                        <h3>Registered office in India</h3>
                        <p>A registered office address in India is compulsory.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">06</span>
                        <h3>Natural persons only</h3>
                        <p>Only natural persons can form an OPC — companies or LLPs are not eligible.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">07</span>
                        <h3>One OPC per individual</h3>
                        <p>One individual cannot incorporate or hold membership in more than one OPC simultaneously.</p>
                    </article>
                    <article class="plc-legal-card" role="listitem">
                        <span class="plc-legal-card-num" aria-hidden="true">08</span>
                        <h3>Restricted activities</h3>
                        <p>Certain restricted business activities are not permitted under the OPC structure.</p>
                    </article>
                </div>
            </div>
        </section>

        <?php
        $caaft_delivered_heading_id = 'opc-delivered-heading';
        $caaft_delivered_title = 'One Person Company Registration Services — What Gets Delivered';
        $caaft_delivered_items = [
            ['name' => 'DSC procurement', 'text' => 'Digital Signature Certificates obtained for the proposed director — mandatory for all online MCA filings.'],
            ['name' => 'DIN application', 'text' => 'Director Identification Number applied for through the MCA portal or integrated within the SPICe+ form.'],
            ['name' => 'Company name approval', 'text' => 'Unique name proposed and reserved through MCA — verified against existing registrations and trademarks.'],
            ['name' => 'MOA & AOA drafting', 'text' => 'Memorandum of Association and Articles of Association drafted accurately — defining business objectives and internal governance rules.'],
            ['name' => 'Nominee appointment', 'text' => 'Nominee consent obtained and filed in the prescribed format — ensuring business continuity compliance from inception.'],
            ['name' => 'SPICe+ incorporation filing', 'text' => 'All incorporation forms, documents, and supporting materials submitted accurately through the integrated MCA portal.'],
            ['name' => 'PAN and TAN issuance', 'text' => 'Issued automatically alongside the Certificate of Incorporation through the SPICe+ process.'],
            ['name' => 'Certificate of Incorporation', 'text' => 'Official Certificate of Incorporation obtained after MCA verification — with Company Identification Number (CIN) confirming legal existence.'],
            ['name' => 'Post-incorporation compliance setup', 'text' => 'Annual filing calendar, statutory register framework, and compliance obligations established from day one.'],
        ];
        include __DIR__ . '/../../includes/components/caaft-get-delivered.php';
        ?>

        <section class="opc-vs-section" aria-labelledby="opc-vs-heading">
            <div class="container">
                <h2 id="opc-vs-heading" class="plc-section-h2">OPC vs Sole Proprietorship — Key Differences</h2>
                <div class="table-responsive">
                    <table class="opc-vs-table">
                        <thead>
                            <tr><th>Aspect</th><th>OPC</th><th>Sole Proprietorship</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Legal Status</td><td>separate legal entity</td><td>no separate identity</td></tr>
                            <tr><td>Liability</td><td>limited to capital contribution</td><td>unlimited personal liability</td></tr>
                            <tr><td>Registration</td><td>mandatory under Companies Act, 2013</td><td>simple registration or trade licence</td></tr>
                            <tr><td>Compliance</td><td>moderate statutory compliance</td><td>minimal requirements</td></tr>
                            <tr><td>Credibility</td><td>higher — registered corporate structure</td><td>lower compared to registered entities</td></tr>
                            <tr><td>Funding Access</td><td>better loan and credit eligibility</td><td>limited funding options</td></tr>
                            <tr><td>Business Continuity</td><td>perpetual succession via nominee</td><td>ends with the owner</td></tr>
                            <tr><td>Tax Structure</td><td>corporate tax rates</td><td>individual income tax rates</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <?php
        $caaft_steps_heading_id = 'opc-steps-heading';
        $caaft_steps_title = 'Step-by-Step Process';
        $caaft_steps_numbered = true;
        $caaft_steps_items = [
            ['title' => 'Obtain a Digital Signature Certificate (DSC)', 'text' => 'A DSC is mandatory to digitally sign all incorporation documents during the online registration process. All designated signatories must hold a valid DSC before any MCA filing can proceed.'],
            ['title' => 'Apply for a Director Identification Number (DIN)', 'text' => 'The proposed director obtains a DIN through the MCA portal — typically integrated within the SPICe+ incorporation form, avoiding a separate filing step for most OPC registrations.'],
            ['title' => 'Company Name Approval', 'text' => 'A unique company name is proposed and submitted through the RUN or SPICe+ form for MCA approval — verified against naming guidelines and existing registered companies or trademarks.'],
            ['title' => 'Draft the MOA and AOA', 'text' => 'The Memorandum of Association (MOA) defines the company\'s business objectives and scope. The Articles of Association (AOA) governs internal management rules. Errors in these documents are one of the most common causes of registration delays and post-incorporation compliance issues.'],
            ['title' => 'File the SPICe+ Incorporation Form', 'text' => 'The integrated SPICe+ form consolidates name reservation, incorporation, DIN allotment, PAN, TAN, and registered office address filing into a single submission — significantly streamlining the registration process.'],
            ['title' => 'Nominee Appointment', 'text' => 'A nominee is appointed and written consent is obtained during incorporation — ensuring the OPC\'s ownership transfers correctly in the event of the owner\'s death or incapacity.'],
            ['title' => 'PAN and TAN Issuance', 'text' => 'PAN and TAN are issued automatically alongside the Certificate of Incorporation through the integrated SPICe+ process — no separate applications required.'],
            ['title' => 'Certificate of Incorporation', 'text' => 'Upon successful MCA verification, the Certificate of Incorporation is issued along with the Company Identification Number (CIN) — formally establishing the One Person Company as a legal entity.'],
            ['title' => 'Open a Business Bank Account', 'text' => 'The Certificate of Incorporation, PAN, and MOA are used to open a dedicated current account in the company\'s name — separating business and personal finances from the first day of operations.'],
        ];
        include __DIR__ . '/../../includes/components/caaft-step-by-step.php';
        ?>

        <section class="plc-docs-section" aria-labelledby="opc-docs-heading">
            <div class="container">
                <h2 id="opc-docs-heading" class="plc-docs-title">Documents Required for OPC Registration</h2>
                <div class="plc-docs-cards-grid">
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--violet" aria-hidden="true"><i class="fas fa-user"></i></span>
                            <h3>Director and Shareholder</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>PAN card</li>
                            <li>Aadhaar card or valid government-issued identity proof</li>
                            <li>Recent passport-size photograph</li>
                            <li>Address proof — bank statement or utility bill not older than two months</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--green" aria-hidden="true"><i class="fas fa-user-check"></i></span>
                            <h3>Nominee</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Identity proof and address proof of the nominee</li>
                            <li>Written consent of the nominee in the prescribed form</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--amber" aria-hidden="true"><i class="fas fa-building"></i></span>
                            <h3>Registered Office</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Utility bill for the registered address not older than two months</li>
                            <li>No Objection Certificate (NOC) from the property owner if the premises are rented</li>
                        </ul>
                    </article>
                    <article class="plc-docs-card">
                        <div class="plc-docs-card-head">
                            <span class="plc-docs-card-icon plc-docs-card-icon--blue" aria-hidden="true"><i class="fas fa-file-alt"></i></span>
                            <h3>Filing</h3>
                        </div>
                        <ul class="plc-docs-card-list">
                            <li>Digital Signature Certificate (DSC) for online portal submission</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section class="opc-compliance-rows" aria-labelledby="opc-compliance-heading">
            <div class="container">
                <h2 id="opc-compliance-heading" class="opc-compliance-title">Compliance Requirements After <em class="opc-compliance-title-em">OPC Registration</em></h2>
                <p class="opc-compliance-lead">Completing OPC registration is only the beginning. Registered One Person Companies must fulfil ongoing annual and event-based compliance obligations:</p>
                <ul class="opc-compliance-list">
                    <li class="opc-compliance-item">
                        <span class="opc-compliance-icon-wrap" aria-hidden="true"><i class="far fa-file-alt"></i></span>
                        <div class="opc-compliance-body">
                            <h3>Annual financial statement filing</h3>
                            <p>Financial statements and annual returns submitted to the MCA within prescribed deadlines each financial year.</p>
                        </div>
                    </li>
                    <li class="opc-compliance-item">
                        <span class="opc-compliance-icon-wrap" aria-hidden="true"><i class="fas fa-laptop"></i></span>
                        <div class="opc-compliance-body">
                            <h3>Income tax return filing</h3>
                            <p>Company ITR filed annually — separate from the owner&apos;s personal income tax return.</p>
                        </div>
                    </li>
                    <li class="opc-compliance-item">
                        <span class="opc-compliance-icon-wrap" aria-hidden="true"><i class="far fa-check-square"></i></span>
                        <div class="opc-compliance-body">
                            <h3>Statutory audit</h3>
                            <p>Mandatory for all OPCs regardless of turnover — unlike LLPs, which have a threshold-based audit requirement.</p>
                        </div>
                    </li>
                    <li class="opc-compliance-item">
                        <span class="opc-compliance-icon-wrap" aria-hidden="true"><i class="far fa-bookmark"></i></span>
                        <div class="opc-compliance-body">
                            <h3>Maintenance of statutory registers</h3>
                            <p>Company records, resolutions, and registers maintained and available for inspection at all times.</p>
                        </div>
                    </li>
                    <li class="opc-compliance-item">
                        <span class="opc-compliance-icon-wrap" aria-hidden="true"><i class="fas fa-wave-square"></i></span>
                        <div class="opc-compliance-body">
                            <h3>GST compliance</h3>
                            <p>If the OPC is GST-registered, periodic return filing is mandatory based on the applicable filing frequency.</p>
                        </div>
                    </li>
                    <li class="opc-compliance-item">
                        <span class="opc-compliance-icon-wrap" aria-hidden="true"><i class="fas fa-info-circle"></i></span>
                        <div class="opc-compliance-body">
                            <h3>Event-based filings</h3>
                            <p>Changes in director details, registered office, nominee, or business objects intimated to the MCA through the relevant forms within prescribed timelines.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="opc-industries-section" aria-labelledby="opc-industries-heading">
            <div class="container">
                <h2 id="opc-industries-heading" class="opc-industries-title">Industries Suitable for <em class="opc-industries-title-em">One Person Company</em> Registration</h2>
                <p class="opc-industries-intro">OPC registration works well for solo founders and independent professionals across a wide range of sectors.</p>
                <ul class="opc-industries-list" role="list">
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">1</span>
                        <span class="opc-industries-text">Consulting and professional services</span>
                        <span class="opc-industries-tag">Services</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">2</span>
                        <span class="opc-industries-text">IT services and software development</span>
                        <span class="opc-industries-tag">Technology</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">3</span>
                        <span class="opc-industries-text">Digital marketing and content agencies</span>
                        <span class="opc-industries-tag">Marketing</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">4</span>
                        <span class="opc-industries-text">Freelancers and independent professionals</span>
                        <span class="opc-industries-tag">Freelance</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">5</span>
                        <span class="opc-industries-text">E-commerce and online retail businesses</span>
                        <span class="opc-industries-tag">Retail</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">6</span>
                        <span class="opc-industries-text">Financial advisory and tax consultancy</span>
                        <span class="opc-industries-tag">Finance</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">7</span>
                        <span class="opc-industries-text">Import-export small businesses</span>
                        <span class="opc-industries-tag">Trade</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">8</span>
                        <span class="opc-industries-text">Coaching, training, and educational services</span>
                        <span class="opc-industries-tag">Education</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">9</span>
                        <span class="opc-industries-text">Creative agencies — design, media, and production</span>
                        <span class="opc-industries-tag">Creative</span>
                    </li>
                    <li class="opc-industries-row" role="listitem">
                        <span class="opc-industries-num" aria-hidden="true">10</span>
                        <span class="opc-industries-text">Startup founders validating early-stage business ideas</span>
                        <span class="opc-industries-tag">Startups</span>
                    </li>
                </ul>
            </div>
        </section>

        <?php
        $opc_benefits_items = [
            [
                'label' => 'Limited Liability Protection',
                'text' => 'Personal assets are completely protected from business debts and liabilities. The OPC bears its own financial obligations as an independent legal entity — the owner\'s personal finances remain entirely separate.',
            ],
            [
                'label' => 'Separate Legal Identity',
                'text' => 'The company can own property, enter contracts, and take legal action in its own name — independent of the owner\'s personal identity — providing a credibility foundation that sole proprietorships cannot offer.',
            ],
            [
                'label' => 'Complete Control Over Decision-Making',
                'text' => 'Single ownership eliminates shareholder disputes and allows the founder to make and execute business decisions without requiring consensus or approval from co-shareholders.',
            ],
            [
                'label' => 'Enhanced Business Credibility',
                'text' => 'A registered corporate structure improves trust with clients, vendors, banks, and institutional partners — significantly more than a sole proprietorship or unregistered freelance setup.',
            ],
            [
                'label' => 'Better Access to Funding',
                'text' => 'Banks and financial institutions treat OPCs more favourably than unregistered entities when evaluating loan applications and credit facilities — making corporate registration a direct financial advantage.',
            ],
            [
                'label' => 'Perpetual Succession',
                'text' => 'The mandatory nominee ensures the business continues to operate in the event of the owner\'s death or incapacity — a protection that is entirely unavailable to sole proprietors.',
            ],
            [
                'label' => 'Tax Planning Flexibility',
                'text' => 'OPCs are taxed under the corporate tax framework — allowing structured financial planning, legitimate deductions, and tax efficiency not available under individual income tax rates.',
            ],
        ];
        ?>
        <section class="opc-benefits-section" aria-labelledby="opc-benefits-heading">
            <div class="container">
                <h2 id="opc-benefits-heading" class="opc-benefits-title">Benefits of One Person Company Registration</h2>
                <ul class="opc-benefits-list" role="list">
                    <?php foreach ($opc_benefits_items as $opc_benefit_row) : ?>
                        <?php
                        $opc_benefit_label = (string) ($opc_benefit_row['label'] ?? '');
                        $opc_benefit_text = (string) ($opc_benefit_row['text'] ?? '');
                        ?>
                        <li class="opc-benefits-item" role="listitem">
                            <span class="opc-benefits-check-wrap" aria-hidden="true"><i class="fas fa-check"></i></span>
                            <div class="opc-benefits-body">
                                <h3 class="opc-benefits-item-title"><?php echo htmlspecialchars($opc_benefit_label, ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="opc-benefits-item-text"><?php echo htmlspecialchars($opc_benefit_text, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <?php
        $opc_mistakes_intro = 'Most OPC registration delays and rejections are caused by avoidable errors — and CAAFT\'s structured approach eliminates each of them:';
        $opc_mistakes_items = [
            [
                'title' => 'Selecting a name already in use',
                'text' => 'Company name conflicts result in rejection and restart the name approval stage entirely, adding significant delay to the registration timeline.',
            ],
            [
                'title' => 'Incorrect or mismatched documents',
                'text' => 'Identity and address documents that do not match exactly across forms are a leading cause of MCA portal rejections.',
            ],
            [
                'title' => 'Incorrect nominee appointment',
                'text' => 'Nominee consent must be obtained and filed in the prescribed format. Errors here are treated as incomplete incorporation.',
            ],
            [
                'title' => 'Errors in MOA and AOA drafting',
                'text' => 'Poorly drafted objects clauses or governance rules create compliance issues that persist throughout the company\'s life and are costly to correct post-incorporation.',
            ],
            [
                'title' => 'Ignoring post-registration compliance',
                'text' => 'Many OPC founders complete registration but miss annual filing deadlines — attracting penalties that accumulate daily without a cap.',
            ],
            [
                'title' => 'Delays in responding to MCA queries',
                'text' => 'Unanswered MCA clarification requests during the review stage cause applications to lapse — requiring fresh submission from the beginning.',
            ],
        ];
        ?>
        <section class="opc-mistakes-section" aria-labelledby="opc-mistakes-heading">
            <div class="container">
                <h2 id="opc-mistakes-heading" class="opc-mistakes-title">Common Mistakes to Avoid During OPC Registration</h2>
                <p class="opc-mistakes-intro"><?php echo htmlspecialchars($opc_mistakes_intro, ENT_QUOTES, 'UTF-8'); ?></p>
                <ul class="opc-mistakes-list" role="list">
                    <?php foreach ($opc_mistakes_items as $opc_mistake_row) : ?>
                        <?php
                        $opc_mistake_title = (string) ($opc_mistake_row['title'] ?? '');
                        $opc_mistake_text = (string) ($opc_mistake_row['text'] ?? '');
                        ?>
                        <li class="opc-mistakes-card" role="listitem">
                            <h3 class="opc-mistakes-card-title"><?php echo htmlspecialchars($opc_mistake_title, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="opc-mistakes-card-text"><?php echo htmlspecialchars($opc_mistake_text, ENT_QUOTES, 'UTF-8'); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <?php
        $why_choose_caaft_heading_id = 'opc-why-caaft-heading';
        $why_choose_caaft_title = 'Why Choose CAAFT';
        $why_choose_caaft_show_intro = true;
        $why_choose_caaft_link_desc = true;
        $why_choose_caaft_intro = 'Solo founders rely on CAAFT for OPC incorporation that is filing-accurate, nominee-ready, and aligned with MCA rules — with post-registration compliance set up from day one.';
        $why_choose_caaft_section_class = 'why-choose-caaft py-90';
        $why_choose_caaft_items = [
            [
                'icon_class' => 'fas fa-lightbulb',
                'title' => 'OPC-specific expertise',
                'text' => 'The unique structure, limitations, and advantages of a One Person Company are fully understood — from nominee appointment requirements to mandatory conversion thresholds — with clear, confident guidance at every stage.',
            ],
            [
                'icon_class' => 'fas fa-magic',
                'title' => 'Hassle-free incorporation from start to finish',
                'text' => 'From DSC and DIN application to MOA, AOA drafting, and ROC filing — the entire OPC registration process is managed so founders can focus on building their business from day one.',
            ],
            [
                'icon_class' => 'fas fa-calendar-check',
                'title' => 'Ongoing compliance made simple',
                'text' => 'OPCs carry annual filing, audit, and ROC compliance obligations that are easy to overlook. Proactive compliance calendar management ensures no deadline is missed and no penalty is incurred.',
            ],
            [
                'icon_class' => 'fas fa-user-friends',
                'title' => 'Personalised attention for solo entrepreneurs',
                'text' => 'As a single-member structure, every OPC client receives dedicated, one-on-one support — treated with the same rigour and attention as any corporate engagement.',
            ],
            [
                'icon_class' => 'fas fa-handshake',
                'title' => 'Trusted partner beyond registration',
                'text' => 'Whether the need is tax filing, accounting, business banking, or eventual conversion to a Private Limited Company — CAAFT remains the single point of contact for all compliance and advisory needs.',
            ],
        ];
        include __DIR__ . '/../../includes/components/why-choose-caaft.php';
        ?>

        <?php
        $caaft_key_facts_heading_id = 'opc-facts-heading';
        $caaft_key_facts_title = 'Key Facts & Figures';
        $caaft_key_facts_items = [
            [
                'stat' => 'One member',
                'text' => 'An OPC can have only one member, who must be an Indian citizen and resident (182 days in India in the previous year).',
            ],
            [
                'stat' => '₹50L / ₹2Cr',
                'text' => 'It must convert into a Private Limited Company if paid-up capital exceeds ₹50 lakhs or turnover crosses ₹2 crore.',
            ],
            [
                'stat' => '28L+',
                'text' => 'By early 2026, India had over 28 lakh registered companies, with new incorporations growing ~29% year-on-year.',
            ],
        ];
        include __DIR__ . '/../../includes/components/caaft-key-facts.php';
        ?>

        <?php
        $caaft_cta_section_id = 'get-in-touch';
        $caaft_cta_heading_id = 'opc-cta-heading';
        $caaft_cta_title = 'Register Your One Person Company — Fast, Accurate & Fully Compliant';
        $caaft_cta_text = 'The OPC registration process involves more than filling out a government form — it requires accurate documentation, correctly drafted constitutional documents, and a clear understanding of post-incorporation compliance obligations. Whether a first-time founder, an experienced freelancer formalising operations, or a professional seeking limited liability protection — CAAFT delivers complete One Person Company registration with the legal foundation properly established from the very first day.';
        $caaft_cta_button_label = 'Register Your OPC Today';
        $caaft_cta_button_href = '/contact#contact_us';
        include __DIR__ . '/../../includes/components/caaft-cta.php';
        ?>

        <?php
        $caaft_faq_heading_id = 'opc-faq-heading';
        $caaft_faq_title = 'Frequently Asked Questions';
        $caaft_faq_accordion_id = 'accordionOpcFaq';
        $caaft_faq_prefix = 'opcFaq';
        $caaft_faq_items = [
            [
                'question' => 'Can an OPC be incorporated with a residential property as the registered office address?',
                'answer' => 'Yes. A residential address is permitted as the registered office of a One Person Company under the Companies Act, 2013 — provided a valid utility bill and NOC from the property owner are submitted. This makes OPC registration accessible to home-based founders without requiring commercial premises.',
            ],
            [
                'question' => 'Can the nominee of an OPC be changed after incorporation?',
                'answer' => 'Yes. The nominee can be changed at any time after incorporation with the written consent of both the existing and incoming nominee. The change must be intimated to the MCA by filing the prescribed form within the stipulated timeline.',
            ],
            [
                'question' => 'What happens if an OPC owner becomes a Non-Resident Indian (NRI) after incorporation?',
                'answer' => 'If the sole member ceases to be a resident of India — defined as staying in India for fewer than 182 days in the preceding calendar year — the OPC becomes ineligible to continue in its current structure and must convert into another company form within the prescribed period.',
            ],
            [
                'question' => 'Can an OPC have employees even though it has only one shareholder?',
                'answer' => 'Yes. The restriction on a One Person Company applies to the number of shareholders — not the number of employees. An OPC can hire any number of employees and operate with a full workforce while maintaining single-shareholder ownership.',
            ],
            [
                'question' => 'Is it possible to convert an OPC directly into an LLP?',
                'answer' => 'The Companies Act, 2013 provides a conversion pathway from OPC to Private Limited Company but does not provide a direct conversion mechanism from OPC to LLP. Conversion to LLP would require first converting the OPC to a Private Limited Company and then following the LLP conversion procedure — making it a two-stage process that should be planned in advance.',
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
