<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        App\Category::create(['name' => 'Ingeniería de Sistemas', 'description' => null]);
        App\Category::create(['name' => 'Ciencia Política, Gobierno y Relaciones Internacionales', 'description' => null]);
        App\Category::create(['name' => 'Diseño de Modas', 'description' => null]);
        App\Category::create(['name' => 'Ingeniería Biomédica', 'description' => null]);
        App\Category::create(['name' => 'Ingeniería Industríal', 'description' => null]);
        App\Category::create(['name' => 'Odontología', 'description' => null]);
        App\Category::create(['name' => 'Fisioterapia', 'description' => null]);
        App\Category::create(['name' => 'Diseño Industríal', 'description' => null]);
        App\Category::create(['name' => 'Ingeniería Electrónica', 'description' => null]);
        App\Category::create(['name' => 'Negocios Internacionales', 'description' => null]);
        App\Category::create(['name' => 'Economía', 'description' => null]);
        App\Category::create(['name' => 'Administración de Empresas', 'description' => null]);
        App\Category::create(['name' => 'Artes Culinarias y Gastronomía', 'description' => null]);
        App\Category::create(['name' => 'Ingeniería Mecánica', 'description' => null]);
    }
}
