<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::insert([
            [
                'name' => 'Kursi',
                'stock' => '2',
                'unit' => 'pcs',
                'note' => 'Kursi sofa'
            ],
            [
                'name' => 'Meja Makan',
                'stock' => '22',
                'unit' => 'pcs',
                'note' => 'Meja makan 2m x 3x'
            ],
            [
                'name' => 'Lampu Belajar',
                'stock' => '12',
                'unit' => 'pcs',
                'note' => 'Lampu belajar 25 watt'
            ]
        ]);
    }
}
