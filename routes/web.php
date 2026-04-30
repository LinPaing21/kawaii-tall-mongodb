<?php

use App\Models\Exam;
use App\Livewire\SupportUs;
use App\Livewire\Auth\Login;
use App\Livewire\ContactUs;
use App\Livewire\ExamResult;
use App\Livewire\Auth\Verify;
use App\Livewire\ResultDetail;
use App\Livewire\Auth\Register;
use App\Livewire\ExamSelection;
use App\Livewire\ResultHistory;
use App\Livewire\ExamParticipate;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Passwords\Confirm;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\EmailVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('robots.txt', function () {
    $content = implode("\n", [
        'User-agent: *',
        'Disallow: /admin',
        'Disallow: /login',
        'Disallow: /register',
        'Disallow: /password',
        'Disallow: /email',
        'Disallow: /results',
        '',
        'Sitemap: ' . url('/sitemap.xml'),
    ]);

    return response($content, 200)->header('Content-Type', 'text/plain');
});

Route::get('sitemap.xml', function () {
    $exams = Exam::select(['_id', 'level', 'year'])->get();

    $urls = collect([
        ['loc' => url('/'),            'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => url('/exams'),       'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => url('/contact-us'),  'priority' => '0.5', 'changefreq' => 'yearly'],
        ['loc' => url('/support-us'),  'priority' => '0.4', 'changefreq' => 'yearly'],
    ]);

    foreach ($exams as $exam) {
        $urls->push([
            'loc'        => url("/exams/{$exam->id}"),
            'lastmod'    => $exam->updated_at?->toAtomString(),
            'priority'   => '0.8',
            'changefreq' => 'monthly',
        ]);
    }

    return response()->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::view('/', 'welcome')->name('home');
// localization
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'my', 'ja'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('set-locale');

Route::get('exams', ExamSelection::class)->name('exam-selection');
Route::get('exams/{exam}', ExamParticipate::class)->name('exam-participate');
Route::get('results', ResultHistory::class)->middleware('auth')->name('exam-results');
Route::get('results/{result}', ExamResult::class)->name('exam-result');
Route::get('results/{result}/detail', ResultDetail::class)->name('exam-result-detail');
Route::get('contact-us', ContactUs::class)->name('contact-us');
Route::get('support-us', SupportUs::class)->name('support-us');
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');

    // OAuth
    Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
