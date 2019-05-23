	window.onload = function() {
		var button = document.getElementById("submit_button");
		button.addEventListener("click", quiz);
	}

	function quiz() {
		var nate = 0;
		var isabel = 0;
		var ivory = 0;
		var kelci = 0;
		var garrett = 0;
		var zina = 0;
		var roy = 0;
		var mackenzie = 0;
		var james = 0;
		var darrien = 0;
		var dillan = 0;
		var julio = 0;
		var gabby = 0;

		var quiz = document.getElementById("quiz");
		var a1 = document.forms["quiz"]["newguy"].value;
		var a2 = document.forms["quiz"]["perceptive"].value;
		var a3 = document.forms["quiz"]["opinion"].value;
		var a4 = document.forms["quiz"]["rude"].value;
		var a5 = document.forms["quiz"]["silly"].value;
		var a6 = document.forms["quiz"]["spiritual"].value;
		var a7 = document.forms["quiz"]["social"].value;
		var a8 = document.forms["quiz"]["secrets"].value;
		var a9 = document.forms["quiz"]["confident"].value;
		var a10 = document.forms["quiz"]["mindbody"].value;
		var a11 = document.forms["quiz"]["imagination"].value;
		var a12 = document.forms["quiz"]["family"].value;
		var a13 = document.forms["quiz"]["advice"].value;
		var a14 = document.forms["quiz"]["patient"].value;
		var a15 = document.forms["quiz"]["dating"].value;


		if (a1 == "a") {
			james++;
			darrien++;
		}
		else if (a1 == "b") {
			nate++;
			kelci++;
			garrett++;
		}
		else if (a1 == "c") {
			julio++;
			dillan++;
			isabel++;
			zina++;
			mackenzie++;
		}
		else if (a1 == "d") {
			roy++;
		}
		else if (a1 == "e") {
			ivory++;
			gabby++;
		}

		if (a2 == "a") {
			ivory++;
			kelci++;
		}
		else if (a2 == "b") {
			james++;
			isabel++;
			zina++;
			mackenzie++;
		}
		else if (a2 == "c") {
			darrien++;
			julio++;
			garrett++;
		}
		else if (a2 == "d") {
			dillan++;
			gabby++;
		}
		else if (a2 == "e") {
			nate++;
			roy++;
		}

		if (a3 == "a") {
			james++;
			darrien++;
			ivory++;
		}
		else if (a3 == "b") {
			nate++;
			kelci++;
			zina++;
			mackenzie++;
			roy++;
		}
		else if (a3 == "c") {
			isabel++;
		}
		else if (a3 =="d") {
			julio++;
			dillan++;
			garrett++;
		}
		else if (a3 == "e") {
			gabby++;
		}

		if (a4 == "a") {
			ivory++;
		}
		else if (a4 == "b") {
			darrien++;
			kelci++;
			zina++;
		}
		else if (a4 == "c") {
			nate++;
			james++;
		}
		else if (a4 == "d") {
			julio++;
			dillan++;
			garrett++;
			gabby++;
			roy++;
		}
		else if (a4 == "e") {
			mackenzie++;
		}
		else if (a4 == "f") {
			isabel++;
		}

		if (a5 == "a") {
			darrien++;
			garrett++;
		}
		else if (a5 == "b") {
			james++;
			zina++;
			mackenzie++;
		}
		else if (a5 == "c") {
			nate++;
			kelci++;
		}
		else if (a5 == "d") {
			isabel++;
			julio++;
			gabby++;
			roy++;
		}
		else if (a5 == "e") {
			dillan++;
			ivory++;
		}

		if (a6 == "a") {
			dillan++;
		}
		else if (a6 == "b") {
			nate++;
			james++;
			darrien++;
			zina++;
		}
		else if (a6 == "c") {
			julio++;
			isabel++;
			garrett++;
		}
		else if (a6 == "d") {
			kelci++;
			gabby++;
			mackenzie++;
			roy++;
		}
		else if (a6 == "e") {
			ivory++;
		}

		if (a7 == "a") {
			darrien++;
			kelci++;
			garrett++;
		}
		else if (a7 == "b") {
			james++;
		}
		else if (a7 == "c") {
			nate++;
			dillan++;
			zina++;
		}
		else if (a7 == "d") {
			mackenzie++;
			roy++;
		}
		else if (a7 == "e") {
			julio++;
			ivory++;
		}
		else if (a7 == "f") {
			isabel++;
		}

		if (a8 == "a") {
			nate++;
			roy++;
		}
		else if (a8 == "b") {
			ivory++;
			isabel++;
			gabby++;
		}
		else if (a8 =="c") {
			zina++;
		}
		else if (a8 == "d") {
			james++;
		}
		else if (a8 == "e") {
			darrien++;
			garrett++;
		}
		else if (a8 == "f") {
			julio++;
			dillan++;
			kelci++;
			mackenzie++;
		}

		if (a9 == "a") {
			darrien++;
			kelci++;
			zina++;
			garrett++;
		}
		else if (a9 == "b") {
			dillan++;
		}
		else if (a9 == "c") {
			james++;
			ivory++;
			mackenzie++;
			roy++;
		}
		else if (a9 == "d") {
			nate++;
			julio++;
			isabel++;
			gabby++;
		}

		if (a10 == "a") {
			nate++;
			dillan++;
			ivory++;
			kelci++;
			zina++;
			mackenzie++;
			roy++;
		}
		else if (a10 == "b") {
			james++;
			julio++;
		}
		else if (a10 == "c") {
			darrien++;
			garrett++;
		}
		else if (a10 == "d") {
			isabel++;
			gabby++;
		}

		if (a11 == "a") {
			james++;
			darrien++;
			isabel++;
			zina++;
			mackenzie++;
		}
		else if (a11 == "b") {
			kelci++;
			nate++;
		}
		else if (a11 == "c") {
			julio++;
			gabby++;
		}
		else if (a11 == "d") {

		}
		else if (a11 == "e") {
			dillan++;
			garrett++;
			roy++;
		}
		else if (a11 == "f") {
			ivory++;
		}

		if (a12 == "a") {
			dillan++;
			isabel++
		}
		else if (a12 == "b") {
			julio++;
			zina++;
			gabby++;
		}
		else if (a12 == "c") {
			ivory++;
			kelci++;
			mackenzie++;
			garrett++;
			roy++;
		}
		else if (a12 == "d") {
			nate++;
		}
		else if (a12 == "e") {
			james++;
			darrien++;
		}
		else if (a12 == "f") {

		}

		if (a13 == "a") {
			nate++;
			zina++;
			roy++;
		}
		else if (a13 == "b") {
			james++;
		}
		else if (a13 == "c") {
			julio++;
			darrien++;
		}
		else if (a13 == "d") {
			isabel++;
			gabby++;
		}
		else if (a13 == "e") {
			dillan++;
			mackenzie++;
			garrett++;
		}
		else if (a13 == "f") {
			ivory++;
			kelci++;
		}

		if (a14 == "a") {
			nate++;
			gabby++;
			roy++;
		}
		else if (a14 == "b") {
			julio++;
			dillan++;
			isabel++;
			zina++;
			garrett++;
		}
		else if (a14 == "c") {
			ivory++;
		}
		else if (a14 == "d") {
			james++;
		}
		else if (a14 == "e") {
			kelci++;
			mackenzie++;
		}
		else if (a14 == "f") {
			darrien++;
		}

		if (a15 == "a") {
			darrien++;
		}
		else if (a15 == "b") {
			james++;
		}
		else if (a15 == "c") {
			zina++;
			mackenzie++;
		}
		else if (a15 == "d") {
			kelci++;
		}
		else if (a15 == "e") {
			julio++;
			nate++;
		}
		else if (a15 == "f") {
			garrett++;
			roy++;
		}
		else if (a15 == "g") {
			ivory++;
			dillan++;
			isabel++;
			gabby++;
		}

		//Figure out which variable has the highest value
		if (nate > isabel && nate > zina && nate > ivory && nate > kelci && nate > garrett && nate > roy && nate > mackenzie && nate > james && nate > dillan && nate > darrien && nate > julio && nate > gabby) {
			document.write("You are Nate!");
		}
		else if (isabel > nate && isabel > zina && isabel > ivory && isabel > kelci && isabel > garrett && isabel > roy && isabel > mackenzie && isabel > james && isabel > dillan && isabel > darrien && isabel > julio && isabel > gabby) {
			document.write("You are Isabel!");
		}
		else if (zina > isabel && zina > nate && zina > ivory && zina > kelci && zina > garrett && zina > roy && zina > mackenzie && zina > james && zina > dillan && zina > darrien && zina > julio && zina > gabby) {
			document.write("You are Zina!");
		}
		else if (ivory > isabel && ivory > zina && ivory > nate && ivory > kelci && ivory > garrett && ivory > roy && ivory > mackenzie && ivory > james && ivory > dillan && ivory > darrien && ivory > julio && ivory > gabby) {
			document.write("You are Ivory!");
		}
		else if (kelci > isabel && kelci > zina && kelci > ivory && kelci > nate && kelci > garrett && kelci > roy && kelci > mackenzie && kelci > james && kelci > dillan && kelci > darrien && kelci > julio && kelci > gabby) {
			document.write("You are Kelci!");
		}
		else if (garrett > isabel && garrett > zina && garrett > ivory && garrett > kelci && garrett > nate && garrett > roy && garrett > mackenzie && garrett > james && garrett > dillan && garrett > darrien && garrett > julio && garrett > gabby) {
			document.write("You are Garrett!");
		}
		else if (roy > isabel && roy > zina && roy > ivory && roy > kelci && roy > garrett && roy > nate && roy > mackenzie && roy > james && roy > dillan && roy > darrien && roy > julio && roy > gabby) {
			document.write("You are Roy!");
		}
		else if (mackenzie > isabel && mackenzie > zina && mackenzie > ivory && mackenzie > kelci && mackenzie > garrett && mackenzie > roy && mackenzie > nate && mackenzie > james && mackenzie > dillan && mackenzie > darrien && mackenzie > julio && mackenzie > gabby) {
			document.write("You are Mackenzie!");
		}
		else if (james > isabel && james > zina && james > ivory && james > kelci && james > garrett && james > roy && james > mackenzie && james > nate && james > dillan && james > darrien && james > julio && james > gabby) {
			document.write("You are James!");
		}
		else if (dillan > isabel && dillan > zina && dillan > ivory && dillan > kelci && dillan > garrett && dillan > roy && dillan > mackenzie && dillan > james && dillan > nate && dillan > darrien && dillan > julio && dillan > gabby) {
			document.write("You are Dillan!");
		}
		else if (darrien > isabel && darrien > zina && darrien > ivory && darrien > kelci && darrien > garrett && darrien > roy && darrien > mackenzie && darrien > james && darrien > dillan && darrien > nate && darrien > julio && darrien > gabby) {
			document.write("You are Darrien!");
		}
		else if (julio > isabel && julio > zina && julio > ivory && julio > kelci && julio > garrett && julio > roy && julio > mackenzie && julio > james && julio > dillan && julio > darrien && julio > nate && julio > gabby) {
			document.write("You are Julio!");
		}
		else if (gabby > isabel && gabby > zina && gabby > ivory && gabby > kelci && gabby > garrett && gabby > roy && gabby > mackenzie && gabby > james && gabby > dillan && gabby > darrien && gabby > julio && gabby > nate) {
			document.write("You are Gabby!");
		}
		else {
			document.write("Sorry, it was too close to call.")
		}

		console.log(nate);
		console.log(isabel);
		console.log(zina);
		console.log(ivory);
		console.log(kelci);
		console.log(garrett);
		console.log(roy);
		console.log(mackenzie);
		console.log(james);
		console.log(dillan);
		console.log(darrien);
		console.log(julio);
		console.log(gabby);
	}