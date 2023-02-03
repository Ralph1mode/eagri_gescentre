<?php

use backend\controllers\Utils;
use backend\models\Formation;
use backend\models\Inscription;
use backend\models\Payement;
use backend\models\Pays;
use backend\models\Spectform;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Apprenant */
/* @var $form yii\widgets\ActiveForm */

$payement = new Payement();
$idFormation = '';
$inscription = Inscription::find()->where(['statut' => 1, 'idApprenant' => $model->id])->one();
if (isset($inscription)) {
    $idFormation = $inscription->idFormation;
    $payement = Payement::find()->where(['statut' => 1, 'idInscription' => $inscription->id])->one();
}

$idPays = '';
if (isset($idPays)) {
    $pays = Pays::find()->where(['statut' => 1])->all();
}
?>

<div class="apprenant-form">
    <?= Alert::widget() ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'maform']]); ?>
    <div id="alertZone" class="content"></div>
    <div class="row">
        <div class="card-body">
            <form action="#" method="post">


                <section class="form_one">

                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 10%; height:6px;" role="progressbar">
                            <span class="sr-only">30% Complete</span>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Nom<span class="text-danger">**</span></label>
                                <input type="text" id="nom" require class="form-control" style="text-transform:uppercase" value="<?= $model->nom ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Prénom<span class="text-danger">**</span></label>
                                <input type="text" id="prenom" require class="form-control" value="<?= $model->prenom ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Email<span class="text-danger">**</span></label>
                                <input type="mail" id="email" require class="form-control" value="<?= $model->email ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Date de naissance<span class="text-danger">**</span></label>
                                <input type="date" id="datenaiss" require class="datepicker-default form-control" value="<?= $model->datenaisse ?>">
                            </div>
                        </div>



                        <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <h5 class="form-label">Pays<span class="text-danger">**</span></h5>
                                <= Html::dropDownList(
                                    'select_pays',
                                    null,
                                    ArrayHelper::map(
                                        Pays::find()->where(['statut' => 1])->all(),
                                        'id',
                                        'libelle'
                                    ),
                                    ['prompt' => 'Choisissez le pays', 'class' => 'form-control']
                                );
                                ?>
                            </div> -->


                        <?php
                        if (!(isset($_GET['key']) and $_GET['key'] != '')) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5 class="form-label">Pays<span class="text-danger">**</span></h5>
                                    <?php
                                    $all_pays = Pays::find()->where(['statut' => 1])->all();
                                    ?>
                                    <select name="select_pays" class="form-control">
                                        <?php
                                        echo '<option value="">Choisissez le pays</option>';
                                        for ($i = 0; $i < sizeof($all_pays); $i++) { ?>
                                            <option value="<?= $all_pays[$i]->id ?>"><?= $all_pays[$i]->libelle ?> </option>;
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php } else  if ((isset($_GET['key']) and $_GET['key'] != '')) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <h5 class="form-label">Pays<span class="text-danger">**</span></h5>
                                    <?php
                                    $all_pays = Pays::find()->where(['statut' => 1])->all();
                                    ?>
                                    <select name="select_pays" class="form-control">
                                        <?php
                                        echo '<option value="">Choisissez le pays</option>';
                                        for ($i = 0; $i < sizeof($all_pays); $i++) { ?>
                                            <option value="<?= $all_pays[$i]->id ?>" <?= $all_pays[$i]->id == $inscription->idApprenant0->idPays ? 'selected="selected"' : '' ?>><?= $all_pays[$i]->libelle ?></option>;
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>



                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Sexe</label>
                                <select id="sexe" class="form-control" value="<?= $model->sexe ?>">
                                    <option value="" selected disabled>Choisir ...</option>
                                    <option value="M" <?= $model->sexe == 'M' ? 'selected="selected"' : '' ?>>Masculin</option>
                                    <option value="F" <?= $model->sexe == 'F' ? 'selected="selected"' : '' ?>>Feminin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <center>
                        <button type="reset" class="btn btn-dark btn-lg fa fa-undo fx-8">Annuler</button>
                        <input type="button" class="btn btn-primary btn-lg fa fa-floppy-o fx-8" value="Continuer" onclick="show_hideformtwo()">
                    </center>




                    <!-- </div> -->
                </section>

                <section class="form_two">
                    <!-- <div id="div2"> -->
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 60%; height:6px;" role="progressbar">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Numéro de téléphone<span class="text-danger">**</span></label>
                                <input type="tel" id="tel" id="phoneNumber" on-input="_allowNumbersCharsOnly" on-change="_formatPhoneNumber" maxlength="12" Pattern="^9[0-9]{7}" require class="form-control" value="<?= $model->tel ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Niveau d'étude<span class="text-danger">**</span></h5></label>

                                <?= $form->field($model, 'niveau')->dropdownList(
                                    Utils::show_modedon(),
                                    ['prompt' => 'Choisir ...', 'onchange' => '', 'required' => true],
                                    ['class' => 'form-control']
                                )->error(false)->label(false); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Profession<span class="text-danger">**</span></h5></label>
                                <input type="text" id="profession" class="form-control" value="<?= $model->profession ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Photo d'identité<span class="text-danger">**</span></h5></label>
                                <div class="input-group mb-3">
                                    <input type="file" id="photo" class="form-control" required accept="image/*" value="<?= $model->chem_photo ?>">

                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Pièce d'identité<span class="text-danger">**</span></h5></label>
                                <div class="input-group mb-3">
                                    <input type="file" id="piece" class=" form-control " required accept="application/pdf" value="<?= $model->chem_piece ?>">

                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Diplôme<span class="text-danger">**</span></h5></label>
                                <div class="input-group mb-3">
                                    <input type="file" id="diplome" class="form-control" required accept="application/pdf" value="<?= $model->chem_diplome ?>">

                                </div>
                                <br>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <center>
                            <?php //Html::submitButton(' Enregistrer', ['class' => 'btn btn-primary btn-rounded fa fa-floppy-o fx-8']) 
                            ?>
                            <input type="button" class="btn btn-dark btn-lg fa fa-undo fx-8" value="Retour" onclick="show_hideformon()">

                            <input type="button" value="Continuer" class="btn btn-primary btn-lg fa fa-floppy-o fx-8" onclick="show_hideformtree()">
                            <!-- <button type="reset" class="btn btn-dark fa fa fa-undo fx-8" onclick="show_hideformon()"> Annuler</button> -->
                        </center>
                    </div>
                    <!-- </div> -->
                </section>

                <section class="form_tree">
                    <!-- <div id="div2"> -->
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 100%; height:6px;" role="progressbar">
                            <span class="sr-only">100% Complete</span>
                        </div>
                    </div>
                    <div id="alertZone" class="content"></div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Formation<span class="text-danger">**</span></h5></label>
                            <?php
                            $all_formation = Formation::find()->where(['statut' => 1, 'cloture' => 1])->all();
                            ?>
                            <select name="select_formation" class="form-control">
                                <?php
                                echo '<option value="">Choisissez la formation</option>';
                                for ($i = 0; $i < sizeof($all_formation); $i++) { ?>
                                    <option value="<?= $all_formation[$i]->id ?>" <?= $all_formation[$i]->id == $idFormation ? 'selected="selected"' : '' ?>><?= $all_formation[$i]->libelle . ' | ' . $all_formation[$i]->frais . 'Fr CFA' ?></option>;
                                <?php }
                                ?>
                            </select>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Moyen de payement<span class="text-danger">**</span></h5></label>
                                <select id="moyenPay" class="form-control">
                                    <!-- value="<= $payement->moypay ?>" -->
                                    <option value="" selected disabled>Choisir ...</option>
                                    <option value="Chèque" <?= $payement->moypay == 'Chèque' ? 'selected="selected"' : '' ?>>CHEQUE</option>
                                    <option value="Virement bancaire" <?= $payement->moypay == 'Virement bancaire' ? 'selected="selected"' : '' ?>>VIREMENT BANCAIRE</option>
                                    <option value="MoneyGram" <?= $payement->moypay == 'MoneyGram' ? 'selected="selected"' : '' ?>>MONEYGRAM</option>
                                    <option value="Flooz" <?= $payement->moypay == 'Flooz' ? 'selected="selected"' : '' ?>>FLOOZ</option>
                                    <option value="T-money" <?= $payement->moypay == 'T-money' ? 'selected="selected"' : '' ?>>T-MONEY</option>
                                    <option value="Western Union" <?= $payement->moypay == 'Western Union' ? 'selected="selected"' : '' ?>>WESTERN UNION</option>
                                    <option value="Espèce" <?= $payement->moypay == 'Espèce' ? 'selected="selected"' : '' ?>>ESPECE</option>
                                </select>
                            </div>
                        </div>


                        <?php
                        if (!(isset($_GET['key']) and $_GET['key'] != '')) { ?>



                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Somme déjà payé<span class="text-danger">**</span></label>
                                    <input type="number" id="deja_paye" require class="form-control" value="<?= $payement->montant_paye ?>">
                                </div>
                            </div>
                        <?php } else  if ((isset($_GET['key']) and $_GET['key'] != '')) { ?>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Somme déjà payé<span class="text-danger">**</span></label>
                                    <input type="number" id="deja_paye" disabled require class="form-control" value="<?= $payement->montant_paye ?>">
                                </div>
                            </div>

                        <?php } ?>


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Date de payement<span class="text-danger">**</span></label>
                                <input type="date" id="paye_le" require class="form-control" value="<?= $payement->datepay ?>">
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Référence payement<span class="text-danger">**</span></label>
                                <input type="text" id="reference" require class="form-control" value="<?= $payement->reference ?>">
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <center>
                            <form action="">
                                <input type="button" class="btn btn-dark btn-lg fa fa-undo fx-8" value="Retour" onclick="show_hideformfour()">

                                <input type="button" value="Valider" class="btn btn-primary btn-lg fa fa-floppy-o fx-8" onclick="validate_form()">
                                <!-- <button type="reset" class="btn btn-dark fa fa fa-undo fx-8" onclick="show_hideformon()"> Annuler</button> -->
                            </form>
                        </center>
                    </div>
                    <!-- </div> -->
                </section>
        </div>
        </form>
    </div>



</div>
<?php ActiveForm::end(); ?>

<script>
    function validate_form() {
        let key_apprenant = '';
        let url = "<?= Yii::$app->homeUrl ?>save_apprenant";
        let nom = document.getElementById('nom').value;
        let prenom = document.getElementById('prenom').value;
        let email = document.getElementById('email').value;
        let date_naiss = document.getElementById('datenaiss').value;
        let pays = $("[name='select_pays']").val();
        let formation = $("[name='select_formation']").val();
        let sexe = document.getElementById('sexe').value;
        let moyen_pay = document.getElementById('moyenPay').value;
        let somme_deja_pay = document.getElementById('deja_paye').value;
        let reference = document.getElementById('reference').value;
        let paye_le = document.getElementById('paye_le').value;
        let num_tel = document.getElementById('tel').value;
        // let niv_etude = $("[name='niveau']").val();
        let niv_etude = document.getElementById('apprenant-niveau').value;
        let profession = document.getElementById('profession').value;
        let photo = document.getElementById('photo').files[0];
        let piece = document.getElementById('piece').files[0];
        let diplome = document.getElementById('diplome').files[0];

        // console.log(diplome);
        // let diplome = $('#diplome');
        let type_action = document.getElementById('type_action').value;
        //let type_action = "CREATE";
        let continu = false;
        if (type_action == 'UPDATE') {
            let url_string = window.location.href
            let url0 = new URL(url_string);
            key_apprenant = url0.searchParams.get("key");

            if (nom != "" && prenom != "" && email != "" && date_naiss != "" && pays != "" && sexe != "" && num_tel != "" && niv_etude != "" && profession != "" && formation != "" && moyen_pay != "" && somme_deja_pay != "" && reference != "" && paye_le != "") {
                continu = true;
            }
        } else {
            if (nom != "" && prenom != "" && email != "" && date_naiss != "" &&
                pays != "" && sexe != "" && num_tel != "" && niv_etude != "" &&
                profession != "" && formation != "" && moyen_pay != "" && somme_deja_pay != "" &&
                reference != "" && paye_le != "" &&
                piece != "" && diplome != "") {
                continu = true;
            }
        }
        if (continu) {
            // if (nom != "" || prenom != "" || email != "" || date_naiss != "" || pays != "" || sexe != null || num_tel != null || niv_etude != null || profession != null || formation != null || moyen_pay != null || somme_deja_pay != null || reference != null || paye_le != null) {

            var formData = new FormData();

            formData.append('nom', nom);
            formData.append('pays', pays);
            formData.append('sexe', sexe);
            formData.append('email', email);
            formData.append('prenom', prenom);
            formData.append('num_tel', num_tel);
            formData.append('paye_le', paye_le);
            formData.append('formation', formation);
            formData.append('moyen_pay', moyen_pay);
            formData.append('reference', reference);
            formData.append('niv_etude', niv_etude);
            formData.append('date_naiss', date_naiss);
            formData.append('profession', profession);
            formData.append('photo', photo, photo.name);
            formData.append('piece', piece, piece.name);
            formData.append('type_action', type_action);
            formData.append('key_apprenant', key_apprenant);
            formData.append('somme_deja_pay', somme_deja_pay);
            formData.append('diplome', diplome, diplome.name);

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(result) {

                    if (result == "0") {
                        // alert(num_tel);
                        document.location.href = "<?= Yii::$app->homeUrl ?>";
                    } else {
                        if (result == "ok") {

                            // alert('niv_etude');

                            document.location.href = "<?php Yii::$app->homeUrl ?>all_apprenant";
                        } else {

                            document.location.reload();
                            console.log(result);
                            console.log('profession');
                        }
                    }
                }
            });
            // } else {

            //     var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            //         'Veuillez renseigner tous les champs obligatoires' +
            //         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            //         '<span aria-hidden="true">&times;</span>' +
            //         '</button>' +
            //         '</div>';
            //     //window.location.reload();
            //     $('#alertZone').html(err);
            // }
        } else {

            var err = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                'Veuillez renseigner tous les champs obligatoires' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
            //alert(nom);
            //window.location.reload();
            $('#alertZone').html(err);
        }
    }


    function set_apprenant(val) {

        let url = "<?= Yii::$app->homeUrl ?>setapprenant";
        if (val != "") {
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                success: function(result) {
                    alert('ok');
                }
            });
        } else {
            alert('rien n est pris');
        }
    }
