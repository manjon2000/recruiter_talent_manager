<?php

namespace Tests\Feature;

use App\Models\CandidateStudie;
use App\Models\Multimedia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidateStudieTest extends TestCase
{

    //use RefreshDatabase;


    public function test_example(): void
    {
        $user =  User::factory()->create();
        $multimedia = Multimedia::factory()->create();

        $response = $this->post('/api/candidates/create', [
            'user_id'           => $user->id,
            'multimedia_id'     => $multimedia->id,
            'name'              => 'name',
            'description'       => 'text',
        ]);

        $response->assertOk();
    }
}
