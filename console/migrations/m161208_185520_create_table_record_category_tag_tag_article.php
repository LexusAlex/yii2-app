<?php

use yii\db\Migration;

class m161208_185520_create_table_record_category_tag_tag_article extends Migration
{
    public function up()
    {
        // record
        $this->createTable('{{%record}}', [
            'id' => $this->primaryKey(),
            'category_id'=> $this->integer()->notNull(), //category
            'user_id'=> $this->integer()->notNull(), // user
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'preview' => 'MEDIUMTEXT NOT NULL',
            'content' => 'MEDIUMTEXT NOT NULL',
            'position' => $this->integer()->notNull(),
            'description' => $this->string()->notNull()->defaultValue(''), // человеко понятное описание для сео
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
        // category
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'parent_id' => $this->integer(), //category
        ]);
        // tag
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique(),
            'description' => $this->string(),
            'parent_id' => $this->integer(), // tag
            'frequency' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        // tag_article
        $this->createTable(
            '{{%tag_article}}',
            [
                'record_id' => $this->integer()->notNull(), //record
                'tag_id' => $this->integer()->notNull(), // tag
                //'PRIMARY KEY(record_id, tag_id)'
            ]
        );
        //pk tag_article
        $this->addPrimaryKey('', '{{%tag_article}}', ['record_id', 'tag_id']);
        // index record.category_id
        $this->createIndex('I_category_id_record', '{{%record}}', 'category_id');
        // fk record.category.id
        $this->addForeignKey('FK_category_id_record', //name foreignKey
            '{{%record}}', // table foreignKey
            'category_id', // column foreignKey
            '{{%category}}', // table ref
            'id', // column ref
            //RESTRICT === NO ACTION - error
            //CASCADE - cascade delete or update
            //SET DEFAULT - No InnoDb
            //SET NULL - NULL
            'CASCADE', //action DELETE
            'CASCADE' //action UPDATE
        );

        // index record.user_id
        $this->createIndex('I_user_id_record', '{{%record}}', 'user_id');
        // fk record.user_id
        $this->addForeignKey('FK_user_id_record', '{{%record}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // index category.parent_id
        $this->createIndex('I_parent_id_category', '{{%category}}', 'parent_id');
        // fk category.parent_id
        $this->addForeignKey('FK_parent_id_category', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'SET NULL', 'CASCADE');

        // index tag.parent_id
        $this->createIndex('I_parent_id_tag', '{{%tag}}', 'parent_id');
        // fk tag.parent_id
        $this->addForeignKey('FK_parent_id_tag', '{{%tag}}', 'parent_id', '{{%tag}}', 'id', 'SET NULL', 'CASCADE');

        // index tag_article.record_id
        $this->createIndex('I_record_id_tag_article', '{{%tag_article}}', 'record_id');
        // fk tag_article.record_id
        $this->addForeignKey('FK_record_id_tag_article', //name foreignKey
            '{{%tag_article}}', // table foreignKey текущая таблица
            'record_id', // column foreignKey
            '{{%record}}', // table ref
            'id', // column ref
            'CASCADE', //action DELETE
            'CASCADE' //action UPDATE
        );

        // index tag_article.tag_id
        $this->createIndex('I_tag_id_tag_article', '{{%tag_article}}', 'tag_id');
        // fk tag_article.tag_id
        $this->addForeignKey('FK_tag_id_tag_article', //name foreignKey
            '{{%tag_article}}', // table foreignKey текущая таблица
            'tag_id', // column foreignKey
            '{{%tag}}', // table ref
            'id', // column ref
            'CASCADE', //action DELETE
            'CASCADE' //action UPDATE
        );
        // базовые категории
        $this->batchInsert(
            'category',
            ['title'],
            [
                ['Программирование'],
                ['Администрирование'],
                ['Саморазвитие'],
            ]
        );
    }

    public function down()
    {
        $this->dropForeignKey('FK_tag_id_tag_article','{{%tag_article}}');
        $this->dropIndex('I_tag_id_tag_article','{{%tag_article}}');

        $this->dropForeignKey('FK_record_id_tag_article','{{%tag_article}}');
        $this->dropIndex('I_record_id_tag_article','{{%tag_article}}');

        $this->dropForeignKey('FK_parent_id_tag','{{%tag}}');
        $this->dropIndex('I_parent_id_tag','{{%tag}}');

        $this->dropForeignKey('FK_parent_id_category','{{%category}}');
        $this->dropIndex('I_parent_id_category','{{%category}}');

        $this->dropForeignKey('FK_user_id_record','{{%record}}');
        $this->dropIndex('I_user_id_record','{{%record}}');

        $this->dropForeignKey('FK_category_id_record','{{%record}}');
        $this->dropIndex('I_category_id_record','{{%record}}');

        $this->dropTable('{{%tag_article}}');
        $this->dropTable('{{%tag}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%record}}');

    }
}
