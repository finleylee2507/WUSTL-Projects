const router = require('express').Router();
let Weight= require('../models/weight.model');

///return a list of usernames and weight from database when there's a get request 
router.route('/').get((req, res) => { 
    Weight.find()
        .then(weight => res.json(weight))
        .catch(err => res.status(400).json('Error: ' + err));
});
//add a new weight when there's a post request 
router.route('/add').post((req, res) => {
    const username = req.body.username;
    const currentWeight = Number(req.body.currentWeight);
    const goalWeight = Number(req.body.goalWeight);
    const weeklyGoal = Number(req.body.weeklyGoal);
    const date = Date.parse(req.body.date);

    const newWeight = new Weight({
        username,
        currentWeight,
        goalWeight,
        weeklyGoal,
        date,
    });

    newWeight.save()
        .then(() => res.json('Weights added!'))
        .catch(err => res.status(400).json('Error: ' + err));
});
///find weight by id 
router.route('/:id').get((req, res) => {
    Weight.findById(req.params.id)
        .then(weight => res.json(weight))
        .catch(err => res.status(400).json('Error: ' + err));
});
///delete weight by id 
router.route('/:id').delete((req, res) => {
    Weight.findByIdAndDelete(req.params.id)
        .then(() => res.json('Weights deleted.'))
        .catch(err => res.status(400).json('Error: ' + err));
});
//update weight by id 
router.route('/update/:id').post((req, res) => {
    Weight.findById(req.params.id)
        .then(weight => {
            weight.username = req.body.username;
            weight.currentWeight = Number(req.body.currentWeight);
            weight.goalWeight = Number(req.body.goalWeight);
            weight.weeklyGoal= Number(req.body.weeklyGoal);
            weight.date=Date.parse(req.body.date);

            weight.save()
                .then(() => res.json('Weights updated!'))
                .catch(err => res.status(400).json('Error: ' + err));
        })
        .catch(err => res.status(400).json('Error: ' + err));
});

module.exports = router;