<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')->truncate();
		DB::table('users')->insert(array(
			0 => 
			array (
				'id' => 1,
				'email' => 'cassiusex@gmail.com',
				'password' => Hash::make('1234'),
				'permissions' => NULL,
				'activated' => 1,
				'activation_code' => NULL,
				'activated_at' => NULL,
				'last_login' => NULL,
				'persist_code' => NULL,
				'reset_password_code' => NULL,
				'first_name' => 'Kasian',
				'last_name' => 'Marszalek',
				'created_at' => '2014-09-23 11:53:37',
				'updated_at' => '2014-09-23 11:53:37',
			)
		));

		DB::table('groups')->truncate();
		DB::table('groups')->insert(array(
			0 => 
			array (
				'id' => 1,
				'name' => 'Administrator',
				'permissions' => '{"user.create":1,"user.delete":1,"user.view":1,"user.update":1,"article.create":1,"article.delete":1,"article.view":1,"article.update":1}',
				'created_at' => '2014-09-29 19:21:37',
				'updated_at' => '2014-09-29 19:21:37'
			)
		));

		DB::table('users_groups')->truncate();
		DB::table('users_groups')->insert(array(
			0 => 
			array (
				'user_id' => 1,
				'group_id' => 1
			)
		));
	}
}