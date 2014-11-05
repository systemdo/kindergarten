<?php

namespace Acme\UsersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\UsersBundle\Entity\Users;
use Acme\UsersBundle\Form\UsersType;

/**
 * Users controller.
 *
 */
class UsersController extends Controller
{
    /**
     * Lists all Users entities.
     *
     */
    public function indexAction()
    {
        
        //var_dump("<pre>");
        //$this->get("security.context")->isGranted("ROLE_ADMIN")
        //var_dump($user = $this->getUser()->getId());die();
        //var_dump($this->get("security.context")->isGranted("ROLE_ADMIN"));
        ///die();
         $session = $this->getRequest()->getSession();

        if(!$session->has('kg'))
             return $this->redirect($this->generateUrl('kindergartens_choose'));

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeUsersBundle:Users')->findAll();
        $entkg= array();
        //var_dump("<pre>");
        foreach ($entities as $users => $user) {
                //var_dump($user->getEmployed());die();
            foreach ($user->getEmployed()->getKindergarten() as $kgs => $kg) {
                    if($kg->getId() == $session->get('kg'))
                    {
                        $entkg[] = $user; 
                    }
                
            }
        }
        //var_dump($entities[3]->getEmployed()->getId());die();
        return $this->render('AcmeUsersBundle:Users:index.html.twig', array(
            //'entities' => $entities,
            'entities' => $entkg,
        ));
    }

    /**
     * Finds and displays a Users entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeUsersBundle:Users')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeUsersBundle:Users:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Users entity.
     *
     */
    public function newAction()
    {
        $entity = new Users();
        $form   = $this->createForm(new UsersType(), $entity);

        return $this->render('AcmeUsersBundle:Users:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Users entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Users();
        $form = $this->createForm(new UsersType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
                //create password
                $entity->setPassword($entity->generatePassword());
                //before encode password
                $entity->passwMail = $entity->getPassword();    
                //endode password
                $this->setSecurePassword($entity);
                
                $em->persist($entity);
                $em->flush();
            /*}else
                {
                    $session = new Session();
                    $session->getFlashBag()->add(
                            'Employed',
                            'This Employed selected have User already'  
                        );
                }    */


            //email 
            /*
            $message = \Swift_Message::newInstance()
                ->setSubject('Password System')
                ->setFrom('kindegardten@kindergarten.com')
                ->setTo($entity->getEmail());
                ->setBody(
                $this->renderView(
                'AcmeUsersBundle:Users:show.html.twig',
                array('entity' => $entity)*/

            //return $this->redirect($this->generateUrl('users_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('users'));
        }

        return $this->render('AcmeUsersBundle:Users:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Users entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeUsersBundle:Users')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $editForm = $this->createForm(new UsersType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeUsersBundle:Users:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Users entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeUsersBundle:Users')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UsersType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users_edit', array('id' => $id)));
        }

        return $this->render('AcmeUsersBundle:Users:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Users entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeUsersBundle:Users')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Users entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('users'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    private function setSecurePassword($entity) 
    {
        $entity->setSalt(md5(time()));
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);
    }

}
