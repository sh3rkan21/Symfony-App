<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Video;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach($this->CommentData() as [$content, $user, $video, $created_at])

        {
            $comment = new Comment;
            $user = $manager->getRepository(User::class)->find($user);
            $video = $manager->getRepository(Video::class)->find($video);

            $comment->setContent($content);
            $comment->setUser($user);
            $comment->setVideo($video);
            $comment->setCreatedAtForFixtures(new \DateTime($created_at));

            $manager->persist($comment);

        }

        $manager->flush();
    }

    private function CommentData()
    {
        return [
            ['Commetariu 1', 1, 10, '2020-01-23 23:34:34'],
            ['Commetariu 2', 2, 1, '2020-01-23 23:34:34'],
            ['Commetariu 3', 2, 12, '2020-01-23 23:34:34'],
            ['Commetariu 4', 3, 13, '2020-01-23 23:34:34'],
        ];
    }

    public function getDependencies()
    {
        return array(UserFixtures::class);
    }
}
