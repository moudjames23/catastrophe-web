<?php

namespace Tests\Feature\Controllers;

use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            factory(User::class)->create(['email' => 'admin@admin.com'])
        );

        $this->artisan('db:seed --class PermissionsSeeder');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_users()
    {
        $users = factory(User::class, 5)->create();

        $response = $this->get(route('users.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.users.index')
            ->assertViewHas('users');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_user()
    {
        $response = $this->get(route('users.create'));

        $response->assertOk()->assertViewIs('app.users.create');
    }

    /**
     * @test
     */
    public function it_stores_the_user()
    {
        $data = factory(User::class)
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->post(route('users.store'), $data);

        unset($data['password']);
        unset($data['email_verified_at']);

        $this->assertDatabaseHas('users', $data);

        $user = User::latest('id')->first();

        $response->assertRedirect(route('users.edit', $user));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_user()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', $user));

        $response
            ->assertOk()
            ->assertViewIs('app.users.show')
            ->assertViewHas('user');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_user()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.edit', $user));

        $response
            ->assertOk()
            ->assertViewIs('app.users.edit')
            ->assertViewHas('user');
    }

    /**
     * @test
     */
    public function it_updates_the_user()
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique->email,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->put(route('users.update', $user), $data);

        unset($data['password']);
        unset($data['email_verified_at']);

        $data['id'] = $user->id;

        $this->assertDatabaseHas('users', $data);

        $response->assertRedirect(route('users.edit', $user));
    }

    /**
     * @test
     */
    public function it_deletes_the_user()
    {
        $user = factory(User::class)->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));

        $this->assertDeleted($user);
    }
}
