<?php

   namespace Database\Factories;

   use Illuminate\Database\Eloquent\Factories\Factory;
   use Illuminate\Support\Str;

   class UserFactory extends Factory
   {
       protected $model = \App\Models\User::class;

       public function definition()
       {
           return [
               'name' => $this->faker->name(),
               'email' => $this->faker->unique()->safeEmail(),
               'password' => bcrypt('password'), // Password default
               'nim' => $this->faker->unique()->numerify('##########'), // 10 digit angka acak
               'role' => $this->faker->randomElement(['mahasiswa', 'dosen', 'admin']),
           ];
       }
   }