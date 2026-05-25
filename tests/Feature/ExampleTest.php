<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_root_redirects_unauthenticated_visitors_to_login(): void
    {
        // GET / is a permanent redirect to admin.dashboard, which is itself
        // behind auth — so an anonymous visitor follows two hops and lands
        // on the login screen.
        $this->get('/')->assertRedirect(route('admin.dashboard'));
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    }
}
