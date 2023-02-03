<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Memomatiere */

$this->title = 'Create Memomatiere';
$this->params['breadcrumbs'][] = ['label' => 'Memomatieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memomatiere-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
