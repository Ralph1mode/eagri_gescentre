<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Typeevaluation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="typeevaluation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'required' => true])->label('Libellé<span class="text-danger">**</span>') ?>

    <div class="form-group">
        <center>
            <?= Html::submitButton(' Enregistrer', ['class' => 'btn btn-primary  fa fa-floppy-o fx-8']) ?>
            <form action="">
                <button type="reset" class="btn btn-dark fa fa fa-undo fx-8"> Annuler</button>
            </form>
        </center>
    </div>

    <?php ActiveForm::end(); ?>

</div>