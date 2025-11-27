<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string|null $title
 * @property string $content
 * @property string $note_date
 * @property string|null $mood
 * @property string|null $tags
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'note_date'], 'required'],
            [['content'], 'string'],
            [['note_date', 'created_at', 'updated_at'], 'safe'],
            [['title', 'tags'], 'string', 'max' => 255],
            [['mood'], 'string', 'max' => 50],
            [['mood'], 'in', 'range' => ['very-happy', 'happy', 'neutral', 'sad', 'stressed', 'excited', 'tired']],
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
            'content' => 'Content',
            'note_date' => 'Date',
            'mood' => 'Mood',
            'tags' => 'Tags',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Get mood emoji
     * @return string
     */
    public function getMoodEmoji()
    {
        $emojis = [
            'very-happy' => '😄',
            'happy' => '😊',
            'neutral' => '😐',
            'sad' => '😢',
            'stressed' => '😫',
            'excited' => '🤩',
            'tired' => '😴',
        ];
        return $emojis[$this->mood] ?? '😐';
    }

    /**
     * Get mood badge class
     * @return string
     */
    public function getMoodBadge()
    {
        $badges = [
            'very-happy' => 'bg-light-success',
            'happy' => 'bg-light-success',
            'neutral' => 'bg-light-warning',
            'sad' => 'bg-light-secondary',
            'stressed' => 'bg-light-danger',
            'excited' => 'bg-light-info',
            'tired' => 'bg-light-secondary',
        ];
        return $badges[$this->mood] ?? 'bg-light-secondary';
    }

    /**
     * Get mood text
     * @return string
     */
    public function getMoodText()
    {
        $moods = [
            'very-happy' => 'Sangat Senang',
            'happy' => 'Senang',
            'neutral' => 'Biasa Aja',
            'sad' => 'Sedih',
            'stressed' => 'Stress',
            'excited' => 'Excited',
            'tired' => 'Capek',
        ];
        return $moods[$this->mood] ?? 'Biasa Aja';
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
     * Get formatted date
     * @return string
     */
    public function getFormattedDate()
    {
        if (!$this->note_date) {
            return '-';
        }
        return date('d M Y', strtotime($this->note_date));
    }

    /**
     * Get content preview (first 150 chars)
     * @return string
     */
    public function getContentPreview()
    {
        if (strlen($this->content) <= 150) {
            return $this->content;
        }
        return substr($this->content, 0, 150) . '...';
    }
}