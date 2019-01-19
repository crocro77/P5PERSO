<br />
<div class="center">
	<ul class="flex-container  white">
		<li class="tab" <?php if($selectedTab == 'dashboard') echo 'class="active"' ?>>
			<a title="Tableau de bord" href="index.php?p=admin&tab=dashboard"><i class="material-icons">dashboard</i></a>
			<p>Tableau de bord</p>
		</li>
		<li class="tab" <?php if($selectedTab == 'list') echo 'class="active"' ?>>
			<a title="Les fiches" href="index.php?p=admin&tab=list&tabpage=1"><i class="material-icons">view_list</i></a>
			<p>Les Fiches</p>
		</li>
		<li class="tab" <?php if($selectedTab == 'write')  echo 'class="active"' ?>>
			<a title="Ecrire" href="index.php?p=write"><i class="material-icons">edit</i></a>
			<p>Ecrire</p>
		</li>
		<li class="tab" <?php if($selectedTab == 'comments') echo 'class="active"' ?>>
			<a title="Commentaires" href="index.php?p=admin&tab=comments"><i class="material-icons">comment</i></a>
			<p>Les Commentaires</p>
		</li>
        <li class="tab" <?php if($selectedTab == 'settings') echo 'class="active"' ?>>
			<a title="Paramètres" href="index.php?p=admin&tab=settings"><i class="material-icons">settings</i></a>
			<p>Paramètres</p>
		</li>
	</ul>
</div>