<?php

class EntriesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run() {
		DB::table('entries')->truncate();
		DB::table('entries')->insert(array(
			0 => 
			array (
				'id' => 1,
				'date' => '2014-09-29',
				'start' => '12:24',
				'end' => '15:41',
				'hours' => '1h 52min',
				'moment' => 'Vouper frontend',
				'work_description' => '{"1":"Hej","2":"på", "3":"dig!"}',
				'created_at' => '2014-09-23 11:53:37',
				'updated_at' => '2014-09-23 11:53:37',
			)
		));
	}
}