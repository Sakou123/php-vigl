<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.inc.html'?>
<body>
<?php include 'includes/header.inc.html'?>
    <div class="row">
        <nav class="col-3 px-5">
            
            <a href='index.php' type="button" class="btn btn-outline-secondary mx-auto btn-block px-3 mb-2 gap-2">Home</a>
            <?php
            session_start();
                if(!empty($_SESSION)){
                    $table = $_SESSION['table'];
                    include 'includes/ul.inc.html';
                }else{} 
            ?>
        </nav>
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

                else if(isset($_GET['add'])){
                    include 'includes/form.inc.html';
                }else{?>
                    <a href='index.php?add' type="button" class="btn btn-primary mb-2 gap-2">Ajouter des données</a>
                <?php
                } 
            ?>     
        </section>
    </div>
<?php include 'includes/footer.inc.html'?>
</body>
</html>