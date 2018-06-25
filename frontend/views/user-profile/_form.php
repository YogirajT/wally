<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\enums\DirectoryTypes;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin([
        'class' => 'pform'
    ]); ?>

    <div class="col-sm-3">
        <img
            src="<?php echo ($model->profile_pic != null) ? DirectoryTypes::getUserDirectory(true) . $model->profilePic->file_name : Url::to('@web/images/profile_pic.png', true); ?> "
            class="profile-photo image responsive" id="profile-photo" width="100" height="100"
            alt="Profile Image"  onclick="document.getElementById('user-media_id').click()"/>
        <?= $form->field($model, 'profile_pic')->fileInput()->label(false); ?>
    </div>

    <div class="col-sm-6">

        <div class="form-group">

        <?= $form->field($model, 'personal_details')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'interests')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>


            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJs("

$(document).ready(function(){

    $('#user-media_id').innerHTML = '';

    $('#user-media_id').change(function(){
        readURL(this);
    });

    $('#user-media_id').hide();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                    $('#profile-photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

});



");?>
