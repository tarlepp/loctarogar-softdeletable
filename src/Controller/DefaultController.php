<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     *
     * @param Request        $request
     * @param BookRepository $bookRepository
     *
     * @return Response
     */
    public function index(Request $request, BookRepository $bookRepository): Response
    {
        $order = $request->get('order');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'books' => $bookRepository->findAllOrdered($order),
            'url' => $this->generateUrl('default'),
        ]);
    }

    /**
     * @Route("/create", name="add")
     *
     * @param \App\Repository\BookRepository $bookRepository
     *
     * @return RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(BookRepository $bookRepository): RedirectResponse
    {
        $faker = \Faker\Factory::create();

        $bookRepository->create((new Book())->setName($faker->name));

        return $this->redirect($this->generateUrl('default'));
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @ParamConverter("book", class="App\Entity\Book")
     *
     * @param Book           $book
     * @param BookRepository $bookRepository
     *
     * @return RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Book $book, BookRepository $bookRepository): RedirectResponse
    {
        $bookRepository->delete($book);

        return $this->redirect($this->generateUrl('default'));
    }
}
