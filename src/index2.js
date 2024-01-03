*import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
/*import MyForm from './Form.js';*/
import App from './App';
/*
const Submit = (event) =>{
  setShowErrors(true);
}

const showErrors = true;

ReactDOM.render(
  React.createElement(
    MyForm,
    { onSubmit: Submit, className: showErrors ? 'show-error' : '' }
    ),

  document.getElementById('root')
);
*/
















/*
function HOC(wrappedComponent, selectData) {

  return class extends React.Component{
    constructor(props){
      super(props);
      this.state = {
        count:0,
      }
    }

    increment = () =>{
    }
    render() {
      return <wrappedComponent increment = {this.increment} count={this.state.count} {...this.props} />
    }
  }
}
//step2

const HoverCounter2 = HOC(HoverCounter,0)*/



const [modalOpen, setModalOpen] = useState(false);


return(
    <div className='App'>
    <TodoList setModalOpen={setModalOpen} />

      {modalOpen && <Modal closeModal={() =>{
        setModalOpen(false)} }/>}
      
    </div>

//import Todolist2 from './Todolist2/Todolist2';
//import { Counter, Button } from './Count';

/*
const handleButton=  () => {
   console.log('Button clicked');
 };
*/


   /*
   <div>
   <Counter count = {0} />
   <Button onClick={handleButton} />
 </div>*/



