<?php

use backend\models\Apprenant;
use backend\models\Formation;
use backend\models\Inscription;
use backend\models\Note;
use backend\models\TypeEvaluation;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Notes des apprenants évalués en ' . $model->idTypeevaluation0->libelle;
$this->params['breadcrumbs'][] = $this->title;

$inscription = Inscription::find()->where(['statut' => 1, 'idFormation' => $model->idFormation])->all();

$all_apprenant = Apprenant::find()->where(['statut' => 1])->all();

$all_typeevaluation = TypeEvaluation::find()->where(['statut' => 1, 'id' => $model->idTypeevaluation])->one();

?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4><?= Html::encode($this->title) ?></h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="fiche_note">Liste des évaluations</a></li>
                <li class="breadcrumb-item active">Notes</li>
            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>
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

                            <div class="">
                                <table class="table primary-table-bordered" id="example">
                                    <thead class="thead-primary">

                                        <tr style="text-align: center;">
                                            <th scope="col">Apprenant</th>
                                            <th scope="col">Note</th>
                                        </tr>


                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($inscription as $inscriptions) {
                                        ?>
                                            <tr>
                                                <!-- <td><= $inscriptions->idApprenant0->id ?></th> -->
                                                <td>
                                                    <center><?= $inscriptions->idApprenant0->nom . ' ' . $inscriptions->idApprenant0->prenom ?></center>
                                                </td>
                                                <td>
                                                    <center>

                                                        <?php $note = Note::find()->where(['idEvaluation' => $model->id, 'idInscription' => $inscriptions->id])->all(); ?>
                                                        <?php foreach ($note  as $notes) { ?>

                                                            &nbsp; <span class="badge rounded-pill bg-dark text-white"><?= isset($notes) ? $notes->libelle : '' ?></span>

                                                        <?php } ?>
                                                    </center>


                                                </td>

                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>
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