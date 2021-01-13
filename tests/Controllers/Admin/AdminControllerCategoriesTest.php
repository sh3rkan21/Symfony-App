<?php

namespace App\Tests\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Category;
use App\Tests\Rollback;

class AdminControllerCategoriesTest extends WebTestCase
{

    use Rollback;

    public function testTextOnPage()
    {
        $crawler = $this->client->request('GET', '/admin/su/categories');
        $this->assertSame('Categories list', $crawler->filter('h2')->text());
       dump($this->assertContains('Electronic',$this->client->getResponse()->getContent())); 
    }

    public function testNumberOfItems()
    {
        $crawler = $this->client->request('GET', '/admin/su/categories');
        
        $this->assertCount(9, $crawler->filter('option'));
    }

    public function testNewCategory()
    {
        $crawler =  $this->client->request('GET', '/admin/su/categories');
        $form = $crawler->selectButton('Add')->form([
            'category[parent]' => 1,
            'category[name]' => 'Other Electronics',
        ]);
        $this->client->submit($form);
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'Other Electronics']);

        $this->assertNotNull($category);
        $this->assertSame('Other Electronics', $category->getName());
    }

    public function testEditCategory()
    {
        $crawler = $this->client->request('GET', '/admin/su/edit-category/1');
        $form = $crawler->selectButton('Save')->form([
            'category[parent]' => 0,
            'category[name]' => 'Electronics 2'
        ]);
        $this->client->submit($form);

        $category = $this->entityManager->getRepository(Category::class)->find(1);
        $this->assertSame('Electronics 2', $category->getName());
    }

    public function testDeleteCategory()
    {
        $crawler = $this->client->request('GET', '/admin/su/delete-category/1');
        $category = $this->entityManager->getRepository(Category::class)->find(1);

        $this->assertNull($category);    
    }
}
