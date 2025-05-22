<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(
        ManagerRegistry $doctrine,
        LibraryRepository $libraryRepository
    ): Response {
        if (!$libraryRepository->findAll()) {
            $entityManager = $doctrine->getManager();

            $book1 = new Library();

            $book1->setTitle('Don Quixote');
            $book1->setIsbn('9780060188702');
            $book1->setAuthor('Miguel Cervantes');
            $book1->setImgLink('don_quixote.jpg');
            $book1->setDetails('Berättelsen om Riddaren av den sorgliga skepnaden, hans trogne vapendragare Sancho Panza och hans älskade Dulcinea av Toboso har trollbundit läsare världen över ända sedan den först utkom i början av 1600-talet. Drömmaren och romantikern Don Quijote symboliserar kungamaktens utopiska ideal, medan Sancho Panza är realisten, den vanliga människan, som försöker klara sig så gott han kan under rådande förhållanden.');

            $entityManager->persist($book1);

            $book2 = new Library();

            $book2->setTitle('Good Night, Mr. Tom');
            $book2->setIsbn('9780062899958');
            $book2->setAuthor('Michelle Magorian');
            $book2->setImgLink('goodnight.jpg');
            $book2->setDetails('Under andra världskriget i England blir barn från London utplacerade på landsbygden. Åttaårige William får flytta in hos Tom, en gammal enstöring. Till en början är William en rädd liten pojke, rädd att bli misshandlad av den nya främmande mannen, såsom Williams egen mor gjorde. Allt Tom ser är en rädd liten pojke, men allt eftersom tiden går utvecklar de båda en underlig, men även stark vänskap. William växer i både kropp och sinne. Han får vänner i form av hund och människa.');

            $entityManager->persist($book2);

            $book3 = new Library();

            $book3->setTitle('Jane Eyre');
            $book3->setIsbn('9780571337095');
            $book3->setAuthor('Charlotte Brontë');
            $book3->setImgLink('janeeyre.jpeg');
            $book3->setDetails('Jane Eyre är en av den brittiska litteraturens stora klassiker och skildrar en föräldralös prästdotters uppväxt och liv som kvinna. Av central betydelse är huvudpersonens försök att skapa en självständighet som möter motstånd i samhället, i religionen men även i henne själv då hon träffar mannen i sitt liv, Mr Rochester på Thornfield, som fastän han är hennes kärlek förblir en främling.');



            // tell Doctrine you want to (eventually) save the book3
            // (no queries yet)
            $entityManager->persist($book3);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        }

        $routes = [
            'Alla böcker' => 'library_read_many',
            'Lägg till ny bok' => 'library_create'
        ];

        $data = [
            'routes' => $routes,
        ];

        return $this->render('library/index.html.twig', $data);
    }

    #[Route('/library/create', name: 'library_create', methods: ['GET'])]
    public function createBook(): Response
    {
        return $this->render('library/create.html.twig');
    }


    #[Route("library/create", name: "library_create_post", methods: ['POST'])]
    public function createBookPost(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        $title = $request->request->get('title');
        $author = $request->request->get('author');
        $isbn = $request->request->get('isbn');
        $imageLink = $request->request->get('imageLink');
        $details = $request->request->get('details');

        $library = new Library();

        $library->setTitle((string)$title);
        $library->setIsbn((string)$isbn);
        $library->setAuthor((string)$author);
        $library->setImgLink((string)$imageLink);
        $library->setDetails((string)$details);

        $entityManager->persist($library);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('library_read_many');
    }

    #[Route('/library/update/{id}', name: 'library_update', methods: ['GET'])]
    public function updateLibrary(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository->find($id);

        $data = [
            "book" => $book
        ];

        return $this->render('library/update.html.twig', $data);
    }

    #[Route('/library/update', name: 'library_update_post', methods: ['POST'])]
    public function updateLibraryPost(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        $entityManager = $doctrine->getManager();

        $id = $request->request->get('id');
        $title = $request->request->get('title');
        $author = $request->request->get('author');
        $isbn = $request->request->get('isbn');
        $imageLink = $request->request->get('imageLink');
        $details = $request->request->get('details');


        $book = $entityManager->getRepository(Library::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $book->setTitle((string)$title);
        $book->setAuthor((string)$author);
        $book->setIsbn((string)$isbn);
        $book->setImgLink((string)$imageLink);
        $book->setDetails((string)$details);

        $entityManager->persist($book);

        $entityManager->flush();

        return $this->redirect('/library/book/'.$id);
    }

    #[Route('/library/view', name: 'library_read_many')]
    public function viewAllProduct(
        LibraryRepository $libraryRepository
    ): Response {
        $library = $libraryRepository->findAll();

        $data = [
            'library' => $library
        ];

        return $this->render('library/view_all.html.twig', $data);
    }

    #[Route('/library/book/{id}', name: 'library_read_one')]
    public function viewOneProduct(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository->find($id);

        $data = [
            'book' => $book
        ];

        return $this->render('library/view_one.html.twig', $data);
    }

    #[Route('/library/delete/{id}', name: 'library_delete')]
    public function deleteLibraryById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $entityManager->getRepository(library::class)->find($id);

        if (!$library) {
            throw $this->createNotFoundException(
                'No library found for id '.$id
            );
        }

        $entityManager->remove($library);
        $entityManager->flush();

        return $this->redirectToRoute('library_read_many');
    }

    #[Route('/library/reset', name: 'library_reset')]
    public function libraryReset(
        ManagerRegistry $doctrine,
        LibraryRepository $libraryRepository
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $libraryRepository->findAll();

        foreach ($library as $book) {
            $entityManager->remove($book);
        }
        $entityManager->flush();

        $book1 = new Library();

        $book1->setTitle('Don Quixote');
        $book1->setIsbn('9780060188702');
        $book1->setAuthor('Miguel Cervantes');
        $book1->setImgLink('don_quixote.jpg');
        $book1->setDetails('Berättelsen om Riddaren av den sorgliga skepnaden, hans trogne vapendragare Sancho Panza och hans älskade Dulcinea av Toboso har trollbundit läsare världen över ända sedan den först utkom i början av 1600-talet. Drömmaren och romantikern Don Quijote symboliserar kungamaktens utopiska ideal, medan Sancho Panza är realisten, den vanliga människan, som försöker klara sig så gott han kan under rådande förhållanden.');

        $entityManager->persist($book1);

        $book2 = new Library();

        $book2->setTitle('Good Night, Mr. Tom');
        $book2->setIsbn('9780062899958');
        $book2->setAuthor('Michelle Magorian');
        $book2->setImgLink('goodnight.jpg');
        $book2->setDetails('Under andra världskriget i England blir barn från London utplacerade på landsbygden. Åttaårige William får flytta in hos Tom, en gammal enstöring. Till en början är William en rädd liten pojke, rädd att bli misshandlad av den nya främmande mannen, såsom Williams egen mor gjorde. Allt Tom ser är en rädd liten pojke, men allt eftersom tiden går utvecklar de båda en underlig, men även stark vänskap. William växer i både kropp och sinne. Han får vänner i form av hund och människa.');

        $entityManager->persist($book2);

        $book3 = new Library();

        $book3->setTitle('Jane Eyre');
        $book3->setIsbn('9780571337095');
        $book3->setAuthor('Charlotte Brontë');
        $book3->setImgLink('janeeyre.jpeg');
        $book3->setDetails('Jane Eyre är en av den brittiska litteraturens stora klassiker och skildrar en föräldralös prästdotters uppväxt och liv som kvinna. Av central betydelse är huvudpersonens försök att skapa en självständighet som möter motstånd i samhället, i religionen men även i henne själv då hon träffar mannen i sitt liv, Mr Rochester på Thornfield, som fastän han är hennes kärlek förblir en främling.');



        // tell Doctrine you want to (eventually) save the book3
        // (no queries yet)
        $entityManager->persist($book3);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('library_read_many');
    }
}
