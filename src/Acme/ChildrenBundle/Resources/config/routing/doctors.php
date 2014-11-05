<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('doctors', new Route('/', array(
    '_controller' => 'AcmeChildrenBundle:Doctors:index',
)));

$collection->add('doctors_show', new Route('/{id}/show', array(
    '_controller' => 'AcmeChildrenBundle:Doctors:show',
)));

$collection->add('doctors_new', new Route('/new', array(
    '_controller' => 'AcmeChildrenBundle:Doctors:new',
)));

$collection->add('doctors_create', new Route(
    '/create',
    array('_controller' => 'AcmeChildrenBundle:Doctors:create'),
    array('_method' => 'post')
));

$collection->add('doctors_edit', new Route('/{id}/edit', array(
    '_controller' => 'AcmeChildrenBundle:Doctors:edit',
)));

$collection->add('doctors_update', new Route(
    '/{id}/update',
    array('_controller' => 'AcmeChildrenBundle:Doctors:update'),
    array('_method' => 'post')
));

$collection->add('doctors_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AcmeChildrenBundle:Doctors:delete'),
    array('_method' => 'post')
));

return $collection;
