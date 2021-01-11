<?php

namespace App\Tests\Utils;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Twig\AppExtension;

class CategoryTest extends KernelTestCase
{

    protected $mockedCategoryTreeFrontPage;
    


    protected function setUp()
    {
        $kernel = self::bootKernel();
        $urlgenerator = $kernel->getContainer()->get('router');
        $tested_classes = [
            'CategoryTreeFrontPage',
        ];

        foreach ($tested_classes as $class)
        {
            $name = 'mocked' . $class;
            $this->$name = $this->getMockBuilder
            ('App\Utils\\' . $class)
            ->disableOriginalConstructor()
            ->setMethods() // daca nu, toate metodele vor returna null pana faci mocked
            ->getMock();
            $this->$name->urlgenerator = $urlgenerator;
            
        }
       
    }

    /**
     * @dataProvider dataForCategoryTreeFrontPage
     */

    public function testCategoryTreeFrontPage($string, $array, $id)
    {
        $this->mockedCategoryTreeFrontPage->categoriesArrayFromDb = $array;
        $this->mockedCategoryTreeFrontPage->slugger = new AppExtension;
        $main_parent_id = $this->mockedCategoryTreeFrontPage->getMainParent($id)['id'];
        $array = $this->mockedCategoryTreeFrontPage->buildTree($main_parent_id);
        $this->assertSame($string, $this->mockedCategoryTreeFrontPage->getCategoryList($array));
    }


    public function dataForCategoryTreeFrontPage()
    {
        yield [
        '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
         [ 
            ["id" => "1","parent_id" => null,"name" => "Electronic"],
            ["id" => "2","parent_id" => null,"name" => "Toys"],
            ["id" => "3", "parent_id" => null,"name" => "Books"],
            ["id" => "4","parent_id" => null,"name" => "Movies"],
            ["id" => "5","parent_id" => "1","name" => "Cameras"],
            ["id" => "6","parent_id" => "1", "name" => "Computers"],
            [ "id" => "7","parent_id" => "1","name" => "Cell Phones"],
            [ "id" => "8","parent_id" => "6", "name" => "Laptops"],
            [ "id" => "9","parent_id" => "6","name" => "Desktops"]           
        ],
        
        1
    ];

    yield [
        '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
         [ 
            ["id" => "1","parent_id" => null,"name" => "Electronic"],
            ["id" => "2","parent_id" => null,"name" => "Toys"],
            ["id" => "3", "parent_id" => null,"name" => "Books"],
            ["id" => "4","parent_id" => null,"name" => "Movies"],
            ["id" => "5","parent_id" => "1","name" => "Cameras"],
            ["id" => "6","parent_id" => "1", "name" => "Computers"],
            [ "id" => "7","parent_id" => "1","name" => "Cell Phones"],
            [ "id" => "8","parent_id" => "6", "name" => "Laptops"],
            [ "id" => "9","parent_id" => "6","name" => "Desktops"]           
        ],
        
        5
    ];
    yield [
        '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
         [ 
            ["id" => "1","parent_id" => null,"name" => "Electronic"],
            ["id" => "2","parent_id" => null,"name" => "Toys"],
            ["id" => "3", "parent_id" => null,"name" => "Books"],
            ["id" => "4","parent_id" => null,"name" => "Movies"],
            ["id" => "5","parent_id" => "1","name" => "Cameras"],
            ["id" => "6","parent_id" => "1", "name" => "Computers"],
            [ "id" => "7","parent_id" => "1","name" => "Cell Phones"],
            [ "id" => "8","parent_id" => "6", "name" => "Laptops"],
            [ "id" => "9","parent_id" => "6","name" => "Desktops"]           
        ],
        
        6
    ];
    yield [
        '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
         [ 
            ["id" => "1","parent_id" => null,"name" => "Electronic"],
            ["id" => "2","parent_id" => null,"name" => "Toys"],
            ["id" => "3", "parent_id" => null,"name" => "Books"],
            ["id" => "4","parent_id" => null,"name" => "Movies"],
            ["id" => "5","parent_id" => "1","name" => "Cameras"],
            ["id" => "6","parent_id" => "1", "name" => "Computers"],
            [ "id" => "7","parent_id" => "1","name" => "Cell Phones"],
            [ "id" => "8","parent_id" => "6", "name" => "Laptops"],
            [ "id" => "9","parent_id" => "6","name" => "Desktops"]           
        ],
        
        7
    ];
    yield [
        '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
         [ 
            ["id" => "1","parent_id" => null,"name" => "Electronic"],
            ["id" => "2","parent_id" => null,"name" => "Toys"],
            ["id" => "3", "parent_id" => null,"name" => "Books"],
            ["id" => "4","parent_id" => null,"name" => "Movies"],
            ["id" => "5","parent_id" => "1","name" => "Cameras"],
            ["id" => "6","parent_id" => "1", "name" => "Computers"],
            [ "id" => "7","parent_id" => "1","name" => "Cell Phones"],
            [ "id" => "8","parent_id" => "6", "name" => "Laptops"],
            [ "id" => "9","parent_id" => "6","name" => "Desktops"]           
        ],
        
        8
    ];
    yield [
        '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
         [ 
            ["id" => "1","parent_id" => null,"name" => "Electronic"],
            ["id" => "2","parent_id" => null,"name" => "Toys"],
            ["id" => "3", "parent_id" => null,"name" => "Books"],
            ["id" => "4","parent_id" => null,"name" => "Movies"],
            ["id" => "5","parent_id" => "1","name" => "Cameras"],
            ["id" => "6","parent_id" => "1", "name" => "Computers"],
            [ "id" => "7","parent_id" => "1","name" => "Cell Phones"],
            [ "id" => "8","parent_id" => "6", "name" => "Laptops"],
            [ "id" => "9","parent_id" => "6","name" => "Desktops"]           
        ],
        
        9
    ];

    }

}
