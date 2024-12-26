<?php

namespace Database\Seeders;

use App\Models\Fakultas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultas::truncate();

        $fakultas = [
            [
                'fakultas_name' => 'Ilmu Budaya',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Ekonomi dan Bisnis',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Ilmu Sosial dan Politik',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Pertanian',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Teknik',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Keguruan dan Ilmu Pendidikan',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Matematika dan IPA',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Kedokteran',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Perternakan',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Seni Rupa dan Desain',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Keolahragaan',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Teknologi Informasi dan Sains Data',
                'year_founded' => '2000',
            ], [
                'fakultas_name' => 'Psikologi',
                'year_founded' => '2000',
            ],
        ];

        Fakultas::insert($fakultas);
    }
}
