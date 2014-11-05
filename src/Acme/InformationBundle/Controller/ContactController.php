<?php

namespace Acme\InformationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Acme\InformationBundle\Entity\Contact;
use Acme\InformationBundle\Form\ContactType;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all Contact entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeInformationBundle:Contact')->findAll();

        return $this->render('AcmeInformationBundle:Contact:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Contact entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Contact:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Contact entity.
     *
     */
    public function newAction($who,$id)
    {
        
        $session = $this->getRequest()->getSession();
       
        $session->set('who' , $who);  
        $session->set('id', $id);  
        
           
            $entity = new Contact();
            $form   = $this->createForm(new ContactType(), $entity);

            return $this->render('AcmeInformationBundle:Contact:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));  
    }

    /**
     * Creates a new Contact entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Contact();
        $form = $this->createForm(new ContactType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
    
            $session = $request->getSession();
            $who = $session->get('who');  
            $id = $session->get('id');  
            
            
            if(isset($who) && isset($id))
            {   
                
                if($who == 'families')
                {
                    $family = $em->getRepository('AcmeFamilyBundle:Families')->find($id);
                    $have = $family->getContact();
                    if(isset($have))
                    {
                        throw $this->createNotFoundException('This Person have contact alredy');
                    }
                    $family->setContact($entity);    
                }elseif($who == 'doctor')
                        {
                            $sos = $em->getRepository('AcmeChildrenBundle:Doctors')->find($id);
                            $have = $sos->getContact();
                            if(isset($have))
                            {
                                throw $this->createNotFoundException('This Person have contact alredy');
                            }
                            $sos->setContact($entity);
                        }elseif($who == 'employeds')
                                {
                                    $employeed = $em->getRepository('AcmeEmployedBundle:Employeds')->find($id);
                                    $have = $employeed->getContact();
                                    if(isset($have))
                                    {
                                        throw $this->createNotFoundException('This Person have contact alredy');
                                    }
                                    $employeed->setContact($entity);
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
                    return $this->redirect($this->generateUrl('contact_edit', array('id' => $sos->getSos()->getId())));
                break;
                case 'employeds':
                    return $this->redirect($this->generateUrl('employeds_show', array('id' => $id)));
                break;  
                default:
                   throw $this->createNotFoundException('Maybe you had created the contact for this member already');
                break;
            }
        }

        return $this->render('AcmeInformationBundle:Contact:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contact entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $editForm = $this->createForm(new ContactType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeInformationBundle:Contact:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Contact entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeInformationBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ContactType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_edit', array('id' => $id)));
        }

        return $this->render('AcmeInformationBundle:Contact:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contact entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeInformationBundle:Contact')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contact entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contact'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
