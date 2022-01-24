const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const weightSchema = new Schema({
    username: { type: String, required: true },
    currentWeight: { type: Number, required: true },
    goalWeight: { type: Number, required: true },
    weeklyGoal: { type: Number, required: true },
    date: { type: Date, required: true },
}, {
    timestamps: true,
});

const weight = mongoose.model('Weight', weightSchema);

module.exports = weight;