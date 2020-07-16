<?php

use Illuminate\Database\Seeder;

class AssignRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::enableForeignKeyConstraints();
        DB::table('role_has_permissions')->insert([
                //for assign permissions to software-admin
                [
                    'permission_id'=> '1',
                    'role_id'=> '1'
                ],
                [
                    'permission_id'=> '2',
                    'role_id'=> '1'
                ],
                [
                    'permission_id'=> '2',
                    'role_id'=> '2'
                ]
            ]

        );
    }
}
