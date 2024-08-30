<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class GenerateStaticHtml extends Command
{
    protected $signature = 'generate:static-html';
    protected $description = 'Generate static HTML for user details';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $html = View::make('user-details', compact('user'))->render();
            $fileName = public_path('static/user-details-' . $user->id . '.html');
            File::put($fileName, $html);
        }

        $this->info('Static HTML files generated successfully.');
    }
}
