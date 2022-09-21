<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\RegForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-registration">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to registration:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password_1')->passwordInput() ?>
        <?= $form->field($model, 'password_2')->passwordInput() ?>


        <div class="form-group">
            <div class="btn-form">
                <div class="offset-lg-1 col-lg-11">
                    <?= Html::a('Login', ['class' => 'btn btn-primary', '/site/login', 'name' => 'login-button']) ?>
                </div>

                <div class="offset-lg-1 col-lg-11">
                    <?= Html::submitButton('Registration', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
                </div>
            </div>
        </div>



    <?php ActiveForm::end(); ?>

    <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
