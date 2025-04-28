<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            'value' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
