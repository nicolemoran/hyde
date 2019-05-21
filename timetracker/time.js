var timerCount = 4;
	var buttons = [{seconds: 0, minutes: 0, hours: 0}, {seconds: 0, minutes: 0, hours: 0}, {seconds: 0, minutes: 0, hours: 0}, {seconds: 0, minutes: 0, hours: 0}];

	function clearTimers() {
		for (i = 0; i < timerCount; i++) {
			if (buttons[i].hasOwnProperty("interval")) {
				clearInterval(buttons[i].interval);
			}
		};
	}

	function update() {
		for (i = 0; i < timerCount; i++) {			
			$("#" + "seconds" + i).text(buttons[i].seconds);
			$("#" + "minutes" + i).text(buttons[i].minutes);
			$("#" + "hours" + i).text(buttons[i].hours);
		};
	}

	function startTimer(a) {
		clearTimers();

		//Update the seconds, minutes, and hours
		buttons[a].interval = setInterval(function() {
			buttons[a].seconds++;
			if (buttons[a].seconds == 60) {
				buttons[a].minutes++;
				buttons[a].seconds = 0;
				if (buttons[a].minutes == 60) {
					buttons[a].hours++;
					buttons[a].minutes = 0;
				}
			}
		//Write the updated time to the page
		update();
		}, 1000);
	}

	function addTracker() {
		//Get the name of the new tracker from the text box
		var newTrackerName = $("#add").val();

		//What's the number?
		var n = buttons.length;

		//Create a new element
		var newButton = document.createElement("button");
		newButton.innerHTML = newTrackerName;
		newButton.id = "button" + n;
		var value = "startTimer(" + n + ")";

		//Create new spans
		var span1 = document.createElement("span");
		span1.id = "seconds" + n;
		var span2 = document.createElement("span");
		span2.id = "minutes" + n;
		var span3 = document.createElement("span");
		span3.id = "hours" + n;
		
		//Add the new button and spans to the buttons div
		$("#buttonDiv").append(newButton);
		$("#buttonDiv").append(span3);
		$("#buttonDiv").append(":");
		$("#buttonDiv").append(span2);
		$("#buttonDiv").append(":");
		$("#buttonDiv").append(span1);
		$("#buttonDiv").append("<br>");

		$("#button" + n).attr("onclick", value);

		//Add a new item to the buttons array
		buttons.push({seconds: 0, minutes: 0, hours: 0});

		//Add one to the timer count
		timerCount = buttons.length;

		//Pick a random color
		var color = randomColor();

		//Give the new button that color as a class
		$("#button" + n).attr("class", color);
	}

	//Generates a random color out of four options
	function randomColor() {
		var num = Math.floor(Math.random() * 4);

		if (num == 0) {
			return "button pink";
		} else if (num == 1) {
			return "button yellow";
		} else if (num == 2) {
			return "button green";
		} else if (num == 3) {
			return "button blue";
		} else {
			return "something went wrong";
		};
	}