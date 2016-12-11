<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TagArticle]].
 *
 * @see TagArticle
 */
class TagArticleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagArticle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagArticle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
