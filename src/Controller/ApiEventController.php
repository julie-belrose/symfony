<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/events', name: 'api_events_')]
class ApiEventController extends AbstractController
{


    #[Route('', name: 'list', methods: ['GET'])]
    public function listEvents(Request $request): Response
    {
        // TODO: Implement list with optional location filter
    }

    #[Route('/public', name: 'public_list', methods: ['GET'])]
    public function listPublicEvents(): Response
    {
        // TODO: Implement public events listing
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function showEvent(int $id): Response
    {
        // TODO: Implement event detail
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function createEvent(Request $request): Response
    {
        // TODO: Implement event creation and refresh event list
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function updateEvent(int $id, Request $request): Response
    {
        // TODO: Implement event update and refresh event list
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteEvent(int $id): Response
    {
        // TODO: Implement event deletion and refresh event list
    }
}
