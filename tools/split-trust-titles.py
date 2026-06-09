"""Split long 2nd trust indicator titles into title + description pairs."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "app" / "pages" / "services"

SPLITS = {
    "Helping Businesses Stay Compliant and Growth-Ready": (
        "Helping Businesses Stay Compliant",
        "and Growth-Ready",
    ),
    "Expert Support for FSSAI Registration & Renewals": (
        "Expert FSSAI Support",
        "Registration & Renewals",
    ),
    "Nationwide DSC Services for Professionals and Businesses": (
        "Nationwide DSC Services",
        "for Professionals and Businesses",
    ),
    "Helping Companies Manage Director Changes Smoothly": (
        "Helping Companies Manage",
        "Director Changes Smoothly",
    ),
    "Expert Assistance for Annual Director KYC Filing": (
        "Expert Director KYC Assistance",
        "Annual Filing Support",
    ),
    "End-to-End OPC Annual Filing Support": (
        "End-to-End OPC Support",
        "Annual Filing",
    ),
    "Simplifying MCA Company Closure Process": (
        "Simplifying Company Closure",
        "MCA Winding Up Process",
    ),
    "Trusted Public Limited Compliance Partner": (
        "Trusted Compliance Partner",
        "for Public Limited Companies",
    ),
    "Proprietorship Compliance End-to-End Support": (
        "Proprietorship Compliance",
        "End-to-End Support",
    ),
    "End-to-End GST Registration Surrender Support": (
        "End-to-End GST Surrender",
        "Registration Cancellation Support",
    ),
    "Simplifying Business Valuation for Growth & Funding": (
        "Simplifying Business Valuation",
        "for Growth & Funding",
    ),
    "End-to-End Authorized Share Capital Increase Support": (
        "Authorized Capital Increase",
        "End-to-End Support",
    ),
    "End-to-End Financial Statement Preparation Support": (
        "Financial Statement Preparation",
        "End-to-End Support",
    ),
    "End-to-End Budgeting & Forecasting Support": (
        "Budgeting & Forecasting",
        "End-to-End Support",
    ),
    "Seamless Financial Management & Strategic Support": (
        "Seamless Financial Management",
        "Strategic Support",
    ),
    "Trusted Partner for Business Accounting & Financial Management": (
        "Trusted Accounting Partner",
        "Business Accounting & Financial Management",
    ),
    "End-to-End MIS Reporting & Analysis Support": (
        "End-to-End MIS Reporting",
        "Analysis Support",
    ),
}

INLINE_HTML = {
    "End-to-End ITR Filing Support for Individuals & Businesses": (
        "End-to-End ITR Filing Support",
        "for Individuals & Businesses",
    ),
}


def replace_pairs(content: str, old_title: str, new_title: str, new_desc: str) -> str:
    patterns = [
        f"'title' => '{old_title}', 'description' => ''",
        f"'title' => '{old_title}',\n                'description' => ''",
        f"'title' => '{old_title}',\n            'description' => ''",
        f"'title' => '{old_title}',\n        'description' => ''",
    ]
    replacements = [
        f"'title' => '{new_title}', 'description' => '{new_desc}'",
        f"'title' => '{new_title}',\n                'description' => '{new_desc}'",
        f"'title' => '{new_title}',\n            'description' => '{new_desc}'",
        f"'title' => '{new_title}',\n        'description' => '{new_desc}'",
    ]
    for old, new in zip(patterns, replacements):
        content = content.replace(old, new)
    return content


def main() -> None:
    for path in sorted(ROOT.glob("*.php")):
        content = path.read_text(encoding="utf-8")
        original = content

        for old_title, (new_title, new_desc) in SPLITS.items():
            content = replace_pairs(content, old_title, new_title, new_desc)

        for old_title, (new_title, new_desc) in INLINE_HTML.items():
            content = content.replace(
                f"<h3>{old_title}</h3>\n                            <p></p>",
                f"<h3>{new_title}</h3>\n                            <p>{new_desc}</p>",
            )
            content = content.replace(
                f"<h3>{old_title.replace('&', '&amp;')}</h3>\n                            <p></p>",
                f"<h3>{new_title.replace('&', '&amp;')}</h3>\n                            <p>{new_desc}</p>",
            )

        if content != original:
            path.write_text(content, encoding="utf-8")
            print(f"OK: {path.name}")


if __name__ == "__main__":
    main()
