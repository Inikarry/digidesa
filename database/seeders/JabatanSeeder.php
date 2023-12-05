<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::truncate();
        $jabatan = [
            [
                'jabatan_nama'  => 'CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'SEKRETARIS CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'ANALISIS KESEJAHTERAAN RAKYAT'
            ],
            [
                'jabatan_nama'  => 'KASI KESEJAHTERAAN RAKYAT KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'KASI PEMERINTAHAN KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'KASI KETENTRAMAN DAN KETERTIBAN UMUM KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'KASI PEREKONOMIAN KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'PENGELOLA BAHAN PERENCANAAN'
            ],
            [
                'jabatan_nama'  => 'KASUBAG UMUM DAN KEPEGAWAIAN KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'ANALISIS KEAMANAN'
            ],
            [
                'jabatan_nama'  => 'KASI PEMBERDAYAAN MASYARAKAT DESA/KELURAHAN KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'KASUBAG PERENCAAN, PELAPORAN DAN KEUANGAN KANTOR CAMAT DONRI-DONRI'
            ],
            [
                'jabatan_nama'  => 'ANALISIS PEMBERDAYAAN MASYARAKAT'
            ],
            [
                'jabatan_nama'  => 'ANALISIS PEMERINTAHAN DAERAH'
            ],
        ];
        Jabatan::insert($jabatan);
    }
}
