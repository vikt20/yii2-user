<?php

/*
 * extended page for dektrium/user
 * this is security page
 * allow user to enable OTP, IP lock and define user access IP
 * 
 */

use yii\helpers\Html;
use dektrium\user\helpers\Timezone;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\switchinput\SwitchBox;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SecurityForm $model
 */

$this->title = Yii::t('user', 'Security settings');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row m-0">
        <?= $this->render('_menu_custom') ?>
                <?php $form = ActiveForm::begin([
                    'id' => 'security-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-8 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>

                <?= $form->field($model, 'otp_login_enable')->widget(SwitchBox::className(),[
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'size' => 'small',
                        'onColor' => 'success',
                        'offColor' => 'danger'
                    ]
                ]);?>

                <?= $form->field($model, 'ip_lock')->widget(SwitchBox::className(),[
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'size' => 'small',
                        'onColor' => 'success',
                        'offColor' => 'danger'
                    ]
                ]);?>

                <?= $form->field($model, 'ip_access'); ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
                        <br>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>