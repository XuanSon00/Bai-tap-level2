import React from 'react';
import axios from 'axios';

export default class PersonList extends React.Component {
  state = {
    persons: []
  }

  componentDidMount() {
    axios.get(`https://jsonplaceholder.typicode.com/users`)
      .then(res => {
        const persons = res.data;
        this.setState({ persons });
      })
      .catch(error => console.log(error));
  }

  handleEdit = (person) => {
    // Xử lý logic khi nhấn nút sửa
    console.log('Edit', person);
  }

  handleDelete = (person) => {
    // Xử lý logic khi nhấn nút xóa
    const updatedPersons = this.state.persons.filter(p => p.id !== person.id);
    this.setState({ persons: updatedPersons });


  /*  axios.delete(`https://jsonplaceholder.typicode.com/users/${this.state.id}`)
      .then(res => {
        console.log(res);
        console.log(res.data);
      })
*/
  }

  render() {
    return (
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {this.state.persons.map(person => (
            <tr key={person.id}>
              <td>{person.name}</td>
              <td>
                <button onClick={() => this.handleEdit(person)}>Edit</button>
                <button onClick={() => this.handleDelete(person)}>Delete</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    )
  }
}
