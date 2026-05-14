<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");

// Helper: check if current page matches any of the given slugs
function isServiceActive($activePage, $slugs) {
    return in_array($activePage, $slugs) ? 'active' : '';
}

$allServiceSlugs = [
    // Accounting & Reporting
    'bookkeeping-and-accounting','financial-analysis-mis','financial-statement-analysis',
    'accounts-receivable-payable-service',
    // Taxation - Income Tax
    'income-tax','income-tax-filing-service','tds-return-filing-services','tax-audit',
    'tax-planning-services','income-tax-appeal-services',
    // Taxation - GST
    'gst-registration','gst-return-filing-services','gst-lut-filing',
    'gst-cancellation-services','gst-advisory','gst-assessment-appeal-services',
    // Business Setup
    'business-setup-and-registration','private-limited-company-registration',
    'public-limited-company-registration','one-person-company-registration',
    'llp-registration-services','register-partnership-firm','register-sole-proprietorship',
    'msme-udyam-registration','fssai-food-licence-india','professional-tax-return-filing',
    'iec-registration','digital-signature-certificate-registration','12a-80g-registration',
    'epf-esi-registration-compliance',
    // Compliance
    'compliance-and-regulatory-services','private-company-compliance','public-ltd-compliance',
    'opc-annual-compliance','llp-annual-compliance','partnership-firm-compliance',
    'sole-proprietorship-compliance','din-kyc-filing','add-remove-director-service',
    'increase-authorised-share-capital','registered-office-change-india',
    'roc-compliance-filing','winding-up-of-company',
    // Advisory
    'advisory-and-cfo-services','budgeting-forecasting-services','business-valuation-services',
    'financial-assessment-services','feasibility-study','cfo-financial-management-services',
    'payroll-management-compliance',
];
$servicesActive = isServiceActive($activePage, $allServiceSlugs);
?>

<style>
/* ─── MEGA MENU OVERRIDES ─── */
.mega-menu-new {
    display: none;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    width: min(1200px, 96vw);
    background: #05050a;
    background-image: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)), url('/assets/img/menu/mega-menu.jpeg?v=4');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-top: 2px solid #c8a96e;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 20px 60px rgba(0,0,0,.7);
    z-index: 9999;
    padding: 0;
    overflow: hidden;
}

.nav-item.dispaly_desktop:hover .mega-menu-new,
.nav-item.dispaly_desktop:focus-within .mega-menu-new {
    display: flex;
}

/* Tab strip */
.mm-tabs {
    display: flex;
    flex-direction: column;
    min-width: 220px;
    background: rgba(0,0,0,.5);
    border-right: 1px solid rgba(200,169,110,.25);
    padding: 8px 0;
}

.mm-tab {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 20px;
    color: #c0c0c0;
    font-size: 12.5px;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    border-left: 3px solid transparent;
    transition: all .2s ease;
    white-space: nowrap;
    text-decoration: none;
}

.mm-tab:hover,
.mm-tab.is-active {
    color: #c8a96e;
    background: rgba(200,169,110,.08);
    border-left-color: #c8a96e;
}

.mm-tab-icon {
    font-size: 16px;
    opacity: .8;
    width: 20px;
    text-align: center;
}

.mm-tab svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    opacity: .75;
    fill: currentColor;
}

/* Panel area */
.mm-panels {
    flex: 1;
    padding: 24px 28px;
    overflow-y: auto;
    max-height: 480px;
}

.mm-panel {
    display: none;
    animation: mmFadeIn .18s ease;
}

.mm-panel.is-active {
    display: grid;
}

