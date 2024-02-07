<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// landing page
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Landing\CertificateController;
use App\Http\Controllers\Landing\PresenceController;
use App\Http\Controllers\Landing\LandingController;

// admin
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Admin\ModeratorController;
use App\Http\Controllers\Admin\SignatureController;
use App\Http\Controllers\Admin\Blog\AuthorController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\Blog\ArticleController;
use App\Http\Controllers\Admin\CollaborationController;
use App\Http\Controllers\Account\ChangePasswordController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Blog\ArticleCategoryController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\Participant\FormRegisterController;
use App\Http\Controllers\Admin\SkSignatureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//   return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// landing
Route::prefix('/')->name('home')->group(function () {
  Route::get('/', [LandingController::class, 'index'])->name('.index');
  Route::get('/artikel', [LandingController::class, 'artikel'])->name('.artikel');

  // user
  Route::prefix('user')->name('.user')->group(function () {

    //pendaftaran
    Route::prefix('register')->name('.register')->group(function () {
      Route::get('/', [FormRegisterController::class, 'index'])->name('.index');
      Route::post('store', [FormRegisterController::class, 'store'])->name('.store');
      Route::get('success/{register_code}', [FormRegisterController::class, 'success'])->name('.success');
    });

    // absensi
    Route::prefix('presence')->name('.presence')->group(function () {
      Route::get('/', [PresenceController::class, 'index'])->name('.index');
      Route::post('submit', [PresenceController::class, 'submit'])->name('.submit');
    });

    // sertifikat
    Route::prefix('certificate')->name('.certificate')->group(function () {
      Route::get('/', [CertificateController::class, 'index'])->name('.index');
      Route::post('submit', [CertificateController::class, 'submit'])->name('.submit');
      Route::post('create/{certificate_code}', [CertificateController::class, 'download'])->name('.create');
    });
  });
});

