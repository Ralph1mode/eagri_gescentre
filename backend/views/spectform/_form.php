<?php

use backend\models\Brouillon;
use backend\models\Matiere;
use backend\models\Specialite;
use backend\models\TypeFormation;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Spectform */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spectform-form">
    <div id="alertZone" class="content"></div>

    <?php $form = ActiveForm::begin() ?>

    <?php
    echo $form->field($model, 'idTypeformation')->dropdownList(
        ArrayHelper::map(
            Typeformation::find()->where(['statut' => 1])->all(),
            'id',
            'libelle'
        ),
        ['prompt' => 'Choisissez le type de formation'],
        ['class' => 'form-control']
    )->error(false)->label('Type de formation');
    ?>


    <?php
    echo $form->field($model, 'idSpecialite')->dropDownList(
        ArrayHelper::map(
            Specialite::find()->where(['statut' => 1])->all(),
            'id',
            'libelle'
        ),
        ['prompt' => 'Choisissez une spécialité'],
        ['class' => 'form-control']
    )->error(false)->label('Specialité');
    ?>


    <div class=" text-white bg-primary">
        <table class="table primary-table-bg-hover" id="">
            <div id="alert_place" class="content"></div>
            <tr>
    </div>
    <td>

        <h5 class="text-white">Ajouter une matière à cette formation<span class="text-danger">*</span></h5>
        <?= Html::dropDownList(
            'select_matiere',
            null,
            ArrayHelper::map(
                Matiere::find()->where(['statut' => 1])->all(),
                'id',
                'libelle'
            ),
            ['prompt' => 'Choisissez la matière', 'class' => 'form-control', 'required' => true],

        );
        ?>

    </td>
    <td>
        <div class="">
            <div class="">
                <h5 class="text-white">Choissez le nombre d'heure pour cette matière<span class="text-danger">*</span></h5>
                <input type="number" class="form-control" id="nbr_heure">

            </div>
        </div>
    </td>
    <td>
        <button type="button" class=" btn btn-dark fa fa-plus-square fa-8x" onclick="add_matiere()"> Ajouter</button>
    </td>
    </tr>
    </table>
    <table class="table table-bordered" id="tab_temp_preview">
        <thead class="thead-primary">
            <tr>
                <th scope="col">Matière</th>
                <th scope="col">Nombre d'heure</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="rows">
        </tbody>
    </table>
    <div class="form-group">
        <center>
            <button type="reset" class="btn btn-dark fa fa fa-undo fx-8"> Annuler</button>
            <input type="button" value=" Valider" class="btn btn-primary" onclick="validate_form()">
            <form action="">
            </form>
        </center>
    </div>
    <?php ActiveForm::end(); ?>
    <textarea name="" id="all_detail_added" cols="30" rows="10" style="display: none;"></textarea>
</div>



<script>
    function add_matiere() {
        let matiere = $("[name='select_matiere']").val();
        let matiere_text = $("[name='select_matiere'] option:selected").text();
        let nbr_heure = document.getElementById('nbr_heure').value;

        if (matiere != null && nbr_heure != '') {

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
                ' Veuillez renseigner les champs obligatoires</div> </div>';
            $('#alert_place').show();
            $('#alert_place').html(msg);
        }
    }

    function delete_detail(data, element) {
        var correct_data = '###' + data + '***';
        var row_index = element.closest('tr').rowIndex;

        var all_detail_added = $("#all_detail_added").val();
        var res = all_detail_added.replace(correct_data, ""); // SUPPRESSION DE L'ELEMENT DANS LE CHAMP CACHE
        $("#all_detail_added").val(res);
        document.getElementById("tab_temp_preview").deleteRow(row_index); // SUPPRESSION DE L'ELEMENT DANS LE TABLEAU
    }
</script>

<script>
    function validate_form() {
        let key_brouillon = '';
        let url = "<?= Yii::$app->homeUrl ?>save_specf";
        let typeformation = document.getElementById('spectform-idtypeformation').value;
        let specialite = document.getElementById('spectform-idspecialite').value;
        let type_action = document.getElementById('type_action').value;
        let all_detail_added = '-';

        if (type_action == 'UPDATE') {
            let url_string = window.location.href
            let url0 = new URL(url_string);
            let key_brouillon = url0.searchParams.get("key");
        } else {
            all_detail_added = document.getElementById('all_detail_added').value;
        }
        if (specialite != "" && typeformation != "" && all_detail_added != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    typeformation: typeformation,
                    specialite: specialite,
                    type_action: type_action,
                    key_brouillon: key_brouillon,
                    all_detail_added: all_detail_added,
                },
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else if (result == "ok") {
                        document.location.href = "<?= Yii::$app->homeUrl ?>all_spectform";
                    } else {
                        // console.log(result);
                        var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            'Ce paramètre existe déjà' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';
                        $('#alertZone').html(err);
                        // window.location.reload();
                    }
                }
            });
        } else {
            var err = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner tous les champs obligatoires' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
            $('#alertZone').html(err);
            // window.location.reload();
        }
    }


    function set_specialite(val) {
        //alert(val);
        let url = "<?= Yii::$app->homeUrl ?>setparam";
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
</script>


<!-- <script>
    function update_form() {
        let url = "<= Yii::$app->homeUrl ?>update_specf";
        let typeformation = document.getElementById('spectform-idtypeformation').value;
        let specialite = document.getElementById('spectform-idspecialite').value;
        let type_action = document.getElementById('type_action').value;
        if (specialite != "" && typeformation != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    typeformation: typeformation,
                    specialite: specialite,
                    type_action: type_action,
                },
                success: function(result) {
                    if (result == "0") {
                        document.location.href = "<= Yii::$app->homeUrl ?>";
                    } else if (result == "ok" || result == "ko") {
                        document.location.href = "<= Yii::$app->homeUrl ?>all_spectform";
                    } else {
                        console.log(result);
                    }
                }
            });
        } else {

        }
    }
</script> -->