<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $parent_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $frequency
 *
 * @property Tag $parent
 * @property Tag[] $tags
 * @property TagArticle[] $tagArticles
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                //'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id','frequency'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['description'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'frequency' => Yii::t('app', 'Frequency'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Tag::className(), ['id' => 'parent_id'])->inverseOf('tags');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['parent_id' => 'id'])->inverseOf('parent');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagArticles()
    {
        //return $this->hasMany(TagArticle::className(), ['tag_id' => 'id'])->inverseOf('tag');
        return $this->hasMany(Record::className(), ['id' => 'record_id'])->viaTable('tag_article', ['tag_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
