<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_redirects_root_to_default_locale(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/ar');
    }
}
