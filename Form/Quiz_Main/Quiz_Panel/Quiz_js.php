<?php session_start();
$_SESSION['topic']="Java Script";
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
        question : "Which of the following is correct about features of JavaScript?",
        imgSrc : "",
        choiceA : "JavaScript is a lightweight, interpreted programming language.",
        choiceB : "JavaScript is designed for creating network-centric applications",
        choiceC : "All Of The Above",
        correct : "c"
        },{
        question : "Can you pass a anonymous function as an argument to another function?",
        imgSrc : "",
        choiceA : "True",
        choiceB : "False",
        choiceC : "Cant say",
        correct : "a"
        },{
        question : "Which built-in method returns the character at the specified index?",
        imgSrc : "",
        choiceA : "characterAt()",
        choiceB : "getCharAt()",
        choiceC : "charAt()",
        correct : "c"
        },{
        question : "Which built-in method returns the characters in a string beginning at the specified location?",
        imgSrc : "",
        choiceA : "substr()",
        choiceB : "slice()",
        choiceC : "None Of Them",
        correct : "a"
        },{
        question : "Which of the following function of Number object defines how many total digits to display of a number?",
        imgSrc : "",
        choiceA : "toExponential()",
        choiceB : "toPrecision()",
        choiceC : "toLocaleString()",
        correct : "b"
        },{
        question : "Which of the following function of String object returns the characters in a string beginning at the specified location through the specified number of characters?",
        imgSrc : "",
        choiceA : "search()",
        choiceB : "split()",
        choiceC : "substr()",
        correct : "c"
        },{
        question : "Which of the following function of String object returns a string representing the specified object?",
        imgSrc : "",
        choiceA : "toLocaleUpperCase()",
        choiceB : "toUpperCase()",
        choiceC : "toString()",
        correct : "c"
        },{
        question : "Which of the following function of String object causes a string to be displayed in fixed-pitch font as if it were in a <tt> tag?",
        imgSrc : "",
        choiceA : "fixed()",
        choiceB : "bold()",
        choiceC : "blink()",
        correct : "a"
        },{
        question : "Which of the following function of Array object creates a new array with the results of calling a provided function on every element in this array?",
        imgSrc : "",
        choiceA : "push()",
        choiceB : "joint()",
        choiceC : "map()",
        correct : "c"
        },{
        question : "Which of the following function of Array object applies a function simultaneously against two values of the array (from right-to-left) as to reduce it to a single value?",
        imgSrc : "",
        choiceA : "pop()",
        choiceB : "push()",
        choiceC : "reduceRight()",
        correct : "c"
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
