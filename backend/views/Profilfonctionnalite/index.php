<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfilfonctionnaliteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profilfonctionnalites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profilfonctionnalite-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profilfonctionnalite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idProfil',
            'idFonctionnalite',
            'key_profilfonctionnalite',
            'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            //'statut',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Profilfonctionnalite $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
