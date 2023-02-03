<?php

use backend\controllers\Utils;
use backend\models\Formation;
use backend\models\Inscription;
use backend\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InscriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formations en cours';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>A PROPOS DES FORMATIONS EN COURS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Formations en cours</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <a href="#" type="button" class="btn btn-danger text-white fa fa-print fa-8x" onclick="printData()"> Imprimer</a>
                            </p>
                        </div>
                        <div class="col-lg-12">

                            <?php
                            $all_inscrit = Inscription::find()->where(['statut' => 1])->all();
                            $all_formation = Formation::find()->where(['statut' => 1, 'cloture' => 1])->all();
                            ?>


                            <div class="">
                                <table id="example" class="table primary-table-bordered" style="min-width: 845px">
                                    <thead class="thead-primary">
                                        <tr>

                                            <!-- <th>#</th> -->
                                            <th>Formation</th>
                                            <th>Type</th>
                                            <th>Spécialité</th>
                                            <th>Inscrit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($all_formation as $formation) {
                                            $nb_inscrit = Inscription::find()->where(['statut' => 1, 'idFormation' => $formation->id])->count();

                                        ?>

                                            <tr>

                                                <td><?= $formation->libelle ?></td>
                                                <td><?= $formation->idSpectForm0->idTypeformation0->libelle ?></td>
                                                <td><?= $formation->idSpectForm0->idSpecialite0->libelle ?></td>
                                                <td><?= $nb_inscrit ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function printData() {
        var divToPrint = document.getElementById('example');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            'table, table, td{' +
            'border:1px solid #000;' +
            'border-collapse: collapse;' +
            'padding;0.5em;' +
            '}' +
            '</style>';
        '<style type="text/css">' +
        ' th {' +
        ' font - family: monospace;' +
        ' border: thin solid #6495ed;' +
        'width: 50%;' +
        'padding: 5px;' +
        'background-color: # D0E3FA;' +
        'background - image: url(template/images/eagri2.jpeg);' +
        '}' +
        '</style>';
        '<style type="text/css">' +
        'td {' +
        'font-family: sans-serif;' +
        'border: thin solid #6495ed;' +
        'width: 50%;' +
        'padding: 5px;' +
        'text-align: center;' +
        'background-color: #ffffff;' +
        '}' +
        '</style>';

        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
</script>