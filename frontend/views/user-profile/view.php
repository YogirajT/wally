<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\enums\DirectoryTypes;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use \common\models\FriendList;
use \common\models\PostLikes;
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = $model->user->username;
?>
<div class="user-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>


    <div class="main-box-body">
        <div class="form-group row">
            <div class="col-sm-3">

                <img src="<?php echo ($model->profile_pic != null) ? DirectoryTypes::getUserDirectory() . $model->profilePic->file_name : Url::to('@web/images/profile_pic.png', true); ?> "
                    class="profile-photo image responsive" id="profile-photo" width="100" height="100"
                    alt="Profile Image" />

            </div>
            <div class="col-sm-3">
                <div>
                <label class="control-label">Email:</label>
                <?= $model->user->email ?>
                </div>
                <div>
                <label class="control-label">Contact no:</label>
                <?= $model->contact ?>
                </div>
                <div>
                <label class="control-label">Interests:</label>
                <?= $model->interests ?>
                </div>
            </div>
            <div class="col-sm-3 col-sm-offset-3">
            <label class="control-label">Friend List:</label>
            <?php foreach(FriendList::getUserFriends()[0] as $m){ ?>
                <div>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['user-profile/index', 'id' => $m->user->id]) ?>">
                <img src="<?php echo ($m->profile_pic != null) ? DirectoryTypes::getUserDirectory() . $m->profilePic->file_name : Url::to('@web/images/profile_pic.png', true); ?> "
                    class="profile-photo image responsive" id="profile-photo" width="50" height="50"
                    alt="Profile Image" />
                <?=$m->user->username ?>
                </a>
                </div>
            <?php
            }
            ?>
            </div>

        </div>
    </div>

</div>

<div class="container">

    <h1>NewPost</h1>

    <?=Yii::$app->controller->renderPartial('/posts/_form', ['model'=> $pmodel]) ?>

    <div class="row">
        <div class="col-sm-8 blog-main">
            <?=ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'itemView' => '_post',
            ]);
            ?>
        </div>
    </div>

</div>



<?php $this->registerJs("
    $('.pform').on('beforeSubmit', function(e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
                alert('Post created!');
            },
            error: function () {
                alert('Something went wrong');
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
    });

");

?>