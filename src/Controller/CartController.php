<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart")
     */
    public function index(): Response
    {
        $ids = $this->get('session')->get('cart');
        if (!is_array($ids))
        {
            $ids = array();
        }
        $rooms = $this->getDoctrine()->getRepository('App:Room')->findById($ids);
        return $this->render('cart/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * @Route("/add/{id}", name="cart_add", requirements={ "id": "\d+"}, methods={"GET"})
     */
    public function add(int $id): Response
    {
        $rooms = $this->get('session')->get('cart');
        if (!is_array($rooms))
        {
            $rooms = array();
        }
        if (!in_array($id, $rooms))
        {
            $rooms[] = $id;
            $this->get('session')->set('cart', $rooms);
        }
        return $this->redirectToRoute('cart', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/remove/{id}", name="cart_remove", requirements={ "id": "\d+"}, methods={"GET"})
     */
    public function remove(int $id): Response
    {
        $rooms = $this->get('session')->get('cart');
        if (is_array($rooms) && in_array($id, $rooms))
        {
            $this->get('session')->set('cart', array_diff($rooms, array($id)));
        }
        return $this->redirectToRoute('cart', [], Response::HTTP_SEE_OTHER);
    }
}
