function getAllElectives() {
    var url = 'http://localhost/project/server/previewAllElectives.php';

    return ajax(url);
}

function getMyElectives() {
    var username = localStorage.getItem("username");
    var url = 'http://localhost/project/server/previewAllElectives.php?creator=' + username;

    return ajax(url);
}

function ajax(url) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            var myArr = JSON.parse(xhr.responseText);
            createTableFromJSON(myArr);
        } else {
            printRespose(xhr.responseText);
        }
    };

    xhr.open("GET", url, true);
    xhr.setRequestHeader("Authorization", localStorage.getItem("username"));
    xhr.send();
}

function printRespose(response) {
    document.getElementById("errors").innerHTML = response;
}

function createTableFromJSON(arr) {
    var col = [];
    col.push("Id");
    for (var i = 0; i < arr.length; i++) {
        for (var key in arr[i]) {
            if (col.indexOf(key) === -1) {
                col.push(key);
            }
        }
    }

    // CREATE DYNAMIC TABLE.
    var table = document.createElement("table");
    table.classList.add("resultTable");

    var tr = table.insertRow(-1); // TABLE ROW.

    for (var i = 0; i < col.length; i++) {
        var th = document.createElement("th"); // TABLE HEADER.
        th.innerHTML = col[i];
        tr.appendChild(th);
    }

    // ADD JSON DATA TO THE TABLE AS ROWS.
    for (var i = 0; i < arr.length; i++) {

        tr = table.insertRow(-1);

        var tabCell = tr.insertCell(-1);
        var name = arr[i][col[1]];
        var idLocation = '../html/previewElective.html?name=' + encodeURIComponent(name);
        tabCell.innerHTML = '<a href=' + idLocation + '>' + (i + 1) + '</a>';


        for (var j = 1; j < col.length; j++) {
            var tabCell = tr.insertCell(-1);
            tabCell.innerHTML = arr[i][col[j]];
        }
    }

    var divContainer = document.getElementById("tableContainer");
    divContainer.innerHTML = "";
    divContainer.appendChild(table);
}