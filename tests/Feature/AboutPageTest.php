<?php

it('returns a successful response for the about page with Ventura content', function () {
    $response = $this->get(route('about'));

    $response->assertSuccessful();
    $response->assertSee('About Ventura Learning Solutions', false);
    $response->assertSee('What We Offer', false);
    $response->assertSee('Flexible Learning Approach', false);
    $response->assertSee('Our Commitment', false);
});
