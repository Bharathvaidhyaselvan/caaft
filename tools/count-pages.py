from pathlib import Path
import re

ROOT = Path(__file__).resolve().parents[1]
services = ROOT / "app/pages/services"
core = ROOT / "app/pages/core"

exclude = {"header.php", "footer.php", "header-top.php", "footer-bottom.php"}
service_files = sorted(p.name for p in services.glob("*.php") if p.name not in exclude)

routes = (ROOT / "app/config/page-routes.php").read_text(encoding="utf-8")
routed = sorted(set(re.findall(r"=> 'pages/services/([^']+)'", routes)))

excel_corrected = [
    "private-limited-registration.php",
    "public-limited-company-registration.php",
    "one-person-company-registration.php",
    "llp-registration-services.php",
    "register-partnership-firm.php",
    "register-sole-proprietorship.php",
    "msme-udyam-registration.php",
    "fssai-food-licence-india.php",
    "professional-tax-return-filing.php",
    "epf-esi-registration-compliance.php",
    "iec-registration.php",
    "digital-signature-certificate-registration.php",
    "12a-80g-registration.php",
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
    "income-tax-filing-service.php",
    "tds-return-filing-services.php",
    "tax-audit.php",
    "gst-return-filing-services.php",
    "gst-cancellation-services.php",
    "bookkeeping-and-accounting-services.php",
    "financial-analysis-mis.php",
    "financial-statement-analysis.php",
    "accounts-receivable-payable-service.php",
    "budgeting-forecasting-services.php",
    "business-valuation-services.php",
    "feasibility-study.php",
    "cfo-financial-management-services.php",
]

startup_funding = [
    "startup-funding-advisory-services.php",
    "startup-india-registration.php",
    "seed-funding-support.php",
    "government-grants.php",
    "pitch-deck-services.php",
    "business-loan-assistance.php",
    "detailed-project-report.php",
    "credit-monitoring-arrangement.php",
]

hub_pages = [
    "business-setup-and-registration.php",
    "compliance-and-regulatory-services.php",
    "taxation-services.php",
    "accounting-reporting.php",
    "advisory-and-cfo-services.php",
]

other_services = [
    "tax-planning-services.php",
    "gst-lut-filing.php",
    "gst-advisory.php",
    "gst-assessment-appeal-services.php",
    "gst-registration.php",
    "income-tax-appeal-services.php",
    "financial-assessment-services.php",
    "payroll-management-compliance.php",
]

core_content = [
    "index.php",
    "about.php",
    "contact.php",
    "privacy-policy.php",
    "terms-and-conditions.php",
    "disclaimer.php",
    "compliance-calendar.php",
    "thankyou.php",
]

trust_pages = []
for name in service_files:
    content = (services / name).read_text(encoding="utf-8", errors="ignore")
    if "caaft_trust_items" in content or "caaft-ar-trust-indicators" in content:
        trust_pages.append(name)

print("=== PAGE COUNTS ===")
print(f"Service PHP files (excl. partials): {len(service_files)}")
print(f"Unique routed service pages: {len(routed)}")
print(f"Service pages with trust indicators: {len(trust_pages)}")
print()
print("=== WORK COMPLETED (this project) ===")
print(f"Excel trust-indicator corrections: {len(excel_corrected)} pages")
print(f"Startup and Funding cluster: {len(startup_funding)} pages (1 hub + 7 services)")
print(f"Category hub pages: {len(hub_pages)}")
print(f"Other individual services (built, no excel correction): {len(other_services)}")
print(f"Core/content pages: {len(core_content)}")
print()
print("=== BREAKDOWN BY CLUSTER ===")
print(f"Business Setup and Incorporation: 6 incorporation + 1 hub")
print(f"Other Registrations: 7")
print(f"Compliance: 12 + 1 hub")
print(f"Taxation: 5 corrected + 8 other = 13 + 1 hub")
print(f"Accounting and Reporting: 4 corrected + 1 hub")
print(f"Advisory and CFO: 4 corrected + 1 hub")
print(f"Startup and Funding: 8 pages")
print()
print("=== NOT IN EXCEL (trust text unchanged) ===")
for name in other_services:
    print(f"  - {name}")
