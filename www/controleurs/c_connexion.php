<?php

/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}
switch ($action) {
    case 'demandeConnexion':
        include 'vues/v_connexion.php';
        break;
    case 'valideConnexion':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $visiteur = $pdo->getInfosVisiteur($login, $mdp);
        $comptable = $pdo->getInfosComptable($login, $mdp);
        // var_dump($comptable);

        if ((!is_array($visiteur)) && (!is_array($comptable))) {
            ajouterErreur('Login ou mot de passe incorrect');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        } elseif (is_array($visiteur)) {

            $id = $visiteur['id'];
            $nom = $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            connecterVisiteur($id, $nom, $prenom);
           echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        exit;
        } elseif (is_array($comptable)) {

            $id = $comptable['id'];
            $nom = $comptable['nom'];
            $prenom = $comptable['prenom'];
            connecterComptable($id, $nom, $prenom);
            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
        exit;
        }
        break;
    case 'modifierMdpComptable':
        include 'vues/v_modifierMdpComptable.php';
        break;
    case 'modifierMdpVisiteur':
        include 'vues/v_modifierMdpVisiteur.php';
        break;

    case 'newMdpComptable':

        var_dump($_SESSION['idComptable']);
        var_dump($_SESSION['nom']);
        $id = $_SESSION['idComptable'];
        $newMdp = filter_input(INPUT_POST, 'newMdp', FILTER_SANITIZE_STRING);
        var_dump($newMdp);
        $hash_mdp = password_hash($newMdp, PASSWORD_DEFAULT);
        var_dump($hash_mdp);
        $ModifMdp = $pdo->modifMdpComptable($id, $newMdp);

        echo 'Avishag !!!';
        break;
    case 'newMdpVisiteur':
        $id = $_SESSION['idVisiteur'];
        $newMdp = filter_input(INPUT_POST, 'newMdp', FILTER_SANITIZE_STRING);
        $hash_mdp = password_hash($newMdp, PASSWORD_DEFAULT);
        // var_dump($_SESSION['idVisiteur']);
        //var_dump($_SESSION['nom']);
        //var_dump($newMdp);
        //var_dump($hash_mdp);
        $ModifMdp = $pdo->modifMdpVisiteur($id, $newMdp);
        if ($ModifMdp) {
            // Si la modification est un succès, ajoutez un message de confirmation
            ajouterErreur('Mot de passe modifié avec succès.');
        } else {
            // Si la modification échoue, ajoutez un message d'erreur
            ajouterErreur('Erreur lors de la modification du mot de passe.');
        }

        include 'vues/v_accueilVisiteur.php';

        //echo 'Avishag !!!';
        break;
    default:
        include 'vues/v_connexion.php';
        break;
}
