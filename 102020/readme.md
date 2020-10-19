# Tìm hiểu docker-compose (continue)
- Khi làm việc với các project sử dụng docker, có thể có nhiều container như Apache, Mysql, Php, Redis, ... với mỗi các container ta có thể build 1 dockerfile và chạy từng file để start nó.
- Để dùng Docker Compose thì bạn chỉ việc tạo một tập tin có tên là docker-compose.yaml cú pháp nó theo định dạng YAML.
- Nhưng khi sử dụng docker-compose, t có thể gói chúng lại thành một service và cho vào file docker-compose để start 1 lần.
- Một file build với Apache, Mysql, Php sẽ như sau:
```md

version: "3"

services:                         
  apache:                   
    image: "httpd:version2"       
    container_name: c-httpd01     
    restart: always
    hostname: httpd01
    networks:
      - my-network
    ports:
      - "8080:80"                 
      - "443:443"

    volumes:                      
      - host-site:/home/sites/     
  mysql:                      
    image: "mysql:latest"
    container_name: mysql-product
    restart: always
    hostname: mysql01
    networks:
      - my-network
    environment:
      MYSQL_ROOT_PASSWORD: abc123   
    volumes:
      - /mycode/db:/var/lib/mysql  
      - /mycode/db/my.cnf:/etc/mysql/my.cnf  
  php:                          
    image: "php:fpm-7.3"
    container_name: php-product     
    depends_on: c-httpd01
    hostname: php01
    restart: always
    networks:
      - my-network
    volumes:
      - host-site:/home/sites/        

networks:                            
  my-network:
    driver: bridge
volumes:                              
  dir-site:                           
    driver_opts:
      device: /mycode/                
      o: bind
```

+ ```version: '3'``` :Ở đây là phiên bản của docker-compose, mỗi phiên bản sẽ có cách viết khác nhau.
+ ```service: ``` : Mỗi service ứng với một container sẽ chạy trong ứng dụng ( php, mysql, apache ...)
+ ```apache```:
  - Tạo một service webserver để chạy php.
  - ```container_name```: Đặt tên cho container khi chạy
  - ```restart: always```: Tự động khởi động lại container khi nó bị tắt.
  - ```hostname: httpd01``` : Thiết lập host cho nó
  - ```networks```: Sẽ được kết nối vào mạng nào khi runing.
  - ```ports: 8080:80```: Mở port 80 ánh xạ vào port 8080 của máy host.
  - ```volumes: - host-site:/home/sites/```: Ánh xạ thư mục vào container, ở đây ta ánh xạ thư mục /home/sites trong docker ra ngoài thư mục host-sites của máy host
+ ```mysql```:
  - Với các tham số khác thì giống nhau như của apache
  - ```environment: MYSQL_ROOT_PASSWORD: abc123```: Ta thiết lập password cho mysql khi muốn connect vào mysql khi contaner đang running
  - Ngoài ra ở ```volumes```: ta thêm 2 options đó là 
    +  ```/mycode/db:/var/lib/mysql```: Thư mục để lưu data của mysql từ máy host vào docker
    + ``` /mycode/db/my.cnf:/etc/mysql/my.cnf```: Lấy config từ máy host để config cho mysql container.
+ ```networkks```: Để các service ( container ) liên kết với nhau thông qua 1 mạng, ta tạo một mạng cầu với tên là ```my-network```.
+ ```volumes```: Tạo một ổ đĩa để chứa dữ liệu là ```/mycode/```
- Ngoài ra còn có options là ```depend_on```: có nghĩa là phải chờ một service nào đó start rồi mới bắt cđàu chạy

#### Sau khi tạo thành công một file docker-compose ta chạy lệnh như sau :
- ```docker-compose build```: Để build hoặc rebuild các service
- ```docker-compose up```: Chạy lệnh này để start các image thành container 
- Có 4 container đang chạy (mysql-product, c-httpd01, php-product), chúng được nối vào mạng my-network vậy giữa chúng có thể liên lạc với nhau qua cổng tương ứng (3304, 80, 9000). Riêng container có public cổng 8080 ánh xạ vào cổng 80 của nó, vậy bên ngoài mạng có thể kết nối tới nó qua cổng 8080
- Có ổ đĩa dir-site dữ liệu nó lưu tại máy HOST /mycode/, ổ đĩa này cũng nối vào container c-http01 ở thư mục /home/sites. Tương tự nó cũng nối vào php-product
- Container mysql-product cũng ánh xạ thư mục /mycode/db vào /var/lib/mysql
- Nếu muốn edit lại file docker-compose hoặc muốn ngưng tất cả các service xuống, ta chỉ cần chạy lệnh ```docker-compose down```.
- Hoặc ```docker-compose stop``` nếu đang start chúng bằng ```docker-compose up -d```
- Cũng giống như docker file, ta có thể run tất cả các service dưới nền với câu lên ```docker-compose up -d```
- Ngoài ra muốn ngừng container đang chạy trong docker-compose ta dùng ```docker-compose rm```.
- ```docker-compose down --volumes```: Dùng để xóa các container và xóa luôn các data đã được tạo bởi các service chứa data (mysql)
##### Ngoài ra có các options, lệnh khác cũng hay được dùng như sau :
- links: Liên kết php server với mariadb server
```md
 - php
    - links: mysql-product:mysql
```
- Vì là các container đang chạy, nên ta có thể truy cập vào nó giống như docker bình thường : ```docker exec -i -t php-product /bin/bash```
- Hoặc ```docker-compose run php-product php artisan migrate```
- ```docker-compose logs -f container_name```: Xem long của service
- ```docker-compose restart container_name/service name```:Khởi động lại một container với tên service hoặc tên container.
- Hoặc khi ta có 1 dockerfile của php cùng thư mục, ta cũng muốn dùng dockerfile đó thay vì pull image mới từ dockerhub ta dùng như sau :
   ```md
    php:
        build:
            context: .
            dockerfile: Dockerfile-php
   ```
  - Với context là path chỉ tới đường dẫn của dockerfile, ở đây là cùng thư mục docker-compsoe
  - dockerfile : nếu file không phải là tên dockerfile, thì ta sẽ chỉ ra tên cụ thể của file muốn build
- Hoặc muốn chạy các lệnh command khi service được build lên : 
```md
php:
   ...
    command: "php -S 0.0.0.0:8080 -t public"
```