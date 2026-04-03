<?php

it('returns a successful response for the home page with static course card imagery', function () {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('images/course.jpeg', false);
    $response->assertSee('CPD Modules', false);
});
