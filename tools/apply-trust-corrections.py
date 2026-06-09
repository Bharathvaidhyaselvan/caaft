"""Apply 2nd trust indicator corrections from Excel to service pages."""
import re
import openpyxl
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "app" / "pages" / "services"
EXCEL = Path(r"c:\Users\bhara\My Drive\Home\Clients\Caaft\Website_Final corrections.xlsx")

SERVICE_TO_FILE = {
    "Private Limited Company": "private-limited-registration.php",
    "Public Limited Company": "public-limited-company-registration.php",
    "One Person Company (OPC)": "one-person-company-registration.php",
    "LLP Registration": "llp-registration-services.php",
    "Partnership Firm Registration": "register-partnership-firm.php",
    "Sole Proprietorship Registration": "register-sole-proprietorship.php",
    "MSME / Udyam Registration": "msme-udyam-registration.php",
    "FSSAI Registration": "fssai-food-licence-india.php",
    "Professional tax registration": "professional-tax-return-filing.php",
    "EPF & ESI Registration & Compliance": "epf-esi-registration-compliance.php",
    "Import Export Code (IEC)": "iec-registration.php",
    "Digital Signature Certificate (DSC)": "digital-signature-certificate-registration.php",
    "12A & 80G Registration": "12a-80g-registration.php",
    "Private Limited Compliance": "private-company-compliance.php",
    "Limited Liability Partnership (LLP) Compliance": "llp-annual-compliance.php",
    "One Person Company (OPC) Compliance": "opc-annual-compliance.php",
    "Partnership Firm Compliance": "partnership-firm-compliance.php",
    "Sole Proprietorship Compliance": "sole-proprietorship-compliance.php",
    "Public Limited Compliance": "public-ltd-compliance.php",
    "Director KYC (DIR-3 KYC Filing)": "din-kyc-filing.php",
    "Add / Remove Director": "add-remove-director-service.php",
    "Increase in Authorized Capital": "increase-authorised-share-capital.php",
    "Registered Office Change": "registered-office-change-india.php",
    "Miscellaneous ROC Filings": "roc-compliance-filing.php",
    "Company Closure / Winding Up": "winding-up-of-company.php",
    "Income Tax Return (ITR) Filing": "income-tax-filing-service.php",
    "TDS Return Filing": "tds-return-filing-services.php",
    "Tax Audit Assistance": "tax-audit.php",
    "GST Return Filing": "gst-return-filing-services.php",
    "GST Registration Cancellation": "gst-cancellation-services.php",
    "General Accounting & Bookkeeping": "bookkeeping-and-accounting-services.php",
    "Financial Analysis & MIS Reporting": "financial-analysis-mis.php",
    "Financial Statements": "financial-statement-analysis.php",
    "Receivable & Payable Management": "accounts-receivable-payable-service.php",
    "Budgeting & Forecasting": "budgeting-forecasting-services.php",
    "Business Valuation": "business-valuation-services.php",
    "Feasibility Study": "feasibility-study.php",
    "CFO & Financial Management": "cfo-financial-management-services.php",
}


def parse_correction(text: str) -> tuple[str, str]:
    if "\n" in text:
        parts = [p.strip() for p in text.split("\n") if p.strip()]
        if len(parts) >= 2:
            return parts[0], parts[1]
    text = text.replace("\n", " ").strip()
    text = text.replace("Businesse", "Businesses")
    match = re.match(r"^(.+?)\(([^)]+)\)\s*$", text)
    if match:
        return match.group(1).strip(), match.group(2).strip()
    if text.endswith(" Across India"):
        return text[: -len(" Across India")].strip(), "Across India"
    if text.endswith(" Nationwide"):
        return text[: -len(" Nationwide")].strip(), "Nationwide"
    return text, ""


def find_trust_items(content: str) -> list[tuple[int, int]] | None:
    start = content.find("$caaft_trust_items")
    if start == -1:
        return None
    bracket = content.find("[", start)
    if bracket == -1:
        return None
    depth = 0
    items: list[tuple[int, int]] = []
    item_starts: list[int] = []
    i = bracket
    while i < len(content):
        char = content[i]
        if char == "[":
            if depth == 1:
                item_starts.append(i)
            depth += 1
        elif char == "]":
            depth -= 1
            if depth == 1:
                items.append((item_starts[-1], i + 1))
                item_starts.pop()
            elif depth == 0:
                break
        i += 1
    return items if len(items) >= 2 else None


def build_item(indent: str, icon: str, title: str, desc: str, multiline: bool) -> str:
    if multiline:
        return (
            f"{indent}[\n"
            f"{indent}    'icon_class' => '{icon}',\n"
            f"{indent}    'title' => '{title}',\n"
            f"{indent}    'description' => '{desc}',\n"
            f"{indent}],"
        )
    return f"{indent}['icon_class' => '{icon}', 'title' => '{title}', 'description' => '{desc}'],"


def main() -> None:
    wb = openpyxl.load_workbook(EXCEL, read_only=True, data_only=True)
    ws = wb["Sheet1"]
    corrections: dict[str, tuple[str, str, str]] = {}

    for service, correction in ws.iter_rows(min_row=2, values_only=True):
        if not service or not correction:
            continue
        service_name = str(service).strip().lstrip("\t")
        correction_text = str(correction).strip()
        if service_name in ("Services", "Page") or correction_text == "Correction":
            continue
        filename = SERVICE_TO_FILE.get(service_name)
        if not filename:
            print(f"NO MAP: {service_name!r}")
            continue
        title, desc = parse_correction(correction_text)
        corrections[filename] = (title, desc, service_name)

    print(f"Mapped {len(corrections)} pages")
    updated = 0
    failed: list[tuple[str, str]] = []

    for filename, (new_title, new_desc, service_name) in sorted(corrections.items()):
        path = ROOT / filename
        if not path.exists():
            failed.append((filename, "file missing"))
            continue
        content = path.read_text(encoding="utf-8")
        items = find_trust_items(content)
        if not items:
            failed.append((filename, "trust items not found"))
            continue

        old_second = content[items[1][0] : items[1][1]]
        icon_match = re.search(r"'icon_class'\s*=>\s*'([^']+)'", old_second)
        if not icon_match:
            icon_match = re.search(r'"icon_class"\s*=>\s*"([^"]+)"', old_second)
        icon = icon_match.group(1) if icon_match else "fas fa-building"

        line_start = content.rfind("\n", 0, items[1][0]) + 1
        indent = re.match(r"(\s*)", content[line_start:]).group(1)
        multiline = "\n" in old_second.strip()
        new_item = build_item(indent, icon, new_title, new_desc, multiline)
        new_content = content[: items[1][0]] + new_item + content[items[1][1] :]

        if new_content != content:
            path.write_text(new_content, encoding="utf-8")
            updated += 1
            print(f"OK: {filename} | {new_title} | {new_desc}")

    print(f"\nUpdated: {updated}, Failed: {len(failed)}")
    for fname, reason in failed:
        print(f"FAIL: {fname} - {reason}")


if __name__ == "__main__":
    main()
