window.onload = function() {
	function add_quiz() {
		var content = document.querySelector("textarea").value.trim();
		var domain = document.querySelector("[name='domain']").value.trim();
		var diff = document.querySelector("[name='difficulty']").value.trim();
		var choiceA = document.querySelector("[name='A']").value.trim();
		var choiceB = document.querySelector("[name='B']").value.trim();
		var choiceC = document.querySelector("[name='C']").value.trim();
		var choiceD = document.querySelector("[name='D']").value.trim();
		var answers = document.querySelectorAll("input:checked");
		if(content == "") {
			alert("Please input the quiz");
			return false;
		} else if(!domain) {
			alert("Please input the domain");
			return false;
		} else if(!choiceA) {
			alert("Please input the choice A");
			return false;
		} else if(!choiceB) {
			alert("Please input the choice B");
			return false;
		} else if(!choiceC) {
			alert("Please input the choice C");
			return false;
		} else if(!choiceD) {
			alert("Please input the choice D");
			return false;
		} else if(answers.length==0) {
			alert("Please choose at least one correct answer");
			return false;
		}
		var answer = "";
		for(var i=0; i<answers.length; i++)
			answer = answer + answers[i].value;
		var param = "content=" +encodeURIComponent(content)+ "&domain=" +encodeURIComponent(domain)+ 
				"&diff=" +diff+ "&choiceA=" +encodeURIComponent(choiceA)+ "&choiceB=" +encodeURIComponent(choiceB)+ 
				"&choiceC=" +encodeURIComponent(choiceC)+"&choiceD=" +encodeURIComponent(choiceD)+ "&answer=" +answer;
		console.log(param);
		new SimpleAjax("add_quiz.php", "POST", param, add_quiz_Success, add_quiz_Failure);
		return false;
	}
	function add_quiz_Failure() {
		alert("Fail to add a new quiz");
	}
	function add_quiz_Success(request) {
		var content = document.querySelector("textarea").value.trim();
		var domain = document.querySelector("[name='domain']").value.trim();
		var diff = document.querySelector("[name='difficulty']").value.trim();
		var choiceA = document.querySelector("[name='A']").value.trim();
		var choiceB = document.querySelector("[name='B']").value.trim();
		var choiceC = document.querySelector("[name='C']").value.trim();
		var choiceD = document.querySelector("[name='D']").value.trim();
		var quiz_id = request.responseText;

		var newdiv1 = document.createElement("div");
		newdiv1.className = "ibox";
		newdiv1.setAttribute("quiz_id", quiz_id);
		var newdiv2 = document.createElement("div");
		newdiv2.className = "ibox-content";
		var newdiv3 = document.createElement("div");
		newdiv3.setAttribute("id", "content");
		var newform = document.createElement("form");
		
		newform.className = "list left";
		
		// var newinput = document.createElement("input");
		// newinput.setAttribute("type", "hidden");
		// newinput.setAttribute("name", "todo_id");
		// newinput.setAttribute("value", quiz_id);
		var newdiv = document.createElement("div");
		newdiv.className = "quiz_title";
		newdiv.innerHTML = domain + " -- Difficulty: " + diff;
		var newdelete = document.createElement("input");
		newdelete.className = "btn btn-warning btn-sm";
		newdelete.setAttribute("type", "submit");
		newdelete.setAttribute("id", "delete_quiz");
		newdelete.setAttribute("name", "delete_quiz");
		newdelete.value = "X";
		newdelete.setAttribute("quiz_id", quiz_id);
		newdelete.setAttribute("title", "delete this quiz");
		newdelete.onclick = delete_quiz;
		var newul = document.createElement("ul");
		var newli1 = document.createElement("li");
		var newspan1 = document.createElement("span");
		newspan1.className = "todo";
		newspan1.innerHTML = content;
		newli1.appendChild(newspan1);
		newul.appendChild(newli1);

		var newli2 = document.createElement("li");
		var newspan2 = document.createElement("span");
		newspan2.className = "todo";
		newspan2.innerHTML = "A---" + choiceA;
		newli2.appendChild(newspan2);
		newul.appendChild(newli2);

		var newli3 = document.createElement("li");
		var newspan3 = document.createElement("span");
		newspan3.className = "todo";
		newspan3.innerHTML = "B---" + choiceB;
		newli3.appendChild(newspan3);
		newul.appendChild(newli3);

		var newli4 = document.createElement("li");
		var newspan4 = document.createElement("span");
		newspan4.className = "todo";
		newspan4.innerHTML = "C---" + choiceC;
		newli4.appendChild(newspan4);
		newul.appendChild(newli4);

		var newli5 = document.createElement("li");
		var newspan5 = document.createElement("span");
		newspan5.className = "todo";
		newspan5.innerHTML = "D---" + choiceD;
		newli5.appendChild(newspan5);
		newul.appendChild(newli5);

		newdiv.appendChild(newdelete);
		newdiv1.appendChild(newdiv2);
		newdiv2.appendChild(newdiv3);
		newdiv3.appendChild(newform);
		newform.appendChild(newdiv);
		newform.appendChild(newul);

		var left_form=document.getElementById("left").getElementsByTagName("form");
		var right_form=document.getElementById("right").getElementsByTagName("form");
		var content_right = document.getElementById("right");
		var content_left = document.getElementById("left");

		if(left_form.length > right_form.length){
			content_right.appendChild(newdiv1);
		}else{
			content_left.appendChild(newdiv1);
		}
	}
	var addquizButton = document.querySelector("[value='Add quiz']");
	addquizButton.onclick = add_quiz;

	function delete_quiz() {
		var quiz_id = this.getAttribute("quiz_id");
		var param = "id=" + quiz_id;
		console.log(param);
		new SimpleAjax("delete_quiz.php", "POST", param, delete_quiz_Success, delete_quiz_Failure);
		return false;
	}
	function delete_quiz_Failure() {
		alert("Fail to delete quiz");
	}
	function delete_quiz_Success(request) {
		var response = request.responseText;
		console.log(response);
		if(response=="no") {
			alert("Cannot delete quiz! (At least 5 quiz.)");
		} else {
			var formToDelete = document.querySelector("div[quiz_id='"+response+"']");
			formToDelete.parentNode.removeChild(formToDelete);
		}

	}
	var deletequizButtons = document.querySelectorAll("[name='delete_quiz']");
	for(var i=0; i<deletequizButtons.length; i++)
		deletequizButtons[i].onclick = delete_quiz;
};
	