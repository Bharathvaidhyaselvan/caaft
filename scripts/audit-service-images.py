#!/usr/bin/env python3
from pathlib import Path
import re

root = Path(__file__).resolve().parents[1]
services = root / "app/pages/services"
skip = {"header.php", "header-top.php", "footer.php", "footer-bottom.php"}

hubs = {
    "accounting-reporting.php",
    "advisory-and-cfo-services.php",
    "business-setup-and-registration.php",
    "compliance-and-regulatory-services.php",
    "taxation-services.php",
}

with_overview = set()
with_local = set()
all_php = []

for php in sorted(services.glob("*.php")):
    if php.name in skip:
        continue
    all_php.append(php.name)
    text = php.read_text(encoding="utf-8", errors="ignore")
    if "caaft-overview-card.php" in text or (
        "bk-overview" in text and "overview-image" in text
    ):
        with_overview.add(php.name)
    if "/assets/img/services/" in text:
        with_local.add(php.name)

no_overview = sorted(set(all_php) - with_overview - hubs)
hub_list = sorted(h for h in all_php if h in hubs)
no_local = sorted(with_overview - with_local)

shared = {}
for php in with_overview:
    text = (services / php).read_text(encoding="utf-8")
    m = re.search(r"caaft_overview_image_src\s*=\s*'([^']+)'", text)
    if not m:
        m = re.search(r'src="(/assets/img/services/[^"]+)"', text)
    if m:
        shared.setdefault(m.group(1), []).append(php)

print("HUB PAGES (no What is overview image block):")
for h in hub_list:
    print(f"  - {h}")

print(f"\nNO overview section ({len(no_overview)}):")
for p in no_overview:
    print(f"  - {p}")

print(f"\nHas overview but NOT updated ({len(no_local)}):")
for p in no_local:
    print(f"  - {p}")

print("\nSHARED placeholder (need dedicated image):")
for u, pages in sorted(shared.items(), key=lambda x: -len(x[1])):
    if len(pages) > 1:
        print(f"  {u} ({len(pages)} pages)")
        for p in sorted(pages):
            print(f"    - {p}")

asset_count = sum(1 for _ in (root / "assets/img/services").rglob("*") if _.is_file())
print(f"\nAssets in folder: {asset_count}")
print(f"Pages with local image: {len(with_local)}")
