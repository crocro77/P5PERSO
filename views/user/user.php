<br />
<div class="container">
	<?php
    include('views/user/user-nav.php');

    if ($selectedTab == 'dashboard') {
        include('views/user/userdashboard.php');
    }
    elseif ($selectedTab == 'list') {
        include('views/user/user-list-sheets.php');
    }
    elseif ($selectedTab == 'write') {
        include('views/user/userwrite.php');
    }
    elseif ($selectedTab == 'settings') {
        include('views/user/usersettings.php');
    }
    ?>
</div>