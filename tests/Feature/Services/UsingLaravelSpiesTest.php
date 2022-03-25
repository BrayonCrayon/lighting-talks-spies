<?php

namespace Tests\Feature\Services;

use App\Services\HelperService;
use Tests\TestCase;

class UsingLaravelSpiesTest extends TestCase
{

    /** @test */
    public function it_will_call_service_with_correct_values()
    {
        $leftNumber = 5;
        $rightNumber = 5;
        $spyService = $this->spy(HelperService::class);

        $this->postJson(route('world.end'), [
            "leftNumber" => $leftNumber,
            "rightNumber" => $rightNumber
        ])
            ->assertOk();

        $spyService->shouldHaveReceived("hitsAnApiMethod")
            ->with($leftNumber, $rightNumber)->once();
    }
}
