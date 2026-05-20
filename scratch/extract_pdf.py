import fitz # PyMuPDF
import os

pdf_path = r"F:\IEB_original_logo.pdf"
print(f"Checking PDF file: {pdf_path}")
if not os.path.exists(pdf_path):
    print("PDF file does not exist!")
    sys.exit(1)

doc = fitz.open(pdf_path)
print(f"Number of pages: {len(doc)}")
for i in range(len(doc)):
    page = doc[i]
    print(f"Page {i} size: {page.rect}")
    print(f"Page {i} text: {page.get_text()[:200]}")
    
    # Try extracting images
    images = page.get_images()
    print(f"Page {i} has {len(images)} images.")
    for img_idx, img in enumerate(images):
        print(f"  Image {img_idx}: xref={img[0]}, width={img[2]}, height={img[3]}")
