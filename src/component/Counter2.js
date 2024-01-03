import React, { Component } from 'react';
//import Counter from '../Test';

class Counter2 extends React.Component{
    render() {
      return <>
      <h1> Count : {this.props.counter.count}</h1>
      <button onClick={this.props.increase}>Click</button>
      <button onClick={this.props.decrease}>Click-</button>
      </>
    
    }
  }
export default Counter2;
//<h1>Count : {this.props.counter.count}</h1>
        //<button onClick={this.props.increase}>Click</button>