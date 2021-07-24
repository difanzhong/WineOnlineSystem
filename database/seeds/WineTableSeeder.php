<?php

use Illuminate\Database\Seeder;
use App\Models\Wine;

class WineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wine::truncate();
        Wine::create([
            'name' => 'Bin 407',
            'grape' => 'Cabernet Sauvignon',
            'year' => 2017,
            'brand' => 'Penfolds',
            'cap' => 'wooden',
            'price' => 450.00,
            'stock_price' => 352.00,
            'size' => 750,
            'description' => 'The best tast for chinese people',
            'stock' => 600,
            'rewarded' => false,
        ]);
    }
}
