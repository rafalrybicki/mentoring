<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuestionRepository;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quizzes')]
class QuizController extends AbstractController
{
    public QuizRepository $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    #[Route('/', name: 'app_quiz_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizzes' => $this->quizRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quiz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionRepository $questionRepository): Response
    {
        $quiz = new Quiz();

        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        $selectedQuestions = implode(',', $quiz->getQuestionsIds());

        $availableQuestions = $questionRepository->findOthers($selectedQuestions);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->quizRepository->save($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/new.html.twig', [
            'form' => $form,
            'availableQuestions' => $availableQuestions,
            'existingQuestions' => []
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_show', methods: ['GET'])]
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quiz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quiz $quiz, QuestionRepository $questionRepository): Response
    {
        $existingQuestions = $quiz->getQuestionsIds();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        $selectedQuestions = implode(',', $quiz->getQuestionsIds());

        $availableQuestions = $questionRepository->findOthers($selectedQuestions);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->quizRepository->save($quiz, true);

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form,
            'availableQuestions' => $availableQuestions,
            'existingQuestions' => $existingQuestions
        ]);
    }

    #[Route('/{id}', name: 'app_quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz): Response
    {
        if (!$this->isCsrfTokenValid('quiz_delete' . $quiz->getId(), $request->request->get('_token'))) {
            throw $this->createAccessDeniedException("Incorrect token");
        }

        $this->quizRepository->remove($quiz, true);

        return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
    }
}
