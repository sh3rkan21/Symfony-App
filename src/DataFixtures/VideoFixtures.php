<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Video;
use App\Entity\Category;

class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach($this->VideoData() as [$title, $path, $category_id])
        {
            $duration = random_int(10,300);
            $category = $manager->getRepository(Category::class)->find($category_id);
            $video = new Video();
            $video->setTitle($title);
            $video->setPath('https://player.vimeo.com/video/'.$path);
            $video->setCategory($category);
            $video->setDuration($duration);
            $manager->persist($video);
        }

        $manager->flush();
    }

    private function VideoData()
    {
        return [

            ['Electronic 1',289729765,1],
            ['Electronic 2',238902809,1],
            ['Electronic 3',150870038,1],
            ['Electronic 4',219727723,1],
            ['Electronic 5',289879647,1],
            ['Electronic 6',261379936,1],
            ['Electronic 7',289029793,1],
            ['Electronic 8',60594348,1],
            ['Electronic 9',290253648,1],
            
            
            ['Toys  1',289729765,2],
            ['Toys  2',289729765,2],
            ['Toys  3',289729765,2],
            ['Toys  4',289729765,2],
            ['Toys  5',289729765,2],
            ['Toys  6',289729765,2],
            
            ['Books 1',289729765,3],
            ['Books 2',289729765,3],
            ['Books 3',289729765,3],
            
            ['Movies 1',289729765,4],
            ['Movies 2',289729765,4],
            ['Movies 3',289729765,4],
        ];
    }
}

