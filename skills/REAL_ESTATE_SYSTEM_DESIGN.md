# Yêu cầu phát triển Custom Gutenberg Block

## 1. Thông tin chung
- **Tên Block (Title):** Danh sách bất động sản
- **Slug (ID):**  lth-real-estate
- **Icon:** 
- **Mô tả ngắn gọn mục đích:** Block hiển thị danh sách bất động sản đang bán
- **Plugin sử dụng:** Lazy Blocks

---

## PHẦN A: QUẢN TRỊ DỮ LIỆU (BACKEND PLUGIN)
*Để độc lập với Theme và dễ bảo trì, phần dữ liệu sẽ được viết thành một Plugin riêng biệt (Ví dụ: `stnd-real-estate`).*

### 2. Thông tin Plugin
- **Tên Plugin:** LTH Real Estate Manager
- **Mục đích:** Khởi tạo cấu trúc dữ liệu Bất động sản và các form nhập liệu trong wp-admin.
- **Thư mục Plugin:** `/wp-content/plugins/lth-real-estate/`

### 3. Cấu trúc Custom Post Type (CPT) & Taxonomy (Danh mục)
*Dữ liệu sẽ lưu qua bảng `wp_posts` với tham số `post_type` tương ứng.*
- **Tên Post Type 1:** Bất động sản (Slug: `real_estate`). Cần kích hoạt tham số `has_archive`, `supports` (title, editor, thumbnail, excerpt, author).

- **Danh mục (Custom Taxonomy - Áp dụng cho BĐS):** 
  - Loại hình (Slug: `property-type`) -> Phân cấp giống Category (Hierarchical = true).
  - Vị trí/Khu vực (Slug: `property-location`) -> Taxonomy phân cấp nhiều tầng (Cha/Con).
  - Dự án (Slug: `project`) -> Hoạt động giống hệt Danh mục Loại hình (Phân cấp = true). Giúp Admin dễ dàng quản lý phân loại và click tickbox Dự án ngay trên màn hình đăng BĐS.

### 4. Tái sử dụng các trường cốt lõi của WordPress (`wp_posts`)
Nhằm tối ưu hóa hiệu suất cơ sở dữ liệu và giao diện, hệ thống sẽ dùng các tính năng có sẵn của bài viết:
- **Trạng thái (Status):** Sử dụng trực tiếp quy trình kiểm duyệt bài viết (`post_status`) thay vì dùng bảng phụ. VD: `publish` (Đang bán), đăng ký thêm custom post status `sold` (Đã bán), `draft` (Bản nháp/Chờ duyệt).
- **Hình ảnh đại diện:** Dùng **Featured Image** (Ảnh đại diện của Post) thay vì tạo input rườm rà.
- **Tiêu đề & Mô tả:** Trực tiếp viết vào `post_title` và khung soạn thảo Editor mặc định `post_content`.

### 5. Cấu trúc Custom Meta Boxes (Lưu vào wp_postmeta)
*Thêm Meta Box trong Plugin để lưu các trường đặc tả của BĐS theo đúng sơ đồ CSDL.*

**A. Liên kết dữ liệu (Relationships):**
*(Tính năng này đã được WP xử lý Native thông qua bảng phân loại Taxonomy, không cần dùng Custom Meta Box nữa).*

**B. Thông tin giá & diện tích:**
- `price` (Number - Decimal): Giá trị (để query/sort).
- `currency` (Text): Đơn vị tiền tệ (VND, Tỷ).
- `area` (Number - Decimal): Diện tích sử dụng (m2).
- `address_street` (Text): Số nhà, tên ngõ/đường cụ thể.

**C. Thông số kỹ thuật BĐS:**
- `num_bedrooms` (Number): Số phòng ngủ.
- `num_bathrooms` (Number): Số phòng tắm.
- `num_floors` (Number): Số tầng.
- `house_direction` (Select - Enum): Hướng nhà (Đông, Tây...).
- `balcony_direction` (Select - Enum): Hướng ban công.
- `entrance_width_m` (Number - Decimal): Rộng mặt ngõ/đường (m).
- `frontage_width_m` (Number - Decimal): Chiều rộng mặt tiền (m).

