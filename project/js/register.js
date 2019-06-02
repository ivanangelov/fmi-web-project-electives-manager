document.addEventListener('submit', function(e) {
    e.preventDefault();
    performRegistration();
})

function performRegistration() {
    if (validateRegistrationDetails() == true) {
        var dataObject = {};
        dataObject.username = document.getElementById("uname").value;
        dataObject.password = document.getElementById("psw").value;
        dataObject.email = document.getElementById("email").value;
        var jsonData = JSON.stringify(dataObject);

        var url = 'http://localhost/project/server/register.php';

        return ajax(url, {
            data: jsonData
        });
    }
}


function validateRegistrationDetails() {
    var validataRequest = true;

    var username = document.getElementById("uname").value;
    var password = document.getElementById("psw").value;
    var passwordRepeat = document.getElementById("pswRepeat").value;
    var email = document.getElementById("email").value;

    document.getElementById("errors").innerHTML = "";

    var usernameRegexPattern = "(^[a-zA-Z0-9]{5,15}$)";
    var passwordRegexPattern = "(^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{5,}$)";
    var emailRegexPattern = "^\\w+@[a-zA-Z_]+?\\.[a-zA-Z]{2,3}$";

    if (username.length < 5 || username.length > 15 || username.match(usernameRegexPattern) == null) {
        document.getElementById("errors").innerHTML = "The username must be at least 5 symbols and atmost 15 symbols - letters and digits.";
        return false;
    }

    if (password.length < 5 || password.match(passwordRegexPattern) == null) {
        document.getElementById("errors").innerHTML = "The password should be at least 5 sybmols, containing 1 upper case letter, 1 lower case letter, and one digit.";
        return false;
    }

    if (passwordRepeat != password) {
        document.getElementById("errors").innerHTML = "Passwords do not match.";
        return false;
    }

    if (email.match(emailRegexPattern) == null) {
        document.getElementById("errors").innerHTML = "The email is not in valid format.";
        return false;
    }

    return validataRequest;
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
    xhr.send(settings.data);
}

function printRespose(response) {
    document.getElementById("errors").innerHTML = response;
}