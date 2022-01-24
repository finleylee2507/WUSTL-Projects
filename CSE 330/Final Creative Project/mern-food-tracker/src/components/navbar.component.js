import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';



export default class Navbar extends Component {

    constructor(props) {
        super(props);

        this.state = {
            show: false
        }
    }

    ///method to check logged in or not
    componentDidMount() {
        axios.get('http://localhost:5000/signin/')
            .then(response => {
                if (response.data.length > 0) {
                    this.setState({
                        show: true
                    })
                }

                else {
                    this.setState({
                        show: false
                    })
                }
            })
    }

    render() {
        return (
            <nav className="navbar navbar-dark bg-dark navbar-expand-lg">
                
                <Link to="/" className="navbar-brand">FoodTracker</Link>
                <div className="collpase navbar-collpase">
                   {
                       this.state.show?
                       <ul className="navbar-nav mr-auto">
                       <li className="navbar-item">
                           <Link to="/foodlist" className="nav-link">Foods</Link>
                       </li>
                       <li className="navbar-item">
                           <Link to="/weights" className="nav-link">Goals</Link>
                       </li>
                       <li className="navbar-item">
                           <Link to="/create" className="nav-link">Add New Food</Link>
                       </li>
                       <li className="navbar-item">
                           <Link to="/weights/create" className="nav-link">Add New Goal</Link>
                       </li>
                       <li className="navbar-item">
                           <Link to="/user" className="nav-link">Create User</Link>
                       </li>
                   </ul>
                   :
                   <ul className="navbar-nav mr-auto">
                       <li className="navbar-item">
                           <Link to="/user" className="nav-link">Create User</Link>
                       </li>
                   </ul>
                   }
                </div>
            </nav>
        )
    }
}