import React from "react";
import { useState } from "react";
import './Slide.css'



const Slideshow = () => {
const [currentSlide, setCurrentSlide] = useState(0)
const slides = [
    'https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg',
    'https://img.freepik.com/premium-photo/aesthetic-synthwave-background_398492-14116.jpg',
    'https://img.freepik.com/free-photo/glowing-lines-human-heart-3d-shape-dark-background-generative-ai_191095-1435.jpg',
    'https://images.pexels.com/photos/1366957/pexels-photo-1366957.jpeg?cs=srgb&dl=pexels-irina-iriser-1366957.jpg&fm=jpg'
]

const showslide =(index) =>{
    setCurrentSlide(index)
}

const nextSlide= () =>{
    let nextSlide = currentSlide +1;
    if (nextSlide >= slides.length) {
        nextSlide = 0
    }
    setCurrentSlide(nextSlide)
    //console.log(nextSlide)
}

const prevSlide= () =>{
    let prevSlide = currentSlide -1;
    if (prevSlide <= slides.length) {
        prevSlide = 0
    }
    setCurrentSlide(prevSlide)
    //console.log(prevSlide)
}





return (
    <div>
    <div className="slideshow">
    { slides.map((slide, index) =>(
        <img
        key = {index}
        src = { slide } 
        alt ={ '{index +1}'}
        className={index === currentSlide ? 'slide' : 'slide hidden'}
        />
    ))}
    <div className="prev-next">
    <button onClick={prevSlide} id="prevBtn"> {"<"} </button>
    <button onClick={nextSlide} id="nextBtn"> {">"} </button>

    </div>
    </div></div>
)
};
export default Slideshow