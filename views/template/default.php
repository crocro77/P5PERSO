<!--DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= $pageTitle; ?></title>
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="public/css/materialize.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="public/js/materialize.js"></script>
    <script type="text/javascript" src="public/js/slider.js"></script>
    <script type="text/javascript" src="public/js/responsive.js"></script>
  </head>
  <body class="grey darken-3">
    <nav id="nav-bar" class="blue-grey darken-4">
        <div class="container">
            <div class="nav-wrapper">
              <a class="navbar-brand" href="index.php">World of Game Gear</a>       
                <ul class="right hide-on-med-and-down">
                    <li><a title="Chat" href="index.php?p=chat"><i class="material-icons">chat_bubble</i></a></li>
                    <li><a title="Quiz" href="index.php?p=quiz"><i class="material-icons">gamepad</i></a></li>
                    <li><a title="Espace Membres" href="index.php?p=user"><i class="material-icons">portrait</i></a></li>
                    <li><a title="A propos" href="index.php?p=about"><i class="material-icons">info</i></a></li>
                    <li><a title="Contact" href="index.php?p=contact"><i class="material-icons">mail_outline</i></a></li>
                </ul>
                <ul class="side-nav" id="mobile-menu">
                  <li><a title="Administration" href="index.php?p=admin"><i class="material-icons">lock</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

      <>?php echo $content; ?>
   
    <footer>
      <p id="titleDetail">© 2018 <a href="#" data-activates="mobile-menu" id="admin-btn" class="button-collapse">ntonyyy</a> - <a title="Mentions légales" id="mention-btn" href="index.php?p=mentions" class="grey-text text-lighten-4">Mentions légales</a></p>
    </footer>   

  </body>
</html>
