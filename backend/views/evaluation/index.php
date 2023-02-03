<?php

use backend\controllers\Utils;
use backend\models\Evaluation;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EvaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>EVALUATIONS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Liste des évaluations</li>
            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="evaluation-index">

                                <p>
                                    <?= Html::a(' Ajouter une évaluation', ['create'], ['class' => 'btn btn-primary fa fa-plus-square fa-8x']) ?>

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
                                        /*  [
                                            'label' => 'Nombre de note',
                                            'value' => 'nb_note'
                                        ], */
                                        /*   [
                                            'label' => 'Date de déroulement',
                                            'value' => 'ladate'
                                        ],
                                        [
                                            'label' => 'Heure de début',
                                            'value' => 'h_debut'
                                        ],
                                        [
                                            'label' => 'Heure de fin',
                                            'value' => 'h_fin'
                                        ], */
                                        //'id',
                                        //'idTypeevaluation',
                                        // 'idFormation',
                                        // 'nb_note',
                                        // 'ladate',
                                       
                                        //'key_eval',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),


                                                'view' => function ($url, $data) {

                                                    if ($data->idFormation0->cloture == 1) {
                                                        $url = 'eval_note?key=' . $data->key_eval;
                                                        return '<a title="' . Yii::t('app', 'Notes') . '" class="btn btn-dark btn-sm" href="' . $url . '">
                                                        <i class="fa fa-building-o"></i>
                                                        </a>';
                                                    } else {
                                                        return '<a title="' . Yii::t('app', 'Formation Clôturée') . '" class="btn btn-dark btn-sm">
                                                        <i class="fa fa-lock"></i>
                                                        </a>';
                                                    }
                                                },
                                            ],
                                        ],
                                       /*  [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'view' => function ($url, $data) {

                                                    if ($data->idFormation0->cloture == 1) {
                                                        $url = 'view_evaluation?key=' . $data->key_eval;
                                                        return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '">
                                                    <i class="fa fa-eye fa-8x"></i>
                                                    </a>';
                                                    } else {
                                                    }
                                                },
                                            ],
                                        ], */


                                        [
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
                                        ],


                                        [
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
                                        ],

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
<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDeleteContent">
                ...
            </div>
            <input type="hidden" value="" id="keyTypeeval">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Type formation  -->
<div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelUpdate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModalUpdate">Modification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalAlertContent2" class="container"></div>
            <div class="modal-body" id="bodyModalUpdate">
                <input type="date" required class="form-control" id="typeeval_Update_ladate">
                <input type="time" required class="form-control" id="typeeval_Update_debut">
                <input type="time" required class="form-control" id="typeeval_Update_fin">
            </div>
            <input type="hidden" value="" id="key_eval">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveUpdateMatiere()">Valider</button>
            </div>
        </div>
    </div>
</div>



<script>
    function showUpdateModal(key_memomatiere, nbr_heure) {
        document.getElementById('key_memomatiere').value = key_memomatiere;
        document.getElementById('memo_matiere_nbr_h').value = nbr_heure;
    }

    function saveUpdateMatiere() {
        let = document.getElementById('key_memomatiere').value;
        let nbr_heure = document.getElementById('memo_matiere_nbr_h').value;
        if (nbr_heure != '' && nbr_heure > 0) {
            let url = "<?= Yii::$app->homeUrl ?>update_memomatiere";
            $.ajax({
                url: url,
                method: "post",
                data: {
                    key_memomatiere: key_memomatiere,
                    nbr_heure: nbr_heure,
                },
                success: function(result) {
                    document.location.reload();
                }
            });
        } else {
            document.getElementById('modalAlertContent').innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner un nombre d\'heure valide' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
        }
    }

    function delete_element(key_element) {
        document.getElementById('keyTypeeval').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer cette évaluation';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_evaluationf";
        var key_element = document.getElementById('keyTypeeval').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element,
            },
            success: function(result) {
                document.location.reload();
            }
        });
    }


    function showUpdateModal(key_eval, ladate, h_debut, h_fin) {
        document.getElementById('key_eval').value = key_eval;
        document.getElementById('typeeval_Update_ladate').value = ladate;
        document.getElementById('typeeval_Update_debut').value = h_debut;
        document.getElementById('typeeval_Update_fin').value = h_fin;
    }

    function saveUpdateMatiere() {
        let key_eval = document.getElementById('key_eval').value;
        let ladate = document.getElementById('typeeval_Update_ladate').value;
        let h_debut = document.getElementById('typeeval_Update_debut').value;
        let h_fin = document.getElementById('typeeval_Update_fin').value;
        if (ladate != '', h_debut != '', h_fin != '') {
            let url = "<?= Yii::$app->homeUrl ?>update_evaluation";
            $.ajax({
                url: url,
                method: "post",
                data: {
                    key: key_eval,
                    ladate: ladate,
                    h_debut: h_debut,
                    h_fin: h_fin,
                },
                success: function(result) {
                    document.location.reload();
                }
            });
        } else {
            document.getElementById('modalAlertContent2').innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner un type d\'évaluation' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
        }
    }
</script>