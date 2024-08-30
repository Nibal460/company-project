<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function show($userId)
    {
        $profile3 = User::find($userId);
        if (!$profile3) {
            abort(404, 'User not found');
        }

        // Check if the logged-in user is an admin
        if (Auth::user()->role === 'admin') {
            $users = User::all();
            return view('admin.show2', compact('users'));
        }

        return view('profile3.show', compact('profile3'));
    }

    public function downloadQrCode($userId)
    {
        // Retrieve user and associated QR code file path
        $user = User::findOrFail($userId);
        $qrCodeFilePath = public_path('storage/qrcodes/' . basename($user->qr_code_path));

        // Check if the QR code file exists
        if (file_exists($qrCodeFilePath)) {
            // Generate file download response
            return Response::download($qrCodeFilePath);
        } else {
            // Handle case when QR code file doesn't exist
            abort(404, 'QR code not found');
        }
    }
}
