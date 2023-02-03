<?php

use backend\models\Memomatiere;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memomatieres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memomatiere-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Memomatiere', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idMatiere',
            'idFormation',
            'nb_heure',
            'key_matiere',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            //'statut',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Memomatiere $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
