load = function() {

    var modal = document.getElementById('register-modal');
    var btn = document.getElementById("register-button");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

window.onload = function() {
    load();
};