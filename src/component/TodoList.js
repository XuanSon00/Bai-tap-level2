import React from "react";


class AddTodo extends React.Component{
    constructor(props) {
      super(props);
      this.state = {input : ''}
    }

    updateInput = () =>{
        this.setState({ input })
    }


    handleAdd = () =>{
        this.props.AddTodo(this.state.input)



    }
render(){
    return(
        <div>
            <input 
            onChange={e => this.updateInput(e.target.value)}
            value={this.state.input}
            />
            <button className="todolist" onClick={this.handleAdd}>Add</button>
        </div>
    )
}

}

export default AddTodo