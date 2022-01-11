function writeUser(json) {
    document.getElementById("user_to_change1").value = json["id"];
    document.getElementById("user_to_change2").value = json["id"];

    document.getElementById('name').value = json['name'];
    document.getElementById('surname').value = json['surname'];
    document.getElementById('email').value = json['email'];
    document.getElementById('phone_number').value = json['phone_number'];
    document.getElementById('credits1500').value = json['credits1500'];
    document.getElementById('credits4000').value = json['credits4000'];
    document.getElementById('isRDZ').checked = json['isRDZ'];
}

function getParams() {
    let sel = document.getElementById('users');
    let mail = sel.options[sel.selectedIndex].value;
    return 'mail=' + mail;
}

function userChanged() {
    // https://www.tutorialrepublic.com/javascript-tutorial/javascript-ajax.php
    var request = new XMLHttpRequest();

    // Instantiating the request object
    request.open("GET", "user_manage_ajax?" + getParams(), true);
    //Send the proper header information along with the request
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Defining event listener for readystatechange event
    request.onreadystatechange = function() {
        // Check if the request is compete and was successful
        if(this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Inserting the response from server into an HTML element

            writeUser(JSON.parse(this.responseText));
        }
    };

    request.send();
}

userChanged();
