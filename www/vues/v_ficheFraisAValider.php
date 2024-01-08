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
<form method="post" 
      action="index.php?uc=validerFicheFrais&action=corrigerFrais" 
      role="form">  

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
                    }
                    ?>
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

                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>    

        </div>
    </div>
</form>
<br>


<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  

            <tbody>

                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                    $date = $unFraisHorsForfait['date'];
                    $montant = $unFraisHorsForfait['montant'];
                    $id = $unFraisHorsForfait['id'];
                    ?>
                    <tr>
                <form method="post" action="index.php?uc=validerFicheFrais&action=corrigerFraisHorsForfait" role="form">

                    <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectioner ?>">
                    <input name="lstVisiteur" type="hidden" id="lstVisiteur" class="form-control" value="<?php echo $visiteurASelectioner ?>">

                    <input type="hidden"  
                           name="idFrais"
                           size="10"
                           value="<?php echo $id ?>" 
                           class="form-control">
                    <td> <input type="text"  
                                name="date"
                                size="10" 
                                value="<?php echo $date ?>" 
                                class="form-control"></td>
                    <td> <input type="text" libelle="libelle" 
                                name="libelle"
                                size="10"
                                value="<?php echo $libelle ?>" 
                                class="form-control"></td>
                    <td><input type="text" montant="montant" 
                               name="montant"
                               size="10"
                               value="<?php echo $montant ?>" 
                               class="form-control"></td>

                    <td>
                        <input id="corrigerFHF" name="corrigerFHF" type="submit" value="Corriger" class="btn btn-success"/>  
                        <input id="supprimerFHF" name="supprimerFHF" type="submit" value="Supprimer" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');"/>
                        <input id="reporterFHF" name="reporterFHF" type="submit" value="Reporter" class="btn btn-danger" style="background-color: orange"onclick="return confirm('Voulez-vous vraiment reporter ce frais?');"/>
                    </td>
                </form>
                </tr>
                <?php
            }
            ?>
                  
            </tbody>  
        </table>
    </div>
    <label for="lstVisiteur" accesskey="n">Nombre de justificatifs :
        <input  type="text" value="<?php  echo $nbjustificatifs  ?>"/>  
        <br>
         <input id="valider" name="valider" type="submit" value="Valider" class="btn btn-success"/>  
                       
    </label> 
 </div>