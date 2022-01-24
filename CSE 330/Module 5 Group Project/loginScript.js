function loginCheck(event){
    //https://classes.engineering.wustl.edu/cse330/index.php?title=AJAX_and_JSON
    const username = document.getElementById("username").value; // Get the username from the form
    const password = document.getElementById("password").value; // Get the password from the form    
    const data = { 'username': username, 'password': password };
    
    fetch("CalendarLogin.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(function(stuff){
            console.log(JSON.stringify(stuff));
            let result = JSON.parse(JSON.stringify(stuff));
            let userid = result.user;
            if(result.success){
                $("#loginBlock").hide();
                $("#regBlock").hide();
                $("#userHead").show();
                document.getElementsByClassName("userHeader")[0].textContent = "Logged in as: " + userid;
                document.getElementById("logoutBlock").style.display = "inline"; //show logout block
                document.getElementById("event_btn").style.display = "inline"; //show add event button 
                document.getElementById("editDrop").style.display="inline-block";//show edit event button
                document.getElementById("deleteDrop").style.display="inline-block";//show delete event button
            }
            else{
                alert(result.message);
            }
        })
        .catch(error => console.error('Error:',error));
}
document.getElementById("login_btn").addEventListener("click", loginCheck, false); 
// End Citation