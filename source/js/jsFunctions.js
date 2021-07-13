var $solution;
var $score;
var $lifes;
var $choice;
var $user;
var $person1;
var timeLeft = 10;

function pageLoad() {
    if (window.location.pathname == "/geoface/register.php") {
        $("#password, #confPassword").on('keyup', check_pass);
        $("#wrongPassword").hide();
    }
    if (window.location.pathname == "/geoface/play.php") {
        loadGame();
        first321();

    }

    if (window.location.pathname == "/geoface/profile.php") {
        loadProfile();
    }
}

function loadGame() {

    $('#playAgain').on("click", function () {
        window.location.href = "play.php";
    });

    $('#goProfile').on("click", function () {
        window.location.href = "profile.php";
    });


    $score = 0;
    $lifes = 3;
    $choice = "";
    $("#score").html($score);
    $user = $("#profile").text();


    $.ajax({
        url: "loadquestion.php",
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            loadQuestion(data);
        }
    });
}

function first321() {

    var init = 3;
    count321();
    var count = setInterval(count321, 1000);

    function count321() {

        $("#start").remove();
        if (init == 0) {
            clearTimeout(count);
            $(".answer").on('click', checkAnswer);
            timeout();
        } else {
            $("<h1 id='start' class= 'display-1'>" + init + "</h1>").appendTo($("#playPage"));
            init--;
        }

    }
}

function disableButton(value) {

    $("#button1").attr("disabled", value);
    $("#button2").attr("disabled", value);
    $("#button3").attr("disabled", value);
    $("#button4").attr("disabled", value);
}

function timeout() {
    var elem = document.getElementById("timer");
    countdown();
    var timerId = setInterval(countdown, 1000);
    $("#timer").css("color", "green");

    function countdown() {
        if (timeLeft == -1) {
            clearTimeout(timerId);
            $("#life" + $lifes).fadeOut('slow');
            $lifes--;
            if ($lifes <= 0) {
                gameOver();

            } else
                nextquestion();
        } else {
            elem.innerHTML = timeLeft + ' s';
            if (timeLeft < 4) {
                $("#timer").css("color", "red");
            } else if (timeLeft >= 4 && timeLeft <= 6) {
                $("#timer").css("color", "orange");
            } else
                $("#timer").css("color", "green");
            timeLeft--;
        }
    }
}


function loadQuestion(data) {
    if (timeLeft <= 0) {
        timeLeft = 10;
        timeout();
    } else
        timeLeft = 10;
    var imageUrl = data[0] + ".jpeg";
    $person1 = data[0];
    $solution = data[2];
    $(".picArea").css("background-image", "url(" + "user-pics/" + imageUrl + ")");
    var question = [data[2], data[3], data[4], data[5]]
    question = shuffle(question);
    $("#button1").html(question[0]);
    $("#button2").html(question[1]);
    $("#button3").html(question[2]);
    $("#button4").html(question[3]);


}

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }
    return array;
}


function checkAnswer() {

    disableButton(true);

    $choice = $(this).text();
    if ($(this).text() == $solution) {
        $score++;
        $("#score").html($score);
        //$(this).css("background-color","green");
        $("<span id='correct'>V</span>").appendTo($(".picArea")).show("slow");
    } else {
        $("#life" + $lifes).fadeOut('slow');
        //$(this).css("background-color", "red");
        $("<span id='wrong'>X</span>").appendTo($(".picArea")).show("slow");
        $lifes--;

    }

    if ($lifes <= 0) {
        gameOver();
    } else {
        $.ajax({
            url: "saveAnswer.php",
            type: 'POST',
            dataType: 'json',
            data: {choice: $choice, person1: $person1, person2: $user},
        });
        setTimeout(nextquestion, 500);
    }

}

function nextquestion() {
    $.ajax({
        url: "loadquestion.php",
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            $("#correct").remove();
            $("#wrong").remove();
            $("#answers").hide();
            $(".picArea").hide();
            $("#answers").show(400);
            $(".picArea").show(400);
            disableButton(false );
            loadQuestion(data);
        }
    });

}

function gameOver() {
    $.ajax({
        url: "saveScore.php",
        type: 'POST',
        dataType: 'json',
        data: {score: $score, user: $user},
        success: function () {
            $('#myModal').modal('show');
        }
    });

}

function check_pass() {
    var submit = $("#submit");
    var errorArea = $("#wrongPassword");

    if ($("#password").val() == $("#confPassword").val()) {
        submit.attr("disabled", false);
        errorArea.hide();
    } else {
        errorArea.show();
        submit.attr("disabled", true);

        errorArea.text("password are not the same");
    }
}

function loadProfile() {
    $user = $("#profile").text();
    var imageUrl = $user + ".jpeg";
    $(".picArea").css("background-image", "url(" + "user-pics/" + imageUrl + ")");

}

window.onload = pageLoad;