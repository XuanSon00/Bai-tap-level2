import React, { useState } from "react";
import "./Register.css"


const initFormValue = {
name: "",
address: "",
zipcode: "",
gender: "",
preferences: "",
phone: "",
password: "",
confirmPassword: ""
}

const EmptyValue = (value) => {  
    return !value || value.trim().length < 1;
}

const EmailValid = (email) => {
    return  /^[\w.-]+@\w+(\.\w{2,3})+$/.test(email);
  };
  



export default function RegisterPage(){
    const  [formValue, setformValue] = useState(initFormValue);
    const  [formError, setformError] = useState({});

    const validateForm = () =>{
        const error ={};

        setformError(error);

        if(EmptyValue(formValue.Name)){
            error["Name"] = "Name is required";
        }
        if(EmptyValue(formValue.Address)){
            error["Address"] = "Address is required";
        }
        if(EmptyValue(formValue.Zipcode)){
            error["Zipcode"] = "Zipcode is required";
        }
        if (EmptyValue(formValue.gender)) {
            error["gender"] = "Gender is required";
          }
        if(EmptyValue(formValue.preferences)){
            error["preferences"] = "preferences is required";
        }
        if(EmptyValue(formValue.phone)){
            error["phone"] = "phone is required";
        }
        if(EmptyValue(formValue.email)){
            error["email"] = "email is required";
        }else {
            if(!EmailValid(formValue.email)){
                error["email"] = "email is invalid";
            }
        }
        if(EmptyValue(formValue.password)){
            error["password"] = "password is required";
        }
        if(EmptyValue(formValue.confirmPassword)){
            error["confirmPassword"] = "confirm Password is required";
        } else if (formValue.confirmPassword !== formValue.password){
            error["confirmPassword"] =  "confirm Password not match "
        }


        return Object.keys(error).length === 0;
    };

    const handleChange = (event) =>{
        const { value, name } = event.target;
        setformValue({
            ...formValue,
            [name]: value,
        });
    };

    const handleSubmit = (event) =>{
        event.preventDefault();

        if(validateForm()){
            console.log('form value', formValue)
        } else {
            console.log('form invalid')
        }
        console.log("form-value", formValue)
    }


    console.log(formError);

    return (
    <div className="register-page">
        <div className="register-form-container">
            <h1 className="tittle">Validation</h1>

        <form onSubmit={handleSubmit}>
            <div className="info">
                <label htmlFor="name" className="form-label">
                Name
                </label>
                <input 
                    id="name"
                    className="form-control"
                    type="text"
                    name="Name"
                    value={formValue.Name}
                    onChange={handleChange}
                />
                {formError.Name && (
                    <div className="error-feedback">{formError.Name}</div>
                )}
            </div>

            <div className="info"> 
                <label htmlFor="address" className="form-label">
                Address
                </label>
                <input 
                    id="address"
                    className="form-control"
                    type="text"
                    name="Address"
                    value={formValue.Address}
                    onChange={handleChange}
                />
                {formError.Address && (
                    <div className="error-feedback">{formError.Address}</div>
                )}
            </div>

            <div className="info">
                <label htmlFor="zipcode" className="form-label">
                Zipcode
                </label>
                <input 
                    id="zipcode"
                    className="form-control"
                    type="text"
                    name="Zipcode"
                    value={formValue.Zipcode}
                    onChange={handleChange}
                />
                {formError.Zipcode && (
                    <div className="error-feedback">{formError.Zipcode}</div>
                )}
            </div>

            <div className="info">
                <span htmlFor="gender" className="form-label" >
                Gender: 
                </span>
                {formError.gender && (
                    <div className="error-feedback" >{formError.gender}</div>
)}
                <input 
                    id="male"
                    className="form-control"
                    type="radio"
                    name="gender"
                    value="male"
                    checked={formValue.gender === 'male'}
                    onChange={handleChange}
                    
                />
                <label htmlFor="male">Male</label>

                <input 
                    id="female"
                    className="form-control"
                    type="radio"
                    name="gender"
                    value ="female"
                    checked={formValue.gender === 'female'}
                    onChange={handleChange}
                  
                />
                <label htmlFor="female">Female</label>
                
            </div>


            <div className="info">
                <label htmlFor="preferences" className="form-label">
                Preferences
                </label>
                <input 
                    id="preferences"
                    className="form-control"
                    type="text"
                    name="preferences"
                    value={formValue.preferences}
                    onChange={handleChange}
                />
                {formError.preferences && (
                    <div className="error-feedback">{formError.preferences}</div>
                )}
            </div>

            <div className="info">
                <label htmlFor="phone" className="form-label">
                Phone
                </label>
                <input 
                    id="phone"
                    className="form-control"
                    type="number"
                    name="phone"
                    value={formValue.phone}
                    onChange={handleChange}
                />
                {formError.phone && (
                    <div className="error-feedback">{formError.phone}</div>
                )}
            </div>

            <div className="info">
                <label htmlFor="email" className="form-label">
                Email
                </label>
                <input 
                    id="email"
                    className="form-control"
                    type="text"
                    name="email"
                    value={formValue.email}
                    onChange={handleChange}
                />
            </div>
            {formError.email && (
                    <div className="error-feedback">{formError.email}</div>
                )}

            <div className="info">
                <label htmlFor="password" className="form-label">
                Password
                </label>
                <input 
                    id="password"
                    className="form-control"
                    type="password"
                    name="password"
                    value={formValue.password}
                    onChange={handleChange}
                />
                {formError.password && (
                    <div className="error-feedback">{formError.password}</div>
                )}
            </div>

            <div className="info">
                <label htmlFor="confirm-password" className="form-label">
                Verify Password
                </label>
                <input 
                    id="confirm-password"
                    className="form-control"
                    type="password"
                    name="confirmPassword"
                    value={formValue.confirmPassword}
                    onChange={handleChange}
                />
                {formError.confirmPassword && (
                    <div className="error-feedback">{formError.confirmPassword}</div>
                )}
            </div>
            
            <button type="submit" className="submit-btn">Submit</button>

        </form>


        </div>
         </div>
         );
}