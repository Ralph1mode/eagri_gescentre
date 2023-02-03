<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Brouillon */

$this->title = 'Create Brouillon';
$this->params['breadcrumbs'][] = ['label' => 'Brouillons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brouillon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
