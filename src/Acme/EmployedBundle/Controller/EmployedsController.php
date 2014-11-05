<?php

namespace Acme\EmployedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\EmployedBundle\Entity\Employeds;
use Acme\EmployedBundle\Form\EmployedsType;
use Acme\SystemBundle\Entity\FilesSystem;


/**
 * Employeds controller.
 *
 */
class EmployedsController extends Controller
{
    /**
     * Lists all Employeds entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //var_dump($this->getUser());

        //multiples kindergarten
        $session = $this->getRequest()->getSession();
        if(!$session->has('kg'))
             return $this->redirect($this->generateUrl('kindergartens_choose'));


        $entities = $em->getRepository('AcmeEmployedBundle:Employeds')->findAll();
        //$entities[] = array('name'=>'lucas');
        //entities by kindegarten
        $ent_kg = array();
        //var_dump("<pre>");
        foreach ($entities as $key => $entitie) {
            foreach ($entitie->getKindergarten() as $kgs=> $kg) {
                    //var_dump($value2);die();
                    if($kg->getId() == $session->get('kg'))
                    {
                        //var_dump($value2->getId()."=");
                        //var_dump($session->get('kg'));
                        $ent_kg[]= $entitie; 
                    }
                    
            }
        }
        //die();
        return $this->render('AcmeEmployedBundle:Employeds:index.html.twig', array(
            'entities' => $ent_kg,
            //'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Employeds entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeEmployedBundle:Employeds')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employeds entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        //var_dump($entity->getContact());die();
        return $this->render('AcmeEmployedBundle:Employeds:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Employeds entity.
     *
     */
    public function newAction()
    {
        $entity = new Employeds();
        $form   = $this->createForm(new EmployedsType(), $entity);

        return $this->render('AcmeEmployedBundle:Employeds:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Employeds entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Employeds();
        
        $files = $request->files->get('acme_employedbundle_employedstype');
        //var_dump($files);die();
        if(!empty($files['image']))
        {
            $upload  = new FilesSystem();
            //die('huee');
            //var_dump($files);die();
            $upload->setFile($files['image'], $entity);
            $files['image'] = $upload;
            $request->files->set('acme_employedbundle_employedstype', $files);
         } 

        $form = $this->createForm(new EmployedsType(), $entity);
        $form->bind($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             if(!empty($files['image']))
                $upload->upload();
            $entity->setPasswordClock();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employeds_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeEmployedBundle:Employeds:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Employeds entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeEmployedBundle:Employeds')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employeds entity.');
        }

        $editForm = $this->createForm(new EmployedsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeEmployedBundle:Employeds:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Employeds entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeEmployedBundle:Employeds')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employeds entity.');
        }

        $files = $request->files->get('acme_employedbundle_employedstype');
        if(!empty($files['image']))
        {
            $upload  = new FilesSystem();
            //die('huee');
            //var_dump($files);die();
            $upload->setFile($files['image'], $entity);
            $files['image'] = $upload;
            $request->files->set('acme_employedbundle_employedstype', $files);
         }   

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmployedsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {

             if(!empty($files['image']))
                $upload->upload();
            //$entity->setPasswordClock();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employeds_edit', array('id' => $id)));
        }

        return $this->render('AcmeEmployedBundle:Employeds:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Employeds entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeEmployedBundle:Employeds')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Employeds entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employeds'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
