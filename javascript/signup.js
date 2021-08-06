//select the signup form  and the submit button and the err-msg 

let signupFrom = document.getElementById("signup");
let btnSubmit = document.getElementById("submitbtn");


signupFrom.onsubmit = (form) => {
    form.preventDefault();   //preventing the form from submitting
}
btnSubmit.onclick = () => {
    //use fetch post to send the data to the php file
    let formdata = new FormData(signupFrom);

    fetch("http://localhost/project1/php/signup.php" , {
        method : 'POST',
        body : formdata
    }).then(response => response.text()).then(data => {
        let err_msg = document.getElementById("error");
        err_msg.style.display = "block";
        err_msg.innerHTML = data;
       // console.log(data);
    });
}
