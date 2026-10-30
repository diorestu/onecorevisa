<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_requires_login_and_explicit_administrator_access(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->actingAs(User::factory()->create())->get('/admin')->assertForbidden();
        $this->actingAs(User::factory()->create(['is_admin' => true]))->get('/admin')->assertOk()->assertSee('Dashboard');
    }

    public function test_login_rejects_regular_users_and_accepts_admin_then_logs_out(): void
    {
        $user = User::factory()->create(['password' => 'a-long-password']);
        $this->post('/admin/login', ['email' => $user->email, 'password' => 'a-long-password'])->assertSessionHasErrors('email');
        $this->assertGuest();
        $user->forceFill(['is_admin' => true])->save();
        $this->post('/admin/login', ['email' => $user->email, 'password' => 'a-long-password'])->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
        $this->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    public function test_admin_creation_command_does_not_use_default_credentials(): void
    {
        $this->artisan('admin:create')->expectsQuestion('Nama', 'Administrator')->expectsQuestion('Email', 'admin@onecore.test')->expectsQuestion('Password (minimal 12 karakter)', 'secure-password-123')->assertSuccessful();
        $this->assertTrue(User::where('email', 'admin@onecore.test')->firstOrFail()->is_admin);
    }
}
