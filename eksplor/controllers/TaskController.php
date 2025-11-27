<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                        'bulk-delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Ambil semua tasks
        $tasks = Task::find()->orderBy(['created_at' => SORT_DESC])->all();
        
        // Hitung statistik
        $totalTasks = Task::find()->count();
        $pendingTasks = Task::find()->where(['status' => 'pending'])->count();
        $completedTasks = Task::find()->where(['status' => 'completed'])->count();
        $highPriorityTasks = Task::find()->where(['priority' => 'high'])->count();
        
        return $this->render('index', [
            'tasks' => $tasks,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $pendingTasks,
            'completedTasks' => $completedTasks,
            'highPriorityTasks' => $highPriorityTasks,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Task created successfully!');
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Task updated successfully!');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Task deleted successfully!');

        return $this->redirect(['index']);
    }

    /**
     * Bulk delete multiple tasks
     * @return array
     */
    public function actionBulkDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $ids = Yii::$app->request->post('ids', []);

        if (empty($ids)) {
            return [
                'success' => false,
                'message' => 'No tasks selected'
            ];
        }

        $deletedCount = Task::deleteAll(['id' => $ids]);

        Yii::$app->session->setFlash('success', "$deletedCount task(s) deleted successfully!");

        return [
            'success' => true,
            'message' => "$deletedCount task(s) deleted successfully!",
            'count' => $deletedCount
        ];
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}