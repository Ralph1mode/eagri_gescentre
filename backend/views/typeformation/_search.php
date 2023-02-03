<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TypeformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-formation-search">

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

    <?php //$form->field($model, 'key_typeformation') 
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

    <div class="form-group">
        <?php // Html::submitButton('Search', ['class' => 'btn btn-primary']) 
        ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) 
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>