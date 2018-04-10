<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $responce = $this->get('/');
        $responce->assertStatus(200);
    }

    /*public function testNew()
    {
        $responce = $this->post('/new/rhyme', ['title' => 'testTitle', 'text' => 'testText', 'categories' => "test, NewCategory"]);
        $responce = $this->get('/');
        $responce->assertSee('testTitle');
    }*/
}
