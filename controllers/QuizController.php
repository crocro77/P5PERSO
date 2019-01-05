<?php

require_once('includes/template-loader.php');

class QuizController
{
    public function executeQuiz() {
		return load_template('front/quiz.php', array());
    }

    public function executeScoreQuiz() {
        return load_template('front/score.php', array());
    }
}