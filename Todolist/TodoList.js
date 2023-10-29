import React, { useState } from "react";
import "./TodoList.css"





export default function TodoList() {
/*------------------Bài tập 2--------------------*/
    //const renderJobs = localStorage.getItem("jobs") dữ liệu chuỗi
    

    const [addJob, setAddJob] = useState('')
    //const [jobs, setJobs] = useState([]) 
    const [jobs, setJobs] = useState(() =>{ 
        const renderJobs = JSON.parse(localStorage.getItem("jobs")) // đổi chuỗi thành mảng
    
        return renderJobs
    })  

 
// console.log(addJob)
/*---------------------Nút Add-----------------------*/
    const handleSubmit = () => {// làm mới lại list danh sách jobs dc thêm vào từ input khi ấn button(thứ tự tăng dần)
        setJobs(prev => {
            const newJobs = [...prev, addJob]
                //lưu vào local storage
                const jsonjobs = JSON.stringify(newJobs) //đổi dữ liệu mảng sang chuổi
                localStorage.setItem('jobs', jsonjobs) // lưu vào local storage key là "jobs"  --> renderJobs

            return newJobs
        });
        setAddJob('')
    }

  
/*---------------------Nút Delete-----------------------*/
    const handleDelete = (index) => {
        setJobs(prev => {
          const newJobs = [...prev];
          newJobs.splice(index, 1); // Loại bỏ công việc khỏi mảng
          // Lưu vào local storage
          const jsonJobs = JSON.stringify(newJobs); //đổi dữ liệu mảng sang chuổi
          localStorage.setItem('jobs', jsonJobs);// lưu vào local storage key là "jobs"
          return newJobs;
        });
      }

/*---------------------Nút Edit-----------------------*/
const [editIndex, setEditIndex] = useState(-1);

const [editValue, setEditValue] = useState("");

const editJob = (index, value) => {
    setEditIndex(index);
    setEditValue(value);
  };
  
const handleEdit = (index) => {
    setJobs((prev) => {
        const newJobs = [...prev];
        newJobs[index] = editValue; // Cập nhật nội dung công việc đã chỉnh sửa vào danh sách công việc
        const jsonJobs = JSON.stringify(newJobs);
        localStorage.setItem('jobs', jsonJobs);
        return newJobs;
    });

    setEditIndex(-1);
  };


/*---------------------------------------------------------------------------------------------------------------------------------*/
return (
    <div className="wrapper" style={{ fontSize: '25px' }}>
      <div className="baitap2">
        <input
          value={addJob}
          onChange={e => setAddJob(e.target.value)}
          type="text"
          placeholder="Enter something"
        />
        <button onClick={handleSubmit}>Add</button>
        <ul>
          {jobs.map((job, index) => (
            <li key={index}>
                {editIndex === index ? (
                    //hiển thị nếu chỉ mục công việc đang được chỉnh sửa
                <input
                value={editValue}
                onChange={(e) => setEditValue(e.target.value)}
                type="text"
                placeholder="Enter something"
                />
                ) : (
                    // Hiển thị nội dung công việc thông thường nếu không được chỉnh sửa
            <div>{job}</div>
                )}
            <div style={{ fontSize: '30px' }}>
                {editIndex === index ? (
                    //check để hoàn thành chỉnh sửa và cập nhật nội dung công việc

                  <i
                    class='bx bxs-check-circle'
                    onClick={() => handleEdit(index)}
                  ></i>
                ) : (
                  <i
                    class='bx bx-edit'
                    onClick={() => editJob(index, job)}
                  ></i>
                )}
                <i
                  class='bx bxs-trash'
                  onClick={() => handleDelete(index)}
                ></i>
              </div>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
}
