<?php
namespace Tests\Feature\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginTest extends TestCase
{
    public function test_render_page(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function test_login_adminseller_via_form(): void
    {
        $user = User::factory()->create(['username' => 'admin seller 3', 'email' => 'adminseller3@gmail.com', 'password' => bcrypt('12345678'), 'role' => 'admin_seller',]);
        $response = $this->post('/login', [ 'email' => 'adminseller3@gmail.com', 'password' => '12345678',]);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('beranda.admins'));
    }
}