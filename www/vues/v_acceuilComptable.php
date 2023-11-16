<?php
/**
 * Acceuil Comptable
 *Vue
 *
 * @category  PPE
 * @author    Avishag Seneor  <avishagseneor@gmail.com >
 * 
 */
?>

<div id="accueil">
    <h2>
        Gestion des frais<small> - Comptable : 
            <?php
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div  >
<div class="row">
    <div class="col-md-12">
        <div style="border-color: orangered" class="panel panel-primary" >
            <div class="panel-heading"  style="background-color: coral ">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    Navigation
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a  href="index.php?uc=validerFicheFrais&action=selectionnerUtilisateur"
                           class="btn btn-success btn-lg" role="button">
                            <span class="glyphicon glyphicon-check"></span>
                            <br>Valider la fiche de frais</a>
                        <a  style="background-color: coral ; border-color: orangered" href="index.php?uc=suivrePaiement"
                           class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon-euro"></span>
                            <br>Suivre le paiement des fiches de frais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>