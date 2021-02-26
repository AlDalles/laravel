<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome']);
});*/


Route::get('/',[\App\Http\Controllers\PostController::class , 'index']);
Route::get('/search',[\App\Http\Controllers\PostController::class , 'search']);
Route::post('/search',[\App\Http\Controllers\PostController::class , 'searchResult']);

Route::get('/category/list',[\App\Http\Controllers\CategoryController::class,'index']);   //вывод таблицы категорий
Route::get('/category/create',[\App\Http\Controllers\CategoryController::class , 'create']); // создание категории из пункта меню
Route::post('/category/create',[\App\Http\Controllers\CategoryController::class , 'store']); // сохранение категории после создания

Route::get('/category/{id}/update',[\App\Http\Controllers\CategoryController::class , 'edit']); // редактирование категории после выбора из таблицы
Route::post('/category/{id}/update',[\App\Http\Controllers\CategoryController::class , 'update']); // сохранение отредактированной категории после выбора из таблицы


Route::get('/category/{id}/delete',[\App\Http\Controllers\CategoryController::class , 'destroy']); //  удаление категории из таблицы

Route::get('/category/delete1',[\App\Http\Controllers\CategoryController::class , 'delete_many']); // вывод списка категорий для удаления из пункта меню
Route::get('/category/delete_many',[\App\Http\Controllers\CategoryController::class , 'destroy_many']); // удаление категорий после выбора из списка ( после выбора из списка)


Route::get('/category/update1',[\App\Http\Controllers\CategoryController::class , 'edit_select']); // вывод списка категорий для редактирования из пункта меню
Route::post('/category/update',[\App\Http\Controllers\CategoryController::class , 'edit1']); // редактирование категории после выбора из пункта меню


Route::get('/tag/list',[\App\Http\Controllers\TagController::class , 'index']);   //вывод таблицы категорий
Route::get('/tag/create',[\App\Http\Controllers\TagController::class , 'create']); // создание тега из пункта меню
Route::post('/tag/create',[\App\Http\Controllers\TagController::class , 'store']); // сохранение тега после создания


Route::get('/tag/{id}/delete',[\App\Http\Controllers\TagController::class , 'destroy']); //  удаление тега из таблицы

Route::get('/tag/delete1',[\App\Http\Controllers\TagController::class , 'delete_many']); // вывод списка тегов для удаления из пункта меню
Route::get('/tag/delete_many',[\App\Http\Controllers\TagController::class , 'destroy_many']); // удаление тегов после выбора из списка ( после выбора из списка)

Route::get('/tag/{id}/update',[\App\Http\Controllers\TagController::class , 'edit']); // редактирование тега после выбора из таблицы
Route::post('/tag/{id}/update',[\App\Http\Controllers\TagController::class , 'update']); // сохранение отредактированной тега после выбора из таблицы

Route::get('/tag/update1',[\App\Http\Controllers\TagController::class , 'edit_select']); // вывод списка тегов для редактирования из пункта меню
Route::post('/tag/update',[\App\Http\Controllers\TagController::class , 'edit1']); // редактирование тегов после выбора из пункта меню

Route::get('/post/list',[\App\Http\Controllers\PostController::class , 'index']);   //вывод постов
Route::get('/tag/{id}',[\App\Http\Controllers\PostController::class , 'posts_tag']);//ввывод постов по тегу
Route::get('/category/{id}',[\App\Http\Controllers\PostController::class , 'posts_category']); //вывод постов по категории
Route::get('/author/{id}',[\App\Http\Controllers\PostController::class , 'post_user']); //вывод постов по юзеру
Route::get('/post/create',[\App\Http\Controllers\PostController::class , 'create']);//создание нового поста
Route::post('/post/create',[\App\Http\Controllers\PostController::class , 'store']);//сохранение поста после добавления
Route::get('/post/{id}/edit',[\App\Http\Controllers\PostController::class , 'edit']);//передача поста на редактирование
Route::post('/post/{id}/edit',[\App\Http\Controllers\PostController::class , 'update']);// редактирование поста
Route::get('/post/{id}/delete',[\App\Http\Controllers\PostController::class , 'destroy']); //  удаление поста из таблицы
Route::get('/user/category',[\App\Http\Controllers\PostController::class , 'postUserCategoryViewUsers']);//поиск от автора pages/post/select-category
Route::post('/user/category',[\App\Http\Controllers\PostController::class , 'postUserCategoryViewCategories']);//поиск от автора
Route::post('/user/category/index',[\App\Http\Controllers\PostController::class , 'postUserCategoryView']);//поиск от автора

Route::get('/category/user',[\App\Http\Controllers\PostController::class , 'postCategoryUserViewCategory']);//поиск от категории
Route::post('/category/user',[\App\Http\Controllers\PostController::class , 'postCategoryUserViewUsers']);//поиск от категории
Route::post('/category/user/index',[\App\Http\Controllers\PostController::class , 'postCategoryUserView']);//поиск от категории

Route::get('/user/list',[\App\Http\Controllers\UserController::class , 'index']);   //вывод таблицы юзеров
Route::get('/user/create',[\App\Http\Controllers\UserController::class , 'create']); // создание юзера из пункта меню
Route::post('/user/create',[\App\Http\Controllers\UserController::class , 'store']); // сохранение юзера после создания


Route::get('/user/{id}/delete',[\App\Http\Controllers\UserController::class , 'destroy']); //  удаление юзера из таблицы

Route::get('/user/delete1',[\App\Http\Controllers\UserController::class , 'delete_many']); // вывод списка юзеров для удаления из пункта меню
Route::get('/user/delete_many',[\App\Http\Controllers\UserController::class , 'destroy_many']); // удаление юзеров после выбора из списка ( после выбора из списка)

Route::get('/user/{id}/update',[\App\Http\Controllers\UserController::class , 'edit']); // редактирование юзера после выбора из таблицы
Route::post('/user/{id}/update',[\App\Http\Controllers\UserController::class , 'update']); // сохранение отредактированной юзера после выбора из таблицы

Route::get('/user/update1',[\App\Http\Controllers\UserController::class , 'edit_select']); // вывод списка юзеров для редактирования из пункта меню
Route::post('/user/update',[\App\Http\Controllers\UserController::class , 'edit1']); // редактирование юзеров после выбора из пункта меню

