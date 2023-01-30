<?php

namespace App\Factory;

use App\Entity\QuizQuestion;
use App\Repository\QuizQuestionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<QuizQuestion>
 *
 * @method        QuizQuestion|Proxy create(array|callable $attributes = [])
 * @method static QuizQuestion|Proxy createOne(array $attributes = [])
 * @method static QuizQuestion|Proxy find(object|array|mixed $criteria)
 * @method static QuizQuestion|Proxy findOrCreate(array $attributes)
 * @method static QuizQuestion|Proxy first(string $sortedField = 'id')
 * @method static QuizQuestion|Proxy last(string $sortedField = 'id')
 * @method static QuizQuestion|Proxy random(array $attributes = [])
 * @method static QuizQuestion|Proxy randomOrCreate(array $attributes = [])
 * @method static QuizQuestionRepository|RepositoryProxy repository()
 * @method static QuizQuestion[]|Proxy[] all()
 * @method static QuizQuestion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static QuizQuestion[]|Proxy[] createSequence(array|callable $sequence)
 * @method static QuizQuestion[]|Proxy[] findBy(array $attributes)
 * @method static QuizQuestion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuizQuestion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class QuizQuestionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'question' => QuestionFactory::random(),
            'sequence' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(QuizQuestion $quizQuestion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return QuizQuestion::class;
    }
}
