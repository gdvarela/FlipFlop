load = function () {

    loadRegister();
    loadChat();
};

loadChat = function () {
    var $chatModal = $('.chat-modal');
    var $chatTabs = $('.chat-tab');
    var $chatInput = $('.chat-input');
    var $chatContent = $(".chat-modal-msg-content");
    var user = $('#currentuser').attr("value");

    var lastID = null;
    var chatsIntervals = {};

    $chatTabs.each(function () {

        var chatID = $(this).data("id");
        chatsIntervals[chatID] = {};

        $.ajax({
                url: 'index.php?controller=AJAX&action=messages',
                data: {idChat: chatID, last: 0},
                type: 'post',
                success: function (Result) {
                    var chat = $.parseJSON(Result);
                    var chatInfo = chat[0];
                    chatsIntervals[chatID]["title"] = chatInfo;
                    chatsIntervals[chatID]["messages"] = [];
                    if (chat[1].length > 0) {
                        chat = chat[1];
                        chatsIntervals[chatID]["messages"] = chat;
                    }
                    notFocusInterval(chatID);
                }
            }
        );

        $(this).click(function () {

            if ($chatModal.css('display') == 'none') {
                lastID = chatID;
                loadMessages();
                $('#chat-tab-' + lastID).addClass("new-messages");
                $chatModal.show();
                onFocusInterval(chatID);
            } else {
                if (chatID == lastID) {
                    $('#chat-tab-' + lastID).removeClass("new-messages");
                    $chatModal.hide();
                    notFocusInterval(chatID);
                } else {
                    notFocusInterval(lastID);
                    $('#chat-tab-' + lastID).removeClass("new-messages");
                    lastID = chatID;
                    $('#chat-tab-' + lastID).addClass("new-messages");
                    onFocusInterval(chatID);
                    loadMessages();
                }
            }
        });
    });

    notFocusInterval = function (chatID) {
        if ( "intervalId" in chatsIntervals[chatID]) {
            clearInterval(chatsIntervals[chatID]["intervalId"]);
        }
        chatsIntervals[chatID]["intervalId"] = setInterval(function () {
            $.ajax({
                    url: 'index.php?controller=AJAX&action=messages',
                    data: {idChat: chatID, last: chatsIntervals[chatID]["title"][0]["lastMessage"]},
                    type: 'post',
                    success: function (Result) {
                        var chat = $.parseJSON(Result);
                        var chatInfo = chat[0];
                        chatsIntervals[chatID]["title"] = chatInfo;
                        if (chat[1].length > 0) {
                            $('#chat-tab-' + chatID).addClass("new-messages");
                            chat = chat[1];
                            chat.forEach(function (message) {
                                chatsIntervals[chatID]["messages"].push(message);
                            });
                        }
                        console.log("NotFocus", chatID);
                    }
                }
            );
        }, 5000);
    };

    onFocusInterval = function (chatID) {
        clearInterval(chatsIntervals[chatID]["intervalId"]);
        chatsIntervals[chatID]["intervalId"] = setInterval(function () {
            $.ajax({
                    url: 'index.php?controller=AJAX&action=messages',
                    data: {idChat: chatID, last: chatsIntervals[chatID]["title"][0]["lastMessage"]},
                    type: 'post',
                    success: function (Result) {
                        var chat = $.parseJSON(Result);
                        var chatInfo = chat[0];
                        chatsIntervals[chatID]["title"] = chatInfo;
                        if (chat[1].length > 0) {
                            chat = chat[1];
                            chat.forEach(function (message) {
                                loadLastMessages(message);
                            });
                        }
                        console.log("Focus", chatID);
                    }
                }
            );
        }, 500);
    };

    clearMessages = function () {
        $chatContent.empty();
    };

    loadMessages = function () {
        clearMessages();
        var chat = chatsIntervals[lastID];
        $('.chat-modal-tittle-name').text(chat.title[0].product_name + ": " + chat.title[0].name);
        chat.messages.forEach(function (msg) {
            if (msg.owner == user) {
                $chatContent.append("<div s='chat-self'><span>Yo:</span><span>" + msg.text + "</span></div>")
            } else {
                $chatContent.append("<div class='chat-their'><span>" + msg.text + "</span></div>")
            }
        });
    };

    loadLastMessages = function (message) {

        chatsIntervals[lastID]["messages"].push(message);
        if (message.owner == user) {
            $chatContent.append("<div s='chat-self'><span>Yo:</span><span>" + message.text + "</span></div>")
        } else {
            $chatContent.append("<div class='chat-their'><span>" + message.text + "</span></div>")
        }
    };

    $chatInput.keypress(function (e) {
        if (e.which == 13) {
            if (lastID) {
                sendMessage(lastID, $chatInput.val(), new Date().getTime())
            }
            $chatInput.val("");
            $chatContent.animate({scrollTop: $chatContent.prop("scrollHeight")}, 250);
        }
    });

    $('#close-chat').click(function () {
        $chatModal.hide();
    });
};

sendMessage = function (chatID, msg, time) {
    $.ajax({
            url: 'index.php?controller=AJAX&action=send',
            data: {idChat: chatID, msg: msg, time: time},
            type: 'post'
        }
    );
};

loadRegister = function () {
    var modal = document.getElementById('register-modal');
    var btn = document.getElementById("register-button");
    var data = document.getElementById("register-data");

    if (data && data.getAttribute("value") == "register") {
        modal.style.display = "block";
    }

    if (btn) {
        btn.onclick = function () {
            modal.style.display = "block";
        }
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
};

window.onload = function () {
    load();
};