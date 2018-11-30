<br />
<div class="center">
	<ul class="flex-container">
		<li class="tab" <?php if($selectedTab == 'dashboard') echo 'class="active"' ?>>
			<a title="Tableau de bord" href="index.php?p=admin&tab=dashboard"><i class="material-icons">dashboard</i></a>
			<p>Tableau de bord</p>
		</li>
		<li class="tab" <?php if($selectedTab == 'list') echo 'class="active"' ?>>
			<a title="Mes fiches" href="index.php?p=admin&tab=list"><i class="material-icons">view_list</i></a>
			<p>Mes Fiches</p>
		</li>
		<li class="tab" <?php if($selectedTab == 'write')  echo 'class="active"' ?>>
			<a title="Ecrire" href="index.php?p=admin&tab=write"><i class="material-icons">edit</i></a>
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