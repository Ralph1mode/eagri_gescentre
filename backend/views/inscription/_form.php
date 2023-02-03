<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idFormation')->textInput() ?>

    <?= $form->field($model, 'idApprenant')->textInput() ?>

    <?= $form->field($model, 'code_carte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moyenne')->textInput() ?>

    <?= $form->field($model, 'key_inscription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'statut')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
