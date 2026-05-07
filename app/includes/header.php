<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrap">
                <div class="header-top-left">
                    <div class="header-top-contact">
                        <ul>
                            <li><a href="mailto:info@caaft.com"><i class="far fa-envelopes"></i>
                                    <span class="__cf_email__"
                                        data-cfemail="543d3a323b14312c35392438317a373b39">info@caaft.com</span></a>
                            </li>
                            <li> <a href="tel:+918870078870"> <i class="far fa-phone-volume"></i>
                                    +91 8870 07 8870 </a> / <a href="tel:+919944617891"> +91 9944 61
                                    7891</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="header-top-right">

                    <div class="header-top-social">

                        <a href="https://www.facebook.com/profile.php?id=61564521313943" target="_blank" title="facebook"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://x.com/CaaftServices" target="_blank" title="twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/caaftconsultancyservices/" target="_blank" title="instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/caaft-consultancy-services-private-limited/"
                            target="_blank" title="linkedin"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand static-logo" id="manimaenu" href="https://caaft.builtbybrevia.com/">
                    <img src="assets/img/caaft-logo-header.webp" alt="CAAFT Consultancy Services"
                        title="CAAFT Consultancy Services" class="img-fluid">
                </a>
                <a class="navbar-brand reaming-logo" id="submenu" href="https://caaft.builtbybrevia.com/">
                    <img src="assets/img/caaft-static-logo.webp" alt="CAAFT Consultancy Services"
                        title="CAAFT Consultancy Services" class="img-fluid">
                </a>
                <a class="navbar-brand fixed_logo" href="https://caaft.builtbybrevia.com/">
                    <img src="assets/img/static-logos.webp" alt="CAAFT Consultancy Services"
                        title="CAAFT Consultancy Services" class="img-fluid">
                </a>
                <div class="mobile-menu-right">
                    <div class="search-btn">
                        <button type="button" class="nav-right-link search-box-outer"><i
                                class="far fa-search"></i></button>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=918870078870" class="text-center" target="_blank">
                        <img src="assets/img/whatsapp-icon.webp" width="50" height="50" alt="Whatsapp" title="Whatsapp"
                            data-toggle="tooltip" data-placement="top" data-original-title="Chat with us">
                    </a>
                    <a href="tel:918870078870">
                        <img src="assets/img/call-icons.webp" width="50" height="50" alt="Call us" data-toggle="tooltip"
                            data-placement="bottom" title="Call us" data-original-title="Call Us">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                    </button>
                </div>
                <div class="main-menu  collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'index') ? 'active':''; ?>" href="index.php">Home</a>
                        </li>

                        <li class="nav-item"><a class="nav-link <?= ($activePage == 'about') ? 'active':''; ?>"
                                href="about.php">About Us </a></li>
                        <li class="nav-item dropdown  mega-menu-wrap dispaly_desktop ">
                            <a title="Services" class="nav-link link-extend main_mesnus_colorss ser_lists dropdown-toggle 
                                <?= ($activePage == 'accounting-firms-in-chennai') ? 'active':''; ?>
                                <?= ($activePage == 'accounting-services') ? 'active':''; ?>
                                <?= ($activePage == 'income-tax-filling-services-in-chennai') ? 'active':''; ?>
                                <?= ($activePage == 'gst-filing-itr-filing-in-chennai') ? 'active':''; ?>
                                       <?= ($activePage == 'business-consultancy-company-registration-in-chennai') ? 'active':''; ?>
                                       <?= ($activePage == 'management-consultancy-services-in-chennai') ? 'active':''; ?>
                                       <?= ($activePage == 'roc-compliance-services') ? 'active':''; ?>
                                       <?= ($activePage == 'bookkeeping-services') ? 'active':''; ?>
                                       <?= ($activePage == 'income-tax-return-filing') ? 'active':''; ?>
                                        <?= ($activePage == 'gst-registration-services') ? 'active':''; ?>
                                        <?= ($activePage == 'private-limited-registration-experts') ? 'active':''; ?>
                                         <?= ($activePage == 'msme-udyam-registration') ? 'active':''; ?>
                                         <?= ($activePage == 'register-partnership-firm') ? 'active':''; ?>
                                         <?= ($activePage == 'register-sole-proprietorship') ? 'active':''; ?>
                                         <?= ($activePage == 'fssai-food-licence-india') ? 'active':''; ?>
                                         <?= ($activePage == 'professional-tax-return-filing') ? 'active':''; ?>
                                         <?= ($activePage == 'epf-esi-registration-compliance') ? 'active':''; ?>
                                         <?= ($activePage == 'iec-registration') ? 'active':''; ?>
                                         <?= ($activePage == 'digital-signature-certificate-registration') ? 'active':''; ?>
                                         <?= ($activePage == '12a-80g-registration') ? 'active':''; ?>
                                         <?= ($activePage == 'din-kyc-filing') ? 'active':''; ?>
                                         <?= ($activePage == 'add-remove-director-service') ? 'active':''; ?>
                                         <?= ($activePage == 'increase-authorised-share-capital') ? 'active':''; ?>
                                         <?= ($activePage == 'registered-office-change-india') ? 'active':''; ?>
                                         <?= ($activePage == 'roc-compliance-filing') ? 'active':''; ?>
                                         <?= ($activePage == 'private-company-compliance') ? 'active':''; ?>
                                         <?= ($activePage == 'public-ltd-compliance') ? 'active':''; ?>
                                         <?= ($activePage == 'opc-annual-compliance') ? 'active':''; ?>
                                         <?= ($activePage == 'llp-annual-compliance') ? 'active':''; ?>
                                         <?= ($activePage == 'partnership-firm-compliance') ? 'active':''; ?>
                                         <?= ($activePage == 'sole-proprietorship-compliance') ? 'active':''; ?>
                                          <?= ($activePage == 'cfo-services') ? 'active':''; ?>
                                      ">Services</a>

                            <ul class="mega-menu row" style="padding: 14px !important; background-color: #05050a !important; background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/assets/img/menu/mega-menu.jpeg?v=4') !important; background-repeat: no-repeat !important; background-position: center center !important; background-size: cover !important;">
                                <li class="menu-has-sub col3">
                                    <a class="link-extend main_mesnus_colors menu-title-center" href="/business-setup-and-registration">BUSINESS SETUP & REGISTRATION</a>
                                    <div class="mega-split">
                                        <ul class="mega-split-col">
                                            <li><a class="link-extend extends_links" href="/business-setup-registration/company-registration#parentVerticalTab1">Company Incorporation</a></li>
                                            <li><a href="/private-limited-company-registration">Private Limited Company</a></li>
                                            <li><a href="/public-limited-company-registration">Public Limited Company</a></li>
                                            <li><a href="/one-person-company-registration">One Person Company (OPC)</a></li>
                                            <li><a href="/llp-registration-services">Limited Liability Partnership (LLP)</a></li>
                                            <li><a href="/register-partnership-firm">Partnership Firm</a></li>
                                            <li><a href="/register-sole-proprietorship">Sole Proprietorship</a></li>
                                        </ul>
                                        <ul class="mega-split-col">
                                            <li><a class="link-extend extends_links" href="/business-setup-registration/company-registration#parentVerticalTab7">Other Registrations</a></li>
                                            <li><a href="/msme-udyam-registration">MSME / Udyam Registration</a></li>
                                            <li><a href="/fssai-food-licence-india">FSSAI Registration</a></li>
                                            <li><a href="/professional-tax-return-filing">Professional Tax Registration</a></li>
                                            <li><a href="/epf-esi-registration-compliance">EPF & ESI Registration & Compliance</a></li>
                                            <li><a href="/iec-registration">Import Export Code (IEC)</a></li>
                                            <li><a href="/digital-signature-certificate-registration">Digital Signature Certificate (DSC)</a></li>
                                            <li><a href="/12a-80g-registration">12A & 80G Registration</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-has-sub col3">
                                    <a class="link-extend main_mesnus_colors menu-title-center" href="/compliance-and-regulatory-services">COMPLIANCE & REGULATORY</a>
                                    <div class="mega-split">
                                        <ul class="mega-split-col">
                                            <li><a class="link-extend extends_links" href="/business-setup-registration/company-registration#parentVerticalTab1">Company Compliance</a></li>
                                            <li><a href="/private-company-compliance">Private Limited Compliance</a></li>
                                            <li><a href="/llp-annual-compliance">Limited Liability Partnership (LLP) Compliance</a></li>
                                            <li><a href="/opc-annual-compliance">One Person Company (OPC) Compliance</a></li>
                                            <li><a href="/partnership-firm-compliance">Partnership Firm Compliance</a></li>
                                            <li><a href="/sole-proprietorship-compliance">Sole Proprietorship Compliance</a></li>
                                            <li><a href="/public-ltd-compliance">Public Limited Compliance</a></li>
                                        </ul>
                                        <ul class="mega-split-col">
                                            <li><a class="link-extend extends_links" href="/business-setup-registration/company-registration#parentVerticalTab7">ROC Compliance</a></li>
                                            <li><a href="/din-kyc-filing">Director KYC (DIR-3 KYC Filing)</a></li>
                                            <li><a href="/add-remove-director-service">Add / Remove Director</a></li>
                                            <li><a href="/increase-authorised-share-capital">Increase in Authorized Capital</a></li>
                                            <li><a href="/registered-office-change-india">Registered Office Change</a></li>
                                            <li><a href="/roc-compliance-filing">Miscellaneous ROC Filings</a></li>
                                            <li><a href="/business-setup-registration/company-registration#parentVerticalTab12">Company Closure / Winding Up</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-has-sub col3">
                                    <a class="link-extend main_mesnus_colors menu-title-center" href="/taxation-services">TAXATION</a>
                                    <div class="mega-split">
                                        <ul class="mega-split-col">
                                            <li><a class="link-extend extends_links" href="/income-tax">Income Tax</a></li>
                                            <li><a href="/income-tax/tax-planning-services">Tax Planning & Advisory</a></li>
                                            <li><a href="/income-tax/income-tax-filing-service">Income Tax Return (ITR) Filing</a></li>
                                            <li><a href="/income-tax/tds-return-filing-services">TDS Return Filing</a></li>
                                            <li><a href="/income-tax/tax-audit">Tax Audit Assistance</a></li>
                                            <li><a href="/income-tax/income-tax-appeal-services">Tax Assessment & Appeal Support</a></li>
                                        </ul>
                                        <ul class="mega-split-col">
                                            <li><a class="link-extend extends_links" href="/taxation-services">Goods and Services Tax</a></li>
                                            <li><a href="/gst/gst-registration">GST Registration</a></li>
                                            <li><a href="/gst/gst-return-filing-services">GST Return Filing</a></li>
                                            <li><a href="/gst/gst-lut-filing">GST LUT Filing</a></li>
                                            <li><a href="/gst/gst-advisory">GST Advisory & Compliance</a></li>
                                            <li><a href="/gst/gst-assessment-appeal-services">GST Assessment & Appeal Support</a></li>
                                            <li><a href="/gst/gst-cancellation-services">GST Registration Cancellation</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-has-sub col3">
                                    <div class="mega-split">
                                        <ul class="mega-split-col">
                                            <a class="link-extend main_mesnus_colors menu-title-left" href="/accounting-and-reporting-services">ACCOUNTING & REPORTING</a>
                                            <li><a href="/accounting-and-reporting/bookkeeping-and-accounting">General Accounting & Bookkeeping</a></li>
                                            <li><a href="/accounting-and-reporting/financial-analysis-mis">Financial Analysis & MIS Reporting</a></li>
                                            <li><a href="/accounting-and-reporting/financial-statement-analysis">Financial Statements</a></li>
                                            <li><a href="/accounting-and-reporting/accounts-receivable-payable-service">Receivable & Payable Management</a></li>
                                        </ul>
                                        <div class="menu-extend extend-colss mega-split-col">
                                            <a class="link-extend main_mesnus_colors menu-title-left" href="/advisory-and-cfo-services">ADVISORY & CFO SERVICES</a>
                                            <ul>
                                                <li><a href="/compliance-regulatory/roc-compliance-services#parentVerticalTab1">Budgeting & Forecasting</a></li>
                                                <li><a href="/compliance-regulatory/roc-compliance-services#parentVerticalTab2">Business Valuation</a></li>
                                                <li><a href="/compliance-regulatory/roc-compliance-services#parentVerticalTab3">Financial Assessment</a></li>
                                                <li><a href="/compliance-regulatory/roc-compliance-services#parentVerticalTab4">Feasibility Study</a></li>
                                                <li><a href="/compliance-regulatory/roc-compliance-services#parentVerticalTab5">CFO & Financial Management</a></li>
                                                <li><a href="/compliance-regulatory/roc-compliance-services#parentVerticalTab6">Payroll Management & Compliance</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown display_mobiles">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Services</a>
                            <ul class="dropdown-menu fade-down">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors"
                                        href="/accounting-and-reporting-services">Accounting & Reporting Services</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/accounting-reporting/accounting-firms">General
                                                Accounting & Bookkeeping </a>
                                        </li>
                                        <li><a class="dropdown-item" href="/accounting-reporting/accounting-firms">Financial
                                                Analysis & MIS Reporting</a>
                                        </li>
                                        <li><a class="dropdown-item" href="/accounting-reporting/accounting-firms">Financial
                                                Statements</a></li>
                                        <li><a class="dropdown-item" href="/accounting-reporting/accounting-firms">Receivable &
                                                Payable Management</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors"
                                        href="/taxation-services">Taxation</a>
                                    <ul class="dropdown-menu">
                                        <li><a class=" link-extend extends_links dropdown-item"
                                                href="/income-tax">Income
                                                Tax Services</a></li>
                                        <li><a class="dropdown-item"
                                                href="/income-tax/tax-planning-services">Tax
                                                Planning and Management</a></li>
                                        <li><a class="dropdown-item"
                                                href="/income-tax/income-tax-filing-service">Income
                                                Tax Returns Filing</a></li>
                                        <li><a class="dropdown-item"
                                                href="/income-tax/tds-return-filing-services">TDS
                                                Filing</a></li>
                                        <li><a class="dropdown-item"
                                                href="/income-tax/tax-audit">Tax Audit
                                                Support</a></li>
                                        <li><a class="dropdown-item"
                                                href="/income-tax/income-tax-appeal-services">Appeal
                                                and Assessment Support</a></li>

                                        <li><a class=" link-extend extends_links dropdown-item"
                                                href="/taxation/gst-income-tax-services#parentVerticalTab6">GST
                                                Services</a></li>
                                        <li><a class="dropdown-item"
                                                href="/taxation/gst-income-tax-services#parentVerticalTab6">GST
                                                Registration</a></li>
                                        <li><a class="dropdown-item"
                                                href="/gst/gst-lut-filing">GST
                                                Returns & LUT Filing</a></li>
                                        <li><a class="dropdown-item"
                                                href="/gst/gst-advisory">GST
                                                Advisory & Compliance</a></li>
                                        <li><a class="dropdown-item"
                                                href="/gst/gst-assessment-appeal-services">Appeal
                                                and Assessment Support</a></li>
                                        <li><a class="dropdown-item"
                                                href="/gst/gst-cancellation-services">Cancellation
                                                of Registration</a></li>
                                        <!-- <li><a class="dropdown-item" href="/taxation/gst-income-tax-services#parentVerticalTab11">GST Compliance</a></li> -->
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors"
                                        href="/business-setup-and-registration">Business
                                        Consultancy
                                        Services</a>
                                    <ul class="dropdown-menu">

                                        <li><a class="link-extend dropdown-item"
                                                href="/business-setup-registration/company-registration">Business
                                                Incorporation Services</a></li>
                                        <li><a class="dropdown-item"
                                                href="/business-setup-registration/company-registration">Private
                                                Limited Company</a></li>
                                        <li><a class="dropdown-item"
                                                href="/business-setup-registration/company-registration">Public
                                                Limited Company</a></li>
                                        <li><a class="dropdown-item"
                                                href="/business-setup-registration/company-registration">One
                                                Person Company</a></li>
                                        <li><a class="dropdown-item"
                                                href="/llp-registration-services">Limited
                                                Liability Partnership</a></li>

                                        <li><a class="dropdown-item"
                                                href="/register-partnership-firm">Partnership
                                                Firm</a></li>
                                        <li><a class="dropdown-item"
                                                href="/register-sole-proprietorship">Sole
                                                Proprietorship</a></li>

                                        <li><a class="link-extend dropdown-item"
                                                href="/business-setup-registration/company-registration">Other
                                                Registrations and Licenses </a></li>
                                        <li><a class="dropdown-item"
                                                href="/msme-udyam-registration">MSME/Udyam
                                                Registration</a></li>
                                        <li><a class="dropdown-item"
                                                href="/fssai-food-licence-india">FSSAI</a>
                                        </li>

                                        <li><a class="dropdown-item"
                                                href="/professional-tax-return-filing">Professional
                                                Tax</a></li>
                                        <li><a class="dropdown-item"
                                                href="/epf-esi-registration-compliance">Set Up
                                                and Administration of EPF & ESI</a></li>
                                        <li><a class="dropdown-item"
                                                href="/digital-signature-certificate-registration">Digital
                                                Signature Certificate (DSC)</a></li>
                                        <li><a class="dropdown-item"
                                                href="/iec-registration">IEC
                                                (Import Export Code)</a></li>
                                        <li><a class="dropdown-item"
                                                href="/12a-80g-registration">12A and
                                                80G Registration</a></li>
                                        <li><a class="dropdown-item"
                                                href="/private-company-compliance">Private Limited
                                                Compliance</a></li>
                                        <li><a class="dropdown-item"
                                                href="/public-ltd-compliance">Public Limited
                                                Compliance</a></li>

                                    </ul>
                                </li>

                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors"
                                        href="business-management-consultancy-services.php">Management Consultancy
                                        Services</a>
                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item"
                                                href="/management-consultancy/services#parentVerticalTab1">CFO
                                                Services</a></li>
                                        <li><a class="dropdown-item"
                                                href="/management-consultancy/services#parentVerticalTab2">Budgeting
                                                and Forecasting</a></li>
                                        <li><a class="dropdown-item"
                                                href="/management-consultancy/services#parentVerticalTab3">Feasibility
                                                Studies</a></li>
                                        <li><a class="dropdown-item"
                                                href="/management-consultancy/services#parentVerticalTab4">Business
                                                Valuation</a></li>
                                        <li><a class="dropdown-item"
                                                href="/management-consultancy/services#parentVerticalTab5">Financial
                                                Assessment</a></li>
                                        <!-- <li><a class="dropdown-item" href="/management-consultancy/services#parentVerticalTab6">Periodical Business Review Report</a></li> -->


                                    </ul>
                                </li>

                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle main_mesnus_colors"
                                        href="/compliance-and-regulatory-services"> Compliance Services</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="link-extend extends_links dropdown-item"
                                                href="/compliance-regulatory/roc-compliance-services#parentVerticalTab1">Entity Wise
                                                Services</a></li>
                                        <li><a class="dropdown-item"
                                                href="/compliance-regulatory/roc-compliance-services#parentVerticalTab1">Private Limited
                                                Compliance</a></li>
                                        <li><a class="dropdown-item"
                                                href="/compliance-regulatory/roc-compliance-services#parentVerticalTab2">Public Limited
                                                Compliance</a></li>
                                        <li><a class="dropdown-item"
                                                href="/compliance-regulatory/roc-compliance-services#parentVerticalTab3">One Person Company
                                                Compliance</a></li>
                                        <li><a class="dropdown-item"
                                                href="/llp-annual-compliance">LLP Compliance</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="/partnership-firm-compliance">Partnership Firm
                                                Compliance</a></li>
                                        <li><a class="dropdown-item"
                                                href="/sole-proprietorship-compliance">Sole
                                                Proprietorship Compliance</a></li>
                                        <li><a class="link-extend extends_links dropdown-item"
                                                href="/compliance-regulatory/roc-compliance-services#parentVerticalTab7">Other ROC
                                                Services</a></li>
                                        <li><a class="dropdown-item"
                                                href="/din-kyc-filing">DIR-3 Director
                                                KYC</a></li>
                                        <li><a class="dropdown-item"
                                                href="/add-remove-director-service">Add/Remove
                                                Director</a></li>
                                        <li><a class="dropdown-item"
                                                href="/increase-authorised-share-capital">Authorized Capital
                                                Increase</a></li>
                                        <li><a class="dropdown-item"
                                                href="/registered-office-change-india">Registered Office
                                                Change</a></li>
                                        <li><a class="dropdown-item"
                                                href="/roc-compliance-filing">Miscellaneous ROC
                                                Filings</a></li>
                                        <li><a class="dropdown-item"
                                                href="/compliance-regulatory/roc-compliance-services#parentVerticalTab12">Winding Up Of A
                                                Company</a></li>
                                    </ul>
                                </li>
                            </ul>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'compliance-calendar.php') ? 'active' : ''; ?>"
                                href="#" data-bs-toggle="dropdown" aria-expanded="true">
                                Resources
                            </a>
                            <ul class="dropdown-menu fade-down show" data-bs-popper="static">
                                <li>
                                    <a class="dropdown-item"
                                        href="compliance-calendar.php">
                                        Compliance Calendar
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link <?= ($activePage == 'blog') ? 'active':''; ?>"
                                href="blog">Blog </a></li>
                        <li class="nav-item"><a class="nav-link <?= ($activePage == 'contact') ? 'active':''; ?>"
                                href="contact.php">Contact Us </a></li>

                    </ul>
                    <div class="nav-right">

                        <div class="nav-right-btn">
                            <a href="contact.php#contact_us" class="theme-btn">Let's Talk<i
                                    class="fas fa-arrow-right"></i></a>
                        </div>

                    </div>
                    <div class="nav-right right_navs">

                        <div class="nav-right-btn">
                            <a href="https://api.whatsapp.com/send?phone=918870078870" class="text-center"
                                target="_blank">
                                <img src="assets/img/whatsapp-icon.webp" width="50" height="50" alt="whatsapp"
                                    title="whatsapp" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Chat with us">
                            </a>
                            <a href="tel:918870078870">
                                <img src="assets/img/call-icons.webp" width="50" height="50" alt="Call us"
                                    data-toggle="tooltip" data-placement="bottom" title="Call Us"
                                    data-original-title="Call Us">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</header>