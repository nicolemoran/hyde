//This function runs when the user clicks #submitbutton on quiz.html
function validatequiz() {
    //Store each answer in a variable
    var a1 = document.forms["quiz"]["q1"].value;
    var a2 = document.forms["quiz"]["q2"].value;
    var a3 = document.forms["quiz"]["q3"].value;
    var a4 = document.forms["quiz"]["q4"].value;
    var a5 = document.forms["quiz"]["q5"].value;
    var a6 = document.forms["quiz"]["q6"].value;
    var a7 = document.forms["quiz"]["q7"].value;
    var a8 = document.forms["quiz"]["q8"].value;

    var rightCounter = 0;

    //Validate Question 1
    if (a1 == "a") {
      $('#q1').addClass('right');
      rightCounter++;
    }
    else {
      $('#q1').addClass('wrong');
    };

    //Validate Question 2
    if (a2 == "d") {
      $('#q2').addClass('right');
      rightCounter++;
    }
    else {
      $('#q2').addClass('wrong');
    }

    //Validate Question 3
    if (a3 == "d") {
      $('#q3').addClass('right');
      rightCounter++;
    }
    else {
      $('#q3').addClass('wrong');
    }

    //Validate Question 4
    if (a4 == "d") {
      $('#q4').addClass('right');
      rightCounter++;
    }
    else {
      $('#q4').addClass('wrong');
    }

    //Validate Question 5
    if (a5 == "c") {
      $('#q5').addClass('right');
      rightCounter++;
    }
    else {
      $('#q5').addClass('wrong');
    }

    //Validate Question 6
    if (a6 == "b") {
      $('#q6').addClass('right');
      rightCounter++;
    }
    else {
      $('#q6').addClass('wrong');
    }

    //Validate Question 7
    if (a7 == "a") {
      $('#q7').addClass('right');
      rightCounter++;
    }
    else {
      $('#q7').addClass('wrong');
    }

    //Validate Question 8
    if (a8 == "c") {
      $('#q8').addClass('right');
      rightCounter++;
    }
    else {
      $('#q8').addClass('wrong');
    }

    //Write the number of correct answers to the top of the page.
    $('#results').html("<p>You got " + rightCounter + "/8 correct!</p>");
}