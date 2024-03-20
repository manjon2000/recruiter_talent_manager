<?php

use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/**
 * Auth
 */

Route::post('/register', function (Request $request) {
    try {
        $request->validate([
            'name'      => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string'
        ]);

        $user = new User($request->all());
        $user->save();

        return response()->json([
            'token' => $user->createToken('personal_token')->plainTextToken,
        ], 201);

    } catch (ValidationException $errors) {
        return response()->json([
            'errors' => $errors->validator->getMessageBag()->toArray()
        ], 422);
    }
});

Route::post('/login', function (Request $request) {
    try {

        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $findUser = User::where('email', $request->email)->first();

        $validatePassword = Hash::check($request->password, $findUser->password);

        if($validatePassword) {
            return response()->json($findUser);
        }
        if(!$validatePassword) {
            return response()->json(['message' => 'Credential incorrect'], 401);
        }

    } catch (ValidationException $errors) {
        return response()->json([
            'errors' => $errors->validator->getMessageBag()->toArray()
        ], 422);
    }
});


/**
 * Route Group generic
 */

Route::middleware('auth:sanctum')->group(function () {

    /**
     * Get logged in user data
     */
    Route::get('/user', function(Response $response) {
        $user = User::where('id', Auth::user()->id)->first();
        return response()->json($user);
    });

    /**
     * TAGS
     */
    Route::prefix('/tags')->group(function () {
        Route::post('/create', function (Request $request) {

            if($request->name) {
                $findTag = tag::where('name', $request->name)->get();

                if(count($findTag) > 0) {
                    return response()->json(['message' => 'Tag duplicate'], 409);
                }

                $createTag = new Tag([
                    'name' => $request->name
                ]);

                if($createTag->save()) {
                    return response()->noContent(201);
                }

                return response()->json(['message' => 'The tag could not be created'], 404);
            }
            return response()->json(['message' => 'Not found name'], 404);
        });
        Route::put('/edit/{id}', function (int $id, Request $request) {

            if(!is_numeric($id)) {
                return response()->noContent(409);
            }

            if($request->name) {
                $findTag = Tag::find($id);

                $findTag->update([
                    'name' => $request->name
                ]);

                return response()->noContent(201);
            }

            return response()->noContent(409);
        });
        Route::delete('/delete/{id}', function (int $id, Request $request) {

            if(!is_numeric($id)) {
                return response()->json(['message' => 'ID incorrect'], 409);
            }

            $findTag = Tag::find($id);

            if($findTag) {
                $findTag->delete();
                return response()->json(['message' => 'Tag deleted'], 201);
            }

            return response()->json(['message' => 'Unable to proceed with deletion'], 409);
        });
    });

    /**
     * CANDIDATES
     */
    Route::prefix('/candidates')->group(function () {

        // @TODO
        Route::prefix('/studies')->group(function () {
            Route::get('/all', function (Request $request) {});
            Route::put('/edit/{id}', function (int $id, Request $request) {});
            Route::delete('/deleted/{id}', function (int $id, Request $request) {});
        });

        // @TODO
        Route::prefix('/description')->group(function() {
            Route::post('/create', function (Request $request) {});
            Route::put('/edit/{id}', function (int $id, Request $request) {});
            Route::delete('/deleted/{id}', function (int $id, Request $request) {});
        });

        // @TODO
        Route::prefix('/experience')->group(function() {
            Route::post('/create', function (Request $request) {});
            Route::put('/edit/{id}', function (int $id, Request $request) {});
            Route::delete('/deleted/{id}', function (int $id, Request $request) {});
        });

        // @TODO
        Route::prefix('/skills')->group(function() {
            Route::post('/create', function (Request $request) {});
            Route::put('/edit/{id}', function (int $id, Request $request) {});
            Route::delete('/deleted/{id}', function (int $id, Request $request) {});
        });

    });

    /**
     * JOBS
     */
    Route::prefix('/jobs')->group(function () {
        // @TODO
        Route::get('/all', function () {});
        Route::post('/create', function () {});
        Route::put('/edit/{id}', function (int $id, Request $request) {});
        Route::delete('/deleted/{id}', function (int $id, Request $request) {});
    });
});
