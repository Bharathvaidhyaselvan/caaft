#!/usr/bin/env python3
from pathlib import Path

root = Path(__file__).resolve().parents[1] / "app" / "pages" / "services"
files = [
    "private-limited-registration.php",
    "public-limited-company-registration.php",
    "llp-registration-services.php",
    "register-partnership-firm.php",
    "register-sole-proprietorship.php",
    "one-person-company-registration.php",
    "msme-udyam-registration.php",
    "fssai-food-licence-india.php",
    "professional-tax-return-filing.php",
    "epf-esi-registration-compliance.php",
    "iec-registration.php",
    "digital-signature-certificate-registration.php",
    "12a-80g-registration.php",
]
needle = "caaft-business-setup-pricing.php"
cta = "include __DIR__ . '/../../includes/components/caaft-cta.php'"

for name in files:
    path = root / name
    text = path.read_text(encoding="utf-8")
    if needle in text:
        print("skip", name)
        continue
    idx = text.find(cta)
    if idx == -1:
        print("NO CTA", name)
        continue
    line_start = text.rfind("\n", 0, idx) + 1
    indent = text[line_start:idx].split("include")[0]
    insert = indent + "<?php include __DIR__ . '/../../includes/components/caaft-business-setup-pricing.php'; ?>\n\n"
    block_start = text.rfind("<?php", 0, line_start)
    path.write_text(text[:block_start] + insert + text[block_start:], encoding="utf-8")
    print("updated", name)
