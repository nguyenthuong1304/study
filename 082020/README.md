# Learning Nuxt.js
### This monthly 
**NuxtJS là một framework của Vuejs giúp chúng ta hoạt động theo với cơ chế SSR, giúp tối ưu hóa cho SEO**
##Routing
- Khi làm việc với nuxt sẽ không làm việc với file router như ở Vue, mà nó nằm trong thư mục pages của project
- Định nghĩa một file, sẽ tương ứng với một page của dự án
- Vd :
```
- Cách đặt tên bình thường
pages/
--| user/
-----| index.vue 127.0.0.1:3000/user
-----| _id.vue -> 127.0.0.1:3000/user/1
--| index.vue -> 127.0.0.1:3000

Đặt tên route là folder mà chứa index vue file
--| category/
----| index.vue -> 127.0.0.1:3000/category
------| _id/
--------| index.vue -> 127.0.0.1:3000/category/1
--------| products/
----------| index.vue -> 127.0.0.1:3000/category/1/products
----------| _id/
------------| index.vue -> 127.0.0.1:3000/category/1/products/1
```
- Nó sẽ tự động generate ra route đúng với folder và file đã khai báo với name route là folder hoặc tên file
##Views
### Layouts
- Mặc định mọi layout nuxt project được apply từ layouts/default.vue
```js
// layout/default.vue
<template>
  <nuxt /> // mọi page sẽ được render vào đây
</template>
// nếu muốn sử dụng 1 layout khác cho page khác chỉ cần tạo thêm layout ở folder layouts
// và ở mỗi file trong pages/ chỉ cần khai báo
<script>
  export default {
    layout: 'tên_layout'
  }
</script>
```
- Định nghĩa page error khi có lỗi, ta sẽ tạo layouts/error.vue mặc định nó luôn nhận props là error
```js
props: ['error'],
layout: 'layout_name_or_default'
// từ đây ta có thể check xem loại lỗi của nó
```
### Page:
- Một page của nuxt thường có cấu trúc giống như Vue nhưng sẽ có thêm các method sau:
```js
<template>
  <h1 class="red">Hello {{ name }}!</h1>
</template>

<script>
  export default {
    asyncData (context) {
    },
    fetch () {
    },
    validate() {
    },
    head () {
    },
    middleware: 'name',
    ...
  }
</script>

<style>
  .red {
    color: red;
  }
</style>
```
###asyncData(context)
- Nếu một get một cái gì đó từ server trước khi trang đó được tải lên
- Nó sẽ được gọi 1 lần từ phía server, và khi phía client điều hướng tới route khác.
- Tất cả data return sẽ được merged thành data của components đó.
- Được dùng khi muốn get data từ phía server và hiển thị ra luôn components ko lưu vào store
- Trả về một promise
```js
const { 
    app, // -> Các Vue instance, bao gồm cả tất cả các plugin ứng dụng
    //  context.app.i18n
    store, // -> Vuex, nó sẽ setup nếu như vuex store được set trước đó
    route, // route instance, từ đây ta có thể tùy cập đến các thành phần của route
    params, // là một alias của route.params, sẽ các tham số _id, ... của page
    query, // là một alias của route.query, sẽ các query string
    env, // biến môi trường
    isDev, // check môi trường dev 
    isHMR,
    redirect, // dùng để redirect đến một page khác
    error, // sử dụng method này để show looix, error({ statusCode: 404, message: "Not found" });
    $config // tất cả các config runtime nuxt.config
} = context
```
```js
  asyncData(context) {
    return axios.get('api...').then(res => {
      return { title: res.data.title }
    })
  }
```
- Sử dụng async/await
```js
  async asyncData(context) {
    const { data } = await axios.get('api...')
    return { title: data.title }
  }
```
### fetch(context)
- Tương tự như asyncData nhưng mục đích là lấy dữ liệu từ api và cập nhập vào lại trong store của ứng dụng, từ đó mới lấy dữ liệu từ store ra dùng, hàm này không trả về dữ liệu.
### validate(context)
- trong hàm này sẽ return về giá trị boolean, nếu true thì render page, ngược lại dừng app và hiển thị error page
```js
  validate({ params }) {
    // phải là một số
    return /^\d+$/.test(params.id)
  }
```
### head()
- Sẽ return các giá trị trong `<head></head>` của html, vd như title, meta,desciption ...
### middleware
- Sẽ nhận apply middleware được khai báo vào page, nhận vào 1 mảng hoặc có thể sử dụng như một hàm
```js
middleware: ['auth', 'admin']
```
# Middleware
- Được tạo trong thư mục middleware/
- middleware(context) cũng nhận vào context, từ đó có thể check điều kiện.
```js
// khai báo trong nuxt.config.js, sẽ được gọi đến tất cả các route
router: {
    middleware: 'name'
}
// khai báo trong page chỉ định trong folder pages/
middleware: ['name'],
// Hoặc cùng có thể sd như một hàm
middleware({ store, redirect }) {
  if (!store.state.auth.authenticated) {
    return redirect('/login')
  }
}
```
# Plugin
- Nằm trong thư mục plugins/, chứa các code js mà mình muốn nó chạy trước instance Vue
- Để sử dụng t có 3 cách,
  + Inject vào $root & context của vue, context ở đây bao gồm app, store, ...
  ```js
  // plugins/plugin.js
  export default (context, inject) {
    inject('myPlugin', msg => console.log(msg))
  }
  // Để truy cập vào my_plugin t làm như sau:
  // client-side: this.$myPlugin('mouted, created')
  // server-side: $myPlugin('asyncData, fetch')
  ```
  + Sử dụng Plugin vào Nuxt app:
  ```js
    // plugin/i18n.js
    import Vue from 'vue';
    import VueI18n from 'vue-i18n';
    Vue.use(VueI18n)
    export default ({ app, store }) => {
        app.i18n = new VueI18n({
            ...
        })
    }
  ```
  + Sử dụng các package modules bên ngoài vào nuxt app:
  ```js
    // plugins/axios.js
    export default ({ $axios, redirect}) => {
      $axios.onError(err => {
          if (err.response.status === 404) redirect('/sorry'); 
      })
    }  
  ```
  - Cả những cách trên đều phải cần khai báo trong nuxt.config.js để nó đảm bảo được load
  - Có 2 cách để khai báo:
  ```js
    export default {
      // khai báo kiểu array strings
      plugins: [
        '~/plugins/foo.client.js', // load duy nhất ở phía client
        '~/plugins/bar.server.js', // load duy nhất ở phía server
        '~/plugins/baz.js' // load cả phía server và client
      ],
     // khai báo kiểu array object
      plugins: [
        { src: '~/plugins/both-sides.js' }, // load cả phía server và client
        { src: '~/plugins/client-only.js', mode: 'client' }, // load duy nhất ở phía client
        { src: '~/plugins/server-only.js', mode: 'server' }  // load duy nhất ở phía server
      ],
    ```