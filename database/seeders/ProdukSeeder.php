<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = [
            [
                'nama_produk' => 'Kopi Ulee Kareng',
                'deskripsi' => 'Kopi Ulee Kareng adalah kopi khas Aceh yang terkenal dengan cita rasa yang kuat dan aroma yang khas. Kopi ini dihasilkan dari biji kopi Arabika yang ditanam di dataran tinggi Aceh, sehingga memiliki kualitas yang tinggi.',
                'harga' => 50000,
                'gambar' => 'kopi_ulee_kareng.jpg',
            ],
            [
                'nama_produk' => 'Kopi Gayo',
                'deskripsi' => 'Kopi Gayo adalah kopi Arabika yang berasal dari dataran tinggi Gayo, Aceh. Kopi ini memiliki cita rasa yang kompleks dengan aroma bunga dan buah-buahan, serta tingkat keasaman yang seimbang.',
                'harga' => 60000,
                'gambar' => 'kopi_gayo.jpg',
            ],
            [
                'nama_produk' => 'Kopi Lintong',
                'deskripsi' => 'Kopi Lintong adalah kopi Arabika yang berasal dari daerah Lintong Nihuta, Sumatera Utara. Kopi ini dikenal dengan cita rasa yang halus, aroma cokelat, dan sedikit rasa asam yang menyegarkan.',
                'harga' => 55000,
                'gambar' => 'kopi_lintong.jpg',
            ],
            [
                'nama_produk' => 'Kopi Brazil',
                'deskripsi' => 'Kopi Brazil adalah kopi Arabika yang berasal dari Brasil, negara penghasil kopi terbesar di dunia. Kopi ini dikenal dengan cita rasa yang khas, aroma yang kuat, dan tingkat keasaman yang rendah.',
                'harga' => 45000,
                'gambar' => 'kopi_brazil.jpg',
            ]
        ];

        foreach ($produk as $item) {
            \App\Models\Produk::create($item);
        }
    }
}
