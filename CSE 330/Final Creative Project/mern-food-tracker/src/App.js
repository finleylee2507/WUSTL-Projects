import React from 'react';
import { BrowserRouter as Router, Route } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";

import Navbar from "./components/navbar.component";
import FrontPage from "./components/front.component";
import FoodsList from "./components/foods-list.component";
import EditFood from "./components/edit-food.component";
import CreateFood from "./components/create-food.component";
import CreateUser from "./components/create-user.component"; 
import WeightList from './components/weight-list.component';
import CreateWeight from  './components/create-weight.component';
import EditWeight from './components/edit-weight.component';


function App() {
    return (
        <Router>
            <div className="container">
                <Navbar />
                <br/>
                {/* map an url path to a specific component  */}
                <Route path="/nav" exact component={Navbar} />
                <Route path="/" exact component={FrontPage} />
                <Route path="/foodlist" exact component={FoodsList} />
                <Route path="/weights" exact component={WeightList}/>
                <Route path="/edit/:id" exact component={EditFood} />
                <Route path="/editweight/:id" exact component={EditWeight} />
                <Route path="/create" exact component={CreateFood} />
                <Route path="/user" exact component={CreateUser} />
                <Route path="/weights/create" exact component={CreateWeight}/>
            </div>
        </Router>
    );
}

export default App;