//Citation: https://www.youtube.com/watch?v=CuXl6D4e9_k
let today = new Date()
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
let monthYear = document.getElementById('monthYear');

///calendar algorithm 
function showCalendar(month, year) {
    let first = new Date(year, month).getDay();
    let numDays = 32 - new Date(year, month, 32).getDate();
    let table = document.getElementById('cal-body');
    table.innerHTML = "";
    monthYear.innerHTML = months[month] + " " + year;
    let date = 1;
    for (let i = 0; i < 6; i++) {
        let row = document.createElement('tr');
        for (let j = 0; j < 7; j++) {
            if (date > numDays) {
                break;
            }
            else if (i === 0 && j < first) {
                let cell = document.createElement('td');
                let text = document.createTextNode("");
                cell.appendChild(text);
                row.appendChild(cell);
            }
            else {
                let cell = document.createElement('td');
                let text = document.createTextNode(date);
                cell.appendChild(text);
                row.appendChild(cell);
                let dateValue = new Date(year, month);
                cell.setAttribute('class', 'dialog');
                cell.setAttribute('title', 'Events');
                cell.setAttribute('id', dateValue);
                date++;
            }
        }
        table.appendChild(row);
    }
}

showCalendar(currentMonth, currentYear);

function previous() {
    if (currentMonth === 0) {
        currentMonth = 11;
        currentYear = currentYear - 1;
    }
    else {
        currentMonth = currentMonth - 1;
    }
    showCalendar(currentMonth, currentYear);
    showEvents();
}

function next() {
    if (currentMonth === 11) {
        currentYear = currentYear + 1;
    }
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
    showEvents();
}
//End Citation

let user_id = "";
function showEvents() {
    //https://stackoverflow.com/questions/24184507/javascript-make-html-table-clickable-with-pop-up-window
    //https://stackoverflow.com/questions/6075016/jquery-ui-dialog-close-button-not-working
    $('#dialog').dialog({
        autoOpen: false,
        buttons: {
            'Close': function () {
                $('#dialog').dialog('close');
            }
        }
    });
    //End Citation
    $(".dialog").click(function () {
        let d = new Date($('.dialog').attr('id'));
        let yearVar = d.getFullYear();
        let monthVar = d.getMonth();
        const dayVar = $(this).html();
        let temp = "No Events";
        let current = this;
        //Get events to display
        const eventData = { 'yearVar': yearVar, 'monthVar': monthVar, 'dayVar': dayVar };
        fetch('getEvent.php', {
            method: 'POST',
            body: JSON.stringify(eventData),
            headers: { 'content-type': 'application/json' }
        })
            .then(response => response.json())
            .then(function (stuff) {
                console.log(JSON.stringify(stuff));
                let result = JSON.parse(JSON.stringify(stuff));
                if (result.success) {
                    temp = result.message;
                    let tempHtml = "";
                    for (let i = 0; i < temp.length; i += 2) {
                        tempHtml += "<br> Title: " + temp[i] + "  Time: " + temp[i + 1];
                    }
                    $('#dialog').html($(current).html() + "<br>" + tempHtml);
                    $('#dialog').dialog("open");
                }
                else {
                    $('#dialog').html($(current).html() + "<br><br>" + temp);
                    $('#dialog').dialog("open");
                }
            })
            .catch(function (error) {
                console.log("Found an error " + error);
            });
    });
};

