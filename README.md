Chú ý cần phải thực hiện theo hướng dẫn sau, ngay khi clone project về máy
==========================================================================
### **Phần 1: Cài đặt Composer**

    Tác dụng của Composer dùng để quản lý các Dependencies trong Laravel
1. _Yêu cầu máy phải cài sẵn composer, để cài composer tải tại địa chỉ: [https://getcomposer.org/Composer-Setup.exe](Composer)_

2. Cài đặt Laravel Installer: 
    `composer global require "laravel/installer"`
    
### **Phần 2: Cấu hình Laravel ban đầu**
1. Đầu tiên sau khi clone prject về thì cần phải chạy lệnh sau tại thư mục gốc của Project:

```sh
    composer install
```		
2. Mở thư mục gốc của project, tạo file **.env** với nội dung giống với **.env.example** đồng thời sửa lại cấu hình đến cơ sở dữ liệu và email trong file .env. Sau đó chạy lệnh sau để tạo một key mã hóa.
```sh
    php artisan key:generate
```	

3. Để sinh ra các bảng trong cơ sở dữ liệu, ta chạy lệnh sau với yêu cầu đã sửa lại file **.env** theo yêu cầu
```sh
	php artisan migrate -seed
```	
4.	Trong đường dẫn config/mail.php là vị trí để ta cấu hình gửi mail
#####	Chạy lệnh:
```sh
	php artisan vendor:publish 
```		
để publish filemanager
5.	Khởi động server Laravel 
    chạy lệnh: 
```sh
	php artisan serve --host 0.0.0.0
```		
đợi một vài giây giờ ta mở trình duyệt tại [localhost](http://localhost:8000/)

### **Phần 3: Hướng dẫn cài Sass**

1. Cài đặt NodeJS
    Để có thể sử dụng Sass ta cần phải cài NodeJS. Kiểm tra xem máy đã có NodeJS chưa check thử:
    `node -v`
    Nếu chưa có NodeJS hãy truy cập vào [NodeJS](https://nodejs.org/en/download/) lựa chọn phiên bản phù hợp với máy
    
2. Cài đặt Gulp Package 
    Để cài đặt Gulp Package Global
    `npm install --global gulp`
    Chờ một thời gian nó sẽ tải các package cần thiết và cài đặt
    
3. Cài Laravel Elixir
    Tại thư mục gốc của Project mở Command Line thực thi lệnh:
    `npm install`
    
4. Chạy Sass compile ngay tại thư mục gốc của project
    `gulp`
    Mọi công việc sẽ tự động diễn ra
    Để minify CSS:
    `gulp --production`


### **Phần 4: Installer plugin support Socials
composer require laravel/socialite

## **Phần 5: Sửa ID và Secret của facebook

1. Bạn phải tạo tài khoản developer facebook tại (developer.facebook.com)

2. Tạo một ứng dựng mới (là trang web)

  - Đặt tên ứng dụng
  - Điền email
  - Chọn loại ứng dụng
  - Điền đường link URL : (http://localhost:8000) - link tới project

3. Chọn :  Skip to Developer Dashboard

4. Thay App ID và App Secret vào file service.php (/config/service.php) ở hai mục client_id và client_secret

### **Phần 6: How to fix error (PHP cURL error code 60) ?

1. Create file have content form (https://curl.haxx.se/ca/cacert.pem)


 File name is (cacert.pem)
 This file is located in C:/xampp/php/ext

2. Open file php.ini (in xampp, .. )

*** Insert at the end of file
    
curl.cainfo = "path_to_cert\cacert.pem"
Note : [path_to_cert]. It is path to cacert.pem.


### **Phần 7: Permission

1. Update lại composer.json
    `composer update`
    
2. Sửa lại file .env 
   `CACHE_DRIVER=file` sửa thành `CACHE_DRIVER=array`
   
3. Làm mới cơ sở dữ liệu
    * Xóa cơ sở dữ liệu cũ trong máy
    `php artisan migrate:reset`
    
    * Chạy lại migrate cơ sở dữ liệu
    `php artisan migrate`
    
    * Seed cơ sơ sở dữ liệu mẫu
    `php artisan db:seed`
    --class class_name
    
4. Xóa Cache
    `php artisan config:cache`
    `php artisan route:clear`
    `php artisan cache:clear`
    
5. Nếu có lỗi: Laravel Collective - Class 'Form' not found
   [Here](https://laracasts.com/discuss/channels/laravel/laravel-collective-class-form-not-found?page=1)
   
6. Hướng dẫn cơ bản về hệ thống phân quyền: Sample Entrust roles
   [Here](https://laracasts.com/discuss/channels/general-discussion/apply-entrust-roles-to-users-using-the-controller)