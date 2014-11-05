<?php

namespace Acme\ChildrenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\ChildrenBundle\Entity\EmergencyDatas;
use Acme\ChildrenBundle\Form\EmergencyDatasType;

/**
 * EmergencyDatas controller.
 *
 * @Route("/emergencydatas")
 */
class EmergencyDatasController extends Controller
{
    /**
     * Lists all EmergencyDatas entities.
     *
     * @Route("/", name="emergencydatas")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a EmergencyDatas entity.
     *
     * @Route("/{id}/show", name="emergencydatas_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmergencyDatas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new EmergencyDatas entity.
     *
     * @Route("/new", name="emergencydatas_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EmergencyDatas();
        $session = $this->getRequest()->getSession();
        if($session)
        {
            //$session->get('children', array('id' => $entity->getid(), 'emergency_data_id' => $sos_id));    
            $sessionchildren= $session->get('children');  
                //var_dump('<pre>');
                //var_dump($session->has('children'));
        }else{
                //var_dump('<pre>');
                //var_dump($session->has('children'));
                $session = new Session();
                 $sessionchildren= $session->get('children');  
        
             }   
        
        if($sessionchildren['id'])
        {   
            $em = $this->getDoctrine()->getManager();
            $children = $em->getRepository('AcmeChildrenBundle:Children')->find($sessionchildren['id']);
            $entity->setChildrenSos($children);
            $form   = $this->createForm(new EmergencyDatasType(), $entity);

            return $this->render('AcmeChildrenBundle:EmergencyDatas:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }else
            {
                return $this->redirect($this->generateUrl('children'));
            }        
    }

    /**
     * Creates a new EmergencyDatas entity.
     *
     * @Route("/create", name="emergencydatas_create")
     * @Method("POST")
     * @Template("AcmeChildrenBundle:EmergencyDatas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new EmergencyDatas();
        $form = $this->createForm(new EmergencyDatasType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $session = $request->getSession();
            $sessionchildren= $session->get('children');  
            if($sessionchildren['id'])
            {   
                $children = $em->getRepository('AcmeChildrenBundle:Children')->find($sessionchildren['id']);
                $entity->setChildrenSos($children);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('children_show', array('id' => $entity->getChildrenSos()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EmergencyDatas entity.
     *
     * @Route("/{id}/edit", name="emergencydatas_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmergencyDatas entity.');
        }

        $editForm = $this->createForm(new EmergencyDatasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EmergencyDatas entity.
     *
     * @Route("/{id}/update", name="emergencydatas_update")
     * @Method("POST")
     * @Template("AcmeChildrenBundle:EmergencyDatas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmergencyDatas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmergencyDatasType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('emergencydatas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EmergencyDatas entity.
     *
     * @Route("/{id}/delete", name="emergencydatas_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EmergencyDatas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('emergencydatas'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
