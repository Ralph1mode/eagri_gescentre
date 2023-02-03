<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brouillon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brouillon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSpectForm')->textInput() ?>

    <?= $form->field($model, 'idMatiere')->textInput() ?>

    <?= $form->field($model, 'nb_heure')->textInput() ?>

    <?= $form->field($model, 'key_brouillon')->textInput(['maxlength' => true]) ?>

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