</script>

<script>
    let premiere_session = document.querySelector(".form_one");
    let deuxieme_session = document.querySelector(".form_two");
    let troixieme_session = document.querySelector(".form_tree");
    deuxieme_session.style.display = "none";
    troixieme_session.style.display = "none";

    visible1 = true;

    function show_hideformtwo() {
        if (visible1) {
            deuxieme_session.style.display = "block";
            premiere_session.style.display = "none";
            troixieme_session.style.display = "none";
            visible2 = false;
        } else {
            premiere_session.style.display = "block";
            deuxieme_session.style.display = "none";
            troixieme_session.style.display = "none";

            visible2 = true;
        }

    }

    function show_hideformon() {

        if (visible2) {
            deuxieme_session.style.display = "block";
            premiere_session.style.display = "none";
            troixieme_session.style.display = "none";
            visible3 = false;
        } else {
            premiere_session.style.display = "block";
            deuxieme_session.style.display = "none";
            troixieme_session.style.display = "none";

            visible3 = false;
        }

    }




    visiblex = true;

    function show_hideformtree() {
        if (visiblex) {
            deuxieme_session.style.display = "none";
            premiere_session.style.display = "none";
            troixieme_session.style.display = "block";
            visible2 = false;
        } else {
            premiere_session.style.display = "none";
            deuxieme_session.style.display = "block";
            troixieme_session.style.display = "none";

            visible2 = true;
        }

    }

    function show_hideformfour() {

        if (visible2) {
            deuxieme_session.style.display = "none";
            premiere_session.style.display = "none";
            troixieme_session.style.display = "block";
            visible3 = false;
        } else {
            premiere_session.style.display = "none";
            deuxieme_session.style.display = "block";
            troixieme_session.style.display = "none";

            visible3 = false;
        }

    }

    /*     function show_hidefortree() {
            if (visible3) {
                deuxieme_session.style.display = "none";
                premiere_session.style.display = "none";
                troixieme_session.style.display = "block";
                visible4 = false;
            } else {
                premiere_session.style.display = "block";
                deuxieme_session.style.display = "block";
                troixieme_session.style.display = "none";

                visible4 = false;
            }
        } */


    let phoneNumber = document.getElementById('phoneNumber');
    phoneNumber.addEventListener('change', _formatPhoneNumber);
    phoneNumber.addEventListener('keyup', _formatPhoneNumber);

    function _formatPhoneNumber(evt) {
        let number = evt.target.value.replace(/[^\d]/g, '')
        if (number.length == 10) {
            number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
        }
        //console.log(number) // (123) 456-6789
        evt.target.value = number;
    }
</script>


<script>
    let b_cont1 = document.getElementById("b_cont1");
    let b_ann1 = document.getElementById("b_ann1");
    let b_cont2 = document.getElementById("b_cont2");
    let b_ann2 = document.getElementById("b_ann2");
    let div1 = document.getElementById("div1");
    let div2 = document.getElementById("div2");
    b_cont2.addEventListener("click", () => {
        if (getComputedStyle(div2).display != "block") {
            div1.style.display = "block";
        } else {
            div2.style.display = "none";
        }
    })


    b_cont1.addEventListener("click", () => {
        if (getComputedStyle(div1).display != "none") {
            div2.style.display = "block";
        } else {
            div1.style.display = "none";
        }
    })

    function togg() {
        if (getComputedStyle(div2).display != "none") {
            div2.style.display = "block";
        } else {
            div2.style.display = "none";
        }
    };

    function togg2() {
        if (getComputedStyle(div1).display != "block") {
            div2.style.display = "none";
        } else {
            div1.style.display = "block";
        }
    };
    b_ann2.onclick = togg;
    b_ann1.onclick = togg2;
</script>