import React, { useState } from "react";

/*
function Counter (){
  
  
  const [count, setCount] = useState(0);

  


  function handleButton(){
      
    setCount(count +1)
      
  
  }

  return <button onClick={handleButton}>Click me{count}</button>
}*/




class Counter extends React.Component{
  constructor(props){
    super(props);
    this.state = {count: 0}
  }

handleButton = () =>{
  this.setState (() => ({ count: this.state.count +1 })
      
 )
}

  render(){ 
    return <button onClick={this.handleButton}>Click me{this.state.count}</button>
   
  }

}

export default Counter;

 