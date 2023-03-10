<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(
        max: 100,
    )]
    private ?string $content = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, cascade: ['persist'], orphanRemoval: true)]
    #[Assert\Count(
        min: 2,
        max: 4,
        minMessage: 'The question must contain 2 to 4 answers!',
        maxMessage: 'The question must contain 2 to 4 answers!',
    )]
    private Collection $answers;

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if (!$this->hasCorrectAnswers()) {
            $context->buildViolation('At least one answer must be correct!')
                ->addViolation();
        }
    }

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->addAnswer(new Answer());
        $this->addAnswer(new Answer());
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        $this->answers->removeElement($answer);

        return $this;
    }

    public function hasCorrectAnswers(): bool
    {
        return $this->getAnswers()->exists(
            fn ($key, Answer $answer) => $answer->isCorrect() == true
        );
    }
}
