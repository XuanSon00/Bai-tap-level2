import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'boxicons/css/boxicons.min.css';
import { Provider } from 'react-redux';
import Appcounter2 from './component/Appcounter2';
import store2 from './store/index2';
import Counter2 from './component/Counter2';
import Appcounter3 from './component/Appcounter3';
import store3 from  './store/index3'
import Counter3 from './component/Counter3';
/*import {
  BrowserRouter,
  createBrowserRouter,
  RouterProvider,useSearchParams,
  Route, Form,
  Link,Routes,Outlet,useParams,useLoaderData,NavLink,createRouterFromElements,Navigate
} from 'react-router-dom'*/ 



import{
  BrowserRouter,Routes,Route
} from 'react-router-dom'
/*
import Home from './Page/Home.jsx'
import About from './Page/About.jsx';
import Page from './Page/Page.jsx';
import Error from './Page/Error.jsx';
import User from './Page/User.jsx';
*/

import Home from './Header/Home.jsx';
import Phone from './Header/Phone.jsx';
import Tablet from './Header/Tablet.jsx';
import Error from './Header/Error.jsx';

import Foot from './Footer/Foot.js';
/*
function Counter (){
  
  
  const [count, setCount] = useState(0);

  


  function handleButton(){
      
    setCount(count +1)
      
  
  }

  return <button onClick={handleButton}>Click me{count}</button>
}*/

/*
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

ReactDOM.render(
  



  <React.StrictMode>
    <Counter />

  </React.StrictMode>,
  document.getElementById('root')
);
*/

/*
class Counter5 extends React.Component{
  constructor(props) {
    super(props);
    this.state = { count : 0}
  }
  increase = () =>{
    console.log(1)
    this.setState(() => ({count: this.state.count + 1}))
  }
  render(){
    return() {
      return <>
      <h1>Cont : { this.state.count }</h1>
      <button onClick={this.increase}>Click</button>
      </>
    }
  }
}*/

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <>

{/*<BrowserRouter> */}
{/*phần render */}
{/* 
<Routes>
<Route path ='/' element={<Home />} >
  <Route path ='page' element={<Page />} />
  <Route path ='about' element={<About />} />
</Route>
<Route path='user/:userId' element={<User />}/>


<Route path='*' element={<Error />}/>

</Routes>
</BrowserRouter>*/}
 






<BrowserRouter> 
<Routes>
  <Route path = '/' element ={<Home />}>
      <Route path = 'phone' element ={<Phone />}></Route>
      <Route path = 'tablet' element ={<Tablet />}></Route>
      <Route path ='//' element ={<Foot />}></Route>

  </Route>
  <Route path='*' element={<Error />}/>
  
</Routes>


</BrowserRouter> 

</>
);

/*
ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
);
*/

/*
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <>
<Provider store={store3}>
<Counter3 />

</Provider>
</>
)*/

