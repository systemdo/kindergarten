<?php

namespace Acme\KindergartenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\ChildrenBundle\Controller\ChildrenController;
use Acme\KindergartenBundle\Entity\AttendanceChildren;
use Acme\KindergartenBundle\Entity\AttendanceChildrenRepository;
use Acme\KindergartenBundle\Form\AttendanceChildrenType;

/**
 * AttendanceChildren controller.
 *
 */
class AttendanceChildrenController extends Controller
{
    /**
     * Lists all AttendanceChildren entities.
     *
     */

    public function infoChildAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Children')->find($id);
       
        //to know if the chiild have the emergency date

        //$sos = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->findOneBy(array('childrenSos'=> $entity->getId()));
        $sos = $entity->getSos();
        $families = $entity->getFamily();

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeKindergartenBundle:AttendanceChildren:show.child.html.twig', array(
            'entity'      => $entity,
            'sos'          => $sos ,
            'delete_form' => $deleteForm->createView(),        
            'families' => $families,
            ));
    }
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->findAll();
        $children = $em->getRepository('AcmeChildrenBundle:Children')->findAll();
        //$child = $em->getRepository('AcmeChildrenBundle:Children')->find(8);
        //var_dump($child->getId()); die();
        //$entity = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->findOneBy(array('child' => 8));
        //var_dump($entity);
        //qdie();
        //$attendance = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->getAlltoday();
        foreach ($children as $key => $child) {
            //var_dump($child->getId());
            //var_dump($em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->isAttendanceToday($child->getId()));
            if($em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->isAttendanceToday($child->getId()))
            {
                $child->setStatus(true);
            }else
                {
                  $child->setStatus(false);   
                }   
        }
    
        return $this->render('AcmeKindergartenBundle:AttendanceChildren:index.html.twig', array(
            'entities' => $entities,
            'children' => $children,
        ));
    }

    /**
     * Finds and displays a AttendanceChildren entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttendanceChildren entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeKindergartenBundle:AttendanceChildren:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new AttendanceChildren entity.
     *
     */
    public function newAction()
    {
        $entity = new AttendanceChildren();
        $form   = $this->createForm(new AttendanceChildrenType(), $entity);

        return $this->render('AcmeKindergartenBundle:AttendanceChildren:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    //cuando el usario  lo pone online refresca online 
    /**
     * Creates a new AttendanceChildren entity.
     *
     */
    public function createAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity  = new AttendanceChildren();
            
        if(!$this->getRequest()->isXmlHttpRequest())
        {
            $form = $this->createForm(new AttendanceChildrenType(), $entity);
            $form->bind($request);

            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('attendancechildren_show', array('id' => $entity->getId())));
            }

            return $this->render('AcmeKindergartenBundle:AttendanceChildren:new.html.twig', array(
                'entity' => $entity,
                'form'   => $form->createView(),
            ));
        }else
            {
                $accion = $request->get('accion');
                $id_child = $request->get('child_id');

                $repository = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren');
                $isAttendanceToday =  $repository->isAttendanceToday($id_child);

                if ($accion == "on") 
                {     
                    //get on         
                    if(!$isAttendanceToday)
                    {
                        $child = $em->getRepository('AcmeChildrenBundle:Children')->find($id_child);
                        $entity->setChild($child);
                        //$entity->setDate(date( 'Y-m-d H:i:s' ));
                           
                        $date = new \DateTime('now');
                        $date->format('Y-m-d H:i:s');
                        $entity->setAttendanceDate($date);
                        //$entity->setAttendance(true);
                        //$entity->setUser(true);

                        $em->persist($entity);
                        $em->flush();
                        $data = "on";
                         
                        
                     }else
                        {
                            $data = "Kinder is online alredy";
                        }   
                }else{
                        //off

                        if($isAttendanceToday)
                        {
                            //var_dump($id_child);die();

                            $child = $em->getRepository('AcmeChildrenBundle:Children')->find($id_child);
                            //var_dump($child);die();

                            $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->findOneBy(array('child' => $child->getId()));
                            //var_dump($entity);die();


                            $em->remove($entity);
                            $em->flush();
                               $data = "off"; 

                         }else
                            {
                                $data = "Kinder isn't  online yet";
                            }
                            
                            //if is online already return new query and update the view
                       
                    }
                 $response = new Response(json_encode(array('data' => $data)));
                $response->headers->set('Content-Type', 'application/json');

                        return $response;    
            }

    }

    /**
     * Displays a form to edit an existing AttendanceChildren entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttendanceChildren entity.');
        }

        $editForm = $this->createForm(new AttendanceChildrenType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeKindergartenBundle:AttendanceChildren:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing AttendanceChildren entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttendanceChildren entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AttendanceChildrenType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attendancechildren_edit', array('id' => $id)));
        }

        return $this->render('AcmeKindergartenBundle:AttendanceChildren:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AttendanceChildren entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceChildren')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AttendanceChildren entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attendancechildren'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
