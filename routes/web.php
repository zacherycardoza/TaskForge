<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Models\Task;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', function () {
    $complete = Task::where('is_done', 1)->count();
    $incomplete = Task::where('is_done', 0)->count();
    return view('pages.dashboard', [
        'complete' => $complete,
        'incomplete' => $incomplete
    ]);
})->name('dashboard');

Route::resource('tasks', TaskController::class);
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
