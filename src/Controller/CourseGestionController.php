<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CourseGestion\Course;
use App\Form\AddCourseType;

class CourseGestionController extends AbstractController
{
    #[Route('/course/addCourse', name: 'addcourse')]
    public function addcourse(Request $req, ManagerRegistry $doctrine): Response
    {
        $course=new Course();
        $form=$this->createForm(AddCourseType::class,$course);

        $form->handleRequest($req);
        if ($form->isSubmitted()){
        $manager=$doctrine->getManager();
        $manager->persist($course);
        $manager->flush();
        return $this->redirectToRoute("addcourse");
        }
        //renvoyer le form vers la vue
      //  return $this->render("author/add.html.twig", ["myForm"=>$form->createView()]);
        return $this->renderForm("course_gestion/addCourse.twig", ["add_course"=>$form]);
    }
    #[Route('/course/show', name: 'show',defaults:["User"=>0])]
    public function show_list_courses($User,ManagerRegistry $doctrine,Request $request) :Response {
            $repository=$doctrine->getRepository(Course::class);
            $courses=$repository->findAll();
            //*
            if($courses)
                return $this->render("/course_gestion/showCourse.twig",
                ["User"=>$User,"courses"=>$courses]
        );
        else throw $this->createNotFoundException("error courses not found");//*/
    }
    #[Route('/course/show_user', name: 'specific_course_user')]
    public function specific_courses_user(ManagerRegistry $doctrine,Request $request) :Response {
            $repository=$doctrine->getRepository(Course::class);
            $courses=$repository->findAll();
            if($courses)
                return $this->render("/course_gestion/showCourse.twig",
            ["request"=>$request]
        );
        else throw $this->createNotFoundException("error courses not found");
    }

}