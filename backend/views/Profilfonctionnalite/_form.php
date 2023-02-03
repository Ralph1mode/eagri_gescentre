<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Profilfonctionnalite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profilfonctionnalite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idProfil')->textInput() ?>

    <?= $form->field($model, 'idFonctionnalite')->textInput() ?>

    <?= $form->field($model, 'key_profilfonctionnalite')->textInput(['maxlength' => true]) ?>

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
