<?php
//Test
return array(
    'controllers' => array(
        'invokables' => array(
            'Book\Controller\Book' => 'Book\Controller\BookController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'book' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/book[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Book\Controller\Book',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'issuebook' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/issuebook',
                            'defaults' => array(
                                'controller' => 'Book\Controller\Book',
                                'action' => 'issuebook',
                            )
                        )
                    ),
                ),        
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'book' => __DIR__ . '/../view',
        ),
    ),
);