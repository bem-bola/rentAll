<?php

namespace App\Controller;

use App\Service\HttpClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/item', name: 'app_item_')]
class ItemController extends AbstractController
{
    #[Route('/view/{slug}', name: 'view')]
    public function view(string $slug, HttpClientService $httpClientService): Response
    {
        $data = [
            [
                'image' => 'https://picsum.photos/300/300',
                'title' => 'img-1'
            ],
            [
                'image' => 'https://picsum.photos/700/300',
                'title' => 'img-3'
            ],
            [
                'image' => 'https://picsum.photos/400/300',
                'title' => 'img-2'
            ],
            [
                'image' => 'https://picsum.photos/600/450',
                'title' => 'img-4'
            ],
            [
                'image' => 'https://picsum.photos/700/300',
                'title' => 'img-3'
            ],
            [
                'image' => 'https://picsum.photos/400/600',
                'title' => 'img-4'
            ],
            [
                'image' => 'https://picsum.photos/700/300',
                'title' => 'img-3'
            ],

        ];

        $ville = 'Cergy';
        $coordonates = $httpClientService->request(
            sprintf($this->getParameter('urlNominatim'), urlencode($ville)),
            ['User-Agent' =>  $this->getParameter('nameProject')]

        );


        return $this->render('item/view.html.twig', [
            'datas' => $data,
            'coordonates' => !empty($coordonates) ? $coordonates[0] : [],

        ]);
    }
}
