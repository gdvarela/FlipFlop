load = function() {

    var modal = document.getElementById('register-modal');
    var btn = document.getElementById("register-button");
    var data = document.getElementById("register-data");

    if (data.getAttribute("value")=="register") {
        modal.style.display = "block";
    }

    btn.onclick = function() {
        modal.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var $testButton = $('#testbutton');
    var xmlhttp = new XMLHttpRequest();

    $testButton.click( function () {
        xmlhttp.open("GET", "index.php?controller=AJAX&action=test", true);
        xmlhttp.send();
    });

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
        }
    };
}

window.onload = function() {
    load();
};