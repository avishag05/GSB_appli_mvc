<?php

/**
 * Suivre Paiement
 * Controleur
 *
 * @category  PPE
 * @author    Avishag Seneor  <avishagseneor@gmail.com >
 * 
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
$unMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);

//echo 'COUCOU ';
switch ($action) {
    case 'suivreP':
        $visiteurs_a_valider = $pdo->VisiteursSuivrePaiement();

        $lesMois = $pdo->MoisSuivrePaiement();
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        //var_dump($lesMois);
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        include 'vues/v_suivrePaiement.php';
        // echo 'COUCOU !!';
        break;

    case 'voirFicheAMettreEnPaiement':
          //var_dump($idVisiteur , $unMois);
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $unMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $unMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $unMois);
        $numAnnee = substr($unMois, 0, 4);
        $numMois = substr($unMois, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        include 'vues/v_ficheAMettreEnPaiement.php';
      

       // echo 'COUCOU';
        break;
    
      case 'validerFichePaiement':
          echo 'AAAA BBB CCC';
            $ModifEtat= $pdo-> ModifEtat($idVisiteur, $unMois);
          //var_dump($idVisiteur , $unMois);
    break;
}


