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
            ], [
                'fakultas_name' => 'Ekonomi dan Bisnis',
            ], [
                'fakultas_name' => 'Ilmu Sosial dan Politik',
            ], [
                'fakultas_name' => 'Pertanian',
            ], [
                'fakultas_name' => 'Teknik',
            ], [
                'fakultas_name' => 'Keguruan dan Ilmu Pendidikan',
            ], [
                'fakultas_name' => 'Matematika dan IPA',
            ], [
                'fakultas_name' => 'Kedokteran',
            ], [
                'fakultas_name' => 'Perternakan',
            ], [
                'fakultas_name' => 'Seni Rupa dan Desain',
            ], [
                'fakultas_name' => 'Keolahragaan',
            ], [
                'fakultas_name' => 'Teknologi Informasi dan Sains Data',
            ], [
                'fakultas_name' => 'Psikologi',
            ],
        ];

        Fakultas::insert($fakultas);
    }
}
