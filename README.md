Dự án Quản lý Đại học (qldaihoc)
Đây là một dự án ứng dụng web được xây dựng bằng Laravel Framework để quản lý các hoạt động cơ bản trong một trường đại học. Ứng dụng cho phép quản lý thông tin về sinh viên, giảng viên, lớp học, môn học và các hoạt động liên quan.

Tính năng chính
Quản lý Sinh viên: Thêm, sửa, xóa, và tìm kiếm thông tin sinh viên.

Quản lý Giảng viên: Quản lý thông tin cá nhân và chuyên môn của giảng viên.

Quản lý Môn học: Tạo và quản lý danh sách các môn học trong chương trình đào tạo.

Quản lý Lớp học: Tổ chức các lớp học, phân công giảng viên và thêm sinh viên vào lớp.

Giao diện người dùng: Giao diện web trực quan để người dùng tương tác.

Cơ sở dữ liệu: Sử dụng Migrations của Laravel để quản lý cấu trúc bảng một cách nhất quán.

Công nghệ sử dụng
Backend: PHP 8.1+, Laravel 10.x

Frontend: HTML, CSS, JavaScript (Sử dụng Blade Template Engine)

Database: MySQL 

Quản lý gói: Composer cho PHP, NPM cho frontend assets.

Hướng dẫn cài đặt
Vui lòng làm theo các bước sau để cài đặt và chạy dự án trên môi trường local.

Yêu cầu:

PHP >= 8.1

Composer

Node.js và NPM

Một web server (ví dụ: XAMPP, Laragon) và một cơ sở dữ liệu (ví dụ: MySQL).

Các bước cài đặt:

Clone repository



git clone https://github.com/thanhtohieu/Quan_ly_dai_hoc
cd qldaihoc
Cài đặt các gói PHP



composer install
Tạo file môi trường (.env) Sao chép file .env.example thành file .env. File này chứa các cấu hình cho dự án.



cp .env.example .env
Tạo khóa ứng dụng (Application Key)



php artisan key:generate
Cấu hình cơ sở dữ liệu Mở file .env và chỉnh sửa các thông tin sau cho phù hợp với môi trường của bạn:

Đoạn mã

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_database_cua_ban
DB_USERNAME=root
DB_PASSWORD=mat_khau_cua_ban
Lưu ý: Bạn cần tạo một database trống với tên đã khai báo ở trên.

Chạy Migrations Lệnh này sẽ tạo các bảng trong cơ sở dữ liệu dựa trên các file migration của bạn.



php artisan migrate
Nếu bạn có Seeder để tạo dữ liệu mẫu, bạn có thể chạy:


php artisan migrate --seed
Cài đặt các gói frontend (Tùy chọn) Nếu dự án của bạn có sử dụng các gói Javascript/CSS.



npm install
npm run dev
Khởi chạy dự án
Để khởi động server phát triển local, chạy lệnh sau:



php artisan serve
Ứng dụng sẽ chạy tại địa chỉ: http://127.0.0.1:8000.