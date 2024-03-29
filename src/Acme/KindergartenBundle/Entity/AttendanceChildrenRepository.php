<?php

namespace Acme\KindergartenBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AttendanceChildrenRepository extends EntityRepository
{
	const className = "AcmeKindergartenBundle:AttendanceChildren";

	function isAttendanceToday($id_child)
    {
        $date = new \DateTime('now');
        $attendance_date1 = date( 'Y-m-d 00:00:00' );
        $attendance_date2 = date( 'Y-m-d 23:59:59' );
        $query = $this->getEntityManager()->createQuery(
                                    'SELECT a
                                       FROM AcmeKindergartenBundle:AttendanceChildren a
                                      
                                   where a.child = :child
                                   AND a.attendanceDate >= :attendance_date1 and a.attendanceDate <= :attendance_date2'
                                )
                ->setParameter('attendance_date1', $attendance_date1)
                ->setParameter('attendance_date2', $attendance_date2)
                ->setParameter('child', $id_child);
 				//var_dump($query->getResult()); die();
            $result = $query->getResult();
       
            return empty($result)?false:$result;
    }

    function getAlltoday()
    {
    	$query = 
    	$this->getEntityManager()
	    ->createQuery(
                    	'SELECT a
                     	 FROM AcmeKindergartenBundle:AttendanceChildren a
                   		 Where a.date = :date'
                    )
                ->setParameter('date', date( 'Y-m-d' ));
      
            $result = $query->getResult();
       
            return empty($result)?false:$result;	
    }
    
}
