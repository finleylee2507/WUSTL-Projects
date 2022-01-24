function deleteEvent(id) {
    const csrfToken = document.getElementById("deleteToken").value; //Get CSRF Token
    const data = { 'eid': id, 'token':csrfToken }
    fetch("deleteEvent.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    })
        .then(response => response.json())
        .then(function (stuff) {
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            let message = result.message;
            alert(result.message);
        })
        .catch(error => console.error('Error:', error));
}