<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertSee('Empowering Nurses Through', false);
    $response->assertSee('Ventura Learning Solutions', false);
});

it('shows login for exams CTA that opens the login modal instead of linking to the admin dashboard', function () {
    $response = $this->get('/');

    $response->assertSee('Log in for exams', false);
    $response->assertDontSee('Go to dashboard', false);
});
