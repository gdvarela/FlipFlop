load = function() {

    loadRegister();

    loadChat();
}

loadRegister = function () {
    var modal = document.getElementById('loadRegister-modal');
    var btn = document.getElementById("loadRegister-button");
    var data = document.getElementById("loadRegister-data");

    if (data.getAttribute("value")=="loadRegister") {
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
}

loadChat = function () {

    var xmlhttp = new XMLHttpRequest();
    var $chatModal = $('.loadChat-modal');

    $('#chat1').click(function () {
        if ($chatModal.css('display') == 'none') {
            $chatModal.show();

            xmlhttp.open("GET", "index.php?controller=AJAX&action=test", true);
            xmlhttp.send();
        } else {
            $chatModal.hide();
        }

    });

    $('#close-loadChat').click(function () {
        $chatModal.hide();
    });

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            insertChat()
        }
    };
}

insertChat = function () {
    
}

window.onload = function() {
    load();
};