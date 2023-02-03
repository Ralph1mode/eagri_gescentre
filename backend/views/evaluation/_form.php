<?php

use backend\models\Evaluation;
use backend\models\Formation;
use backend\models\Profil;
use backend\models\TypeEvaluation;
use backend\models\User;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Evaluation */
/* @var $form yii\widgets\ActiveForm */


$model2 = Evaluation::find()->where(['statut' => 1, 'id' => $model->id])->one();
if (isset($model2)) {
    $idEvaluation = $model2->id;
}
?>

<div class="evaluation-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-row">
        <div class="form-group col-md-6">
            <h5 class="textwhite">Type d'évaluation<span class="text-danger">**</span></h5>
            <?= Html::dropDownList(
                'idTypeevaluation',
                null,
                ArrayHelper::map(
                    TypeEvaluation::find()->where(['statut' => 1])->all(),
                    'id',
                    'libelle'
                ),
                ['prompt' => 'Choisissez un type d\'évaluation', 'class' => 'form-control', 'required' => true],
            );
            ?>
        </div>


        <!--  <php
            $all_evaluation = TypeEvaluation::find()->where(['statut' => 1])->all();
            >
            <select name="select_formation" class="form-control">
                <php
                echo '<option value="">Choisissez un type d\'évaluation</option>';
                for ($i = 0; $i < sizeof($all_evaluation); $i++) { ?>
                    <option value="<= $all_evaluation[$i]->id ?>" <= $all_evaluation[$i]->id == $idEvaluation ? 'selected="selected"' : '' ?>><= $all_evaluation[$i]->libelle ?></option>;
                <php }
                ?>
            </select> -->


        <div class="form-group col-md-6">
            <h5 class="textwhite">Formation<span class="text-danger">**</span></h5>
            <?= Html::dropDownList(
                'idFormation',
                null,
                ArrayHelper::map(
                    Formation::find()->where(['statut' => 1, 'cloture' => 1])->all(),
                    'id',
                    'libelle'
                ),
                ['prompt' => 'Choisissez la formation', 'class' => 'form-control', 'required' => true],
            );
            ?>
        </div>
    </div>
    <center>
        <h5 class="textwhite" style="text-align:center;">Date de déroulement<span class="text-danger">**</span></h5>
    </center>
    <input type="date" name="ladate" class="form-control" value="<?= $model->ladate ?>" require>
    <center>
        <h5 class="textwhite">Heure de début<span class="text-danger">**</span></h5>
    </center>
    <input type="time" name="h_debut" class="form-control" value="<?= $model->h_debut ?>" require>
    <center>
        <h5 class="textwhite">Heure de fin<span class="text-danger">**</span></h5>
    </center>
    <input type="time" name="h_fin" class="form-control" value="<?= $model->h_fin ?>" require>


    <div class="form-group">
        <center>
            <form action="">
                <button type="reset" class="btn btn-dark btn-lg  fa fa fa-undo fx-8"> Annuler</button>
            </form>
            <input type="button" value="Valider" class="btn btn-primary btn-lg fa fa-floppy-o fx-8" onclick="validate_form()">
        </center>
    </div>
    <?php ActiveForm::end(); ?>


</div>



