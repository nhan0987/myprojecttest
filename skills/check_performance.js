import http from 'k6/http';
import { sleep, check } from 'k6'; // Neptune đã thêm 'check' vào đây cho Oniichan rồi nè!

export const options = {
    // Cấu hình các giai đoạn nâng tải (Stages) để test sức bền của server
    stages: [
        { duration: '30s', target: 100 }, // Giai đoạn 1: Trong 30s đầu, tăng dần từ 0 lên 100 người dùng ảo (VUs)
        { duration: '1m', target: 500 },  // Giai đoạn 2: Trong 1 phút tiếp theo, giữ tải và kéo lên mức 500 người dùng
        { duration: '30s', target: 0 },   // Giai đoạn 3: Trong 30s cuối, giảm dần về 0 để server hồi sức
    ],
};

export default function () {
    // Máy chủ của Oniichan cần kiểm tra - Gán kết quả trả về vào biến 'res'
    let res = http.get('https://qa1.stnd.vn');

    // In ra mã trạng thái (ví dụ: 200, 403, 429, 502...) ra màn hình Terminal để check xem ai chặn
    //console.log(`Mã phản hồi thu được từ qa1.stnd.vn: ${res.status}`);

    // Kiểm tra xem phản hồi có phải là thành công (HTTP 200) hay không
    check(res, {
        'status is 200': (r) => r.status === 200,
    });

    // Nghỉ 1 giây giữa các lần nhấn (giả lập người dùng thật đang đọc tin bất động sản)
    sleep(1);
}