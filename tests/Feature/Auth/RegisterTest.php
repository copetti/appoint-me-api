<?php

use App\Http\Resources\UserResource;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('should be able to register a new user', function () {

    $password = Hash::make('joe@doe!');

    $this->postJson(route('api.register', [
        'first_name'  => 'Joe',
        'email' => 'joe@doe.com',
        'password' => $password
    ]))->assertStatus(201)
      ->assertJson(fn (AssertableJson $json) =>
            $json->has(1)
                ->first(fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->where('first_name', 'Joe')
                    ->where('email', fn (string $email) => str($email)->is('joe@doe.com'))
                    ->etc()
                )
            );

    $this->assertTrue(Hash::check('joe@doe!', $password));

    $this->assertDatabaseHas('users', [
        'first_name'  => 'Joe',
        'email' => 'joe@doe.com',
    ]);

    $this->assertDatabaseCount('users', 1);
});
