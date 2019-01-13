<?php

require_once('includes/template-loader.php');

class ContactController
{
    public function executeContact()
    {
		return load_template('front/contact.php', array());
    }

    public function executeSendMessage()
    {
        if(isset($_POST['mailform']))
        {
            if(!empty($_POST['contactname']) AND !empty($_POST['contactmail']) AND !empty($_POST['contactmessage']))
            {
                $header="MIME-Version: 1.0\r\n";
                $header.='From:"World of Game Gear"<anthony.fumo@gmail.com>'."\n";
                $header.='Content-Type:text/html; charset="uft-8"'."\n";
                $header.='Content-Transfer-Encoding: 8bit';

                $message='
                <html>
                    <body>
                        <div align="center">
                            <u>Nom de l\'expéditeur :</u>'.$_POST['contactname'].'<br />
                            <u>Mail de l\'expéditeur :</u>'.$_POST['contactmail'].'<br />
                            <br />
                            '.nl2br($_POST['contactmessage']).'
                            <br />
                        </div>
                    </body>
                </html>
                ';

                mail("anthony.fumo@gmail.com", "CONTACT - World of Game Gear", $message, $header);
                $msg="Votre message a bien été envoyé !";
            } else {
                $msg="Tous les champs doivent être complétés !";
            }
        }
    }
}