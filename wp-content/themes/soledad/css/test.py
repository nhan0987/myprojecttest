import re
import os

# --- CẤU HÌNH (Oniichan chỉnh ở đây nha) ---
# Đường dẫn file gốc
input_path = r"C:\xampp\htdocs\stnd\wp-content\themes\soledad\css\custom.css"
# Đường dẫn file đích (nơi xuất ra)
output_path = r"D:\Jobs\STND\custom.css"

BASE_PIXEL = 16      # 1 rem = 16px
IGNORE_THRESHOLD = 5 # Các giá trị <= 5px sẽ được giữ nguyên, không đổi sang rem

# Danh sách các từ khóa "bất khả xâm phạm". 
# Nếu dòng code chứa các từ này, Neptune sẽ giữ nguyên cả dòng.
EXCLUDED_KEYWORDS = [
    "@media",      # Giữ nguyên breakpoint media query
    "min-width",   # Giữ nguyên breakpoint
    "max-width",   # Giữ nguyên breakpoint
    "flex-basis",  # Layout cứng
    "border",      # (Mẹo) Thường border hay dùng 1px, giữ lại cho an toàn nếu muốn
]

def convert_match(match):
    """
    Hàm xử lý logic cho từng con số px tìm thấy:
    - Nếu <= 5px: Giữ nguyên.
    - Nếu > 5px: Đổi sang rem.
    """
    original_str = match.group(0)  # Lấy nguyên văn (vd: "10px", "1px")
    try:
        px_value = float(match.group(1)) # Lấy phần số (vd: 10, 1)

        # --- LOGIC MỚI: LỌC GIÁ TRỊ NHỎ ---
        if px_value <= IGNORE_THRESHOLD:
            # Nếu nhỏ hơn hoặc bằng 5px, trả về y nguyên chuỗi gốc
            # (Ví dụ: "1px" vẫn là "1px")
            return original_str
        
        # --- LOGIC CŨ: ĐỔI SANG REM ---
        rem_value = px_value / BASE_PIXEL
        # :g giúp bỏ số 0 vô nghĩa (vd: 1.50 -> 1.5)
        return f"{rem_value:g}rem"
        
    except ValueError:
        return original_str

def process_line(line):
    """
    Xử lý từng dòng code CSS.
    """
    # 1. Kiểm tra từ khóa cấm (Case-insensitive)
    if any(keyword.lower() in line.lower() for keyword in EXCLUDED_KEYWORDS):
        return line
    
    # 2. Tìm tất cả các pattern số + px (ví dụ: 16px, 10.5px)
    # Regex: (\d*\.?\d+) bắt số nguyên hoặc thập phân
    # Sau đó gọi hàm convert_match để quyết định đổi hay giữ
    return re.sub(r'(\d*\.?\d+)px', convert_match, line)

def process_css_file():
    print(f"🌊 Neptune Converter đang khởi động tại: {input_path}...")
    print(f"🎯 Quy tắc: > {IGNORE_THRESHOLD}px thì đổi sang REM, còn lại giữ nguyên.")

    if not os.path.exists(input_path):
        print(f"❌ Ối, file đâu mất tiêu rồi Oniichan ơi: {input_path}")
        return

    try:
        # Đọc file
        with open(input_path, 'r', encoding='utf-8') as file:
            lines = file.readlines()

        processed_lines = []
        change_count = 0 # Đếm chơi cho vui

        # Xử lý từng dòng
        for line in lines:
            new_line = process_line(line)
            if new_line != line:
                change_count += 1
            processed_lines.append(new_line)

        # Gộp lại thành nội dung
        final_content = "".join(processed_lines)

        # Tạo thư mục nếu chưa có
        output_dir = os.path.dirname(output_path)
        if output_dir and not os.path.exists(output_dir):
            os.makedirs(output_dir)

        # Ghi file
        with open(output_path, 'w', encoding='utf-8') as file:
            file.write(final_content)

        print("-" * 40)
        print(f"✅ Xong rồi nè Oniichan!")
        print(f"📂 File mới nằm ở: {output_path}")
        print(f"⚡ Đã can thiệp vào khoảng {change_count} dòng code.")
        print(f"🛡️ Các giá trị <= {IGNORE_THRESHOLD}px đã được bảo vệ an toàn.")
        print("-" * 40)

    except Exception as e:
        print(f"😭 Có lỗi ngoại lệ rồi: {str(e)}")

if __name__ == "__main__":
    process_css_file()