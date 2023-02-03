<?php

use backend\controllers\Utils;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Profil */

$this->title = $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                <li class="breadcrumb-item active"><a href="all_profil">Liste des profils</a></li>
                <li class="breadcrumb-item active">Détails</li>
            </ol>
        </div>
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
                            <h3 class=" text-white">Détail profil : <?= Html::encode($this->title) ?> </h3>
                            <p>
                                <!-- <= Html::a(' Modifier', ['update', 'key' => $model->key_profil], ['class' => 'text-white btn btn-success btn-rounded fa fa-pencil-square fa-8x']) ?> -->
                                <?= Html::a(' Supprimer', ['delete', 'key' => $model->key_profil], [
                                    'class' => 'btn btn-danger btn-rounded fa fa-trash-o fa-8x',
                                    'data' => [
                                        'confirm' => 'Etes vous sur de vouloir supprimer cette profil ?',
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
                                    //  'id',
                                    'libelle',
                                    // 'key_profil',
                                    //'created_by',
                                    // 'updated_by',
                                    // 'created_at',
                                    // 'updated_at',
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
                                        <h4 class="text-primary mb-4">Les fonctionnalitées de ce profil</h4>
                                        <div class="row mb-4">
                                            <div class="card-body">
                                                <p>
                                                    <?= Html::a(' Ajouter une fonctionnalité', ['createdetail', 'key' => $model->key_profil], ['class' => 'text-white btn btn-primary fa fa-plus-square fa-8x']) ?>
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
                                                                ['class' => 'yii\grid\SerialColumn'],

                                                                //'id',



                                                                [
                                                                    'label' => 'Fonctionnalité',
                                                                    'value' => function ($data) {
                                                                        return $data->idFonctionnalite0->libelle;
                                                                    }
                                                                ],





                                                                //['class' => 'yii\grid\ActionColumn'],
                                                                /* [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'template' => '{view}',
                                                    'headerOptions' => ['width' => '15'],
                                                    //'visible' => $droits[3] == 1 ? true : false,
                                                    'buttons' => [
                                                        'view' => function ($url, $data) {
            
                                                            $url = 'view_detail?key=' . $data->key_detail;
                                                            return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '">
                                            <i class="fas fa-eye"></i>
                                        </a>';
                                                        },
                                                    ],
                                                ], */


                                                                /*    [
                                                                    'class' => 'yii\grid\ActionColumn',
                                                                    'template' => '{update}',
                                                                    'headerOptions' => ['width' => '15'],
                                                                    //'visible' => $droits[3] == 1 ? true : false,
                                                                    'buttons' => [
                                                                        'update' => function ($url, $data) {
                                                                            //$url = 'index.php?r=article/update&key=' . $data->key_categorie;
                                                                            $url = 'update_profildetail?key=' . $data->key_profilfonctionnalite;
                                                                            return '<a title="' . Yii::t('app', 'update') . '" class="btn btn-info btn-sm" href="' . $url . '"><i class="fas fa-edit"></i></a>';
                                                                        },
                                                                    ],
                                                                ], */

                                                                [
                                                                    'class' => 'yii\grid\ActionColumn',
                                                                    'template' => '{delete}',
                                                                    'headerOptions' => ['width' => '15'],
                                                                    //'visible' => $droits[3] == 1 ? true : false,
                                                                    'buttons' => [
                                                                        'delete' => function ($url, $data) {
                                                                            return '<a title="' . Yii::t('app', 'delete') . '" class=" fa fa-trash-o fa-8x btn mini btn-danger btn-sm" href="#" data-toggle="modal" data-target="#exampleModal" onclick="delete_profildetail(\'' . $data->key_profilfonctionnalite . '\')">
                                                            
                                                                    </a>';

                                                                            /* $url = 'delete_demandedetail?key=' . $data->key_detaildemande;
                                                            return Html::a('<i class="fas fa-trash"></i>', $url, ['onClick' => 'return confirm("Veuillez confirmer la suppression !")', 'class' => 'btn btn-danger btn-sm', 'data-pjax' => '0']); */
                                                                        },
                                                                    ],


                                                                ]
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                ...
            </div>
            <input type="hidden" value="" id="keyElement">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="delete_real_enter()">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_profildetail(key_element) {
        document.getElementById('modalTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalContent').innerHTML = 'Vous êtes sur le point de supprimer cette fonctionnalité. Cette action est irréversible';
        document.getElementById('keyElement').value = key_element;
    }

    function delete_real_enter() {
        let url = "<?= Yii::$app->homeUrl ?>delete_profildetail";
        let key_element = document.getElementById('keyElement').value;
        if (key_element != '') {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    key_element: key_element
                },
                success: function(result) {
                    document.location.reload();
                }
            });
        }
    }
</script>