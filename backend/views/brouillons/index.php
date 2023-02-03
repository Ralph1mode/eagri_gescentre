<?php

use backend\models\Brouillon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrouillonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brouillons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brouillon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Brouillon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idSpectForm',
            'idMatiere',
            'nb_heure',
            'key_brouillon',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            //'statut',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Brouillon $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
