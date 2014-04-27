<?php
class WDB {

    public static function CreateTables() {

        if( !Schema::hasTable('users') ) {

            Schema::create('users', function($table) {
                // $table->increments('id');
                // $table->bigInteger('id')->unsigned()->primary();
                $table->bigIncrements('id')->unsigned()->index();
                $table->string('provider', 20);
                $table->integer('provider_uid')->unsigned()->index();
                $table->string('name', 50);
                $table->string('surname', 50);
                $table->string('username', 50);
                $table->string('email', 50);
                $table->tinyInteger('approved')->unsigned()->index();
                $table->string('gender', 10);
                $table->string('location', 30);
                $table->string('birthday', 30);
                $table->string('provider_picture', 300);
                $table->string('picture', 300);
                $table->string('token', 30);
                $table->text('access_token');
                $table->dateTime('date');
                $table->dateTime('last_entry');
                $table->string('description', 300);

                $table->engine = 'MyISAM';
            });

        }


        if( !Schema::hasTable('items') ) {

            Schema::create('items', function($table) {
                $table->bigIncrements('id')->unsigned()->index();
                $table->string('name', 30);
                $table->integer('type')->unsigned()->index();
                $table->string('units', 30);
                $table->integer('calori')->unsigned()->index();
                $table->integer('carbon')->unsigned()->index();

                $table->engine = 'MyISAM';
            });

        }


        if( !Schema::hasTable('wasted') ) {

            Schema::create('wasted', function($table) {
                $table->bigIncrements('id')->unsigned()->index();
                $table->integer('user_id')->unsigned()->index();
                $table->integer('item_id')->unsigned()->index();
                // $table->string('unit', 10);
                $table->decimal('cost', 5, 2);
                $table->date('date');
                $table->dateTime('date_time');

                $table->engine = 'MyISAM';
            });

        }

        
        if( !Schema::hasTable('friends') ) {

            Schema::create('friends', function($table) {
                $table->bigIncrements('id')->unsigned()->index();
                $table->integer('user_id')->unsigned()->index();
                $table->integer('friend_id')->unsigned()->index();
                $table->integer('provider_user_uid')->unsigned()->index();
                $table->integer('provider_friend_uid')->unsigned()->index();
                $table->dateTime('date');

                $table->engine = 'MyISAM';
            });

        }


    }

}