import React, { Component } from 'react';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import axios from 'axios';

export default class CreateFood extends Component {
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
        console.log(this.state.date);
    }
    ///return user array based on info in database 
    componentDidMount() { //automatically called before page is loaded

        ///request to get logged in user
        axios.get('http://localhost:5000/signin/')
        .then(response => {
            if (response.data.length > 0) {
                this.setState({
                    username :response.data[0].username
                })
            }
           
        });
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

        ///send post request to backend 
        axios.post('http://localhost:5000/foods/add', food)
            .then(res => console.log(res.data));

        alert("Food added!");
        //window.location = "/foodlist";   //takes user back to the homepage (list of foods )
    }

    render() {
        return (
            <div>
                <h3>Create New Food Log</h3>
                <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                        <label>Username: {this.state.username}</label>
                    </div>
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
                        <input type="submit" value="Create Food Log" className="btn btn-primary" />
                    </div>
                </form>
            </div>


        )
    }
}