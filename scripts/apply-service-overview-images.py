#!/usr/bin/env python3
"""Set service overview images from assets/img/services-images/."""
from __future__ import annotations

import re
from pathlib import Path
from urllib.parse import quote

ROOT = Path(__file__).resolve().parents[1]
SERVICES = ROOT / "app" / "pages" / "services"
ASSET_ROOT = "assets/img/services-images"

# PHP basename -> path under assets/img/services-images/
IMAGE_MAP: dict[str, str] = {
    "private-limited-registration.php": "Business Set up & REgistration/Pvt ltd.jpg",
    "public-limited-company-registration.php": "Business Set up & REgistration/Public limited.jpg",
    "one-person-company-registration.php": "Business Set up & REgistration/OPC1.jpg",
    "llp-registration-services.php": "Business Set up & REgistration/LLP.jpg",
    "register-partnership-firm.php": "Business Set up & REgistration/Partnership firm.jpg",
    "register-sole-proprietorship.php": "Business Set up & REgistration/Sole proprietorship.jpg",
    "msme-udyam-registration.php": "Business Set up & REgistration/MSME.jpg",
    "fssai-food-licence-india.php": "Business Set up & REgistration/FSSAI.jpg",
    "professional-tax-return-filing.php": "Business Set up & REgistration/Professional Tax.jpg",
    "epf-esi-registration-compliance.php": "Business Set up & REgistration/EPF & ESI.jpg",
    "iec-registration.php": "Business Set up & REgistration/IMport Export Code.jpg",
    "digital-signature-certificate-registration.php": "Business Set up & REgistration/Digital Signature.jpg",
    "12a-80g-registration.php": "Business Set up & REgistration/12A & 80G.jpg",
    "gst-registration.php": "Taxation/GST/GST Registration.png",
    "gst-return-filing-services.php": "Taxation/GST/GST Return filing.jpg",
    "gst-advisory.php": "Taxation/GST/GST Advisory.jpg",
    "gst-assessment-appeal-services.php": "Taxation/GST/GST Assessment.jpg",
    "gst-lut-filing.php": "Taxation/GST/GST LUT filing.jpg",
    "gst-cancellation-services.php": "Taxation/GST/GST REgistration Cancellation.jpg",
    "income-tax-filing-service.php": "Taxation/ITR/Incometax Returning filing.jpg",
    "tds-return-filing-services.php": "Taxation/ITR/TDS return filing.jpg",
    "tax-planning-services.php": "Taxation/ITR/Tax Planning & Advisory.jpg",
    "tax-audit.php": "Taxation/ITR/TAX Audit & Assistance.jpg",
    "income-tax-appeal-services.php": "Taxation/ITR/TAx Assessment & Appeal.jpg",
    "add-remove-director-service.php": "ROC Compliance/Add ro remove director.jpg",
    "winding-up-of-company.php": "ROC Compliance/Company Closure_windup.jpg",
    "din-kyc-filing.php": "ROC Compliance/DIR KYC.jpg",
    "increase-authorised-share-capital.php": "ROC Compliance/Increase in Authorised Capital.jpg",
    "roc-compliance-filing.php": "ROC Compliance/Miselleneous ROC filings.jpg",
    "registered-office-change-india.php": "ROC Compliance/Registered Office change.jpg",
    "bookkeeping-and-accounting-services.php": "Accounting&Reporting/Financial Statement.jpg",
    "financial-statement-analysis.php": "Accounting&Reporting/Financial Statement.jpg",
    "financial-analysis-mis.php": "Accounting&Reporting/Financial Analysis & MIS reporting.jpg",
    "accounts-receivable-payable-service.php": "Accounting&Reporting/Receivable & Payable management.jpg",
    "budgeting-forecasting-services.php": "Advisory & CFO/Budgeting & Forecasting.jpg",
    "business-valuation-services.php": "Advisory & CFO/Business valuation.jpg",
    "cfo-financial-management-services.php": "Advisory & CFO/CFO & Financial management.jpeg",
    "feasibility-study.php": "Advisory & CFO/Feasibility Study.jpeg",
    "financial-assessment-services.php": "Advisory & CFO/Financial Assessment.jpg",
    "payroll-management-compliance.php": "Advisory & CFO/Payroll Management.jpeg",
    "private-company-compliance.php": "ROC Compliance/Miselleneous ROC filings.jpg",
    "partnership-firm-compliance.php": "ROC Compliance/Miselleneous ROC filings.jpg",
    "sole-proprietorship-compliance.php": "ROC Compliance/Miselleneous ROC filings.jpg",
    "public-ltd-compliance.php": "ROC Compliance/Miselleneous ROC filings.jpg",
    "llp-annual-compliance.php": "ROC Compliance/Miselleneous ROC filings.jpg",
    "opc-annual-compliance.php": "ROC Compliance/Miselleneous ROC filings.jpg",
}


def asset_url(relative: str) -> str:
    parts = [*ASSET_ROOT.split("/"), *relative.replace("\\", "/").split("/")]
    return "/" + "/".join(quote(p, safe="") for p in parts)


def main() -> None:
    overview_re = re.compile(
        r"(\$caaft_overview_image_src\s*=\s*)['\"][^'\"]+['\"]\s*;",
        re.MULTILINE,
    )
    overview_img_re = re.compile(
        r'(<div class="bk-overview-image-wrap[^"]*">\s*<img\s+src=")[^"]+(")',
        re.MULTILINE,
    )

    updated: list[str] = []
    for php_name, rel in IMAGE_MAP.items():
        path = SERVICES / php_name
        if not path.is_file():
            print(f"SKIP missing page: {php_name}")
            continue
        img_path = ROOT / ASSET_ROOT.replace("/", "\\") / rel.replace("/", "\\")
        if not img_path.is_file():
            print(f"SKIP missing image: {rel}")
            continue

        url = asset_url(rel)
        text = path.read_text(encoding="utf-8")
        new_text, n1 = overview_re.subn(rf"\1'{url}';", text, count=1)
        new_text, n2 = overview_img_re.subn(rf"\1{url}\2", new_text, count=1)
        if n1 == 0 and n2 == 0:
            print(f"SKIP no overview image slot: {php_name}")
            continue
        if new_text != text:
            path.write_text(new_text, encoding="utf-8")
            updated.append(php_name)
            print(f"OK {php_name} -> {rel}")

    print(f"\nUpdated {len(updated)} files.")


if __name__ == "__main__":
    main()
