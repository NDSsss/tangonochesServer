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
                        ['students', 'AdminSchoolStudentsController'],//0
                        ['teachers', 'AdminSchoolTeachersController'],//1
                        ['groups', 'AdminSchoolGroupsController'],//2
                        ['ticketCountTypes', 'AdminSchoolTicketCountTypesController'],//3
                        ['ticketEventTypes', 'AdminSchoolTicketEventTypesController'],//4
                        ['lessons', 'AdminSchoolLessonsController'],//5
                        ['tickets', 'AdminSchoolTicketsController'],//6
                        ['studentsLessonsLeft', 'StudentsLessonsLeftController'],//7
                        ['lessonAnnounces', 'AdminSchoolLessonAnnouncesController'],//8
                        ['eventAnnounces', 'AdminSchoolEventAnnouncesController'],//9
                        ['notifications', 'AdminSchoolNotificationController'],//10
                    ]
            ]
        ]
    ],
];
?>
