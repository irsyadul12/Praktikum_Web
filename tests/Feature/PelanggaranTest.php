<?php

namespace Tests\Feature;

use App\Models\Pelanggaran;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PelanggaranTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an unauthenticated user is redirected from the index page.
     *
     * @return void
     */
    public function test_unauthenticated_user_is_redirected_from_index()
    {
        $response = $this->get(route('pelanggarans.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test that an authenticated user can see the index page.
     *
     * @return void
     */
    public function test_authenticated_user_can_see_the_index_page()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create(['name' => 'Demo', 'nis' => 'S100']);
        Pelanggaran::factory()->create(['student_id' => $student->id, 'jenis' => 'pelanggaran', 'kategori' => 'non-akademik', 'poin' => -5]);

        $response = $this->actingAs($user)->get(route('pelanggarans.index'));

        $response->assertStatus(200);
        $response->assertSee('Pelanggaran & Prestasi Siswa');
        $response->assertSee('Demo');
    }

    /**
     * Test that an authenticated user can see the create page.
     *
     * @return void
     */
    public function test_authenticated_user_can_see_the_create_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('pelanggarans.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Pencatatan (Pelanggaran / Prestasi)');
    }

    /**
     * Test that an authenticated user can create a new violation.
     *
     * @return void
     */
    public function test_authenticated_user_can_create_a_violation()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create();

        $response = $this->actingAs($user)->post(route('pelanggarans.store'), [
            'student_id' => $student->id,
            'jenis' => 'pelanggaran',
            'kategori' => 'non-akademik',
            'poin' => -10,
            'keterangan' => 'Terlambat masuk sekolah.',
            'tanggal' => now()->format('Y-m-d'),
        ]);

        $response->assertRedirect(route('pelanggarans.index'));
        $response->assertSessionHas('success', 'Pencatatan berhasil disimpan.');
        $this->assertDatabaseHas('pelanggarans', [
            'student_id' => $student->id,
            'poin' => -10,
            'created_by' => $user->id,
        ]);
    }

    /**
     * Test that store action requires valid data.
     *
     * @return void
     */
    public function test_store_requires_validation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('pelanggarans.store'), []);

        $response->assertSessionHasErrors(['student_id', 'jenis', 'kategori', 'poin']);
    }
}