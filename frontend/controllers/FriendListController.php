<?php

namespace frontend\controllers;

use Yii;
use \common\models\FriendList;
use app\models\FriendListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FriendListController implements the CRUD actions for FriendList model.
 */
class FriendListController extends Controller
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
     * Lists all FriendList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FriendListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FriendList model.
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
     * Creates a new FriendList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FriendList();

        if (Yii::$app->request->isPost) {
            $row = Yii::$app->request->post('FriendList');
            $id = $row['friend_id'];
            $val = FriendList::preinvites($id);
            if(count($val)<1)
            {
                $model->user_id = Yii::$app->user->id;
                $model->confirmation = 0;
                $model->friend_id = Yii::$app->request->post('FriendList')['friend_id'];
                $model->save();
                Yii::$app->session->setFlash('success', "Friend added to your list!");
                return $this->redirect(['friend-list/create']);
            }else
            {
                $model = FriendList::find()->where(['or','user_id'=>Yii::$app->user->id,'friend_id'=>Yii::$app->user->id])->andWhere(['or','user_id'=>Yii::$app->request->post('FriendList')['friend_id'],'friend_id'=>Yii::$app->request->post('FriendList')['friend_id']])->one();
                if($model->confirmation == 10)
                {
                    Yii::$app->session->setFlash('warning', "This user is already a friend.");
                    return $this->goHome();
                }
                else
                {
                    $model->confirmation = 10;
                    Yii::$app->session->setFlash('success', "Friend confirmed!");
                    return $this->goHome();
                }
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FriendList model.
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
     * Deletes an existing FriendList model.
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
     * Finds the FriendList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FriendList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FriendList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
