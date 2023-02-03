<?php

use backend\controllers\Utils;
use backend\models\User;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>UTILISATEURS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Liste des utilisateurs</li>
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
                            <div class="user-index">

                                <!-- <h1><= Html::encode($this->title) ?></h1> -->

                                <p>
                                    <?= Html::a(' Ajouter un utilisateur', ['create'], ['class' => 'btn btn-primary fa fa-plus-square fa-8x']) ?>
                                </p>

                                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                                ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{pager}',
                                    'showOnEmpty' => false,
                                    'emptyText' => Utils::emptyContent(),
                                    'tableOptions' => [
                                        'class' => 'table table-hover'
                                    ],
                                    // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        //'id',
                                        'username',
                                        'idProfil',
                                        /* [
                                            'label' => 'Profil',
                                            'value' =>  function ($data) {
                                                return $data->profils->libelle;
                                            }

                                        ], */
                                       /*  [
                                            'label' => 'Profil',
                                            'value' => $model->profil0->libelle,

                                        ], */
                                        //'auth_key',
                                        //'password_hash',
                                        //'password_reset_token',
                                        //'sexe',
                                        //'email:email',
                                        //'telephone',
                                        //'status',
                                        //'role',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'verification_token',
                                      /*   [
                                            'class' => ActionColumn::className(),
                                            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                                                return Url::toRoute([$action, 'id' => $model->id]);
                                            }
                                        ], */
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'update' => function ($url, $data) {
                                                    $url = 'update_user?key=' . $data->auth_key;
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
                                                    $url = 'delete_user?key=' . $data->auth_key;

                                                    // return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-sm', 'data-pjax' => '0']);

                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->auth_key . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]); ?>


                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>