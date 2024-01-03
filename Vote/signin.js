import React from "react";
import { useState, useEffect } from "react"
import { db, storage} from "../firebase";
import { collection, addDoc, onSnapshot, query  } from "firebase/firestore";
import { getStorage, ref, listAll, getDownloadURL } from "firebase/storage";
import {  Link, Navigate } from 'react-router-dom';
import './admin.css'

 
export default function SignIn(){
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [redirect, setRedirect] = useState(false)
    const [data, setData] = useState([]);
 
    useEffect(() => {
      //tạo một truy vấn đến collection 'UserInfo' trong cơ sở dữ liệu Firebase
      const q = query(collection(db, "UserInfo"));
      //lắng nghe sự thay đổi trong truy vấn q. Mỗi khi có sự thay đổi trong collection 'INFO'
      // hàm callback được truyền vào onSnapshot sẽ được gọi
      //Tham số QuerySnapshot là kết quả trả về từ truy vấn và chứa thông tin về các document thỏa mãn truy vấn.
      const unsubscribe = onSnapshot(q, (snapshot) => {
        const newData = snapshot.docs.map((doc) => ({
          id: doc.id,
          ...doc.data(),
        }));
        setData(newData);
      });
        //trả về một hàm từ useEffect để huỷ lắng nghe sự thay đổi khi component bị huỷ
        return () => unsubscribe();
      }, []);

   
         
    //lưu vào firestore database
  const handleSave = async (e) => {
        console.log(handleSave)
        e.preventDefault();
    if (username !== "" && password !== "") {
        //  tham chiếu đến Firebase Storage
      const storageRef = getStorage();
        // dẫn đến thư mục 'Avatar'
      const avatarRef = ref(storageRef, "Avatar");
        // Lấy danh sách tất cả các file trong thư mục 'Avatar'
      const avatarFiles = await listAll(avatarRef);
        // Chọn một file ngẫu nhiên từ danh sách
      const randomAvatar = Math.floor(Math.random() * avatarFiles.items.length);
      const randomFile = avatarFiles.items[randomAvatar];
        // Lấy URL của file ngẫu nhiên
      const avatarURL = await getDownloadURL(randomFile);

      try{
        await addDoc(collection(db, 'UserInfo'), {
          username,
          password,
          avatar:avatarURL
        });
        const newData = {
          username: username,
          password: password,
          avatar:avatarURL
        };
    
        setData([...data, newData]);
        setUsername("");
        setPassword("");
        setRedirect(true);
        } catch(error){
          console.log("Error adding document: ", error);
        }
        }
        
      };

      if (redirect) {
        return <Navigate to ="/Vote/login" />
      }

    return(

        <div className="title">
           <div>
            <div>
                <form>
                  <h2>Register</h2>
                    <span>Username</span>
                    <input 
                        type="text" 
                        placeholder="Usernane..." 
                        name='username'
                        onChange={(e) => setUsername(e.target.value)}
                    />
                    <br/>
                    <span>Password</span>
                    <input 
                        type="password" 
                        placeholder="password..." 
                        name='password'
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    <br/>
                    <br/>
                    <button onClick={handleSave}>SignIn</button>
                </form>
            </div>
            <br/>
            <div>
            
            </div>
           </div>
        </div>
    );
}