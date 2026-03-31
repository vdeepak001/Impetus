<?php

it('returns a successful response for the CPD certifications page', function () {
    $response = $this->get(route('cpd.certifications'));

    $response->assertSuccessful();
    $response->assertSee('CPD Certification', false);
    $response->assertSee('Key Features', false);
    $response->assertSee('Program Benefits', false);
    $response->assertSee('Our Goal', false);
});
