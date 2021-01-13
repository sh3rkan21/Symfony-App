<?php

namespace App\Tests;

trait Rollback {

    public function setUp()
    {
        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'sh3rkan21@yahoo.com',
            'PHP_AUTH_PW' => 'parola111',
        ]);
        

        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function tearDown():void
    {
        parent::tearDown();
        $this->entityManager->close();    
        $this->entityManager = null; // avoid memory leaks   
    }

}