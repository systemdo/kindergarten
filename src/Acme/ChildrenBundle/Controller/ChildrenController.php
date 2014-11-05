<?php

namespace Acme\ChildrenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\ChildrenBundle\Entity\Children;
use Acme\ChildrenBundle\Form\ChildrenType;
use Acme\SystemBundle\Entity\FilesSystem;

/**
 * Children controller.
 *
 */
class ChildrenController extends Controller
{
    /**
     * Lists all Children entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        
        $session = $this->getRequest()->getSession();

        if(!$session->has('kg'))
             return $this->redirect($this->generateUrl('kindergartens_choose'));

        //cabiar consulta en ordene alfabetica
        //$entities = $em->getRepository('AcmeChildrenBundle:Children')->findAll();
        $entities = $em->getRepository('AcmeChildrenBundle:Children')->findBy(array('kindergarten'=> $session->get('kg')));

        return $this->render('AcmeChildrenBundle:Children:index.html.twig', array(
            'entities' => $entities,
        )); 

        //var_dump( $session->get('kg')); die(); 
    }

    /**
     * Finds and displays a Children entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Children')->find($id);
       
        //to know if the chiild have the emergency date

        //$sos = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->findOneBy(array('childrenSos'=> $entity->getId()));
        $sos = $entity->getSos();
        $families = $entity->getFamily()->isEmpty();
        //var_dump("<pre>");
        ///var_dump($entity->getFamily()->first()->getName());
        //die();

        $sos_id ="false";
        if ($sos)
        {
            $sos_id =$sos->getId();
        }

        $session = $this->getRequest()->getSession();
        if($session)
        {
            //always el id's child needs to be in the session 
            $session->set('children', array('id' => $entity->getid(), 'emergency_data_id' => $sos_id));    
        }else{
                
                ChildrenController::createSession('children', array('id' => $entity->getid(), 'emergency_data_id' => $sos_id));
             }   
         
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Children entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('AcmeChildrenBundle:Children:show.html.twig', array(
            'entity'      => $entity,
            'sos'          => $sos ,
            'delete_form' => $deleteForm->createView(),        
            'families' => $families,
            ));
    }

    /**
     * Displays a form to create a new Children entity.
     *
     */
    public function newAction()
    {
        $entity = new Children();
        $form   = $this->createForm(new ChildrenType(), $entity);

        //this is when children is created about the family seccion 
        $request =  Request::createFromGlobals();
        $family = $request->query->get('family');
        $session = $this->getRequest()->getSession();
        if(!empty($family))
        {
            $session->set('family', $family);
        }else
            {
                if($session->has('family'))
                {
                    $session->remove('family');
                }
            }
        //var_dump($family);die();

        return $this->render('AcmeChildrenBundle:Children:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Children entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Children();
        //$upload  = new FilesSystem();
        
        //$files = $request->files->get('acme_childrenbundle_childrentype');
        $files = $request->files->get('acme_childrenbundle_childrentype');
        if(!empty($files['image']))
        {
            $upload  = new FilesSystem();
            //die('huee');
            //var_dump($files);die();
            $upload->setFile($files['image'], $entity);
            $files['image'] = $upload;
            $request->files->set('acme_childrenbundle_childrentype', $files);
         }   
        //var_dump($family);
        
        //$upload->setFile($files['image'], $entity);
        //$files['image'] = $upload;
        //$request->files->set('acme_childrenbundle_childrentype', $files);
        
        $form = $this->createForm(new ChildrenType(), $entity);
        
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
             if(!empty($files['image']))
                $upload->upload();

            $session = $this->getRequest()->getSession();
            if($session->has('family'))
            {
                $family_id = $session->get('family');
                $family = $em->getRepository('AcmeFamilyBundle:Families')->find($family_id);
                $entity->addFamily($family);
                $session->remove('family');

            }
            

            $em->persist($entity);

            $em->flush();
            
            if(isset($family_id))
            {
                return $this->redirect($this->generateUrl('families_show', array('id' => $family_id)));
            }    
            return $this->redirect($this->generateUrl('children_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeChildrenBundle:Children:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Children entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeChildrenBundle:Children')->find($id);
        $sos = $em->getRepository('AcmeChildrenBundle:EmergencyDatas')->findOneBy(array('childrenSos'=> $entity->getId()));
        $family = $entity->getFamily(); 
        //var_dump($family); 
        //var_dump($sos->getDoctor());
        $sos_id ="false";
        if ($sos)
        {
            $sos_id =$sos->getId();
            //var_dump($sos_id);
        }

       $session = $this->getRequest()->getSession();
        if($session)
        {
            $session->set('children', array('id' => $entity->getid(), 'emergency_data_id' => $sos_id));    
                //var_dump('<pre>');
                //var_dump($session->has('children'));
        }else{
                //var_dump('<pre>');
                //var_dump($session->has('children'));
                ChildrenController::createSession('children', array('id' => $entity->getid(), 'emergency_data_id' => $sos_id));
             }   
        
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Children entity.');
        }

        $editForm = $this->createForm(new ChildrenType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeChildrenBundle:Children:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
             'sos'          => $sos ,
        ));
    }

    /**
     * Edits an existing Children entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeChildrenBundle:Children')->find($id);
        
        $files = $request->files->get('acme_childrenbundle_childrentype');
        if(!empty($files['image']))
        {
            $upload  = new FilesSystem();
            //die('huee');
            //var_dump($files);die();
            $upload->setFile($files['image'], $entity);
            $files['image'] = $upload;
            $request->files->set('acme_childrenbundle_childrentype', $files);
         }   

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Children entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ChildrenType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            if(!empty($files['image']))
                $upload->upload();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('children_edit', array('id' => $id)));
        }

        return $this->render('AcmeChildrenBundle:Children:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Children entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeChildrenBundle:Children')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Children entity.');
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

    static function createSession($name, $data)
    {
        $session = new Session();
        //$session = $request->session();
      //var_dump('<pre>');
      //var_dump($session);//die();
        $session->start();
        //var_dump($this->getRequest());
        $session->set($name, $data);
        //echo '</pre>';
    }
}
