# Learning React p.3 (Làm quen với Redux-saga)
## Khái niệm : 
 Redux Saga là 1 thư viện được sử dụng để xử lý các side effects trong redux. Khi bạn gọi một action mà làm thay đổi state của ứng dựng và bạn có thể muốn làm điều gì đó với sự thay đổi của state. 

 Ta muốn khi Button nào đó đưỢc kích, thì dispatch 1 action đó là USER_FETCH_REQUESTED, vậy ta muốn trong lúc action đó được gọi, thì ta sử lý thêm abc, xyz gì đó thì t làm như thế nào ?

 ```jsx
 const UserComponent = () => {
  ...
  onSomeButtonClicked() {
    const { userId, dispatch } = this.props
    dispatch({ type: 'USER_FETCH_REQUESTED', payload: {userId}})
  }
  ...
} 
```
![image info](https://images.viblo.asia/6d6e476c-b16a-45ae-9642-f159218af9ac.png)
### Config
 - Để sử dụng redux-saga, ta cần phải cài đặt yarn add redux-saga / npm i redux-saga
 - Nó là một middleware, tương tự như middleware ở các FW backend, sẽ có 1 action đi qua và trigger middleware này, ví dụ t lắp 1 middleware khi action USER_FETCH_REQUESTED đưỢc bắt, nó sẽ update User vào store.

 ##### sagas/index.js
 - Đầu tiên, ta sẽ tạo 1 file saga root:
```jsx
import { all, takeLatest, put } from 'redux-saga/effects';

function* fetchUser(action) {
   try {
     // dùng call() để call 1 api và trả về user
      const user = yield call(Api.fetchUser, action.payload.userId);
      // sau khi có user, ta sẽ dispatch 1 action USER_FETCH_SUCCEEDED với payload là user
      yield put({type: "USER_FETCH_SUCCEEDED", user});
   } catch (e) {
     // trong quá trình call có lỗi thì ta dispatch action USER_FETCH_FAILED
      yield put({type: "USER_FETCH_FAILED", message: e.message});
   }
}

// generator funciton này đảm bảo khi USER_FETCH_REQUESTED được dispatch thì fetchUser sẽ được gọi

// Với takeLastest có nghĩa là nếu chúng ta thực hiện một loạt các actions, nó sẽ chỉ thực thi và trả lại kết quả của của actions cuối cùng
function* actionWatcher() {
    yield takeLatest('USER_FETCH_REQUESTED', fetchUser)
}

export default function* rootSaga() {
  yield all([
    actionWatcher(),
  ]);
}

export default rootSaga;
```

##### main.js
```js
import createSagaMiddleware from 'redux-saga';
import { createStore, applyMiddleware } from 'redux';
import { Provider } from 'react-redux';
import { logger } from 'redux-logger';
import reducer from './reducers';
import App from './components/App';
import rootSaga from './sagas';
const sagaMiddleware = createSagaMiddleware();

const store = createStore(
   reducer,
   // apply cho reducer có middlare saga
   applyMiddleware(sagaMiddleware, logger),
);
// run saga
sagaMiddleware.run(rootSaga);

render(
   <Provider store={store}>
     <App />
   </Provider>,
document.getElementById('root'),
);
```

Ở file sagas/index.js: ta khai báo generator function actionWatcher nhằm mục đích làm cho hàm fetchUser sẽ được gọi khi mà action USER_FETCH_REQUESTED chạy.

Sau đó ta export gen.. function rootSaga với yeild all. Việc sử dụng all là cách để chạy các effect một cách song song

Ở file main.js : ta dùng ``` const sagaMiddleware = createSagaMiddleware() ``` để khởi tạo saga, và phải cần apply nó vào redux với ```applyMiddleware(sagaMiddleware)``` khi create store;

Dó đã khai báo middlware vào reducer nên khi ta gọi action USER_FETCH_REQUESTED thì nó sẽ đi qa middleware và takeLatest nhận biết được sideEffect này sẽ gọi fetchUser

Sau khi fetchUser thì sẽ dispatch 1 action;

#### Các side effects thường sử dụng
```
takeEvery() : thực thi và trả lại kết quả của mọi actions được gọi.
takeLastest() : có nghĩa là nếu chúng ta thực hiện một loạt các actions, nó sẽ chỉ thực thi và trả lại kết quả của của actions cuối cùng.
take() : tạm dừng cho đến khi nhận được action
put() : dispatch một action.
call(): gọi function. Nếu nó return về một promise, tạm dừng saga cho đến khi promise được giải quyết.
race() : chạy nhiều effect đồng thời, sau đó hủy tất cả nếu một trong số đó kết thúc
```

### Ví dụ về các sideEffect
```jsx 
// Khi sử dụng call(), ta thường dùng cho việc call API
import { all, call } from 'redux-saga/effects'

const todos = yield call(fetch, '/api/todos');
const user = yield call(fetch, '/api/user');

// Với cách làm trên, khi todos thực hiện xong thì user mới bắt đầu được thực thi

const [todos, user]  = yield all([
  call(fetch, '/api/todos'),
  call(fetch, '/api/user')
]);

// Với all() ta có thể giải quyết vấn đề này bằng cách cho các effect được gọi đồng thời