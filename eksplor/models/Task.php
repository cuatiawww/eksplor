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
            [['title'], 'required'],
            [['description'], 'string'],
            [['deadline', 'created_at', 'updated_at'], 'safe'],
            [['is_urgent', 'is_important', 'is_recurring', 'assigned_to_me'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['priority'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 20],
            [['category', 'reminder'], 'string', 'max' => 50],
            [['tags'], 'string', 'max' => 255],
            [['priority'], 'in', 'range' => ['low', 'medium', 'high']],
            [['status'], 'in', 'range' => ['pending', 'in_progress', 'completed']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Task Title',
            'description' => 'Description',
            'priority' => 'Priority',
            'status' => 'Status',
            'deadline' => 'Deadline',
            'category' => 'Category',
            'tags' => 'Tags',
            'is_urgent' => 'Urgent',
            'is_important' => 'Important',
            'is_recurring' => 'Recurring',
            'reminder' => 'Reminder',
            'assigned_to_me' => 'Assigned to Me',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Get badge class for priority
     * @return string
     */
    public function getPriorityBadge()
    {
        $badges = [
            'high' => 'bg-light-danger',
            'medium' => 'bg-light-warning',
            'low' => 'bg-light-secondary',
        ];
        return $badges[$this->priority] ?? 'bg-light-secondary';
    }

    /**
     * Get badge class for status
     * @return string
     */
    public function getStatusBadge()
    {
        $badges = [
            'completed' => 'bg-light-success',
            'in_progress' => 'bg-light-warning',
            'pending' => 'bg-light-secondary',
        ];
        return $badges[$this->status] ?? 'bg-light-secondary';
    }

    /**
     * Get badge class for category
     * @return string
     */
    public function getCategoryBadge()
    {
        $badges = [
            'work' => 'bg-light-primary',
            'personal' => 'bg-light-success',
            'study' => 'bg-light-info',
            'shopping' => 'bg-light-warning',
            'health' => 'bg-light-danger',
            'others' => 'bg-light-secondary',
        ];
        return $badges[$this->category] ?? 'bg-light-secondary';
    }

    /**
     * Get formatted deadline text
     * @return string
     */
    public function getFormattedDeadline()
    {
        if (!$this->deadline) {
            return 'No deadline';
        }
        
        $deadline = strtotime($this->deadline);
        $today = strtotime('today');
        $tomorrow = strtotime('tomorrow');
        
        if (date('Y-m-d', $deadline) == date('Y-m-d', $today)) {
            return 'Today';
        } elseif (date('Y-m-d', $deadline) == date('Y-m-d', $tomorrow)) {
            return 'Tomorrow';
        } else {
            return date('M d', $deadline);
        }
    }

    /**
     * Get priority text with proper case
     * @return string
     */
    public function getPriorityText()
    {
        return ucfirst($this->priority ?? 'medium');
    }

    /**
     * Get status text with proper case
     * @return string
     */
    public function getStatusText()
    {
        return str_replace('_', ' ', ucfirst($this->status ?? 'pending'));
    }

    /**
     * Get category text with proper case
     * @return string
     */
    public function getCategoryText()
    {
        return ucfirst($this->category ?? 'others');
    }

    /**
     * Get tags as array
     * @return array
     */
    public function getTagsArray()
    {
        if (empty($this->tags)) {
            return [];
        }
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Get reminder text with proper formatting
     * @return string
     */
    public function getReminderText()
    {
        $reminders = [
            'none' => 'No Reminder',
            '1_day' => '1 Day Before',
            '1_hour' => '1 Hour Before',
        ];
        return $reminders[$this->reminder] ?? 'No Reminder';
    }
}