<?php

/**
 * Valider Fiche Frais
 * Controleur
 *
 * @category  PPE
 * @author    Avishag Seneor  <avishagseneor@gmail.com >
 * 
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
$unMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
$idFrais = filter_input(INPUT_POST, 'idFrais', FILTER_SANITIZE_STRING);
$lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$montant = filter_input(INPUT_POST, 'montant', FILTER_SANITIZE_STRING);
 $quantite = filter_input(INPUT_POST, 'quantite', FILTER_SANITIZE_STRING);
 

$visiteurs_a_valider = $pdo->getLesVisiteursAValider();
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $unMois);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $unMois);

$mois = afficher12DerniersMois();

switch ($action) {
    case 'selectionnerUtilisateur':
        include 'vues/v_validerFicheFrais.php';
        break;

    case 'validerfichefrais':
        $moisASelectioner = $unMois;
        $visiteurASelectioner = $idVisiteur;
        if ((empty($lesFraisHorsForfait)) && (empty($lesFraisForfait))) {
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_validerFicheFrais.php';
        } else {
            $nbjustificatifs = $pdo->getNbjustificatifs($idVisiteur, $unMois);
            include 'vues/v_ficheFraisAValider.php';
        }
        break;

    case 'corrigerFrais' :
        $moisASelectioner = $unMois;
        $visiteurASelectioner = $idVisiteur;
        $pdo->majFraisForfait($idVisiteur, $unMois, $lesFrais);
        //var_dump($lesFrais);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $unMois);
        $nbjustificatifs = $pdo->getNbjustificatifs($idVisiteur, $unMois);
        ajouterErreur('Modification des frais forfaits prise en compte');
        include 'vues/v_erreurs.php';
        include 'vues/v_ficheFraisAValider.php';
        break;


    case 'corrigerFraisHorsForfait':
        $nbjustificatifs = $pdo->getNbjustificatifs($idVisiteur, $unMois);
        if (isset($_POST['corrigerFHF'])) {
            $pdo->majFraisHorsForfait($idFrais, $date, $libelle, $montant);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $unMois);
            $moisASelectioner = $unMois;
            $visiteurASelectioner = $idVisiteur;
            ajouterErreur('Modification du frais hors forfait prise en compte');
            include 'vues/v_erreurs.php';
            include 'vues/v_ficheFraisAValider.php';
        } elseif (isset($_POST['supprimerFHF'])) {
            $pdo->supprimerFraisHorsForfait($idFrais);
            $moisASelectioner = $unMois;
            $visiteurASelectioner = $idVisiteur;
            ajouterErreur('Suppression du frais hors forfaits');
            include 'vues/v_erreurs.php';
            include 'vues/v_ficheFraisAValider.php';
        } elseif (isset($_POST['reporterFHF'])) {
            $Moispro = getMoisSuivant($unMois);
            $pdo->modiflibelle($idFrais, $libelle);
            $pdo->creeNouveauFraisHorsForfait($idVisiteur, $Moispro, $libelle, $date, $montant);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $unMois);
            $moisASelectioner = $unMois;
            $visiteurASelectioner = $idVisiteur;
            ajouterErreur('Reportation du frais hors forfaits');
            include 'vues/v_erreurs.php';
            include 'vues/v_ficheFraisAValider.php';
        }
        
        break;
        
        case 'validerMontant':
            
            $nbJustificatifs = filter_input(INPUT_POST, 'justif', FILTER_SANITIZE_STRING);
            
               
           //var_dump($idVisiteur , $unMois);
           $EHF= $pdo-> calculerEHF($idVisiteur, $unMois);
           //var_dump($EHF);
           
           $EF= $pdo-> calculerEF($idVisiteur, $unMois);
           //var_dump($EF);
       
           $A=$EHF[0][0];
           $B=$EF[0][0];
           $Total=$A+$B ;
           $idEtat='VA';
          //var_dump($Total); 
          
           $EFetEHF= $pdo-> calculerEFetEHF($idVisiteur, $unMois, $Total, $idEtat,$nbJustificatifs);
           //var_dump($EFetEHF);
           ajouterErreur('Fiche validée !');
            include 'vues/v_erreurs.php';
            include 'vues/v_acceuilComptable.php';
            
       break;
}
