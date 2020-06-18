<?php

// Create new Plates instance
$templates = new League\Plates\Engine('../app/views');

// Render a template
echo $templates->render('homepage',
    ['name' => 'Sergey',

    ]);