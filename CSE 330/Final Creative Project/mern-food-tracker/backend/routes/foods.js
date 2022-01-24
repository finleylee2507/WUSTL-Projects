const router = require('express').Router();
let Food = require('../models/food.model');

///return a list of food from database when there's a get request 
router.route('/').get((req, res) => {
    Food.find()
        .then(food => res.json(food))
        .catch(err => res.status(400).json('Error: ' + err));
});
//add a new food when there's a post request 
router.route('/add').post((req, res) => {
    const username = req.body.username;
    const description = req.body.description;
    const calories = Number(req.body.calories);
    const date = Date.parse(req.body.date);

    const newFood = new Food({
        username,
        description,
        calories,
        date,
    });

    newFood.save()
        .then(() => res.json('Food added!'))
        .catch(err => res.status(400).json('Error: ' + err));
});
///find food by id 
router.route('/:id').get((req, res) => {
    Food.findById(req.params.id)
        .then(food => res.json(food))
        .catch(err => res.status(400).json('Error: ' + err));
});
///delete food by id 
router.route('/:id').delete((req, res) => {
    Food.findByIdAndDelete(req.params.id)
        .then(() => res.json('Food deleted.'))
        .catch(err => res.status(400).json('Error: ' + err));
});
//update food by id 
router.route('/update/:id').post((req, res) => {
    Food.findById(req.params.id)
        .then(food => {
            food.username = req.body.username;
            food.description = req.body.description;
            food.calories = Number(req.body.calories);
            food.date = Date.parse(req.body.date);

            food.save()
                .then(() => res.json('Food updated!'))
                .catch(err => res.status(400).json('Error: ' + err));
        })
        .catch(err => res.status(400).json('Error: ' + err));
});

module.exports = router;