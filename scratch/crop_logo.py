from PIL import Image
import os

logo_dir = r"c:\ProgramData\Herd\impetus\public\images\logo"
logo_png = os.path.join(logo_dir, "logo-impetus.png")
logo_small_png = os.path.join(logo_dir, "logo-impetus-small.png")
logo_icon_png = os.path.join(logo_dir, "logo-icon-impetus.png")

# 1. Process Large Logo
img = Image.open(logo_png)
bbox = img.getbbox()
if bbox:
    # Add a small padding of 10 pixels around the content for anti-aliasing safety, but clip to image size
    padding = 10
    cropped_bbox = (
        max(0, bbox[0] - padding),
        max(0, bbox[1] - padding),
        min(img.width, bbox[2] + padding),
        min(img.height, bbox[3] + padding)
    )
    cropped_img = img.crop(cropped_bbox)
    cropped_img.save(logo_png)
    print(f"Trimmed and saved high-resolution logo to {logo_png} (size: {cropped_img.size})")

# 2. Process Small Logo
img_small = Image.open(logo_small_png)
bbox_small = img_small.getbbox()
if bbox_small:
    padding_small = 5
    cropped_bbox_small = (
        max(0, bbox_small[0] - padding_small),
        max(0, bbox_small[1] - padding_small),
        min(img_small.width, bbox_small[2] + padding_small),
        min(img_small.height, bbox_small[3] + padding_small)
    )
    cropped_img_small = img_small.crop(cropped_bbox_small)
    cropped_img_small.save(logo_small_png)
    print(f"Trimmed and saved small-resolution logo to {logo_small_png} (size: {cropped_img_small.size})")

# 3. Process Icon
img_icon = Image.open(logo_icon_png)
bbox_icon = img_icon.getbbox()
if bbox_icon:
    padding_icon = 5
    cropped_bbox_icon = (
        max(0, bbox_icon[0] - padding_icon),
        max(0, bbox_icon[1] - padding_icon),
        min(img_icon.width, bbox_icon[2] + padding_icon),
        min(img_icon.height, bbox_icon[3] + padding_icon)
    )
    cropped_img_icon = img_icon.crop(cropped_bbox_icon)
    cropped_img_icon.save(logo_icon_png)
    print(f"Trimmed and saved icon-only logo to {logo_icon_png} (size: {cropped_img_icon.size})")
