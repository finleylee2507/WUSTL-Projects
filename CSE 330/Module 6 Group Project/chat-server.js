let roomDict = {};
let roomCreator = {};
let roomBlacklist = {};
let muteDict = {};

// Require the packages we will use:
var http = require("http"),
    socketio = require("socket.io"),
    fs = require("fs");

// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp) {
    // This callback runs when a new connection is made to our HTTP server.

    fs.readFile("client.html", function(err, data) {
        // This callback runs when the client.html file has been read from the filesystem.

        if (err) return resp.writeHead(500);
        resp.writeHead(200);
        resp.end(data);
    });
});
app.listen(3456);
console.log('Server running at http://localhost:3456/');

// Do the Socket.IO magic:
var io = socketio.listen(app);
io.sockets.on("connection", function(socket) {
    // This callback runs when a new Socket.IO connection is established.
    //login 
    socket.on('login', function(data) {
        ///return all the keys in the room array
        let mutedUsers = new Array();
        muteDict[data['user']] = mutedUsers;
        socket.emit("roomList", { keySet: Object.keys(roomDict), rooms: roomDict })
        console.log(Object.keys(roomDict));
    })

    //mute another user
    socket.on('mute', function(data) {
        let mutedUser = data['mutedUser'];
        let user = data['me'];
        muteDict[user].push(mutedUser);
    })

    //send DM
    socket.on('direct_message', function(data) {
        let currentUser = data['me'];
        let otherUser = data['other'];
        let message = data['dm'];
        if (!muteDict[otherUser].includes(currentUser)) {
            io.sockets.emit("alertDM", { sender: currentUser, recipient: otherUser, msg: message, canSend: true });
        } else {
            io.sockets.emit("alertDM", { sender: currentUser, recipient: otherUser, msg: message, canSend: false });
        }
    })

    //create room
    socket.on('createRoom', function(data) {
        socket.join(data['room']); //join room
        let userList = new Array(); ///new array to hold the users for the room
        userList.push(data['user']) //add user to the array
        roomDict[data['room']] = userList; //add user array to the roomDict under the correct room key 
        roomCreator[data['room']] = data['user']; //add user to list of room creators 
        let banUserList = new Array(); //create blacklist for that room 
        roomBlacklist[data['room']] = banUserList; //add blacklist to dictionary 
        console.log(roomDict);
        io.sockets.to(data['room']).emit("userList", { users: roomDict[data['room']], creator: roomCreator[data['room']] }); //send to client the list of user 
    })

    //create private room
    socket.on('createPrivateRoom', function(data) {
        socket.join(data['room']); //join room
        let userList = new Array(); ///new array to hold the users for the room
        userList.push(`Password:${data['pass']}`); //add the password to the userList in the first index
        userList.push(data['user']) //add user to the array
        roomDict[data['room']] = userList; //add user array to the roomDict under the correct room key 
        roomCreator[data['room']] = data['user']; //add user to list of room creators
        let banUserList = new Array(); //create blacklist for that room 
        roomBlacklist[data['room']] = banUserList; //add blacklist to dictionary 
        console.log(roomDict);
        io.sockets.to(data['room']).emit("userList", { users: roomDict[data['room']], creator: roomCreator[data['room']] }); //send to client the list of user 
    })

    //join room
    socket.on('joinRoom', function(data) {
        let status = 1;
        //check whether user is banned 
        for (let i = 0; i < roomBlacklist[data['room']].length; i++) {
            if (data['user'] == roomBlacklist[data['room']][i]) { //if user on the blacklist
                console.log("Found blacklist user");
                io.sockets.emit("fail_to_join", { user: data['user'] });
                status = 0;
                console.log(status);
            }
        }
        //else let the user in 
        if (status == 1) {
            socket.join(data['room']);
            roomDict[data['room']].push(data['user']);
            console.log(roomDict);
            socket.to(data['room']).emit("newUser", { user: data['user'] }); //send back to client the username that has joined
            io.sockets.to(data['room']).emit("userList", { users: roomDict[data['room']], creator: roomCreator[data['room']] }); //send to client the list of user
            socket.emit("join_success", { user: data['user'], roomName: data['room'] });
        }
    })

    //leave room
    socket.on('leaveRoom', function(data) {
        socket.leave(data['room']);
        let index = roomDict[data['room']].indexOf(`${data["user"]}`);
        roomDict[data['room']].splice(index, 1); //delete user from the list of connected user in the user array 
        console.log(roomDict);
        io.sockets.to(data['room']).emit("userLeft", { user: data['user'] }); //send back to client the username that just left
        io.sockets.to(data['room']).emit("userList", { users: roomDict[data['room']], creator: roomCreator[data['room']] });
        socket.emit("roomList", { keySet: Object.keys(roomDict), rooms: roomDict });
    })

    //kick user 
    socket.on('kickUser', function(data) {
        console.log(`Warning message sent, kicked user is ${data['user']}`);
        io.sockets.to(data['room']).emit("message_to_kicked_user", { user: data['user'], creator: roomCreator[data['room']] });
    })

    //ban user
    socket.on('banUser', function(data) {
        console.log(`Warning message sent, banned user is ${data['user']}`);
        roomBlacklist[data['room']].push(data['user']); //add user to blacklist for that room 
        ///send a message to user 
        io.sockets.to(data['room']).emit("message_to_banned_user", { user: data['user'], creator: roomCreator[data['room']] });
        console.log(roomBlacklist);
    })

    socket.on('message_to_server', function(data) {
        // This callback runs when the server receives a new message from the client.
        //test
        // console.log("message: "+data["message"]); // log it to the Node.JS output

        console.log(`New Message received from the user ${data["user"]}: ${data["message"]}, the time is ${data["time"]}`);
        io.sockets.to(data['room']).emit("message_to_client", { user: data["user"], message: data["message"], time: data["time"] }) // broadcast the message to other users
    });
});