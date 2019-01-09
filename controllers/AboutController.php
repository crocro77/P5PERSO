<?php

require_once('includes/template-loader.php');

class AboutController
{
    public function executeAbout() {
        $aboutManager = new About();
        $aboutDescription = $aboutManager->getAboutDescription();

        return load_template('front/about.php', array('aboutDescription' => $aboutDescription));
    }
}