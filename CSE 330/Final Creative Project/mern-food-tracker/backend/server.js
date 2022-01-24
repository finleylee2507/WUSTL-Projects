const express = require('express');
const cors = require('cors');
const mongoose = require('mongoose');

require('dotenv').config();

const app = express();
const port = process.env.PORT || 5000;

app.use(cors());
app.use(express.json());

const uri = process.env.ATLAS_URI;
mongoose.connect(uri, { useNewUrlParser: true, useCreateIndex: true, useUnifiedTopology: true });
const connection = mongoose.connection;
connection.once('open', () => {
    console.log("MongoDB database connection established successfully.");
})

const foodRouter = require('./routes/foods');
const userRouter = require('./routes/users');
const sessionRouter = require('./routes/signin');

app.use('/foods', foodRouter); ///load food router
app.use('/users', userRouter); ///load user router 
app.use('/signin', sessionRouter); ///load session router 
const weightRouter=require('./routes/weights');
app.use('/weights', weightRouter); ///load weights router 

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
})