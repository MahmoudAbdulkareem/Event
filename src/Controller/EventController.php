<?php

namespace App\Controller;
use App\Form\EventType;
use App\Entity\EventGestion\Event;
use App\Repository\EventGestion\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/Event', name: 'a_event')]
    public function index(): Response
    {
        return $this->render('home/home.twig', [
            'controller_name' => 'EventController',
        ]);
    }
    #[Route('/showEvent/{name}', name: 'app_showEvent')]

    public function showEvent ($name)
    {
        return $this->render('Event/show.html.twig',['n'=>$name]);

    }
  
    #[Route('/eventDetails/{id}', name: 'app_EventDetails')]

    public function eventDetails»($id)
    {
        $Event = [
            'id' => $id,
            'name' => 'name',
            'location' => 'location',
            'type' => 'type',
            'details' => 'details',
            'city' => 'city',
        ];

        return $this->render("Event/showEvent.html.twig",['Event'=>$Event]);
        }


    #[Route('/Affiche', name: 'app_Affiche')]
    public function Affiche (EventRepository $repository)
        {
            $Event=$repository->findAll() ; //select *
            return $this->render('EventGestion/showEvent.twig',['events'=>$Event]);
        }

    
    
#[Route('/Add', name: 'app_Add')]

public function  Addevent(Request  $request)
{
    $Event=new Event();
    $form =$this->CreateForm(EventType::class,$Event);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
        $em=$this->getDoctrine()->getManager();
        $em->persist($Event);
        $em->flush();
        return $this->redirectToRoute('app_Affiche');
    }
    return $this->render('EventGestion/addEvent.twig',['Event'=>$form->createView()]);

}
#[Route('/edit/{id}', name: 'app_editevent')]
public function editevent(EventRepository $repository, $id, Request $request)
{
    $event = $repository->find($id);
    $form = $this->createForm(EventType::class, $event);
    $form->add('Edit', SubmitType::class);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->flush(); // Save changes to the database
        return $this->redirectToRoute("app_Affiche");
    }

    return $this->render('EventGestion/editEvent.twig', [
        'event' => $event, // Pass the event object instead of the form view
        'form' => $form->createView(), // Pass the form view separately if needed in the template
    ]);
}


    #[Route('/delete_event/{id}', name: 'app_delete')]
    public function deleteevent($id, EventRepository $repository)
    {
        $Event = $repository->find($id);

        if (!$Event) {
            throw $this->createNotFoundException('Event non trouvé');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($Event);
        $em->flush();

        
        return $this->redirectToRoute('app_Affiche');
    } 

}