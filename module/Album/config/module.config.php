<?php

namespace Album;

use Album\Controller\AlbumController;
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Router\Http\Segment;

return [

    'router' => [
        'routes' => [
            'album' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'service_manager' => [
        'factories' => [
            'AlbumTable' =>  function($container) {

                $tableGateway = $container->get('AlbumTableGateway');
                $table = new AlbumTable($tableGateway);

                return $table;

            },

            'AlbumTableGateway' => function ($container) {

                $dbAdapter = $container->get(Adapter::class);
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Album());

                return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);

            },
        ],
    ],

    'controllers' => [
        'factories' => [
            AlbumController::class => function($container) {
                return new AlbumController(
                    $container->get('AlbumTable')
                );
            },
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];

