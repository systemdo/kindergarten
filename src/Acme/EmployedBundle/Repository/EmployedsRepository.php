<?php

namespace Acme\EmployedBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TextRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmployedsRepository extends EntityRepository
{
	function isEmployedToUser($id)
	{
		$repository = $this->getDoctrine()
    	->getRepository('AcmeEmployedBundle:Employeds');
		 
		$result = $repository->find($id);
		$result= $query->getResult();
		
		return $result;

	}
}
