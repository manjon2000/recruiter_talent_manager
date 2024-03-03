<?php

use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user-and-roles', function(Response $response) {
    $user = User::with(['userRoles','userRoles.role'])->where('id', 2)->get();
    return response()->json($user);
});

/**
 * TAGS
 */

Route::post('/tags/create', function (Request $request, Response $response) {

    if($request->name) {
        $findTag = tag::where('name', $request->name)->get();

        if(count($findTag) > 0) {
            abort(409, 'Tag duplicate');
        }

        $createTag = new Tag([
            'name' => $request->name
        ]);

        if($createTag->save()) {
            abort(201, 'Tag created correctly');
        }
        abort(404, 'The tag could not be created');
    }
    abort(404, 'Not found name');
});

Route::put('/tags/edit/{id}', function (int $id, Request $request, Response $response) {

    if(!is_numeric($id)) {
        abort(409);
    }

    if($request->name) {
        $findTag = Tag::find($id);

        $findTag->update([
            'name' => $request->name
        ]);

        abort(201);
    }

    abort(409);
});

Route::delete('/tags/delete/{id}', function (int $id, Request $request, Response $response) {

    if(!is_numeric($id)) {
        abort(409);
    }

    $findTag = Tag::find($id);

    if($findTag) {
        $findTag->delete();
        return response()->json(['message' => 'Tag deleted'], 201);
    }

    abort(409);
});

/**
 * TAGS
 */
