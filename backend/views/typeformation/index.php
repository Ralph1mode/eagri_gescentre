<?php

use backend\controllers\Utils;
use backend\models\TypeFormation;
use common\widgets\Alert;
use yii\bootstrap4\Button;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypeformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type Formations';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>TYPES DE FORMATION</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Les types de formation</li>
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
                            <div class="type-formation-index">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <?= Html::a(' Ajouter un type de formation', ['create'], ['class' => 'btn btn-primary fa fa-plus-square fa-8x']) ?>

                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle no-print" data-toggle="dropdown" aria-expanded="false">Ordre</button>
                                        <button type="button" class="btn btn-rounded btn-warning no-print," onclick="printContent('div1')"><span class="btn-icon-left text-warning"><i class="fa fa-download color-warning"></i>
                                            </span>Imprimer</button>
                                        <a href="all_typeformation" type="button" class="btn btn-rounded btn-primary"><span class="btn-icon-left text-warning"><i class="fa fa fa-undo fx-8"></i>
                                            </span>Actualiser</a> -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <php echo $this->render('_search', ['model' => $searchModel]); ?> -->
                                    </div>

                                </div>
                                <div id='div1'>
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
                                            [
                                                'class' => 'yii\grid\SerialColumn',

                                            ],

                                            // 'id',
                                            [
                                                'label' => 'libelle',
                                                'value' => 'libelle',
                                            ],
                                            [
                                                'label' => 'descriptions',
                                                'value' => 'descriptions',

                                            ],

                                            /*       [
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => '{view}',
                                                'headerOptions' => ['width' => '15'],
                                                'buttons' => [
                                                    'class' => ActionColumn::className(),
                                                    'view' => function ($url, $data) {
                                                        $url = 'view_typeformation?key=' . $data->key_typeformation;
                                                        return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '">
                                                            <i class="fa fa-eye fa-8x"></i>
                                                            </a>';
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
                                                        $url = 'update_typeformation?key=' . $data->key_typeformation;
                                                        return '<a title="' . Yii::t('app', 'update') . '" class="btn btn-success text-white btn-sm" href="' . $url . '">
                                                            <i class="fa fa-pencil-square fa-8x"></i>
                                                            </a>';
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
                                                        $url = 'delete_typeformation?key=' . $data->key_typeformation;
                                                        // return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")','data-toggle'=>"modal", 'data-target' => "#exampleModal", 'class' => 'btn btn-danger  btn-sm  data-toggle="modal" data-target="#exampleModal"', 'data-pjax' => '0']);
                                                        return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_typeformation . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                    }

                                                ],
                                            ],
                                        ],
                                    ]);

                                    ?>
                                </div>

                            </div>
                        </table>
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
            <input type="hidden" value="" id="keyTypform">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showUpdateModal(key_specialite) {
        document.getElementById('key_typeformation').value = key_typeformation;
    }

    function saveUpdateMatiere() {
        let key_memomatiere = document.getElementById('key_memomatiere').value;
        if (key_matiere != "") {
            let url = "<?= Yii::$app->homeUrl ?>update_specialite";
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
        document.getElementById('keyTypform').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer ce type de formation, cette action est irréverssible !';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_typeformation";
        var key_element = document.getElementById('keyTypform').value;
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