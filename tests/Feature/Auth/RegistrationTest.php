<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->seed(\Database\Seeders\RolesSeeder::class);
        $this->seed(\Database\Seeders\JabatanSeeder::class);
        $jabatan = \App\Models\Jabatan::first();

        $response = $this->post('/register', [
            'nip' => '123456789012345678',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'nama_lengkap' => 'Test User Lengkap',
            'jabatan_id' => $jabatan->id,
            'bidang' => 'Bidang Testing',
            'pangkat_golongan' => 'Golongan Testing',
            'nomor_telepon' => '08123456789',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertGuest();
        $response->assertRedirect(route('login', absolute: false));

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'nip' => '123456789012345678',
        ]);
    }
}
