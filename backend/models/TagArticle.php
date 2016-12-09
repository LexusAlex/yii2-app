<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tag_article".
 *
 * @property integer $record_id
 * @property integer $tag_id
 *
 * @property Tag $tag
 * @property Record $record
 */
class TagArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['record_id', 'tag_id'], 'required'],
            [['record_id', 'tag_id'], 'integer'],
            //[['record_id', 'tag_id'], 'unique'],
            [ ['record_id', 'tag_id'], 'unique', 'targetAttribute' => ['record_id', 'tag_id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => Record::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'record_id' => Yii::t('app', 'Record ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id'])->inverseOf('tagArticles');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(Record::className(), ['id' => 'record_id'])->inverseOf('tagArticles');
    }

    /**
     * @inheritdoc
     * @return TagArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagArticleQuery(get_called_class());
    }
}