**D. Pháp lý & Khác:**
- `legal_paper_status` (Select - Enum): Tình trạng pháp lý (Sổ đỏ, Sổ hồng...).
- `furniture_status` (Select - Enum): Nội thất (Cơ bản, Đầy đủ...).
- `video_url` (Text - URL): Link video BĐS.
- `expires_at` (Date Picker): Ngày hết hạn tin rao (nếu có).
- `property_gallery` (Text/Array): **Khắc phục hạn chế 1 ảnh của WordPress**. Chúng ta tạo trường Meta đặc biệt này để lưu trữ chuỗi ID của hàng loạt bức ảnh, dùng cho slide show chi tiết BĐS.

### 6. Yêu cầu hiển thị Admin Menu & UI
- **Cấu trúc Menu (Sidebar Trái wp-admin):**
  - Tất cả các thành phần phải được nhóm vào chung một Menu chính mang tên **"LTH Real Estate Manager"**. Menu này có icon riêng (ví dụ icon tòa nhà `dashicons-building`).
  - Các Submenu con xổ xuống sẽ được sắp xếp theo đúng thứ tự:
    1. **Tất cả Bất động sản** (Link quản lý danh sách CPT `real_estate`).
    2. **Danh mục Loại hình** (Quản lý Taxonomy `property-type`).
    3. **Danh mục dự án** (Quản lý Taxonomy `project`).
    4. **Danh mục vị trí** (Quản lý Taxonomy `property-location`, phân cấp cha con: Tỉnh/Thành -> Quận/Huyện -> Xã/Phường).
- **Bố cục bảng danh sách "Tất cả BĐS" (Admin List Table):** Bố trí các cột hiển thị theo thiết kế trực quan ngay khi vào menu:
  - Cột 1: `[Checkbox]` (Mặc định để thao tác hàng loạt).
  - Cột 2: `Hình ảnh` (Hiển thị một khung ảnh vuông nhỏ khoảng 60x60px rút từ Ảnh đại diện để dể nhận biết).
  - Cột 3: `Tiêu đề BĐS` (Tên bài đăng kèm các nút tuỳ chọn nhanh như Chỉnh sửa / Xóa / Xem ở dưới).
  - Cột 4: `Thông số chính` (Gộp nhanh 2 trường: Hiển thị Định dạng dạng `<Giá> / <Diện tích>`).
  - Cột 5: `Thuộc Dự án` (In tags của Taxonomy `project`).
  - Cột 6: `Phân loại` (Gộp hiển thị Loại hình BĐS và Vị trí để tiết kiệm không gian).
  - Cột 7: `Tình trạng` (Hiển thị một Label màu tuỳ thuộc vào `post_status`: Publish, Draft, Sold).
  - Cột 8: `Thời gian` (Ngày đăng / cập nhật - Mặc định WP).
- **Thanh công cụ Lọc (Admin Filters) ở trên cùng:**
  - Kế bên nút Lọc Ngày tháng mặc định, thêm 3 thanh Dropdown để lọc tức thời danh sách theo: **Chọn Loại hình**, **Chọn Vị trí**, và **Chọn Dự án**.
  - Trạng thái bài viết sẽ hiển thị bằng các hàng chữ dạng danh sách ở ngay cụm trên đầu bảng: **Tất cả (13) | Của tôi (5) | Đã xuất bản (11) | Nháp (2)**. Trong đó mục "Của tôi" dùng để lọc nhanh những bài BĐS được tạo bởi chính tài khoản đang đăng nhập hiện tại.
- **Bố cục màn hình "Danh mục Loại hình" (Taxonomy Editor):** Bố trí chuẩn layout 2 cột giống với hiển thị Taxonomy mặc định trong WordPress.
  - **Cột Trái (Thêm Danh Mục):** Chỉ sử dụng các trường input cơ bản: Tên, Đường dẫn, Danh mục cha, Mô tả. (Không cần trường tải ảnh).
  - **Cột Phải (Bảng danh sách Taxonomy):** Table list hiển thị các cột: `[Checkbox]` | `Tên` | `Mô tả` | `Đường dẫn` | `Lượt` (Đếm số lượng BĐS đang được gán Loại hình này).
