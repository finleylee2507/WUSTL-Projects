import React, { Component } from 'react';
import axios from 'axios';
import "react-datepicker/dist/react-datepicker.css";

export default class EditFoods extends Component {
    constructor(props) {
        super(props);

        //make sure the word "this" refers to the class within each method 
        this.onChangeUsername = this.onChangeUsername.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.onLogout = this.onLogout.bind(this);

        this.state = {
            show: true,
            logged: false,
            username: '',
            users: [],
        }
    }
    ///return user array based on info in database 
    componentDidMount() { //automatically called before page is loaded
        axios.get('http://localhost:5000/users/')
            .then(response => {
                if (response.data.length > 0 && !this.state.logged) {
                    this.setState({
                        users: response.data.map(user => user.username), ///for each element in the data array, keep it's username 
                        username: response.data[0].username ///username automatically set to the first user in the database 
                    })
                }
            })
            .catch(error => {
                alert(error)
            });

        axios.get('http://localhost:5000/signin/')
            .then(response => {
                if (response.data.length > 0) {
                    this.setState({
                        username: response.data[0].username,
                        show: false,
                        logged: true
                    })
                }
                else {
                    this.setState({
                        show: true,
                    })
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

    onChangeUsername(e) { ///function is called whenever someone changes the username 
        this.setState(
            {
                username: e.target.value, ///target ->textbox, value->text
            }
        )
    }

    onSubmit(e) {
        e.preventDefault(); //prevent default html form submit behaviors 
        
        const show = this.state.show;
        this.setState({show: !show});

        const user = {
            username: this.state.username,
        }

        ///send post request to backend 
        axios.post('http://localhost:5000/signin/add/', user)
            .then(res => {
                console.log(res.data)
                this.setState({
                    username: user,
                    successLogin: true,
                    successLogout: false
                })
            })
            .catch(error=>{
                alert("Error")
            });
            window.location = "/create";
    }

    onLogout(e) {
        e.preventDefault();

        const show = this.state.show;
        this.setState({
            show: !show,
            logged: false
        });

        axios.delete('http://localhost:5000/signin/delete')
            .then(response => { 
                console.log(response.data)
                this.setState ({
                    username: '',
                    successLogin: false,
                    successLogout: true
                })
            })
            .catch(error=>{
                alert("Error")
            });
            window.location = "/";
    }

    render() {
        return (
            <div>
                <h3>Login</h3>
                {/* before logged in  */}
                {
                    this.state.show?
                    <div className="login">
                    <form onSubmit={this.onSubmit}>
                        <div className="form-group">
                            <label>Username: </label>
                            {/* drop down menu */}
                            <select ref="userInput"
                                required
                                className="form-control"
                                value={this.state.username}
                                onChange={this.onChangeUsername}>
                                {/* iterate over the users array and return select box */}
                                {
                                    this.state.users.map(function (user) {
                                        return <option
                                            key={user}
                                            value={user}>{user}
                                        </option>;
                                    })
                                }
                            </select>
                        </div>
                        <div className="form-group">
                            <input type="submit" value="Login" className="btn btn-primary" />
                        </div>
                    </form>
                </div>
                : null
                }

                {/* after logged in  */}
                {
                    this.state.show?null
                    :<form onSubmit={this.onLogout}>
                        <div className="form-group">
                            <label>Logged in as: {this.state.username}</label>
                        </div>
                        <div className="form-group">
                            <input type="submit" value="Logout" className="btn btn-primary"/>
                        </div>
                    </form>
                }
            </div>
        )
    }
}