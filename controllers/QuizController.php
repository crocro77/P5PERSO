<?php

class QuizController extends Controller
{
    public function executeQuiz() {
        echo $this->twig->render('front/quiz.twig');
    }

    public function executeScoreQuiz() {
        echo $this->twig->render('front/score.twig');
    }
}