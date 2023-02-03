<?php

use backend\controllers\Utils;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypeevaluationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type d\'évaluation';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>TYPE D'EVALUATION</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Liste des types d'évaluation</li>

            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="table table-primary-bordered" style="min-width: 845px">
                            <div class="typeevaluation-index">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <?= Html::a(' Ajouter un type d\'évaluation', '#', ['class' => 'btn btn-primary  fa fa-plus-square fa-8x', 'data-toggle' => 'modal', 'data-target' => '#exampleModalCreate', 'onclick' => 'Creat_typeevalModal']) ?>

                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <!--  <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle no-print" data-toggle="dropdown" aria-expanded="false">Ordre</button>
                                        <button type="button" class="btn btn-rounded btn-warning no-print," onclick="printContent('div1')"><span class="btn-icon-left text-warning"><i class="fa fa-download color-warning"></i>
                                            </span>Imprimer</button>
                                        <a href="all_typeevaluation" type="button" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-warning"><i class="fa fa fa-undo fx-8"></i>
                                            </span>Actualiser</a> -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <php echo $this->render('_search', ['model' => $searchModel]); ?> -->
                                    </div>

                                </div>




                                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                                ?>


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
                                            'label' => 'Libelle',
                                            'value' => 'libelle',
                                        ],


                                        //'id',
                                        //'libelle',
                                        //'key_Typeevaluation',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                        /*  [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'view' => function ($url, $data) {
                                                    $url = 'view_typeevaluation?key=' . $data->key_Typeevaluation;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-rounded btn-sm" href="' . $url . '">

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
                                                    $url = 'update_typeevaluation?key=' . $data->key_Typeevaluation;
                                                    // return '<a title="' . Yii::t('app', 'update') . '" class="btn btn-info btn-rounded btn-sm" href="' . $url . '">
                                                    // <i class="fa fa-pencil-square fa-8x"></i>
                                                    // </a>';

                                                    return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#exampleModalUpdate" onclick="showUpdateModal(\'' . $data->key_Typeevaluation . '\',\'' . $data->libelle . '\')"><i class="fa fa-pencil-square fa-8x"></i></a>';
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
                                                    $url = 'delete_typeevaluation?key=' . $data->key_Typeevaluation;

                                                    // return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-rounded btn-sm', 'data-pjax' => '0']);
                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_Typeevaluation . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                }
                                            ],
                                        ],


                                    ],
                                ]);
                                ?>


                            </div>

                    </div>

                    <!-- Modal Create type formation  -->
                    <div class="modal fade" id="exampleModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCreate" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="labelModalCreate">Ajoute d'un type d'évaluation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="modalAlertContent" class="container"></div>
                                <div class="modal-body" id="bodyModalCreate">
                                    <p>Libellé<span class="text-danger">**</span></p>
                                    <input type="text" required class="form-control" id="typeeval_Create_libelle">
                                </div>
                                <!-- <input type="hidden" value="" id="key_Typeevaluation"> -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary" onclick="Creat_typeevalModal()">Valider</button>
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
                                    <input type="text" required class="form-control" id="typeeval_Update_libelle">
                                </div>
                                <input type="hidden" value="" id="key_Typeevaluation">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-primary" onclick="saveUpdateMatiere()">Valider</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Delete Type formation -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="modalAlertContent" class="container"></div>
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

                    <!--Adding function-->
                    <script>
                        function Creat_typeevalModal() {
                            let libelle = document.getElementById('typeeval_Create_libelle').value;
                            if (libelle != '') {
                                let url = "<?= Yii::$app->homeUrl ?>create_typeevaluation";
                                $.ajax({
                                    url: url,
                                    method: "post",
                                    data: {
                                        libelle: libelle,
                                    },
                                    success: function(result) {
                                        document.location.reload();
                                    }
                                });
                            } else {
                                document.getElementById('modalAlertContent').innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                    'Veuillez renseigner un type d\'évaluation' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                    '</div>';
                            }

                        }
                    </script>
                    <script>
                        function showUpdateModal(key_Typeevaluation, libelle) {
                            document.getElementById('key_Typeevaluation').value = key_Typeevaluation;
                            document.getElementById('typeeval_Update_libelle').value = libelle;
                        }

                        function saveUpdateMatiere() {
                            let key_Typeevaluation = document.getElementById('key_Typeevaluation').value;
                            let Tlibelle = document.getElementById('typeeval_Update_libelle').value;
                            if (Tlibelle != '') {
                                let url = "<?= Yii::$app->homeUrl ?>update_typeevaluation";
                                $.ajax({
                                    url: url,
                                    method: "post",
                                    data: {
                                        key_Typeevaluation: key_Typeevaluation,
                                        Tlibelle: Tlibelle,
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

                        function delete_element(key_element) {
                            document.getElementById('keyTypeeval').value = key_element;
                            document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
                            document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer ce type d\'évaluation, cette action est irréverssible';
                        }

                        function vdelete_element() {
                            var url = "<?= Yii::$app->homeUrl ?>delete_typeevaluation";
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
                    </script>



                    <script>
                        function printContent(el) {
                            var restorepage = document.body.innerHTML;
                            var printcontent = document.getElementById(el).innerHTML;
                            document.body.innerHTML = printcontent;
                            window.print();
                            document.body.innerHTML = restorepage;
                        }
                    </script>