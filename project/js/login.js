document.addEventListener('submit', function(e) {
    e.preventDefault();
    performLogin();
})

function performLogin() {
    var dataObject = {};
    dataObject.username = document.getElementById("uname").value;
    dataObject.password = document.getElementById("psw").value;
    var jsonData = JSON.stringify(dataObject);

    var url = 'http://localhost/project/server/login.php';

    return ajax(url, {
        data: jsonData
    });
}


function ajax(url, settings) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            var username = document.getElementById("uname").value;
            localStorage.setItem("username", username);
            window.location.replace("http://localhost/project/html/index.html");
        } else {
            printRespose(xhr.responseText);
        }
    };

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(settings.data);
}

function printRespose(response) {
    document.getElementById("errors").innerHTML = response;
}