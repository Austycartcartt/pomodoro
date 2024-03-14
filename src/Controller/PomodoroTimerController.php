<?php
namespace App\Controller;

use App\Entity\PomodoroTimer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/pomodoro-timers')]
class PomodoroTimerController extends AbstractController
{
    #[Route('/', name: 'pomodoro_timer_index', methods: ['GET'])]
    public function index(SerializerInterface $serializer): Response
    {
        $pomodoroTimers = $this->getDoctrine()->getRepository(PomodoroTimer::class)->findAll();
        $data = $serializer->serialize($pomodoroTimers, 'json');

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'pomodoro_timer_show', methods: ['GET'])]
    public function show(PomodoroTimer $pomodoroTimer, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($pomodoroTimer, 'json');

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/', name: 'pomodoro_timer_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $pomodoroTimer = $serializer->deserialize($data, PomodoroTimer::class, 'json');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pomodoroTimer);
        $entityManager->flush();

        $responseData = $serializer->serialize($pomodoroTimer, 'json');

        return new Response($responseData, Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'pomodoro_timer_update', methods: ['PUT'])]
    public function update(Request $request, PomodoroTimer $pomodoroTimer, SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $pomodoroTimer = $serializer->deserialize($data, PomodoroTimer::class, 'json');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $responseData = $serializer->serialize($pomodoroTimer, 'json');

        return new Response($responseData, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'pomodoro_timer_delete', methods: ['DELETE'])]
    public function delete(PomodoroTimer $pomodoroTimer): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($pomodoroTimer);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }}