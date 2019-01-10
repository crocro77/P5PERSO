<?php

require_once('includes/template-loader.php');

class AboutController
{
    public function executeAbout() {
        $aboutManager = new About();
        $aboutDescription = $aboutManager->getAboutDescription();

        return load_template('front/about.php', array('aboutDescription' => $aboutDescription));
    }

    public function executeAddAbout() {
        if(isset($_POST['description'])) {
            $aboutManager = new About();
            $aboutManager->setDescription($_POST['description']);
            $aboutManager->add($about);
            header("Location:index.php?p=about");
        }	
    }

    public function executeUpdateAbout() {
        $aboutManager = new About();
			if($aboutDescription) {
				if(isset($_POST['description'])) {
					$aboutManager->setDescription($_POST['description']);
					$aboutManager->update($description, $id);
					header("Location:index.php?p=admin&tab=settings");
                }
            }
    }

    public function executeDeleteAbout() {
		$aboutManager = new About();
		$aboutManager->deleteDescription();
		header("Location:index.php?p=admin&tab=settings");
    }
}