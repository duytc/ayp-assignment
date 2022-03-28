<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function testHealthCheck()
    {
        $this->json('GET', '/')->seeJsonEquals([
            "data" => [
                "dbConnection" => true,
            ]
        ]);
    }
}
