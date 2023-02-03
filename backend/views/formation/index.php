<?php

use backend\controllers\Utils;
use backend\models\Formation;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FormationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>FORMATIONS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Liste des formations</li>
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
                            <div class="formation-index">
                                <div class="row">
                                    <div class="col-md-7">
                                        <?php
                                        $lecture_formation = Utils::have_access('read_formation');
                                        $all_formation = Utils::have_access('manage_formation');
                                        if ($all_formation == 1) { ?>
                                            <p>
                                                <?= Html::a(' Ajouter une formation', ['create'], ['class' => 'btn btn-primary fa fa-plus-square fa-8x']) ?>

                                            </p>

                                        <?php } ?>
                                        <?php if($lecture_formation == 1) {} ?>
                                    </div>
                                    <div class="col-md-1">
                                        <!-- <button type="button" class="btn btn-primary" onclick="printContent('div1')">Imprimer <span class="btn-icon-right"><i class="fa fa-download"></i></span> -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <php echo $this->render('_search', ['model' => $searchModel]); ?> -->
                                    </div>



                                </div>




                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{pager}',
                                    'showOnEmpty' => false,
                                    'emptyText' => Utils::emptyContent(),
                                    'tableOptions' => [

                                        'class' => 'table table-hover',
                                        'id' => 'example'
                                    ],
                                    // 'filterModel' => $searchModel,
                                    'columns' => [
                                        // ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'Formation',
                                            'value' => 'libelle'
                                        ],
                                        [
                                            'label' => 'Type',
                                            'value' =>   function ($data) {
                                                return $data->idSpectForm0->idTypeformation0->libelle;
                                            },

                                        ],
                                        [
                                            'label' => 'Spécialité',
                                            'value' =>   function ($data) {
                                                return $data->idSpectForm0->idSpecialite0->libelle;
                                            },

                                        ],
                                        /* [
                                            'label' => 'Coût de formation',
                                            'value' => 'frais'
                                        ], */
                                        /*  [
                                            'label' => 'Date de début',
                                            'value' => 'date_debut'
                                        ],
                                        [
                                            'label' => 'Date de fin',
                                            'value' => 'date_fin'
                                        ], */



                                        [
                                            'format' => 'html',
                                            'label' => 'Etat de la formation',
                                            'value' => function ($data) {
                                                $state = 'danger';
                                                $state = 'success';
                                                $stateTxt = 'Clôturée';
                                                if ($data->cloture == 1) {
                                                    $state = 'info';
                                                    $stateTxt = 'En cours';
                                                    return '<span class="badge badge-' . $state . '">' . $stateTxt . '</span>';
                                                } else if ($data->cloture == 0) {
                                                    $state = 'dark';
                                                    $stateTxt = 'Clôturée';
                                                    return '<span class="badge badge-' . $state . '">' . $stateTxt . '</span>';
                                                }
                                            }
                                        ],
                                        [

                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'view' => function ($url, $data) {
                                                    $lecture_formation = Utils::have_access('read_formation');
                                                    $all_formation = Utils::have_access('manage_formation');

                                                    if ($all_formation == 1) {
                                                        if ($data->cloture == 1) {
                                                            $url = 'close_formation?key=' . $data->key_formation;
                                                            return Html::a('<i class="fa fa-unlock-alt"></i>', '#', ['onClick' => 'close_format(\'' . $data->key_formation . '\')', 'class' => 'btn btn-warning btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalClose"]);
                                                        } else if ($data->cloture == 0) {
                                                            // $url = 'open_formation?key=' . $data->key_formation;


                                                            return Html::a('<i class="fa fa-lock"></i>', '#', ['onClick' => 'close//_formation(\'' . $data->key_formation . '\')', 'class' => 'btn btn-dark btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModal"]);
                                                        }
                                                    } elseif ($lecture_formation == 1) {
                                                    }
                                                },
                                            ],
                                        ],


                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'view' => function ($url, $data) {
                                                    $lecture_formation = Utils::have_access('read_formation');
                                                    $all_formation = Utils::have_access('manage_formation');

                                                    if ($all_formation == 1) {

                                                        if ($data->cloture == 1) {
                                                            $url = 'view_formation?key=' . $data->key_formation;
                                                            return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '">
                                                        <i class="fa fa-eye fa-8x"></i>
                                                        </a>';
                                                        } else if ($data->cloture == 0) {
                                                            // $url = 'update_formation?key=' . $data->key_formation;
                                                            //     return '<a title="' . Yii::t('app', 'clôturé') . '"class="btn btn-info btn-sm" href="#">
                                                            // <i class="fa fa-exclamation-triangle"></i>
                                                            // </a>';
                                                        }
                                                    } elseif ($lecture_formation == 1) {
                                                    }
                                                },
                                            ],
                                        ],


                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'update' => function ($url, $data) {
                                                    $lecture_formation = Utils::have_access('read_formation');
                                                    $all_formation = Utils::have_access('manage_formation');

                                                    if ($all_formation == 1) {

                                                        if ($data->cloture == 1) {
                                                            $url = 'update_formation?key=' . $data->key_formation;
                                                            return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-success btn-sm" href="' . $url . '">
                                                    <i class="fa fa-pencil-square fa-8x"></i>
                                                    </a>';
                                                        } else if ($data->cloture == 0) {
                                                            // $url = 'update_formation?key=' . $data->key_formation;
                                                            // return '<a title="' . Yii::t('app', 'clôturé') . '"class=" btn btn-info btn-sm" href="#">
                                                            // <i class="fa fa-exclamation-triangle"></i>
                                                            // </a>';
                                                        }
                                                    } elseif ($lecture_formation == 1) {
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
                                                    $lecture_formation = Utils::have_access('read_formation');
                                                    $all_formation = Utils::have_access('manage_formation');
                                                    if ($all_formation == 1) {

                                                        $url = 'delete_formation?key=' . $data->key_formation;

                                                        return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_formation . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenterDel"]);
                                                    } elseif ($lecture_formation == 1) {
                                                    }
                                                }
                                            ],
                                        ],


                                    ],
                                ]); ?>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenterDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterDelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteexempleModallabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deletmodalContent">
                ...
            </div>
            <input type="hidden" value="" id="key_form_tion">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal close formation -->
