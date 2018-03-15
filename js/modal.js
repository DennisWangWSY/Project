window.onload = function(){
	
	function getQuiz(){
		var label = document.getElementById("myModalLabel");
		label.innerHTML = "666";
		var quiz_id = this.innerHTML;
		console.log(quiz_id);
		var param = "quiz_id=" + quiz_id;
		new SimpleAjax("getQuiz.php", "POST", encodeURI(param), getAnswer_Success, getAnswer_Failure);

	}
	function getAnswer_Success(request){
		var data = JSON.parse(request.responseText);
		var title = document.getElementById("myModalLabel");
		title.innerHTML = "Quiz #" + data.id;

		var content = document.getElementById("content");
		content.innerHTML = data.content;

		var difficulty = document.getElementById("difficulty");
		difficulty.innerHTML = "Difficulty: " + data.difficulty;

		var domain = document.getElementById("domain");
		domain.innerHTML = "Domain: " + data.domain; 
		
		var a = document.getElementById("a");
		a.innerHTML = data.quiz_choicesA;

		var b = document.getElementById("b");
		b.innerHTML = data.quiz_choicesB;

		var c = document.getElementById("c");
		c.innerHTML = data.quiz_choicesC;

		var d = document.getElementById("d");
		d.innerHTML = data.quiz_choicesD;

	}
	function getAnswer_Failure(request){
		alert("wrong");
	}

	var modal = document.getElementsByClassName("showmodal");

	for (var i = 0; i < modal.length; i++) {
		modal[i].onclick = getQuiz;
	}
}