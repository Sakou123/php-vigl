<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
    <?php include 'includes/head.inc.html'?>
<body>
    <?php include 'includes/header.inc.html'?>
        <div class="container">
            <div class="row">
                            <!-- NAV + OPEN SESSION / COOKIE READ -->
                <nav class="col-sm-3 pt-3   ">
                    <a href='index.php' type="button" class="btn btn-outline-secondary w-100 mb-2">Home</a>
                    <?php
                        if(isset($_SESSION['table'])){
                            $table = $_SESSION['table'];
                            include 'includes/ul.inc.html';  
                        }else if(!empty($_COOKIE['info'])){ 
                            $table = unserialize($_COOKIE['info']); //Remet le cookie en donnée lisible pour notre $table
                            include 'includes/ul.inc.html';
                        }
                    ?>
                </nav>
                            <!-- Remplissage du tableau + changement entre les differentes "pages" -->
                <section class="col-sm-9 pt-3 pr-5">
                    <?php
                        if(isset($_POST['submit'])){
                            $_SESSION['table']=[
                                'first_name'=>$_POST['first_name'],
                                'last_name'=>$_POST['last_name'],
                                'age'=>$_POST['age'],
                                'size'=>$_POST['size'],
                                'situation'=>$_POST['situation']
                            ];

                            // Si rien n'est rentré remplace les blancs par des presets pour faire "joli"
                            if (empty($_SESSION['table']['first_name'])){
                                $_SESSION['table']['first_name']='Prénom';
                            }
                            if (empty($_SESSION['table']['last_name'])){
                                $_SESSION['table']['last_name']='Nom';
                            }
                            if (empty($_SESSION['table']['age'])){
                                $_SESSION['table']['age']= 18;
                            }
                            if (empty($_SESSION['table']['size'])){
                                $_SESSION['table']['size']=1.6;
                            }
                            // Setup cookie
                            setcookie('info', serialize($_SESSION['table']) , time() + 300);

                            // passage de 1.8 a 1.80
                            $_SESSION['table']['size'] = number_format($_SESSION['table']['size'], 2, '.', ' ');

                            echo '<h2 class="text-center">Données Sauvegardées</h2>';
                        }

                            // Formulaire
                        else if(isset($_GET['add'])){
                            include 'includes/form.inc.html';
                        }

                            // Debogage
                        else if(isset($_GET['debugging'])) {
                            echo "<h2>Débogage</h2><br>";
                            echo "<p>===> Lecture du tableau à l'aide de la fonction print_r()</p>";
                            // print nl2br(print_r($table)) Autre façon presque pareil
                            echo'<pre>';
                            print_r($table);
                            echo'</pre>';
                        }

                            // Concatenation
                        else if(isset($_GET['concatenation'])) {
                            
                            echo "<h2>Concaténation</h2><br>";
                            //Première concaténation
                            echo "<p>===> Construction d'une phrase avec le contenu du tableau :</p>";
                            echo '<h3>',$table['first_name'],' ',$table['last_name'],'</h3>';
                            echo $table['age'],' ans, ','je mesure ',$table['size'], 'm et je fais partie des ', $table['situation'],'s de la promo Simplon.<br><br>';
                            
                            //Deuxième concaténation
                            $table['last_name'] = strtoupper($table['last_name']);
                            $table['first_name'] = ucfirst($table['first_name']);
                            
                            echo "<p>===> Construction d'une phrase après MAJ du tableau :</p>";
                            echo '<h3>',$table['first_name'],' ',$table['last_name'],'</h3>';
                            echo $table['age'],' ans, ','je mesure ',$table['size'], 'm et je fais partie des ', $table['situation'],'s de la promo Simplon.<br><br>';

                            //Troisième concaténation
                            $table['size'] = number_format($table['size'], 2, ',', ' ');

                            echo "<p>===> Affichage d'une virgule à la place du point pour la taille :</p>";
                            echo '<h3>',$table['first_name'],' ',$table['last_name'],'</h3>';
                            echo $table['age'],' ans, ','je mesure ',$table['size'], 'm et je fais partie des ', $table['situation'],'s de la promo Simplon.<br><br>';
                        }
                        
                            // Boucle
                        else if(isset($_GET['loop'])) {
                            echo "<h2>Boucle</h2><br>";
                            echo "<p>===> Lecture du tableau à l'aide d'une boucle foreach</p>";
                            $i = 0;
                            foreach ($table as $k => $v) {
                                echo 'à la ligne n°',$i,' correspond la clé ', '"',$k,'"',' et contient ', '"',$v,'"', '<br>';
                                ++$i;
                            }
                        }

                            // Fonction 
                        else if(isset($_GET['function'])) {
                            echo "<h2>Fonction</h2><br>";
                            echo "<p>===> Lecture du tableau à l'aide de la fonction readTable()</p>";
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
                        else if(isset($_GET['del'])) {
                            session_destroy();
                            setcookie('info', null, -1, '/');
                            echo '<h2>Les données ont bien été supprimées.</h2>';
                        }
                            //Bouton Ajouter de données
                        else{
                            echo '<a href="index.php?add" type="button" class="btn btn-primary mb-2 gap-2">Ajouter des données</a>';
                            // if(!empty($_COOKIE['info'])){
                            //     var_dump($_COOKIE['info']);
                            // }
                        }
                    ?>     
                </section>
            </div>
        </div>
    <?php include 'includes/footer.inc.html'?>
</body>
</html>