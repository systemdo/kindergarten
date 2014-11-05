<?php

namespace Acme\InformationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\InformationBundle\Entity\Contracts;
use Acme\InformationBundle\Form\ContractsType;

/**
 * Contracts controller.
 *
 */
class ContractsController extends Controller
{
    /**
     * Lists all Contracts entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeInformationBundle:Contracts')->findAll();

        return $this->render('AcmeInformationBundle:Contracts:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Contracts entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Contracts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contracts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Contracts:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Contracts entity.
     *
     */
    public function newAction()
    {
        $entity = new Contracts();
        $form   = $this->createForm(new ContractsType(), $entity);

        return $this->render('AcmeInformationBundle:Contracts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Contracts entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Contracts();
        $form = $this->createForm(new ContractsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contracts_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeInformationBundle:Contracts:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contracts entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Contracts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contracts entity.');
        }

        $editForm = $this->createForm(new ContractsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Contracts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Contracts entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Contracts')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contracts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ContractsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contracts_edit', array('id' => $id)));
        }

        return $this->render('AcmeInformationBundle:Contracts:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contracts entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeInformationBundle:Contracts')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contracts entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contracts'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
