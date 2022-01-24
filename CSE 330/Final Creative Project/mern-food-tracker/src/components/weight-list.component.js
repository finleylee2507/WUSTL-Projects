import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

///functional React component (doesn't have states and not in separate file)
const Weight = props => (
  <tr>
    <td>{props.weight.username}</td>
    <td>{props.weight.currentWeight}</td>
    <td>{props.weight.goalWeight}</td>
    <td>{props.weight.weeklyGoal}</td>
    <td>{props.weight.date.substring(0, 10)}</td>
    <td>
      <Link to={"/editweight/" + props.weight._id}>edit</Link> | <a href="#" onClick={() => { props.deleteWeight(props.weight._id) }}>delete</a>
    </td>
  </tr>
)

///class component 
export default class WeightList extends Component {
  constructor(props) {
    super(props);

    //make sure the word "this" refers to the class within each method 
    this.deleteWeight = this.deleteWeight.bind(this)
    this.calculator=this.calculator.bind(this)
    
    this.state = {
      weights: [],
      username: '',
      age: 20,
      height: 70,
    };
  }

  componentDidMount() {
    axios.get('http://localhost:5000/weights/')
      .then(response => {
        this.setState({ weights: response.data })
      })
      .catch((error) => {
        console.log(error);
      })
    // console.log(this.state.weights[0].currentWeight);

    axios.get('http://localhost:5000/signin/')
      .then(response => {
        this.setState({
          username: response.data[0].username
        })
      })
      .catch((error) => {
        console.log(error);
      })

    // ///calculate BMR
    // //  iterate through the weights array
    //  this.state.weights.map(currentweight => {
    //   if (currentweight.username === this.state.username){
    //     this.setState({
    //       BMR:currentweight.currentWeight
    //     })
    //   }
    // })

  }
  ///method for delete 
  deleteWeight(id) {
    axios.delete('http://localhost:5000/weights/' + id)
      .then(response => { console.log(response.data) })
      .then(alert("Goal successfully deleted!"));
    ///return new list of weights (array )
    this.setState({
      weights: this.state.weights.filter(el => el._id !== id) ///list all the weights whose id is not the deleted id 
    })
  }

  ///weightList method 
  weightList() {
    ///iterate through the list of weight items and output each weight with the Weight component (a row of the table)
    return this.state.weights.map(currentweight => {
      if (currentweight.username === this.state.username) {
        return <Weight weight={currentweight} deleteWeight={this.deleteWeight} key={currentweight._id} />;
      }
    })
  }

  ///calculator method
  calculator() {
    let temp=0;
    let BMR=0;
    //iterate through the weights array
    this.state.weights.map(currentweight => {
      if (currentweight.username === this.state.username) {
        temp+=currentweight.currentWeight;
        BMR= 66.47+(6.24*temp) + (12.7*this.state.height) - (6.755*this.state.age);
      }
    })
    return <p>Your BMR(Basal Metabolic Rate) is {BMR}</p>
  }

  render() {
    return (
      <div>
        <h3>Goals</h3>

        <div> {this.calculator()}</div>
        
        <table className="table">
          <thead className="thead-light">
            <tr>
              <th>Username</th>
              <th>Current Weight</th>
              <th>Goal Weight</th>
              <th>Weekly Goal</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {this.weightList()}
          </tbody>
        </table>
      </div>
    )
  }
}