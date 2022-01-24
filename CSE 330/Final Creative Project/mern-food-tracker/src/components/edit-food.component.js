import React, { Component } from 'react';
import axios from 'axios';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";


export default class EditFoods extends Component {
    constructor(props) {
        super(props);

        //make sure the word "this" refers to the class within each method 
        this.onChangeCalories = this.onChangeCalories.bind(this);
        this.onChangeDescription = this.onChangeDescription.bind(this);
        this.onChangeDate = this.onChangeDate.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

        this.state = {
            username: '',
            description: '',
            calories: '',
            date: new Date(),
        }
    }
    ///return user array based on info in database 
    componentDidMount() { //automatically called before page is loaded
        axios.get('http://localhost:5000/foods/' + this.props.match.params.id) ///get id from the url 
            .then(response => {
                this.setState({
                    username: response.data.username,
                    description: response.data.description,
                    calories: response.data.calories,
                    date: new Date(response.data.date)
                })
                console.log(this.state.date)
            })
            .catch(function (error) {
                console.log(error);
            })
        ///reqeust to get the logged in user
        axios.get('http://localhost:5000/signin/')
            .then(response => {
                this.setState({
                    username: response.data[0].username
                })
            })


    }

    onChangeDescription(e) { ///function is called whenever someone changes the description
        this.setState(
            {
                description: e.target.value ///target ->textbox, value->text
            }
        )
    }

    onChangeCalories(e) { ///function is called whenever someone changes the calories
        this.setState(
            {
                calories: e.target.value ///target ->textbox, value->text
            }
        )
    }

    onChangeDate(date) { ///function is called whenever someone changes the date
        this.setState(
            {
                date: date ///target ->textbox, value->text
            }
        )
    }

    onSubmit(e) {
        e.preventDefault(); //prevent default html form submit behaviors 

        const food = {
            username: this.state.username,
            description: this.state.description,
            calories: this.state.calories,
            date: this.state.date
        }

        console.log(food);
        ///send post request to backend 
        axios.post('http://localhost:5000/foods/update/' + this.props.match.params.id, food)
            .then(res => console.log(res.data))
            .catch(error => {alert(error)});
        alert("Food log updated!");
        // window.location = "/foodlist";   //takes user back to the homepage (list of foods )
    }

    render() {
        return (
            <div>
                <h3>Edit Food Log</h3>
                <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                        <label>Description: </label>
                        <input type="text"
                            required
                            className="form-control"
                            value={this.state.description}
                            onChange={this.onChangeDescription}
                        />
                    </div>
                    <div className="form-group">
                        <label>Calories: </label>
                        <input
                            type="text"
                            className="form-control"
                            value={this.state.calories}
                            onChange={this.onChangeCalories}
                        />
                    </div>
                    <div className="form-group">
                        <label>Date: </label>
                        <div>
                            <DatePicker
                                selected={this.state.date}
                                onChange={this.onChangeDate}
                            />
                        </div>
                    </div>

                    <div className="form-group">
                        <input type="submit" value="Edit Food Log" className="btn btn-primary" />
                    </div>
                </form>
            </div>


        )
    }







}