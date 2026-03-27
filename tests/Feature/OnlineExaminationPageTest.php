<?php

it('returns a successful response for the online examination page', function () {
    $response = $this->get(route('online.examination'));

    $response->assertStatus(200);
    $response->assertSee('Online Examination', false);
    $response->assertSee('Mock examination emulates the real online examination experience', false);
    $response->assertSee('forty-five minutes', false);
    $response->assertSee('Final examination is taken at the end of study', false);
    $response->assertSee('cannot be saved or paused', false);
});
