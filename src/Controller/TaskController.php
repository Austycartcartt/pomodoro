<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Task;

#[Route('/tasks')]
class TaskController extends AbstractController
{
    #[Route('/', name: 'task_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $tasks = $entityManager->getRepository(Task::class)->findAll();
        $data = $serializer->serialize($tasks, 'json', ['groups' => 'task']);

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'task_show', methods: ['GET'])]
    public function show(EntityManagerInterface $entityManager, Task $task, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($task, 'json', ['groups' => 'task']);

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/', name: 'task_create', methods: ['POST'])]
    public function create(EntityManagerInterface $entityManager, Request $request, SerializerInterface $serializer): Response
    {
        $data = json_decode($request->getContent(), true);
        $task = new Task();
        $task->setName($data['name']); // Assuming 'name' is the field name

        $entityManager->persist($task);
        $entityManager->flush();

        $serializedTask = $serializer->serialize($task, 'json', ['groups' => 'task']);

        return new Response($serializedTask, Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'task_update', methods: ['PUT'])]
    public function update(EntityManagerInterface $entityManager, Request $request, Task $task, SerializerInterface $serializer): Response
    {
        $data = json_decode($request->getContent(), true);
        $task->setName($data['name']); // Assuming 'name' is the field name

        $entityManager->flush();

        $serializedTask = $serializer->serialize($task, 'json', ['groups' => 'task']);

        return new Response($serializedTask, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'task_delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, Task $task): Response
    {
        $entityManager->remove($task);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}

