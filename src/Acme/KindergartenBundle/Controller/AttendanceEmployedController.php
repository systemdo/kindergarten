<?php

namespace Acme\KindergartenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\KindergartenBundle\Entity\AttendanceEmployed;
use Acme\UsersBundle\Entity\Users;
use Acme\KindergartenBundle\Form\AttendanceEmployedType;

/**
 * AttendanceEmployed controller.
 *
 * @Route("/attendanceemployed")
 */
class AttendanceEmployedController extends Controller
{
    
    
    public function attendanceAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeKindergartenBundle:AttendanceEmployed')->findAll();

        return $this->render('AcmeKindergartenBundle:AttendanceEmployed:attendance.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all AttendanceEmployed entities.
     *
     * @Route("/", name="attendanceemployed")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeKindergartenBundle:AttendanceEmployed')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AttendanceEmployed entity.
     *
     * @Route("/{id}/show", name="attendanceemployed_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceEmployed')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttendanceEmployed entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new AttendanceEmployed entity.
     *
     * @Route("/new", name="attendanceemployed_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AttendanceEmployed();
        $form   = $this->createForm(new AttendanceEmployedType(), $entity);

        return $this->render('AcmeKindergartenBundle:AttendanceEmployed:attendance.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new AttendanceEmployed entity.
     *
     * @Route("/create", name="attendanceemployed_create")
     * @Method("POST")
     * @Template("AcmeKindergartenBundle:AttendanceEmployed:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AttendanceEmployed();
        $form = $this->createForm(new AttendanceEmployedType(), $entity);
        $form->bind($request);
        $post = $request->request->all();
        //var_dump($post);die();
        
        if (!empty($post)) {
            
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('AcmeUsersBundle:Users')->findOneByUsername($post['_username']);
            //hay que verificar se el esta logado hoy     
            //var_dump("<pre>");
            //var_dump($user->getEmployed());die();
            //var_dump($now = new \DateTime('now'));
            //var_dump($date = $now->format('Y-m-d'));
            //var_dump($hour = $now->format('h:i:s'));die();
            //var_dump($now = new \DateTime('now'));die();
            if(!empty($user))
            {
                $em = $this->getDoctrine()->getManager();
                $now = new \DateTime('now');
                $date = $now->format('Y-m-d');
                $hour = $now->format('h:i:s');
                $entity->setDate($now);
                $entity->setClockIn($now);
                $entity->setEmployed($user->getEmployed());

                $em->persist($entity);
                if($em->flush())
                {
                    return $this->render('AcmeKindergartenBundle:AttendanceEmployed:getattendance.html.twig', array(
                        'entity' => $entity,
                    ));
                }
            }else{
                   
                    $session = $this->get('session');
                    $session->getFlashBag()->add(
                            'attendance',
                            array(
                                    'tittle' => 'Warning',
                                    'message' => 'Error in to ClockIn Maybe you aren\'t registed oder your password is wrong',
                                    'type' =>'warning' 
                                )

                        );
            }    

            //return $this->redirect($this->generateUrl('attendanceemployed_show', array('id' => $entity->getId())));
        }
        /*if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attendanceemployed_show', array('id' => $entity->getId())));
        }*/

        return $this->render('AcmeKindergartenBundle:AttendanceEmployed:attendance.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AttendanceEmployed entity.
     *
     * @Route("/{id}/edit", name="attendanceemployed_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceEmployed')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttendanceEmployed entity.');
        }

        $editForm = $this->createForm(new AttendanceEmployedType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AttendanceEmployed entity.
     *
     * @Route("/{id}/update", name="attendanceemployed_update")
     * @Method("POST")
     * @Template("AcmeKindergartenBundle:AttendanceEmployed:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceEmployed')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AttendanceEmployed entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AttendanceEmployedType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attendanceemployed_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a AttendanceEmployed entity.
     *
     * @Route("/{id}/delete", name="attendanceemployed_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeKindergartenBundle:AttendanceEmployed')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AttendanceEmployed entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attendanceemployed'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
