//select the login form  and the submit button and the err-msg 

let loginForm = document.getElementById("login");
let btnSubmit = document.getElementById("submitbtn");


loginForm.onsubmit = (form) => {
    form.preventDefault();   //preventing the form from submitting
}


btnSubmit.onclick = () => {
    //use fetch post to send the data to the php file
    let formdata = new FormData(loginForm);

    fetch("http://localhost/project1/php/login.php" , {
        method : 'POST',
        body : formdata 
    }).then(response => response.json()).then(data => {
        if (data == "success") {
            console.log(data);
            location.href = "http://localhost/project1/public/user/user_dash.html";
        } else {
            let err_msg = document.getElementById("error");
            err_msg.style.display = "block";
            err_msg.innerHTML = data;
            // console.log(data);
        }
        
    });
}