- **Bố cục màn hình "Danh mục dự án" (Taxonomy Editor):** Bố trí chuẩn layout 2 cột giống hệt với luồng thiết kế của Danh mục Loại hình nhưng có tuỳ chỉnh riêng về hình ảnh.
  - **Cột Trái (Thêm Danh Mục):** Cung cấp các ô nhập liệu: Tên, Đường dẫn, Danh mục cha, Mô tả. *Đặc biệt: Code thêm Custom Field (Term Meta) "Tải ảnh lên" dưới cùng hỗ trợ uploader cho phép gán Ảnh đại diện cho mỗi dự án.*
  - **Cột Phải (Bảng Danh mục):** Mở rộng Table list hiển thị: `[Checkbox]` | `Ảnh đại diện` | `Tên` | `Mô tả` | `Đường dẫn` | `Lượt` (Đếm số BĐS đang thuộc dự án).
- **Bố cục màn hình "Danh mục Vị trí" (Taxonomy Editor):** Đây là phân cấp địa lý (Tỉnh/Thành -> Quận/Huyện -> Phường/Xã), nó hoạt động giống hệt chức năng Chuyên mục (Category) của WP.
  - **Cột Trái (Thêm Vị Trí Mới):** Quản lý qua các trường mặc định: `Tên vị trí` (VD: "Đa Kao"), `Đường dẫn`, `Danh mục cha` (VD: Chọn "Quận 1" làm cha của Đa Kao). Móc thêm 1 custom field dạng text là **Mã hành chính (Code)** (Như đã thiết kế ở ERD cũ bảng provinces `code` dạng varchar).
  - **Cột Phải (Bảng Danh mục):** Hiển thị dạng phân cấp cha con: `[Checkbox]` | `Tên Vị trí` (Thò thụt bằng gạch ngang `— Quận 1`) | `Mã` (Code hành chính) | `Đường dẫn` | `Lượt` (Đếm số BĐS thuộc phường/quận này).

### 7. Giao diện Thêm mới / Chỉnh sửa Bất động sản (Backend Editor UI)
*Theo đúng thiết kế mẫu đưa ra, để tạo trải nghiệm quản lý quen thuộc, dể dùng và native, toàn bộ trang Edit Post sẽ tái sử dụng các components (Gutenberg) chuẩn.*

**A. Khu vực Soạn thảo Chính (Main Canvas):** Mặc định của WordPress.
- **Tiêu đề:** Dùng thẳng khung h1 to nhất (`Thêm tiêu đề` -> Lên `post_title`). VD: "Bán nhà Quận 1".
- **Nội dung / Mô tả chi tiết:**Sử dụng khối Block Editor chính giữa để cho Admin tự do chèn đoạn văn, thư viện ảnh, video review một cách linh hoạt, tạo dữ liệu rich-text cho `post_content`.

**B. Thanh Sidebar Cài đặt (Bên phải):** Chứa các panel thiết lập hệ thống chuẩn.
- Panel **Trạng thái (Status/Visibility):** Mở ra để chọn Tác giả (`post_author`), Thời gian và Tự lưu Tình trạng (`post_status`).
- Panel **Danh mục Loại hình / Vị trí:** Do chúng ta đã đăng ký Hierarchical Taxonomy ở trên, tab Cài đặt bài viết đã tự động sinh ra UI ô Tickbox chọn danh mục cực kỳ xịn (Giống hoàn toàn box Ngành nghề/Nơi làm việc ở trong ảnh mẫu).
- Panel **Ảnh đại diện (Featured Image):** Dành riêng để setting 1 hình ảnh làm Thumbnail cover mặt ngoài.

**C. Khu vực Khai báo Thông số BĐS (Custom Meta Boxes):**
- Những dữ liệu kiểu gõ Text, chọn List mà ta định nghĩa ở Mục Số 5 (Bao gồm Giá, Diện tích...) thay vì nhồi vào Sidebar -> Sẽ được thiết kế hiển thị dạng Form lớn bọc khung màu trắng chuẩn Native CSS của WordPress, **đặt gọn gàng bên dưới khung soạn thảo lớn Main Canvas**.
- **Giải pháp cho Thư viện nhiều ảnh (Gallery):** Để bổ trợ cho 1 Ảnh đại diện duy nhất mặc định, trong khu vực Meta Box dưới cùng ta sẽ code thêm một block "Thư viện ảnh (Gallery)". Khi admin bấm "Thêm ảnh", nó sẽ gọi cửa sổ **WP Media Library** gốc của WordPress lền, cho phép Shift+Click chọn hàng chục ảnh cùng lúc. List ảnh này sẽ show grid nhỏ ngay trong trang edit để admin kéo thả đổi vị trí.
- Trải nghiệm Admin sẽ là: *Gõ Tên -> Gõ Mô tả dài -> Cuộn xuống điền Thông số kỹ thuật & Up nhiều ảnh Gallery nội thất căn nhà -> Chọn Vị trí & Ảnh đại diện Cover ở cột phải -> Xuất bản.*

