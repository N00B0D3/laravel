<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Produto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    protected $model = Produto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = $this->faker->unique()->sentence();
        return [
            'nome' => $nome,
            'descricao' =>$this->faker->paragraph(),
            'valor' => $this->faker->randomNumber(2),
            'slug' => Str::slug($nome), //cria uma url amigavel baseada no parametro passado
            'quantidade' => $this->faker->randomNumber(2),
            'imagem' =>$this->faker->imageUrl(400, 400),
            'id_user' => User::pluck('id')->random(),
            'id_categoria' =>Categoria::pluck('id')->random(),
        ];
    }
}
