<?php

use App\KelompokKompetensi;
use App\Posisi;
use App\Training;
use App\UnitKerja;
use Illuminate\Database\Seeder;

class StaticDataSeeder extends Seeder
{
    private $kelompok_kompetensi = [
        'Administrasi',
        'Keuangan',
        'Teknisi',
    ];

    private $posisi = [
        'Direktur Eksekutif',
        'Wakil Direktur Eksekutif',
        'Direktur/Ketua/Kepala',
        'Wakil Direktur/Ketua/Kepala',
        'Sekretaris Lembaga',
        'Kepala Bagian',
        'Kepala Sub Direktorat',
        'Kepala Bidang',
        'Kepala Sub Bagian',
        'Kepala Seksi',
        'Kepala Divisi',
        'Kepala Sekretariat',
        'Kepala Pusat',
        'Supervisor Audit',
        'Koordinator',
        'Staf',
    ];

    private $unit_kerja = [
        'Badan Pengelola Usaha dan Dana Lestari (BPUDL)',
        'Direktorat Eksekutif Kampus ITB Jatinangor',
        'Direktorat Eksekutif Pengelolaan Penerimaan Mahasiswa dan Kerja Sama Pendidikan (DEKTM)',
        'Direktorat Administrasi Umum',
        'Direktorat Hubungan Masyarakat dan Alumni',
        'Direktorat Kemitraan dan Hubungan Internasional (DKHI)',
        'Direktorat Kepegawaian',
        'Direktorat Keuangan',
        'Direktorat Logistik',
        'Direktorat Pendidikan',
        'Direktorat Pengembangan',
        'Direktorat Perencanaan',
        'Direktorat Sarana dan Prasarana',
        'Direktorat Sistem dan Teknologi Informasi (DSTI)',
        'Komisi Penegakan Norma Kemahasiswaan',
        'Lembaga Bimbingan Konseling',
        'Lembaga Kemahasiswaan (LK)',
        'Lembaga Layanan Hukum',
        'Lembaga Pengembangan Inovasi dan Kewirausahaan (LPIK)',
        'Lembaga Penelitian dan Pengabdian Kepada Masyarakat (LPPM)',
        'Lembaga Tahap Persiapan Bersama (LTPB)',
        'Satuan Pengawas Internal (SPI)',
        'Satuan Penjaminan Mutu (SPM)',
        'UPT Asrama',
        'UPT e-Learning',
        'UPT Keamanan, Kesehatan, Keselamatan Kerja dan Lingkungan (K3L)',
        'UPT Layanan Kesehatan',
        'UPT Olahraga',
        'UPT Pengembangan Manusia dan Organisasi (PMO)',
        'UPT Perpustakaan',
        'UPT Pusat  Bahasa',
        'Fakultas Ilmu dan Teknologi Kebumian (FITB)',
        'Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA)',
        'Fakultas Seni Rupa dan Desain (FSRD)',
        'Fakultas Teknik Industri (FTI)',
        'Fakultas Teknik Mesin dan Dirgantara (FTMD)',
        'Fakultas Teknik Pertambangan dan Perminyakan (FTTM)',
        'Fakultas Teknik Sipil dan Lingkungan (FTSL)',
        'Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan (SAPPK)',
        'Sekolah Bisnis dan Manajemen (SBM)',
        'Sekolah Farmasi (SF)',
        'Sekolah Ilmu dan Teknologi Hayati (SITH)',
        'Sekolah Teknik Elektro dan Informatika (STEI)',
        'Sekolah Pasca Sarjana (SPS)',
    ];

    private $training = [
        'Achievement Motivation Training',
        // 'Achievement Orientation',
        // 'Building Commitment',
        // 'Change Management',
        'Continuous Learning and Improvement',
        // 'Customer Services Orientation',
        // 'Decision Making',
        'Effective Leadership',
        'Emphatic Communication',
        'Extraordinary Productivity',
        // 'Group Dynamic',
        // 'Group Leadership',
        // 'Management by Objective',
        'Performance Mangement',
        // 'Policy Deployment',
        // 'Problem Solving',
        'Problem Solving and Decision Making',
        // 'Quality Management',
        // 'Relationship Management',
        // 'Risk Management',
        'Services Excellence',
        'Strategic Management',
        'Stress Management',
        'Team Building',
        'Time Management',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->kelompok_kompetensi as $kelompok_kompetensi) {
            KelompokKompetensi::firstOrCreate(['nama_kelompok_kompetensi' => $kelompok_kompetensi]);
        }

        foreach ($this->posisi as $posisi) {
            Posisi::firstOrCreate(['nama_posisi' => $posisi]);
        }

        foreach ($this->unit_kerja as $unit_kerja) {
            UnitKerja::firstOrCreate(['nama_unit_kerja' => $unit_kerja]);
        }

        foreach ($this->training as $training) {
            Training::firstOrCreate(['nama_training' => $training]);
        }
    }
}
