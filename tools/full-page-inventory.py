"""Full inventory of service, hub, core, and legal pages."""
from pathlib import Path
import re

ROOT = Path(__file__).resolve().parents[1]

HUB_PAGES = {
    "business-setup-and-registration.php": "Business Setup & Registration",
    "compliance-and-regulatory-services.php": "Compliance & Regulatory Services",
    "taxation-services.php": "Taxation Services",
    "accounting-reporting.php": "Accounting & Reporting",
    "advisory-and-cfo-services.php": "Advisory & CFO Services",
    "startup-funding-advisory-services.php": "Startup & Funding Advisory",
}

LEGAL_PAGES = {
    "privacy-policy.php": "Privacy Policy",
    "terms-and-conditions.php": "Terms & Conditions",
    "disclaimer.php": "Disclaimer",
}

CORE_PAGES = {
    "index.php": "Home",
    "about.php": "About Us",
    "contact.php": "Contact Us",
    "compliance-calendar.php": "Compliance Calendar",
    "thankyou.php": "Thank You",
}

routes = (ROOT / "app/config/page-routes.php").read_text(encoding="utf-8")
routed_services = sorted(set(re.findall(r"=> 'pages/services/([^']+)'", routes)))

services_dir = ROOT / "app/pages/services"
exclude_partials = {"header.php", "footer.php", "header-top.php", "footer-bottom.php"}
all_service_files = sorted(
    p.name for p in services_dir.glob("*.php") if p.name not in exclude_partials
)

hub_files = [f for f in routed_services if f in HUB_PAGES]
individual_services = [f for f in routed_services if f not in HUB_PAGES]

excel_done = 38  # from project work
startup_cluster = [
    "startup-india-registration.php",
    "seed-funding-support.php",
    "government-grants.php",
    "pitch-deck-services.php",
    "business-loan-assistance.php",
    "detailed-project-report.php",
    "credit-monitoring-arrangement.php",
]

print("=" * 60)
print("FULL SITE INVENTORY (Services + Core + Legal)")
print("=" * 60)
print()
print(f"GRAND TOTAL: {len(routed_services) + len(CORE_PAGES) + len(LEGAL_PAGES)} pages")
print(f"  Service pages (all):     {len(routed_services)}")
print(f"    - Hub pages:           {len(hub_files)}")
print(f"    - Individual services: {len(individual_services)}")
print(f"  Core pages:              {len(CORE_PAGES)}")
print(f"  Legal pages:             {len(LEGAL_PAGES)}")
print()
print("HUB PAGES (category landing pages)")
for f in hub_files:
    print(f"  - {HUB_PAGES[f]}")
print()
print("CORE PAGES")
for f, name in CORE_PAGES.items():
    print(f"  - {name}")
print()
print("LEGAL PAGES")
for f, name in LEGAL_PAGES.items():
    print(f"  - {name}")
print()
print("INDIVIDUAL SERVICE PAGES BY CLUSTER")
clusters = {
    "Company Incorporation (6)": [
        "private-limited-registration.php",
        "public-limited-company-registration.php",
        "one-person-company-registration.php",
        "llp-registration-services.php",
        "register-partnership-firm.php",
        "register-sole-proprietorship.php",
    ],
    "Other Registrations (7)": [
        "msme-udyam-registration.php",
        "fssai-food-licence-india.php",
        "professional-tax-return-filing.php",
        "epf-esi-registration-compliance.php",
        "iec-registration.php",
        "digital-signature-certificate-registration.php",
        "12a-80g-registration.php",
    ],
    "Compliance (12)": [
        "private-company-compliance.php",
        "llp-annual-compliance.php",
        "opc-annual-compliance.php",
        "partnership-firm-compliance.php",
        "sole-proprietorship-compliance.php",
        "public-ltd-compliance.php",
        "din-kyc-filing.php",
        "add-remove-director-service.php",
        "increase-authorised-share-capital.php",
        "registered-office-change-india.php",
        "roc-compliance-filing.php",
        "winding-up-of-company.php",
    ],
    "Taxation (11)": [
        "income-tax-filing-service.php",
        "tds-return-filing-services.php",
        "tax-audit.php",
        "tax-planning-services.php",
        "income-tax-appeal-services.php",
        "gst-registration.php",
        "gst-return-filing-services.php",
        "gst-lut-filing.php",
        "gst-cancellation-services.php",
        "gst-advisory.php",
        "gst-assessment-appeal-services.php",
    ],
    "Accounting & Reporting (4)": [
        "bookkeeping-and-accounting-services.php",
        "financial-analysis-mis.php",
        "financial-statement-analysis.php",
        "accounts-receivable-payable-service.php",
    ],
    "Advisory & CFO (5)": [
        "budgeting-forecasting-services.php",
        "business-valuation-services.php",
        "financial-assessment-services.php",
        "feasibility-study.php",
        "cfo-financial-management-services.php",
        "payroll-management-compliance.php",
    ],
    "Startup & Funding (7)": startup_cluster,
}
for cluster, files in clusters.items():
    print(f"  {cluster}")
    for f in files:
        print(f"    - {f.replace('.php','').replace('-', ' ').title()}")