<script>
    function validate_form() {
        let key_eval = '';
        let url = "<?= Yii::$app->homeUrl ?>save_evaluation";
        let idTypeevaluation = $("[name='idTypeevaluation']").val();
        let idFormation = $("[name='idFormation']").val();
        // let nb_note = $("[name='nb_note']").val();
        let date = $("[name='ladate']").val();
        let heure_d = $("[name='h_debut']").val();
        let heure_f = $("[name='h_fin']").val();
        let type_action = document.getElementById('type_action').value;

        if (type_action == 'UPDATE') {
            let url_string = window.location.href
            let url0 = new URL(url_string);
            key_eval = url0.searchParams.get("key");
        }
        if (idTypeevaluation != null && idFormation != null && date != null && heure_d != null && heure_f != null && type_action != null) {
            if (idTypeevaluation != null || idFormation != null || date != null || heure_d != null || heure_f != null || type_action != null) {

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        idTypeevaluation: idTypeevaluation,
                        idFormation: idFormation,

                        date: date,
                        heure_d: heure_d,
                        heure_f: heure_f,
                        key_eval: key_eval,
                        type_action: type_action
                    },

                    success: function(result) {
                        if (result == "0") {
                            document.location.href = "<?= Yii::$app->homeUrl ?>";
                        } else {
                            var data = JSON.parse(result);
                            // var data = (result);
                            if (data.status == "ok") {
                                document.location.href = "<?php Yii::$app->homeUrl ?>all_evaluation";
                            } else if (result == 'ko') {
                                var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                    'Cette évaluation existe déjà' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                    '</div>';
                                window.location.reload();
                                $('#alertZone').html(err);
                            } else {
                                var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                    data.message +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                    '</div>';
                                window.location.reload();
                                $('#alertZone').html(err);
                            }
                        }
                    }
                });
            } else {
                var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                    'Veuillez renseigner tous les champs obligatoire' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
                window.location.reload();
                $('#alertZone').html(err);
                // window.location.reload();
            }
        } else {
            var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner tous les champs obligatoire' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
            window.location.reload();
            $('#alertZone').html(err);
            // window.location.reload();
        }
    }

    function set_evaluation(val) {
        alert(val);
        let url = "<?= Yii::$app->homeUrl ?>seteval";
        if (val != "") {
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    specialite: val,
                },
                success: function(result) {
                    alert('ok');
                }
            });
        } else {

        }
    }

    /*  function add_matiere() {
         let matiere = $("[name='select_matiere']").val();
         let matiere_text = $("[name='select_matiere'] option:selected").text();
         let nbr_heure = document.getElementById('nbr_heure').value;
         if (matiere != '' && matiere != null && nbr_heure != null && nbr_heure != '') {

             var old_detail_added = $("#all_detail_added").val();
             var search_position = old_detail_added.search('###' + matiere + ';;;');

             if (search_position >= 0) {
                 msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                     ' Cette matière a déjà été ajouté à la liste </div> </div>';
                 $('#alert_place').show();
                 $('#alert_place').html(msg);
             } else {

                 var new_data = matiere + ';;;' + nbr_heure;

                 $("#all_detail_added").val(old_detail_added + '###' + new_data + '***');

                 var newCell = document.createElement("td");
                 var newCell1 = document.createElement("td");
                 var newCell2 = document.createElement("td");

                 newCell.innerHTML = matiere_text;
                 newCell1.innerHTML = nbr_heure;
                 newCell2.innerHTML = '<i class="fa fa-trash" style="color:red" onclick="delete_detail(\'' + new_data + '\', this)"></i>';

                 var newRow = document.createElement("tr");

                 newRow.append(newCell);
                 newRow.append(newCell1);
                 newRow.append(newCell2);

                 document.getElementById("rows").appendChild(newRow);

                 $("[name='select_matiere']").val('');
                 document.getElementById('nbr_heure').value = '';


                 msg = '<div class="alert alert-success alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                     '  </div> Matière ajoutée avec succès </div>';
                 $('#alert_place').show();
                 $('#alert_place').html(msg);

             }

         } else {
             msg = '<div class="alert alert-danger alert-dismissible show fade" style="margin-bottom: 30px">' + ' <div class="alert-body">' +
                 ' Veuillez renseigner les champs obligatoires </div> </div>';
             $('#alert_place').show();
             $('#alert_place').html(msg);
         }
     } */

    /*  function delete_detail(data, element) {
         var correct_data = '###' + data + '***';
         var row_index = element.closest('tr').rowIndex;

         var all_detail_added = $("#all_detail_added").val();
         var res = all_detail_added.replace(correct_data, ""); // SUPPRESSION DE L'ELEMENT DANS LE CHAMP CACHE
         $("#all_detail_added").val(res);
         document.getElementById("tab_temp_preview").deleteRow(row_index); // SUPPRESSION DE L'ELEMENT DANS LE TABLEAU
     } */
</script>