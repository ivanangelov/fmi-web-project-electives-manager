document.addEventListener('submit', function(e) {
    e.preventDefault();
    modifyElective();
})

function modifyElective() {
    var dataObject = {};
    dataObject.name = document.getElementById("name").innerHTML;
    dataObject.lecturer = document.getElementById("lecturer").value;
    dataObject.assistant = document.getElementById("assistant").value;
    dataObject.busyness = document.getElementById("busyness").value;
    dataObject.description = document.getElementById("description").value;
    dataObject.requirements = document.getElementById("requirements").value;
    dataObject.results = document.getElementById("results").value;

    var jsonData = JSON.stringify(dataObject);

    var url = 'http://localhost/project/server/modifyElective.php';

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

    xhr.open("PUT", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", localStorage.getItem("username"));
    xhr.send(settings.data);
}

function printRespose(response) {
    document.getElementById("errors").innerHTML = response;
}

function loadParameters() {
    var jsonResponse = localStorage.getItem("jsonResponse");
    var jsonResponseArr = JSON.parse(jsonResponse);
    
    document.getElementById("name").innerHTML = jsonResponseArr.name;
    document.getElementById("lecturer").value = jsonResponseArr.lecturer;
    document.getElementById("assistant").value = jsonResponseArr.assistant;
    document.getElementById("busyness").value = jsonResponseArr.busyness;
    document.getElementById("description").innerHTML = jsonResponseArr.description;
    document.getElementById("requirements").innerHTML = jsonResponseArr.requirements;
    document.getElementById("results").innerHTML = jsonResponseArr.results;

    localStorage.removeItem("jsonResponse");
}