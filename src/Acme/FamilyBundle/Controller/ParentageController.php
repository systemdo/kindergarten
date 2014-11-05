<?php

namespace Acme\FamilyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\FamilyBundle\Entity\Parentage;
use Acme\FamilyBundle\Form\ParentageType;

/**
 * Parentage controller.
 *
 */
class ParentageController extends Controller
{
    /**
     * Lists all Parentage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeFamilyBundle:Parentage')->findAll();

        return $this->render('AcmeFamilyBundle:Parentage:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Parentage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFamilyBundle:Parentage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parentage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeFamilyBundle:Parentage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Parentage entity.
     *
     */
    public function newAction()
    {
        $entity = new Parentage();
        $form   = $this->createForm(new ParentageType(), $entity);

        return $this->render('AcmeFamilyBundle:Parentage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Parentage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Parentage();
        $form = $this->createForm(new ParentageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('parentage_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeFamilyBundle:Parentage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Parentage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFamilyBundle:Parentage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parentage entity.');
        }

        $editForm = $this->createForm(new ParentageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeFamilyBundle:Parentage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Parentage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFamilyBundle:Parentage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parentage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ParentageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('parentage_edit', array('id' => $id)));
        }

        return $this->render('AcmeFamilyBundle:Parentage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Parentage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeFamilyBundle:Parentage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Parentage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('parentage'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
