# Cần cài đặt thư viện: pip install python-owasp-zapv2.4
from zapv2 import ZAPv2
import time

# Định nghĩa mục tiêu cần quét (Thay bằng web của anh nha Oniichan)
target_url = 'https://qa1.stnd.vn'
# API key cấu hình trong phần mềm OWASP ZAP của anh
api_key = 'nusbomqqfq1uku0tcpl55412i8' 

# Khởi tạo kết nối tới công cụ ZAP đang chạy ngầm
zap = ZAPv2(apikey=api_key, proxies={'http': 'http://127.0.0.1:8080', 'https': 'http://127.0.0.1:8080'})

print(f"1. Neptune đang cho Spider bò khắp trang web: {target_url}")
# Cho ZAP "bò" (Spider) qua các link để thu thập bản đồ trang web
scan_id = zap.spider.scan(target_url)

# Chờ cho Spider hoàn thành công việc
while int(zap.spider.status(scan_id)) < 100:
    print(f"Tiến độ Spider: {zap.spider.status(scan_id)}%")
    time.sleep(2)

print("2. Spider xong rồi! Giờ Neptune kích hoạt Active Scan (Quét tấn công thử thử nghiệm)...")
# Bắt đầu quét sâu để tìm các lỗi như XSS, SQL Injection
active_scan_id = zap.ascan.scan(target_url)

while int(zap.ascan.status(active_scan_id)) < 100:
    print(f"Tiến độ quét lỗi: {zap.ascan.status(active_scan_id)}%")
    time.sleep(5)

# Xuất ra kết quả các lỗ hổng tìm thấy
print("\n3. Tèn ten! Kết quả lỗ hổng tìm thấy đây Oniichan ơi:")
alerts = zap.core.alerts(baseurl=target_url)
for alert in alerts:
    print(f"[-] Phát hiện lỗi: {alert['alert']} | Mức độ nguy hiểm: {alert['risk']}")