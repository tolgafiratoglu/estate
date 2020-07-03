<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserRepository $userRepository)
    {
        
        $password = bcrypt('admin');
        $userRepository->create(['username'=>'admin', 'password'=>$password, 'email'=>'admin@yourdomain.com', 'email_verified_at'=>date('Y-m-d H:i:s'), 'is_admin'=> true, 'is_super_admin' => true]);

    }
}
