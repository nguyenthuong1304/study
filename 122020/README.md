# Learning React p.2 (Làm quen với React Hook)

Hooks là những hàm cho phép bạn "kết nối" React state và lifecycle vào các components sử dụng hàm. Với Hooks bạn có thể sử dụng state và lifecycles mà không cần dùng ES6 class

## State
Khi làm việc với ES6 class, ta phải khao báo như sau 
```jsx
export default Counter extends React {
    this.state = {
        couter: 0
    }

    setCount = counter => {
        this.state({ counter })
    }

    render() {
        return (
            <div>
                <p>You clicked {count} times</p>
                <button onClick={() => setCount(count + 1)}>Click me</button>
            </div>
        )
    }
}
```
Còn về Hook bạn chỉ cần import { useState } from 'react' 
```jsx
import { useState } from 'react'

function Counter() {
  const [count, setCount] = useState(0);
    // count ở đây tương tự với state
    // setCount tương tự với 
    // setCount = counter => {
    //     this.state({ counter })
    // }   
  return (
    <div>
      <p>You clicked {count} times</p>
      <button onClick={() => setCount(count + 1)}>Click me</button>
    </div>
  )
}
```
Việc viết theo cách này, sẽ làm giảm bớt thời gian viết code react và có thế thấ code gọn và sạch hơn

## Life circle
Nếu như ta viết kiểu thông thường, ta sẽ viết như này : 
```jsx
    componentWillUnmount() {
        // Chạy khi component chuẩn bị remove khỏi DOM
    }
    componentDidMount() {
	  // Chạy khi mọi thứ đã sẵn sàng ( được mount vào DOM )
    }
    componentDidUpdate(prevProps, prevState) {
	  // chạy khi có sự thay đổi từ props/state
    }
```
Còn hook ta sẽ có 1 hàm mà có thể thực thi được 3 action này 
```jsx
import { useState, useEffect } from 'react'

function Example() {
  const [count, setCount] = useState(0)

  // Giống như componentDidMount và componentDidUpdate
  useEffect(() => {
    document.title = `You clicked ${count} times`

    // Hàm này tương tự componentWillUnmount
    return () =>  setCount(0)
  })

  return (
    ...
  )
}
```

Mặc định useEffect sẽ thực thi nếu như component được mount hoặc có sự thay đổi từ state or props, ví dụ click vào button để setCount thì hàm này sẽ được gọi

Nếu có return một thứ gì đó, thì tất cả các hàm thực thi trong hàm return sẽ thực thi nếu component cb được loại bỏ khỏi DOM

Chúng ta có thể sử dụng nhiều useEffect() trong 1 component được

#### Prevent re-render khi không cần thiết
```jsx
// Nếu không muốn component render khi giá trị state/props nào đó thay đổi chỉ việc truyền tham số thứ 2 thành một mảng để tránh bị re-render
useEffect(() => {
    // rendered or re-rendered
    return () =>  setCount(0)
  }, [$x])

//   $x {
//     state: truyền vào state để lắng nghe
//     props: truyền vào 1 props bên ngoài và lắng nghe nó
//     []: để rỗng, chỉ render lần đầu, còn lại sẽ không render nếu có sự thay đổi
//   }
```
### Làm việc rới redux
Khi làm việc với redux, ta có thể connect giữa component với redux với nhiều cách khác nhau.
Thông thường ta sẽ làm như này, rất phổ biến
```jsx
// reducers/index.js
import { combineReducers } from 'redux'
import todos from '/path_to/todos'

export default combineReducers({
  todos,
})
// -----------------


// Giả sử ta có 1 action như sau :
// todoActions.js
export const addTodo = (todo) => {
  return {
    type: 'ADD_TODO',
    payload: todo,
  };
};


// component/todo.jsx
function mapStateToProps(state) {
    return {
        todos: state.todos
    };
}

function mapDispatchToProps(dispatch) {
    return {
        addTodo: () => dispatch(addTodo()),
    };
}

export default connect(mapStateToProps, mapDispatchToProps)(App);
```

#### Additional hook
```jsx
// thay thế cho mapStateToProps để lấy state của todosReducers
// với todos là tên reducers khi ta combine sang
const todos = useSelector(state => state.todos)

// Thay thế cho mapDispatchToProps
const dispatch = useDispatch(); // register dispatch
// Tạo ra 1 hàm addTodo
// addTodo() được import từ todoActions.js với payload là todo
const addTodo = (todo) => dispatch(addTodo(todo));

// như vậy ta sẽ lấy được state (todos) và dispatch được reducers của todoReducers

//  ...
return (
    //  ...
    <button onClick={() => addTodo(TodoItem)} />
    // ...
)

```

- useSelector : Cho phép chúng ta lấy state từ Redux store bằng cách sử dụng một selector function làm tham số đầu vào. Ngoài ra mapStateToProps chỉ return về 1 object còn useSelector return về any values
- Khi dispatch 1 action, useSelector sẽ so sánh tham chiếu với giá trị được return trước đó và giá trị hiện tại và thực hiện re-render, việc so sánh với toán tử ===
- useDispatch : là return về một tham chiếu đến dispatch function từ Redux store và được sử dụng để dispatch các action


useReducer() : Một cái nâng cao hơn của useState()
```jsx
// nhận vào reducer và initialState để init, return state hiện tại và dispatch function để trigger 1 action

// Giả sử ta có reducer với 1 CASE :
// todoReducer.jsx
case 'DO_TODO':
    return state.map(todo => {
        if (todo.id === action.id) {
            return { ...todo, complete: true };
        } else {
            return todo;
        }
    })
default: 
    return state

// component.jsx
const initialTodos = [
    {
        {
            _id: '123456',
            task: 'Learn React',
            complete: false,
        },
    }
];


const [todos, dispatch] = useReducer(todoReducer, initTodos);
// Lấy todos = việc gắn giá trị mặc định cho reducers

// ...
return (
    // ...
    {todos.map(todo => (
        <button onClick={() => dispatch(({
            type: 'DO_TODO',
            id: todo.id
        }))} />
    )}
)
```
Bằng việc sử dụng useReducer giúp mở rộng hơn nữa khả năng của React về mặt quản lý state, và nó chỉ hoạt động trong nội bộ của mỗi component.

useMemo: giúp ta kiểm soát việc được render dư thừa của các component con, nó khá giống với hàm shouldComponentUpdate trong LifeCycle
```jsx
// completeTodos.jsx
const UsingMemo = ({ todos, refresh }) => {
    const completeTodos = useMemo(
        () => todos.filter(x => x.complete === true), // completeTodos sẽ chỉ thực thi khi props todos thay đổi
        [todos] // watch todos
    );

    return (
        // ... loop todos
        <div onClick={refresh}>
            
        </div>
  );
}

// như vậy nếu ta call completeTodos từ 1 component khác và truyền vào todos, nó sẽ listening props.todos có thay đổi ko? nếu có sẽ tiến hành re-render lại completeTodos component
```


useCallback : Tương tự useMemo nhưng khác ở chỗ function truyền vào useMemo bắt buộc phải ở trong quá trình render trong khi đối với useCallback đó lại là function callback của 1 event 

```jsx
const Todo = useMemo(
    const [todos, setTodos] = React.useState([]);
    const refresh = useCallback(() => setTodos(someNewTodos), [
        
    ]);

    return <UsingMemo todos={todos} onClick={refresh} />;
);
// sử dụng useCallback cho sự kiện onClick, điều này có nghĩa là việc thay đổi giá trị todos component Todo không làm UsingMemo component re-render lại
```

Phần tiế theo sẽ tìm hiểu về Redux-Saga