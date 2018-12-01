<div class="row grey lighten-3">
	<div class="col-xs-12">
		<div class="center">
			<h3>Tableau de bord</h3>
		</div>  
		<div class="row">
			<div class="center">
            <?php
                require_once('includes/dashboard-tables.php');
                $tables = [
                    "Fiche(s)"          =>  "datasheet",
                    "Commentaire(s)"    =>  "comments",
                ];
                $colors = [
                    "datasheet"         =>  "green",
                    "comments"          =>  "orange",
                ];
                foreach($tables as $table_name => $table){
                    ?>
                        <div class="col l6 m6 s12">
                            <div class="card">
                                <div class="card-content <?= getColor($table,$colors) ?> white-text">
                                    <span class="card-title"><?= $table_name ?></span>
                                    <?php $nombre = inTable($table); ?>
                                    <h4><?= $nombre[0] ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
			</div>	
        </div>
        <div class="center">
			<a class="btn light-blue waves-effect" title="Se déconnecter" href="index.php?p=logout"><i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>
        </div>
	</div>
</div>