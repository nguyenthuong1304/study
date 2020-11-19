# Learning React p.1 (Làm quen với React)

React đang nhanh chóng trở thành bộ thư viện JavaScript phổ biến giúp xây dựng các UI component viết bằng HTML, CSS và JavaScript. So sánh với một số lượng không ít các thư viện và framework JavaScript hiện nay thì React nổi trội ở tính đơn giản và hiệu quả và thích hợp để build các ứng dụng UI phức tạp. Thư viện React được phát triển bởi các lập trình viên làm việc tại Facebook với mục đích cải tiến các UI component sử dụng trên trang mạng xã hội Facebook và trang web Instagram.

## Install :
 Tạo một dự án với : npx create-react-app reactjs-learning
- Sau khi install xong, ta chú ý đến file src/App.js, src/index.js và public/index.html

```html
// index.html
<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
  </body>
```
- Sẽ có một div có id là root, div này dùng để các code js khi được build ra sẽ render tại đây
```jsx
// App.js
...

export default function App() {
  return (
    <div className="App">
      <header className="App-header">
        ...
      </header>
    </div>
  );
}
```
- Đây được gọi là 1 component, bên trong mỗi component, bạn có thể định nghĩa các hàm thực hiện các nhiệm vụ riêng trong component đó.
- Vd App() return về 1 đoạn html mà trong react gọi là đó JSX, đoạn mã này sẽ được biên dịch thành một đoạn mã html bình thường, giúp ta nhìn thấy được trên trình duyệt. Cách này gọi là functional components
hoặc: 
```jsx
import React from 'react';
export default class App extends React.Component {
    ...
}
``` 
- Thông thường người ta hay sử dụng functional component hơn, vì cú pháp của nó khá ngắn gọn, và còn được dùng với React Hook
```js
// index.js
import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
);
reportWebVitals();
```
- File này được khai báo các thư viện chính, và có nhiệm vụ là render mọi thứ được build ra vào element có id là root
## Component:
- Một component sẽ giải quyết một vấn đề, nghiệp vụ, layout ... nào đó của trang web,
Ví dụ :
```jsx
import ...;

export default class SideBar extends React.Component {
    constructor() {
        super();
        this.state = {
            isToggled = false;
        }
    }

    return (
        <div>
            <div className="sidebar"></div>
        </div>
    );
}
```
- ```class SideBar extends React.Component```, đây là syntax cơ bản khi khởi tạo 1 component và kế thừa component của React. điều này có thể giải thích là tất cả các attributes có trong React.Component thì trong Sidebar ta có thể mở rộng chúng ra.
- ```Constructor``` Phương thức này gọi để mở rộng component là phương thức khởi tạo cho một component trước khi nó được mount, khi thi triển các component kế thừa từ React.Component ta phải gọi super(props) trong hàm khởi tạo, để xác được các props từ parent được nạp vào, nếu không thì truyền props vào Component này, gọi this.props sẽ lỗi
- ```Props``` : Props hay property của một component, là một object được truyền vào trong một components, mỗi components sẽ nhận vào props và trả về react element.
Props cho phép chúng ta giao tiếp giữa các components với nhau bằng cách truyền tham số qua lại giữa các components;

```jsx
// app.js
import ...;
import Sidebar from 'sidebar';

export default class App extends React.Component {
    render (
        return (
            <div>
                <Sidebar name='Trang chủ'></Sidebar>
            </div>
        )
    )
}

// Sidebar,js
...
class Sidebar extends Component {
    render (
        return (
            <div>
                <a href="">{{ this.props.name}} </a>
            </div>
        )
    )
}

// Hoặc với fucntional component
function Sidebar(props) {
    render() {
        return (
            <div>
                <a href="">{{ this.props.name}} </a>
            </div>
        )
    }
}
...
```
- Từ thằng app ta truyền một props là name qa Sidebar, và t gọi nó = this.props.name
## State :
- Nó là một object có thể chứa data hoặc thông tin về component, khác với props, state chỉ tồn tại trong phạm vi component, khi state thay đổi, component sẽ được rerender:
```jsx
export default class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = { title: "Hello world" };
  }
  render() {
    return (
      <div>
        <h1>{this.state.title}</h1>
      </div>
    );
  }
}
```
- Đa số state sẽ chạy bên trong hàm khởi tạo đê tránh gặp các lỗi không mong muốn
Để cập nhật một state bạn sử dụng phương thức:
```jsx
render() {
  return {
    <div>
	<button onClick={() => {this.setState({ title : 'Goodby world' })}}>
    </div>
  }
}
```

