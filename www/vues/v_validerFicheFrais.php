<?php 

/**
 * Valider Fiche Frais
 * Vue
 *
 * @category  PPE
 * @author    Avishag Seneor  <avishagseneor@gmail.com >
 * 
 */ 
?>

<h2>Valider une fiche de frais </h2>
<div class="row">

    <div class="col-md-4">
        <form action="index.php?uc=validerFicheFrais&action=validerfichefrais" 
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
                    foreach ($mois as $unMois) {
                        ?>
                            <option value="<?php echo $unMois ?>">
                                <?php echo substr($unMois, 4, 6)."/".substr($unMois, 0, 4) ?> </option>
                            <?php
                        }
                    ?>    

                </select>
            </div>

            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
                   role="button">
        </form>
    </div>
</div>