function displayButtons() {
    fetch('checkUser.php', {
        method: 'POST',
        headers: { 'content-type': 'application/json' }
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (stuff) {
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            if (result.success) {
                user_id = result.message;
                $("#loginBlock").hide();
                $("#regBlock").hide();
                document.getElementById("logoutBlock").style.display = "inline"; //show logout block
                document.getElementById("event_btn").style.display = "inline"; //show add event button 
                document.getElementById("editDrop").style.display = "inline-block";//show edit event button
                document.getElementById("deleteDrop").style.display = "inline-block"//show delete event button
                document.getElementById("shareDrop").style.display="inline-block"; //show share button
                document.getElementsByClassName("userHeader")[0].innerHTML = "Logged in as: " + user_id;
            }
        })
        .catch(function (error) {
            console.log("Found an error " + error);
        });
}
document.getElementById("login_btn").addEventListener("click", displayButtons, false);
document.getElementById("reg_btn").addEventListener("click", displayButtons, false);


window.onload = displayButtons();
window.onload = showEvents();

function logout() {
    fetch('cal_logout.php')
        .then(function (stuff) {
            document.getElementById("logoutBlock").style.display = "none";
            document.getElementById("event_btn").style.display = "none";
            document.getElementById("editDrop").style.display = "none";
            document.getElementById("deleteDrop").style.display = "none";
            document.getElementById("shareDrop").style.display="none";
            $("#userHead").hide();
            $("#loginBlock").show();
            $("#regBlock").show();
            $("#addEvent").hide();
            $("#editEvent").hide();
            $("#shareEvent").hide();
            user_id = "";
        }).catch(function (error) {
            console.log("Found an error " + error);
        });
}
document.getElementById("logout_btn").addEventListener("click", logout, false);

//https://www.w3schools.com/howto/howto_js_dropdown.asp
//When the user clicks on the button, toggle between hiding and showing the dropdown content
let deleteForm = false;
function openDelete() {
    document.getElementById("myDeleteDropdown").innerHTML = "<p>Click on an event to delete</p>"; 
    if (!deleteForm){
        deleteForm = true;
        document.getElementById("myDeleteDropdown").style.display = "block"; ///show drop down delete menu
    }
    else{
        deleteForm = false;
        document.getElementById("myDeleteDropdown").style.display = "none"; ///hide drop down delete menu
    }
    fetch("getUserEvents.php", {
        method: 'POST',
        headers: { 'content-type': 'application/json' }
    })
        .then(response => response.json())
        .then(function (stuff) {
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            temp = result.message;
            if (result.success) {
                let tempHtml = "";
                for (let i = 0; i < temp.length; i += 3) {
                    tempHtml += "<text onclick=deleteEvent(this.id) id=" + temp[i + 2] + ">Title: " + temp[i + 1] + "  Time: " + temp[i] + "</text><br>";
                }
                document.getElementById("myDeleteDropdown").innerHTML += tempHtml;
            }
            else {
                document.getElementById("myDeleteDropdown").innerHTML += "<text>" + result.message + "</text>";
            }
        })
        .catch(error => console.error('Error:', error));
}
document.getElementById("delete_btn").addEventListener("click", openDelete, false);



function openEdit() {
    document.getElementById("myEditDropdown").classList.toggle("show");

    fetch("getUserEvents.php", {
        method: 'POST',
        headers: { 'content-type': 'application/json' }
    })
        .then(response => response.json())
        .then(function (stuff) {
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            temp = result.message;
            if (result.success) {
                let tempHtml = "";
                for (let i = 0; i < temp.length; i += 3) {
                    tempHtml += "<text onclick=showEditForm(this.id) id=" + temp[i + 2] + ">Title: " + temp[i + 1] + "  Time: " + temp[i] + "</text><br>";
                }
                document.getElementById("myEditDropdown").innerHTML += tempHtml;
            }
            else {
                document.getElementById("myEditDropdown").innerHTML += "<text>" + result.message + "</text>";
            }
        })
        .catch(error => console.error('Error:', error));
}
document.getElementById("edit_btn").addEventListener("click", openEdit, false);

function openShare(){
    document.getElementById("myShareDropdown").classList.toggle("show");
    fetch("getUserEvents.php", {
        method: 'POST',
        headers: { 'content-type': 'application/json' }
    })
        .then(response => response.json())
        .then(function (stuff) {
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            temp = result.message;
            if (result.success) {
                let tempHtml = "";
                for (let i = 0; i < temp.length; i += 3) {
                    tempHtml += "<text onclick=showShareForm(this.id) id=" + temp[i + 2] + ">Title: " + temp[i + 1] + "  Time: " + temp[i] + "</text><br>";
                }
                document.getElementById("myShareDropdown").innerHTML += tempHtml;
            }
            else {
                document.getElementById("myShareDropdown").innerHTML += "<text>" + result.message + "</text>";
            }
        })
        .catch(error => console.error('Error:', error));
}
document.getElementById("share_btn").addEventListener("click", openShare, false);
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.editdropbtn')) { ///if the user is not clicking on the edit drop down button
        let dropdowns = document.getElementsByClassName("dropdown-content");///select the drop down menu
        for (let i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');///hide the content of the drop down menu as we iterate through
            }
        }
        document.getElementById("myEditDropdown").innerHTML = "<p>Click on an event to edit</p>";
    }
    else {
        document.getElementById("myEditDropdown").innerHTML = "<p>Click on an event to edit</p>";
    }
    
    
    if (!event.target.matches('.sharedropbtn')) { ///if the user is not clicking on the share drop down button
        let dropdowns = document.getElementsByClassName("dropdown-content2");///select the drop down menu
        for (let i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');///hide the content of the drop down menu as we iterate through
            }
        }
        document.getElementById("myShareDropdown").innerHTML = "<p>Click on an event to share</p>";
    }
    else {
        document.getElementById("myShareDropdown").innerHTML = "<p>Click on an event to share</p>";
    }





    if (!event.target.matches('.deldropbtn')) {///if the user is not clicking on the delete drop down button 
        if (deleteForm) {
            deleteForm = false;
            document.getElementById("myDeleteDropdown").style.display = "none";            
        }
        document.getElementById("myDeleteDropdown").innerHTML = "<p>Click on an event to delete</p>";
    }
    else {
        document.getElementById("myDeleteDropdown").innerHTML = "<p>Click on an event to delete</p>";
    }
}


//End Citation

function showEditForm(id) { ///show the edit event form when called
    document.getElementById("editEvent").style.display = "block";
    document.getElementById("eventID1").value = id; ///set the hidden id field in the form equal to the current event id 
}

function showShareForm(id){///show the share event form when called
    document.getElementById("shareEvent").style.display = "block";
    document.getElementById("eventID").value = id; ///set the hidden id field in the form equal to the current event id 
}