@keyframes mmFadeIn {
    from { opacity: 0; transform: translateY(4px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Panel grid layouts */
.mm-panel--accounting  { grid-template-columns: 1fr; }
.mm-panel--taxation    { grid-template-columns: 1fr 1fr; gap: 24px; }
.mm-panel--business    { grid-template-columns: 1fr 1fr; gap: 24px; }
.mm-panel--compliance  { grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
.mm-panel--advisory    { grid-template-columns: 1fr; }

/* Group headings */
.mm-group-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #c8a96e;
    margin-bottom: 10px;
    padding-bottom: 6px;
    border-bottom: 1px solid rgba(200,169,110,.3);
}

/* Links */
.mm-links {
    list-style: none;
    margin: 0 0 18px;
    padding: 0;
}

.mm-links li a {
    display: block;
    font-size: 12.5px;
    color: #b0b0b0;
    padding: 5px 0 5px 12px;
    border-left: 2px solid transparent;
    transition: color .15s, border-color .15s, padding-left .15s;
    text-decoration: none;
    line-height: 1.4;
}

.mm-links li a:hover {
    color: #fff;
    border-left-color: #c8a96e;
    padding-left: 16px;
}

/* Flat grid for Advisory */
.mm-grid-flat {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px 20px;
    margin-top: 4px;
}

.mm-grid-flat a {
    display: block;
    font-size: 12.5px;
    color: #b0b0b0;
    padding: 7px 10px 7px 12px;
    border-left: 2px solid rgba(200,169,110,.3);
    border-radius: 0 4px 4px 0;
    transition: all .15s;
    text-decoration: none;
}

.mm-grid-flat a:hover {
    color: #fff;
    border-left-color: #c8a96e;
    background: rgba(200,169,110,.06);
}

/* "View all" footer row */
.mm-view-all {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: #c8a96e;
    text-decoration: none;
    font-weight: 600;
    letter-spacing: .05em;
    margin-top: 4px;
    transition: gap .15s;
}

.mm-view-all:hover { gap: 8px; color: #dfc080; }

/* Responsive: hide desktop mega on mobile */
@media (max-width: 991px) {
    .dispaly_desktop { display: none !important; }
    .display_mobiles { display: block !important; }
}
@media (min-width: 992px) {
    .display_mobiles { display: none !important; }
}
</style>

<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrap">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        <ul>
                            <li><a href="mailto:info@caaft.com"><i class="far fa-envelopes"></i>
                                    <span class="__cf_email__" data-cfemail="543d3a323b14312c35392438317a373b39">info@caaft.com</span></a>
                            </li>
                            <li>
                                <a href="tel:+918870078870"><i class="far fa-phone-volume"></i> +91 8870 07 8870</a>
                                / <a href="tel:+919944617891">+91 9944 61 7891</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-social">
                        <a href="https://www.facebook.com/profile.php?id=61564521313943" target="_blank" title="facebook"><i class="fab fa-facebook"></i></a>
                        <a href="https://x.com/CaaftServices" target="_blank" title="twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/caaftconsultancyservices/" target="_blank" title="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/caaft-consultancy-services-private-limited/" target="_blank" title="linkedin"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">

                <a class="navbar-brand static-logo" id="manimaenu" href="https://caaft.builtbybrevia.com/">
                    <img src="assets/img/caaft-logo-header.webp" alt="CAAFT Consultancy Services" class="img-fluid">
                </a>
                <a class="navbar-brand reaming-logo" id="submenu" href="https://caaft.builtbybrevia.com/">
                    <img src="assets/img/caaft-static-logo.webp" alt="CAAFT Consultancy Services" class="img-fluid">
                </a>
                <a class="navbar-brand fixed_logo" href="https://caaft.builtbybrevia.com/">
                    <img src="assets/img/static-logos.webp" alt="CAAFT Consultancy Services" class="img-fluid">
                </a>

                <div class="mobile-menu-right">
                    <div class="search-btn">
                        <button type="button" class="nav-right-link search-box-outer"><i class="far fa-search"></i></button>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=918870078870" class="text-center" target="_blank">
                        <img src="assets/img/whatsapp-icon.webp" width="50" height="50" alt="Whatsapp">
                    </a>
                    <a href="tel:918870078870">
                        <img src="assets/img/call-icons.webp" width="50" height="50" alt="Call us">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>

                <div class="main-menu collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'index') ? 'active' : ''; ?>" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'about') ? 'active' : ''; ?>" href="about.php">About Us</a>
                        </li>

                        <!-- ═══════════════════════════════════════════════════════════
                             DESKTOP MEGA MENU — 5-tab tabbed layout
                        ════════════════════════════════════════════════════════════ -->
                        <li class="nav-item dispaly_desktop" style="position:static;">
                            <a class="nav-link <?= $servicesActive; ?>" href="#" role="button" aria-haspopup="true">
                                Services <i class="fas fa-chevron-down" style="font-size:10px; margin-left:3px;"></i>
                            </a>

                            <div class="mega-menu-new" role="navigation" aria-label="Services mega menu">

                                <!-- ── LEFT: Tab strip ── -->
                                <div class="mm-tabs" role="tablist">

                                    <a class="mm-tab is-active" data-panel="accounting" role="tab" aria-selected="true" href="/accounting-and-reporting-services">
                                        <span class="mm-tab-icon">
                                            <!-- Ledger icon -->
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 3h5v2h-5V6zm0 4h5v2h-5v-2zm-5-4h3v6H7V6zm0 8h10v2H7v-2zm0 4h10v2H7v-2z"/></svg>
                                        </span>
                                        Accounting & Reporting
                                    </a>

                                    <a class="mm-tab" data-panel="taxation" role="tab" href="/taxation-services">
                                        <span class="mm-tab-icon">
                                            <!-- Tax/receipt icon -->
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11zM9 13h2v2H9v-2zm4 0h2v2h-2v-2zm-4 4h2v2H9v-2zm4 0h2v2h-2v-2z"/></svg>
                                        </span>
                                        Taxation
                                    </a>

                                    <a class="mm-tab" data-panel="business" role="tab" href="/business-setup-and-registration">
                                        <span class="mm-tab-icon">
                                            <!-- Building icon -->
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 3L2 12h3v8h6v-5h2v5h6v-8h3L12 3zm0 2.7L19 12h-1v7h-4v-5H10v5H6v-7H5l7-6.3z"/></svg>
                                        </span>
                                        Business Setup & Registration
                                    </a>

                                    <a class="mm-tab" data-panel="compliance" role="tab" href="/compliance-and-regulatory-services">
                                        <span class="mm-tab-icon">
                                            <!-- Shield / check icon -->
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L3 6v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V6l-9-4zm-1 14l-3-3 1.41-1.41L11 13.17l4.59-4.58L17 10l-6 6z"/></svg>
                                        </span>
                                        Compliance & Regulatory
                                    </a>

                                    <a class="mm-tab" data-panel="advisory" role="tab" href="/advisory-and-cfo-services">
                                        <span class="mm-tab-icon">
                                            <!-- Chart/advisory icon -->
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 13h2v7H3v-7zm4-6h2v13H7V7zm4-4h2v17h-2V3zm4 7h2v10h-2V10zm4-3h2v13h-2V7z"/></svg>
                                        </span>
                                        Advisory & CFO Services
                                    </a>

                                </div><!-- /mm-tabs -->

                                <!-- ── RIGHT: Panels ── -->
                                <div class="mm-panels">

                                    <!-- ① ACCOUNTING & REPORTING -->
                                    <div class="mm-panel mm-panel--accounting is-active" id="panel-accounting" role="tabpanel">
                                        <div class="mm-group-title">Accounting & Reporting Services</div>
                                        <div class="mm-grid-flat">
                                            <a href="/accounting-and-reporting/bookkeeping-and-accounting">General Accounting &amp; Bookkeeping</a>
                                            <a href="/accounting-and-reporting/financial-analysis-mis">Financial Analysis &amp; MIS Reporting</a>
                                            <a href="/accounting-and-reporting/financial-statement-analysis">Financial Statements</a>
                                            <a href="/accounting-and-reporting/accounts-receivable-payable-service">Receivable &amp; Payable Management</a>
                                        </div>
                                        <br>
                                        <a class="mm-view-all" href="/accounting-and-reporting-services">View all Accounting Services →</a>
                                    </div>

                                    <!-- ② TAXATION -->
                                    <div class="mm-panel mm-panel--taxation" id="panel-taxation" role="tabpanel">
                                        <div>
                                            <div class="mm-group-title">Income Tax</div>
                                            <ul class="mm-links">
                                                <li><a href="/income-tax/income-tax-filing-service">Income Tax Return (ITR) Filing</a></li>
                                                <li><a href="/income-tax/tds-return-filing-services">TDS Return Filing</a></li>
                                                <li><a href="/income-tax/tax-audit">Tax Audit Assistance</a></li>
                                                <li><a href="/income-tax/tax-planning-services">Tax Planning &amp; Advisory</a></li>
                                                <li><a href="/income-tax/income-tax-appeal-services">Tax Assessment &amp; Appeal Support</a></li>
                                            </ul>
                                            <a class="mm-view-all" href="/income-tax">All Income Tax Services →</a>
                                        </div>
                                        <div>
                                            <div class="mm-group-title">Goods &amp; Services Tax (GST)</div>
                                            <ul class="mm-links">
                                                <li><a href="/gst/gst-registration">GST Registration</a></li>
                                                <li><a href="/gst/gst-return-filing-services">GST Returns Filing</a></li>
                                                <li><a href="/gst/gst-lut-filing">GST LUT Filing</a></li>
                                                <li><a href="/gst/gst-cancellation-services">GST Registration Cancellation</a></li>
                                                <li><a href="/gst/gst-advisory">GST Advisory &amp; Compliance</a></li>
                                                <li><a href="/gst/gst-assessment-appeal-services">GST Assessment &amp; Appeal Support</a></li>
                                            </ul>
                                            <a class="mm-view-all" href="/taxation-services">All GST Services →</a>
                                        </div>
                                    </div>

                                    <!-- ③ BUSINESS SETUP & REGISTRATION -->
                                    <div class="mm-panel mm-panel--business" id="panel-business" role="tabpanel">
                                        <div>
                                            <div class="mm-group-title">Company Incorporation</div>
                                            <ul class="mm-links">
                                                <li><a href="/private-limited-company-registration">Private Limited Company</a></li>
                                                <li><a href="/public-limited-company-registration">Public Limited Company</a></li>
                                                <li><a href="/one-person-company-registration">One Person Company (OPC)</a></li>
                                                <li><a href="/llp-registration-services">Limited Liability Partnership (LLP)</a></li>
                                                <li><a href="/register-partnership-firm">Partnership Firm</a></li>
                                                <li><a href="/register-sole-proprietorship">Sole Proprietorship</a></li>
                                            </ul>
                                            <a class="mm-view-all" href="/business-setup-and-registration">All Incorporation Services →</a>
                                        </div>
                                        <div>
                                            <div class="mm-group-title">Other Registrations &amp; Licences</div>
                                            <ul class="mm-links">
                                                <li><a href="/msme-udyam-registration">MSME / Udyam Registration</a></li>
                                                <li><a href="/fssai-food-licence-india">FSSAI Registration</a></li>
                                                <li><a href="/professional-tax-return-filing">Professional Tax Registration</a></li>
                                                <li><a href="/iec-registration">Import Export Code (IEC)</a></li>
                                                <li><a href="/digital-signature-certificate-registration">Digital Signature Certificate (DSC)</a></li>
                                                <li><a href="/12a-80g-registration">12A &amp; 80G Registration</a></li>
                                                <li><a href="/epf-esi-registration-compliance">EPF &amp; ESI Registration &amp; Compliance</a></li>
                                            </ul>
                                            <a class="mm-view-all" href="/business-setup-and-registration">All Registrations →</a>
                                        </div>
                                    </div>

                                    <!-- ④ COMPLIANCE & REGULATORY -->
                                    <div class="mm-panel mm-panel--compliance" id="panel-compliance" role="tabpanel">
                                        <div>
                                            <div class="mm-group-title">Company Compliance</div>
                                            <ul class="mm-links">
                                                <li><a href="/private-company-compliance">Private Limited Compliance</a></li>
                                                <li><a href="/public-ltd-compliance">Public Limited Compliance</a></li>
                                                <li><a href="/opc-annual-compliance">One Person Company Compliance</a></li>
                                                <li><a href="/llp-annual-compliance">LLP Compliance</a></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <div class="mm-group-title">Firm Compliance</div>
                                            <ul class="mm-links">
                                                <li><a href="/partnership-firm-compliance">Partnership Firm Compliance</a></li>
                                                <li><a href="/sole-proprietorship-compliance">Sole Proprietorship Compliance</a></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <div class="mm-group-title">ROC Compliance</div>
                                            <ul class="mm-links">
                                                <li><a href="/din-kyc-filing">Director KYC (DIR-3 KYC)</a></li>
                                                <li><a href="/add-remove-director-service">Add / Remove Director</a></li>
                                                <li><a href="/increase-authorised-share-capital">Increase in Authorised Capital</a></li>
                                                <li><a href="/registered-office-change-india">Registered Office Change</a></li>
                                                <li><a href="/roc-compliance-filing">Miscellaneous ROC Filings</a></li>
                                                <li><a href="/winding-up-of-company">Company Closure / Winding Up</a></li>
                                            </ul>
                                            <a class="mm-view-all" href="/compliance-and-regulatory-services">All Compliance Services →</a>
                                        </div>
                                    </div>

                                    <!-- ⑤ ADVISORY & CFO SERVICES -->
                                    <div class="mm-panel mm-panel--advisory" id="panel-advisory" role="tabpanel">
                                        <div class="mm-group-title">Advisory &amp; CFO Services</div>
                                        <div class="mm-grid-flat">
                                            <a href="/budgeting-forecasting-services">Budgeting &amp; Forecasting</a>
                                            <a href="/business-valuation-services">Business Valuation</a>
                                            <a href="/financial-assessment-services">Financial Assessment</a>
                                            <a href="/feasibility-study">Feasibility Study</a>
                                            <a href="/cfo-financial-management-services">CFO &amp; Financial Management</a>
                                            <a href="/payroll-management-compliance">Payroll Management &amp; Compliance</a>
                                        </div>
                                        <br>
                                        <a class="mm-view-all" href="/advisory-and-cfo-services">View all Advisory Services →</a>
                                    </div>

                                </div><!-- /mm-panels -->
                            </div><!-- /mega-menu-new -->
                        </li><!-- /desktop mega menu -->

                        <!-- ═══════════════════════════════════════════════════════════
                             MOBILE ACCORDION MENU — same new structure
                        ════════════════════════════════════════════════════════════ -->
                        <li class="nav-item dropdown display_mobiles">
                            <a class="nav-link dropdown-toggle <?= $servicesActive; ?>" href="#" data-bs-toggle="dropdown">Services</a>
                            <ul class="dropdown-menu fade-down">

                                <!-- Accounting -->
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors" href="/accounting-and-reporting-services">Accounting &amp; Reporting</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/accounting-and-reporting/bookkeeping-and-accounting">General Accounting &amp; Bookkeeping</a></li>
                                        <li><a class="dropdown-item" href="/accounting-and-reporting/financial-analysis-mis">Financial Analysis &amp; MIS Reporting</a></li>
                                        <li><a class="dropdown-item" href="/accounting-and-reporting/financial-statement-analysis">Financial Statements</a></li>
                                        <li><a class="dropdown-item" href="/accounting-and-reporting/accounts-receivable-payable-service">Receivable &amp; Payable Management</a></li>
                                    </ul>
                                </li>

                                <!-- Taxation -->
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors" href="/taxation-services">Taxation</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item link-extend" href="/income-tax">Income Tax</a></li>
                                        <li><a class="dropdown-item" href="/income-tax/income-tax-filing-service">Income Tax Return (ITR) Filing</a></li>
                                        <li><a class="dropdown-item" href="/income-tax/tds-return-filing-services">TDS Return Filing</a></li>
                                        <li><a class="dropdown-item" href="/income-tax/tax-audit">Tax Audit Assistance</a></li>
                                        <li><a class="dropdown-item" href="/income-tax/tax-planning-services">Tax Planning &amp; Advisory</a></li>
                                        <li><a class="dropdown-item" href="/income-tax/income-tax-appeal-services">Tax Assessment &amp; Appeal Support</a></li>

                                        <li><a class="dropdown-item link-extend" href="/taxation-services">GST Services</a></li>
                                        <li><a class="dropdown-item" href="/gst/gst-registration">GST Registration</a></li>
                                        <li><a class="dropdown-item" href="/gst/gst-return-filing-services">GST Returns Filing</a></li>
                                        <li><a class="dropdown-item" href="/gst/gst-lut-filing">GST LUT Filing</a></li>
                                        <li><a class="dropdown-item" href="/gst/gst-cancellation-services">GST Registration Cancellation</a></li>
                                        <li><a class="dropdown-item" href="/gst/gst-advisory">GST Advisory &amp; Compliance</a></li>
                                        <li><a class="dropdown-item" href="/gst/gst-assessment-appeal-services">GST Assessment &amp; Appeal Support</a></li>
                                    </ul>
                                </li>

                                <!-- Business Setup -->
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors" href="/business-setup-and-registration">Business Setup &amp; Registration</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item link-extend" href="/business-setup-and-registration">Company Incorporation</a></li>
                                        <li><a class="dropdown-item" href="/private-limited-company-registration">Private Limited Company</a></li>
                                        <li><a class="dropdown-item" href="/public-limited-company-registration">Public Limited Company</a></li>
                                        <li><a class="dropdown-item" href="/one-person-company-registration">One Person Company (OPC)</a></li>
                                        <li><a class="dropdown-item" href="/llp-registration-services">Limited Liability Partnership (LLP)</a></li>
                                        <li><a class="dropdown-item" href="/register-partnership-firm">Partnership Firm</a></li>
                                        <li><a class="dropdown-item" href="/register-sole-proprietorship">Sole Proprietorship</a></li>

                                        <li><a class="dropdown-item link-extend" href="/business-setup-and-registration">Other Registrations &amp; Licences</a></li>
                                        <li><a class="dropdown-item" href="/msme-udyam-registration">MSME / Udyam Registration</a></li>
                                        <li><a class="dropdown-item" href="/fssai-food-licence-india">FSSAI Registration</a></li>
                                        <li><a class="dropdown-item" href="/professional-tax-return-filing">Professional Tax Registration</a></li>
                                        <li><a class="dropdown-item" href="/iec-registration">Import Export Code (IEC)</a></li>
                                        <li><a class="dropdown-item" href="/digital-signature-certificate-registration">Digital Signature Certificate (DSC)</a></li>
                                        <li><a class="dropdown-item" href="/12a-80g-registration">12A &amp; 80G Registration</a></li>
                                        <li><a class="dropdown-item" href="/epf-esi-registration-compliance">EPF &amp; ESI Registration &amp; Compliance</a></li>
                                    </ul>
                                </li>

                                <!-- Compliance -->
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors" href="/compliance-and-regulatory-services">Compliance &amp; Regulatory</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item link-extend" href="/compliance-and-regulatory-services">Company Compliance</a></li>
                                        <li><a class="dropdown-item" href="/private-company-compliance">Private Limited Compliance</a></li>
                                        <li><a class="dropdown-item" href="/public-ltd-compliance">Public Limited Compliance</a></li>
                                        <li><a class="dropdown-item" href="/opc-annual-compliance">One Person Company Compliance</a></li>
                                        <li><a class="dropdown-item" href="/llp-annual-compliance">LLP Compliance</a></li>

                                        <li><a class="dropdown-item link-extend" href="/compliance-and-regulatory-services">Firm Compliance</a></li>
                                        <li><a class="dropdown-item" href="/partnership-firm-compliance">Partnership Firm Compliance</a></li>
                                        <li><a class="dropdown-item" href="/sole-proprietorship-compliance">Sole Proprietorship Compliance</a></li>

                                        <li><a class="dropdown-item link-extend" href="/compliance-and-regulatory-services">ROC Compliance</a></li>
                                        <li><a class="dropdown-item" href="/din-kyc-filing">Director KYC (DIR-3 KYC)</a></li>
                                        <li><a class="dropdown-item" href="/add-remove-director-service">Add / Remove Director</a></li>
                                        <li><a class="dropdown-item" href="/increase-authorised-share-capital">Increase in Authorised Capital</a></li>
                                        <li><a class="dropdown-item" href="/registered-office-change-india">Registered Office Change</a></li>
                                        <li><a class="dropdown-item" href="/roc-compliance-filing">Miscellaneous ROC Filings</a></li>
                                        <li><a class="dropdown-item" href="/winding-up-of-company">Company Closure / Winding Up</a></li>
                                    </ul>
                                </li>

                                <!-- Advisory -->
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors" href="/advisory-and-cfo-services">Advisory &amp; CFO Services</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/budgeting-forecasting-services">Budgeting &amp; Forecasting</a></li>
                                        <li><a class="dropdown-item" href="/business-valuation-services">Business Valuation</a></li>
                                        <li><a class="dropdown-item" href="/financial-assessment-services">Financial Assessment</a></li>
                                        <li><a class="dropdown-item" href="/feasibility-study">Feasibility Study</a></li>
                                        <li><a class="dropdown-item" href="/cfo-financial-management-services">CFO &amp; Financial Management</a></li>
                                        <li><a class="dropdown-item" href="/payroll-management-compliance">Payroll Management &amp; Compliance</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li><!-- /mobile menu -->

                        <!-- Resources -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'compliance-calendar.php') ? 'active' : ''; ?>"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">Resources</a>
                            <ul class="dropdown-menu fade-down">
                                <li><a class="dropdown-item" href="compliance-calendar.php">Compliance Calendar</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'blog') ? 'active' : ''; ?>" href="blog">Blog</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'contact') ? 'active' : ''; ?>" href="contact.php">Contact Us</a>
                        </li>

                    </ul>

                    <div class="nav-right">
                        <div class="nav-right-btn">
                            <a href="contact.php#contact_us" class="theme-btn">Let's Talk <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="nav-right right_navs">
                        <div class="nav-right-btn">
                            <a href="https://api.whatsapp.com/send?phone=918870078870" class="text-center" target="_blank">
                                <img src="assets/img/whatsapp-icon.webp" width="50" height="50" alt="whatsapp">
                            </a>
                            <a href="tel:918870078870">
                                <img src="assets/img/call-icons.webp" width="50" height="50" alt="Call us">
                            </a>
                        </div>
                    </div>

                </div><!-- /navbar-collapse -->
            </div><!-- /container -->
        </nav>
    </div>
</header>

<script>
(function () {
    /* ── Tabbed mega menu hover logic ── */
    const tabs = document.querySelectorAll('.mm-tab[data-panel]');
    const panels = document.querySelectorAll('.mm-panel');

    function activateTab(tab) {
        tabs.forEach(t => t.classList.remove('is-active'));
        panels.forEach(p => p.classList.remove('is-active'));

        tab.classList.add('is-active');
        const target = document.getElementById('panel-' + tab.dataset.panel);
        if (target) target.classList.add('is-active');
    }

    tabs.forEach(tab => {
        tab.addEventListener('mouseenter', () => activateTab(tab));
        tab.addEventListener('focus', () => activateTab(tab));
    });

    /* ── Prevent mega menu close on inner hover ── */
    const megaMenu = document.querySelector('.mega-menu-new');
    if (megaMenu) {
        megaMenu.addEventListener('mouseleave', function () {
            // panel stays as-is; closing handled by parent li mouseleave
        });
    }
})();
</script>