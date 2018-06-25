<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PostLikes */

$this->title = 'Create Post Likes';
$this->params['breadcrumbs'][] = ['label' => 'Post Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-likes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
