import React, { Component } from 'react';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import axios from 'axios';

export default class CreateWeight extends Component {
    constructor(props) {
        super(props);

        //make sure the word "this" refers to the class within each method 
        this.onChangeCurrentWeight = this.onChangeCurrentWeight.bind(this);
        this.onChangeGoalWeight = this.onChangeGoalWeight.bind(this);
        this.onChangeWeeklyGoal = this.onChangeWeeklyGoal.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.onChangeDate = this.onChangeDate.bind(this);

        this.state = {
            username: '',
            currentWeight: '',
            goalWeight: '',
            weeklyGoal: '',
            date: new Date(),
        }
    }
    ///return user array based on info in database 
    componentDidMount() { //automatically called before page is loaded
        ///reqeust to get the logged in user
        axios.get('http://localhost:5000/signin/')
        .then(response => {
            this.setState({
                username: response.data[0].username
            })
        })


    }

    onChangeCurrentWeight(e) { ///function is called whenever someone changes the current weight
        this.setState(
            {
                currentWeight: e.target.value ///target ->textbox, value->text
            }
        )
    }

    onChangeGoalWeight(e) { ///function is called whenever someone changes the goal weight 
        this.setState(
            {
                goalWeight: e.target.value ///target ->textbox, value->text
            }
        )
    }

    onChangeWeeklyGoal(e) { ///function is called whenever someone changes the weekly goal 
        this.setState(
            {
                weeklyGoal: e.target.value ///target ->textbox, value->text
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

        const weight = {
            username: this.state.username,
            currentWeight: this.state.currentWeight,
            goalWeight: this.state.goalWeight,
            weeklyGoal: this.state.weeklyGoal,
            date:this.state.date
        }

        console.log(weight);
        ///send post request to backend 
        axios.post('http://localhost:5000/weights/add', weight)
            .then(res => console.log(res.data));

        alert("New Goal Added!");
    }

    render() {
        return (
            <div>
                <h3>Create New Goal</h3>
                <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                        <label>Username: {this.state.username}</label>
                    </div>
                    <div className="form-group">
                        <label>Current Weight: </label>
                        <input type="text"
                            required
                            className="form-control"
                            value={this.state.currentWeight}
                            onChange={this.onChangeCurrentWeight}
                        />
                    </div>
                    <div className="form-group">
                        <label>Goal Weight: </label>
                        <input
                            type="text"
                            className="form-control"
                            value={this.state.goalWeight}
                            onChange={this.onChangeGoalWeight}
                        />
                    </div>

                    <div className="form-group">
                        <label>Weekly Goal: </label>
                        <input
                            type="text"
                            className="form-control"
                            value={this.state.weeklyGoal}
                            onChange={this.onChangeWeeklyGoal}
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
                        <input type="submit" value="Create New Goal" className="btn btn-primary" />
                    </div>
                </form>
            </div>


        )
    }
}