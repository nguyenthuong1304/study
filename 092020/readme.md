# Tìm hiểu Docker ( P1 )

## Khái niệm : 
Docker là một công cụ giúp cho việc tạo ra và triển khai các container để phát triển, chạy ứng dụng được dễ dàng. Các container là môi trường, mà ở đó lập trình viên đưa vào các thành phần cần thiết để ứng dụng của họ chạy được, bằng cách đóng gói ứng dụng cùng với container như vậy, nó đảm bảo ứng dụng chạy được và giống nhau ở các máy khác nhau (Linux, Windows, Desktop, Server ...)

### Images và container
- Là những phần mềm được đóng gói và quản lý bởi docker, chỉ tồn tại trong docker. Vd: một image đóng đói phần mềm php, nginx, ubuntu ...
- Các image chỉ có thể đọc không thể sửa đổi
- Khi các image được docker khởi chạy thì phiên bản của các image được gọi là các container và có thể ghi đc dữ liệu vào trong container.
  + docker images : liệt kê ra những các images đang có trong docker, gồm các cột :
    + Repository : Tên của images
    + Tag : Version của images
    + Image ID : Mã hash của Images
    + CREATED : ngày tạo
    + SIZE : size của images
- Các images có sẵn trên https://hub.docker.com dể tìm các images hoặc gõ: 
```docker seach unbuntu```
- Khi muốn sử dụng image nào đó cần có tên image và version ( mặc định sẽ lấy latest ): ```docker pull image:tag```
```
 docker pull ubuntu:16:04 
```
- Nếu không muốn dùng t có thể xóa đi : 
```
docker image rm image:tag  | docker image rm tên_image
``` 

- Chạy image : 
```
docker run tham_số  IMAGE command tham_số_lệnh
```
  + ví dụ : 
  ```
   docker run -i -t ubuntu:latest (hoặc ID_IMAGE)
  ``` 
    + Với -i  là muốn khi chạy sẽ nhận tương tác và kết nối với ternimal là -t ( có thể viết gọn là -it )
- Để thoát 1 container : gõ ```exit```
- Xem các container đang chạy : ```docker ps``` hoặc ```docker ps -a ``` để xem các container đã dừng
- Chạy container đang dừng ```docker start Container_ID``` nhưng đây chỉ đang chạy ngầm, muốn vào lại docker của container đang chạy thì 
dùng ```docker attach CONTAINER_ID```
- Thi hành lệnh trong container khi ở máy host : ```docker exec container_name _lệnh``` vd: 
```
    docker exec -it container_name bash ~ tương đương với docker attach container_name
```
- Muốn thoát container mà vẫn để nó đang chạy thì k dùng ```exit``` mà nhấn tổ hợp ``` Ctrl + P + Q```
- Khi container đang chạy và đứng ngoài máy host và ép nó dừng thì dùng ```docker stop CONTAINER_ID```
- Xóa container : ```docker rm -f NAME_CONTAINER```
- Vd 1 container ta đã cài nhiều package và muốn sử dụng lại cho nhiều dự án, muốn xuất nó ra thành 1 image thì ta làm như sau :
```
docker commit CONTAINER_ID image_name:image_tag
```
thì sẽ có 1 image được lưu, ```docker image``` để kiểm tra, để lưu ra file để dễ sử dụng ta dùng :
```
docker save --output tên_image_xuất tên_file.tar tên_image_trong_docker 
```
và muốn load 1 file từ máy host vào docker ta dùng : 
```
docker load -i ten_image_may_host.tar
```

## Chia sẽ dữ liệu giữa máy host và docker
- Khi các container được chạy, thì các dữ liệu chỉ được tồn tại trong docker và không thể xuất ra ngoài máy host đc, vậy muons chia sẽ dữ liệu giữa máy host và contaier và ngược lại t làm như sau :
    + Gỉa sử có file hello.txt ở đường dẫn  /home/thuong/Desktop
```
docker run -it -v /home/thuong/desktop:/home/docker/hello image_id
```
```/home/thuong/desktop:/home/docker/hello``` có nghĩa là khi container được chạy, docker sẽ ánh xạ từ thư mục ```/home/thuong/desktop``` vảo thư mục ```/home/docker/hello``` của container thì các dữ liệu từ thư mục của máy host sẽ có trong thư mục container mà ta ánh xạ
- Từ câu folder đã ánh xạ trong docker, ta có thể tạo, chỉnh sửa file trong folder này thì ngoài máy host sẽ có cho dù có xóa container thì dữ liệu sẽ k bị mất đi.
- Chia sẽ dữ liệu giữa các container với nhau vd ta có 1 container như sau:
```
docker run -it -v /home/thuong/desktop:/home/docker/hello --name Container1 Image_id
```
container này ánh xạ tới thư mục desktop của máy host và có tên là Container1, Ta tạo 1 container 2 và mong muốn nó đọc đc dữ liệu giống như Container1 thì thiết lập nhanh :
```
docker run -it --name Container2 --volumes-from C1 image_id
```
sau khi chạy xong t kiểm tra thì sẽ có 2 container đang chạy, và kiểm tra thư mục ta sẽ thấy Container2 sẽ ánh xạ với Container1.
- Ngoài cách trên ta cũng có thể chia sẽ dữ liệu bằng cách tạo các volumn, các volumn này không bị xóa khi ta dừng container trừ khi t cố tình xóa nó đi
- Để kiểm tra các volumn đang có ta dùng ```docker volumn ls```
- Tạo volumn ```docker create D1``` -> sẽ tạo ra một ổ đĩa D1 và muốn kiểm tra nó t dùng lênhj ```docker volumn inspect tên_volumn ```, Xóa volumn ta dùng ```docker volumn rm ten_volumn```
- Khi mà ta muốn container lưu dữ liệu cố định vào column này, ta làm như sau:
  + Đầu tiên: ta chạy 1 container
