<?php

namespace Database\Seeders;

use App\Models\Prodi;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::truncate();
        $prodi = [
            [
                'fakultas_id' => '1',
                'prodi_name' => 'Ilmu Sejarah',
            ], [
                'fakultas_id' => '1',
                'prodi_name' => 'Sastra Arab',
            ], [
                'fakultas_id' => '2',
                'prodi_name' => 'Akuntansi',
            ], [
                'fakultas_id' => '2',
                'prodi_name' => 'Ekonomi Pembangunan',
            ], [
                'fakultas_id' => '3',
                'prodi_name' => 'Hubungan Internasional',
            ], [
                'fakultas_id' => '3',
                'prodi_name' => 'Administrasi Negara',
            ], [
                'fakultas_id' => '4',
                'prodi_name' => 'Agribisnis',
            ], [
                'fakultas_id' => '4',
                'prodi_name' => 'Agroteknologi',
            ], [
                'fakultas_id' => '5',
                'prodi_name' => 'Teknik Elektro',
            ], [
                'fakultas_id' => '5',
                'prodi_name' => 'Teknik Industri',
            ], [
                'fakultas_id' => '6',
                'prodi_name' => 'Pendidikan Akuntansi',
            ], [
                'fakultas_id' => '6',
                'prodi_name' => 'Pendidikan Bahasa Inggris',
            ], [
                'fakultas_id' => '7',
                'prodi_name' => 'Biologi',
            ], [
                'fakultas_id' => '7',
                'prodi_name' => 'Farmasi',
            ], [
                'fakultas_id' => '7',
                'prodi_name' => 'Fisika',
            ], [
                'fakultas_id' => '8',
                'prodi_name' => 'Kedokteran',
            ], [
                'fakultas_id' => '9',
                'prodi_name' => 'Peternakan',
            ], [
                'fakultas_id' => '10',
                'prodi_name' => 'Desain Komunikasi Visual',
            ], [
                'fakultas_id' => '10',
                'prodi_name' => 'Kriya Seni',
            ], [
                'fakultas_id' => '11',
                'prodi_name' => 'Pendidikan Jasmani, Kesehatan, dan Rekreasi',
            ], [
                'fakultas_id' => '11',
                'prodi_name' => 'Pendidikan Kepelatihan Olahraga',
            ], [
                'fakultas_id' => '12',
                'prodi_name' => 'Informatika',
            ], [
                'fakultas_id' => '13',
                'prodi_name' => 'Psikologi',
            ], [
                'fakultas_id' => '6',
                'prodi_name' => 'Pendidian Teknik Informatika dan Komputer',
            ]
        ];

        Prodi::insert($prodi);
    }
}
