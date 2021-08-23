fetch("http://localhost/project1/php/getToDo.php")
.then(response => response.json())
.then(data => {
    console.log(data);
    let main = document.getElementById("content");
    let item = document.getElementById("item");
    
    data.forEach(element => {
        item.innerHTML += element.item;
        main.innerHTML += "<h1>" + element.item + "</h1>";
        main.innerHTML += "<h3>" + element.status + "</h3>";
    });
})  