<div class="modal fade" id="exampleModalClose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeModalLabelclose">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalCloseFormation">
                ...
            </div>
            <input type="hidden" value="" id="key_form">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="cloture()">Valider</button>
            </div>
        </div>
    </div>
</div>


<script>
    function close_format(key_elements) {
        document.getElementById('key_form').value = key_elements;
        document.getElementById('closeModalLabelclose').innerHTML = 'Confirmation de clôture';
        document.getElementById('modalCloseFormation').innerHTML = 'Vous êtes sur le point de clôturer cette formation';
    }

    function delete_element(key_element_) {
        document.getElementById('key_form_tion').value = key_element_;
        document.getElementById('deleteexempleModallabel').innerHTML = 'Confirmation de suppression';
        document.getElementById('deletmodalContent').innerHTML = 'Vous êtes sur le point de supprimer cette formation Cette action est irréversible';
    }


    function cloture(key_elements) {
        var url = "<?= Yii::$app->homeUrl ?>close_formation";
        var key_elements = document.getElementById('key_form').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_elements,
            },
            success: function(result) {
                document.location.reload();
            }
        });
    }


    function vdelete_element(key_element_) {
        var url = "<?= Yii::$app->homeUrl ?>delete_formation";
        var key_element_ = document.getElementById('key_form_tion').value;

        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element_,
            },
            success: function(result) {

                document.location.reload();

            }
        });
    }
</script>

<style media="print">
    .no-print {
        display: none;
    }

    @media print {

        button,
        th {
            display: none;
        }
    }
</style>
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>