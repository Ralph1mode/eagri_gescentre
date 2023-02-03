<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Memomatiere */

$this->title = 'Update Memomatiere: ' . $model->key_memomatiere;
$this->params['breadcrumbs'][] = ['label' => 'Memomatieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="memomatiere-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'key_memomatiere' => $key_memomatiere,
    ]) ?>

</div>
