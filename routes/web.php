<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProfileController,
    AuthController,
    Auth\RegisterController,
    Auth\ResetPasswordController,
    Auth\ForgotPasswordController,
    TeacherController,
    AdminProfileController,
    AdminAuthController,
    AdminController,
    ManagerController,
    CEOController,
    CourseController
};

// Home route
Route::get('/', function () {
    return view('home');
});

// Authentication routes using AuthController
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Home route after login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route for showing the 'kind' view
Route::get('/kind', function () {
    return view('kind');
})->name('kind');

// Profile routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile3/show', [ProfileController::class, 'show'])->name('profile3.show');
    Route::get('/profile3/edit', [ProfileController::class, 'edit'])->name('profile3.edit');
    Route::put('/profile3/update', [ProfileController::class, 'update'])->name('profile3.update');
    Route::get('/profile/image_display', function () {
        return view('profile.image_display');
    })->name('profile.image_display');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

// Password reset routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Course routes
Route::get('/course/add', [CourseController::class, 'showAddCourseForm'])->name('course.add');
Route::post('/course/add', [CourseController::class, 'add']);

// Admin authentication routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/download-qr', [AdminController::class, 'downloadQrCode'])->name('users.downloadQrCode');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::delete('/users/bulk-delete', [AdminController::class, 'bulkDelete'])->name('users.bulk-delete');

    // Routes for managing courses
    Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
    Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
     // Route to delete a course
    Route::delete('/courses/{course}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
    // Routes for managing teachers
    Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
    Route::post('/teachers/store', [AdminController::class, 'storeTeacher'])->name('teachers.store');
    Route::delete('/teachers/{teacher}', [AdminController::class, 'destroyTeacher'])->name('teachers.destroy');
    Route::get('/teachers/{teacher}/qrcode', [AdminController::class, 'showTeacherQrCode'])->name('teachers.qrcode');

    // Routes for managing CEOs
Route::get('/ceos/create', [AdminController::class, 'createCeoManager'])->name('ceos.create');
Route::get('/ceos/{ceo}/qrcode', [AdminController::class, 'showCeoQrCode'])->name('ceos.qrcode');
Route::get('/managers/{manager}/qrcode', [AdminController::class, 'showManagerQrCode'])->name('managers.qrcode');

// Route to generate a certificate for a user
Route::get('/users/{user}/generate-certificate/{course}', [AdminController::class, 'generateCertificateForm'])->name('generateCertificateForm');
Route::post('/users/{user}/generate-certificate/{course}', [AdminController::class, 'generateCertificate'])->name('generateCertificate');

// Primary course certificate date route
Route::get('/users/{user}/certificateDate/{course2}', [AdminController::class, 'showCertificateDateForm'])
    ->name('users.certificateDate');
Route::post('/users/{user}/course2/{course2}/certificate-date', [AdminController::class, 'storeCourseTimes'])
    ->name('users.storeCourseTimes');
Route::get('/users/{user}/course2/{course2}/certificate', [AdminController::class, 'showCertificate'])
    ->name('users.showCertificate');


// Routes for additional courses
Route::get('/users/{user}/additionalCertificateDate/{courseProfile3}', [AdminController::class, 'showCertificateDateFormForAdditionalCourse'])
    ->name('users.additionalCertificateDate');
Route::post('/users/{user}/courseProfile3/{courseProfile3}/additional-certificate-date', [AdminController::class, 'storeAdditionalCourseCertificate'])
    ->name('users.storeAdditionalCourseCertificate');
Route::get('/users/{user}/courseProfile3/{courseProfile3}/additional-certificate', [AdminController::class, 'showAdditionalCourseCertificate'])
    ->name('users.showAdditionalCourseCertificate');
Route::post('/users/{user}/courseProfile3/{courseProfile3}/generate-certificate', [AdminController::class, 'generateAdditionalCourseCertificate'])
    ->name('users.generateAdditionalCourseCertificate');
});


// Teacher authentication routes
Route::get('teacher/login', [TeacherController::class, 'showLoginForm'])->name('teacher.login');
Route::post('teacher/login', [TeacherController::class, 'login'])->name('teacher.login.submit');

// Teacher profile route

Route::get('teacher/profile', [TeacherController::class, 'profile'])->name('teacher.profile');
Route::post('teacher/logout', [TeacherController::class, 'logout'])->name('teacher.logout');

    // Fetch students for selected course

Route::get('teacher/course/{course22_id}/profile3s', [TeacherController::class, 'getStudents'])->name('teacher.course.profile3s');

Route::get('/teacher/show/{id}', [TeacherController::class, 'show'])->name('teacher.show');

// Routes for managing normal and CEO managers
Route::get('admin/add_manager', [AdminController::class, 'showAddManagerForm'])->name('admin.add_manager');
Route::get('admin/managers/create', [AdminController::class, 'createManager'])->name('admin.managers.create');
Route::post('admin/managers/store', [AdminController::class, 'storeManager'])->name('admin.managers.store');
Route::delete('admin/managers/{id}', [AdminController::class, 'destroyManager'])->name('admin.managers.destroy');

