<?php
return [
    'admin_routes' => [
        'namespace' => 'Admin\\',
        'prefix' => 'admin',
        'global_groups' => [
            [
                'group_namespace' => 'School',
                'group_prefix' => 'school',
                'pages' =>
                    [
                        ['students', 'AdminSchoolStudentsController'],
                        ['teachers', 'AdminSchoolTeachersController'],
                        ['groups', 'AdminSchoolGroupsController'],
                        ['ticketCountTypes', 'AdminSchoolTicketCountTypesController']
                    ]
            ]
        ]
    ],
];
?>
