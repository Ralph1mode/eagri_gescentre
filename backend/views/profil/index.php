<?php

use backend\controllers\Utils;
use backend\models\Profil;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profils';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>PROFILS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Liste des profils</li>
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
                            <div class="profil-index">

                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <?= Html::a(' Ajouter un profil', ['create'], ['class' => 'btn btn-primary  fa fa-plus-square fa-8x']) ?>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <button type="button" class="btn btn-primary" onclick="printContent('div1')">Imprimer <span class="btn-icon-right"><i class="fa fa-download"></i></span> -->
                                    </div>
                                    <div class="col-md-4">
                                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                                    </div>

                                </div>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{pager}',
                                    'showOnEmpty' => false,
                                    'emptyText' => Utils::emptyContent(),
                                    'tableOptions' => [
                                        'class' => 'table table-hover',
                                        'id' => 'example'
                                    ],
                                    //'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        //'id',
                                        'libelle',
                                        //'key_profil',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'update' => function ($url, $data) {
                                                    $url = 'update_profil?key=' . $data->key_profil;

                                                    return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#exampleModalUpdate" onclick="showUpdateModal(\'' . $data->key_profil . '\',\'' . $data->libelle . '\')"><i class="fa fa-pencil-square fa-8x"></i></a>';
                                                },
                                            ],
                                        ],

                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            //'visible' => $droits[3] == 1 ? true : false,
                                            'buttons' => [
                                                'view' => function ($url, $data) {
                                                    $url = 'view_profil?key=' . $data->key_profil;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '"><i class="fas fa-eye"></i></a>';
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
                                                    $url = 'delete_profil?key=' . $data->key_profil;

                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_profil . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
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

<!-- Modal Create profil  -->
<div class="modal fade" id="exampleModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModalCreate">Ajout d'un profil</h5>
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
            <input type="hidden" value="" id="key_profil">
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
            <input type="hidden" value="" id="keypro">
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
            let url = "<?= Yii::$app->homeUrl ?>create_profil";
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
                'Veuillez renseigner un profil' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
        }

    }
</script>

<script>
    function showUpdateModal(key_profil, libelle) {
        document.getElementById('key_profil').value = key_profil;
        document.getElementById('typeeval_Update_libelle').value = libelle;
    }

    function saveUpdateMatiere() {
        let key_profil = document.getElementById('key_profil').value;
        let Tlibelle = document.getElementById('typeeval_Update_libelle').value;
        if (Tlibelle != '') {
            let url = "<?= Yii::$app->homeUrl ?>update_profil";
            $.ajax({
                url: url,
                method: "post",
                data: {
                    key_profil: key_profil,
                    Tlibelle: Tlibelle,
                },
                success: function(result) {
                    document.location.reload();
                }
            });
        } else {
            document.getElementById('modalAlertContent2').innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner un profil' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
        }
    }

    function delete_element(key_element) {
        document.getElementById('keypro').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer ce profil, cette action est irréverssible';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_profil";
        var key_element = document.getElementById('keypro').value;
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