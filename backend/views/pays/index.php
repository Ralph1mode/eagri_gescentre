<?php

use backend\models\Pays;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pays';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Alert::widget() ?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>PAYS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_typeformation">Pays</a></li>
                <li class="breadcrumb-item active"><a href="all_typeformation">Liste des pays</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="table table-primary-bordered" style="min-width: 845px">
                            <div class="pays_index">

                                <p>
                                    <?= Html::a(' Ajouter un pays',  ['create'], ['class' => 'btn btn-success btn-rounded fa fa-plus-square fa-8x']) ?>
                                </p>

                                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                                ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'tableOptions' => [
                                        'id' => 'theDatatable',
                                        'class' => 'table table-primary-bordered table-bordered'
                                    ],
                                    //'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        
                                        //'id',
                                        [
                                            'label' => 'Libellé',
                                            'value' => 'libelle',
                                        ],

                                        [
                                            'label' => 'Code',
                                            'value' => 'code',
                                        ],
                                        //update
                                        
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'view' => function ($url, $data) {
                                                    $url = 'view_pays?id=' . $data->id;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-rounded btn-sm" href="' . $url . '">
                                                    <i class="fa fa-eye fa-8x"></i>
                                                    </a>';
                                                },
                                            ],
                                        ],


                                           [ 'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'update' => function ($url, $data) {
                                                    $url = 'update_pays?id=' . $data->id;
                                                    return '<a title="' . Yii::t('app', 'update') . '" class="btn btn-info btn-rounded btn-sm" href="' . $url . '">
                                                    <i class="fa fa-pencil-square fa-8x"></i>
                                                    </a>';
                                                },
                                            ],
                                        ],
                                        

                                           [ 'class' => 'yii\grid\ActionColumn',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'delete' => function ($url, $data) {
                                                    $url = 'delete_pays?id=' . $data->id;

                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-rounded btn-sm', 'data-pjax' => '0']);
                                                }
                                            ],
                                        ],

                                            /*  'urlCreator' => function ($action, Pays $model, $key, $index, $column) {
                                                return Url::toRoute([$action, 'id' => $model->id]);
                                            } */
                                        
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
</div>