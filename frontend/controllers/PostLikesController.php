<?php

namespace frontend\controllers;

use Yii;
use common\models\PostLikes;
use common\models\PostLikesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostLikesController implements the CRUD actions for PostLikes model.
 */
class PostLikesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PostLikes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostLikesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PostLikes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PostLikes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostLikes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDislike()
    {
        if(Yii::$app->request->isPost)
        {
            $id = Yii::$app->request->post('val');
            $model = PostLikes::find()->where(['post_id'=> $id])->andWhere(['user_id'=> Yii::$app->user->id])->one();
            if($model != null)
            {
                $model->status = 2;
                $model->save();
            }
            else
            {
                $lmodel = new PostLikes();
                $lmodel->post_id = $id;
                $lmodel->user_id = Yii::$app->user->id;
                $lmodel->status = 2;
                $lmodel->save();
            }
            return json_encode([PostLikes::likescount($id),PostLikes::dislikescount($id)]);
        }
    }

    public function actionLike()
    {
        if(Yii::$app->request->isPost)
        {
            $id = Yii::$app->request->post('val');
            $model = PostLikes::find()->where(['post_id'=> $id])->andWhere(['user_id'=> Yii::$app->user->id])->one();
            if($model != null)
            {
                $model->status = 1;
                $model->save();
            }
            else
            {
                $lmodel = new PostLikes();
                $lmodel->post_id = $id;
                $lmodel->user_id = Yii::$app->user->id;
                $lmodel->status = 1;
                $lmodel->save();
            }
            return json_encode([PostLikes::likescount($id),PostLikes::dislikescount($id)]);
        }  
    }

    /**
     * Updates an existing PostLikes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PostLikes model.
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
     * Finds the PostLikes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostLikes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostLikes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
