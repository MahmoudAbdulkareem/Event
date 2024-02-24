<?php

namespace App\Controller;

use App\Entity\EventGestion\Competition;
use App\Entity\EventGestion\Event;
use App\Form\CompetitionType;
use App\Repository\EventGestion\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetitionController extends AbstractController
{
    #[Route('/competition', name: 'app_competition')]
    public function index(): Response
    {
        return $this->render('home/home.twig', [
            'controller_name' => 'CompetitionController',
        ]);
    }

    #[Route('/showCompetition/{name}', name: 'app_showCompetition')]
    public function showCompetition($name)
    {
        return $this->render('Competition/show.html.twig', ['n' => $name]);
    }

    #[Route('/competitionDetails/{id}', name: 'app_competitionDetails')]
    public function competitionDetails($id)
    {
        $competition = [
            'id' => $id,
            'name' => 'name',
            'location' => 'location',
            'description' => 'description',
            'group' => 'group',
        ];

        return $this->render("Competition/showCompetition.html.twig", ['competition' => $competition]);
    }

    #[Route('/affichecomp', name: 'app_affiche')]
    public function affiche(CompetitionRepository $repository)
    {
        $competitions = $repository->findAll();
        //dd($competitions);
        return $this->render('EventGestion/showCompetition.twig', ['comp' => $competitions]);
    }

    #[Route('/addcomp', name: 'app_add')]
    public function add(Request $request)
    {
        $competition = new Competition();
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            
            
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($competition);
            $em->flush();
            
            return $this->redirectToRoute('app_affiche');
        }
        
        return $this->render('EventGestion/addCompetition.twig', ['competition' => $form->createView()]);
    }

    #[Route('/edit-comp/{id}', name: 'app_editz')]
    public function edit(CompetitionRepository $repository, $id, Request $request)
    {
        $competition = $repository->find($id);
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->add('Edit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->redirectToRoute("app_affiche");
        }

        return $this->render('EventGestion/EditCompetition.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_del')]
    public function delete($id, CompetitionRepository $repository)
    {
        $competition = $repository->find($id);

        if (!$competition) {
            throw $this->createNotFoundException('Competition not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($competition);
        $em->flush();

        return $this->redirectToRoute('app_affiche');
    }
}
