import React from "react";
import { useState, useEffect } from "react"
import './admin.css'
import { db} from "../firebase";
import { collection, addDoc, onSnapshot, query, updateDoc, deleteDoc, doc  } from "firebase/firestore";
import {  Link } from 'react-router-dom';

export default function Admin(){
    const [title, setTitle] = useState("");
    const [content, setContent] = useState("");
    const [timeStart, setTimeStart] = useState("");
    const [timeEnd, setTimeEnd] = useState("");
    
    const [data, setData] = useState([]);
    
    const [editingItem, setEditingItem] = useState(null);
    const [newTitle, setNewTitle] = useState("");
    const [newContent, setNewContent] = useState("");
    
    useEffect(() => {
        //tạo một truy vấn đến collection 'INFO' trong cơ sở dữ liệu Firebase
        const q = query(collection(db, "INFO"));
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
    
    /*const handleSave =(event)=> {
        event.preventDefault();
         //Lưu thông tin
        const newData ={
            title: title,
            content: content,
            timeStart: timeStart,
            timeEnd: timeEnd
            };

        setData([...data, newData]);

    }*/
 
    //lưu vào firestore database
    const handleSave = async (e) => {
        e.preventDefault();
        if (title !== "" && content !== "" && timeStart !== "" && timeEnd !== "") {
          await addDoc(collection(db, 'INFO'), {
            title,
            content,
            timeStart,
            timeEnd,
          });
          const newData = {
            title: title,
            content: content,
            timeStart: timeStart,
            timeEnd: timeEnd,
          };
    
        setData([...data, newData]);
        setTitle("");
        setContent("");
        setTimeStart("");
        setTimeEnd("");
        }
      };
    

   /*
   const handleEdit = async (item, newTitle) => {
    await updateDoc(doc(db, "INFO", item.id), { title: newTitle  });
  };*/

  //hiện input sửa nội dung
    const handleEdit = (item) => { 
      setEditingItem(item);
      setNewTitle(item.title);
      setNewContent(item.content);
    };
  // lưu nội dung đã sửa
    const handleSaveEdit = async () => {
      if (editingItem) {
        await updateDoc(doc(db, "INFO", editingItem.id), {
          title: newTitle,
          content: newContent,
        });
        setEditingItem(null);
        setNewTitle("");
        setNewContent("");
      }
    };
  
  
    //xóa dữ liệu trong firestore
    const handleDelete = async (item) => {
        await deleteDoc(doc(db, 'INFO', item.id));
console.log(item)
      };
      

    return(
        <div className="admin">
           <div>
            <div className="title">
                <form>
                    <input 
                        type="text" 
                        placeholder="Tiêu đề" 
                        name='title' value={title}
                        onChange={(e) => setTitle(e.target.value)}
                        />
                    <br/>
                    <input 
                        type="text" 
                        placeholder="Nội dung" 
                        name='content' 
                        value={content}
                        onChange={(e) => setContent(e.target.value)}
                        />
                    <br/>
                    <input 
                        type="date"
                        placeholder="Thời gian bắt đầu" 
                        name='time-start' 
                        value={timeStart}
                        onChange={(e) => setTimeStart(e.target.value)}
                        />
                    <input 
                        type="date"
                         placeholder="Thời gian kết thúc" 
                         name='time-end' 
                         value={timeEnd}
                         onChange={(e) => setTimeEnd(e.target.value)}
                         />
                    <br/>
                    <button onClick={handleSave}>Lưu</button>
                </form>
            </div>
            <br/>
            <div className="render">
            
                <table>
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Thời gian bắt đầu học</th>
                            <th>Thời gian kết thúc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    {data.map((item) => (
                    <tr key={item.id}>
                    <td>
                      {editingItem && editingItem.id === item.id ? ( //khi bấm nút sửa nếu có dữ liệu dc render -> hiển thị input TIÊU ĐỀ
                        <input
                          type="text"
                          value={newTitle}
                          onChange={(e) => setNewTitle(e.target.value)}
                        />
                      ) : (
                        item.title
                      )}
                    </td>
                    <td>
                      {editingItem && editingItem.id === item.id ? (//khi bấm nút sửa nếu có dữ liệu dc render -> hiển thị input NỘI DUNG
                        <input
                          type="text"
                          value={newContent}
                          onChange={(e) => setNewContent(e.target.value)}
                        />
                      ) : (
                        item.content
                      )}
                    </td>
                        <td>{item.timeStart}</td>
                        <td>{item.timeEnd}</td>
                        <td>
                          {editingItem && editingItem.id === item.id ? (
                            <button onClick={handleSaveEdit}>Lưu</button>
                          ) : (
                            <>
                              <button onClick={() => handleEdit(item)}>Sửa</button>
                              <button onClick={() => handleDelete(item)}>Xóa</button>
                            </>
                          )}
                        </td>
                    </tr>
                    ))}
                    </tbody>
                </table>
            </div>
    <div>
      <Link to="/Vote/signin">Go to SignIn</Link><br ></br>
      <Link to="/Vote/login">Go to LogIn</Link><br ></br>
      <Link to="/Vote/vote">Go to Vote</Link>
    </div>
           </div>
        </div>
    );
}