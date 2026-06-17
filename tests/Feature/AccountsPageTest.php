<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountsPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the accounts page returns a successful response for supported locales.
     */
    public function test_accounts_page_returns_successful_response(): void
    {
        $response = $this->get('/ar/accounts');
        $response->assertStatus(200);

        $response = $this->get('/en/accounts');
        $response->assertStatus(200);
    }

    /**
     * Test that the accounts page contains the expected links and brand information.
     */
    public function test_accounts_page_has_required_elements(): void
    {
        $response = $this->get('/ar/accounts');

        $response->assertSee('balkis_travel.ico');
        $response->assertSee('link-website');
        $response->assertSee('link-whatsapp');
        $response->assertSee('link-instagram');
        $response->assertSee('link-tiktok');
        $response->assertSee('link-snapchat');
        $response->assertSee('link-email');
    }
}
