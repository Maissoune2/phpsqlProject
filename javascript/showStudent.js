

fetch("http://localhost/project1/php/showStudent.php")
.then(response => response.json())
.then(data => {
    console.log(data);
    let main = document.getElementById("content");
    
    data.forEach(element => {
        main.innerHTML += "<h1>Your Name:"+ '&nbsp;' + element.fname + '&nbsp;' + element.lname + "</h1>";
        main.innerHTML += "<h2>Your Education Level:"+ '&nbsp;' + element.schoolYear + "</h2>";
        main.innerHTML += "<h3>Your Phone Number:"+ '&nbsp;' + element.PhoneNumber + "</h3>";
        main.innerHTML += "<h4>Your Date of Birth:" + '&nbsp;'+ element.age + "</h4>";
        main.innerHTML += "<h5>Your Date of Joining:" + '&nbsp;'+ element.creation + "</h5>";
        
    });
})  