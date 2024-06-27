<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            [
                'nama_barang' => 'Laptop Asus'
            ],
            [
                'nama_barang' => 'Laptop Acer'
            ],
            [
                'nama_barang' => 'Laptop Macbook'
            ],
            [
                'nama_barang' => 'Mouse Gaming'
            ],
            [
                'nama_barang' => 'Keyboard Mekanik'
            ],
            [
                'nama_barang' => 'Kopi Expresso'
            ],
            [
                'nama_barang' => 'Indomie Ayam Bawang'
            ],
            [
                'nama_barang' => 'Darul'
            ],
        ];

        Barang::insert($barang);
    }
}
