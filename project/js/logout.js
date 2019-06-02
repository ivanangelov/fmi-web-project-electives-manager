function logout() {
    var dataObject = {};
    dataObject.username = sessionStorage.getItem("username");
    var jsonData = JSON.stringify(dataObject);

    var url = 'http://localhost/project/server/logout.php';

    return ajaxLogout(url, {
        data: jsonData
    });
}

function ajaxLogout(url, settings) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            localStorage.clear();
            window.location.replace("http://localhost/project/html/login.html");
        } else {
            alert(xhr.responseText);
        }
    };

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(settings.data);
}