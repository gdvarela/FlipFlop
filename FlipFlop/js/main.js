load = function() {

    loadRegister();

    loadChat();
}

loadRegister = function () {
    var modal = document.getElementById('register-modal');
    var btn = document.getElementById("register-button");
    var data = document.getElementById("register-data");

    if (data && data.getAttribute("value")=="register") {
        modal.style.display = "block";
    }

    if(btn) {
        btn.onclick = function() {
            modal.style.display = "block";
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

loadChat = function () {

    var $chatModal = $('.chat-modal');
    var $chatTabs = $('.chat-tab');

    $chatTabs.each(function () {
        var chatID = $(this).data("id");
        $(this).click(function () {
            if ($chatModal.css('display') == 'none') {
                $chatModal.show();

                $.ajax({
                        url      : 'index.php?controller=AJAX&action=messages',
                        data     : {idChat: chatID},
                        type     : 'post',
                        success  : function(Result){
                            var chat = $.parseJSON(Result);
                            console.log(chat);

                            chat.forEach(function (msg) {
                                if (msg.owner == 1) {
                                    //append.msg-content
                                } else {

                                }
                            });
                        }
                    }
                );
            } else {
                $chatModal.hide();
            }
        });
    })

    $('#close-chat').click(function () {
        $chatModal.hide();
    });
}

window.onload = function() {
    load();
};