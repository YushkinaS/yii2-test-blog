<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Comments".
 *
 * @property integer $comment_id
 * @property integer $comment_post_id
 * @property string $comment_author
 * @property string $comment_content
 */
 
class Comments extends ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            $this->comment_content = $_POST['Comments']['comment_content'];
            if (empty($this->comment_content)) return false;
            
            if ($this->isNewRecord) 
            {
                $this->comment_post_id = $_POST['Comments']['post_id'];
                $author = Yii::$app->user->identity->id;
                $this->comment_author = empty($author) ? 0 : $author;
                //$this->date_created = date("Y-m-d H:i:s");     
            }
            else 
            {
                //$this->date_modified = date("Y-m-d H:i:s");  
            }
     
            return true;
        }
        return false;
    }
    
}