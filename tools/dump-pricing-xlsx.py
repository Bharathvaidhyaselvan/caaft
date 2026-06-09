#!/usr/bin/env python3
import zipfile
import xml.etree.ElementTree as ET
from pathlib import Path

path = Path(r"C:\Users\bhara\Downloads\CAAFT_Website_Pricing.xlsx")
out = Path(__file__).resolve().parent / "pricing-xlsx-latest.txt"
ns = {"m": "http://schemas.openxmlformats.org/spreadsheetml/2006/main"}
M = "{http://schemas.openxmlformats.org/spreadsheetml/2006/main}"

with zipfile.ZipFile(path) as z:
    ss = ET.fromstring(z.read("xl/sharedStrings.xml"))
    strings = []
    for si in ss.findall("m:si", ns):
        strings.append("".join((t.text or "") for t in si.iter(f"{M}t")))
    sheet = ET.fromstring(z.read("xl/worksheets/sheet1.xml"))
    lines = []
    for row in sheet.findall(".//m:sheetData/m:row", ns):
        cells = []
        for c in row.findall("m:c", ns):
            v = c.find("m:v", ns)
            if v is None:
                cells.append("")
            elif c.get("t") == "s":
                cells.append(strings[int(v.text)])
            else:
                cells.append(v.text or "")
        if any(cells):
            lines.append(" | ".join(cells))
out.write_text("\n".join(lines), encoding="utf-8")
print(f"Wrote {len(lines)} rows to {out}")