---

## PHẦN B: BLOCK HIỂN THỊ (FRONTEND / LAZY BLOCKS)
*Đây là phần setting cho Block sẽ được kéo thả ra trang chủ để hiển thị danh sách BĐS dựa trên bộ thiết kế bạn gửi.*

### 8. Cấu hình Block Attributes (Thuộc tính cài đặt cho Block)
*Admin tùy biến Block mà không phải sửa code:*
- `subtitle` (Text): "DANH MỤC BĐS"
- `title` (Text): Tiêu đề chính "Bất Động Sản Nhà Mặt Phố"
- `locations` (Select Multiple): Chọn các Vị trí/Quận huyện hiển thị ra thanh Tab (Đống Đa, Long Biên, Hoàn Kiếm...).
- `post_number` (Number): Giới hạn số lượng bài đăng (Mặc định: 10).

### 9. Cấu trúc Giao diện Frontend (Layout Design)
*Mô tả cách lấy dữ liệu từ DB (Phần A) lắp mảnh ghép vào bản vẽ UI (Frontend):*

**A. Khu vực Tiêu đề & Công cụ (Header & Toolbar):**
- **Tiêu đề & Filter Tabs:** Label nhỏ màu vàng nhạt, Title chính in đậm ngang hàng với viền trái. Phía dưới là nhóm nút Tabs chức năng phân loại Location (Taxonomy `property-location` - Bấm vào sẽ lọc ra BĐS thuộc Đống Đa, Long Biên...).
- **Thanh Quản lý (Action Bar):** 
  - Bên trái: Hiển thị tự động bộ đếm "Có `<Count>` bất động sản".
  - Bên phải: Khu vực Icon Switcher chuyển đổi góc nhìn (Dạng Lưới `Grid` hoặc Dạng Danh sách ngang `List`) và một ô Dropdown "Sắp xếp: Mới nhất...".

**B. Khối thẻ Bất động sản (Property Card - Map với CPT `real_estate`):**
Cấu trúc Thẻ ở dạng danh sách (List Mode) chia 2 vế rõ ràng:
- **Khối Ảnh - Left Thumbnail (30%):** 
  - Render `Featured Image` của bài đăng cực lớn, bo góc.
  - Góc trái trên cùng: Badge Label nền xanh "Mới nhất".
  - Góc phải dưới cùng (nổi lên trên ảnh): Nút nền đen chữ trắng "Xem chi tiết >".
- **Khối Thông tin - Right Content (70%):**
  - **Tag phân loại:** Rút từ Taxonomy `property-type` (VD: "Nhà mặt phố"), thiết kế dạng box viền xám tròn góc.
  - **Tiêu đề:** Rút từ `post_title` in đậm lớn (Bán nhà phố Hoàng Như Tiếp...).
  - **Dòng thông tin nhỏ:** `[Icon Vị trí]` + Taxonomy `property-location` (Long Biên, Hà Nội) | `[Icon Lịch]` + `post_date` (19/07/2025).
  - **Block 4 Icon Kỹ thuật:** Trích xuất vòng lặp lấy Custom Metas: 
    - `[Icon Mặt tiền]` + Trường `<frontage_width_m>`m.
    - `[Icon Mở Rộng]` + Trường `<area>`m2.
    - `[Icon Cầu Thang]` + Trường `<num_floors>` tầng.
    - `[Icon Pháp Lý]` + Trường `<legal_paper_status>` (Sổ đỏ).
  - **Dòng Footer:** `Giá: <price_formatted>` với phần text mệnh giá in màu đỏ nổi bật. Phía ngoài cùng bên phải là nút CTA bo tròn lớn viền vàng "Gọi ngay".




