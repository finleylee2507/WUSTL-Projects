function addEvent(event){
    const eventTime = document.getElementById("eventTime").value; // Get the username from the form
    const eventData = document.getElementById("event").value; // Get the password from the form
    const csrfToken = document.getElementById("addToken").value; //Get CSRF Token
    const otherUser = document.getElementById("shareUser").value; // Get the username from the form
    const data = { 'eventTime': eventTime, 'event': eventData, 'token': csrfToken, 'otherUser': otherUser};// info to pass onto the fetch call
    
    fetch("addEvent.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })  
        .then(response => response.json())
        .then(function(stuff){
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            let message = result.message;
            alert(message);
            document.getElementById("addEvent").style.display = "none";
        }) 
        .catch(error => console.error('Error:',error));
}
document.getElementById("addEventBtn").addEventListener("click", addEvent, false);