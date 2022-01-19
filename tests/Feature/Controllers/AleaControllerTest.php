<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Alea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AleaControllerTest extends TestCase
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
    public function it_displays_index_view_with_aleas()
    {
        $aleas = factory(Alea::class, 5)->create();

        $response = $this->get(route('aleas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.aleas.index')
            ->assertViewHas('aleas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_alea()
    {
        $response = $this->get(route('aleas.create'));

        $response->assertOk()->assertViewIs('app.aleas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_alea()
    {
        $data = factory(Alea::class)
            ->make()
            ->toArray();

        $response = $this->post(route('aleas.store'), $data);

        $this->assertDatabaseHas('aleas', $data);

        $alea = Alea::latest('id')->first();

        $response->assertRedirect(route('aleas.edit', $alea));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_alea()
    {
        $alea = factory(Alea::class)->create();

        $response = $this->get(route('aleas.show', $alea));

        $response
            ->assertOk()
            ->assertViewIs('app.aleas.show')
            ->assertViewHas('alea');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_alea()
    {
        $alea = factory(Alea::class)->create();

        $response = $this->get(route('aleas.edit', $alea));

        $response
            ->assertOk()
            ->assertViewIs('app.aleas.edit')
            ->assertViewHas('alea');
    }

    /**
     * @test
     */
    public function it_updates_the_alea()
    {
        $alea = factory(Alea::class)->create();

        $data = [
            'nom' => $this->faker->unique->text(255),
            'url' => $this->faker->url,
        ];

        $response = $this->put(route('aleas.update', $alea), $data);

        $data['id'] = $alea->id;

        $this->assertDatabaseHas('aleas', $data);

        $response->assertRedirect(route('aleas.edit', $alea));
    }

    /**
     * @test
     */
    public function it_deletes_the_alea()
    {
        $alea = factory(Alea::class)->create();

        $response = $this->delete(route('aleas.destroy', $alea));

        $response->assertRedirect(route('aleas.index'));

        $this->assertDeleted($alea);
    }
}
