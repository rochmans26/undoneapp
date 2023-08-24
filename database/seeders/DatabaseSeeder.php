<?php

namespace Database\Seeders;

use App\Models\Skim;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Bidang;
use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'email' => 'spadmin@example.com',
            'name' => 'SP-Admin',
            'username' => 'sp-admin',
            'password' => bcrypt('rahasia'),
            'level' => 'sp-admin'
        ]);

        Bidang::create([
            'nm_bidang' => 'dummy_bidang_1',
            'slug' => 'dummy-bidang-1'
        ]);

        Bidang::create([
            'nm_bidang' => 'dummy_bidang_2',
            'slug' => 'dummy-bidang-2'
        ]);

        Bidang::create([
            'nm_bidang' => 'dummy_bidang_3',
            'slug' => 'dummy-bidang-3'
        ]);

        Skim::create([
            'nm_skim' => 'Biomedik',
            'slug' => 'biomedik'
        ]);
        Skim::create([
            'nm_skim' => 'Hibah HI-LINK',
            'slug' => 'hibah-hi-link'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks',
            'slug' => 'ipteks'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks Bagi Inovasi Kreativitas Kampus',
            'slug' => 'ipteks-bagi-inovasi-kreativitas-kampus'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks Bagi Kewirausahaan',
            'slug' => 'ipteks-bagi-kewirausahaan'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks Bagi Masyarakat',
            'slug' => 'ipteks-bagi-masyarakat'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks Bagi Produk Ekspor',
            'slug' => 'ipteks-bagi-produk-ekspor'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks Bagi Wilayah',
            'slug' => 'ipteks-bagi-wilayah'
        ]);
        Skim::create([
            'nm_skim' => 'Ipteks Bagi Wilayah Antara PT-CSR/PT-PEMDA-CSR',
            'slug' => 'ipteks-bagi-wilayah-antara-pt-csr/pt-pemda-csr'
        ]);
        Skim::create([
            'nm_skim' => 'Kerjasama Luar Negeri dan Publikasi Internasional',
            'slug' => 'kerjasama-luar-negeri-dan-publikasi-internasional'
        ]);
        Skim::create([
            'nm_skim' => 'KKN Pembelajaran Pemberdayaan Masyarakat',
            'slug' => 'kkn-pembelajaran-pemberdayaan-masyarakat'
        ]);
        Skim::create([
            'nm_skim' => 'Mobil Listrik Nasional',
            'slug' => 'mobil-listrik-nasional'
        ]);
        Skim::create([
            'nm_skim' => 'MP3EI',
            'slug' => 'mp3ei'
        ]);
        Skim::create([
            'nm_skim' => 'Pendidikan Magister Doktor Sarjana Unggul',
            'slug' => 'pendidikan-magister-doktor-sarjana-unggul'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Dana Lokal Perguruan Tinggi',
            'slug' => 'penelitian-dana-lokal-perguruan-tinggi'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Disertasi Doktor',
            'slug' => 'penelitian-disertasi-doktor'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Dosen Pemula',
            'slug' => 'penelitian-dosen-pemula'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Fundamental',
            'slug' => 'penelitian-fundamental'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Hibah Bersaing',
            'slug' => 'penelitian-hibah-bersaing'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Kerjasama Antar Perguruan Tinggi',
            'slug' => 'penelitian-kerjasama-antar-perguruan-tinggi'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Kompetensi',
            'slug' => 'penelitian-kompetensi'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Strategis Nasional',
            'slug' => 'penelitian-strategis-nasional'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Tim Pasca Sarjana',
            'slug' => 'penelitian-tim-pasca-sarjana'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Unggulan Perguruan Tinggi',
            'slug' => 'penelitian-unggulan-perguruan-tinggi'
        ]);
        Skim::create([
            'nm_skim' => 'Penelitian Unggulan Strategis Nasional',
            'slug' => 'penelitian-unggulan-strategis-nasional'
        ]);
        Skim::create([
            'nm_skim' => 'Riset Andalan Perguruan Tinggi dan Industri',
            'slug' => 'riset-andalan-perguruan-tinggi-dan-industri'
        ]);

        Fakultas::create([
            'id_fak' => 50,
            'nm_fak' => 'Teknik',
            'slug' => 'teknik',
        ]);
        Fakultas::create([
            'id_fak' => 51,
            'nm_fak' => 'Hukum',
            'slug' => 'hukum',
        ]);
        Fakultas::create([
            'id_fak' => 52,
            'nm_fak' => 'Ekonomi',
            'slug' => 'ekonomi',
        ]);
        Fakultas::create([
            'id_fak' => 53,
            'nm_fak' => 'FISIP',
            'slug' => 'fisip',
        ]);
        Fakultas::create([
            'id_fak' => 54,
            'nm_fak' => 'PGSD',
            'slug' => 'pgsd',
        ]);

        Prodi::create([
            'id_fak' => 1,
            'id_prodi' => 50,
            'nm_prodi' => 'Informatika',
            'slug' => 'informatika'
        ]);
        Prodi::create([
            'id_fak' => 1,
            'id_prodi' => 51,
            'nm_prodi' => 'Industri',
            'slug' => 'industri'
        ]);
        Prodi::create([
            'id_fak' => 1,
            'id_prodi' => 52,
            'nm_prodi' => 'Sipil',
            'slug' => 'sipil'
        ]);
        Prodi::create([
            'id_fak' => 1,
            'id_prodi' => 53,
            'nm_prodi' => 'Arsitek',
            'slug' => 'arsitek'
        ]);

    }
}
