<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('criterias')->insert([
            'criteria' => 'Pengetahuan Umum',
            'description' => 'Pengetahuan Umum adalah pengetahuan yang dimiliki seseorang tentang berbagai hal yang terjadi di sekitar mereka. Ini mencakup informasi tentang sejarah, geografi, budaya, sains, dan banyak lagi.',
            'value' => 35,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('criterias')->insert([
            'criteria' => 'Test Praktik',
            'description' => 'Test Praktik adalah ujian yang dilakukan untuk menguji keterampilan praktis seseorang dalam bidang tertentu. Ini bisa mencakup ujian praktik di bidang teknik, seni, atau keterampilan lainnya.',
            'value' => 35,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('criterias')->insert([
            'criteria' => 'Wawancara',
            'description' => 'Wawancara adalah metode pengumpulan data yang melibatkan interaksi langsung antara pewawancara dan responden. Ini sering digunakan dalam penelitian sosial, psikologi, dan seleksi karyawan.',
            'value' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('criterias')->insert([
            'criteria' => 'Kepribadian',
            'description' => 'Kepribadian adalah pola perilaku, pikiran, dan emosi yang konsisten yang membedakan individu satu sama lain. Ini mencakup karakteristik seperti ekstroversi, introversi, keterbukaan terhadap pengalaman, dan banyak lagi.',
            'value' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('roles')->insert([
            'name' => 'super_admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'assessor',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'participant',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
