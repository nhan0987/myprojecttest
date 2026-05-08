import http from 'k6/http';
import { sleep } from 'k6';

export const options = {
    // Cấu hình các giai đoạn nâng tải (Stages)
    stages: [
        { duration: '30s', target: 100 }, // Trong 30s đầu, tăng dần lên 100 người dùng
        { duration: '1m', target: 500 }, // Trong 1 phút tiếp theo, kéo lên hẳn 5000 người
        { duration: '30s', target: 0 },    // Sau đó giảm dần về 0 để server "thở"
    ],
};

export default function () {
    // Máy chủ của Oniichan cần kiểm tra
    http.get('https://stnd.vn//');

    // Nghỉ 1 giây giữa các lần nhấn (giả lập người dùng thật)
    sleep(1);
}