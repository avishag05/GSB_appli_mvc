<?php
/**
 * Fiche Frais A Valider
 *  Vue
 *
 * @category  PPE
 * @author    Avishag Seneor  <avishagseneor@gmail.com >
 * 
 */
?>

<div class="form-row">
    <!-- Liste déroulante de sélection de visiteurs -->
    <div class="form-group col-md-6">
        <label for="lstVisiteur" accesskey="n">Choisir le visiteur : </label>
        <select id="lstVisiteur" name="lstVisiteur" class="form-control">
            <?php
            foreach ($visiteurs_a_valider as $unVisiteur) {
                $id = $unVisiteur['id'];
                $nom = $unVisiteur['nom'];
                $prenom = $unVisiteur['prenom'];
                $selectionneoupas = "";
                if ($id == $visiteurASelectioner) {
                    $selectionneoupas = "selected";
                }?>
                    <option value="<?php echo $id ?>" <?php echo $selectionneoupas ?>>
                        <?php echo $nom . ' ' . $prenom ?> </option>
                    <?php
                
            }
            ?>
        </select>
    </div>

    <!-- Liste déroulante de sélection de mois -->
    <div class="form-group col-md-6">
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois" class="form-control">
            <?php
            foreach ($mois as $unMois) {
                $selectionneoupas = "";
                if ($unMois == $moisASelectioner) {
                    $selectionneoupas = "selected";
                }
                ?>
                <option  value="<?php echo $unMois ?>"  <?php echo $selectionneoupas ?>>
                    <?php echo substr($unMois, 4, 6) . "/" . substr($unMois, 0, 4) ?> </option>
                <?php
            }
            ?>    
        </select>
    </div>
</div>

<!--elements forfaitisés-->

<div class = "row">
    <h2>Renseigner ma fiche de frais du mois
    </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
              role="form">  
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Ajouter</button>
                <button class="btn btn-danger" type="reset">Effacer</button>
            </fieldset>
        </form>
    </div>
</div>




