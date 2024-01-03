import React from "react";
import { useState, useEffect } from "react"
import './user.css'
import { db} from "../firebase";
import { collection, addDoc, onSnapshot, query, updateDoc, deleteDoc, doc  } from "firebase/firestore";
import {  Link } from 'react-router-dom';
export default function User(){
    
  const [data, setData] = useState([]); // Lưu trữ dữ liệu từ collection 'INFO'
  const [dataUser, setDataUser]= useState([]); // Lưu trữ dữ liệu từ collection 'UserInfo'

  
  const [selectedAvatar, setSelectedAvatar] = useState([]); //lưu lại img Avatar trong mỗi container

  const [isVoted, setIsVoted] = useState([]); //Kiểm tra xem container đã được vote hay chưa

  
  const [openVote, setOpenVote] = useState([]); // cập nhật trạng thái khi mở phần vote
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
      useEffect(() => {
        //tạo một truy vấn đến collection 'INFO' trong cơ sở dữ liệu Firebase
        const q = query(collection(db, "UserInfo"));
        //lắng nghe sự thay đổi trong truy vấn q. Mỗi khi có sự thay đổi trong collection 'INFO'
        // hàm callback được truyền vào onSnapshot sẽ được gọi
        //Tham số QuerySnapshot là kết quả trả về từ truy vấn và chứa thông tin về các document thỏa mãn truy vấn.
        const unsubscribe = onSnapshot(q, (snapshot) => {
          const newData = snapshot.docs.map((doc) => ({
            id: doc.id,
            ...doc.data(),
          }));
          setDataUser(newData);

        });
        //trả về một hàm từ useEffect để huỷ lắng nghe sự thay đổi khi component bị huỷ
        return () => unsubscribe();
      }, []);
    

    // khi bấm ảnh avatar, nhận vào containerId và avatarId
      //cập nhật state selectedAvatar để lưu lại avatarId được chọn trong từng containerId.
    const handleAvatarClick = (containerId, avatarId) => {
      setSelectedAvatar((prevAvatar) => {
        const newSelectedAvatar = [...prevAvatar];
        newSelectedAvatar[containerId] = avatarId;
        return newSelectedAvatar;
      });
      //cập nhật trạng thái có hiện phần vote hay k
      setOpenVote((prevOpenVote) => {
        const showVote = [...prevOpenVote];
        showVote[containerId] = true;
        return showVote
      })
    };
  
    //nhận tham số containerId
    const handleVoteClick = async (containerId) => {
      const selectedAvatarId = selectedAvatar[containerId];
      if (selectedAvatarId !== undefined) {
        console.log("Voted bởi: ", selectedAvatarId);
        try {
           // Lấy thông tin vote từ mảng data dựa trên containerId
          const voteItem = data[containerId];
          const { title, content } = voteItem;
    
          // Lấy thông tin user từ mảng dataUser dựa trên selectedAvatarId
          const user = dataUser[selectedAvatarId];
          const { username, password } = user;
    
          // Tạo đối tượng voteData để lưu thông tin vote
          const voteData = {
            title: `${title},${content}`,
            userInfo: `${username},${password}`,
          };
    
          const docRef = await addDoc(collection(db, "VOTE"), voteData);
    console.log("vote bởi ID: ", docRef.id);

    // Cập nhật state isVoted để đánh dấu containerId đã được vote
    setIsVoted((prevIsVoted) => {
      const newIsVoted = [...prevIsVoted];
      newIsVoted[containerId] = true;
      return newIsVoted;
    });

      //cập nhật trạng thái có hiện phần vote hay k
    setOpenVote((prevOpenVote) => {
      const showVote = [...prevOpenVote];
      showVote[containerId] = true;
      return showVote
    })

    // Cập nhật state data để lưu voteId vào voteItem tương ứng
    setData((prevData) => {
      const newData = [...prevData];
      newData[containerId].voteId = docRef.id; // Lưu voteId vào data
      return newData;
    });
    } catch (error) {
      console.error("Lỗi vote: ", error);
    }
  };
    };
    
    //nhận tham số containerId
      //đặt giá trị false cho phần tử tương ứng trong state isVoted
      //sau đó thực hiện việc xóa document vote khỏi Firestore và cập nhật các state liên quan.

    const handleUnvoteClick = async (containerId) => {
      setIsVoted((prevIsVoted) => {
        const newIsVoted = [...prevIsVoted];
        newIsVoted[containerId] = false;
        return newIsVoted;
      });

      //cập nhật trạng thái có hiện phần vote hay k
      setOpenVote((prevOpenVote) => {
        const showVote = [...prevOpenVote];
        showVote[containerId] = false;
        return showVote
      })
    
      try {
        // Lấy thông tin vote từ mảng data dựa trên containerId
        const voteItem = data[containerId];//Lấy thông tin vote từ mảng data
        const voteId = voteItem.voteId;
    
        if (voteId) {
          const docRef = doc(db, "VOTE", voteId);//Tạo  document trong collection "VOTE"
          await deleteDoc(docRef);//Xóa document từ Firestore
    
          // Cập nhật state data để xóa voteId tương ứng
          setData((prevData) => {
            const newData = [...prevData];
            delete newData[containerId].voteId;
            return newData.filter((item) => item !== undefined); // Loại bỏ phần tử undefined khỏi mảng

          });
        } else {
          console.log("Không tìm thấy ID vote để xóa.");
        }
      } catch (error) {
        console.error("Lỗi khi xóa vote: ", error);
      }
    };
    
    //khi ấn nút sẽ hiện phần Vote
   const handleOpenVote = (containerId) => {
    setOpenVote((prevOpenVote) => {
      const showVote = [...prevOpenVote];
      showVote[containerId] = true;
      return showVote
    })
  }
    return(
        <div className="user">
            <div>
                <Link to="/">Go to Admin</Link><br ></br>
                <Link to="/Vote/login">Go to Login</Link>
            </div>
           <div >
            {data.map((item, containerId) => (
            <div key={item.id} className="container">
                <b>Tiêu đề Vote:</b><br/>
                    <span>{item.title}</span>
            <br/>
                <b>Nội dung Vote:</b><br/>
                    <span>{item.content}</span>
            <br/>
                <b>Vote bởi:</b>
                {/* */ }
                {openVote[containerId] ? (
                  <>
                <div className="avatar">
                {dataUser.map((index, avatarId) => (
                  <div key={index.id}>
                    <img
                      src={index.avatar}
                      alt="Avatar"
                      className={`Img ${
                        selectedAvatar[containerId] === avatarId ? 'Img-clicked' : ''
                      }`}
                      onClick={() => handleAvatarClick(containerId, avatarId)}
                    />
                  </div>
                ))}
              </div>
              {isVoted[containerId] ? (
                <button onClick={() => handleUnvoteClick(containerId)}>Unvote</button>
              ) : (
                <button onClick={() => handleVoteClick(containerId)}>Vote</button>
              )}
            </>
          ) : (
            <button onClick={() => handleOpenVote(containerId)}>Vote</button> // khi ấn vào sẽ hiện VOTE
          )}
        </div>
      ))}
            
            <br/>
            
           </div>
        </div>
    );
}


