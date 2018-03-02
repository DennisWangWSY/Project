window.onload = function() {
    function showQuiz() {
        before = current;
        current = this.name;
        var hide = document.getElementById(before);
        hide.style.display = "none";
        var show = document.getElementById(current);
        show.style.display = "block";
    }

    function next() {
        var quiz = document.getElementById(current);
        quiz.style.display = "none";
        if (current == max)
            finish();
        else {
            current++;
            document.getElementById(current).style.display = "block";
            timeleft = fulltime;
            clearInterval(interval);
            clearTimeout(timeout);
            interval = setInterval(countdown, 1000);
            timeout = setTimeout(timeup, fulltime * 1000);
        }
    }

    function finish() {
        for (var i = 0; i < quiz_correct.length; i++)
            quiz_correct[i] = quiz_ids[quiz_correct[i]];
        var param = "score=" + score + "&ids=" + quiz_ids + "&corrects=" + quiz_correct;
        new SimpleAjax("record.php", "POST", encodeURI(param));

        var result = document.getElementById("result");
        var result_form = result.querySelector("form");
        result.style.display = "block";
        document.getElementById("score").innerHTML = score;
        document.getElementById("quiz").onclick = function() {
            result_form.action = "quiz.php";
        };
        var buttons = buttonDiv.querySelectorAll("button");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].removeAttribute("disabled");
            buttons[i].onclick = showQuiz;
        }
        if (document.getElementById("myHome")) {
            document.getElementById("myHome").onclick = function() {
                result_form.action = "my.php";
            };
        } else {
            document.getElementById("main").onclick = function() {
                result_form.action = "home.php";
            };
        }
    }

    function getChoices(form) {
        var boxes = form.querySelectorAll("[name='choice']");
        var answer = "";
        for (var i = 0; i < boxes.length; i++) {
            if (boxes[i].checked)
                answer = answer + boxes[i].value;
        }
        return answer;
    }

    function checkAnswer() {
        var current_form = document.getElementById(current);
        var inputs = current_form.querySelectorAll("input");
        var user_answer = getChoices(current_form);
        if (user_answer == "")
            alert("Choose at least one answer!");
        else {
            clearInterval(interval);
            clearTimeout(timeout);
            var form = document.getElementById(current);
            var div = form.querySelector(".countdown");
            div.style.display = "none";
            var id = current_form.querySelector("[name='id']").value;
            var param = "quiz_id=" + id + "&ans=" + user_answer;
            new SimpleAjax("getAnswer.php", "POST", encodeURI(param), getAnswer_Success, getAnswer_Failure);
            for (var i = 0; i < inputs.length; i++)
                inputs[i].disabled = "true";
        }
        return false;
    }

    function getAnswer_Failure() {
        alert("Fail to check your answer");
    }

    function getAnswer_Success(request) {
        var response = request.responseText;
        var button = buttonDiv.querySelector("[name='" + current + "']");
        if (response == "y") {
            button.className = "correct";
            score++;
            quiz_correct.push(current - 1);
        } else
            button.className = "wrong";
        next();
    }

    function startQuiz() {
        buttonDiv.style.display = "block";
        next();
        return false;
    }

    function countdown() {
        var form = document.getElementById(current);
        var div = form.querySelector(".countdown");
        timeleft--;
        div.innerHTML = timeleft;
    }

    function timeup() {
        clearInterval(interval);
        var button = buttonDiv.querySelector("[name='" + current + "']");
        button.className = "wrong";
        var form = document.getElementById(current);
        var div = form.querySelector(".countdown");
        div.style.display = "none";
        var current_form = document.getElementById(current);
        var inputs = current_form.querySelectorAll("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = "true";
            if (i != inputs.length - 1)
                inputs[i].checked = false;
        }
        next();
    }
    var current = 0;
    var max = 10;
    var score = 0;
    var before = 1;
    var interval = null;
    var timeout = null;
    var fulltime = 10;
    var timeleft = fulltime;
    var buttonDiv = document.querySelector(".buttons");
    buttonDiv.style.display = "none";

    var ids = document.querySelectorAll("input[name='id']");
    var quiz_ids = new Array();
    var quiz_correct = new Array();
    for (var i = 0; i < ids.length; i++) {
        quiz_ids.push(ids[i].value);
    }

    var start = document.getElementById(current);
    start.style.display = "block";
    var startButton = document.getElementById("start");
    startButton.onclick = startQuiz;

    var checkAnswerButtons = document.querySelectorAll(".checkAnswer");
    for (var i = 0; i < checkAnswerButtons.length; i++)
        checkAnswerButtons[i].onclick = checkAnswer;

    var div_countdowns = document.querySelectorAll("div.countdown");
    for (var i = 0; i < div_countdowns.length; i++)
        div_countdowns[i].innerHTML = fulltime;

}