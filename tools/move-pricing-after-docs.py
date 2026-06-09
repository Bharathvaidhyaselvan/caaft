#!/usr/bin/env python3
import re
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

include_re = re.compile(
    r"\n[ \t]*<\?php include __DIR__ \. '/\.\./\.\./includes/components/caaft-business-setup-pricing\.php'; \?>\n*",
)
docs_re = re.compile(
    r'([ \t]*)<section class="plc-docs-section"[^>]*>.*?</section>\n',
    re.DOTALL,
)

for name in files:
    path = root / name
    text = path.read_text(encoding="utf-8")
    text = include_re.sub("\n", text, count=1)

    match = docs_re.search(text)
    if not match:
        print("NO DOCS SECTION", name)
        continue

    indent = match.group(1)
    insert = f"\n{indent}<?php include __DIR__ . '/../../includes/components/caaft-business-setup-pricing.php'; ?>\n"
    pos = match.end()
    if "caaft-business-setup-pricing.php" in text[pos : pos + 120]:
        print("already after docs", name)
        path.write_text(text, encoding="utf-8")
        continue

    text = text[:pos] + insert + text[pos:]
    path.write_text(text, encoding="utf-8")
    print("moved", name)
