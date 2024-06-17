<?php
/**
 * Vue Connexion
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
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Modification de MDP</h3>
                <small> 
                                    <?php
                                    echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
                                    ?></small>
            </div>
            <div class="panel-body">
                <form role="form" method="post" 
                      action="index.php?uc=connexion&action=newMdpVisiteur">
                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                
                                <input class="form-control" placeholder="inserez votre nouveau MDP"
                                       name="newMdp" type="text" maxlength="45">
                            </div>
                        </div>
                        <input class="btn btn-lg btn-success btn-block"
                               type="submit" value="Modifier">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>