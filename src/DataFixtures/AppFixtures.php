<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $answer1 = new Answer();
        $answer1->setContent('answer 1');
        $answer1->setIsCorrect(true);

        $answer2 = new Answer();
        $answer2->setContent('answer 2');

        $question1 = new Question();
        $question1->setContent('**bold** question');
        $question1->addAnswer($answer1);
        $question1->addAnswer($answer2);

        $answer3 = new Answer();
        $answer3->setContent('answer 1');

        $answer4 = new Answer();
        $answer4->setContent('answer 2');
        $answer4->setIsCorrect(true);

        $answer5 = new Answer();
        $answer5->setContent('answer 3');

        $question2 = new Question();
        $question2->setContent('another question');
        $question2->addAnswer($answer3);
        $question2->addAnswer($answer4);
        $question2->addAnswer($answer5);

        $manager->persist($question1);
        $manager->persist($question2);

        $manager->flush();
    }
}
