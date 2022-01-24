import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

///functional React component (doesn't have states and not in separate file)
const Food = props => (
  <tr>
    <td>{props.food.username}</td>
    <td>{props.food.description}</td>
    <td>{props.food.calories}</td>
    <td>{props.food.date.substring(0,10)}</td>
    <td>
      <Link to={"/edit/"+props.food._id}>edit</Link> | <a href="#" onClick={() => { props.deleteFood(props.food._id) }}>delete</a>
    </td>
  </tr>
)

///class component 
export default class FoodList extends Component {
  constructor(props) {
    super(props);
    
    //make sure the word "this" refers to the class within each method 
    this.deleteFood = this.deleteFood.bind(this)

    this.state = {
      foods: [],
      username: '',
    };
  }

  componentDidMount() {
    axios.get('http://localhost:5000/signin/')
      .then(response => {
        this.setState({
          username: response.data[0].username
        })
      })
      .catch((error) => {
        console.log(error);
      })

    axios.get('http://localhost:5000/foods/')
      .then(response => {
        this.setState({ foods: response.data })
      })
      .catch((error) => {
        console.log(error);
      })
  }

  ///method for delete 
  deleteFood(id) {
    axios.delete('http://localhost:5000/foods/'+id)
      .then(response => { console.log(response.data)})
      .then(alert("Food successfully deleted!"))
   ///return new list of foods (array )
    this.setState({
      foods: this.state.foods.filter(el => el._id !== id) ///list all the foods whose id is not the deleted id 
    })
  }

  ///foodList method 
  foodList() {
    ///iterate through the list of food items and output each food with the Food component (a row of the table)
    return this.state.foods.map(currentfood => {
      if (currentfood.username === this.state.username){
        return <Food food={currentfood} deleteFood={this.deleteFood} key={currentfood._id}/>;
      }
    })
  }

  render() {
    return (
      <div>
        <h3>Logged Food</h3>
        <table className="table">
          <thead className="thead-light">
            <tr>
              <th>Username</th>
              <th>Description</th>
              <th>Calories</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            { this.foodList() }
          </tbody>
        </table>
      </div>
    )
  }
}