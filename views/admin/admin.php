<br />
<div class="container">
	<?php
    include('views/admin/admin-nav.php');

    if ($selectedTab == 'dashboard') {
        include('views/admin/dashboard.php');
    }
    elseif ($selectedTab == 'list') {
        include('views/admin/list-sheets.php');
    }
    elseif ($selectedTab == 'write') {
        include('views/admin/write.php');
    }
    elseif ($selectedTab == 'comments') {
        include('views/admin/comments.php');
    }
    elseif ($selectedTab == 'settings') {
        include('views/admin/settings.php');
    }
    ?>
</div>