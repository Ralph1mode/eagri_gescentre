<?php

use backend\controllers\Utils;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Spectform */

$this->title = 'Paramétrage type de formation et spécialité';
$this->params['breadcrumbs'][] = ['label' => 'Spectforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>PARAMETRAGE TYPE DE FORMATION ET SPECIALITE</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_spectform">Paramétrage type de formation et spécialité</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ol>
        </div>
    </div>

    <div class="spectform-view">
        <div class="col-sm-6 p-md-0 list-group list-group-flush">
        </div>
        <div class="row">
            <div class="col-xl-3 col-xxl-4 col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="text-center p-3 overlay-box" style="background-image: url(template/images/img1.jpg);">
                                <div class="profile-photo">
                                    <img src="template/images/profil.png" width="100" class="img-fluid rounded-circle" alt="">
                                </div>
                                <h3 class=" text-white"><?= Html::encode($this->title) ?> </h3>
                                <p>
                                    <!-- <= Html::a(' Modifier', ['update', 'key' => $model->key_spectform], ['class' => 'text-white btn btn-success  btn-rounded fa fa-pencil-square fa-8x']) ?> -->
                                    <?= Html::a(' Supprimer', ['delete', 'key' => $model->key_spectform], [
                                        'onClick' => 'delete_elementspect(\'' . $model->key_spectform . '\')',
                                        'class' => 'btn btn-danger btn-rounded fa fa-trash-o fa-8x',
                                        "data-toggle" => "modal",
                                        "data-target" => "#exampleModalCenter3",
                                        'class' => 'btn btn-danger btn-rounded fa fa-trash-o fa-8x',
                                        'data' => [
                                            'confirm' => 'Etes vous sur de vouloir supprimer cet élément ?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </p>
                            </div>

                            <ul class="list-group list-group-flush">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'options' => [

                                        'class' => ' table-responsive table primary-table-bg-hover',
                                    ],
                                    'attributes' => [
                                        [
                                            'label' => 'Type de formation',
                                            'value' => function ($data) {
                                                return $data->idTypeformation0->libelle;
                                            }
                                        ],
                                        [
                                            'label' => 'Spécialité',
                                            'value' => function ($data) {
                                                return $data->idSpecialite0->libelle;
                                            }
                                        ],
                                        //'id',
                                        //'idTypeformation',
                                        //'idSpecialite',
                                        //'key_spectform',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                    ],
                                ]) ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-xxl-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">

                                <div class="tab-content">
                                    <div id="about-me" class="tab-pane fade active show">
                                        <div class="profile-personal-info pt-4">
                                            <h4 class="text-primary mb-4">Les matières de cette spécialité</h4>
                                            <div id="alertZone" class="content"></div>

                                            <div class="row mb-4">
                                                <div class="card-body">
                                                    <p>
                                                        <?= Html::a(' Ajouter une matière', ['createmat', 'key' => $model->key_spectform], ['class' => 'text-white btn btn-primary fa fa-plus-square fa-8x']) ?>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-responsive-sm" style="min-width: 845px">
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
                                                                    // ['class' => 'yii\grid\SerialColumn'],
                                                                    [
                                                                        'label' => 'Matières',
                                                                        'value' => function ($data) {
                                                                            return $data->idMatiere0->libelle;
                                                                        }
                                                                    ],

                                                                    [
                                                                        'label' => 'Nombre d\'heure',
                                                                        'value' => 'nb_heure'
                                                                    ],

                                                                    [
                                                                        'class' => 'yii\grid\ActionColumn',
                                                                        'template' => '{update}',
                                                                        'headerOptions' => ['width' => '15'],
                                                                        'buttons' => [
                                                                            'class' => ActionColumn::className(),
                                                                            'update' => function ($url, $data) {
                                                                                $url = 'update_mat?key=' . $data->key_brouillon;
                                                                                // return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-info btn-sm" href="' . $url . '"><i class="fa fa-pencil-square fa-8x"></i></a>';
                                                                                return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#exampleModalUpdate" onclick="showUpdateModal(\'' . $data->key_brouillon . '\',\'' . $data->nb_heure . '\',\'' . $data->idMatiere0->libelle . '\')"><i class="fa fa-pencil-square fa-8x"></i></a>';
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
                                                                                $url = 'delete_mat?key=' . $data->key_brouillon;
                                                                                return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_brouillon . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                                            }
                                                                        ],
                                                                    ],
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
            <input type="hidden" value="" id="keySpec">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Update brouillon -->
<div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelUpdate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModalUpdate">Modification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalAlertContent" class="container"></div>
            <div class="modal-body" id="bodyModalUpdate">
                <input type="text" disabled class="form-control" id="brouillon_matiere_libelle">
                <input type="number" class="form-control" id="brouillon_matiere_nbr_h">
            </div>
            <input type="hidden" value="" id="key_brouillon">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveUpdateMatiere()">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterDel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle3">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDeleteContent3">
                ...
            </div>
            <input type="hidden" value="" id="keyspect">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_elementspect()">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showUpdateModal(key_brouillon, nbr_heure, libelle) {
        document.getElementById('key_brouillon').value = key_brouillon;
        document.getElementById('brouillon_matiere_nbr_h').value = nbr_heure;
        document.getElementById('brouillon_matiere_libelle').value = libelle;
    }

    function saveUpdateMatiere() {
        let url = "<?= Yii::$app->homeUrl ?>update_brouillonf";
        let key_brouillon = document.getElementById('key_brouillon').value;
        let nbr_heure = document.getElementById('brouillon_matiere_nbr_h').value;
        let libelle = document.getElementById('brouillon_matiere_libelle').value;
        if (nbr_heure != '' || nbr_heure > 0) {
            $.ajax({
                url: url,
                method: "post",
                data: {
                    key_brouillon: key_brouillon,
                    nbr_heure: nbr_heure,
                    libelle: libelle,
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
        document.getElementById('keySpec').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de retirer cette matière pour la spécialitée';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_matbr";
        var key_element = document.getElementById('keySpec').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element,
            },
            success: function(result) {
                var err = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    'Matière supprimer avec succès' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
                $('#alertZone').html(err);
                document.location.reload();
            }
        });
    }

    function delete_elementspect(key_element3) {
        document.getElementById('keyspect').value = key_element3;
        document.getElementById('exampleModalLongTitle3').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent3').innerHTML = 'Vous êtes sur le point de supprimer ce paramètre';
    }

    function vdelete_elementspect() {
        var url = "<?= Yii::$app->homeUrl ?>delete_spectf";
        var key_element3 = document.getElementById('keyspect').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element3,
            },
            success: function(result) {
                // document.location.reload();
                document.location.href = "<?php Yii::$app->homeUrl ?>all_spectform";

            }
        });
    }
</script>