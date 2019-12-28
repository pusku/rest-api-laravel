<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;

class PostTest extends TestCase{

    public function testsPostsAreCreatedCorrectly(){

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $this->json('POST', '/api/posts', $payload)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }

    public function testsPostsAreUpdatedCorrectly(){

        $post = factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/posts/' . $post->id, $payload)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 51, 
                'title' => 'Lorem', 
                'body' => 'Ipsum' 
            ]);
    }

    public function testsPostsAreDeletedCorrectly(){

        $post = factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', '/api/posts/' . $post->id, [])
            ->assertStatus(204);
    }

    public function testPostsAreListedCorrectly(){

        factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body'
        ]);

        factory(Post::class)->create([
            'title' => 'Second Post',
            'body' => 'Second Body'
        ]);


        $response = $this->json('GET', '/api/posts', [])
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'First Post', 'body' => 'First Body' ],
                [ 'title' => 'Second Post', 'body' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }

}
