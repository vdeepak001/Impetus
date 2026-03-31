<?php

it('returns a successful response for the online examination page', function () {
    $response = $this->get(route('online.examination'));

    $response->assertSuccessful();
    $response->assertSee('Online Test', false);
    $response->assertSee('Flexible Online Assessment', false);
    $response->assertSee('Level of Questions', false);
    $response->assertSee('Scoring and Feedback:', false);
});
