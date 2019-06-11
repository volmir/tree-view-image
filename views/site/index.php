<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */


$this->title = 'Image tree view application';
?>
<div class="site-index">
<br>
<?php  


Modal::begin([
 'header' => '<h4>Image view form</h4>',
    'toggleButton' => [
        'label' => 'Open image dialog',
        'tag' => 'button',
        'class' => 'btn btn-success btn-lg',
    ],
 'footer' => '',
]);
?>
    
    <?php $form = ActiveForm::begin(['id' => 'image-form']); ?>

    <div class="recaptcha">
    <?= $form->field($model, 'verifyCode')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha::className(),
                ['siteKey' => Yii::$app->reCaptcha->siteKey]
            ) ?>    
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Get random image form Giphy API', ['class' => 'btn btn-primary send-button', 'name' => 'send-button']) ?>
    </div>
 
    <?php ActiveForm::end(); ?>

<?php Modal::end(); ?>

</div>

<?php
$this->registerJs("    
$('#image-form').submit(function( event ) {
    event.preventDefault();

    var response = grecaptcha.getResponse();
    if (response.length == 0) {
        ;
    } else {
        $.get('/site/get-random-image', function(data){
            var img = new Image();
            img.src = data;
            
            $('.recaptcha').html(img);
        });
    }
    
});
",
    View::POS_READY,
    'my-button-handler'
    );
    
?> 