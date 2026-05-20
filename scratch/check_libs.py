import sys

libs = ['pypdf', 'fitz', 'pdf2image', 'pdfplumber', 'reportlab', 'fpdf2', 'PIL', 'matplotlib']
for lib in libs:
    try:
        __import__(lib)
        print(f"{lib}: available")
    except ImportError:
        print(f"{lib}: NOT available")
