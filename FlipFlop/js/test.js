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
    var firstLoad = 1;
    var chatsIntervals = {};

    $chatTabs.each(function () {

        var chatID = $(this).data("id");
        chatsIntervals[chatID] = {};

        $.ajax({
                url: 'index.php?controller=AJAX&action=messages',
                data: {idChat: chatID, first: 1},
                type: 'post',
                success: function (Result) {
                    var chat = $.parseJSON(Result);
                    var chatInfo = chat[0];
                    if (chat[1].length > 0) {
                        chat = chat[1];
                        chatsIntervals[chatID]["title"] = chatInfo;
                        chatsIntervals[chatID]["messages"] = chat;
                    }
                }
            }
        );

        chatsIntervals[chatID]["intervalId"] = setInterval(function () {
            $.ajax({
                    url: 'index.php?controller=AJAX&action=messages',
                    data: {idChat: chatID, first: 0},
                    type: 'post',
                    success: function (Result) {
                        var chat = $.parseJSON(Result);
                        var chatInfo = chat[0];
                        if (chat[1].length > 0) {
                            chat = chat[1];
                            chatsIntervals[chatID]["title"] = chatInfo;
                            chatsIntervals[chatID]["messages"].push(chat);
                        }
                    }
                }
            );
        }, 2000);

        $(this).click(function () {

            if ($chatModal.css('display') == 'none') {
                lastID = chatID;
                loadMessages();
                $chatModal.show();
                changeInterval(100);
            } else {
                if (chatID == lastID) {
                    $chatModal.hide();

                    changeInterval(2000);
                } else {
                    changeInterval(2000);
                    lastID = chatID;
                    changeInterval(100);
                }
            }
        });

        changeInterval = function (interval) {
            clearInterval(chatsIntervals[lastID]["intervalId"]);
            chatsIntervals[lastID]["intervalId"] = setInterval(function () {
                $.ajax({
                        url: 'index.php?controller=AJAX&action=messages',
                        data: {idChat: chatID, first: 0},
                        type: 'post',
                        success: function (Result) {
                            var chat = $.parseJSON(Result);
                            var chatInfo = chat[0];
                            if (chat[1].length > 0) {
                                chat = chat[1];
                                chatsIntervals[chatID]["title"] = chatInfo;
                                chat.forEach(function (x) {
                                    chatsIntervals[chatID]["messages"].push(x);
                                });
                            }
                        }
                    }
                );
            }, interval);
        };

        loadMessages = function () {

            console.log(chatsIntervals[lastID]);
            var chat = chatsIntervals[lastID];
            $('.chat-modal-tittle-name').text(chat.title[0].product_name + ": " + chat.title[0].name);
            chat.messages.forEach(function (msg) {
                if (msg.owner == user) {
                    $chatContent.append("<div class='chat-self'><span>Yo:</span><span>" + msg.message + "</span></div>")
                } else {
                    $chatContent.append("<div class='chat-their'><span>" + msg.message + "</span></div>")
                }
            });
        }
    });

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
            type: 'post',
            success: function () {
                console.log("SUCCES", chatID, msg, time);
            },
            error: function () {
                console.log("ERROR", chatID, msg, time);
            }
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