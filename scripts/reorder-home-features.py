#!/usr/bin/env python3
from pathlib import Path

path = Path(__file__).resolve().parents[1] / "app/pages/core/index.php"
text = path.read_text(encoding="utf-8")

feature_start = text.index('<div class="feature-area pt-80">')
about_start = text.index('<motion.div class="about-area py-120">') if '<motion.div class="about-area py-120">' in text else None
if about_start is None:
    about_start = text.index('<div class="about-area py-120">')
about_end = text.index('<div class="service-area2 bg py-90" id="services">')

feature_block = text[feature_start:about_start]
before = text[:feature_start]
about_block = text[about_start:about_end]
after = text[about_end:]

path.write_text(before + about_block + feature_block + after, encoding="utf-8")
print("Moved feature-area below about-area.")
