#!/usr/bin/env python3
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / 'app' / 'pages' / 'services'

UPDATES = {
    'private-limited-registration.php': [
        ("'title' => '500+', 'description' => 'Companies Registered'", "'title' => '300+', 'description' => 'Companies Registered'"),
    ],
    'public-limited-company-registration.php': [
        ("'title' => '500+', 'description' => 'Companies Registered'", "'title' => '100+', 'description' => 'Companies Registered'"),
    ],
    'one-person-company-registration.php': [
        ("'title' => '500+', 'description' => 'OPCs Registered'", "'title' => '200+', 'description' => 'OPCs Registered'"),
    ],
    'llp-registration-services.php': [
        ("'title' => '500+', 'description' => 'LLPs Registered'", "'title' => '200+', 'description' => 'LLPs Registered'"),
    ],
    'register-partnership-firm.php': [
        ("'title' => '500+ Firms Registered'", "'title' => '100+ Firms Registered'"),
    ],
    'register-sole-proprietorship.php': [
        ("'title' => '500+ Proprietorships Registered'", "'title' => '100+ Proprietorships Registered'"),
    ],
    'msme-udyam-registration.php': [
        ("'title' => '500+ MSME Filings'", "'title' => '200+ MSME Filings'"),
    ],
    'fssai-food-licence-india.php': [
        ("'title' => '500+ Food Businesses Licensed'", "'title' => '100+ Food Businesses Licensed'"),
    ],
    'professional-tax-return-filing.php': [
        ("'title' => '500+ Businesses Registered'", "'title' => '200+ Businesses Registered'"),
    ],
    'epf-esi-registration-compliance.php': [
        ("'title' => '500+ Businesses Registered'", "'title' => '100+ Businesses Registered'"),
    ],
    'iec-registration.php': [
        ("'title' => '500+ Businesses Registered'", "'title' => '100+ Businesses Registered'"),
    ],
    'digital-signature-certificate-registration.php': [
        ("'title' => '500+ DSCs Issued'", "'title' => '300+ DSCs Issued'"),
    ],
    '12a-80g-registration.php': [
        ("'title' => '500+ NGOs Registered'", "'title' => '100+ NGOs Registered'"),
    ],
    'private-company-compliance.php': [
        ("'title' => '500+ Companies Managed'", "'title' => '300+ Companies Managed'"),
    ],
    'llp-annual-compliance.php': [
        ("'title' => '500+ LLPs Managed'", "'title' => '300+ LLPs Managed'"),
    ],
    'opc-annual-compliance.php': [
        ("'title' => '500+ OPCs Managed'", "'title' => '100+ OPCs Managed'"),
    ],
    'partnership-firm-compliance.php': [
        ("'title' => '500+ Firms Managed'", "'title' => '200+ Firms Managed'"),
    ],
    'sole-proprietorship-compliance.php': [
        ("'title' => '500+ Proprietors Served'", "'title' => '100+ Proprietors Served'"),
    ],
    'public-ltd-compliance.php': [
        ("'title' => '500+ Companies Managed'", "'title' => '100+ Companies Managed'"),
    ],
    'din-kyc-filing.php': [
        ("'title' => '500+ Directors Served'", "'title' => '200+ Directors Served'"),
    ],
    'add-remove-director-service.php': [
        ("'title' => '500+ Director Changes Handled'", "'title' => '100+ Director Changes Handled'"),
    ],
    'increase-authorised-share-capital.php': [
        ("'title' => '500+ Capital Increase Filings'", "'title' => '100+ Capital Increase Filings'"),
    ],
    'registered-office-change-india.php': [
        ("'title' => '500+ Office Changes Completed'", "'title' => '100+ Office Changes Completed'"),
    ],
    'roc-compliance-filing.php': [
        ("'title' => '500+ ROC Filings Completed'", "'title' => '300+ ROC Filings Completed'"),
    ],
    'winding-up-of-company.php': [
        ("'title' => '500+ Company Closures Completed'", "'title' => '100+ Company Closures Completed'"),
    ],
    'tds-return-filing-services.php': [
        ('<h3>1000+</h3><p>TDS Returns Filed</p>', '<h3>500+</h3><p>TDS Returns Filed</p>'),
    ],
    'gst-return-filing-services.php': [
        ("'title' => '1000+',\n                'description' => 'Returns Filed Monthly'", "'title' => '300+',\n                'description' => 'Returns Filed Monthly'"),
    ],
    'bookkeeping-and-accounting-services.php': [
        ("'title' => '500+',\n                'description' => 'Businesses Served'", "'title' => '300+',\n                'description' => 'Businesses Served'"),
    ],
    'financial-analysis-mis.php': [
        ("'title' => '500+',\n                'description' => 'Businesses Served'", "'title' => '200+',\n                'description' => 'Businesses Served'"),
    ],
    'financial-statement-analysis.php': [
        ("'title' => '500+', 'description' => 'Businesses Served'", "'title' => '100+', 'description' => 'Businesses Served'"),
    ],
    'accounts-receivable-payable-service.php': [
        ("'title' => '500+', 'description' => 'Businesses Served'", "'title' => '200+', 'description' => 'Businesses Served'"),
    ],
    'cfo-financial-management-services.php': [
        ("'title' => '200+ Businesses Served'", "'title' => '100+ Businesses Served'"),
    ],
}

changed = []
missing = []
for fname, reps in UPDATES.items():
    path = ROOT / fname
    if not path.exists():
        missing.append(fname)
        continue
    text = path.read_text(encoding='utf-8')
    orig = text
    for old, new in reps:
        if old not in text:
            missing.append(f'{fname}: not found')
            continue
        text = text.replace(old, new, 1)
    if text != orig:
        path.write_text(text, encoding='utf-8')
        changed.append(fname)

print('CHANGED', len(changed))
for f in changed:
    print(f)
print('MISSING', len(missing))
for m in missing:
    print(m)
