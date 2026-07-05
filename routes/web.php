<?php

declare(strict_types=1);

use App\Http\Controllers\ChecklistAnswerController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeclarationController;
use App\Http\Controllers\ExpedientController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/dashboard',

        [DashboardController::class, 'index']

    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Empresas
    |--------------------------------------------------------------------------
    */

    Route::resource(

        'companies',

        CompanyController::class

    );

    /*
    |--------------------------------------------------------------------------
    | Periodos
    |--------------------------------------------------------------------------
    */

    Route::resource(

        'periods',

        PeriodController::class

    );

    Route::patch(

        'periods/{period}/close',

        [PeriodController::class, 'close']

    )->name('periods.close');

    Route::patch(

        'periods/{period}/open',

        [PeriodController::class, 'open']

    )->name('periods.open');

    /*
    |--------------------------------------------------------------------------
    | Expedientes
    |--------------------------------------------------------------------------
    */

    Route::resource(

        'expedients',

        ExpedientController::class

    )->only([

        'index',

        'show',

    ]);

    /*
    |--------------------------------------------------------------------------
    | Checklists
    |--------------------------------------------------------------------------
    */

    Route::put(

        'expedients/{expedient}/checklists/{checklist}',

        [ChecklistAnswerController::class, 'update']

    )->name('checklists.update');

    /*
    |--------------------------------------------------------------------------
    | Declaración
    |--------------------------------------------------------------------------
    */
    Route::post(

        'expedients/{expedient}/observation',

        [ExpedientController::class, 'saveObservation']

    )->name('expedients.observation');
    
    Route::post(

        'expedients/{expedient}/declare',

        [DeclarationController::class, 'store']

    )->name('expedients.declare');

    /*
    |--------------------------------------------------------------------------
    | Reportes
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/reports',

        [ReportController::class, 'index']

    )->name('reports.index');

    /*
    |--------------------------------------------------------------------------
    | Configuración
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/configuration',

        [ConfigurationController::class, 'index']

    )->name('configuration.index');

    Route::put(

        '/configuration/ruc-assignment',

        [ConfigurationController::class, 'updateAssignment']

    )->name('configuration.assignment.update');

});

require __DIR__.'/auth.php';