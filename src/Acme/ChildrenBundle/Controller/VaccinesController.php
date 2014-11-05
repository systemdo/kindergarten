<?php

namespace Acme\ChildrenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\ChildrenBundle\Entity\Vaccines;
use Acme\ChildrenBundle\Form\VaccinesType;

/**
 * Vaccines controller.
 *
 */
class VaccinesController extends Controller
{
    /**
     * Lists all Vaccines entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeChildrenBundle:Vaccines')->findAll();

        return $this->render('AcmeChildrenBundle:Vaccines:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Vaccines entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Vaccines')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaccines entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeChildrenBundle:Vaccines:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Vaccines entity.
     *
     */
    public function newAction()
    {
        $entity = new Vaccines();
        $form   = $this->createForm(new VaccinesType(), $entity);

        return $this->render('AcmeChildrenBundle:Vaccines:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Vaccines entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Vaccines();
        $form = $this->createForm(new VaccinesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vaccines_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeChildrenBundle:Vaccines:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vaccines entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Vaccines')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaccines entity.');
        }

        $editForm = $this->createForm(new VaccinesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeChildrenBundle:Vaccines:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Vaccines entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Vaccines')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaccines entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VaccinesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vaccines_edit', array('id' => $id)));
        }

        return $this->render('AcmeChildrenBundle:Vaccines:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vaccines entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeChildrenBundle:Vaccines')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vaccines entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vaccines'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
