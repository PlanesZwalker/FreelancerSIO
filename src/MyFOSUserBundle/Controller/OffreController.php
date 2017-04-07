<?php

namespace MyFOSUserBundle\Controller;

use MyFOSUserBundle\Entity\Offre;
use MyFOSUserBundle\Entity\Freelancer;
use MyFOSUserBundle\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
/**
 * Offre controller.
 *
 * @Route("offre")
 */
class OffreController extends Controller
{
    /**
     * Lists all offre entities.
     *
     * @Route("/", name="offre_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id_projet = $request->get('id');
        
        $criteria = ["projet"=>$id_projet];
        
        $offresById = $em->getRepository("MyFOSUserBundle:Offre")->findBy($criteria);
        $offres = $em->getRepository('MyFOSUserBundle:Offre')->findAll();
    
        return $this->render('offre/index.html.twig', array(
            'offres' => $offres,
            'offresById' => $offresById,
            'id_projet' => $id_projet
        ));
    }

    /**
     * Creates a new offre entity.
     *
     * @Route("/new", name="offre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $offre = new Offre();
        $freelancer = new Freelancer();
        $projet = new Projet();
        
        $em = $this->getDoctrine()->getManager();
        
        $id_projet=$request->get('id');
        $criteria = ["id" => $id_projet];
        $projet = $em->getRepository("MyFOSUserBundle:Projet")->findOneBy($criteria);
        
        $monIdfreelancer= ["user"=>$this->getUser()->getId()];
        $freelancer = $em->getRepository("MyFOSUserBundle:Freelancer")->findOneBy($monIdfreelancer);    
            
        $form = $this->createFormBuilder($offre)
                ->add('tarif', null, array(
                    'label'=> 'Tarif Horaire estimé'
                    )
                )
                ->add('delai', null, array(
                    'label'=> 'Durée estimée pour réaliser le projet'
                    )
                )
                ->add('particularite', TextareaType::class, array(
                    'label'=> 'Particularités'
                    )
                )
                ->add('proposition', CKEditorType::class, array(
                    'input_sync' => true,
                    'config' => array(
                        'uiColor' => '#020F58',
                    ),
                    'label' => 'Saisir la proposition commerciale ici: ',  
                  )) 
           
                ->getForm();
          
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $offre->setFreelancer($freelancer);
            $offre->setProjet($projet);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush($offre);

            return $this->redirectToRoute('offre_show', array('id' => $offre->getIdOffre()));
        }

        return $this->render('offre/new.html.twig', array(
            'offre' => $offre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a offre entity.
     *
     * @Route("/{id}", name="offre_show")
     * @Method("GET")
     */
    public function showAction(Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);
        $projet = new Projet();
        
        return $this->render('offre/show.html.twig', array(
            'offre' => $offre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing offre entity.
     *
     * @Route("/{id}/edit", name="offre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);
        $editForm = $this->createFormBuilder($offre)
               ->add('tarif', null, array(
                    'label'=> 'Tarif Horaire estimé'
                    )
                )
    
                ->add('delai', null, array(
                    'label'=> 'Durée estimée pour réaliser le projet'
                    )
                )
                ->add('particularite', TextareaType::class, array(
                    'label'=> 'Particularités'
                    )
                )
                ->add('proposition', CKEditorType::class, array(
                    'input_sync' => true,
                    'config' => array(
                        'uiColor' => '#020F58',
                    ),
                    'label' => 'Saisir la proposition commerciale ici: ',  
                  )) 
                ->add('proposition', CKEditorType::class, array(
                    'input_sync' => true,
                    'config' => array(
                        'uiColor' => '#020F58',
                    ),
                    'label' => 'Saisir la proposition commerciale ici: ',  
                  ))
              
                ->getForm();
                
            
        $editForm->handleRequest($request);      
    
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_edit', array('id' => $offre->getIdOffre()));
        }

        return $this->render('offre/edit.html.twig', array(
            'offre' => $offre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offre entity.
     *
     * @Route("/{id}", name="offre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Offre $offre)
    {
        $form = $this->createDeleteForm($offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offre);
            $em->flush($offre);
        }

        return $this->redirectToRoute('offre_index');
    }

    /**
     * Creates a form to delete a offre entity.
     *
     * @param Offre $offre The offre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offre $offre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offre_delete', array('id' => $offre->getIdOffre())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
