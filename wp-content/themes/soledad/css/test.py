import re
import os

# --- CẤU HÌNH (Oniichan chỉnh ở đây nha) ---

# Thư mục gốc muốn quét (Nó sẽ quét cả thư mục con luôn nha!)
root_folder_path = r"C:\xampp\htdocs\stnd\wp-content\themes\soledad"

# Các loại file cần xử lý
TARGET_EXTENSIONS = ['.css', '.php', '.html']

BASE_PIXEL = 16      # 1 rem = 16px
IGNORE_THRESHOLD = 5 # Giữ nguyên nếu <= 5px

# Từ khóa cấm "CỨNG" (Dù là file gì cũng bỏ qua dòng này)
# Lý do: Media query luôn cần pixel chính xác để trigger
GLOBAL_EXCLUDED_KEYWORDS = ["@media", "min-width", "max-width"]

# Từ khóa cấm "MỀM" (Chỉ áp dụng cho file .css thuần)
# Lý do: Trong HTML/PHP, "border" là tên class Tailwind, không được chặn cả dòng!
CSS_ONLY_EXCLUDED_KEYWORDS = ["border", "flex-basis", "outline"]

def convert_match(match):
    """
    Logic đổi px sang rem (Giữ nguyên như cũ)
    """
    original_str = match.group(0)
    try:
        px_value = float(match.group(1))
        
        # Logic bảo vệ giá trị nhỏ (Border, shadow blur nhỏ...)
        if px_value <= IGNORE_THRESHOLD:
            return original_str
        
        rem_value = px_value / BASE_PIXEL
        return f"{rem_value:g}rem"
    except ValueError:
        return original_str

def process_line(line, extension):
    """
    Xử lý từng dòng, có phân biệt đối xử giữa CSS và HTML/PHP
    """
    # 1. Kiểm tra từ khóa cấm CỨNG (áp dụng mọi nơi)
    if any(k.lower() in line.lower() for k in GLOBAL_EXCLUDED_KEYWORDS):
        return line
    
    # 2. Kiểm tra từ khóa cấm MỀM (Chỉ áp dụng cho file .css)
    if extension == '.css':
        if any(k.lower() in line.lower() for k in CSS_ONLY_EXCLUDED_KEYWORDS):
            return line
            
    # 3. Tìm và diệt px
    # Regex này bắt số + px (ví dụ: 20px, 10.5px)
    return re.sub(r'(\d*\.?\d+)px', convert_match, line)

def process_folder():
    print(f"🌊 Neptune V2 đang quét toàn bộ thư mục: {root_folder_path}")
    print(f"🎯 Mục tiêu: {TARGET_EXTENSIONS}")
    
    total_files = 0
    total_changes = 0

    # os.walk giúp đi xuyên qua mọi ngóc ngách thư mục con
    for root, dirs, files in os.walk(root_folder_path):
        for filename in files:
            # Lấy đuôi file
            _, ext = os.path.splitext(filename)
            
            # Chỉ xử lý file trong danh sách
            if ext.lower() in TARGET_EXTENSIONS:
                file_path = os.path.join(root, filename)
                
                try:
                    # Đọc file
                    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                        lines = f.readlines()
                    
                    new_lines = []
                    file_changed = False
                    
                    for line in lines:
                        # Gọi hàm xử lý, truyền thêm đuôi file để nó biết cách ứng xử
                        processed_line = process_line(line, ext.lower())
                        new_lines.append(processed_line)
                        
                        if processed_line != line:
                            file_changed = True
                            total_changes += 1

                    # Nếu có thay đổi thì mới ghi lại file (Tiết kiệm ổ cứng nha Oniichan)
                    if file_changed:
                        print(f"⚡ Đang sửa file: {filename}")
                        with open(file_path, 'w', encoding='utf-8') as f:
                            f.write("".join(new_lines))
                        total_files += 1

                except Exception as e:
                    print(f"⚠️ Lỗi khi đọc file {filename}: {e}")

    print("-" * 40)
    print(f"✅ Hoàn tất nhiệm vụ!")
    print(f"📂 Số file đã chỉnh sửa: {total_files}")
    print(f"🔧 Tổng số dòng code đã convert: {total_changes}")
    print("-" * 40)

if __name__ == "__main__":
    process_folder()