// midleware admin
Route::group(['middleware' => 'auth'], function () {

  // redirect default route admin dashboard
  Route::get('/home', function () {
    return redirect()->to('/admin/dashboard');
  });

  // Keamanan
  Route::prefix('account')->group(function () {
    Route::get('/', function () {
      return redirect()->route('profile.index');;
    })->name('account.index');
    Route::prefix('my-profile')->name('profile')->group(function () {
      Route::get('/', [ProfileController::class, 'index'])->name('.index');
      Route::put('update', [ProfileController::class, 'update'])->name('.update');
    });
    Route::prefix('security')->name('change-password')->group(function () {
      Route::get('/', [ChangePasswordController::class, 'index'])->name('.index');
      Route::put('update', [ChangePasswordController::class, 'update'])->name('.update');
    });
  });

  // route admin
  Route::prefix('admin')->name('admin')->group(function () {

    // dashboard
    Route::prefix('dashboard')->name('.dashboard')->group(function () {
      Route::get('/', [DashboardController::class, 'index'])->name('.index');
    });

    // Training prefix
    Route::prefix('training')->name('.training')->group(function () {

      // Pelatihan
      Route::get('/', [TrainingController::class, 'index'])->name('.index');
      Route::post('new', [TrainingController::class, 'new'])->name('.new');
      Route::post('store', [TrainingController::class, 'store'])->name('.store');
      Route::post('edit', [TrainingController::class, 'edit'])->name('.edit');
      Route::get('show/{id}', [TrainingController::class, 'show'])->name('.show');
      Route::put('finish/{id}', [TrainingController::class, 'finish'])->name('.finish');
      Route::put('update', [TrainingController::class, 'update'])->name('.update');
      Route::delete('{id}/destroy', [TrainingController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');

      // pemateri
      Route::prefix('speaker')->name('.speaker')->group(function () {
        Route::get('/', [SpeakerController::class, 'index'])->name('.index');
        Route::post('new', [SpeakerController::class, 'new'])->name('.new');
        Route::post('store', [SpeakerController::class, 'store'])->name('.store');
        Route::post('edit', [SpeakerController::class, 'edit'])->name('.edit');
        Route::put('presence/{id}', [SpeakerController::class, 'presence'])->name('.presence');
        Route::put('update', [SpeakerController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [SpeakerController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
        Route::post('certificate/{certificate_code}', [CertificateController::class, 'speaker'])->name('.certificate');
        Route::post('invitation/{id}', [InvitationController::class, 'speaker'])->name('.invitation');
      });

      // moderator
      Route::prefix('moderator')->name('.moderator')->group(function () {
        Route::get('/', [ModeratorController::class, 'index'])->name('.index');
        Route::post('new', [ModeratorController::class, 'new'])->name('.new');
        Route::post('store', [ModeratorController::class, 'store'])->name('.store');
        Route::post('edit', [ModeratorController::class, 'edit'])->name('.edit');
        Route::put('presence/{id}', [ModeratorController::class, 'presence'])->name('.presence');
        Route::put('update', [ModeratorController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [ModeratorController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
        Route::post('certificate/{certificate_code}', [CertificateController::class, 'moderator'])->name('.certificate');
        Route::post('invitation/{id}', [InvitationController::class, 'moderator'])->name('.invitation');
      });

      // colaboration
      Route::prefix('collaboration')->name('.collaboration')->group(function () {
        Route::get('/', [CollaborationController::class, 'index'])->name('.index');
        Route::post('new', [CollaborationController::class, 'new'])->name('.new');
        Route::post('store', [CollaborationController::class, 'store'])->name('.store');
        Route::post('edit', [CollaborationController::class, 'edit'])->name('.edit');
        Route::put('update', [CollaborationController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [CollaborationController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
      });
    });

    // prefix participant
    Route::prefix('participant')->name('.participant')->group(function () {
      Route::get('/', [ParticipantController::class, 'index'])->name('.index');
      Route::post('new', [ParticipantController::class, 'new'])->name('.new');
      Route::post('store', [ParticipantController::class, 'store'])->name('.store');
      Route::post('edit', [ParticipantController::class, 'edit'])->name('.edit');
      Route::put('update', [ParticipantController::class, 'update'])->name('.update');
      Route::put('presence/{id}', [ParticipantController::class, 'presence'])->name('.presence');
      Route::get('{id}', [ParticipantController::class, 'show'])->where('id', '[0-9]+')->name('.detail');
      Route::delete('{id}/destroy', [ParticipantController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');

      Route::prefix('presence')->name('.presence')->group(function () {
        Route::get('/', [ParticipantController::class, 'presence'])->name('.index');
      });
    });

    // Atur sertifikat
    Route::prefix('certificate')->name('.certificate')->group(function () {
      Route::get('/', [CertificateController::class, 'index'])->name('.index');

      // signature
      Route::prefix('signature')->name('.signature')->group(function () {
        Route::get('/', [SignatureController::class, 'index'])->name('.index');
        Route::post('new', [SignatureController::class, 'new'])->name('.new');
        Route::post('store', [SignatureController::class, 'store'])->name('.store');
        Route::post('edit', [SignatureController::class, 'edit'])->name('.edit');
        Route::put('update', [SignatureController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [SignatureController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
      });
    });

    // Prefix SK udangan
    Route::prefix('invitation')->name('.invitation')->group(function () {
      // Route::get('/', [InvitationController::class, 'index'])->name('.index');
      // signature
      Route::prefix('signature')->name('.signature')->group(function () {
        Route::get('/', [SkSignatureController::class, 'index'])->name('.index');
        Route::post('new', [SkSignatureController::class, 'new'])->name('.new');
        Route::post('store', [SkSignatureController::class, 'store'])->name('.store');
        Route::post('edit', [SkSignatureController::class, 'edit'])->name('.edit');
        Route::put('update', [SkSignatureController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [SkSignatureController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
      });
    });

    // articles
    Route::prefix('blog')->name('.blog')->group(function () {
      Route::get('/', function () {
        return redirect()->route('admin.blog.article.index');
      })->name('.index');
      Route::prefix('article')->name('.article')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('.index');
        Route::get('create', [ArticleController::class, 'create'])->name('.create');
        Route::post('store', [ArticleController::class, 'store'])->name('.store');
        Route::get('{id}', [ArticleController::class, 'show'])->name('.show');
        Route::get('{id}/edit', [ArticleController::class, 'edit'])->name('.edit');
        Route::put('update', [ArticleController::class, 'update'])->name('.update');
        Route::put('publish', [ArticleController::class, 'publish'])->name('.publish');
        Route::delete('{id}/destroy', [ArticleController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
      });
      Route::prefix('author')->name('.author')->group(function () {
        Route::get('/', [AuthorController::class, 'index'])->name('.index');
        Route::post('store', [AuthorController::class, 'store'])->name('.store');
        Route::post('edit', [AuthorController::class, 'edit'])->name('.edit');
        Route::put('update', [AuthorController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [AuthorController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
      });
      Route::prefix('article-category')->name('.article-category')->group(function () {
        Route::get('/', [ArticleCategoryController::class, 'index'])->name('.index');
        Route::post('store', [ArticleCategoryController::class, 'store'])->name('.store');
        Route::post('edit', [ArticleCategoryController::class, 'edit'])->name('.edit');
        Route::put('update', [ArticleCategoryController::class, 'update'])->name('.update');
        Route::delete('{id}/destroy', [ArticleCategoryController::class, 'destroy'])->where('id', '[0-9]+')->name('.destroy');
      });
    });
  });
});
