<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Freelancer;
use MyFOSUserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Freelancer controller.
 *
 * @Route("freelancer")
 */
class FreelancerController extends Controller {

    public function getNationalite() {


        $nationalites = array(
            'France' => 'français',
            'Belgique' => 'belge',
            'Acores' => 'acores',
            'Afganistan' => 'afganistan',
            'Afrique du sud' => 'afriquedusud',
            'Albanie' => 'albanie',
            'Algerie' => 'algerie',
        );

        return $nationalites;
    }

    public function getTestFreelancer($idfreelancer) {
        $em = $this->getDoctrine()->getManager();
        $freelancer = array('freelancer' => $idfreelancer);
        $test = $em->getRepository('MyFOSUserBundle:Testfreelancer')->find($freelancer);
        return $test;
    }

    public function getTestCompetence($test) {
        
        $em = $this->getDoctrine()->getManager();
        $citere_id_test = array('idTest' => $test);
        $tests = $em->getRepository('MyFOSUserBundle:Test')->find($critere_id_test);
        
        $competence_test = array('competence' => $tests);
        $competence = $em->getRepository('MyFOSUserBundle:Testcompetence')->findBy($competence_test);

        return $competence;
    }

    /**
     * Lists all freelancer entities.
     *
     * @Route("/", name="freelancer_index")
     * @Method("GET")
     */
    public function indexAction() {
        
        $freelancer = new Freelancer();
        $em = $this->getDoctrine()->getManager();

        $freelancers = $em->getRepository('MyFOSUserBundle:Freelancer')->findAll();

        foreach ($freelancers as $freelancer) {
         //   $mestests = $this->getTestFreelancer($freelancer);
        }
        
        $competences = "aucune";
        
        if (isset($mestests)) {
            foreach ($mestests as $test) {
              //  $competences = array($test, $this->getTestCompetence($test));
            }
        } 

        if ($this->getUser()) {
            $arrayFreel = ["user" => $this->getUser()->getId()];
            $freel = $em->getRepository('MyFOSUserBundle:Freelancer')->findOneBy($arrayFreel);
            return $this->render('freelancer/index.html.twig', array(
                        'freel' => $freel,
                        'freelancers' => $freelancers
                   //     'competences' => $competences
            ));
        } else {
            return $this->render('freelancer/index.html.twig', array(
                        'freelancers' => $freelancers
                    //    'competences' => $competences
            ));
        }
    }

    /**
     * Creates a new freelancer entity.
     *
     * @Route("/new", name="freelancer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $freelancer = new Freelancer();

        // $pseudo=array($this->getUser()->getName() => $request->getUser() );

        $nationalites = $this->getNationalite();

        $form = $this->createFormBuilder($freelancer)
                ->add('description')
                ->add('cv', FileType::class, array(
                    'label' => 'Votre Cv : ',
                    'data_class' => null))
                ->add('photo', FileType::class, array(
                    'label' => 'Votre photo : ',
                    'data_class' => null))
                ->add('pseudo')
                ->add('nationalite', ChoiceType::class, array(
                    'choices' => $nationalites,
                    'label' => 'Pays'
                ))
                ->add('age')
                ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $freelancer->setUser($this->getUser());
            $freelancer->uploadPhoto();
            $freelancer->uploadCv();

            $em = $this->getDoctrine()->getManager();
            $em->persist($freelancer);
            $em->flush($freelancer);

            return $this->redirectToRoute('freelancer_show', array('id' => $freelancer->getId()));
        }

        return $this->render('freelancer/new.html.twig', array(
                    'freelancer' => $freelancer,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_show")
     * @Method("GET")
     */
    public function showAction(Request $request, Freelancer $freelancer) {

        $deleteForm = $this->createDeleteForm($freelancer);
        $em = $this->getDoctrine()->getManager();
     
/*
        // on recupere les tests qu'a passé le freelancer 
        $freelancerTests = $em->getRepository('MyFOSUserBundle:Testfreelancer')->findBy($myfreelancer);

        $critereTestid=array( 'test', $freelancerTests[0]);
        //on passe les ids des tests passés par le freelancer
           $idTest = $em->getRepository('MyFOSUserBundle:TestFreelancer')->findBy($critereTestid);
        // $user= $freelancer->getUser();
        
        
        
        // on récupére les informations des competences qui sont associées à tous ces tests
        $myfreelancerTestCompetence = array('test' => $idTest[0]);
        $freelancerCompetences = $em->getRepository('MyFOSUserBundle:Testcompetence')->findOneBy($myfreelancerTestCompetence);
*/
        return $this->render('freelancer/show.html.twig', array(
                    'freelancer' => $freelancer,
                    //   'user' => $user,
                //    'competencesFreelancer' => $freelancerCompetences,
               
                 //   'freelancerTests' => $freelancerTests,
                    'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing freelancer entity.
     *
     * @Route("/{id}/edit", name="freelancer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Freelancer $freelancer) {

        $pseudo = array($freelancer->getUser()->getName() => $request->getUser());

        $nationalites = $this->getNationalite();

        $deleteForm = $this->createDeleteForm($freelancer);

        $moncv = new UploadedFile($freelancer->getAbsoluteCvRoot(), $freelancer->getWebCvPath());
        $maphoto = new UploadedFile($freelancer->getAbsolutePhotoRoot(), $freelancer->getWebPhotoPath());

        $editForm = $this->createFormBuilder($freelancer)
                ->add('description')
                ->add('cv', FileType::class, array(
                    'label' => 'Votre Cv : ',
                    'required' => false,
                    'empty_data' => $moncv,
                    'data' => $moncv,
                    'data_class' => null))
                ->add('photo', FileType::class, array(
                    'label' => 'Votre photo : ',
                    'required' => false,
                    'empty_data' => $maphoto,
                    'data' => $maphoto,
                    'data_class' => null))
                ->add('pseudo')
                ->add('nationalite', ChoiceType::class, array(
                    'choices' => $nationalites,
                      'label' => 'Pays'
                ))
                ->add('age')
                ->getForm()
        ;

        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if ($freelancer->getPhoto() != $maphoto) {
                $freelancer->uploadPhoto();
            }

            if ($freelancer->getCv() != $moncv) {
                $freelancer->uploadCv();
            }

            $freelancer->setUser($freelancer->getUser());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('freelancer_show', array('id' => $freelancer->getId()));
        }



        return $this->render('freelancer/edit.html.twig', array(
                    'freelancer' => $freelancer,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a freelancer entity.
     *
     * @Route("/{id}", name="freelancer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Freelancer $freelancer) {
        $form = $this->createDeleteForm($freelancer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($freelancer);
            $em->flush($freelancer);
        }

        return $this->redirectToRoute('freelancer_index');
    }

    /**
     * Creates a form to delete a freelancer entity.
     *
     * @param Freelancer $freelancer The freelancer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Freelancer $freelancer) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('freelancer_delete', array('id' => $freelancer->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
