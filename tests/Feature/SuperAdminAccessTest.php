<?php

use App\Models\User;

test('admin role can access admin dashboard', function () {
    $user = User::factory()->create(['role_type' => 'admin']);

    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertOk();
});

test('sme role can access sme dashboard', function () {
    $user = User::factory()->create(['role_type' => 'sme']);

    $response = $this->actingAs($user)->get(route('sme.dashboard'));

    $response->assertOk();
});

test('non super admin users are redirected to their dashboard when accessing admin users routes', function () {
    $user = User::factory()->create(['role_type' => 'support']);

    $response = $this->actingAs($user)->get(route('super-admin.admin-users.index'));

    $response->assertRedirect(route('support.dashboard'));
});

test('super admin can access super admin dashboard and admin users', function () {
    $user = User::factory()->create(['role_type' => 'superadmin']);

    $this->actingAs($user)->get(route('super-admin.dashboard'))->assertOk();
    $this->actingAs($user)->get(route('super-admin.admin-users.index'))->assertOk();
});
