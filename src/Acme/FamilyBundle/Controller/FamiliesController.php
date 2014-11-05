<?php

namespace Acme\FamilyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\FamilyBundle\Entity\Families;
use Acme\ChildrenBundle\Entity\Children;
use Acme\FamilyBundle\Form\FamiliesType;

/**
 * Families controller.
 *
 */
class FamiliesController extends Controller
{
    /**
     * Lists all Families entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeFamilyBundle:Families')->findAll();

        return $this->render('AcmeFamilyBundle:Families:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Families entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFamilyBundle:Families')->find($id);

        //var_dump($entity->getAddress()->getStreet()); die();
        $children = $entity->getOurChildren();
            //print_r("<pre>");
            //var_dump($children);

            //die();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Families entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeFamilyBundle:Families:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'address'  => $entity->getAddress(),
            'contact'  => $entity->getContact(),
            'children' => $children
            ));
    }

    /**
     * Displays a form to create a new Families entity.
     *
     */
    public function newAction()
    {
        $session = $this->getRequest()->getSession();
        if($session)
        {
            $idchild =  $session->get('children');
            if($idchild)
            {    
                
                 $em = $this->getDoctrine()->getManager();

                 $child = $em->getRepository('AcmeChildrenBundle:Children')->findOneById($idchild);
                 //var_dump('<pre>');
                //var_dump($child);

                $entity = new Families();

                $form   = $this->createForm(new FamiliesType(), $entity);

                return $this->render('AcmeFamilyBundle:Families:new.html.twig', array(
                    'entity' => $entity,
                    'child' => $child,
                    'form'   => $form->createView(),
                ));
            }    
         }  

         return $this->redirect($this->generateUrl('children_children'));           
       
    }

    /**
     * Creates a new Families entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Families();
        $form = $this->createForm(new FamiliesType(), $entity);
        $form->bind($request);
        $session = $this->getRequest()->getSession();
        if($session)
        {
            $idchild =  $session->get('children');
            if($idchild)
            {  
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $child = $em->getRepository('AcmeChildrenBundle:Children')->findOneById($idchild);
                    $entity->addOurChildren($child);
                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('families_show', array('id' => $entity->getId())));
                }

                return $this->render('AcmeFamilyBundle:Families:new.html.twig', array(
                    'entity' => $entity,
                    'form'   => $form->createView(),
                ));
            }    
        }
        $this->redirect($this->generateUrl('children_children'));
    }

    /**
     * Displays a form to edit an existing Families entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFamilyBundle:Families')->find($id);
        $address = $em->getRepository('AcmeInformationBundle:Address')->find($id);
        $contact = $em->getRepository('AcmeInformationBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Families entity.');
        }

        $editForm = $this->createForm(new FamiliesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeFamilyBundle:Families:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'address'  => $address,
            'contact'  => $contact,
        ));
    }

    /**
     * Edits an existing Families entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFamilyBundle:Families')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Families entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FamiliesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('families_edit', array('id' => $id)));
        }

        return $this->render('AcmeFamilyBundle:Families:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Families entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeFamilyBundle:Families')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Families entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('families'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
