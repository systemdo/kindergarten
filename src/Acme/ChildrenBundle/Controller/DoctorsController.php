<?php

namespace Acme\ChildrenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Acme\ChildrenBundle\Entity\Doctors;
use Acme\ChildrenBundle\Form\DoctorsType;

/**
 * Doctors controller.
 *
 */
class DoctorsController extends Controller
{
    /**
     * Lists all Doctors entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeChildrenBundle:Doctors')->findAll();

        return $this->render('AcmeChildrenBundle:Doctors:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Doctors entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Doctors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctors entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeChildrenBundle:Doctors:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Doctors entity.
     *
     */
    public function newAction()
    {
        $entity = new Doctors();
        $form   = $this->createForm(new DoctorsType(), $entity);
        $session =$this->getRequest()->getSession();
        $sessionchildren= $session->get('children');  
        
        if(!empty($sessionchildren['emergency_data_id']))
        {   
            return $this->render('AcmeChildrenBundle:Doctors:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }else
            {
                return $this->redirect($this->generateUrl('children'));
            }        
    }

    /**
     * Creates a new Doctors entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Doctors();
        $form = $this->createForm(new DoctorsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            //save doctor in emergency
            $session = $request->getSession();
            
            //var_dump($sessionchildren);
            if($session->has('children'))
            {   
                
                $sessionchildren= $session->get('children');  
                if(isset($sessionchildren['emergency_data_id']))
                {
                    $sos = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->find($sessionchildren['emergency_data_id']);
                    $sos->setDoctor($entity);
                    $em->persist($entity);
                    $em->flush();
                    $session->remove('children');
                }else
                    {
                        throw $this->createNotFoundException();
                    }
            
            }
            
            return $this->redirect($this->generateUrl('children_show', array('id' => $sessionchildren['id'])));
        }

    }

    /**
     * Displays a form to edit an existing Doctors entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //$session = new Session();
        //$sessionchildren= $session->set('doctor', array('id'=> $id));
        $session = $this->getRequest()->getSession();
            //var_dump($sessionchildren);
            if($session)
            {
                //$session->get('children', array('id' => $entity->getid(), 'emergency_data_id' => $sos_id));    
                $sessionchildren= $session->set('doctor', array('id'=> $id));
                    //var_dump('<pre>');
                    //var_dump($session->has('children'));
            }else{
                    //var_dump('<pre>');
                    //var_dump($session->has('children'));
                    $session = new Session();
                    $sessionchildren= $session->set('doctor', array('id'=> $id));
                 }   
            
        $entity = $em->getRepository('AcmeChildrenBundle:Doctors')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctors entity.');
        }

        $editForm = $this->createForm(new DoctorsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeChildrenBundle:Doctors:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Doctors entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Doctors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctors entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DoctorsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('doctors_edit', array('id' => $id)));
        }

        return $this->render('AcmeChildrenBundle:Doctors:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Doctors entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeChildrenBundle:Doctors')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Doctors entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('doctors'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
