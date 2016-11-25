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
    var lastMsg = "new";
    $chatTabs.each(function () {
        var chatID = $(this).data("id");
        $(this).click(function () {
            if ($chatModal.css('display') == 'none') {
                $chatModal.show();

                $.ajax({
                        url      : 'index.php?controller=AJAX&action=messages',
                        data     : {idChat: chatID, last: lastMsg},
                        type     : 'post',
                        success  : function(Result){
                            var chat = $.parseJSON(Result);
                            var chatInfo = chat[0];
                            chat = chat[1];
                            lastMsg = chat[chat.length - 1].time;

                            $('.chat-modal-tittle-name').text(chatInfo[0].product_name + ": " + chatInfo[0].name);
                            chat.forEach(function (msg) {
                                if (msg.owner == 1) {
                                    $('.msg-content').append("<div class='chat-self'><span>Yo:</span><span>" + msg.message + "</span></div>")
                                } else {
                                    $('.msg-content').append("<div class='chat-their'><span>" + msg.message + "</span></div>")
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