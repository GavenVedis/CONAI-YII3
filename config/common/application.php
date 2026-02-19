<?php

declare(strict_types=1);

return [
    'charset' => 'UTF-8',
    'locale' => 'it',
    'name' => 'ECO TOOL CONAI',
    'nuova_homepage' => true,
    'chatbot' => false,
    'conaiInfoMail' => 'ecotoolconai@conai.org',
    'successDestination' => "@public/success_images/",
    'mpsSuccessDestination' => "@public/success_mps_images/",
    'domainName' => getenv('DOMAIN_NAME') . '/',
    'casi_successo' => true,
    'uploadDestination' => "@public/uploads/",
    'adminEmail' => 'noreply@ecotoolconai.org'
];
