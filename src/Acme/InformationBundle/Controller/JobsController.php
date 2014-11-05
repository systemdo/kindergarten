<?php

namespace Acme\InformationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\InformationBundle\Entity\Jobs;
use Acme\InformationBundle\Form\JobsType;

/**
 * Jobs controller.
 *
 * @Route("/jobs")
 */
class JobsController extends Controller
{
    /**
     * Lists all Jobs entities.
     *
     * @Route("/", name="jobs")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeInformationBundle:Jobs')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Jobs entity.
     *
     * @Route("/{id}/show", name="jobs_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Jobs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jobs entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Jobs entity.
     *
     * @Route("/new", name="jobs_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Jobs();
        $form   = $this->createForm(new JobsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Jobs entity.
     *
     * @Route("/create", name="jobs_create")
     * @Method("POST")
     * @Template("AcmeInformationBundle:Jobs:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Jobs();
        $form = $this->createForm(new JobsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jobs_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Jobs entity.
     *
     * @Route("/{id}/edit", name="jobs_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Jobs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jobs entity.');
        }

        $editForm = $this->createForm(new JobsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Jobs entity.
     *
     * @Route("/{id}/update", name="jobs_update")
     * @Method("POST")
     * @Template("AcmeInformationBundle:Jobs:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Jobs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jobs entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JobsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jobs_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Jobs entity.
     *
     * @Route("/{id}/delete", name="jobs_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeInformationBundle:Jobs')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Jobs entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('jobs'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
