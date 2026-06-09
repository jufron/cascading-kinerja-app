<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Jabatan;
use App\Models\DokumentKinerja;
use App\Models\validationLaaporan;
use App\Models\Catatan;
use App\Models\LaporanPegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed standard roles and jabatan
        $this->seed(\Database\Seeders\RolesSeeder::class);
        $this->seed(\Database\Seeders\JabatanSeeder::class);
    }

    /**
     * Helper to create a user, assign role, and create associated biodata.
     */
    protected function createUserWithRole(string $roleName, string $name = 'Test User'): User
    {
        $user = User::factory()->create([
            'name' => $name,
        ]);
        $user->assignRole($roleName);

        Biodata::create([
            'user_id' => $user->id,
            'nama_lengkap' => $name . ' Lengkap',
            'jabatan_id' => Jabatan::first()->id,
            'bidang' => 'Bidang Testing',
            'pangkat_golongan' => 'Pangkat/Golongan Testing',
            'nomor_telepon' => '08123456789'
        ]);

        return $user;
    }

    /**
     * Test public landing pages and authentication forms.
     */
    public function test_public_views(): void
    {
        // Welcome Page
        $response = $this->get('/');
        $response->assertStatus(200);

        // Login Page
        $response = $this->get('/login');
        $response->assertStatus(200);

        // Register Page
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * Test dashboard access depending on role.
     */
    public function test_dashboard_views_for_different_roles(): void
    {
        // 1. Admin Dashboard
        $admin = $this->createUserWithRole('admin', 'Admin User');
        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.admin.dashboard');

        // 2. Pimpinan Dashboard
        $pimpinan = $this->createUserWithRole('pimpinan', 'Pimpinan User');
        $response = $this->actingAs($pimpinan)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pimpinan.dashboard');

        // 3. Pegawai Dashboard
        $pegawai = $this->createUserWithRole('pegawai', 'Pegawai User');
        $response = $this->actingAs($pegawai)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pegawai.dashboard');
    }

    /**
     * Test edit profile view.
     */
    public function test_profile_edit_view(): void
    {
        $user = $this->createUserWithRole('pegawai', 'Profile User');
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    }

    /**
     * Test admin role-specific views.
     */
    public function test_admin_resource_and_custom_views(): void
    {
        $admin = $this->createUserWithRole('admin', 'Admin User');

        // Daftar Admin Index & Create
        $response = $this->actingAs($admin)->get('/daftar-admin');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/daftar-admin/create');
        $response->assertStatus(200);

        // Pejabat Atasan Index & Create
        $response = $this->actingAs($admin)->get('/pejabat-atasan');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/pejabat-atasan/create');
        $response->assertStatus(200);

        // Dokument Kinerja Index & Create
        $response = $this->actingAs($admin)->get('/dokument-kinerja');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/dokument-kinerja/create');
        $response->assertStatus(200);

        // Setup a mock DokumentKinerja to test show & edit routes
        $pegawai = $this->createUserWithRole('pegawai', 'Pegawai Pihak Pertama');
        $pimpinan = $this->createUserWithRole('pimpinan', 'Pimpinan Pihak Kedua');

        $dokumentKinerja = DokumentKinerja::create([
            'user_id_pihak_pertama' => $pegawai->id,
            'user_id_pihak_kedua' => $pimpinan->id,
            'jenis_kinerja' => 'utama',
            'head_dokument' => 'Kepala Dokumen',
            'body_dokument' => 'Badan Dokumen',
            'tahun' => '2026'
        ]);

        // Show & Edit Dokument Kinerja
        $response = $this->actingAs($admin)->get("/dokument-kinerja/{$dokumentKinerja->id}");
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get("/dokument-kinerja/{$dokumentKinerja->id}/edit");
        $response->assertStatus(200);

        // Kinerja Index & Create
        $response = $this->actingAs($admin)->get("/dokument-kinerja/{$dokumentKinerja->id}/kinerja");
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get("/dokument-kinerja/{$dokumentKinerja->id}/kinerja/create");
        $response->assertStatus(200);

        // Pelaksanaan Anggaran Create
        $response = $this->actingAs($admin)->get("/dokument-kinerja/{$dokumentKinerja->id}/anggaran/create");
        $response->assertStatus(200);

        // Catatan Index
        $response = $this->actingAs($admin)->get('/catatan');
        $response->assertStatus(200);

        // Laporan Index
        // Note: LaporanController index filters where status = 'disetujui'
        $dokumentKinerja->validasiLaporan->update(['status' => 'disetujui']);
        $response = $this->actingAs($admin)->get('/laporan');
        $response->assertStatus(200);

        // Laporan Show JSON response
        $response = $this->actingAs($admin)->get("/laporan/{$dokumentKinerja->validasiLaporan->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'disetujui',
            'tahun' => '2026'
        ]);
    }

    /**
     * Test pimpinan role-specific views.
     */
    public function test_pimpinan_resource_and_custom_views(): void
    {
        $pimpinan = $this->createUserWithRole('pimpinan', 'Pimpinan User');
        $pegawai = $this->createUserWithRole('pegawai', 'Pegawai User');

        // Laporan Pegawai Index & Create
        $response = $this->actingAs($pimpinan)->get('/laporan-pegawai');
        $response->assertStatus(200);

        $response = $this->actingAs($pimpinan)->get('/laporan-pegawai/create');
        $response->assertStatus(200);

        // Setup a mock LaporanPegawai to test edit view
        $laporanPegawai = LaporanPegawai::create([
            'user_id' => $pimpinan->id,
            'pegawai_user_id' => $pegawai->id,
            'nama_file' => 'test-laporan.pdf'
        ]);

        $response = $this->actingAs($pimpinan)->get("/laporan-pegawai/{$laporanPegawai->id}/edit");
        $response->assertStatus(200);

        // Setup a mock DokumentKinerja & Validation Laporan for validation tests
        $dokumentKinerja = DokumentKinerja::create([
            'user_id_pihak_pertama' => $pegawai->id,
            'user_id_pihak_kedua' => $pimpinan->id,
            'jenis_kinerja' => 'tambahan',
            'head_dokument' => 'Kepala Dokumen Pimpinan',
            'body_dokument' => 'Badan Dokumen Pimpinan',
            'tahun' => '2026'
        ]);

        // Validasi Laporan Index, Show & Edit
        $response = $this->actingAs($pimpinan)->get('/validasi-laporan');
        $response->assertStatus(200);

        $response = $this->actingAs($pimpinan)->get("/validasi-laporan/{$dokumentKinerja->validasiLaporan->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'menunggu persetujuan',
            'tahun' => '2026'
        ]);

        $response = $this->actingAs($pimpinan)->get("/validasi-laporan/{$dokumentKinerja->validasiLaporan->id}/edit");
        $response->assertStatus(200);
    }
}
