<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz App Results</title>
        <link rel="stylesheet" href="A1.css">
    </head>
    <body>
        <?php
        //access the quiz from the previous page
        $theQuiz = $_SESSION['myQuiz'];
        $quizQuestions = $theQuiz["questions"];
        //if all questions have NOT been answered, redirect to error page
        for($i = 0; $i < count($quizQuestions); $i++){
            if(!isset($_POST["question" . $i])){
                header("location: errorPage.php");
                return;
            }
        }
            //rebuild questions
            $title = $theQuiz["title"];
            echo "<h1>" . $title . "</h1>";
            
            $questions = $theQuiz['questions'];
            //set score counter
            $totalScore = 0;
            echo "<form>";
            for($i = 0; $i < count($questions); $i++){
                $q = $questions[$i];
                echo "<div class='question'>";
                echo "<h3>" . "Question " . ($i + 1) . "</h3>";
                echo "<h4>" . $q["questionText"] . "</h4>";
                $choices = $q["choices"];
                for ($a = 0; $a < count($choices); $a++){
                    $choice = $choices[$a];
                    echo "<p><input type='radio' value='" . $choice . "'name='question" . $i . "'> " . $choice . "</p>";
                }
                //if user answered correctly, add 1 point to their total score
                $currentScore = $choices[$q["answer"]] === $_POST["question" . $i] ? 1 : 0;
                $totalScore += $currentScore;
                //if user's answer is incorrect, show answer, along with the correct answer
                if ($choices[$q["answer"]] !== $_POST["question" . $i]) {
                    echo "<p class='incorrect'>" . "Your answer: " . $_POST["question" . $i] . "(incorrect)</p>";
                    echo "<p>" . "Correct answer: " . $choices[$q["answer"]] . "</p>";
                }
                else{
                    echo "<p class='correct'>" . "Your answer: " . $_POST["question" . $i] . "(correct!)</p>";
                }
                echo "</div>";
            }
            echo "<h4>Your Score</h4>";
            echo "<p>" . "Your total score on this quiz was " . $totalScore . "!</p>";
            echo "</form>";
        ?>
    </body>
</html>
