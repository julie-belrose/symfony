<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/events', name: 'api_events_')]
class ApiEventController extends AbstractController
{
    private array $events = [
        [
            'id' => 1,
            'title' => 'Concert',
            'location' => 'Lyon',
            'date' => '2025-06-01',
            'isPublic' => true
        ],

        [
            'id' => 2,
            'title' => 'Meetup',
            'location' => 'Paris',
            'date' => '2025-07-15',
            'isPublic' => false
        ],
        [
            'id' => 3,
            'title' => 'Symfony Meetup',
            'location' => 'Paris',
            'date' => '2025-06-01 18:00:00',
            'isPublic' => true
        ],
        [
            'id' => 4,
            'title' => 'Angular Workshop',
            'location' => 'Lyon',
            'date' => '2025-07-15 10:00:00',
            'isPublic' => false
        ],
    ];

    #[Route('', name: 'list', methods: ['GET'])]
    public function listEvents(Request $request): JsonResponse
    {
        $location = $request->query->get('location'); // events?location=Paris

        if ($location) {
            $filtered = array_filter($this->events, fn($event) => $event['location'] === $location);
            return new JsonResponse(array_values($filtered));
        }

        return new JsonResponse($this->events);
    }

    #[Route('/public', name: 'public_list', methods: ['GET'])]
    public function listPublicEvents(): JsonResponse
    {
        return new JsonResponse(array_values($this->events));
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function showEvent(int $id): JsonResponse
    {
        return isset($this->events[$id])
        ? new JsonResponse($this->events[$id], Response::HTTP_OK)
        : new JsonResponse(['error' => 'event not found'], Response::HTTP_NOT_FOUND);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function createEvent(Request $request): JsonResponse
    {
         $data = json_decode($request->getContent(), true);
         $data['id']= rand(100, 900);

        return new JsonResponse([
            'message' => 'Event add',
            'event' => $data],
            Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function updateEvent(int $id, Request $request): JsonResponse
    {
        // TODO: Implement event update and refresh event list
        $data = json_decode($request->getContent(), true);
        $data['id']= $id;

        return new JsonResponse([
            'message' => "Event $id update",
            'event' => $data
        ], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteEvent(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => "Event $id delete",
        ],Response::HTTP_NO_CONTENT);
    }
}
