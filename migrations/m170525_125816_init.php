<?php

use yii\db\Migration;

/**
 * Класс m170525_125816_init
 *
 * @author  Марунин Алексей
 * @since   1.0
 */
class m170525_125816_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $now = time();

        // Таблица пользователей
        $this->createTable( '{{%users}}', [
            'id'              => $this->primaryKey( 11 ),
            'login'           => $this->string( 32 )->notNull(),
            'first_name'      => $this->string( 255 ),
            'middle_name'     => $this->string( 255 ),
            'last_name'       => $this->string( 255 ),
            'hashed_password' => $this->string( 60 )->notNull(),
            'auth_key'        => $this->string( 40 )->notNull(),
            'created_at'      => $this->integer( 11 ),
            'updated_at'      => $this->integer( 11 ),
        ] );

        $this->insert( '{{%users}}', [
            'login'           => 'admin',
            'first_name'      => 'Администратор',
            'hashed_password' => Yii::$app->getSecurity()->generatePasswordHash( 'admin' ),
            'auth_key'        => Yii::$app->getSecurity()->generateRandomString( 40 ),
            'created_at'      => $now,
            'updated_at'      => $now,
        ] );


        // Таблица статусов задач
        $this->createTable( '{{%statuses}}', [
            'id'    => $this->primaryKey( 11 ),
            'title' => $this->string( 255 ),
            'order' => $this->integer( 4 ),
        ] );

        $this->insert( '{{%statuses}}', [ 'title' => 'Новая задача', 'order' => 0 ] );
        $this->insert( '{{%statuses}}', [ 'title' => 'Анализ задачи', 'order' => 1 ] );
        $this->insert( '{{%statuses}}', [ 'title' => 'Задача в разработке', 'order' => 2 ] );
        $this->insert( '{{%statuses}}', [ 'title' => 'Задача отложена', 'order' => 3 ] );
        $this->insert( '{{%statuses}}', [ 'title' => 'Задача тестируется', 'order' => 4 ] );
        $this->insert( '{{%statuses}}', [ 'title' => 'Задача принята заказчиком', 'order' => 5 ] );
        $this->insert( '{{%statuses}}', [ 'title' => 'Задача закрыта', 'order' => 6 ] );


        // Таблица задач
        $this->createTable( '{{%tasks}}', [
            'id'         => $this->primaryKey( 11 ),
            'title'      => $this->string( 255 )->notNull(),
            'desc'       => $this->string( 4000 ),
            'due_date'   => $this->date(),
            'status_id'  => $this->date()->defaultValue( 1 ),
            'created_at' => $this->integer( 11 ),
            'updated_at' => $this->integer( 11 ),
            'created_by' => $this->integer( 11 ),
            'updated_by' => $this->integer( 11 ),
        ] );

        $this->insert( '{{%tasks}}', [
            'title'      => 'Тестовое задание',
            'desc'       => 'Сдать тестовое задание',
            'due_date'   => '2017-08-09',
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => 1,
            'updated_by' => 1,
        ] );
        $this->insert( '{{%tasks}}', [
            'title'      => 'День программиста',
            'desc'       => 'Поздравить всех коллег с днем программиста',
            'due_date'   => '2017-09-13',
            'created_at' => $now,
            'updated_at' => $now,
            'created_by' => 1,
            'updated_by' => 1,
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%tasks}}' );
        $this->dropTable( '{{%statuses}}' );
        $this->dropTable( '{{%users}}' );
    }

}
