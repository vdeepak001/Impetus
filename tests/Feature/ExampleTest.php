<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('shows login for exams CTA that opens the login modal instead of linking to the admin dashboard', function () {
    $response = $this->get('/');

    $response->assertSee('Log in for exams', false);
    $response->assertDontSee('Go to dashboard', false);
});
