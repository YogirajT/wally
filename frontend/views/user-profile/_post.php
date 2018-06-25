<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use \common\models\PostLikes;
?>

<div class="row">
    <div class="blog-wrapper">
        <div class="cover"></div>
            <div class="blog-post">
                <h2 class="blog-post-title"><?=$model->title?></h2>
                <p class="blog-post-meta">on <?=date("F j, Y",$model->created_at)?>&nbsp;<a href="#">By <?=$model->user->username?></a></p>
                <p><?=$model->description?></p>
                <button class="social-like">
                  <span class="like"><i class="glyphicon glyphicon-thumbs-up"></i></span>
                  <span class="count"><?=PostLikes::likescount($model->id) ?></span>
                  <h1 style="display:none"><?=$model->id ?></h1>
                </button>
                &nbsp;
                <button class="social-dislike">
                  <span class="dislike"><?=PostLikes::dislikescount($model->id)?></span>
                  <span class="like"><i class="glyphicon glyphicon-thumbs-down"></i></span>
                  <h1 style="display:none"><?=$model->id ?></h1>
                </button>
                <div style="margin-top:10px"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?=$model->id?>">Add comment</button></div>
            </div>
            <div>
            Comments:
            <?php
            foreach($model->comments as $v)
            {?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>By: <?=$v->user->username  ?></p>
                    <p><?=$v->description ?></p>
                    <p>On : <?=date('D M Y',$v->created_at) ?></p>
                </div>
            </div>
            <?php 
            }?>
            </div>
    </div><!-- /.blog-post -->
</div>

<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="myModal<?=$model->id?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add comment</h4>
      </div>
      <div class="modal-body">
        <?=HTML::beginForm(Url::to(['comments/create']),'post',['class'=>'cform'.$model->id])?>
        <?=HTML::hiddenInput('user_id',Yii::$app->user->id) ?>
        <?=HTML::hiddenInput('post_id',$model->id)?>
        <p><?=HTML::textInput('title')?></p>
        <p><?=HTML::textArea('description')?></p>
        <p><?=HTML::submitButton('Submit',['class'=>'sbutton'])?></p>
        <?=HTML::endForm()?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php $this->registerJs("

  $('.social-like').click(function() {
    val = $(this).find('h1').html();
    $.ajax({
      type: 'POST',
      url: '". Yii::$app->urlManager->createAbsoluteUrl('post-likes/like') ."',
      data: {
          val: val
      }, context: this, success: function(result) {
        result = JSON.parse(result);
        $(this).find('.count').html(result[0]);
      }, error: function(result) {
        alert('fail');
      }
    });
  });

  $('.social-dislike').click(function() {
    val = $(this).find('h1').html();
    $.ajax({
      type: 'POST',
      url: '". Yii::$app->urlManager->createAbsoluteUrl('post-likes/dislike') ."',
      data: {
          val: val
      }, context: this, success: function(result) {
        result = JSON.parse(result);
        $(this).find('.dislike').html(result[1]);
      }, error: function(result) {
        alert('fail');
      }
    });
  });

");

?>