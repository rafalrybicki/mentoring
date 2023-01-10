<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $question = new Question();
        $question->setContent('**bold** question');

        $question2 = new Question();
        $question2->setContent('another question');

        $manager->persist($question);
        $manager->persist($question2);

        $manager->flush();
    }
}
