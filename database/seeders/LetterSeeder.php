<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Letter;

   class LetterSeeder extends Seeder
   {
       public function run()
       {
           Letter::create([
               'letter_number' => 'sk/2024/001',
               'nim' => 'XXXXXX',
               'letter_type' => 'Keterangan Beasiswa',
               'submission_date' => '2025-05-20',
               'completion_date' => '2025-05-22',
               'file_link' => null,
               'status' => 'Selesai',
           ]);

           // Tambahkan data lain jika perlu
           Letter::create([
               'letter_number' => 'sk/2024/002',
               'nim' => 'XXXXXX',
               'letter_type' => 'Rekomendasi Dosen',
               'submission_date' => '2025-05-20',
               'completion_date' => null,
               'file_link' => null,
               'status' => 'Proses',
           ]);
       }
   }