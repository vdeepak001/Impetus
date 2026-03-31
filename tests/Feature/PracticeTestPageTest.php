<?php

it('returns a successful response for the practice test page', function () {
    $response = $this->get(route('practice.test'));

    $response->assertSuccessful();
    $response->assertSee('Practice Tests', false);
    $response->assertSee('Key Features', false);
    $response->assertSee('Benefits', false);
    $response->assertSee('Purpose:', false);
});
