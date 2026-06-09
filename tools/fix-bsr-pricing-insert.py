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
include_line = "<?php include __DIR__ . '/../../includes/components/caaft-business-setup-pricing.php'; ?>"
pattern = re.compile(
    r"\n[ \t]*<\?php include __DIR__ \. '/\.\./\.\./includes/components/caaft-business-setup-pricing\.php'; \?>\n+<\?php\n([ \t]*)\$caaft_cta_section_id",
    re.MULTILINE,
)

for name in files:
    path = root / name
    text = path.read_text(encoding="utf-8")
    if include_line not in text:
        print("missing include", name)
        continue

    def repl(match: re.Match[str]) -> str:
        indent = match.group(1)
        return (
            f"\n{indent}<?php include __DIR__ . '/../../includes/components/caaft-business-setup-pricing.php'; ?>\n\n"
            f"{indent}<?php\n{indent}$caaft_cta_section_id"
        )

    new_text, count = pattern.subn(repl, text, count=1)
    if count != 1:
        print("pattern fail", name, count)
        continue
    path.write_text(new_text, encoding="utf-8")
    print("fixed", name)
