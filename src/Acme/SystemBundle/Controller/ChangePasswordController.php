<?php
namespace Acme\SystemBundle\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\UsersBundle\Entity\Users;
use Acme\SystemBundle\Form\ChangePasswordType;

 
class ChangePasswordController extends Controller
{
    
    public function editAction()
    {   
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $id = $user->getId();
        //$entity = $em->getRepository('AcmeUsersBundle:Users')->find($id);
        $entity = new Users();
       
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users.');
        }

         $form = $this->createForm(new ChangePasswordType(), $entity);
      
        
        return $this->render('AcmeSystemBundle:ChangePassword:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
        ));
    }    

    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $id = $user->getId();

        $entity = $em->getRepository('AcmeUsersBundle:Users')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users.');
        }
        $form = $this->createForm(new ChangePasswordType(), $entity);
        //var_dump("<pre>");
        //var_dump($form);
        //var_dump($request->request);
        $form->bind($request);

        if ($form->isValid()) {
            $session = $this->get('session');
           if($entity->isEqualPassword())
           {
                $this->setSecurePassword($entity);
                $em->persist($entity);
                $em->flush();

                $session->getFlashBag()->add(
                            'Password',
                            array(
                                    'tittle' => 'Success',
                                    'message' => 'Your new Password had created with sucess',
                                    'type' =>'success' 
                                )

                        );
                /*$message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('kindegardten@kindergarteb.com')
                ->setTo($entity->getEmail())
                ->setBody(
                $this->renderView(
                'AcmeUsersBundle:Users:show.html.twig',
                array('entity' => $entity)
            )
        )
    ;
    $this->get('mailer')->send($message);*/

                //return $this->redirect($this->generateUrl('change_password', array('id' => $id)));
            }else
                {
                    
                    $session->getFlashBag()->add(
                            'Password',
                            array(
                                    'tittle' => 'Warning',
                                    'message' => 'Diferents Passwords',
                                    'type' => 'warning'
                                )  
                        );
                }    
        }
        return $this->render('AcmeSystemBundle:ChangePassword:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
        ));
    }    
    
    private function setSecurePassword($entity) 
    {
        $entity->setSalt(md5(time()));
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);
    }

}
?>