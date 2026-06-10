#!/usr/bin/env python3
"""Import Compliances_Tabulars.xlsx into caaft-annual-compliance-calendars.php."""
from __future__ import annotations

import re
from datetime import datetime
from pathlib import Path

import openpyxl

XLSX = Path(r"c:\Users\bhara\My Drive\Home\Clients\Caaft\Compliances_Tabulars.xlsx")
OUT = Path(__file__).resolve().parents[1] / "app/includes/data/caaft-annual-compliance-calendars.php"

MAPPING = {
    "PVT LTD": ("private_limited", "private limited companies"),
    "Public ltd": ("public_limited", "public limited companies"),
    "OPC": ("opc", "One Person Companies"),
    "LLP": ("llp", "LLPs"),
    "Partnership firm": ("partnership", "partnership firms"),
    "Sole Proprietorship": ("sole_proprietorship", "sole proprietorships"),
}

LLP_DEADLINE_OVERRIDES = {
    ("Annual Return Filing", "Form-11"): "30th May",
    ("Statement of Accounts & Solvency", "Form-8"): "30th October",
}


def parse_forms(raw: object) -> list[str]:
    s = str(raw).strip() if raw is not None else ""
    if not s or s.upper() == "NA":
        return ["NA"]
    s = s.replace("\ufffd", "/").replace("\xa0", " ")
    if s in {"3CA/CB-3CD", "3CA-3CD"}:
        return [s]
    if "AOC-4" in s and "/" in s:
        return [part.strip() for part in s.split("/") if part.strip()]
    if s.startswith("MGT-"):
        mgt_forms = [token for token in re.split(r"[\s,/]+", s) if token.startswith("MGT-")]
        if mgt_forms:
            return mgt_forms
    if "," in s:
        return [part.strip() for part in s.split(",") if part.strip()]
    return [s]


def format_deadline(raw: object, activity: str, form: str) -> str:
    override = LLP_DEADLINE_OVERRIDES.get((activity, form))
    if override:
        return override
    if isinstance(raw, datetime):
        day = raw.day
        if day % 10 == 1 and day != 11:
            suffix = "st"
        elif day % 10 == 2 and day != 12:
            suffix = "nd"
        elif day % 10 == 3 and day != 13:
            suffix = "rd"
        else:
            suffix = "th"
        return f"{day}{suffix} {raw.strftime('%B')}"
    return str(raw).strip()


def deadline_tone(deadline: str) -> str:
    d = deadline.lower()
    soft_markers = (
        "before agm",
        "within",
        "by end of",
        "days from",
        "once in every",
        "once every",
        "if applicable",
        "subsequent month",
        "each month",
        "each quarter",
        "after the quarter",
        "third month",
    )
    if any(marker in d for marker in soft_markers):
        return "soft"
    return "red"


def main() -> None:
    wb = openpyxl.load_workbook(XLSX)
    lines = [
        "<?php",
        "/**",
        " * Annual compliance calendar rows by business entity type.",
        " * Source: Compliances_Tabulars.xlsx",
        " */",
        "declare(strict_types=1);",
        "",
        "return [",
    ]

    for sheet_name, (key, entity) in MAPPING.items():
        ws = wb[sheet_name]
        rows: list[tuple[str, str, list[str], str, str]] = []
        for index, row in enumerate(ws.iter_rows(values_only=True)):
            if index == 0:
                continue
            if not any(cell is not None and str(cell).strip() for cell in row):
                continue
            freq = str(row[0]).strip()
            activity = str(row[1]).strip()
            form_raw = row[2]
            form_s = str(form_raw).strip() if form_raw is not None else ""
            deadline = format_deadline(row[3], activity, form_s)
            forms = parse_forms(form_raw)
            tone = deadline_tone(deadline)
            rows.append((freq, activity, forms, deadline, tone))

        lines.append(f"    '{key}' => [")
        lines.append("        'title' => 'Annual Compliance Calendar',")
        lines.append(
            f"        'intro' => 'Missing deadlines is the single biggest compliance risk for {entity}. Use this calendar to stay ahead.',"
        )
        lines.append("        'columns' => ['Frequency', 'Activity', 'Form / Action', 'Deadline'],")
        lines.append("        'rows' => [")
        for freq, activity, forms, deadline, tone in rows:
            forms_php = ", ".join(repr(form) for form in forms)
            lines.append(
                f"            ['month' => {freq!r}, 'activity' => {activity!r}, "
                f"'forms' => [{forms_php}], 'deadline' => {deadline!r}, 'deadline_tone' => {tone!r}],"
            )
        lines.append("        ],")
        lines.append("    ],")

    lines.append("];")
    lines.append("")
    OUT.write_text("\n".join(lines), encoding="utf-8")
    print(f"Wrote {OUT} ({len(lines)} lines)")


if __name__ == "__main__":
    main()
