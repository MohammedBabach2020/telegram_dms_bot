//toggle emojis
$(".emojiToggler").on("click", function () {
    $(".emojiContainer").fadeToggle();
});

//Update time notification receiving
var hours, minutes, meridian, message;
hours = document.getElementById("hours");
minutes = document.getElementById("minutes");
meridian = document.getElementById("meridian");
message = document.getElementById("message");

function handleKeyUpBirth(e) {
    window.clearTimeout(500); // prevent errant multiple timeouts from being generated
    message = window.setTimeout(() => {
        changeSendingTime();
    }, 500);
}

function changeSendingTime() {
    $.ajax({
        url: "/modifyBirthParams",
        type: "PUT",
        cache: false,
        data: {
            _token: csrf,
            hours: document.getElementById("hours").value,
            minutes: document.getElementById("minutes").value,
            meridian: document.getElementById("meridian").value,
            message: document.getElementById("message").value,
        },
        success: function (dataResult) {},
    });
}

function handleKeyPress(e) {
    window.clearTimeout(500);
    //'Typing...';
}
// message.addEventListener("keypress", handleKeyPress);
// message.addEventListener("keyup", handleKeyUpBirth);
// hours.addEventListener("change", changeSendingTime);
// minutes.addEventListener("change", changeSendingTime);
// meridian.addEventListener("change", changeSendingTime);
