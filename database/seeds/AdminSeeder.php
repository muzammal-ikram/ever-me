<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email', 'admin@gmail.com')->first();

        if($user){
            $has_role = DB::table('model_has_roles')->where('model_id', $user->id)
                ->where('role_id', 1)->first();

            if($has_role){
                $this->command->info('Admin User Already exists');
            }else{
                DB::table('model_has_roles')->insert(
                    [
                        'role_id' => '1',
                        'model_type' => 'App\User',
                        'model_id'=>'1'
                    ]
                );
                $this->command->info('Assign Admin Role to User');
            }

        }else{
            $user =  DB::table('users')->insert(
                [
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('password'),
                    'status' => 1,
                    'email_verified_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            $user =  DB::table('users')->where('email', 'admin@gmail.com')->first();
            if($user){
                DB::table('model_has_roles')->insert(
                    [
                        'role_id' => '1',
                        'model_type' => 'App\User',
                        'model_id'=>$user->id
                    ]

                );
            }
        }
    }
}
