<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $priority
 * @property string|null $status
 * @property string|null $deadline
 * @property string|null $category
 * @property string|null $tags
 * @property int|null $is_urgent
 * @property int|null $is_important
 * @property int|null $is_recurring
 * @property string|null $reminder
 * @property int|null $assigned_to_me
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Task extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'deadline', 'category', 'tags'], 'default', 'value' => null],
            [['priority'], 'default', 'value' => 'medium'],
            [['status'], 'default', 'value' => 'pending'],
            [['is_recurring'], 'default', 'value' => 0],
            [['reminder'], 'default', 'value' => 'none'],
            [['assigned_to_me'], 'default', 'value' => 1],
            [['title'], 'required'],
            [['description'], 'string'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['is_urgent', 'is_important', 'is_recurring', 'assigned_to_me'], 'default', 'value' => null],
            [['is_urgent', 'is_important', 'is_recurring', 'assigned_to_me'], 'integer'],
            [['title', 'tags'], 'string', 'max' => 255],
            [['priority', 'status'], 'string', 'max' => 20],
            [['category', 'reminder'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'priority' => 'Priority',
            'status' => 'Status',
            'deadline' => 'Deadline',
            'category' => 'Category',
            'tags' => 'Tags',
            'is_urgent' => 'Is Urgent',
            'is_important' => 'Is Important',
            'is_recurring' => 'Is Recurring',
            'reminder' => 'Reminder',
            'assigned_to_me' => 'Assigned To Me',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
