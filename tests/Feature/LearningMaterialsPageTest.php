<?php

it('returns a successful response for the learning materials page', function () {
    $response = $this->get(route('learning.materials'));

    $response->assertSuccessful();
    $response->assertSee('Learning Materials', false);
    $response->assertSee('PowerPoint Slide Materials', false);
    $response->assertSee('PDF Learning Resources', false);
});
