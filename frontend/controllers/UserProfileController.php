<?php

namespace frontend\controllers;

use Yii;
use app\models\enums\PictureTypes;
use common\models\UserProfile;
use common\models\Comments;
use common\models\Posts;
use common\models\FriendList;
use common\models\UserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\LogoUploader;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\data\ActivedataProvider;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view','index'],
                'rules' => [
                    [
                        'actions' => ['view','index','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $model = UserProfile::find()->where(['user_id'=>$id])->one();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {

        $model = UserProfile::find()->where(['user_id'=>\Yii::$app->user->identity->id])->one();

        if(count($model)>0){
            $pmodel = new Posts;

            $cmodel = new Comments;

            $dataProvider = new ActiveDataProvider([
                'query' => Posts::find()->joinWith('user')->where(['user.id'=>\Yii::$app->user->id])->orWhere(['user.id'=>FriendList::getUserFriends()[1]]),
                'pagination' => [
                    'pageSize' => 2,
                ],
                'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
            ]);

            //print_r($model);exit;
            return $this->render('view', [
                'model' => $model,
                'pmodel' => $pmodel,
                'dataProvider' => $dataProvider,
                'cmodel'=>$cmodel
            ]);
        }
        return $this->redirect(['site/index']);
    }



    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_media = $model->profile_pic;

        if ($model->load(Yii::$app->request->post())) {

            $media = UploadedFile::getInstance($model, 'profile_pic');
            if ($media != null && !$media->getHasError()) {
                $media_id = LogoUploader::LogoUpload($media, PictureTypes::PROFILE_PICURE, $type = $model->user->role);
            }

            if (isset($media_id)) {
                $model->profile_pic = $media_id;
            }

            else{
                $model->profile_pic = $old_media;
            }
            
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
