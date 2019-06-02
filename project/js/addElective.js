document.addEventListener('submit', function(e) {
    e.preventDefault();
    addNewElective();
})

function addNewElective() {
    var dataObject = {};
    dataObject.name = document.getElementById("name").value;
    dataObject.lecturer = document.getElementById("lecturer").value;
    dataObject.assistant = document.getElementById("assistant").value;
    dataObject.busyness = document.getElementById("busyness").value;
    dataObject.description = document.getElementById("description").value;
    dataObject.requirements = document.getElementById("requirements").value;
    dataObject.results = document.getElementById("results").value;
    dataObject.creator = localStorage.getItem("username");
    
    var jsonData = JSON.stringify(dataObject);

    var url = 'http://localhost/project/server/addElective.php';

    return ajax(url, {
        data: jsonData
    });
}

function ajax(url, settings) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 201) {
            printRespose(xhr.responseText);
        } else {
            printRespose(xhr.responseText);
        }
    };

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", localStorage.getItem("username"));
    xhr.send(settings.data);
}

function printRespose(response) {
    document.getElementById("errors").innerHTML = response;
}