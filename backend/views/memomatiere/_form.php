<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Memomatiere */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="memomatiere-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMatiere')->textInput(['autofocus' => true, 'required'=>true,]) ?>

    <?= $form->field($model, 'idFormation')->textInput(['required'=>true,]) ?>

    <?= $form->field($model, 'nb_heure')->textInput(['required'=>true,]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
