<?php

use backend\controllers\Utils;
use backend\models\Spectform;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpectformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Les types de formation et leurs spécialités';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>SPECIALITES ET LEURS TYPE DE FORMATION</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Spécialités leurs type de formation</li>
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
                            <div class="spectform-index">


                                <p>
                                    <?= Html::a(' Nouveau paramètre', ['create'], ['class' => 'btn btn-primary text-white fa fa-plus-square fa-8x']) ?>
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

                                        //'id',
                                        //'idTypeformation',
                                        //'idSpecialite',
                                        //'key_spectform',
                                        //'created_by',
                                        [
                                            'label' => 'Specialite',
                                            'value' => function ($data) {
                                                return $data->idSpecialite0->libelle;
                                            }

                                        ],
                                        [
                                            'label' => 'Type de formation',
                                            'value' => function ($data) {
                                                return $data->idTypeformation0->libelle;
                                            }

                                        ],
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
                                                    $url = 'view_spectform?key=' . $data->key_spectform;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '">
                                                            <i class="fa fa-eye fa-8x"></i>
                                                            </a>';
                                                },
                                            ],
                                        ],


                                        /* [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'update' => function ($url, $data) {
                                                    $url = 'update_spectform?key=' . $data->key_spectform;
                                                    return '<a title="' . Yii::t('app', 'update') . '" class="btn btn-info text-white btn-sm" href="' . $url . '">
                                                            <i class="fa fa-pencil-square fa-8x"></i>
                                                            </a>';
                                                },
                                            ],
                                        ], */


                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'delete' => function ($url, $data) {
                                                    $url = 'delete_spectform?key=' . $data->key_spectform;

                                                    // return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-sm', 'data-pjax' => '0']);

                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_spectform . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]);
                                ?>

                            </div>


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
            <input type="hidden" value="" id="keySpecial">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_element(key_element) {
        document.getElementById('keySpecial').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer ce paramètre, cette action est irréverssible !';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_spectf";
        var key_element = document.getElementById('keySpecial').value;
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