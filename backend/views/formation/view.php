<?php

use backend\controllers\Utils;
use backend\models\Memomatiere;
use common\widgets\Alert;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Formation */

$this->title = $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Formations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                <li class="breadcrumb-item active"><a href="all_formation">Liste des formations</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ol>
        </div>
    </div>

    <?= Alert::widget() ?>

    <div class="formation-view">
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
                                <h3 class=" text-white">Détail formation : <?= Html::encode($this->title) ?> </h3>
                                <p>
                                    <?= Html::a(' Modifier', ['update', 'key' => $model->key_formation], ['class' => 'text-white btn btn-success btn-rounded fa fa-pencil-square fa-8x']) ?>
                                    <?= Html::a(' Supprimer', ['delete', 'key' => $model->key_formation], [
                                        'onClick' => 'delete_elementform(\'' . $model->key_formation . '\')',
                                        'class' => 'btn btn-danger btn-rounded fa fa-trash-o fa-8x',
                                        "data-toggle" => "modal",
                                        "data-target" => "#exampleModalCenter3",
                                        'data' => [
                                            'confirm' => 'Etes vous sur de vouloir supprimer cette formation ?',
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
                                            'value' =>   function ($data) {
                                                return $data->idSpectForm0->idTypeformation0->libelle;
                                            },

                                        ],
                                        [
                                            'label' => 'Spécialité de la formation',
                                            'value' =>   function ($data) {
                                                return $data->idSpectForm0->idSpecialite0->libelle;
                                            },

                                        ],
                                        'libelle',
                                        'descriptions:ntext',

                                        [
                                            'label' => 'Coût de la formation',
                                            'value' => $model->frais . ' Fr CFA',
                                        ],

                                        [
                                            'label' => 'date de début',
                                            'format' => ['date', 'php:d-m-Y'],
                                            'attribute' => 'date_debut',
                                            //'value' => Yii::$app->formatter->format($model->date_debut, 'date'),
                                        ],
                                        [
                                            'label' => 'Date de fin',
                                            'attribute' => 'date_fin',
                                            'format' => ['date', 'php:d-m-Y']

                                        ],
                                        [
                                            'format' => 'html',
                                            'label' => 'Etat de la formation',
                                            'value' => function ($data) {
                                                $state = 'danger';
                                                $stateTxt = 'Clôturée';
                                                if ($data->cloture == 1) {
                                                    $state = 'info';
                                                    $stateTxt = 'En cours';
                                                }
                                                return '<span class="badge badge-' . $state . '">' . $stateTxt . '</span>';
                                            }
                                        ]

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
                                            <h4 class="text-primary mb-4">Les matières de cette formation</h4>
                                            <div class="row mb-4">
                                                <div class="card-body">
                                                    <p>
                                                        <?= Html::a(' Ajouter une matière', ['createmat', 'key' => $model->key_formation], ['class' => 'text-white btn btn-primary fa fa-plus-square fa-8x']) ?>
                                                    </p>
                                                    <div class="table-responsive">
                                                        <table class="table table-responsive-sm" style="min-width: 845px">
                                                            <?= GridView::widget([
                                                                'dataProvider' => $dataProvider,
                                                                'layout' => '{items}{pager}',
                                                                'showOnEmpty' => false,
                                                                'emptyText' => Utils::emptyContent(),
                                                                'tableOptions' => [
                                                                    'class' => 'table table-hover'
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
                                                                                $url = 'update_mat?key=' . $data->idFormation0->key_formation;
                                                                                return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#exampleModalUpdate" onclick="showUpdateModal(\'' . $data->key_memomatiere . '\',\'' . $data->nb_heure . '\',\'' . $data->idMatiere0->libelle . '\')"><i class="fa fa-pencil-square fa-8x"></i></a>';
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
                                                                                $url = 'delete_mat?key=' . $data->key_memomatiere;

                                                                                return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_memomatiere . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
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


<!-- Modal Update Memo matiere -->
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

                <input type="text" disabled class="form-control" id="memo_matiere_libelle">
                <input type="number" class="form-control" id="memo_matiere_nbr_h">
            </div>
            <input type="hidden" value="" id="key_memomatiere">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveUpdateMatiere()">Valider</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterDel" aria-hidden="true">
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
            <input type="hidden" value="" id="keyMemomat">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
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
            <input type="hidden" value="" id="keyform">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_elementform()">Valider</button>
            </div>
        </div>
    </div>
</div>



<script>
    function showUpdateModal(key_memomatiere, nbr_heure, libelle) {
        document.getElementById('key_memomatiere').value = key_memomatiere;
        document.getElementById('memo_matiere_nbr_h').value = nbr_heure;
        document.getElementById('memo_matiere_libelle').value = libelle;
    }

    function saveUpdateMatiere() {
        let url = "<?= Yii::$app->homeUrl ?>update_memomatiere";
        let key_memomatiere = document.getElementById('key_memomatiere').value;
        let nbr_heure = document.getElementById('memo_matiere_nbr_h').value;
        let libelle = document.getElementById('memo_matiere_libelle').value;
        if (nbr_heure != '' || nbr_heure > 0) {
            $.ajax({
                url: url,
                method: "post",
                data: {
                    key_memomatiere: key_memomatiere,
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
        document.getElementById('keyMemomat').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de retirer cette matière de la formation';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_memomatieref";
        var key_element = document.getElementById('keyMemomat').value;
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


    function delete_elementform(key_element3) {
        document.getElementById('keyform').value = key_element3;
        document.getElementById('exampleModalLongTitle3').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent3').innerHTML = 'Vous êtes sur le point de supprimer cette formation';
    }

    function vdelete_elementform() {
        var url = "<?= Yii::$app->homeUrl ?>delete_formation";
        var key_element3 = document.getElementById('keyform').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element3,
            },
            success: function(result) {
                // document.location.reload();
                document.location.href = "<?php Yii::$app->homeUrl ?>all_formation";

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