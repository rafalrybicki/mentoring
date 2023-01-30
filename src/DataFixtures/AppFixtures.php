<?php

namespace App\DataFixtures;

use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use App\Factory\QuizFactory;
use App\Factory\QuizQuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        QuestionFactory::createMany(20);
        // QuestionFactory::createMany(20, ['answers' => AnswerFactory::new()->many(2, 4)]);

        QuizFactory::createMany(5);
        // QuizFactory::createMany(5, ['quiz_questions' => QuizQuestionFactory::new()->many(5, 10)]);
    }
}
