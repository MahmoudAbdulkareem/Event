<?php

namespace App\Controller;

use App\Entity\CourseGestion\Course;
use App\Entity\OffreGestion\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class MenuCourseController extends AbstractController
{
    /*
    #[Route('/menu/course', name: 'menu_course')]
    public function index(ManagerRegistry $doctrine,Request $req): Response
    {
        return new Response
        (
        $this->renderView("Components/header.twig")
            .
        $this->renderView('menu_course/menu.twig', [
            'User'=>
                ["Courses"=>[
                    ["owner"=>"ahmed","Thumbnail"=>'menu_course/img/course-img1.png',"Categorie"=>"this is","Title"=>"Learn Python: The Complete Python Programming Course"],
                    ["owner"=>"mohsen","Thumbnail"=>'menu_course/img/course-img2.png',"Categorie"=>"a list","Title"=>"Learning Python for Data Analysis and Visualization Ver 1"],
                    ["owner"=>"yajri","Thumbnail"=>'menu_course/img/course-img3.png',"Categorie"=>"of","Title"=>"Python for Beginners - Learn Programming from scratch"],
                    ["owner"=>"tahta","Thumbnail"=>'menu_course/img/course-img4.png',"Categorie"=>"my courses","Title"=>"Learn Python: Python for Beginners"],
                    ["owner"=>"chajara","Thumbnail"=>'menu_course/img/course-img5.png',"Categorie"=>"s'Categories","Title"=>"Python From Scratch & Selenium WebDriver QA"],
                ]
                ]       ,
            ])
        );
        */
        #[Route('/menu/course/{User}', name: 'menu_course',defaults:["User"=>-1])]
        public function index($User,EntityManagerInterface $manager,Request $req): Response
        {
            $data= [
                'User'=>
                    ["Courses"=>[
                        ["owner"=>"ahmed","Thumbnail"=>'menu_course/img/course-img1.png',"Categorie"=>"this is","Title"=>"Learn Python: The Complete Python Programming Course"],
                        ["owner"=>"mohsen","Thumbnail"=>'menu_course/img/course-img2.png',"Categorie"=>"a list","Title"=>"Learning Python for Data Analysis and Visualization Ver 1"],
                        ["owner"=>"yajri","Thumbnail"=>'menu_course/img/course-img3.png',"Categorie"=>"of","Title"=>"Python for Beginners - Learn Programming from scratch"],
                        ["owner"=>"tahta","Thumbnail"=>'menu_course/img/course-img4.png',"Categorie"=>"my courses","Title"=>"Learn Python: Python for Beginners"],
                        ["owner"=>"chajara","Thumbnail"=>'menu_course/img/course-img5.png',"Categorie"=>"s'Categories","Title"=>"Python From Scratch & Selenium WebDriver QA"],
                    ]
                    ]       ,
                ];
            if($User>=0){
                    $repository=$manager->find(Course::class,20);
                    
            }

            return new Response
            (
            $this->renderView("Components/header.twig",["User"=>$User])
                .
            $this->renderView('menu_course/menu.twig',["User"=>$data["User"]])
            );
    }
}
