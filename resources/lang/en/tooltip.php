<?php

return [

    'common'=>[
        'label'=>[
            'action'=>'View Edit Delete',
            'description'=>'Description',
        ],
        'icon' =>[
            'edit'=>'Edit Record',
            'delete'=>'Delete Record',
            'eye'=>'View Detail',
            'recover'=>'Recover the deleted record',
        ],
    ],
    'ticket'=>[
        'status'=>[
            'new' => 'Not viewed ever',
            'open' => 'Once viewed by operator',
            'pending' => 'Pending',
            'on-hold' => 'On-hold',
            'solved' => 'Solved',
            'closed' => 'Closed'
        ],

        'label'=>[
            'subject'=>'Subject',
            'title'=>'Title',
            'site'=>'Site',
            'assign'=>'Assigne',
            'content'=>'Content',
            'mark'=>'More Actions',
            'action'=>'View Edit Delete',
            'close'=>'Close Ticket',
        ],
        'icon' =>[
            'checked'=>'Change Status to',
            'file'=>'Add Evidence',
            'map'=>'View in Map',
        ],
        'form_field' =>[
            'activity_option'=>'It will show ticket at only setlected time.',
            'evidence'=>'Evidence of issue/report/problem',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Tickets, Events, Plan Activities, Alarms etc',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Tickets, Events, Plan Activities, Alarms etc'
    ],


    'duty'=>[
        'icon' =>[
            'subject_add_icon'=>'Add Subject for Duty',
            'checked'=>'Close ticket',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Tickets,Events,Plan Activities,Alarms etc',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Tickets, Events, Plan Activities, Alarms etc'
    ],

    'moduleunit'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Define unit price for each module',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Define unit price for each module'
    ],
    'unitpackage'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'User can order and purchase package and get/credit units of package',
    ],
    'unittransaction'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>"Transaction/Unit history of Domain",
    ],


    'services'=>[
        'form_field' =>[
            'site'=>'Site For Services',
            'manager'=>'Manager For Services',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Subject belongs to services',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Subject belongs to services'
    ],


    'subject'=>[
        'form_field' =>[
            'service'=>'Service for subject',
            'time_to_resolve'=>'Time (in Minuts) taken to resolve issue',
            'caller_list'=>'People assigned to subject',
            'upload_PDF'=>'Subject Detail Pdf View',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Subjects for Ticket',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Subjects for Ticket'
    ],


    'companies'=>[
        'form_field' =>[
            'business_type'=>'Business Type',
            'logo'=>'Logo of companies',
            'reference'=>'Reference of companies',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Companies List',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Companies'
    ],
    'companies_module'=>[
        'form_info_header'=>'How it\'s work',
        'index_info'=>'The company can select one or more chargeable module, based on assign module company would be charged'
    ],


    'site'=>[
        'form_field' =>[
            'company'=>'Site belongs to company',
            'site_type'=>'Type of site , i.e Gov.',
            'logo'=>'Logo of Site',
            'access_conditions'=>'Access Conditions',
            'default_email'=>'Default Email',
            'guard_presence'=>'Guard Presence',
            'digicode'=>'Digicode',
            'keybox_presence'=>'Keybox Presence',
            'keybox_code'=>'Keybox Code',
            'keybox_place'=>'Keybox Place',
            'keybox_issue'=>'Keybox Issue',
            'known_issue'=>'Known Issue',
            'instructions_tasks_file'=>'Instructions Tasks File',
            'order_file'=>'Order File',
            'procedures_file'=>'Procedures File',
            'sitemaps_file'=>'Sitemaps File',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Building belongs to Site',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Building belongs to Site'
    ],


    'building'=>[
        'form_field' =>[
            'site'=>'Building belongs to Site',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Buildings , It\'s belongs to site',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Buildings , It\'s belongs to site'
    ],


    'equipment'=>[
        'form_field' =>[
            'equipment_id'=>'Unique ID for equipment',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'List of available Equipments',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'List of available Equipments'
    ],


    'audit'=>[
        'form_field' =>[
            'table_name'=>'Table Name',
            'table_row_id'=>'Table Row Id',
            'old_values'=>'Old Values',
            'audit_by'=>'Audit Added By Someone',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'List of table audit',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'List of table audit'
    ],

    'people'=>[
        'form_field' =>[
            'User'=>'People Belongs to some user - Manager',
            'Services'=>'Services',
            'Title'=>'Title',
            'Quality'=>'Quality',
            'Emergancy_Password'=>'Emergancy Password',
            'Availability'=>'Availability',
            'Hold_Key'=>'Hold Key',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'List of People',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'List of People'
    ],

    'permission'=>[
        'form_field' =>[
            'Parent_Permission'=>'Parent Permission',
            'name'=>'Permission name',
            'label'=>'Permission desplay name',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'List of Permission , Permission belongs to role',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'List of Permission , Permission belongs to role'
    ],


    'role'=>[
        'form_field' =>[
            'name'=>'Role name',
            'label'=>'Role desplay name',
            'permission'=>'Role Can have many permission',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'User can have one or more roles , and as per role permission user can access modules',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'User can have one or more roles , and as per role permission user can access modules'
    ],


    'website'=>[
        'form_field' =>[
            'domain'=>'Sub domain Of website ',
            'logo_image'=>'Logo Image For Website',
            'master'=>'Main site , Allow all access',
        ],
        'index_info_header'=>'How it\'s work',
        'index_info'=>'List of all availabel Website and with permission. Master type website have access of all websites. Non-master website have only access of it\'s own data',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'List of all availabel Website and with permission. Master type website have access of all websites. Non-master website have only access of it\'s own data'
    ],


    'api_access'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Api List and process steps.. , Generate and Get Access Key ',
        'form_info_header'=>'',
        'form_info'=>''
    ],

    'dropdownvalue'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Dropdown Value',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Dropdown Value'
    ],

    'dropdowntype'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Dropdown Type ',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Dropdown Type'
    ],

    'language'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'language  Available for site',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'language  Available for site'
    ],

    'profile'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'profile Detail',
        'form_info_header'=>'How it\'s work',
        'form_info'=>''
    ],

    'setting'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Store some constant value',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Store some constant value'
    ],

    'user'=>[
        'index_info_header'=>'How it\'s work',
        'index_info'=>'Website Auth User , User can have one or more role and can access modules as per role.',
        'form_info_header'=>'How it\'s work',
        'form_info'=>'Website Auth User , User can have one or more role and can access modules as per role.'
    ],

];
