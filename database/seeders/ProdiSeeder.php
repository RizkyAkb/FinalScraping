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
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '1',
                'prodi_name' => 'Sastra Arab',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '2',
                'prodi_name' => 'Akuntansi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '2',
                'prodi_name' => 'Ekonomi Pembangunan',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '3',
                'prodi_name' => 'Hubungan Internasional',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '3',
                'prodi_name' => 'Administrasi Negara',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '4',
                'prodi_name' => 'Agribisnis',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '4',
                'prodi_name' => 'Agroteknologi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '5',
                'prodi_name' => 'Teknik Elektro',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '5',
                'prodi_name' => 'Teknik Industri',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '6',
                'prodi_name' => 'Pendidikan Akuntansi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '6',
                'prodi_name' => 'Pendidikan Bahasa Inggris',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '7',
                'prodi_name' => 'Biologi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '7',
                'prodi_name' => 'Farmasi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '7',
                'prodi_name' => 'Fisika',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '8',
                'prodi_name' => 'Kedokteran',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '9',
                'prodi_name' => 'Peternakan',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '10',
                'prodi_name' => 'Desain Komunikasi Visual',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '10',
                'prodi_name' => 'Kriya Seni',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '11',
                'prodi_name' => 'Pendidikan Jasmani, Kesehatan, dan Rekreasi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '11',
                'prodi_name' => 'Pendidikan Kepelatihan Olahraga',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '12',
                'prodi_name' => 'Informatika',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '13',
                'prodi_name' => 'Psikologi',
                'year_founded' => '2000',
            ], [
                'fakultas_id' => '6',
                'prodi_name' => 'Pendidian Teknik Informatika dan Komputer',
                'year_founded' => '2000',
            ]
        ];

        Prodi::insert($prodi);
    }
}
