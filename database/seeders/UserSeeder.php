<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Fakultas',
            'email' => 'fakultas@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'fakultas'
        ]);

        User::create([
            'name' => 'Prodi',
            'email' => 'prodi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'prodi'
        ]);

        User::create([
            'name' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen'
        ]);

        User::create([
            'name' => 'Ilmu Budaya',
            'email' => 'ilmu_budaya@mail.com',
            'password' => Hash::make('fakultas'),
            'role' => 'fakultas',
            'fakultas_id' => '1',
        ]);

        User::create(
            [
                'name' => 'Ekonomi dan Bisnis',
                'email' => 'ekonomi_bisnis@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '2',
            ]
        );

        User::create(
            [
                'name' => 'Ilmu Sosial dan Politik',
                'email' => 'ilmu_sosial_politik@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '3',
            ]
        );

        User::create(
            [
                'name' => 'Pertanian',
                'email' => 'pertanian@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '4',
            ]
        );

        User::create(
            [
                'name' => 'Teknik',
                'email' => 'teknik@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '5',
            ]
        );

        User::create(
            [
                'name' => 'Keguruan dan Ilmu Pendidikan',
                'email' => 'keguruan_ilmu_pendidikan@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '6',
            ]
        );

        User::create(
            [
                'name' => 'Matematika dan IPA',
                'email' => 'matematika_ipa@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '7',
            ]
        );

        User::create(
            [
                'name' => 'Kedokteran',
                'email' => 'kedokteran@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '8',
            ]
        );

        User::create(
            [
                'name' => 'Peternakan',
                'email' => 'peternakan@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '9',
            ]
        );

        User::create(
            [
                'name' => 'Seni Rupa dan Desain',
                'email' => 'seni_rupa_desain@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '10',
            ]
        );

        User::create(
            [
                'name' => 'Keolahragaan',
                'email' => 'keolahragaan@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '11',
            ]
        );

        User::create(
            [
                'name' => 'Teknologi Informasi dan Sains Data',
                'email' => 'teknologi_informasi_sains_data@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '12',
            ]
        );

        User::create(
            [
                'name' => 'Psikologi',
                'email' => 'psikologi@mail.com',
                'password' => Hash::make('fakultas'),
                'role' => 'fakultas',
                'fakultas_id' => '13',
            ]
        );

        User::create(
            [
                'name' => 'Ilmu Sejarah',
                'email' => 'ilmu_sejarah@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '1',
                'prodi_id' => '1',
            ]
        );

        User::create(
            [
                'name' => 'Sastra Arab',
                'email' => 'sastra_arab@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '1',
                'prodi_id' => '2',
            ]
        );

        User::create(
            [
                'name' => 'Akuntansi',
                'email' => 'akuntansi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '2',
                'prodi_id' => '3',
            ]
        );

        User::create(
            [
                'name' => 'Ekonomi Pembangunan',
                'email' => 'ekonomi_pembangunan@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '2',
                'prodi_id' => '4',
            ]
        );

        User::create(
            [
                'name' => 'Hubungan Internasional',
                'email' => 'hubungan_internasional@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '3',
                'prodi_id' => '5',
            ]
        );

        User::create(
            [
                'name' => 'Administrasi Negara',
                'email' => 'administrasi_negara@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '3',
                'prodi_id' => '6',
            ]
        );

        User::create(
            [
                'name' => 'Agribisnis',
                'email' => 'agribisnis@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '4',
                'prodi_id' => '7',
            ]
        );

        User::create(
            [
                'name' => 'Agroteknologi',
                'email' => 'agroteknologi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '4',
                'prodi_id' => '8',
            ]
        );

        User::create(
            [
                'name' => 'Teknik Elektro',
                'email' => 'teknik_elektro@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '5',
                'prodi_id' => '9',
            ]
        );

        User::create(
            [
                'name' => 'Teknik Industri',
                'email' => 'teknik_industri@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '5',
                'prodi_id' => '10',
            ]
        );

        User::create(
            [
                'name' => 'Pendidikan Akuntansi',
                'email' => 'pendidikan_akuntansi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '6',
                'prodi_id' => '11',
            ]
        );

        User::create(
            [
                'name' => 'Pendidikan Bahasa Inggris',
                'email' => 'pendidikan_bahasa_inggris@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '6',
                'prodi_id' => '12',
            ]
        );

        User::create(
            [
                'name' => 'Biologi',
                'email' => 'biologi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '7',
                'prodi_id' => '13',
            ]
        );

        User::create(
            [
                'name' => 'Farmasi',
                'email' => 'farmasi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '7',
                'prodi_id' => '14',
            ]
        );

        User::create(
            [
                'name' => 'Fisika',
                'email' => 'fisika@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '7',
                'prodi_id' => '15',
            ]
        );

        User::create(
            [
                'name' => 'Kedokteran',
                'email' => 'kedokteran@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '8',
                'prodi_id' => '16',
            ]
        );

        User::create(
            [
                'name' => 'Peternakan',
                'email' => 'peternakan@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '9',
                'prodi_id' => '17',
            ]
        );

        User::create(
            [
                'name' => 'Desain Komunikasi Visual',
                'email' => 'desain_komunikasi_visual@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '10',
                'prodi_id' => '18',
            ]
        );

        User::create(
            [
                'name' => 'Kriya Seni',
                'email' => 'kriya_seni@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '10',
                'prodi_id' => '19',
            ]
        );

        User::create(
            [
                'name' => 'Pendidikan Jasmani, Kesehatan, dan Rekreasi',
                'email' => 'pendidikan_jasmani_kesehatan_rekreasi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '11',
                'prodi_id' => '20',
            ]
        );

        User::create(
            [
                'name' => 'Pendidikan Kepelatihan Olahraga',
                'email' => 'pendidikan_kepelatihan_olahraga@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '11',
                'prodi_id' => '21',
            ]
        );

        User::create(
            [
                'name' => 'Informatika',
                'email' => 'informatika@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '12',
                'prodi_id' => '22',
            ]
        );

        User::create(
            [
                'name' => 'Psikologi',
                'email' => 'psikologi@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '13',
                'prodi_id' => '23',
            ]
        );

        User::create(
            [
                'name' => 'Pendidikan Teknik Informatika dan Komputer',
                'email' => 'pendidikan_teknik_informatika_komputer@example.com',
                'password' => Hash::make('prodi'),
                'role' => 'prodi',
                'fakultas_id' => '6',
                'prodi_id' => '24',
            ]
        );

        User::create([
            'name' => 'Muhammad Rohmadi',
            'email' => 'muhammad.rohmadi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '_ahaA8oAAAAJ',
            'scopus_id' => '16641219300',
            'fakultas_id' => '1',
            'prodi_id' => '1'
        ]);

        User::create([
            'name' => 'Sri Mulyani',
            'email' => 'sri.mulyani@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'WNQeNrMAAAAJ',
            'scopus_id' => '6701338308',
            'fakultas_id' => '1',
            'prodi_id' => '1'
        ]);

        User::create([
            'name' => 'Bhisma Murti',
            'email' => 'bhisma.murti@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'hHn9BsYAAAAJ',
            'scopus_id' => '15836029400',
            'fakultas_id' => '1',
            'prodi_id' => '2'
        ]);

        User::create([
            'name' => 'Doddy Setiawan',
            'email' => 'doddy.setiawan@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'ousdEh4AAAAJ',
            'scopus_id' => '57201775415',
            'fakultas_id' => '1',
            'prodi_id' => '2'
        ]);

        User::create([
            'name' => 'Wiranta',
            'email' => 'wiranta@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'B3_rrxEAAAAJ',
            'scopus_id' => '56338223000',
            'fakultas_id' => '2',
            'prodi_id' => '3'
        ]);

        User::create([
            'name' => 'Agus Purwanto',
            'email' => 'agus.purwanto@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'cIGHN8cAAAAJ',
            'scopus_id' => '56178586300',
            'fakultas_id' => '2',
            'prodi_id' => '3'
        ]);

        User::create([
            'name' => 'Mohammad Masykuri',
            'email' => 'mohammad.masykuri@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'QN7qX9UAAAAJ',
            'scopus_id' => '42062336300',
            'fakultas_id' => '2',
            'prodi_id' => '4'
        ]);

        User::create([
            'name' => 'Edy Purwanto',
            'email' => 'edy.purwanto@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '2qFReLoAAAAJ',
            'scopus_id' => '55754220200',
            'fakultas_id' => '2',
            'prodi_id' => '4'
        ]);

        User::create([
            'name' => 'Andayani',
            'email' => 'andayani@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'gNeMIS0AAAAJ',
            'scopus_id' => '52463607900',
            'fakultas_id' => '3',
            'prodi_id' => '5'
        ]);

        User::create([
            'name' => 'BRM Bambang Irawan',
            'email' => 'brm.bambang.irawan@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '0UpmBB4AAAAJ',
            'scopus_id' => '57197832621',
            'fakultas_id' => '3',
            'prodi_id' => '5'
        ]);

        User::create([
            'name' => 'Widha Sunarno',
            'email' => 'widha.sunarno@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'IVvbtxoAAAAJ',
            'scopus_id' => '35741558600',
            'fakultas_id' => '3',
            'prodi_id' => '6'
        ]);

        User::create([
            'name' => 'Sajidan',
            'email' => 'sajidan@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'VFmnslYAAAAJ',
            'scopus_id' => '24464557700',
            'fakultas_id' => '3',
            'prodi_id' => '6'
        ]);

        User::create([
            'name' => 'Sulistyo Saputro',
            'email' => 'sulistyo.saputro@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '2IBZW1AAAAAJ',
            'scopus_id' => '57213148406',
            'fakultas_id' => '4',
            'prodi_id' => '7'
        ]);

        User::create([
            'name' => 'Suciati Suciati',
            'email' => 'suciati.suciati@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'ZGd-RO8AAAAJ',
            'scopus_id' => '36053216800',
            'fakultas_id' => '4',
            'prodi_id' => '7'
        ]);

        User::create([
            'name' => 'Riyadi Santosa',
            'email' => 'riyadi.santosa@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '3JLX0XcAAAAJ',
            'scopus_id' => '56177538900',
            'fakultas_id' => '4',
            'prodi_id' => '8'
        ]);

        User::create([
            'name' => 'Irwan Trinugroho',
            'email' => 'irwan.trinugroho@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'EGwfzmoAAAAJ',
            'scopus_id' => '6505505624',
            'fakultas_id' => '4',
            'prodi_id' => '8'
        ]);

        User::create([
            'name' => 'Bandi',
            'email' => 'bandi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'kszM5JoAAAAJ',
            'scopus_id' => '57208682883',
            'fakultas_id' => '5',
            'prodi_id' => '9'
        ]);

        User::create([
            'name' => 'Dr. Argyo Demartoto, M.Si',
            'email' => 'argyo.demartoto@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'DM7Q5vYAAAAJ',
            'scopus_id' => '59128529300',
            'fakultas_id' => '5',
            'prodi_id' => '9'
        ]);

        User::create([
            'name' => 'Budi Usodo',
            'email' => 'budi.usodo@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'tRzpS5AAAAAJ',
            'scopus_id' => '35118145700',
            'fakultas_id' => '5',
            'prodi_id' => '10'
        ]);

        User::create([
            'name' => 'Imam Sujadi',
            'email' => 'imam.sujadi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '93LrpJwAAAAJ',
            'scopus_id' => '7409510765',
            'fakultas_id' => '5',
            'prodi_id' => '10'
        ]);

        User::create([
            'name' => 'Puan Rafida Mahira',
            'email' => 'puan.rafida.maira@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'xu-WlO4AAAAJ',
            'scopus_id' => '6602940233',
            'fakultas_id' => '6',
            'prodi_id' => '11'
        ]);

        User::create([
            'name' => 'Hasan Fauzi.',
            'email' => 'hasan.fauzi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'ao7MiNAAAAAJ',
            'scopus_id' => '56451212200',
            'fakultas_id' => '6',
            'prodi_id' => '11'
        ]);

        User::create([
            'name' => 'Sukarmin',
            'email' => 'sukarmin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'YQyGpHAAAAAJ',
            'scopus_id' => '35225746000',
            'fakultas_id' => '6',
            'prodi_id' => '12'
        ]);

        User::create([
            'name' => 'Muhammad Muslikhin',
            'email' => 'muhammad.muslikhin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'MS8m5psAAAAJ',
            'scopus_id' => '55934837700',
            'fakultas_id' => '6',
            'prodi_id' => '12'
        ]);

        User::create([
            'name' => 'Sanjaya',
            'email' => 'sanjaya@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'H_x-5H0AAAAJ',
            'scopus_id' => '35234876400',
            'fakultas_id' => '7',
            'prodi_id' => '13'
        ]);

        User::create([
            'name' => 'Amroni',
            'email' => 'amroni@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'F4f8vD4AAAAJ',
            'scopus_id' => '35150227800',
            'fakultas_id' => '7',
            'prodi_id' => '13'
        ]);

        User::create([
            'name' => 'Ernoiz Antriyandarti',
            'email' => 'ernoiz.antriyandarti@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'uTQxsToAAAAJ',
            'scopus_id' => '40761547000',
            'fakultas_id' => '7',
            'prodi_id' => '14',
        ]);

        User::create([
            'name' => 'Sarwiji Suwandi',
            'email' => 'sarwiji.suwandi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'HM8cBzAAAAAJ',
            'scopus_id' => '56352104600',
            'fakultas_id' => '7',
            'prodi_id' => '14',
        ]);

        User::create([
            'name' => 'Maria Ulfa',
            'email' => 'maria.ulfa@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '4_lBDjUAAAAJ',
            'scopus_id' => '6603804256',
            'fakultas_id' => '7',
            'prodi_id' => '15',
        ]);

        User::create([
            'name' => 'Agung Nugroho Catur Saputro',
            'email' => 'agung.nugroho@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'SVzbvn4AAAAJ',
            'scopus_id' => '55846541300',
            'fakultas_id' => '7',
            'prodi_id' => '15',
        ]);

        User::create([
            'name' => 'Dr. Ubaidillah',
            'email' => 'ubaidillah.dosen@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'dQsTxE0AAAAJ',
            'scopus_id' => '56180418700',
            'fakultas_id' => '8',
            'prodi_id' => '16',
        ]);

        User::create([
            'name' => 'Mangatur Nababan',
            'email' => 'mangatur.nababan@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'xchq1-8AAAAJ',
            'scopus_id' => '55195744200',
            'fakultas_id' => '8',
            'prodi_id' => '16',
        ]);

        User::create([
            'name' => 'Nugroho Agung Pambudi',
            'email' => 'nugroho.pambudi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'n_ofxzcAAAAJ',
            'scopus_id' => '55387142700',
            'fakultas_id' => '9',
            'prodi_id' => '17',
        ]);

        User::create([
            'name' => 'St Y Slamet',
            'email' => 'st.slamet@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'o3ntphQAAAAJ',
            'scopus_id' => '57190934033',
            'fakultas_id' => '9',
            'prodi_id' => '17',
        ]);

        User::create([
            'name' => 'Leo Agung Sutimin',
            'email' => 'leo.sutimin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'QMMg4t8AAAAJ',
            'scopus_id' => '55571941200',
            'fakultas_id' => '10',
            'prodi_id' => '18',
        ]);

        User::create([
            'name' => 'Joko Nurkamto',
            'email' => 'joko.nurkamto@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '5ZM3_LMAAAAJ',
            'scopus_id' => '56460408200',
            'fakultas_id' => '10',
            'prodi_id' => '18',
        ]);

        User::create([
            'name' => 'Sapja Anantanyu',
            'email' => 'sapja.anantanyu@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'TGGuHMQAAAAJ',
            'scopus_id' => '57215215171',
            'fakultas_id' => '10',
            'prodi_id' => '19',
        ]);

        User::create([
            'name' => 'Riyadi',
            'email' => 'riyadi.dosen@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'XMecgUoAAAAJ',
            'scopus_id' => '56012196700',
            'fakultas_id' => '10',
            'prodi_id' => '19',
        ]);

        User::create([
            'name' => 'RB. Soemanto',
            'email' => 'rb.soemanto@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'T8aNrqQAAAAJ',
            'scopus_id' => '57202300237',
            'fakultas_id' => '11',
            'prodi_id' => '20',
        ]);

        User::create([
            'name' => 'Prof. Dr. Suyitno, M.Pd.',
            'email' => 'suyitno.mpd@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '2jeJznAAAAAJ',
            'scopus_id' => '33267518100',
            'fakultas_id' => '11',
            'prodi_id' => '20',
        ]);

        User::create([
            'name' => 'Cut Adira Titania Putri',
            'email' => 'cut.adira@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'TM890zkAAAAJ',
            'scopus_id' => '56012247000',
            'fakultas_id' => '11',
            'prodi_id' => '21',
        ]);

        User::create([
            'name' => 'Dr. Sri Yamtinah, S.Pd., M.Pd',
            'email' => 'sri.yamtinah@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'DFdrc_gAAAAJ',
            'scopus_id' => '58068387700',
            'fakultas_id' => '11',
            'prodi_id' => '21',
        ]);

        User::create([
            'name' => 'Dwi Wahyuni',
            'email' => 'dwi.wahyuni@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => '2Ix4WxsAAAAJ',
            'scopus_id' => '56028197800',
            'fakultas_id' => '12',
            'prodi_id' => '22',
        ]);

        User::create([
            'name' => 'Retno Winarni',
            'email' => 'retno.winarni@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'P5CZccoAAAAJ',
            'scopus_id' => '59165567800',
            'fakultas_id' => '12',
            'prodi_id' => '22',
        ]);

        User::create([
            'name' => 'Mugi Rahardjo',
            'email' => 'mugi.rahardjo@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'NXYKxnIAAAAJ',
            'scopus_id' => '36931094200',
            'fakultas_id' => '13',
            'prodi_id' => '23',
        ]);

        User::create([
            'name' => 'Tri Atmojo Kusmayadi',
            'email' => 'tri.kusmayadi@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'GPBtAsUAAAAJ',
            'scopus_id' => '55851190200',
            'fakultas_id' => '13',
            'prodi_id' => '23',
        ]);

        User::create([
            'name' => 'Agus Kristiyanto',
            'email' => 'agus.kristiyanto@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'tAQT8W8AAAAJ',
            'scopus_id' => '55791436800',
            'fakultas_id' => '6',
            'prodi_id' => '24',
        ]);

        User::create([
            'name' => 'Hendri Widiyandari',
            'email' => 'hendri.widiyandari@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen',
            'scholar_id' => 'nPdAO3oAAAAJ',
            'scopus_id' => '57207550189',
            'fakultas_id' => '6',
            'prodi_id' => '24',
        ]);
    }
}
