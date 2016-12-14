<?php

namespace backend\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use common\models\User;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "record".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property string $preview
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Category $category
 * @property TagArticle[] $tagArticles
 * @property array $tagsArray
 */
class Record extends \yii\db\ActiveRecord
{
    /** Inactive status */
    const STATUS_INACTIVE = 0;

    /** Active status */
    const STATUS_ACTIVE = 10;

    /** Deleted status */
    const STATUS_DELETED = 20;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'record';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                //'value' => function() { return date('U');},
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'slug', 'preview', 'content'], 'required'],
            [['category_id', 'user_id', 'status'], 'integer'],
            [['preview', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['tagsArray'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatuses())],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'preview' => Yii::t('app', 'Preview'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'tagsArray' => Yii::t('app', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('records');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->inverseOf('records');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagArticles()
    {
        //return $this->hasMany(TagArticle::className(), ['record_id' => 'id'])->inverseOf('record');
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('tag_article', ['record_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RecordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecordQuery(get_called_class());
    }

    /**
     * @return string label for current status статус текущей записи
     */
    public function getStatusLabel()
    {
        return ArrayHelper::getValue(static::getStatuses(), $this->status);
    }

    /**
     * @return array status labels indexed by status values
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_INACTIVE => "<span class='label label-default'>".Yii::t('app', 'Inactive')."</span>",
            self::STATUS_ACTIVE => "<span class='label label-success'>".Yii::t('app', 'Active')."</span>",
            self::STATUS_DELETED => "<span class='label label-danger'>".Yii::t('app', 'Deleted')."</span>",
        ];
    }
    /**
     * @return array status labels indexed by status values text
     */
    public static function getStatusesText()
    {
        return [
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_DELETED => Yii::t('app', 'Deleted'),
        ];
    }
    // Tags
    private $_tagsArray;

    public function getTagsArray()
    {
        if ($this->_tagsArray === null) {
            $this->_tagsArray = $this->getTagArticles()->select('id')->column();
        }
        return $this->_tagsArray;
    }

    public function setTagsArray($value)
    {
        $this->_tagsArray = (array)$value;
    }
    // После сохранения модели
    public function afterSave($insert, $changedAttributes)
    {
        $this->updateTags(); // обновление тегов у записей
        parent::afterSave($insert, $changedAttributes);
    }

    private function updateTags()
    {
        $currentTagIds = $this->getTagArticles()->select('id')->column(); // теги которые имеются у записи
        $newTagIds = $this->getTagsArray(); // отмеченные новые теги в форме или убранные
        // добавляем связи
        foreach (array_filter(array_diff($newTagIds, $currentTagIds)) as $tagId) {
            /** @var Tag $tag */
            if ($tag = Tag::findOne($tagId)) {
                $tag->updateCounters(['frequency' => 1]);
                $this->link('tagArticles', $tag);
            }
        }
        // удаляем связи
        foreach (array_filter(array_diff($currentTagIds, $newTagIds)) as $tagId) {
            /** @var Tag $tag */
            if ($tag = Tag::findOne($tagId)) {
                $tag->updateCounters(['frequency' => -1]);
                $this->unlink('tagArticles', $tag, true);
            }
        }
    }
}
