<?php
/**
 * Hero indicative pricing by service page basename (app/pages/services/*.php).
 * Keys match basename only. Used when $caaft_hero_pricing_amount is not set on the page.
 * are not set and pricing is not disabled.
 *
 * 'govt_fee' => true shows "| Govt. Fee" after the + GST segment.
 * Omit a file or use empty 'amount' when no fixed "starts from" price applies.
 */
declare(strict_types=1);

return [
    // --- Business setup & registration: company incorporation ---
    'private-limited-registration.php' => ['amount' => '14,999', 'govt_fee' => true],
    'public-limited-company-registration.php' => ['amount' => '29,999', 'govt_fee' => true],
    'one-person-company-registration.php' => ['amount' => '11,999', 'govt_fee' => true],
    'llp-registration-services.php' => ['amount' => '11,999', 'govt_fee' => true],
    'register-partnership-firm.php' => ['amount' => '11,999', 'govt_fee' => true],
    'register-sole-proprietorship.php' => ['amount' => '9,999', 'govt_fee' => true],

    // --- Other registrations & licences (hero pricing only; no mid-page pricing cards) ---
    'msme-udyam-registration.php' => ['amount' => '1,999', 'govt_fee' => false],
    'fssai-food-licence-india.php' => ['amount' => '2,999', 'govt_fee' => true],
    'professional-tax-return-filing.php' => ['amount' => '2,999', 'govt_fee' => false],
    'epf-esi-registration-compliance.php' => ['amount' => '5,999', 'govt_fee' => false],
    'iec-registration.php' => ['amount' => '2,999', 'govt_fee' => true],
    'digital-signature-certificate-registration.php' => ['amount' => '2,499', 'govt_fee' => false],
    '12a-80g-registration.php' => ['amount' => '34,999', 'govt_fee' => true],

    // --- Compliance & regulatory: company compliance ---
    'private-company-compliance.php' => ['amount' => '14,999', 'govt_fee' => true],
    'llp-annual-compliance.php' => ['amount' => '9,999', 'govt_fee' => true],
    'opc-annual-compliance.php' => ['amount' => '9,999', 'govt_fee' => true],
    'partnership-firm-compliance.php' => ['amount' => '9,999', 'govt_fee' => true],
    'sole-proprietorship-compliance.php' => ['amount' => '9,999', 'govt_fee' => true],
    'public-ltd-compliance.php' => ['amount' => '19,999', 'govt_fee' => true],

    // --- ROC compliance ---
    'din-kyc-filing.php' => ['amount' => '2,999', 'govt_fee' => true],
    'add-remove-director-service.php' => ['amount' => '4,999', 'govt_fee' => true],
    'increase-authorised-share-capital.php' => ['amount' => '4,999', 'govt_fee' => true],
    'registered-office-change-india.php' => ['amount' => '4,999', 'govt_fee' => true],
    'roc-compliance-filing.php' => ['amount' => '4,999', 'govt_fee' => true],
    'winding-up-of-company.php' => ['amount' => '9,999', 'govt_fee' => true],

    // --- Taxation: income tax ---
    'tax-planning-services.php' => ['amount' => '999', 'govt_fee' => false],
    // Business ITR; individual ₹1,499 shown as second strip on income-tax-filing-service.php hero.
    'income-tax-filing-service.php' => ['amount' => '4,999', 'govt_fee' => false],
    'tds-return-filing-services.php' => ['amount' => '2,499', 'govt_fee' => false],
    'tax-audit.php' => ['amount' => '4,999', 'govt_fee' => false],
    'income-tax-appeal-services.php' => ['amount' => '4,999', 'govt_fee' => false],

    // --- Taxation: GST ---
    'gst-registration.php' => ['amount' => '2,999', 'govt_fee' => false],
    'gst-return-filing-services.php' => ['amount' => '1,499', 'govt_fee' => false],
    'gst-lut-filing.php' => ['amount' => '1,999', 'govt_fee' => false],
    'gst-advisory.php' => ['amount' => '2,999', 'govt_fee' => false],
    'gst-assessment-appeal-services.php' => ['amount' => '4,999', 'govt_fee' => false],
    'gst-cancellation-services.php' => ['amount' => '4,999', 'govt_fee' => false],

    // Hub / category pages (no single "starts from" price): business-setup-and-registration.php,
    // compliance-and-regulatory-services.php, taxation-services.php, accounting-reporting.php,
    // advisory-and-cfo-services.php — not listed.

    // Accounting & advisory line items without fixed table prices: bookkeeping-and-accounting-services.php,
    // financial-analysis-mis.php, financial-statement-analysis.php, accounts-receivable-payable-service.php,
    // budgeting-forecasting-services.php, business-valuation-services.php, financial-assessment-services.php,
    // feasibility-study.php, cfo-financial-management-services.php, payroll-management-compliance.php — not listed.
];
