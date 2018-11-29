<br />
<div class="container">
	<?php
    include('views/admin/admin-nav.php');
	// Le tableau de bord si 'selectedTab' vaut 'dashboard'.
    if ($selectedTab == 'dashboard') {
        include('views/admin/dashboard.php');
    }
	//  Le tableau de bord si 'selectedTab' vaut 'list'.
    elseif ($selectedTab == 'list') {
        include('views/admin/list-sheets.php');
    }
	//  Le tableau de bord si 'selectedTab' vaut 'write'.
    elseif ($selectedTab == 'write') {
        include('views/admin/write.php');
    }
	//  Le tableau de bord si 'selectedTab' vaut 'comments'.
    elseif ($selectedTab == 'comments') {
        include('views/admin/comments.php');
    }
	//  Le tableau de bord si 'selectedTab' vaut 'settings'.
    elseif ($selectedTab == 'settings') {
        include('views/admin/settings.php');
    }
    ?>
</div>