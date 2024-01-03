import React from 'react';
import './App.css';
//import React, { useState } from 'react';
//import TodoList from './Todolist/TodoList';
//import RegisterPage from './Register/Register';
//import TodoList2 from './Todolist2/Todolist2';
import axios from 'axios';
//import Counter2 from './component/Counter2';
//import Counter from './Test';
//import Slideshow from './Slide';
//import Title from "./TodoList/Title";
//import AddTodo from './TodoList/AddToDo';
//import Todo from './TodoList/Todo';
//import { collection,query,onSnapshot,doc,updateDoc,deleteDoc, QuerySnapshot } from 'firebase/firestore';
//import { db } from './firebase';

//collection: đọc, truy vấn tất cả tài liệu trong firestore
//query: xác định điều kiện truy vấn và trả về 1 collection trong firestore(chỉ xác định truy vấn collection để thu kết quả)
//onSnapshot: lắng nghe sự thay đổi trong một truy vấn hoặc một collection. Khi có bất kỳ thay đổi nào xảy ra, nó sẽ tự động gọi lại và cung cấp một QuerySnapshot mới
//doc: Đại diện cho một tài liệu cụ thể trong Firestore. Có thể đọc, ghi, cập nhật và xóa tài liệu bằng cách sử dụng phương thức trên đối tượng doc.
//updateDoc: cập nhật một tài liệu trong Firestore. Nó cho phép bạn chỉ định các trường và giá trị mới để cập nhật.
//deleteDoc: xóa một tài liệu trong Firestore. Nó xóa hoàn toàn tài liệu đó khỏi cơ sở dữ liệu.
//QuerySnapshot: Đại diện cho kết quả trả về từ một câu truy vấn Firestore hoặc sự thay đổi trong một collection. 


import Admin from './Vote/admin';
import User from './Vote/user';
import SignIn from './Vote/signin';
import Login from './Vote/login';
import Vote from './Vote/vote';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

function App() {
  /*const [todos, setTodos] = React.useState([]);

  React.useEffect(() => {
    //tạo một truy vấn đến collection 'todos' trong cơ sở dữ liệu Firebase
  const q = query(collection(db, "todos"));
    //lắng nghe sự thay đổi trong truy vấn q. Mỗi khi có sự thay đổi trong collection 'todos'
    // hàm callback được truyền vào onSnapshot sẽ được gọi
    //Tham số QuerySnapshot là kết quả trả về từ truy vấn và chứa thông tin về các document thỏa mãn truy vấn.
  const unsub = onSnapshot(q, (querySnapshot) => {
    let todosArray = [];
    querySnapshot.forEach((doc) => {
        //tạo một đối tượng mới từ dữ liệu và thêm một thuộc tính id với giá trị là doc.id
        todosArray.push({ ...doc.data(), id: doc.id });
    });
    setTodos(todosArray);
    });
  return () => unsub(); //trả về một hàm từ useEffect để huỷ lắng nghe sự thay đổi khi component bị huỷ
  }, []);

  const handleEdit = async (todo, title) => {
    await updateDoc(doc(db, "todos", todo.id), { title: title });
  };
  //// Xử lý sự kiện thay đổi trạng thái hoàn thành của công việc sang completed
  const toggleComplete = async (todo) => {
    await updateDoc(doc(db, "todos", todo.id), { completed: !todo.completed });
  };
  const handleDelete = async (id) => {
    await deleteDoc(doc(db, "todos", id));
  };*/
  return (
    //<Slideshow />
  //<Counter2 />
  //<TodoList />
   //<RegisterPage />
  //<TodoList2 />
  //<Counter/>

    <div className="App">
      {/*<div>
        <Title />
      </div>
      <div>
        <AddTodo />
      </div>
      <div className="todo_container">
        {todos.map((todo) => (
          <Todo
            key={todo.id}
            todo={todo}
            toggleComplete={toggleComplete}
            handleDelete={handleDelete}
            handleEdit={handleEdit}
          />
        ))}
      </div>*/}

      <BrowserRouter>
  <Routes>
    <Route path="/" element={<Admin />} />
    <Route path="/Vote/signin" element={<SignIn />} />
    <Route path="/Vote/login" element={<Login />} />
    <Route path="/Vote/user" element={<User />} />
    <Route path="/Vote/vote" element={<Vote />} />
  </Routes>
</BrowserRouter>
    </div>



  );
}
export default App;