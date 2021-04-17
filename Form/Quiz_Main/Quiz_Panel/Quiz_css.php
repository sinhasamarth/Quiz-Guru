<?php session_start();
$_SESSION['topic']="CSS";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <div id="start">Start Quiz!</div>
        <div id="quiz" style="display: none">
            <div id="question"></div>
            <div id="qImg"></div>
            <div id="choices">
                <div class="choice" id="A" onclick="checkAnswer('A')"></div>
                <div class="choice" id="B" onclick="checkAnswer('B')"></div>
                <div class="choice" id="C" onclick="checkAnswer('C')"></div>
            </div>
            <div id="timer">
                <div id="counter"></div>
                <div id="btimeGauge"></div>
                <div id="timeGauge"></div>
            </div>
            <div id="progress"></div>
        </div>
        <div id="scoreContainer" style="display: none"></div>
    </div>
    <script>
            // select all elements
const start = document.getElementById("start");
const quiz = document.getElementById("quiz");
const question = document.getElementById("question");
const qImg = document.getElementById("qImg");
const choiceA = document.getElementById("A");
const choiceB = document.getElementById("B");
const choiceC = document.getElementById("C");
const counter = document.getElementById("counter");
const timeGauge = document.getElementById("timeGauge");
const progress = document.getElementById("progress");
const scoreDiv = document.getElementById("scoreContainer");
const choice = document.getElementById("choices");
const container = document.getElementById("container");

// create our questions
let questions = [
    {
    question : "Which of the following is a component of CSS style rule?",
        imgSrc : "",
        choiceA : "Selector",
        choiceB : "Property",
        choiceC : "Both Of Them",
        correct : "c"
        },{
        question : "Which of the following defines a measurement in inches?",
        imgSrc : "",
        choiceA : "Inch",
        choiceB : "MM",
        choiceC : "pc",
        correct : "a"
        },{
        question : "Which of the following uses 1vw or 1vh, whichever is smaller?",
        imgSrc : "",
        choiceA : "px",
        choiceB : "Vmin",
        choiceC : "vw",
        correct : "b"
        },{
        question : "Which of the following property is used to set the background image of an element?",
        imgSrc : "",
        choiceA : "background-color",
        choiceB : "background-image",
        choiceC : "background-position",
        correct : "b"
        },{
        question : "Which of the following property is used as shorthand to specify a number of other font properties?",
        imgSrc : "",
        choiceA : "font",
        choiceB : "font-size",
        choiceC : "font-weight",
        correct : "a"
        },{
        question : "Which of the following property is used to control the flow and formatting of text?",
        imgSrc : "",
        choiceA : "white-space",
        choiceB : "text-shadow",
        choiceC : "text-decoration",
        correct : "a"
        },{
        question : "Which of the following property changes the color of bottom border?",
        imgSrc : "",
        choiceA : "border:",
        choiceB : "border-bottom:",
        choiceC : "border-style:",
        correct : "b"
        },{
        question : "Which of the following property changes the width of left border?",
        imgSrc : "",
        choiceA : "border-bottom-width:",
        choiceB : "border-top-width",
        choiceC : "border-left-width",
        correct : "c"
        },{
        question : "Which of the following property changes the width of right border?",
        imgSrc : "",
        choiceA : "border-bottom-width",
        choiceB : "border-top-width",
        choiceC : "border-right-width",
        correct : "c"
        },{
        question : "Which of the following property specifies the left padding of an element?",
        imgSrc : "",
        choiceA : "padding-top",
        choiceB : "padding-left",
        choiceC : "padding-right",
        correct : "b"
        }
];

// create some variables

const lastQuestion = questions.length - 1;
let runningQuestion = 0;
let count = 0;
const questionTime = 10; // 10s
const gaugeWidth = 150; // 150px
const gaugeUnit = gaugeWidth / questionTime;
let TIMER;
let score = 0;

// render a question
function renderQuestion(){
    let q = questions[runningQuestion];
    
    question.innerHTML = "<p>"+ q.question +"</p>";
    qImg.innerHTML = "<img src="+ q.imgSrc +">";
    choiceA.innerHTML = q.choiceA;
    choiceB.innerHTML = q.choiceB;
    choiceC.innerHTML = q.choiceC;
}

start.addEventListener("click",startQuiz);

// start quiz
function startQuiz(){
    start.style.display = "none";
    renderQuestion();
    quiz.style.display = "block";
    renderProgress();
    renderCounter();
    TIMER = setInterval(renderCounter,1000); // 1000ms = 1s
}

// render progress
function renderProgress(){
    for(let qIndex = 0; qIndex <= lastQuestion; qIndex++){
        progress.innerHTML += "<div class='prog' id="+ qIndex +"></div>";
    }
}

// counter render

function renderCounter(){
    if(count <= questionTime){
        counter.innerHTML = count;
        timeGauge.style.width = count * gaugeUnit + "px";
        count++
    }else{
        count = 0;
        // change progress color to red
        answerIsWrong();
        if(runningQuestion < lastQuestion){
            runningQuestion++;
            renderQuestion();
        }else{
            // end the quiz and show the score
            clearInterval(TIMER);
            scoreRender();
        }
    }
}

// checkAnwer

function checkAnswer(answer){
    if( answer == questions[runningQuestion].correct){
        // answer is correct
        score++;
        // change progress color to green
        answerIsCorrect();
    }else{
        // answer is wrong
        // change progress color to red
        answerIsWrong();
    }
    count = 0;
    if(runningQuestion < lastQuestion){
        runningQuestion++;
        renderQuestion();
    }else{
        // end the quiz and show the score
        clearInterval(TIMER);
        scoreRender();
    }
}

// answer is correct
function answerIsCorrect(){
    document.getElementById(runningQuestion).style.backgroundColor = "#83f52c";
}

// answer is Wrong
function answerIsWrong(){
    document.getElementById(runningQuestion).style.backgroundColor = "#FB2B11";
}

// score render
function scoreRender(){
    
    scoreDiv.style.display = "block";
     quiz.style.display = "none";
    
    // calculate the amount of question percent answered by the user
    const scorePerCent = Math.round(100 * score/questions.length);
    localStorage.setItem("score", scorePerCent);
    
    if(scorePerCent>= 75)
    {
        window.location.replace("Certificate/");
    }

    else{
        window.location.replace("notpass.php");
    }
}

</script>
</body>
</html>
<?php
   
?>
