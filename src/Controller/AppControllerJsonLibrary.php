<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AppControllerJsonLibrary extends AbstractController
{
    #[Route('api/library/books', name: 'library_show_all_api')]
    public function showAllBooksApi(
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
            $book1->setDetails('Don Quijote är en av världens mest lästa och älskade klassiker. Berättelsen om Riddaren av den sorgliga skepnaden, hans trogne vapendragare Sancho Panza och hans älskade Dulcinea av Toboso har trollbundit läsare världen över ända sedan den först utkom i början av 1600-talet. Romanen kan läsas som en äventyrsroman, med både komiska och tragiska inslag, men också som en allegori över dåtidens Spanien. Drömmaren och romantikern Don Quijote symboliserar kungamaktens utopiska ideal, medan Sancho Panza är realisten, den vanliga människan, som försöker klara sig så gott han kan under rådande förhållanden. För den här boken belönades Jens Nordenhök av Kungl. Vetenskapsakademien med Letterstedtska priset för översättningar. Han har även erhållit Svenska Akademiens översättarpris.');

            $entityManager->persist($book1);

            $book2 = new Library();

            $book2->setTitle('Good Night, Mr. Tom');
            $book2->setIsbn('9780062899958');
            $book2->setAuthor('Michelle Magorian');
            $book2->setImgLink('goodnight.jpg');
            $book2->setDetails('Under andra världskriget i England blir barn från London utplacerade på landsbygden. Åttaårige William får flytta in hos Tom, en gammal enstöring. Till en början är William en rädd liten pojke, rädd att bli misshandlad av den nya främmande mannen, såsom Williams egen mor gjorde. Allt Tom ser är en rädd liten pojke, men allt eftersom tiden går utvecklar de båda en underlig, men även stark vänskap. William växer i både kropp och sinne. Han får vänner i form av hund och människa. En dag skriver Williams mamma och tar honom tillbaka till sig i London, William lovar att skriva till Tom, men när inga brev kommer så bestämmer sig Tom för att åka och leta efter honom.');

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


        $library = $libraryRepository->findAll();

        $response = $this->json($library);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('api/library/books/{isbn}', name: 'library_search_by_isbn_api', methods: ['GET'])]
    public function searchByIsbnApi(
        ManagerRegistry $doctrine,
        LibraryRepository $libraryRepository,
        int $isbn
    ): Response {
        $entityManager = $doctrine->getManager();
        if (!$libraryRepository->findAll()) {

            $book1 = new Library();

            $book1->setTitle('Don Quixote');
            $book1->setIsbn('9780060188702');
            $book1->setAuthor('Miguel Cervantes');
            $book1->setImgLink('don_quixote.jpg');
            $book1->setDetails('Don Quijote är en av världens mest lästa och älskade klassiker. Berättelsen om Riddaren av den sorgliga skepnaden, hans trogne vapendragare Sancho Panza och hans älskade Dulcinea av Toboso har trollbundit läsare världen över ända sedan den först utkom i början av 1600-talet. Romanen kan läsas som en äventyrsroman, med både komiska och tragiska inslag, men också som en allegori över dåtidens Spanien. Drömmaren och romantikern Don Quijote symboliserar kungamaktens utopiska ideal, medan Sancho Panza är realisten, den vanliga människan, som försöker klara sig så gott han kan under rådande förhållanden. För den här boken belönades Jens Nordenhök av Kungl. Vetenskapsakademien med Letterstedtska priset för översättningar. Han har även erhållit Svenska Akademiens översättarpris.');

            $entityManager->persist($book1);

            $book2 = new Library();

            $book2->setTitle('Good Night, Mr. Tom');
            $book2->setIsbn('9780062899958');
            $book2->setAuthor('Michelle Magorian');
            $book2->setImgLink('goodnight.jpg');
            $book2->setDetails('Under andra världskriget i England blir barn från London utplacerade på landsbygden. Åttaårige William får flytta in hos Tom, en gammal enstöring. Till en början är William en rädd liten pojke, rädd att bli misshandlad av den nya främmande mannen, såsom Williams egen mor gjorde. Allt Tom ser är en rädd liten pojke, men allt eftersom tiden går utvecklar de båda en underlig, men även stark vänskap. William växer i både kropp och sinne. Han får vänner i form av hund och människa. En dag skriver Williams mamma och tar honom tillbaka till sig i London, William lovar att skriva till Tom, men när inga brev kommer så bestämmer sig Tom för att åka och leta efter honom.');

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

        $book = $entityManager->getRepository(Library::class)->findBy(['isbn' => $isbn]);


        $response = $this->json($book);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
