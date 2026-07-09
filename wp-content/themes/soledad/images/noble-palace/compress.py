from PIL import Image
import os

img_dir = r"c:\xampp\htdocs\stnd\wp-content\themes\soledad\images\noble-palace"

# Resize hero-bg for mobile with lower quality
hero_path = os.path.join(img_dir, "hero-bg.webp")
hero_mobile_path = os.path.join(img_dir, "hero-bg-mobile.webp")
hero_img = Image.open(hero_path)

# Mobile size: 800 width, lower quality to save 11+ KB
w, h = hero_img.size
new_w = 800
new_h = int(h * (new_w / w))
hero_mobile = hero_img.resize((new_w, new_h), Image.Resampling.LANCZOS)
hero_mobile.save(hero_mobile_path, "WEBP", quality=35, method=6)
print(f"Created compressed {hero_mobile_path}")
