"""Audit 2nd trust indicator title lengths."""
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "app" / "pages" / "services"


def find_second(content: str) -> tuple[str, str] | None:
    start = content.find("$caaft_trust_items")
    if start != -1:
        bracket = content.find("[", start)
        depth = 0
        items: list[str] = []
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
                    items.append(content[item_starts[-1] : i + 1])
                    item_starts.pop()
                elif depth == 0:
                    break
            i += 1
        if len(items) >= 2:
            block = items[1]
            title_match = re.search(r"'title'\s*=>\s*'([^']*)'", block)
            desc_match = re.search(r"'description'\s*=>\s*'([^']*)'", block)
            if title_match:
                return title_match.group(1), desc_match.group(1) if desc_match else ""

    articles = list(re.finditer(r'<article class="caaft-ar-trust-item">', content))
    if len(articles) >= 2:
        end = articles[2].start() if len(articles) > 2 else articles[1].start() + 500
        chunk = content[articles[1].start() : end]
        title_match = re.search(r"<h3>(.*?)</h3>", chunk, re.S)
        desc_match = re.search(r"<p>(.*?)</p>", chunk, re.S)
        if title_match:
            title = re.sub(r"<[^>]+>", "", title_match.group(1)).strip()
            desc = re.sub(r"<[^>]+>", "", desc_match.group(1)).strip() if desc_match else ""
            return title, desc
    return None


def main() -> None:
    for path in sorted(ROOT.glob("*.php")):
        result = find_second(path.read_text(encoding="utf-8"))
        if not result:
            continue
        title, desc = result
        if len(title) > 32:
            print(f"{path.name}: title={title!r} | desc={desc!r}")


if __name__ == "__main__":
    main()
