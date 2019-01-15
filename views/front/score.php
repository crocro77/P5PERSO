<br />
<div id="score" class="container grey lighten-3">
	<div class="row center">
        <div id="wrapper">

            <h1>Résultat</h1>
            <br />

            <?php
                $answer1 = $_POST['answerOne'];
                $answer2 = $_POST['answerTwo'];
                $answer3 = $_POST['answerThree'];
                $answer4 = $_POST['answerFour'];
                $answer5 = $_POST['answerFive'];
                $answer6 = $_POST['answerSix'];
                $answer7 = $_POST['answerSeven'];
                $answer8 = $_POST['answerEight'];
                $answer9 = $_POST['answerNine'];
                $answer10 = $_POST['answerTen'];
                $score = 0;
                
                if ($answer1 == "A"){$score++;}
                if ($answer2 == "C"){$score++;}
                if ($answer3 == "A"){$score++;}
                if ($answer4 == "B"){$score++;}
                if ($answer5 == "C"){$score++;}
                if ($answer6 == "A"){$score++;}
                if ($answer7 == "B"){$score++;}
                if ($answer8 == "A"){$score++;}
                if ($answer9 == "B"){$score++;}
                if ($answer10 == "C"){$score++;}

                if (isset($_SESSION['username'])) {
                    echo ($_SESSION['username']);
                } else {
                    echo "<p>Cher visiteur :</p>";
                }
                    echo "<p id='score-result' class='center'>Votre score est de<br> $score/10</p>";

                if($score > 0 && $score < 5){
                    echo "<p class='center'>Pas terrible</p>";
                } elseif ($score > 5 && $score < 10){
                    echo "<p class='center'>Très bien</p>";
                } elseif ($score == 10){
                    echo "<p class='center'>Waouh ! Parfait !</p>";
                } else {
                    echo "<p class='center'>Aïe Aïe Aïe</p>";
                }
                
            ?>
            
            <a title="Quiz" class="btn btn-default btn-sm" href="index.php?p=quiz">Retour au quiz</a>
        </div>
    </div>
</div>