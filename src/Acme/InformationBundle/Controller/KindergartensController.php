<?php

namespace Acme\InformationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\InformationBundle\Entity\Kindergartens;
use Acme\InformationBundle\Form\KindergartensType;

/**
 * Kindergartens controller.
 *
 */
class KindergartensController extends Controller
{
    /**
     * Lists all Kindergartens entities.
     *
     */
    public function chooseAction()
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($this->getUser());
        $entities = $em->getRepository('AcmeInformationBundle:Kindergartens')->findAll();


        return $this->render('AcmeInformationBundle:Kindergartens:kg.choose.html.twig', array(
            'entities' => $entities,
        ));
    }
    public function setKGAction(Request $request)
    {
        
        if($this->getRequest()->isXmlHttpRequest())
        {
            $id = $request->get('id');
            //die($id);
            $data = false;
            if(!empty($id))
            {
                $session = $request->getSession();
                $session->set('kg', $id);
                $data = true;
                //return $this->redirect($this->generateUrl('children'));
            }
            $response = new Response(json_encode(array('data' => $data)));
            $response->headers->set('Content-Type', 'application/json');

            return $response;    
            
        }   

    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($this->getUser());
        $entities = $em->getRepository('AcmeInformationBundle:Kindergartens')->findAll();

        return $this->render('AcmeInformationBundle:Kindergartens:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Kindergartens entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Kindergartens')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Kindergartens entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Kindergartens:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Kindergartens entity.
     *
     */
    public function newAction()
    {
        $entity = new Kindergartens();
        $form   = $this->createForm(new KindergartensType(), $entity);

        return $this->render('AcmeInformationBundle:Kindergartens:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Kindergartens entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Kindergartens();
        $form = $this->createForm(new KindergartensType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('kindergartens_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('kindergartens'));
        }

        return $this->render('AcmeInformationBundle:Kindergartens:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Kindergartens entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Kindergartens')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Kindergartens entity.');
        }

        $editForm = $this->createForm(new KindergartensType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Kindergartens:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Kindergartens entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Kindergartens')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Kindergartens entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new KindergartensType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('kindergartens_edit', array('id' => $id)));
        }

        return $this->render('AcmeInformationBundle:Kindergartens:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Kindergartens entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeInformationBundle:Kindergartens')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Kindergartens entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('kindergartens'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
