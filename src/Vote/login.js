import React, { useState, useEffect } from "react";
import { db } from "../firebase";
import { collection, onSnapshot, query } from "firebase/firestore";
import { useNavigate } from 'react-router-dom';
import './admin.css'

export default function LogIn() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [data, setData] = useState([]);
  const navigate = useNavigate(); //điều hướng đến các trang khác


  useEffect(() => {
    const q = query(collection(db, "UserInfo"));
    const unsubscribe = onSnapshot(q, (snapshot) => {
      const newData = snapshot.docs.map((doc) => ({
        id: doc.id,
        ...doc.data(),
      }));
      setData(newData);
    });

    return () => unsubscribe();
  }, []);

  const handleLogin = (e) => {
    e.preventDefault();
    // Tìm người dùng trong mảng 'data' dựa trên tên người dùng và mật khẩu 
    const userData = data.find(item => item.username === username && item.password === password);
    if (userData) {
      navigate("/Vote/vote", { state: { userData } });// Điều hướng đến trang "/Vote/vote" và truyền dữ liệu người dùng dưới dạng 'state'
    }
  };

  return (
    <div className="title">
      <div>
        <div>
          <form>
            <h2>Login</h2>
          <span>Username</span>
          <input
            type="text"
            placeholder="Username"
            name='username'
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
          <br />
          <span>Password</span>
          <input
            type="password"
            placeholder="Password"
            name='password'
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
          <br />
          <br />
          <button onClick={handleLogin}>Login</button>
        </form>
        </div>
        <br />
        
      </div>
    </div>
  );
}