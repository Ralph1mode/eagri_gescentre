<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Profilfonctionnalite */

$this->title = 'Create Profilfonctionnalite';
$this->params['breadcrumbs'][] = ['label' => 'Profilfonctionnalites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profilfonctionnalite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
