<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= $pageTitle; ?></title>
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="public/css/materialize.css"  media="screen,projection"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="public/js/materialize.js"></script>
    <script type="text/javascript" src="public/js/slider.js"></script>
  </head>
  <body>
    <nav class="black">
        <div class="container">
            <div class="nav-wrapper">
              <a class="navbar-brand" href="index.php">World of Game Gear</a>       
                <ul class="right hide-on-med-and-down">
                    <li><a title="Chat" href="#"><i class="material-icons">chat_bubble</i></a></li>
                    <li><a title="Administration" href="index.php?p=admin"><i class="material-icons">lock</i></a></li>
                    <li><a title="A propos" href="#"><i class="material-icons">info</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

      <?= $content; ?>
      
    <footer>
        <p id="titleDetail">2018 - ntonyyy</p>
    </footer>
  </body>
</html>
