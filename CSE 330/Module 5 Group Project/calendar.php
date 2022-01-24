<?php
ini_set("session.cookie_httponly", 1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
    <!-- https://classes.engineering.wustl.edu/cse330/index.php?title=JQuery -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css" type="text/css" rel="Stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
    <!-- End Citation -->
    <link rel="stylesheet" type="text/css" href="calendarStyle.css" />
</head>

<body>
    <h1>Calendar</h1>
    <div class="userHeader" id="userHead"></div><br>

    <!-- login button -->
    <div class="login" id="loginBlock">
        <input type="text" placeholder="Username" id="username" />
        <input type="password" placeholder="Password" id="password" />
        <button id="login_btn">Login</button>
    </div>

    <!-- logout button -->
    <div class="logout" id="logoutBlock" style="display: none;">
        <button id="logout_btn">Logout</button>
    </div>
    <script src=loginScript.js></script>

    <!-- register button -->
    <div class="register" id="regBlock">
        <input type="text" placeholder="Username" id="user" />
        <input type="password" placeholder="Password" id="pass" />
        <button id="reg_btn">Register</button>
    </div>
    <script src=registerScript.js></script>

    <!-- Add Events -->
    <button class="open-button" id="event_btn" style="display: none;" onclick="openForm()">Add events</button>
    <div class="form-popup" id="addEvent" style="display: none;">
        <h1>Add events</h1>

        <b>Date</b>
        <input type="datetime-local" name="event_date" id="eventTime" required><br>

        <b>Title</b>
        <input type="text" placeholder="Enter an event" name="event_stuff" id="event" required>
        <label><input type="checkbox" name="groupEvent" onclick="showGroup()">Make a Group Event</label>
        <input type="text" placeholder="User to share with" id="shareUser" style="display: none;">
        <input type="hidden" id="addToken" name="token" value="<?php echo $_SESSION['token']; ?>" />
        <button id="addEventBtn">Add to calendar</button>
        <button type="button" class="btn cancel" id="addCancel" onclick="closeForm()">Close</button>
    </div>
    <script src=addEvent.js></script>

    <!-- edit event -->
    <div class="dropdown" id="editDrop" style="display: none;">
        <button id="edit_btn" class="editdropbtn">Edit Events</button>
        <div id="myEditDropdown" class="dropdown-content">
            <p>Click on an event to edit</p>
        </div>
    </div>
    <div class="editEventForm" id="editEvent" style="display: none;">
        <h1>Edit Events</h1>
        <b>Edit date and time:</b>
        <input type="datetime-local" name="event_date2" id="eventTime2" required><br>

        <b>Edit title:</b>
        <input type="text" placeholder="Enter an event" name="event_stuff2" id="event2" required>
        <input type="hidden" id='eventID1'>
        <input type="hidden" id="editToken" name="token" value="<?php echo $_SESSION['token']; ?>" />
        <button id="editEventBtn">Make Changes</button>
        <button type="button" class="btn cancel" id="editCancel" onclick="closeForm2()">Close</button>
    </div>
    <script src=editEvent.js></script>

    <!-- delete event -->
    <div class="dropdown" id="deleteDrop" style="display: none;">
        <button id="delete_btn" class="deldropbtn">Delete Events</button>
        <div id="myDeleteDropdown" class="dropdown-content">
            <p>Click on an event to delete</p>
        </div>
        <input type="hidden" id="deleteToken" name="token" value="<?php echo $_SESSION['token']; ?>" />
    </div>
    <script src=deleteEvent.js></script>

    <!-- share event -->

    <div class="dropdown" id="shareDrop" style="display: none;">
        <button id="share_btn" class="sharedropbtn">Share Events</button>
        <div id="myShareDropdown" class="dropdown-content2">
            <p>Click on an event to share</p>
        </div>
    </div>
    <div class="shareEventForm" id="shareEvent" style="display: none;">
        <h1>Share Events</h1>

        <b>Type in a user to share with:</b>         
        <input type="hidden" id="shareEventToken" name="token" value="<?php echo $_SESSION['token']; ?>" />
    
        <input type="text" placeholder="Enter an username" name="shareUsername" id="sharedUsername" required>
        <input type="hidden" id='eventID'>
        <button id="shareEventBtn">Share Event</button>
        <button type="button" class="btn cancel" id="shareEventCancel" onclick="closeForm3()">Close</button>
    </div>
    <script src=shareEvent.js></script>




    <script>
        function showGroup() {
            if (document.getElementById('shareUser').style.display == "block"){
                document.getElementById("shareUser").style.display = "none";
            }
            else {
                document.getElementById("shareUser").style.display = "block";
            }
        }
        function openForm() {
            document.getElementById("addEvent").style.display = "block";
        }

        function openForm2() {
            document.getElementById("editEvent").style.display = "block";
        }

        function openForm3() {
            document.getElementById("shareEvent").style.display = "block";
        }

        function closeForm() {
            document.getElementById("addEvent").style.display = "none";
        }

        function closeForm2() {
            document.getElementById("editEvent").style.display = "none";
        }

        function closeForm3() {
            document.getElementById("shareEvent").style.display = "none";
        }
    </script>
    <!-- Citation: https://www.youtube.com/watch?v=CuXl6D4e9_k -->
    <div class="calendar">
        <h3 class="calendar__title" id="monthYear">Month and Year</h3>
        <table class="calendar--view" id="calendar">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody id="cal-body"></tbody>
        </table>
        <!-- for the pop up window -->
        <div id="dialog" title="Events"></div><br>
        <div class="form-inline">
            <button class="prevButton" onclick=previous()>Previous</button>
            <button class="nextButton" onclick=next()>Next</button>
        </div>
    </div>
    <!-- End Citation -->
    <script src=calScript.js></script>
</body>

</html>