<?php session_start();
$_SESSION['topic']="HTML";
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
        question : "What does HTML stand for?",
        imgSrc : "",
        choiceA : "Hyper Text Markup Language",
        choiceB : "High Text Markup Language",
        choiceC : "Hyper Tabular Markup Language",
        correct : "A"
    }, {
        question : "Which of the following browser supports HTML5 in its latest version?",
        imgSrc : "img/html300.png",
        choiceA : "Apple Safari",
        choiceB : "Google Chrome",
        choiceC : "Both Of The Above",
        correct : "C"
    },{
    question : "Which of the following tag can be used to mark up a conversation in HTML5?",
        imgSrc : "img/html300.png",
        choiceA : "footer",
        choiceB : "dialog",
        choiceC : "none of the above",
        correct : "B"
    },{
        question : "Which of the following input control represents a time (hour, minute, seconds, fractional seconds) encoded according to ISO 8601 in Web Form 2.0?",
        imgSrc : "img/html300.png",
        choiceA : "week",
        choiceB : "time",
        choiceC : "number",
        correct : "B"
    }, {
        question : "Which value of Socket.readyState atribute of WebSocket indicates that the connection is established and communication is possible?",
        imgSrc : "img/html300.png",
        choiceA : "0",
        choiceB : "1",
        choiceC : "2",
        correct : "B"
    }, {
        question : "Which of the following attribute triggers events when a form changes?",
        imgSrc : "img/html300.png",
        choiceA : "onformchange",
        choiceB : "onedit",
        choiceC : "onchange",
        correct : "A"
    }, {
        question : "Which of the following attribute triggers events when a form gets user input?",
        imgSrc : "img/html300.png",
        choiceA : "onchange",
        choiceB : "onforminput",
        choiceC : "onedit",
        correct : "B"
    }, {
        question : "How Many tags are there in HTML 5 ?",
        imgSrc : "img/html300.png",
        choiceA : "100",
        choiceB : "110",
        choiceC : "120",
        correct : "B"
    }, {
        question : "Which of the following attribute triggers event when an element is dragged?",
        imgSrc : "img/html300.png",
        choiceA : "ondrag",
        choiceB : "ondragenter",
        choiceC : "both of the above",
        correct : "A"
    }, {
        question : "Which of the following attribute specifies a keyboard shortcut to access an element in HTML5?",
        imgSrc : "img/html300.png",
        choiceA : "key",
        choiceB : "acceskey",
        choiceC : "none of the above",
        correct : "B"
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
