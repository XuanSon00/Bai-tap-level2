import { createStore } from 'redux'
import reducer from '../reducers/index2'
//tạo store phương thức createStore, với tham số reducer
const store = createStore(reducer)


export default store