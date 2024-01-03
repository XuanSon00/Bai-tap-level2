import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import { createStore } from 'redux';

//import store
import { Store } from '../store'

// 1.state là 1 dối tượng
const initialState = {
   isLoading: false,
   items: [],
   hasError: false
};

//2. Action là hàm
//luôn có thuộc tính type

function update(){
    return {
        type: 'ITEMS_REQUEST', //action type
        isLoading: true //payload information
     }
     
}

//3.reducer là hàm
//quản lý state, action
const reducer = (state = initialState, action) => { //es6 arrow function
    switch (action.type) {
       case 'INCREMENT':
          return Object.assign({}, state, {
             isLoading: action.isLoading
          })
       default:
          return state;
    }
 }
 

//4. tạo store đúng phương thức createStore

const store2 = createStore(reducer)

//có 3 phương thức quan trọng
//4.1 getState: lấy state đã lưu trữ
store2.getState()

//4.2 dispatch: truyen vào action để thay đổi giá trị state
//4.3 subscribe: được gọi khi có sự kiện dispatch
window.store2 = store2;
const unsubscribe = store2.subscribe(() => { console.log(store.getState());})
store2.dispatch(update());
unsubscribe();
store2.dispatch(update());
console.log(store2.getState());

// tao cau trong thu muc
//1.actions   ( file index.js)
//2.reducers ( file index.js)
/*//3.store  ( file index.js   ) 
import { createStore } from 'redux';
import reducer from '../reducers'
//tạo store phương thức createStore, voi tham số reducer
const store =     
*/
//4.component (tạo file AppCounter.js và Counter.js)