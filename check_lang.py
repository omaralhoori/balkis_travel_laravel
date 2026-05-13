import json
import re

def has_arabic(text):
    return bool(re.search('[\u0600-\u06FF]', text))

with open('lang/ar.json', 'r') as f:
    ar = json.load(f)

with open('lang/tr.json', 'r') as f:
    tr = json.load(f)

with open('lang/fr.json', 'r') as f:
    fr = json.load(f)

print("--- Missing/Arabic in TR ---")
for k, v in ar.items():
    if k not in tr:
        print(f"MISSING: {k}")
    elif has_arabic(tr[k]):
        print(f"ARABIC: {k} -> {tr[k]}")

print("\n--- Missing/Arabic in FR ---")
for k, v in ar.items():
    if k not in fr:
        print(f"MISSING: {k}")
    elif has_arabic(fr[k]):
        print(f"ARABIC: {k} -> {fr[k]}")
