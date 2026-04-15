<?php

use App\Models\User;

it('allows super admin to view the frontend users list', function () {
    $superAdmin = User::factory()->create(['role_type' => 'superadmin']);
    $customer = User::factory()->create([
        'role_type' => 'user',
        'name' => 'Learner One',
    ]);

    $response = $this->actingAs($superAdmin)->get(route('super-admin.users-list.index'));

    $response->assertSuccessful();
    $response->assertSee('Learner One');
    $response->assertSee($customer->email);
});

it('does not list staff accounts on the frontend users list', function () {
    $superAdmin = User::factory()->create(['role_type' => 'superadmin']);
    $admin = User::factory()->create([
        'role_type' => 'admin',
        'name' => 'Staff Admin Person',
    ]);

    $response = $this->actingAs($superAdmin)->get(route('super-admin.users-list.index'));

    $response->assertSuccessful();
    $response->assertDontSee('Staff Admin Person');
});

it('allows support role to view the frontend users list', function () {
    $support = User::factory()->create(['role_type' => 'support']);

    $this->actingAs($support)->get(route('support.users-list.index'))->assertSuccessful();
});

it('redirects frontend learners away from the staff users list', function () {
    $customer = User::factory()->create(['role_type' => 'user']);

    $this->actingAs($customer)
        ->get(route('super-admin.users-list.index'))
        ->assertRedirect(route('login'));
});
