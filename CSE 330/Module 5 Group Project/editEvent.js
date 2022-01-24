function editEvent(event){
    const eventTime2 = document.getElementById("eventTime2").value; // Get the username from the form
    const content2 = document.getElementById("event2").value; // Get the password from the form
    const eid = document.getElementById("eventID1").value;
    const csrfToken = document.getElementById("editToken").value;
    const data = { 'eventTime2': eventTime2, 'content2': content2, 'eid': eid, 'token': csrfToken}; ///info to pass onto the fetch call
    
    fetch("editEvent.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })  
        .then(response => response.json())
        .then(function(stuff){
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            let message = result.message;
            alert (result.message);
            document.getElementById("editEvent").style.display = "none";
        }) 
        .catch(error => console.error('Error:',error));
}
document.getElementById("editEventBtn").addEventListener("click", editEvent, false);