```
 docker run -it --name Container1 --mount source=D1,target=/home/disk image_ID
```
lệnh này dùng để : chạy 1 container và ổ đĩa D1 ánh xạ vào thư mục ```/home/disk``` của container đó, tất cả các dữ liệu sẽ được ghi vào volumn D1
- Hoặc ta muốn tạo 1 volumn và muốn nó ánh xạ đến thư mục nào đó của máy host ta làm như sau :
```
docker volumn create --opt device=/home/thuong/Desktop/ --opt type=none --opt o=bind NAME_DISK
```
khi inspect volumn ```NAME_DISK``` ra ta sẽ thấy options 
```json
"Options" : {
    "device": "/home/thuong/desktop/",
    "o": "bind",
    "type": "none"
}
```
đối với loại này, khi ta muốn gán cho container ta sẽ sử dụng lệnh như sau :
```
docker run -it -v VOLUMN_NAME:PATH_CONTAINER IMAGE_ID
```
## Network
- Docker tạo các network để khi nhiều container có thể liên kết mạng với nhau dễ dàng chia sẽ với nhau hơn, kiểm tra network```docker network ls```
  + Mặc định khi cài docker sẽ có 3 mạng với driver là : ```bridge, host null```, mặc định các container khi chạy sẽ kết nối vào mạng bridge
  + Để check network t gõ ```docker network ínpect bridge``` kéo xuống ta sẽ thấy option```"Containers": {}``` có nghĩa là k có container nào kết nối vào
- Khi ta tạo 2 container mà không chỉ rõ network, nó sẽ cùng connect vào network bridge, và sẽ mỗi container sẽ được cấp 1 IP khác nhau và kết nối với nhau
- Để biết các container đã connect với nhau chưa, ta chỉ cần ping địa chỉ IP từ container này đến container kia sẽ rõ, và để 1 container chạy được trên máy host với cổng 80 ta làm như sau :
```
    docker run -it --name Con2 -p 8888:80 IMAGE_ID
```
   + -p 8888:80 có nghĩa là cổng 8888 của máy host sẽ ánh xạ vào cổng 80 của container ```0.0.0.0:8888->80/tcp```
   + Để thử nghiệm ta cần vào container Con2 vào thư mục /www/ và mở httpd và tạo 1 file index.html với nội dung gì đó, sau đó khi chayjh localhost:8888(127.0.0.1:8888) ở máy host ta sẽ thấy nội dung file html được hiển thị
- Để tạo network, trong trường hợp ta không muốn các container đều connect đến mạng cố định :
```
docker network create --driver bridge network_name / docker network rm network_name
```
- Để chạy container và chỉ rỏ network connect : 
```
docker run -it --name container_name --network network_name image_id
```
- Thiết lập container kết nối vào network khi đang chạy ```dovker network connect network_name```
## DEMO
- Pull 1 image xuống từ hub.docker : 7.3-fpm
```
docker pull php:7.3-fpm
```
- Tạo ra một network bridge tên là www-net:
```
docker network create --driver bridge www-net
```
- Tạo một thư mục để container chia sẽ dữ liệu ```/home/thuong/desktop/my-code/www/```
- Tạo container từ image: 
```
docker run -d --name c-php -h php -v /home/thuong/desktop/my-code/www/:/home/my-code/ --network www-net php:7.3-fpm
```
- Như vậy sẽ tạo được 1 container chạy php và connect vào network ```php:7.3-fpm``` và ánh xạ vào thư mục ```/home/thuong/desktop/my-code/www/``` của máy host
- Pull httpd: ```docker pull httpd:latest``` và run nó
```
docker run --network www-net --name c-httpd -h httpd -p 9999:80 -p 443:443 -v /my-code/:/home/my-code/
```
Như vậy ta đã chạy được php trên webserver apache của httpd
### Part2 : sẽ là tìm hiểu build ứng dụng với dockerfile và quản lý nhiều container với docker-compose 