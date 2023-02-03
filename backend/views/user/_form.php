<?php

use backend\models\Profil;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>



    <!-- <= $form->field($model, 'idProfil')->textInput() ?> -->

    <!-- <= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> -->

    <!-- <= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?> -->

    <!-- <= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?> -->

    <!-- <= $form->field($model, 'sexe')->textInput(['maxlength' => true]) ?> -->



    <!-- <= $form->field($model, 'status')->textInput() ?> -->

    <!-- <= $form->field($model, 'role')->textInput() ?> -->
    <!-- 
    <= $form->field($model, 'created_by')->textInput() ?>

    <= $form->field($model, 'updated_by')->textInput() ?>

    <= $form->field($model, 'created_at')->textInput() ?>

    <= $form->field($model, 'updated_at')->textInput() ?>

    <= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?> -->

    <div id="alert_place" class="content"></div>
    <?= Alert::widget() ?>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">

                <div class="card-body">
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Nom d'utilisateur</label>
                                    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Profil</label>
                                    <?= Html::dropDownList(
                                        'idProfil',
                                        null,
                                        ArrayHelper::map(
                                            Profil::find()->where(['statut' => 1])->all(),
                                            'id',
                                            'libelle',
                                        ),
                                        ['prompt' => 'Choisir une fonctionnalité', 'class' => 'form-control', 'required' => true, 'id' => 'selectFonctionnalite'],
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Sexe</label>
                                    <label class="form-label">Sexe</label>
                                    <select id="sexe" class="form-control" value="<?= $model->sexe ?>">
                                        <option value="" selected disabled>Choisir ...</option>
                                        <option value="M" <?= $model->sexe == 'M' ? 'selected="selected"' : '' ?>>Masculin</option>
                                        <option value="F" <?= $model->sexe == 'F' ? 'selected="selected"' : '' ?>>Feminin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Contact</label>
                                    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Mot de passe</label>
                                    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'type' => 'password'])->label(false) ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="form-group">
    <center>
        <form action="">
            <button type="reset" class="btn btn-dark btn-lg fa fa fa-undo fx-8"> Annuler</button>
        </form>
        <input type="button" value="Valider" class="btn btn-primary btn-lg " onclick="save_user()">
    </center>
</div>

<?php ActiveForm::end(); ?>
<script>
    function save_user() {
        let auth_key = '';
        let url = "<?= Yii::$app->homeUrl ?>save_use";
        let username = document.getElementById('user-username').value;
        let profil =  $("[name='idProfil']").val();
        let email = document.getElementById('user-email').value;
        let sexe = document.getElementById('sexe').value;
        let telephone = document.getElementById('user-telephone').value;
        let password_hash = document.getElementById('user-password_hash').value;


        if (username != '' && profil != '' && email != '' && sexe != '' && telephone != '' && password_hash != '') {
            if (username != '' || profil != '' || email != '' || sexe != '' || telephone != '' || password_hash != '') {
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        username: username,
                        profil: profil,
                        email: email,
                        sexe: sexe,
                        telephone: telephone,
                        password_hash: password_hash,
                        auth_key: auth_key,
                    },
                    success: function(result) {
                        if (result == "0") {
                            document.location.href = "<?= Yii::$app->homeUrl ?>";
                            console.log(telephone);
                        } else if (result == "ok" || result == "ko") {
                            document.location.href = "<?= Yii::$app->homeUrl ?>all_user";
                        } else {
                            // console.log(result);
                            // $('#alertZone').html(err);
                            window.location.reload();
                        }
                    }
                });
            } else {
                msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                    ' Veuillez renseigner les champs obligatoires</div> </div>';
                $('#alert_place').show();
                $('#alert_place').html(msg);
            }
        } else {
            msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                ' Veuillez renseigner les champs obligatoires</div> </div>';
            $('#alert_place').show();
            $('#alert_place').html(msg);
        }

    }
</script>