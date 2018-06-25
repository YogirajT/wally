<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use app\models\enums\DirectoryTypes;
use \common\models\FriendList;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->user->username."'s Profile";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="user-profile-view">


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

    </div>
</div>

</div>