<?php

/**
 * Suivre Paiement
 * Vue
 *
 * @category  PPE
 * @author    Avishag Seneor  <avishagseneor@gmail.com >
 * 
 */
//echo 'COUCOU !!!'; 
?>

<h2>Suivre le paiement des fiches de frais </h2>
<div class="row">

    <div class="col-md-4">
        <form action="index.php?uc=suivrePaiement&action=voirFicheAMettreEnPaiement" 
              method="post" role="form">

            <!-- Liste deroulante de selection de visiteurs-->
            
                <h3>Sélectionner un visiteur : </h3>
            <div class="form-group">
                <label for="lstVisiteur" accesskey="n">Visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($visiteurs_a_valider  as $unVisiteur) {
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        $idVisiteur = $unVisiteur['id'];
                            ?>
                            <option value="<?php echo $idVisiteur ?>">
                                <?php echo $nom." ".$prenom?> </option>
                            <?php
                    }
                    ?>    

                </select>
            </div>

            <!-- Liste deroulante de selection de mois-->
                <h3>Sélectionner un mois : </h3>
          <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee =  substr($mois, 0, 4);
                         $numMois = substr($mois, 4, 2);
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
               <input id="validerMontant" name="validerMontant" type="submit" value="Valider" class="btn btn-success"/>   
        </form>
    </div>
</div>
