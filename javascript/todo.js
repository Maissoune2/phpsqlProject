//select the addItem form  and the submit button and the err-msg 

let additemFrom = document.getElementById("additem");
let addbtn = document.getElementById("addbtn");


additemFrom.onsubmit = (form) => {
    form.preventDefault();   //preventing the form from submitting
}
addbtn.onclick = () => {
    //use fetch post to send the data to the php file
    let formdata = new FormData(additemFrom);

    fetch("http://localhost/project1/php/todo.php" , {
        method : 'POST',
        body : formdata
    }).then(response => response.text()).then(data => {
        let err_msg = document.getElementById("error");
        err_msg.style.display = "block";
        err_msg.innerHTML = data;
       // console.log(data);
    });
}