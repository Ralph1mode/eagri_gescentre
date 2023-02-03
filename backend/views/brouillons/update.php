<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Brouillon */

$this->title = 'Update Brouillon: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Brouillons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brouillon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
