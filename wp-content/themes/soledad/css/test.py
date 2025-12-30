import re
import os
import sys

# --- CẤU HÌNH CỐ ĐỊNH ---
TARGET_EXTENSIONS = ['.css', '.php', '.html']
BASE_PIXEL = 16      
IGNORE_THRESHOLD = 5 

# Từ khóa cấm "CỨNG" (Media queries, v.v.)
GLOBAL_EXCLUDED_KEYWORDS = ["@media", "min-width", "max-width"]
# Từ khóa cấm "MỀM" (Chỉ áp dụng file .css)
CSS_ONLY_EXCLUDED_KEYWORDS = ["border", "flex-basis", "outline"]

def convert_match(match):
    """ Logic đổi px sang rem """
    original_str = match.group(0)
    try:
        px_value = float(match.group(1))
        if px_value <= IGNORE_THRESHOLD:
            return original_str
        rem_value = px_value / BASE_PIXEL
        return f"{rem_value:g}rem"
    except ValueError:
        return original_str

def process_line(line, extension):
    """ Xử lý dòng code dựa trên loại file """
    if any(k.lower() in line.lower() for k in GLOBAL_EXCLUDED_KEYWORDS):
        return line
    
    if extension == '.css':
        if any(k.lower() in line.lower() for k in CSS_ONLY_EXCLUDED_KEYWORDS):
            return line
            
    return re.sub(r'(\d*\.?\d+)px', convert_match, line)

def get_user_input_path():
    """ Hàm hỏi đường dẫn từ người dùng """
    print("\n" + "="*50)
    print("🔱 NEPTUNE PIXEL CONVERTER (PX -> REM) 🔱")
    print("="*50)
    
    while True:
        # Nhập đường dẫn
        raw_path = input("👉 Mời Oniichan nhập đường dẫn thư mục cần quét: ")
        
        # Xử lý: Xóa khoảng trắng thừa, xóa dấu ngoặc kép " hoặc ' nếu có
        clean_path = raw_path.strip().strip('"').strip("'")
        
        # Kiểm tra rỗng
        if not clean_path:
            print("⚠️ Oniichan chưa nhập gì cả. Thử lại nhé!")
            continue
            
        # Kiểm tra đường dẫn có tồn tại không
        if os.path.exists(clean_path):
            return clean_path
        else:
            print(f"❌ Đường dẫn không tồn tại: {clean_path}")
            print("💡 Oniichan kiểm tra lại xem có copy thiếu chữ nào không nha?")

def process_folder():
    # 1. Lấy đường dẫn từ người dùng nhập
    root_folder_path = get_user_input_path()
    
    print(f"\n🚀 Đang khởi động quét tại: {root_folder_path}")
    print(f"🎯 Mục tiêu: {TARGET_EXTENSIONS}")
    print("-" * 30)
    
    total_files = 0
    total_changes = 0

    # 2. Bắt đầu quét
    for root, dirs, files in os.walk(root_folder_path):
        for filename in files:
            _, ext = os.path.splitext(filename)
            
            if ext.lower() in TARGET_EXTENSIONS:
                file_path = os.path.join(root, filename)
                
                try:
                    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                        lines = f.readlines()
                    
                    new_lines = []
                    file_changed = False
                    
                    for line in lines:
                        processed_line = process_line(line, ext.lower())
                        new_lines.append(processed_line)
                        if processed_line != line:
                            file_changed = True
                            total_changes += 1

                    if file_changed:
                        print(f"⚡ Đã sửa file: {filename}")
                        with open(file_path, 'w', encoding='utf-8') as f:
                            f.write("".join(new_lines))
                        total_files += 1

                except Exception as e:
                    print(f"⚠️ Lỗi khi đọc file {filename}: {e}")

    print("\n" + "="*50)
    print(f"✅ HOÀN TẤT NHIỆM VỤ!")
    print(f"📂 Tổng số file đã sửa: {total_files}")
    print(f"🔧 Tổng số dòng code đã convert: {total_changes}")
    print("="*50)
    
    # Giữ màn hình console không tắt ngay để Oniichan kịp đọc kết quả
    input("\nNhấn Enter để thoát nha Oniichan...")

if __name__ == "__main__":
    try:
        process_folder()
    except KeyboardInterrupt:
        print("\n\n👋 Oniichan đã hủy chương trình. Hẹn gặp lại!")
        sys.exit()