<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $answers = "- [x] Write the press release \n";
        $answers .= "- [ ] Update the website \n";
        $answers .= "- [ ] Contact the media";

        $question = new Question();
        $question->setContent('**bold** question');
        $question->setAnswers($answers);

        $question2 = new Question();
        $question2->setContent('another question');
        $question2->setAnswers($answers);

        $manager->persist($question);
        $manager->persist($question2);

        $manager->flush();
    }
}
