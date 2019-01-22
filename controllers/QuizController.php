<?php

// require_once('includes/template-loader.php');

class QuizController extends Controller
{
    public function executeQuiz() {
        // return load_template('front/quiz.php', array());
        echo $this->twig->render('front/quiztest.twig');
    }

    public function executeScoreQuiz() {
        // return load_template('front/score.php', array());
        echo $this->twig->render('front/scoretest.twig');
    }
}