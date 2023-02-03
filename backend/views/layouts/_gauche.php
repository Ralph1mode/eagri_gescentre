<?php

use backend\controllers\Utils;
use backend\models\Specialite;

$dashboard = Utils::have_access('manage_dashboard');
$specialite = Utils::have_access('manage_specialite');
$typeformation = Utils::have_access('manage_type_formation');
$spectform = Utils::have_access('manage_specialite_formation');
$apprennant = Utils::have_access('manage_students');
$formation = Utils::have_access('manage_formation');
$matiere = Utils::have_access('manage_lessons');
$generercarte = Utils::have_access('manage_carte');
$evaluation = Utils::have_access('manage_evaluation');
$typeevaluation = Utils::have_access('manage_type_evaluation');
$lecture_formation = Utils::have_access('read_formation');
$pays = Utils::have_access('manage_country');
$rule = Utils::have_access('manage_rule');

?>
<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll mm-active ps ps--active-y">
        <ul class="metismenu mm-show" id="menu">
            <li class="nav-label first">Menu principal</li>
            <li><a class="has-arrow" href="index" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Accueil</span>
                </a>
            </li>




            <!-- <li class="nav-label">Components</li> -->
            <li class="mega-menu mega-menu-xl"><a class="has-arrow ai-icon" href="#" aria-expanded="false">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="nav-text">Pédagogie</span>
                </a>
                <ul aria-expanded="">

                    <?php
                    if ($formation == 1 || $lecture_formation == 1) {
                        echo '
                <li><a class="has-arrow" href="all_formation" aria-expanded="false">
                        <span class="nav-text">Formation</span>
                    </a>
                </li>';
                    } ?>
                    <?php
                    if ($apprennant == 1) {
                        echo '
                <li><a class="has-arrow" href="all_apprenant" aria-expanded="false">
                        <span class="nav-text">Apprenants</span>
                    </a>
                </li>
                
                ';
                    } ?>

                    <?php
                    if ($evaluation == 1) {
                        echo '
                <li><a class="has-arrow" href="all_evaluation" aria-expanded="false">
                        <span class="nav-text">Evaluation</span>
                    </a>
                </li>
                ';
                    }
                    ?>

                    <?php
                    if ($generercarte == 1) {
                        echo '
                <li><a class="has-arrow ai-icon" href="all_inscription" aria-expanded="false">
                        <span class="nav-text">Edition des cartes</span>
                    </a>
                </li>
                ';
                    }
                    ?>
                </ul>
            </li>

            <li class="nav-label">Components</li>
            <li class="mega-menu mega-menu-xl"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class=" fa fa-cog"></i>
                    <span class="nav-text">Paramètre systèmes</span>
                </a>
                <ul aria-expanded="false">
                    <?php
                    if ($spectform == 1) {
                        echo '
                <li><a class="has-arrow" href="all_spectform" aria-expanded="false">
                        <span class="nav-text">Paramétrage formation</span>
                    </a>
                </li>
                ';
                    } ?>

                    <?php

                    if ($specialite == 1) {
                        echo '
                        <li><a class="has-arrow" href="all_specialite" aria-expanded="false">
                        <span class="nav-text">Specialités</span>
                        </a>
                        </li>';
                    }
                    ?>
                    <?php
                    if ($matiere == 1) {
                        echo '
                <li><a class="has-arrow" href="all_matiere" aria-expanded="false">
                        <span class="nav-text">Matières</span>
                    </a>
                </li>
                ';
                    }
                    ?>
                    <?php
                    if ($typeformation == 1) {
                        echo '
                <li><a class="has-arrow" href="all_typeformation" aria-expanded="false">
                        <span class="nav-text">Type de formation</span>
                    </a>
                </li>';
                    }
                    ?>


                    <?php
                    if ($typeevaluation == 1) {
                        echo '
            <li><a class="has-arrow" href="all_typeevaluation" aria-expanded="false">
                    <span class="nav-text">Type d\'évaluation</span>
                </a>
            </li> ';
                    }
                    ?>
                </ul>
            </li>


            <!-- <php
            if ($typeformation == 1) {
                echo '
                <li><a class="has-arrow" href="all_typeformation" aria-expanded="false">
                        <i class="la la-th-list"></i>
                        <span class="nav-text">Type de formation</span>
                    </a>
                </li>';
            }
            ?> !-->



            <li class="nav-label">Components</li>
            <li class="mega-menu mega-menu-xl"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Etats et statiqtiques</span>
                </a>
                <ul aria-expanded="false">
                    <?php
                    if ($apprennant == 1) {
                        echo '
                        <li><a class="has-arrow" href="formcours" aria-expanded="false">
                                <span class="nav-text">Formations en cours</span>
                        </a>
                        </li>
                            ';
                    } ?>
                    <?php
                    if ($apprennant == 1) {
                        echo '
                        <li><a class="has-arrow" href="formacheve" aria-expanded="false">
                                <span class="nav-text">Formations clôturées</span>
                        </a>
                        </li>
                            ';
                    } ?>
                    <?php
                    if ($specialite == 1) {
                        echo '
                <li><a class="has-arrow" href="historique" aria-expanded="false">
                        <span class="nav-text">Historique des inscritpions</span>
                    </a>
                </li>';
                    }
                    ?>
                    <?php
                    if ($apprennant == 1) {
                        echo '
                        <li><a class="has-arrow" href="fiche_note" aria-expanded="false">
                                <span class="nav-text">Fiche de note</span>
                        </a>
                        </li>
                            ';
                    } ?>
                </ul>
            </li>















            <!--      <php
            if ($rule == 0) {
                echo '
                <li><a class="ai-icon" href="all_user" aria-expanded="false">
                        <i class="fa fa-barcode"></i>
                        <span class="nav-text">Utilisateur</span>
                    </a>
                </li>
                ';
            }
            ?> -->
            </li>
        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->