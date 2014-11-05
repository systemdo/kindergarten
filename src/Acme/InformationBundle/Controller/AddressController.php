<?php

namespace Acme\InformationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\InformationBundle\Entity\Address;
use Acme\InformationBundle\Form\AddressType;

/**
 * Address controller.
 *
 */
class AddressController extends Controller
{
    /**
     * Lists all Address entities.
     *
     */
    public function indexAction()
    {
        /*$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeInformationBundle:Address')->findAll();

        return $this->render('AcmeInformationBundle:Address:index.html.twig', array(
            'entities' => $entities,
        ));*/

            throw $this->createNotFoundException(404);
    }

    /**
     * Finds and displays a Address entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Address:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Address entity.
     *
     */


    public function newAction($who,$id)
    {
        $session = $this->getRequest()->getSession();
        
        $session->set('who' ,$who);  
        $session->set('id', $id);  
       
            $entity  = new Address();
            $form   = $this->createForm(new AddressType(), $entity);

            return $this->render('AcmeInformationBundle:Address:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));  
    }

    /**
     * Creates a new Address entity.
     *
     */
    public function createAction(Request $request)
    {
        
        $entity  = new Address();
        $form = $this->createForm(new AddressType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $session = $request->getSession();
            
            //diferents entities have address
            $who = $session->get('who');  
            $id = $session->get('id');  
            
            if(isset($who) && isset($id))
            {   
                
                if($who == 'families')
                {
                    $family = $em->getRepository('AcmeFamilyBundle:Families')->find($id);
                    $have = $family->getAddress();
                    if(isset($have))
                    {
                        throw $this->createNotFoundException('This Person have address alredy');
                    }
                    $family->setAddress($entity);
                }elseif($who == 'doctor')
                        {
                            $sos = $em->getRepository('AcmeChildrenBundle:Doctors')->find($id);
                            $have = $sos->getAddress();
                            if(isset($have))
                            {
                                throw $this->createNotFoundException('This Person have address alredy');
                            }
                            $sos->setAddress($entity);
                        }elseif($who == 'employeds')
                                {
                                    $employeed = $em->getRepository('AcmeEmployedBundle:Employeds')->find($id);
                                    $have = $employeed->getAddress();
                                    if(isset($have)) {
                                        throw $this->createNotFoundException('This Person have contact alredy');
                                    }
                                    $employeed->setAddress($entity);
                                }else
                                {
                                    
                                    throw $this->createNotFoundException();
        
                                }
                $session->remove('who');
                $session->remove('id');
                $em->persist($entity);
                $em->flush();
            
            }
            
            switch ($who) {
                case 'families':
                    return $this->redirect($this->generateUrl('families_show', array('id' => $id)));
                break;
                case 'doctor':
                    return $this->redirect($this->generateUrl('doctors_edit', array('id' => $sos->getId())));
                break;
                case 'employeds':
                    return $this->redirect($this->generateUrl('employeds_show', array('id' => $id)));
                break;  
                default:
                   throw $this->createNotFoundException('Maybe you had created the address for this member already');
                break;
            }
            //return $this->redirect($this->generateUrl('address_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeInformationBundle:Address:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Address entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $editForm = $this->createForm(new AddressType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Address:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Address entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AddressType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('address_edit', array('id' => $id)));
        }

        return $this->render('AcmeInformationBundle:Address:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Address entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeInformationBundle:Address')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('children'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
