import React, { useState, useEffect } from "react";
import { db } from "../firebase";
import {collection, onSnapshot, addDoc, query, where, getDocs, deleteDoc} from "firebase/firestore";
import { Link, useLocation } from "react-router-dom";

export default function Vote() {
  const [data, setData] = useState([]);
  const [userData, setUserData] = useState(null);
  const [userVotes, setUserVotes] = useState({}); //lưu trữ dữ liệu bình chọn của người dùng
  const location = useLocation();// dùng để truy cập vào thông tin người dùng được truyền từ route khác


  //lấy dữ liệu firebase "INFO" để cập nhật trạng thái
  useEffect(() => {
    const unsubscribe = onSnapshot(collection(db, "INFO"), (snapshot) => {
      const newData = snapshot.docs.map((doc) => ({
        id: doc.id,
        ...doc.data(),
      }));
      setData(newData);
    });

    return () => unsubscribe();
  }, []);

  //cập nhật thông tin người dùng từ url
  //nếu có thông tin người dùng truyền từ route khác=> cập nhật trạng thái userData 
  useEffect(() => {
    if (location.state && location.state.userData) {
      setUserData(location.state.userData);
    }
  }, [location.state]);

  //lấy dữ liệu khi vote và lưu vào trong firebase "voteResults"
  useEffect(() => {
    const q = query(collection(db, "voteResults"));
    const unsubscribe = onSnapshot(q, (snapshot) => {
      const votes = snapshot.docs.map((doc) => doc.data());

      //lưu trữ bình chọn đã được nhóm lại theo itemId
      const updatedUserVotes = {};
      votes.forEach((vote) => {
        if (!updatedUserVotes[vote.itemId]) { 
          updatedUserVotes[vote.itemId] = [];
        }
        updatedUserVotes[vote.itemId].push(vote); //thêm phần tử vote vào mảng đã tồn tại 
      });
      setUserVotes(updatedUserVotes);
    });

    return () => unsubscribe();
  }, []);

  const handleVote = async (avatar, itemId) => {
    // Lưu kết quả chọn vào firebase "voteResults"
    if (userData && userData.username && userData.password) {
      try {
        const existingVoteQuery = query(
          collection(db, "voteResults"),
          where("avatar", "==", avatar),
          where("itemId", "==", itemId)
        );

        // Kiểm tra xem đã có kết quả bình chọn tồn tại hay chưa
        const existingVote = await getDocs(existingVoteQuery);
        if (!existingVote.empty) {
          // Nếu đã tồn tại kết quả bình chọn, xóa kết quả bình chọn đó
          existingVote.forEach(async (doc) => {
            await deleteDoc(doc.ref);
            console.log("Xóa kết quả vote!");
          });

        } else {
          // Nếu chưa có kết quả bình chọn, thêm mới kết quả vào collection "voteResults"
          await addDoc(collection(db, "voteResults"), {
            username: userData.username,
            password: userData.password,
            avatar: avatar,
            itemId: itemId,
          });
          console.log("Đã lưu vào Firebase");
        }
      } catch (error) {
        console.error("Lỗi xóa vote : ", error);
      }
    }
  
    console.log("Vote/Unvote clicked", avatar);
  };

  return (
    <div className="user">
      <div>
        <Link to="/">Go to Admin</Link>
        <br />
        <Link to="/Vote/signin">Go to Signin</Link>
        <br />
        <Link to="/Vote/login">Go to Login</Link>
      </div>
      <div>
        {data.map((item) => (
          <div key={item.id} className="container">
            <b>Tiêu đề Vote:</b>
            <br />
            <span>{item.title}</span>
            <br />
            <b>Nội dung Vote:</b>
            <br />
            <span>{item.content}</span>
            <br />
            <b>Vote bởi:</b>
            {userVotes[item.id] &&
              userVotes[item.id].map((vote, index) => (
                <span key={index}>
                  <img src={vote.avatar} alt="Avatar" className="Img" />
                </span>
              ))}
            <br />
            <button
              onClick={() => handleVote(userData && userData.avatar, item.id)}
            >
              {userVotes[item.id] &&
              userVotes[item.id].some(
                (vote) => vote.avatar === (userData && userData.avatar)
              )
                ? "Unvote"
                : "Vote"}
            </button>
            <br />
          </div>
        ))}
        <br />
      </div>
    </div>
  );
}