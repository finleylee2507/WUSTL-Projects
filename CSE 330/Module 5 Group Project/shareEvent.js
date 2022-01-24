function shareEvent(id) {
    const csrfToken = document.getElementById("shareEventToken").value; //Get CSRF Token
    const sharedUser= document.getElementById("sharedUsername").value; ///get the shared user name from the form
    const eid = document.getElementById("eventID").value;
    alert(eid);
    const data = { 'eid': eid,  'user_id': sharedUser, 'token': csrfToken };
    fetch("shareEvent.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    })
        .then(response => response.json())
        .then(function (stuff) {
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            let message = result.message;
            alert(message);
        })
        .catch(error => console.error('Error:', error));
}
document.getElementById("shareEventBtn").addEventListener("click", shareEvent, false);