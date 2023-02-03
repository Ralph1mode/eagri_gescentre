<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\DetailView;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <?php //$this->registerCsrfMetaTags() 
    ?>
    <title>Eagri Gescentre</title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div id="main-wrapper">
        <!-- To display the header -->
        <?= $this->render('_haut') ?>
        <!-- To display the sidebar -->
        <?= $this->render('_gauche') ?>

        <div class="content-body">
            <?php echo $content; ?>
        </div>

        <footer class="footer">
            <!--footer-->
            <?= $this->render('_bas') ?>
            <!--end footer-->
        </footer>
    </div>



    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
