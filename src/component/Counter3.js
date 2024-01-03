import React from "react";
import { useDispatch, useSelector } from "react-redux"; //Hook
import { decrement, increment } from "../reducers/index3"; // import 2 action
export default function Counter3(){
//useSelector get giá trị của state(mapStatetToProps)
//usseDispatch gọi hành động
  const count = useSelector((state) => state.counter.value)
  const dispatch = useDispatch()
  return <>
    <h1>Count: {count}</h1>
    <button onClick={()=> dispatch(increment())}>Click</button>
  </>
}