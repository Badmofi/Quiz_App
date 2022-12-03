<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz App Assignment</title>
        <link rel="stylesheet" href="A1.css">
    </head>
    <body>
        <?php
         include 'ChromePhp.php';
         include 'FileUtils.php';

         //read data from json
         $fileName = "WorldGeography.json";
         $fileContents = readFileIntoString($fileName);
         $quiz = json_decode($fileContents, true);

         
         //display quiz
         buildQuiz();
         
         function buildQuiz(){ 
             //display quiz title
             global $quiz;
             $title = $quiz["title"];
             echo "<h1>" . $title . "</h1>";
             
             //build quiz
             $questions = $quiz["questions"];
             echo "<form action='results.php' method='POST'>";
             for ($i = 0; $i < count($questions); $i++) {
                $q = $questions[$i];
                //question number
                echo "<div class='question'>";
                echo "<h3>" . "Question " . ($i + 1) . "</h3>";
                echo "<h4>" . $q["questionText"] . "</h4>";
                $choices = $q["choices"];
                for ($a = 0; $a < count($choices); $a++) {
                    $choice = $choices[$a];
                    echo "<p><input type='radio' value='" . $choice . "'name='question" . $i . "'> " . $choice . "</p>";
                }
                echo "</div>";
             }
             echo "<button type='submit'>Submit</button>";
             echo "</form>";
        }
         //store quiz inside session variable
         $_SESSION['myQuiz'] = $quiz;
        ?>
    </body>
</html>
