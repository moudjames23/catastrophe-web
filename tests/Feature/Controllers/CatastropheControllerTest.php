<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Catastrophe;

use App\Models\Alea;
use App\Models\Ville;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatastropheControllerTest extends TestCase
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
    public function it_displays_index_view_with_catastrophes()
    {
        $catastrophes = factory(Catastrophe::class, 5)->create();

        $response = $this->get(route('catastrophes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.catastrophes.index')
            ->assertViewHas('catastrophes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_catastrophe()
    {
        $response = $this->get(route('catastrophes.create'));

        $response->assertOk()->assertViewIs('app.catastrophes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_catastrophe()
    {
        $data = factory(Catastrophe::class)
            ->make()
            ->toArray();

        $response = $this->post(route('catastrophes.store'), $data);

        $this->assertDatabaseHas('catastrophes', $data);

        $catastrophe = Catastrophe::latest('id')->first();

        $response->assertRedirect(route('catastrophes.edit', $catastrophe));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_catastrophe()
    {
        $catastrophe = factory(Catastrophe::class)->create();

        $response = $this->get(route('catastrophes.show', $catastrophe));

        $response
            ->assertOk()
            ->assertViewIs('app.catastrophes.show')
            ->assertViewHas('catastrophe');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_catastrophe()
    {
        $catastrophe = factory(Catastrophe::class)->create();

        $response = $this->get(route('catastrophes.edit', $catastrophe));

        $response
            ->assertOk()
            ->assertViewIs('app.catastrophes.edit')
            ->assertViewHas('catastrophe');
    }

    /**
     * @test
     */
    public function it_updates_the_catastrophe()
    {
        $catastrophe = factory(Catastrophe::class)->create();

        $alea = factory(Alea::class)->create();
        $ville = factory(Ville::class)->create();

        $data = [
            'valeur' => $this->faker->randomNumber(0),
            'url' => $this->faker->url,
            'alea_id' => $alea->id,
            'ville_id' => $ville->id,
        ];

        $response = $this->put(
            route('catastrophes.update', $catastrophe),
            $data
        );

        $data['id'] = $catastrophe->id;

        $this->assertDatabaseHas('catastrophes', $data);

        $response->assertRedirect(route('catastrophes.edit', $catastrophe));
    }

    /**
     * @test
     */
    public function it_deletes_the_catastrophe()
    {
        $catastrophe = factory(Catastrophe::class)->create();

        $response = $this->delete(route('catastrophes.destroy', $catastrophe));

        $response->assertRedirect(route('catastrophes.index'));

        $this->assertDeleted($catastrophe);
    }
}
