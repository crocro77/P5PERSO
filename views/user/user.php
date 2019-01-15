<br />
<div class="container">
	<?php
    include('views/user/user-nav.php');

    if ($selectedTab == 'dashboard') {
        include('views/user/userdashboard.php');
    }
    elseif ($selectedTab == 'write') {
        include('views/user/userwrite.php');
    }
    ?>
</div>