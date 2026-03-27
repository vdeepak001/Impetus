<?php

it('returns a successful response for the learning materials page', function () {
    $response = $this->get(route('learning.materials'));

    $response->assertStatus(200);
    $response->assertSee('Learning Resources', false);
});
