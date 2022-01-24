const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const userSessionSchema = new Schema({
    username: {
        type: String,
        default: -1
    },
}, {
    timestamps: true,
});

const userSession = mongoose.model('UserSession', userSessionSchema);

module.exports = userSession;