<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = new User();
        $admin->name="admin";
        $admin->email="admin@gmail.com";
        $admin->password=bcrypt('password');
        $admin->visible_password="password";
        $admin->email_verified_at = NOW();
        $admin->occupation="CEO";
        $admin->address="Turkiye";
        $admin->phone="05555555555";
        $admin->is_admin=1;
        $admin->save();

    }
}
