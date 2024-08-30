<?php

use Illuminate\Container\Container;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

// Load Laravel's bootstrap files
require_once __DIR__ . '/bootstrap/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(
    Illuminate\Http\Request::capture()
);

// Define paths
$viewsPath = __DIR__ . '/resources/views';
$outputPath = __DIR__ . '/public/static-html';

// Create the output directory if it doesn't exist
if (!File::exists($outputPath)) {
    File::makeDirectory($outputPath, 0755, true);
}

// Fixed data for the views
$data = [
    'user' => (object)[
        'id' => 1,
        'fname' => 'John',
        'lname' => 'Doe',
        'username' => 'johndoe',
        'email' => 'john.doe@example.com',
        'telephone' => '123-456-7890',
        'location' => 'New York',
        'course_place' => 'XYZ University',
        'course2' => (object)['name' => 'Computer Science'],
        'qr_code_path' => 'path/to/qrcode.svg'
    ],
    // Add more fixed data if necessary
];

// Function to render and save Blade views as HTML files
function renderAndSaveView($viewFile, $data, $outputPath)
{
    $viewName = basename($viewFile, '.blade.php');
    $htmlContent = View::make($viewName, $data)->render();
    $htmlFile = $outputPath . '/' . $viewName . '.html';
    File::put($htmlFile, $htmlContent);
}

// Render and save all Blade views
$viewFiles = File::allFiles($viewsPath);
foreach ($viewFiles as $file) {
    if (strpos($file->getExtension(), 'blade') !== false) {
        renderAndSaveView($file->getRealPath(), $data, $outputPath);
    }
}

echo "Static HTML files have been generated in '$outputPath'.\n";
