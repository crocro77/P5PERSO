<br />
<div class="center">
	<ul class="flex-container  white">
		<li class="tab" <?php if($selectedTab == 'dashboard') echo 'class="active"' ?>>
			<a title="Tableau de bord" href="index.php?p=member&tab=dashboard"><i class="material-icons">dashboard</i></a>
			<p>Tableau de bord</p>
		</li>
		<li class="tab" <?php if($selectedTab == 'write')  echo 'class="active"' ?>>
			<a title="Ecrire" href="index.php?p=memberwrite"><i class="material-icons">edit</i></a>
			<p>Ecrire</p>
		</li>
	</ul>
</div>