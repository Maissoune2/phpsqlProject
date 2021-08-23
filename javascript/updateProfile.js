//select the update form  and the edit button and the err-msg 

let updateFrom = document.getElementById("update");
let editBtn = document.getElementById("editBtn");


updateFrom.onsubmit = (form) => {
    form.preventDefault();   //preventing the form from submitting
}
editBtn.onclick = () => {
    //use fetch post to send the data to the php file
    let formdata = new FormData(updateFrom);

    fetch("http://localhost/project1/php/updateProfile.php" , {
        method : 'POST',
        body : formdata
    }).then(response => response.text()).then(data => {
        let err_msg = document.getElementById("error");
        err_msg.style.display = "block";
        err_msg.innerHTML = data;
       // console.log(data);
    }).catch(err =>{
        console.log(err);
    })
}