Sự khác nhau giữa state và props:

```
State - Dữ liệu chỉ nằm trong phạm vi của một component. Nó được sở hữu bởi một components cụ thể mà chỉ là của component đó thôi. Và mỗi khi state thay đổi thì component cũng phải thay đổi theo.
Props - Dữ liệu đường truyền từ component cha cho componet con, components con khi nhận được sẽ chỉ được đọc mà không thể thay đổi dữ liệu đó
```
## Component Life Cycle
##### Khi một components được khởi chạy nó sẽ phải trải qua 4 giai đoạn chính:

 - initialization : Giai đoạn khởi tạo state và props
 - mounting : Giai đoạn này sau khi xog khởi tạo, nó thực hiện việc chuyển Vitual DOM trong react và thành DOM để hiển thị. có 3 phương thức để thực hiện điều này :
 ```jsx
class LifeCycle extends React.Component {
  componentWillMount() {
	  // không nên change state, props ở đây, vì quá trình này rất nhanh sẽ khiến kq render ra không như mong muốn
      console.log('chạy trước khi component được mount, tức là trước khi render')
   }
  componentDidMount() {
	  // trong phương thức này có thể gọi API để change state, props...
      console.log('Component đã được mount ( render thành công)')
      this.getList();
   }
  getList = () => {
   /*** Gọi API, update state,vv...***/
  }
  render() {
      ...
   }
}
 ```
 - updating : Là quá trình thứ 3 sau khi compoentn được khởi tạo, mount (render lần 1), ở trạng thái này, state và props sẽ được update với các sự kiện (click, gõ, ...) -> dẫn đến re-render
 ```jsx
class LifeCycle extends React.Component {
  constructor(props)
  {
    super(props);
     this.state = {
       list:[]
     };
  }
// Sau khi mount
   shouldComponentUpdate(nextProps, nextState){
	// phương thức này có xem component có re-render lại hay không dựa vào return true or false
     return this.state.list !== nextState.list
    }
   componentWillUpdate(nextProps, nextState) {
      console.log('Được gọi trước khi re-render');
   }
   componentDidUpdate(prevProps, prevState) {
      console.log('Đã re-render xog')
   }
  render() {
	  ...
   }
}
 ```

 - unmounting : Quá trình này chỉ xảy ra một lần duy nhất, khi component được gỡ khỏi DOM
 ```js
 componentWillUnmount() {
    console.log('component will unmount')
  }
  ```
  ## Handle event:
- Ví dụ ta có 1 hàm changeName() ta muốn click thì làm như sau:
```jsx
	<button onClick={changeName}>Change name</button>
```
#### ChÚ ý:
```jsx
export default class Sidebar extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isToggled: true
    };
  }
  toggled() {
    this.setState({
      isToggled: !this.state.isToggled
    });
  }
  render() {
    return (
      <div>
        <button onClick={() => this.toggled()}>
          {this.state.isToggled
            ? <NavOpen />
            : <NavClose />
          }
        </button>
      </div>
    );
  }
}
```
- Có 2 cách để gọi event trong React, để function có thể hiểu được this
```jsx
//Sử dụng arrow function
<button onClick={() => this.toggled()}>
 
// Sử dụng bind
<button onClick={this.toggled.bind(this)}>
 
//hoặc bind this trong constructor()
```

Kết thúc phần 1 ở đây, ở phần sau, sẽ tìm hiểu về các state, props, event handle, lifecircle của React Hooks và cách sử dụng