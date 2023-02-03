<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h4 class="error-text font-weight-bold"><?= Html::encode($this->title) ?></h4>
                        <i class="fa fa-exclamation-triangle text-warning"></i>
                                <div class="alert alert-danger">
                                    <?= nl2br(Html::encode($message)) ?>
                                </div>
                                <div>
                                    <a class="btn btn-primary" href="index">Back to Home</a>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


    <!--   <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p> -->
