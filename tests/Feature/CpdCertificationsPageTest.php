<?php

it('returns a successful response for the CPD certifications page', function () {
    $response = $this->get(route('cpd.certifications'));

    $response->assertStatus(200);
    $response->assertSee('CPD Certification', false);
});
