<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * SettingController handles application settings
 */
class SettingController extends Controller
{
    /**
     * Displays settings page
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays profile information
     * @return string
     */
    public function actionProfile()
    {
        return $this->render('profile');
    }

    /**
     * Displays application information
     * @return string
     */
    public function actionInfo()
    {
        // Get app info
        $appInfo = [
            'name' => 'Ruang Yosua',
            'version' => '1.0.0',
            'description' => 'Personal Task Manager & Daily Journal',
            'author' => 'Yosua',
            'yii_version' => Yii::getVersion(),
            'php_version' => PHP_VERSION,
            'database' => 'PostgreSQL',
        ];

        // Get database stats
        $totalTasks = \app\models\Task::find()->count();
        $totalNotes = \app\models\Note::find()->count();
        $completedTasks = \app\models\Task::find()->where(['status' => 'completed'])->count();
        $pendingTasks = \app\models\Task::find()->where(['status' => 'pending'])->count();

        return $this->render('info', [
            'appInfo' => $appInfo,
            'totalTasks' => $totalTasks,
            'totalNotes' => $totalNotes,
            'completedTasks' => $completedTasks,
            'pendingTasks' => $pendingTasks,
        ]);
    }

    /**
     * Displays database information
     * @return string
     */
    public function actionDatabase()
    {
        // Get table info
        $db = Yii::$app->db;
        
        $taskCount = \app\models\Task::find()->count();
        $noteCount = \app\models\Note::find()->count();
        
        return $this->render('database', [
            'taskCount' => $taskCount,
            'noteCount' => $noteCount,
            'dbName' => $db->dsn,
        ]);
    }
}