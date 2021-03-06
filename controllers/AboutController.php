<?php

class AboutController extends Controller
{
    public function executeAbout()
    {
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
                $aboutAdd->addAbout();
                header('Location: '.generateURL('about'));
            } else {
                ?>
				<div class="card red">
					<div class="card-content white-text">
						<?php echo $errors."<br/>"; ?>
					</div>
				</div>
				<?php
			}	
        }

        echo $this->twig->render('admin/admin.twig');
    }

    public function executeDeleteAbout()
    {
		$aboutManager = new About();
		$aboutManager->deleteDescription();
		header('Location: '.generateURL('admin?tab=settings'));
    }
}