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

switch ($action) {
    case 'selectionnerUtilisateur':
        $visiteurs_a_valider = $pdo->getLesVisiteursAValider();
        // var_dump($visiteurs_a_valider);

        $mois = afficher12DerniersMois();
        //  var_dump($mois);
        include 'vues/v_validerFicheFrais.php';

        break;

    case 'validerfichefrais':

        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $unMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $unMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $unMois);
       // var_dump($lesFraisForfait, $lesFraisHorsForfait);
       
        $moisASelectioner = $unMois;
        $visiteurASelectioner = $idVisiteur;

        $visiteurs_a_valider = $pdo->getLesVisiteursAValider();
        $mois = afficher12DerniersMois();

        if ((empty($lesFraisHorsForfait)) && (empty($lesFraisForfait))) {
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_validerFicheFrais.php';
            
        } else {
            include 'vues/v_ficheFraisAValider.php';
        }


        break;
}