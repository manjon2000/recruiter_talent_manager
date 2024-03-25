<?php

use App\Http\Controllers\CandidateController;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/**
 * @Auth
 */


/**
 * @TODO
 * - Created Controller
 * - Created Custom Request for validated
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

        $userRole = new UserRole([
            'role_id'   => 3,
            'user_id'   => $user->id
        ]);
        $userRole->save();

        return response()->json([
            'token' => $user->createToken('personal_token')->plainTextToken,
        ], 201);

    } catch (ValidationException $errors) {
        return response()->json([
            'errors' => $errors->validator->getMessageBag()->toArray()
        ], 422);
    }
});

/**
 * @TODO
 * - Created Controller
 * - Created Custom Request for validated
 */

Route::post('/login', function (Request $request) {
    try {

        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        $findUser = User::where('email', $request->email)->first();

        $validatePassword = Hash::check($request->password, $findUser->password);

        if($validatePassword) {
            return response()->json([
                'token' => $findUser->createToken('personal_token')->plainTextToken,
                'user'  => $findUser
            ], 201);
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

        /**
         * @TODO
         * - Created Controller
         * - Created Custom Request for validated
         */
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

        /**
         * @TODO
         * - Created Controller
         * - Created Custom Request for validated
         */
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

        /**
         * @TODO
         * - Created Controller
         * - Created Custom Request for validated
         */
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
        Route::prefix('/studies')->group(function () {
            Route::get('/all', [CandidateController::class, 'candidateStudyAll']);
            Route::post('/create',  [CandidateController::class, 'candidateStudyCreated']);
            Route::put('/edit/{id}',[CandidateController::class, 'candidateStudyEdited']);
            Route::delete('/delete/{id}',[CandidateController::class, 'candidateStudyDeleted']);
        });
        Route::prefix('/description')->group(function() {
            Route::post('/create', [CandidateController::class, 'candidateDescriptionCreated']);
            Route::put('/edit/{id}', [CandidateController::class, 'candidateDescriptionEdited']);
            Route::delete('/deleted/{id}', [CandidateController::class, 'candidateDescriptionDeleted']);
        });
        Route::prefix('/experience')->group(function() {
            Route::get('/all',[CandidateController::class, 'candidateExperienceAll']);
            Route::post('/create',[CandidateController::class, 'candidateExperienceCreated']);
            Route::put('/edit/{id}',[CandidateController::class, 'candidateExperienceEdited']);
            Route::delete('/deleted/{id}',[CandidateController::class, 'candidateExperienceDeleted']);
        });
        Route::prefix('/skills')->group(function() {
            Route::get('/all',[CandidateController::class, 'candidateSkillAll']);
            Route::post('/create',[CandidateController::class, 'candidateSkillCreated']);
            Route::delete('/deleted/{id}',[CandidateController::class, 'candidateSkillDeleted']);
        });
    });

    /**
     * JOBS
     */
    Route::prefix('/jobs')->group(function () {

        /**
         * @TODO
         * - Created Controller
         * - Created Custom Request for validated
         */
        Route::get('/all', function () {});
        Route::post('/create', function () {});
        Route::put('/edit/{id}', function (int $id, Request $request) {});
        Route::delete('/deleted/{id}', function (int $id, Request $request) {});
    });
});
