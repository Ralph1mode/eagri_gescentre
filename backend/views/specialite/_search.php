<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SpecialiteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specialite-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'id') 
    ?>


    <div class="header-left">
        <div class="search_bar dropdown">
            <?= $form->field($model, 'libelle')->textInput(['placeholder' => "Recherche", 'class' => "mdi mdi-magnify search_icon"])->label(false) ?>
            <button type="submit" class="btn btn-rounded pull-right btn-outline-primary"><i class="fa fa-search"></i></button>
        </div>
    </div>


    <?php //$form->field($model, 'descriptions') 
    ?>

    <?php //$form->field($model, 'key_specialite') 
    ?>

    <?php //$form->field($model, 'created_by') 
    ?>

    <?php // echo $form->field($model, 'updated_by') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'updated_at') 
    ?>

    <?php // echo $form->field($model, 'statut') 
    ?>



    <?php ActiveForm::end(); ?>

</div>