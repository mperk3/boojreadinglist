<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadingListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_readinglist_index()
    {
        $response = $this->get('/readinglist');

        $response->assertStatus(200);
    }

    public function test_readinglist_show()
    {
        $testBook = [
            'id' => 13,
        ];

        $response = $this->get("/readinglist/{$testBook['id']}");

        $response->assertStatus(200);
    }

    public function test_readinglist_create()
    {
        $response = $this->get('/readinglist/create');

        $response->assertStatus(200);
    }

    public function test_readinglist_store()
    {

        $testBook = [
            'isbn' => '9781722834920'
        ];

        $response = $this->post("/readinglist", ['isbn' => $testBook['isbn']]);

        $response->assertRedirect(route('readinglist.index'));
    }

    public function test_readinglist_update()
    {
        $testBook = [
            'id' => 13,
            'action' => 'move_down',
        ];

        $response = $this->patch("/readinglist/{$testBook['id']}", $testBook);

        $response->assertRedirect(route('readinglist.index'));
    }

    public function test_readinglist_destroy()
    {
        $testBook = [
            'id' => 15,
        ];

        $response = $this->delete("/readinglist/{$testBook['id']}");

        $response->assertRedirect(route('readinglist.index'));
    }
}