Route::get('admin/ceo_managers/create', [AdminController::class, 'createCeoManager'])->name('admin.ceo_managers.create');
Route::post('admin/ceo_managers', [AdminController::class, 'storeCeoManager'])->name('admin.ceo_managers.store');
Route::delete('admin/ceo_managers/{id}', [AdminController::class, 'destroyCeoManager'])->name('admin.ceo_managers.destroy');


Route::get('/admin/users/search', [AdminController::class, 'search'])->name('admin.users.search');


//Route::get('manager/login', [ManagerController::class, 'showLoginForm'])->name('manager.login');
//Route::get('manager/profile', [ManagerController::class, 'profile'])->name('manager.profile');
//Route::get('manager/users/{user}/download-qr', [ManagerController::class, 'downloadQrCode'])->name('manager.users.downloadQrCode');
//Route::post('manager/logout', [ManagerController::class, 'logout'])->name('manager.logout');



//Route::get('manager/users/{user}', [ManagerController::class, 'show'])->name('manager.users.show');

//Route::get('manager/course/{course_id}/profiles', [ManagerController::class, 'getProfilesByCourse'])->name('manager.course.profiles');
// Manager routes
//Route::prefix('manager')->group(function () {
  //  Route::get('profile', [ManagerController::class, 'Profile'])->name('manager.profile');
   // Route::get('users/{user}', [ManagerController::class, 'showUser'])->name('manager.users.show');
//});

// ceo routes


Route::get('ceo/login', [CEOController::class, 'showLoginForm'])->name('ceo.login');
Route::post('ceo/login', [CEOController::class, 'login'])->name('ceo.login.submit');
Route::post('ceo/logout', [CEOController::class, 'logout'])->name('ceo.logout');

Route::get('ceo/profile', [CEOController::class, 'profile'])->name('ceo.profile');
Route::get('ceo/users/{user}', [CEOController::class, 'show'])->name('ceo.users.show');
Route::get('ceo/users/{user}/download-qr', [CEOController::class, 'downloadQrCode'])->name('ceo.users.downloadQrCode');
Route::get('ceo/course/{course_id}/profiles', [CEOController::class, 'getProfilesByCourse'])->name('ceo.course.profiles');
Route::get('ceo/teachers/create', [CEOController::class, 'createTeacher'])->name('ceo.teachers.create');
Route::post('ceo/teachers/store', [CEOController::class, 'storeTeacher'])->name('ceo.teachers.store');
Route::delete('ceo/teachers/{teacher}', [CEOController::class, 'destroyTeacher'])->name('ceo.teachers.destroy');
Route::get('ceo/teachers/{id}/qr', [CEOController::class, 'showQrCode'])->name('ceo.teachers.qr');

//Route::get('ceo/login', function () {
 //   return view('ceo.login'); // Placeholder, you will create this view later
//})->name('ceo.login');



// ceo routes
Route::get('manager/login', [ManagerController::class, 'showLoginForm'])->name('manager.login');
Route::post('manager/login', [ManagerController::class, 'login'])->name('manager.login.submit');
Route::get('manager/profile', [ManagerController::class, 'profile'])->name('manager.profile');
Route::get('manager/users/{user}/download-qr', [ManagerController::class, 'downloadQrCode'])->name('manager.users.downloadQrCode');
Route::post('manager/logout', [ManagerController::class, 'logout'])->name('manager.logout');


Route::get('/manager/users/{id}', [ManagerController::class, 'show'])->name('manager.users.show');
Route::get('manager/users/{user}/download-qr', [ManagerController::class, 'downloadQrCode'])->name('manager.users.downloadQrCode');
Route::get('manager/course/{course_id}/profiles', [ManagerController::class, 'getProfilesByCourse'])->name('manager.course.profiles');

//Route::get('ceo/login', function () {
 //   return view('ceo.login'); // Placeholder, you will create this view later
//})->name('ceo.login');



Route::get('manager/teachers/create', [ManagerController::class, 'createTeacher'])->name('manager.teachers.create');
Route::post('manager/teachers/store', [ManagerController::class, 'storeTeacher'])->name('manager.teachers.store');
Route::delete('manager/teachers/{teacher}', [ManagerController::class, 'destroyTeacher'])->name('manager.teachers.destroy');
Route::get('manager/teachers/{id}/qr', [ManagerController::class, 'showQrCode'])->name('manager.teachers.qr');


// Manager routes

Route::get('/robotech', function () {
    return view('dropdown.robotech');
})->name('robotech');


Route::get('/industrial', function () {
    return view('dropdown.industrial');
})->name('industrial');



Route::get('/automation', function () {
    return view('dropdown.automation');
})->name('automation');

Route::get('/development', function () {
    return view('dropdown.development');
})->name('development');


Route::get('/download', function () {
    return view('prog.download');
})->name('download');


