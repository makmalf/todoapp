<?php

use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10; $i++) {
            DB::table('tasks')->insert([
                'user_id' => 1,
                'title' => 'Task '.$i,
                'content' => 'Getting task '.$i.' done ',
                'is_completed' => 0,
                'created_at' => date('y/m/d'),
            ]);           
        }
    }
}
