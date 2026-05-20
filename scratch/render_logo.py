import fitz # PyMuPDF
import os
import shutil

pdf_path = r"F:\IEB_original_logo.pdf"
logo_dir = r"c:\ProgramData\Herd\impetus\public\images\logo"

print("Starting logo rendering from PDF...")

# Ensure backups
logo_png = os.path.join(logo_dir, "logo-impetus.png")
logo_small_png = os.path.join(logo_dir, "logo-impetus-small.png")
logo_icon_png = os.path.join(logo_dir, "logo-icon-impetus.png")

if os.path.exists(logo_png):
    shutil.copy2(logo_png, logo_png + ".bak")
    print(f"Backed up logo-impetus.png to {logo_png}.bak")
    
if os.path.exists(logo_small_png):
    shutil.copy2(logo_small_png, logo_small_png + ".bak")
    print(f"Backed up logo-impetus-small.png to {logo_small_png}.bak")

# Render PDF using PyMuPDF
doc = fitz.open(pdf_path)
page = doc[0]

# Render large version (8x scale -> 2304 x 864)
zoom = 8.0
mat = fitz.Matrix(zoom, zoom)
pix = page.get_pixmap(matrix=mat, alpha=True)
pix.save(logo_png)
print(f"Rendered and saved high-resolution logo (8x zoom, transparent) to {logo_png}")

# Render small version (4x scale -> 1152 x 432)
zoom_small = 4.0
mat_small = fitz.Matrix(zoom_small, zoom_small)
pix_small = page.get_pixmap(matrix=mat_small, alpha=True)
pix_small.save(logo_small_png)
print(f"Rendered and saved small-resolution logo (4x zoom, transparent) to {logo_small_png}")

# Let's inspect the bounding boxes of non-transparent pixels to see if we can crop the icon only
# PyMuPDF lets us inspect the pixmap directly, or we can use PIL to crop it
from PIL import Image
img = Image.open(logo_png)
bbox = img.getbbox()
print(f"Bounding box of non-transparent content: {bbox}")

# If we want to crop the icon only:
# The icon is an Orange Circle with 'i' icon on the left.
# Let's see if we can crop just the left-most square of the image to get the icon!
# Typically the logo is square icon on the left + text on the right.
# Let's write a script to auto-detect the icon portion or just crop a square from the left edge of the bounding box.
if bbox:
    width = bbox[2] - bbox[0]
    height = bbox[3] - bbox[1]
    print(f"Content width: {width}, height: {height}")
    
    # The icon is usually on the left and has a circular shape. Its height is equal to its width.
    # Let's crop a square from the left part of the bbox
    icon_size = height
    icon_bbox = (bbox[0], bbox[1], bbox[0] + icon_size, bbox[1] + icon_size)
    print(f"Suggested icon bounding box: {icon_bbox}")
    icon_img = img.crop(icon_bbox)
    
    # Save the cropped icon
    icon_img.save(logo_icon_png)
    print(f"Cropped and saved icon-only logo to {logo_icon_png}")
