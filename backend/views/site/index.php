<?php

/** @var yii\web\View $this */

use backend\controllers\Utils;
use backend\models\User;
use PharIo\Manifest\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'My Yii Application';
$this->params['breadcrumbs'][] = $this->title;
$apprennant = Utils::have_access('manage_students');
?>


<!--**********************************
            Content body start
        ***********************************-->
<!-- row -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-primary">
                <div class="card-body">
                    <div class="media">
                        <span class="mr-3">
                            <i class="la la-user"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Total Inscrit</p>
                            <h3 class="text-white"><?= $total_stud ?></h3>
                            <div class="progress mb-2 bg-white">
                                <div class="progress-bar progress-animated bg-light" style="width: <?= $total_stud ?>%"></div>
                            </div>
                            <!-- <small>50% Increase in 25 Days</small> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-warning">
                <div class="card-body">
                    <div class="media">
                        <span class="mr-3">
                            <i class="la la-users"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Total spécialités</p>
                            <h3 class="text-white"><?= $total_specialite ?></h3>
                            <div class="progress mb-2 bg-white">
                                <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                            </div>
                            <!-- <small>80% Increase in 20 Days</small> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-secondary">
                <div class="card-body">
                    <div class="media">
                        <span class="mr-3">
                            <i class="la la-graduation-cap"></i>
                        </span>
                        <a href="formcours">
                            <div class="media-body text-white">
                                <p class="mb-1">Formations en cours</p>
                                <h3 class="text-white"><?= $formation_encour ?></h3>
                                <div class="progress mb-2 bg-white">
                                    <div class="progress-bar progress-animated bg-light" style="width: <?= $formation_encour ?>%"></div>
                                </div>
                                <!-- <small>76% Increase in 20 Days</small> -->
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card bg-danger">
                <div class="card-body">
                    <div class="media">
                        <span class="mr-3">
                            <i class="fas fa-check"></i>
                        </span>
                        <a href="formacheve">
                            <div class="media-body text-white">
                                <p class="mb-1">Formations clôturées</p>
                                <h3 class="text-white"><?= $formation_cloture ?></h3>
                                <div class="progress mb-2 bg-white">
                                    <div class="progress-bar progress-animated bg-light" style="width: <?= $formation_cloture ?>%"></div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                            </svg>
                        </span>
                        <a href="historique">
                            <div class="media-body">
                                <p class="mb-1">Historique des inscriptions</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($apprennant == 1) {
            echo '
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <a href="fiche_note">
                            <i class="fa fa-pencil-square fa-3x"></i>

                            <div class="media-body">
                                <p class="mb-1 text-left"> Fiche de note</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>';
        } ?>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Total type formation</p>
                            <h4 class="mb-0"><?= $total_formation ?></h4>
                            <!-- <span class="badge badge-danger">-3.5%</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Evaluation en cours</p>
                            <h4 class="mb-0"><?= $nb ?></h4>
                            <!-- <span class="badge badge-success">-3.5%</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-xxl-6 col-lg-12 col-sm-12">

            <div class="card">
                <div id="piechart_3d" class="" style="width: 400px; height: 400px;"></div>
            </div>

        </div>
        <div class="col-xl-8 col-xxl-6 col-lg-12 col-sm-12">
            <section class="form_one">
                <div class="card">
                    <button class="btn btn-success btn-xs" onclick="show_hideformtwo()">E-Agribusiness
                        <!-- <i class="fa fa-refresh" aria-hidden="true"></i> -->
                    </button>
                    <div id="top_x_div" class="morris_chart_height" style="height: 400px !important;"></div>
                </div>
            </section>
            <section class="form_two">
                <div class="card">
                    <button class="btn btn-success btn-xs" onclick="show_hideformone()">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </button>
                    <img src="template/images/eagri2.png" alt="">
                    <!-- <div id="chart_div" class="morris_chart_height" style="height: 400px !important;"></div> -->
                </div>
            </section>
        </div>


    </div>

    <script>
        let premiere_session = document.querySelector(".form_one");
        let deuxieme_session = document.querySelector(".form_two");
        deuxieme_session.style.display = "none";

        visible1 = true;

        function show_hideformtwo() {
            if (visible1) {
                deuxieme_session.style.display = "block";
                premiere_session.style.display = "none";
                visible2 = false;
            } else {
                premiere_session.style.display = "block";
                deuxieme_session.style.display = "none";

                visible2 = true;
            }
        }

        function show_hideformone() {
            if (visible1) {
                deuxieme_session.style.display = "none";
                premiere_session.style.display = "block";
                visible2 = false;
            } else {
                premiere_session.style.display = "none";
                deuxieme_session.style.display = "block";

                visible2 = true;
            }

        }
    </script>