<?php

class AboutController extends Controller
{
    public function executeAbout()
    {
        $aboutManager = new About();
        $aboutDescription = $aboutManager->getAboutDescription();

        // return load_template('front/about.php', array('aboutDescription' => $aboutDescription));
        echo $this->twig->render('front/about.twig', ['aboutDescription' => About::getAboutDescription()]);
    }

    public function executeAddAbout()
    {
        if(isset($_POST['description'])) {
            $errors = '';
            if (empty($_POST['description'])) {
                $errors .= '<li>La description est obligatoire.</li>';
            }
            if (empty($errors)) {
                $aboutAdd = new About();
                $aboutAdd->setDescription($_POST['description']);
                $aboutAdd->add($about);
                header("Location:index.php?p=about");
            } else {
				$_SESSION['flash']['error'] = '<ul>' . $errors . '</ul>';
			}	
        }
        // return load_template('front/about.php', array('aboutDescription' => $aboutDescription));
        echo $this->twig->render('front/abouttest.twig');
    }

    public function executeUpdateAbout()
    {
        $aboutUpdate = new About();
        if(isset($_GET['id'])) {
            if($aboutDescription) {
                if(isset($_POST['description'])) {
                    $aboutUpdate->setDescription($_POST['description']);
                    $aboutUpdate->update($description, $id);
                    header("Location:index.php?p=about");
                }
            }
        }
        // return load_template('front/about.php', array('aboutDescription' => $aboutDescription));
        echo $this->twig->render('front/abouttest.twig');
    }

    public function executeDeleteAbout()
    {
		$aboutManager = new About();
		$aboutManager->deleteDescription();
		header("Location:index.php?p=admin&tab=settings");
    }
}