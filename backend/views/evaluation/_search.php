<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EvaluationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idTypeevaluation') ?>

    <?= $form->field($model, 'idFormation') ?>

    <?= $form->field($model, 'nb_note') ?>

    <?= $form->field($model, 'ladate') ?>

    <?php // echo $form->field($model, 'h_debut') ?>

    <?php // echo $form->field($model, 'h_fin') ?>

    <?php // echo $form->field($model, 'key_eval') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'statut') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
