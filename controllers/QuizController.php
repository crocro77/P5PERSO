<?php

require_once('includes/template-loader.php');

class QuizController
{
    public function executeQuiz() {
		return load_template('quiz.php', array());
    }

    public function executeScoreQuiz() {
        return load_template('score.php', array());
    }
}