<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_be_also_created()
    {
        // Arrange
        /** @var SeriesRepository $repository */
        $repository = $this->app->make(SeriesRepository::class);
        $request = new SeriesFormRequest();
        $request = new SeriesFormRequest();
        $request->nome = 'Nome da série';
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        // Act
        $repository->add($request);

        // Assert
        $this->assertDatabaseHas('series', ['nome' => $request->nome]);
        $this->assertDatabaseHas('seasons', ['number' => $request->seasonsQty]);
        $this->assertDatabaseHas('episodes', ['number' => $request->episodesPerSeason]);
    }
}
