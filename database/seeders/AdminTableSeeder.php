<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin ;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Miso',
            'email'=>'miso@gmail.com',
            'password'=>Hash::make('password'),
            'super_admin'=>1,
            'status'=>'active' ,
        ]) ;
    }
}
