<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $author
 * @property string $title
 * @property string $excerpt
 * @property string $content
 * @property string $status
 * @property string $date_created
 * @property string $date_modified
 * @property string $slug
 *
 * @property Comments[] $comments
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['author', 'title', 'excerpt', 'content', 'status', 'date_created', 'date_modified', 'slug'], 'required'],
            [['title', 'excerpt', 'content'], 'string'],
            //[['date_created', 'date_modified'], 'safe'],
            //[['author', 'status'], 'string', 'max' => 20],
            [['slug'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'content' => 'Content',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['comment_post_id' => 'id']);
    }
    
    public function newComment()
    {
        return new Comments();
    }
    
    public function setStatus($status)
    {
        if (!empty($status)) $this->status = $status;
        return true;
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            $slug = $this->slug;
            $counter = 1;
            while (Posts::findOne(['slug' =>$this->slug])) {
                $this->slug = $slug.'-'.$counter;
                $counter += 1;
            }
            
     
            if ($this->isNewRecord) 
            {
                $this->author = Yii::$app->user->identity->id;
                $this->status = 'draft';
                $this->date_created = date("Y-m-d H:i:s");     
            }
            else 
            {
                $this->date_modified = date("Y-m-d H:i:s");  
            }
     
            return true;
        }
        return false;
    }

}
