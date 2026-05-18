#!/usr/bin/env python3
from pathlib import Path

path = Path(__file__).resolve().parents[1] / "app/pages/core/index.php"
text = path.read_text(encoding="utf-8")

quote_start = text.index('<div class="container">\n            <div class="quote-area ">')
team_marker = "<!-- ===== 6. TEAM / FOUNDER SECTION ===== -->"
quote_end = text.index(team_marker)

quote_block = text[quote_start:quote_end]
without_quote = text[:quote_start] + text[quote_end:]

# Insert after home3-leaders-area (The Experts Behind CAAFT), before </main>
insert_point = without_quote.index("\n\n    </main>")
new_text = without_quote[:insert_point] + "\n" + quote_block + without_quote[insert_point:]
path.write_text(new_text, encoding="utf-8")
print("Moved Get your quote below The Experts Behind CAAFT.")
