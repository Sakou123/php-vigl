<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.inc.html'?>
<body>
<?php include 'includes/header.inc.html'?>
    <div class="row">
        <!-- NAV + OPEN SESSION -->
        <nav class="col-3 px-5">
            <a href='index.php' type="button" class="btn btn-outline-secondary mx-auto btn-block px-3 mb-2 gap-2">Home</a>
            <?php
            session_start();
                if(!empty($_SESSION)){
                    $table = $_SESSION['table'];
                    include 'includes/ul.inc.html';
                } 
            ?>
        </nav>
        <!-- Remplissage du tableau + changement entre les differentes "pages" -->
        <section class="col-9 pr-5">
            <?php
                if(isset($_POST['submit'])){
                    $_SESSION['table']=[
                        'prenom'=>$_POST['prenom'],
                        'nom'=>$_POST['nom'],
                        'age'=>$_POST['age'],
                        'size'=>$_POST['size'],
                        'situation'=>$_POST['situation']
                    ];
                    
                    echo '<h2 class="text-center">Données Sauvegardées</h2>';
                }
                // Formulaire
                else if(isset($_GET['add'])){
                    include 'includes/form.inc.html';
                }else{?>
                    <a href='index.php?add' type="button" class="btn btn-primary mb-2 gap-2">Ajouter des données</a>
                <?php
                }
                // Debogage
                if(isset($_GET['debugging'])) {
                    echo "<h2>Débogage</h2><br>";
                    print nl2br(print_r($table, true));
                }
                // Concatenation
                if(isset($_GET['concatenation'])) {
                    
                    echo "<h2>Concaténation</h2><br>";
                    //Première concaténation
                    echo '<h3>',$table['prenom'],' ',$table['nom'],'</h3>';
                    echo $table['age'],' ans, ','je mesure ',$table['size'], 'm et je fais partie des ', $table['situation'],'s de la promo Simplon.';
                    
                    //Deuxième concaténation
                    $table['nom'] = strtoupper($table['nom']);
                    $table['prenom'] = ucfirst($table['prenom']);
                    
                    echo '<h3>',$table['prenom'],' ',$table['nom'],'</h3>';
                    echo $table['age'],' ans, ','je mesure ',$table['size'], 'm et je fais partie des ', $table['situation'],'s de la promo Simplon.';

                    //Troisième concaténation
                    $table['size'] = number_format($table['size'], 2, ',', ' ');

                    echo '<h3>',$table['prenom'],' ',$table['nom'],'</h3>';
                    echo $table['age'],' ans, ','je mesure ',$table['size'], 'm et je fais partie des ', $table['situation'],'s de la promo Simplon.';

                }
                // Boucle
                if(isset($_GET['loop'])) {
                    echo "<h2>Boucle</h2><br>";
                    $i = 0;
                    foreach ($table as $k => $v) {
                        echo 'à la ligne n°',$i,' correspond la clé ', '"',$k,'"',' et contient ', '"',$v,'"', '<br>';
                        ++$i;
                    }
                // Fonction 
                }
                if(isset($_GET['function'])) {
                    echo "<h2>Fonction</h2><br>";
                    //===> Lecture du tableau à l'aide de la fonction readTable()
                    function readTable($t) {
                        $i = 0;
                        foreach ($t as $k => $v) {
                            echo 'à la ligne n°',$i,' correspond la clé ', '"',$k,'"',' et contient ', '"',$v,'"', '<br>';
                            ++$i;
                        }
                    }
                    readTable($table);
                }
                // Delete
                if(isset($_GET['delete'])) {
                session_destroy();
                echo '<h2>Les données ont bien été supprimées.</h2>';
                }
            ?>     
        </section>
    </div>
<?php include 'includes/footer.inc.html'?>
</body>
</html>