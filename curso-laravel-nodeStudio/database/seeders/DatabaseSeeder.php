<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(){
        $this->call([
            UsersSeeder::class, //usado para carregar tudo ao usar o comando db:seed
            CategoriasSeeder::class,     // por usar apenas uma, não é preciso usar a estrutura de array
            ProdutosSeeder::class
        ]);
    }
}
