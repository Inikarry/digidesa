<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DaftarDesa;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DaftarDesa::truncate();
        $desa = [
            [
                'nama_desa' => 'PESSE'
            ],
            [
                'nama_desa' => 'PISING'
            ],
            [
                'nama_desa' => 'DONRI-DONRI'
            ],
            [
                'nama_desa' => 'SERING'
            ],
            [
                'nama_desa' => 'LABOKONG'
            ],
            [
                'nama_desa' => 'LALABATA RIAJA'
            ],
            [
                'nama_desa' => 'TOTTONG'
            ],
            [
                'nama_desa' => 'LEWORENG'
            ],
            [
                'nama_desa' => 'KESSING'
            ],
        ];
        DaftarDesa::insert($desa);
    }
}
