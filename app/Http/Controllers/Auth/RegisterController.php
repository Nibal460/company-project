<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile3;
use Illuminate\Http\Request;

use Endroid\QrCode\Writer\PngWriter;
use App\Libraries\BaconQrCode\src\Writer;
use App\Libraries\BaconQrCode\src\Encoder;
use Spatie\Backtrace\Arguments\Reducers\BaseTypeArgumentReducer;
use App\Libraries\BaconQrCode\Renderer\ImageRenderer;
use App\Libraries\BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Common\Mode;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Common\ErrorCorre;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telephone' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        // Generate a unique username
        $username = $this->generateUniqueUsername($data['fname']);

        // Generate QR code
    $qrCodeText = $data['email'];
    $renderer = new ImageRenderer(
        new RendererStyle(200),
        new SvgImageBackEnd()
    );
    $writer = new Writer($renderer);
    $qrCodePath = 'qrcodes/' . uniqid() . '.svg';
    $qrCodeAbsolutePath = storage_path('app/public/' . $qrCodePath);

    // Save QR code to storage directory
    $writer->writeFile($qrCodeText, $qrCodeAbsolutePath);

    // Create the user
    $user = User::create([
        'fname' => $data['fname'],
        'lname' => $data['lname'],
        'username' => $username,
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'telephone' => $data['telephone'],
        'location' => $data['location'],
        'qr_code_path' => $qrCodePath,
    ]);

    // Create the user's profile
    Profile3::create([
        'user_id' => $user->id,
        'fname' => $data['fname'],
        'lname' => $data['lname'],
        'email' => $data['email'],
        'telephone' => $data['telephone'],
        'location' => $data['location'],
        'qr_code_path' => $qrCodePath,
    ]);

    return $user;
}

    public function register(Request $request)
    {
        Log::info('Register method called', ['request' => $request->all()]);

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $user = $this->create($request->all());
            DB::commit();

            // Log the user in after successful registration
            Auth::login($user);

            // Redirect the user after successful registration
            Log::info('Registration successful, redirecting to home page');
            return redirect('/home')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['registration_error' => 'Failed to register user. Please try again later.']);
        }


         // Generate QR code
         $mode = Mode::ALPHANUMERIC(); // Define the mode
         $qrCode = new QrCode($user->email, $mode); // Initialize QR code with the mode
         $renderer = new SaveImageBackend();
         $renderer->setHeight(250);
         $renderer->setWidth(250);
         $writer = new Writer($renderer);
         $qrCodePath = 'qrcodes/' . uniqid() . '.svg';
         $qrCodeAbsolutePath = public_path($qrCodePath);
         $writer->writeFile($qrCode, $qrCodeAbsolutePath); // Pass $qrCode instead of $qrCodeText

         // Store QR code path in the database
         $user->qr_code_path = $qrCodePath;
         $user->save();
    }

}