<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscription */

$this->title = 'Create Inscription';
$this->params['breadcrumbs'][] = ['label' => 'Inscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscription-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
