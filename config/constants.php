<?php

const PROJECT_STATUS = [
  'kick-off'    => ['label' => 'Kick Off', 'style'    => 'bg-green-700'],
  'design'      => ['label' => 'Design', 'style'      => 'bg-violet-500'],
  'development' => ['label' => 'Development', 'style' => 'bg-amber-600'],
  'staging'     => ['label' => 'Staging', 'style'     => 'bg-lime-600'],
  'testing'     => ['label' => 'Testing', 'style'     => 'bg-yellow-500'],
  'production'  => ['label' => 'Production', 'style'  => 'bg-blue-500'],
];

const TASK_STATUS = [
  'pending'     => ['label' => 'Pending', 'style'     => 'bg-yellow-500'],
  'in-progress' => ['label' => 'In Progress', 'style' => 'bg-sky-500'],
  'completed'   => ['label' => 'Completed', 'style'   => 'bg-green-700'],
  'dropped'     => ['label' => 'Dropped', 'style'     => 'bg-red-600'],
];

const NAV_LINKS = [
  ''         => ['label' => 'Dashboard', 'icon' => 'dashboard'],
  'clients'  => ['label' => 'Clients', 'icon' => 'client'],
  'projects' => ['label' => 'Projects', 'icon' => 'project'],
  'tasks'    => ['label' => 'Tasks', 'icon' => 'task'],
  'users'    => ['label' => 'Users', 'icon' => 'user'],
  'roles'    => ['label' => 'Roles', 'icon' => 'role'],
];

const CLIENT_TABLE_COLUMNS = [
  'company' => [
    'label'    => 'Company',
    'type'     => 'string',
    'sortable' => true
  ],
  'vat' => [
    'label'    => 'VAT',
    'type'     => 'string',
    'sortable' => false
  ],
  'email' => [
    'label'    => 'Email',
    'type'     => 'string',
    'sortable' => true
  ],
  'phone' => [
    'label'    => 'Phone',
    'type'     => 'string',
    'sortable' => false
  ],
  'active' => [
    'label'    => 'Active',
    'type'     => 'boolean',
    'sortable' => false
  ],
  'actions' => [
    'label'    => 'Actions',
    'type'     => 'actions',
    'sortable' => false
  ] 
];

const PROJECT_TABLE_COLUMNS = [
  'title' => [
    'label'    => 'Title',
    'type'     => 'string',
    'sortable' => true
  ],
  'deadline' => [
    'label'    => 'Deadline',
    'type'     => 'string',
    'sortable' => true
  ],
  'status' => [
    'label'    => 'Status',
    'type'     => 'lookup',
    'lookup'   => PROJECT_STATUS,
    'sortable' => true
  ],
  'cost' => [
    'label'    => 'Cost',
    'type'     => 'currency',
    'sortable' => true
  ],
  'actions' => [
    'label'    => 'Actions',
    'type'     => 'actions',
    'sortable' => false
  ]
];

const TASK_TABLE_COLUMNS = [
  'title' => [
    'label'    => 'Title',
    'type'     => 'string',
    'sortable' => true
  ],
  'deadline' => [
    'label'    => 'Deadline',
    'type'     => 'string',
    'sortable' => true
  ],
  'status' => [
    'label'    => 'Status',
    'type'     => 'lookup',
    'lookup'   => TASK_STATUS,
    'sortable' => true
  ],
  'cost' => [
    'label'    => 'Cost',
    'type'     => 'currency',
    'sortable' => true
  ],
  'actions' => [
    'label'    => 'Actions',
    'type'     => 'actions',
    'sortable' => false
  ]
];

const CURRENCY = 'EUR';

const MIN_COST = 100;

const MAX_COST = 10000;

const PAGE_LIMIT = 10;

return [
  'PROJECT_STATUS'        => PROJECT_STATUS,
  'TASK_STATUS'           => TASK_STATUS,
  'MIN_COST'              => MIN_COST,
  'MAX_COST'              => MAX_COST,
  'NAV_LINKS'             => NAV_LINKS,
  'CLIENT_TABLE_COLUMNS'  => CLIENT_TABLE_COLUMNS,
  'PROJECT_TABLE_COLUMNS' => PROJECT_TABLE_COLUMNS,
  'TASK_TABLE_COLUMNS'    => TASK_TABLE_COLUMNS,
  'PAGE_LIMIT'            => PAGE_LIMIT,
  'CURRENCY'              => CURRENCY
];