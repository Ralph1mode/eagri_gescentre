<?php

use backend\controllers\Utils;
use backend\models\Inscription;
use backend\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InscriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fiche de note des évaluations';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>FICHE DE NOTE</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Fiche de note</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example5" class="display" style="min-width: 845px">
                                                <div class="evaluation-index">

                                                    <p>
                                                        <button class="btn btn-danger text-white fa fa-print fa-8x" id="" onclick="printData()"> Imprimer</button>
                                                    </p>


                                                    <?= GridView::widget([
                                                        'dataProvider' => $dataProvider,
                                                        'layout' => '{items}{pager}',
                                                        'showOnEmpty' => false,
                                                        'emptyText' => Utils::emptyContent(),
                                                        'tableOptions' => [
                                                            'class' => 'table table-hover',
                                                            'id' => 'example'
                                                        ],
                                                        'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                            [
                                                                'label' => 'Type d\'évaluation',
                                                                'value' => function ($data) {
                                                                    return $data->idTypeevaluation0->libelle;
                                                                }
                                                            ],
                                                            [
                                                                'label' => 'Formation',
                                                                'value' => function ($data) {
                                                                    return $data->idFormation0->libelle;
                                                                }
                                                            ],
                                                            [
                                                                'label' => 'Spécialité',
                                                                'value' => function ($data) {
                                                                    return $data->idFormation0->idSpectForm0->idSpecialite0->libelle;
                                                                }
                                                            ],
                                                            [
                                                                'label' => 'Type de formation',
                                                                'value' => function ($data) {
                                                                    return $data->idFormation0->idSpectForm0->idTypeformation0->libelle;
                                                                }
                                                            ],
                                                            [

                                                                'label' => 'date de déroulement',
                                                                'format' => ['date', 'php:d-m-Y'],
                                                                'attribute' => 'ladate',
                                                            ],
                                                            'h_debut',
                                                            'h_fin',

                                                            [
                                                                'class' => 'yii\grid\ActionColumn',
                                                                'template' => '{view}',
                                                                'headerOptions' => ['width' => '15'],
                                                                'buttons' => [
                                                                    'class' => ActionColumn::className(),


                                                                    'view' => function ($url, $data) {


                                                                        $url = 'list_note?key=' . $data->key_eval;
                                                                        return '<a title="' . Yii::t('app', 'Notes') . '" class="btn btn-dark btn-sm" href="' . $url . '">
                                                        <i class="fa fa-building-o"></i>
                                                        </a>';
                                                                    },
                                                                ],
                                                            ],



                                                            /*  [
                                                                'class' => 'yii\grid\ActionColumn',
                                                                'template' => '{update}',
                                                                'headerOptions' => ['width' => '15'],
                                                                'buttons' => [
                                                                    'class' => ActionColumn::className(),
                                                                    'update' => function ($url, $data) {

                                                                        if ($data->idFormation0->cloture == 1) {
                                                                            $url = 'update_evaluation?key=' . $data->key_eval;
                                                                            // return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-success btn-sm" href="' . $url . '">
                                                                            // <i class="fa fa-pencil-square fa-8x"></i>
                                                                            // </a>';

                                                                            return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#exampleModalUpdate" onclick="showUpdateModal(\'' . $data->key_eval . '\',\'' . $data->ladate . '\',\'' . $data->h_debut . '\',\'' . $data->h_fin . '\')"><i class="fa fa-pencil-square fa-8x"></i></a>';
                                                                        } else {
                                                                        }
                                                                    },
                                                                ],
                                                            ], */


                                                            /*  [
                                                                'class' => 'yii\grid\ActionColumn',
                                                                'template' => '{delete}',
                                                                'headerOptions' => ['width' => '15'],
                                                                'buttons' => [
                                                                    'class' => ActionColumn::className(),
                                                                    'delete' => function ($url, $data) {

                                                                        $url = 'delete_evaluation?key=' . $data->key_eval;
                                                                        return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_eval . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                                        // return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-sm', 'data-pjax' => '0']);
                                                                    }
                                                                ],
                                                            ], */

                                                            /*  'urlCreator' => function ($action, Pays $model, $key, $index, $column) {
                                                return Url::toRoute([$action, 'id' => $model->id]);
                                            } */

                                                        ],
                                                    ]); ?>

                                            </table>
                                        </div>
                                    </div>
                                </div>
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