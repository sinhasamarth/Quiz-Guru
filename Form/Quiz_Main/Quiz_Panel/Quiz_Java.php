<?php session_start();
$_SESSION['topic']="Java";
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
        question : "What of the following is the default value of an instance variable?",
        imgSrc : "",
        choiceA : "Null",
        choiceB : "0",
        choiceC : "Depends upon the type of variable",
        correct : "c"
        },{
        question : "What is the size of char variable?",
        imgSrc : "",
        choiceA : "8 bit",
        choiceB : "16 bit",
        choiceC : "32 bit",
        correct : ""
        },{
        question : "What is the default value of byte variable?",
        imgSrc : "",
        choiceA : "0",
        choiceB : "0.0",
        choiceC : "null",
        correct : "a"
        },{
        question : "Which of the following is false about String?",
        imgSrc : "",
        choiceA : "String is immutable",
        choiceB : "String is a primary data type",
        choiceC : "String can be created using new operator",
        correct : "b"
        },{
        question : "What is an Interface?",
        imgSrc : "",
        choiceA : " An interface is a collection of abstract methods",
        choiceB : "Interface is an abstract class",
        choiceC : "Interface is an concrete class",
        correct : "b"
        },{
        question : "What is Set Interface?",
        imgSrc : "",
        choiceA : "Set is a collection of element which cannot contain duplicate elements.",
        choiceB : "Set is a collection of element which contains elements along with their key.",
        choiceC : "None of Above",
        correct : "a"
        },{
        question : "Method Overloading is an example of",
        imgSrc : "",
        choiceA : "Static Binding",
        choiceB : "Dynamic Binding",
        choiceC : "Both of the above",
        correct : "a"
        },{
        question : "Is it necessary that each try block must be followed by a finally block?",
        imgSrc : "",
        choiceA : "True",
        choiceB : "False",
        choiceC : "Can't Say",
        correct : "b"
        },{
        question : "What is a marker interface?",
        imgSrc : "",
        choiceA : "marker interface is an interface with no method",
        choiceB : " marker interface is an interface with single method, marker()",
        choiceC : "none of the above",
        correct : "a"
        },{
        question : "What happens when thread's sleep() method is called?",
        imgSrc : "",
        choiceA : "Thread returns to the ready state",
        choiceB : "Thread returns to the waiting state",
        choiceC : "Thread starts running",
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
