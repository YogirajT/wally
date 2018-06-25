<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="row">
    <div class="blog-wrapper">
        <div class="cover"></div>
            <div class="blog-post">
              <h2 class="blog-post-title"><?=$model->posts->title?></h2>
              <p class="blog-post-meta">on <?=date("F j, Y",$model->posts->created_at)?>&nbsp;<a href="#">By static</a></p>
              <p><?=$model->posts->description?></p>
            </div>
            <?= HTML::a('Read more','view?id='.$model->id,['class'=>"readmore"])?>
    </div><!-- /.blog-post -->
</div>