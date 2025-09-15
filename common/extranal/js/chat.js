"use strict";
$(document).ready(function () {
    "use strict";
    $.ajax({
        url: 'chat/checkChat2',
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            $('#chatCount').empty();
            let count = (response.unreads).length;

            $('#chatCount').append(count);
        }
    })
    setInterval(function () {
        $.ajax({
            url: 'chat/checkChat2',
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                $('#chatCount').empty();
                let count = (response.unreads).length;
                
                $('#chatCount').append(count);
            }
        });
    }, 3000);
});



    // Simple script to initialize user avatars
$(document).ready(function() {
    // Add initials to admin chat buttons
    $('#adminChatters .ca-btn').each(function() {
        var username = $(this).text().trim();
        var initial = username.charAt(0).toUpperCase();
        $(this).attr('data-initial', initial);
    });
    
    // Add initials to employee chat buttons
    $('#employeeChatters .ca-btn').each(function() {
        var name = $(this).text().trim();
        var initial = name.charAt(0).toUpperCase();
        $(this).attr('data-initial', initial);
    });
});
