<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Note */

$this->title = 'Ajouter une note';
$this->params['breadcrumbs'][] = ['label' => 'Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
