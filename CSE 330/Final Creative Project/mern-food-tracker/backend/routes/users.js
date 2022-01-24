const router = require('express').Router();
let User = require('../models/user.model');

///get a list of all the users from the database if there's a get request 
router.route('/').get((req, res) => {
    User.find() ///query database 
        .then(users => res.json(users)) //return result in JSON format 
        .catch(err => res.status(400).json('Error: ' + err));
});

//add a user in the database if there's a post request 
router.route('/add').post((req, res) => {
    const username = req.body.username;

    const newUser = new User({ username }); //create a new instance of user using username 

    newUser.save()  //new user saved to database 
        .then(() => res.json('User added!'))
        .catch(err => res.status(400).json('Error: ' + err));
});

module.exports = router; //export router 