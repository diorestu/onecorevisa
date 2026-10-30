<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSessionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['session.driver' => 'database', 'session.secure' => true]);
        $this->app->bind(ValidateCsrfToken::class, fn ($app) => new class($app, $app['encrypter']) extends ValidateCsrfToken
        {
            protected function runningUnitTests()
            {
                return false;
            }
        });
    }

    public function test_database_session_keeps_csrf_token_and_authenticates_across_https_requests(): void
    {
        $admin = User::factory()->create(['is_admin' => true, 'password' => 'a-secure-test-password']);
        $page = $this->get('https://onecorevisa.test/admin/login')->assertOk();
        preg_match('/name="_token"[^>]*value="([^"]+)"/', $page->getContent(), $matches);
        $token = $matches[1];
        $sessionId = app('session.store')->getId();
        $this->assertDatabaseHas('sessions', ['id' => $sessionId]);
        $this->withCookie(config('session.cookie'), $sessionId)
            ->get('https://onecorevisa.test/admin/login')->assertOk()->assertSee('value="'.$token.'"', false);
        $this->post('https://onecorevisa.test/admin/login', ['_token' => $token, 'email' => $admin->email, 'password' => 'a-secure-test-password'])
            ->assertRedirect('https://onecorevisa.test/admin');
        $this->assertAuthenticatedAs($admin);
        $this->withCookie(config('session.cookie'), app('session.store')->getId())
            ->get('https://onecorevisa.test/admin')->assertOk();
    }

    public function test_login_keeps_csrf_protection_enabled(): void
    {
        $this->post('https://onecorevisa.test/admin/login', ['email' => 'unknown@example.test', 'password' => 'invalid'])
            ->assertStatus(419);
    }
}
