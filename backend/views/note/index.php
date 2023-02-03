<?php

use backend\controllers\Utils;
use backend\models\Note;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notes';/* $model->idEvaluation->idTypeevaluation0->libelle; */
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>NOTES</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Liste des notes</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="table table-primary-bordered" style="min-width: 845px">
                            <div class="note-index">
                                <!-- <h1><?= Html::encode($this->title) ?></h1> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <?= Html::a(' Ajouter une note', ['create'], ['class' => 'btn btn-primary  fa fa-plus-square fa-8x']) ?>
                                            <a href="#" class="btn btn-danger text-white fa fa-print fa-8x"> Imprimer</a>

                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <button type="button" class="btn btn-primary" onclick="printContent('div1')">Imprimer <span class="btn-icon-right"><i class="fa fa-download"></i></span> -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- <?php echo $this->render('_search', ['model' => $searchModel]); ?> -->
                                    </div>

                                </div>

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

                                        // 'id',
                                        //  'idEvaluation',
                                        [
                                            'label' => 'Apprenant',
                                            'value' =>
                                            function ($data) {
                                                return $data->idInscription0->idApprenant0->nom;
                                            }

                                        ],
                                        /*  [
                                            'label' => 'Type d\'évaluation',
                                            'value' =>
                                            function ($data) {
                                                return $data->idEvaluation0->idTypeevaluation0->libelle;
                                            }

                                        ], */
                                        [
                                            'label' => 'Notes',
                                            'value' => 'libelle'


                                        ],
                                        //'idInscription',
                                        // 'libelle',
                                        //'key_note',
                                        //'idUser',
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
                                                    $url = 'view_note?key=' . $data->key_note;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary  btn-sm" href="' . $url . '">
                                                    <i class="fa fa-eye fa-8x"></i>
                                                    </a>';
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
                                                    $url = 'update_note?key=' . $data->key_note;
                                                    return '<a title="' . Yii::t('app', 'update') . '" class="btn btn-success btn-sm" href="' . $url . '">
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
                                                    $url = 'delete_note?key=' . $data->key_note;

                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-sm', 'data-pjax' => '0']);
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