<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head><!-- style="background-image: url(template/images/img1.jpg);background-size:cover;background-repeat:no-repeat;  position:fixe;" -->
<body class="h-100" >
<?php $this->beginBody() ?>

<main class="mt-5">
   <div>
    <?= $content ?>
   </div>
        
   
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
