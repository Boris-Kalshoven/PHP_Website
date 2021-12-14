var totalLikes = 0;
var totalUnlikes = 0;

function postReply(commentId) {
    $('#commentId').val(commentId);
    $("#comment").focus();
}

$("#submitButton").click(function () {
    $("#comment-message").css('display', 'none');
    var str = $("frm-comment").serialize();

    $.ajax({
        url: "comment-add.php",
        data: str,
        type: 'POST',
        success: function (response) {
            var result = eval('('+ response +')');
            if(response){
                $("#comment-message").css('display', 'inline-block');
                $("#comment").val("");
                $("#commentId").val("");
                listComment();
            } else {
                alert("Failed to add comments !");
                return false;
            }
        }
    });
});

$(document).ready(function () {
    listComment();
});

function listComment() {
    $.post("comment-list.php",
    function (data) {
        var data = JSON.parse(data);

        var comments = "";
        var replies = "";
        var item = "";
        var parent = -1;
        var results = new Array();

        var list = $("<ul class='outer-comment'>");
        var item = $("<li>").html(comments);

        for (var i = 0;(i < data.length); i++){
            var commentId = data['comment_id'];
            parent = data[i]['parent_comment_id'];

            var obj = getLikesUnlikes(commentId);

            if(parent == "0"){
                if(data[i]['like-unlike'] >= 1){
                    like_icon = "<img src='image/like.png' class='like-unlike' id='unlike_" + data[i]['comment_id']+ "'  onClick=likeOrDislike(" + data[i]['comment_id'] + ",-1)' />";
                    like_icon += "<img style='display:none;' src='image/unlike.png' class='like-unlike' id='like_" + data[i]['comment_id'] + "' onClick=likeOrDislike("+ data[i]['comment_id'] +",1) />";
                } else {
                    like_icon = "<img style='display:none;' src='image/like.png' class='like-unlike' id='unlike_" + data[i]['comment_id']+ "' onClick=likeOrDislike(" + data[i]['comment_id'] + ",-1)' />";
                    like_icon += "<img  src='image/unlike.png' class='like-unlike' id='like_" + data[i]['comment_id'] + "' onClick=likeOrDislike("+ data[i]['comment_id'] +",1) />";
                }
                // Let op, verwijder alle spaties zodat het 1 string blijft.
                comments = 
                    "\<div class='comment-row'>\
                        <div class='comment-info'>\
                            <span class='comment-row-label'>from</span>\
                            <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                            <span class='comment-row-label'>at</span>\
                            <span class='posted-at'>" + data[i]['date'] +"</span>\
                        </div>\
                        <div class='comment-text'>" + data[i]['comment'] + "</div>\
                        <div>\
                            <a class='btn-reply' onClick='postReply("+commentId+")'>Reply</a>\
                        </div>\
                        <div class='post-action'>\ " + like_icon + "&nbsp;\
                            <span id='likes_" + commentId + "'> " + totalLikes + " likes </span>\
                        </div>\
                    </div>";

                    var item = $("<li>").html(comments);
                    list.append(item);
                    var reply_list = $('<ul>');
                    item.append(reply_list);
                    listReplies(commentId, data, reply_list);
            }
        }
        $("#output").html(list);
    });
}

function listReplies(commentId,data,list){
    for (var i = 0; (i < data.length); i++) {

        var obj = getLikesUnlikes(data[i].commentId);
            if(commentId == data[i].parent_comment_id){
                if(data[i]['like-unlike'] >= 1){
                    like_icon = "<img src='image/like.png' class='like-unlike' id='unlike_" + data[i]['comment_id']+ "'  onClick=likeOrDislike(" + data[i]['comment_id'] + ",-1)' />";
                    like_icon += "<img style='display:none;' src='image/unlike.png' class='like-unlike' id='like_" + data[i]['comment_id'] + "' onClick=likeOrDislike("+ data[i]['comment_id'] +",1) />";
                } else {
                    like_icon = "<img style='display:none;' src='image/like.png' class='like-unlike' id='unlike_" + data[i]['comment_id']+ "' onClick=likeOrDislike(" + data[i]['comment_id'] + ",-1)' />";
                    like_icon += "<img  src='image/unlike.png' class='like-unlike' id='like_" + data[i]['comment_id'] + "' onClick=likeOrDislike("+ data[i]['comment_id'] +",1) />";
                }
                 // Let op, verwijder alle spaties zodat het 1 string blijft.
                 comments = 
                 "\<div class='comment-row'>\
                     <div class='comment-info'>\
                         <span class='comment-row-label'>from</span>\
                         <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                         <span class='comment-row-label'>at</span>\
                         <span class='posted-at'>" + data[i]['date'] +"</span>\
                     </div>\
                     <div class='comment-text'>" + data[i]['comment'] + "</div>\
                     <div>\
                         <a class='btn-reply' onClick='postReply("+commentId+")'>Reply</a>\
                     </div>\
                     <div class='post-action'>\ " + like_icon + "&nbsp;\
                         <span id='likes_" + commentId + "'> " + totalLikes + " likes </span>\
                     </div>\
                 </div>";

                 var item = $("<li>").html(comments);
                 list.append(item);
                 var reply_list = $('<ul>');
                 item.append(reply_list);
                 listReplies(commentId, data, reply_list);
        }
    }
}

function getLikesUnlikes(commentId){
    $.ajax({
        type: 'POST',
        async: false,
        url: 'get-like-unlike.php',
        data: {
            comment_id: commentId
        },
        success: function (data) {
            totalLikes = data;
        }
    });
}

function likeOrDislike(comment_id, like_unlike){

    $.ajax({
        url: 'comment-like-unlike.php',
        async: false,
        type: 'POST',
        data: {
            comment_id: comment_id,
            like_unlike: like_unlike
        },
        dataType: 'json',
        success: function (data) {
            $("#likes_" + comment_id).text(data + " likes");

            if(like_unlike == 1){
                $("#like_" + comment_id).css('display', 'none');
                $("#unlike_" + comment_id).show();
            }
            
            if(like_unlike == -1){
                $("#unlike_" + comment_id).css('display', 'none');
                $("#like_" + comment_id).show();
            }
        },
        error: function(data) {
            alert("Error: " + JSON.stringify(data));
        }
    });

}