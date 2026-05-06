# Quy trình Chuyển đổi Ảnh sang WebP và Cập nhật Mã nguồn

Tài liệu này hướng dẫn cách chuyển đổi hàng loạt các tệp ảnh (JPG, PNG, JPEG) sang định dạng WebP và cập nhật các tham chiếu trong mã nguồn bằng PowerShell và Node.js (`sharp-cli`).

## 1. Yêu cầu Tiền đề
- **Node.js**: Phải được cài đặt trên hệ thống để chạy `npx`.
- **PowerShell**: Được sử dụng để chạy các câu lệnh lặp và thay thế văn bản.

## 2. Quy trình Thực hiện

### Bước 1: Chuyển đổi Ảnh sang WebP
Sử dụng `npx sharp-cli` để chuyển đổi mà không cần cài đặt thư viện vĩnh viễn. Chạy lệnh này tại thư mục chứa ảnh:

```powershell
# Chạy trong thư mục chứa ảnh
$files = Get-ChildItem | Where-Object { $_.Extension -match '^\.(jpg|jpeg|png)$' }
foreach ($file in $files) { 
    Write-Host "Đang chuyển đổi: $($file.Name)..."
    npx sharp-cli -i $file.FullName -o . --format webp 
}
```

### Bước 2: Cập nhật Tham chiếu trong Mã nguồn
Sau khi có các tệp `.webp`, bạn cần cập nhật các đường dẫn trong tệp HTML/PHP/CSS để website nhận định dạng mới.

```powershell
# Thay thế đường dẫn trong một tệp cụ thể
(Get-Content -Path "đường\dẫn\đến\file.html") -replace 'images/projects/(.*?\.)(jpg|png|jpeg)', 'images/projects/$1webp' | Set-Content -Path "đường\dẫn\đến\file.html"
```

*Lưu ý: Chỉnh sửa Regex `images/projects/` cho phù hợp với cấu trúc thư mục của bạn.*

### Bước 3: Dọn dẹp Tệp gốc
Sau khi kiểm tra website hoạt động ổn định với định dạng WebP, xóa các tệp gốc để tiết kiệm dung lượng:

```powershell
# Xóa các tệp jpg, png, jpeg trong thư mục hiện tại
Get-ChildItem | Where-Object { $_.Extension -match '^\.(jpg|jpeg|png)$' } | Remove-Item -Force
```

## 3. Tại sao nên dùng WebP?
- **Dung lượng nhẹ**: Giảm từ 30% - 80% so với JPG/PNG mà vẫn giữ được chất lượng tốt.
- **Tốc độ**: Giúp website đạt điểm Google PageSpeed cao hơn.
- **Hỗ trợ**: Hầu hết các trình duyệt hiện đại đều hỗ trợ WebP.

---
*Tài liệu được tạo tự động bởi Antigravity AI.*
