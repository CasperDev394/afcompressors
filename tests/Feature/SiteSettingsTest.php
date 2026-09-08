<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_uses_site_settings(): void
    {
        $this->withoutVite();

        SiteSetting::query()->firstOrFail()->update([
            'phone' => '+7 495 123 45 67',
            'email' => 'office@example.com',
            'home_h1' => 'Компрессоры AF',
            'home_title' => 'Главная — AF Compressors',
            'home_description' => 'SEO-описание главной страницы.',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('<title>Главная — AF Compressors</title>', false)
            ->assertSee('content="SEO-описание главной страницы."', false)
            ->assertSee('home-h1="Компрессоры AF"', false)
            ->assertSee('phone="+7 495 123 45 67"', false)
            ->assertSee('email="office@example.com"', false);
    }

    public function test_admin_can_read_and_update_site_settings(): void
    {
        $admin = Admin::query()->create();
        $user = User::factory()->create([
            'entity_type' => 'ADMIN',
            'entity_id' => $admin->id,
        ]);

        $this->actingAs($user, 'admin');

        $this->getJson('/admin/settings/read')
            ->assertOk()
            ->assertJsonPath('data.home_h1', 'Energy Sobriety');

        $payload = [
            'phone' => '+7 812 555 35 35',
            'email' => 'hello@example.com',
            'home_h1' => 'Новый H1',
            'home_title' => 'Новый title',
            'home_description' => 'Новое описание.',
        ];

        $this->postJson('/admin/settings/update', $payload)
            ->assertOk()
            ->assertJsonPath('status', 'ok')
            ->assertJsonPath('data.home_title', 'Новый title');

        $this->assertDatabaseHas('site_settings', $payload);
    }
}
