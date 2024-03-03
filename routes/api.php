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

Route::post('/tags/create', function (Request $request, Response $response) {

    if($request->name) {
        $findTag = tag::where('name', $request->name)->get();

        if(count($findTag) > 0) {
            return response()->json(['message' => 'Tag duplicate'], 409);
        }

        $createTag = new Tag([
            'name' => $request->name
        ]);

        if($createTag->save()) {
            return response()->json(['message' => 'Tag created correctly'], 201);
        }

        return response()->json(['message' => 'The tag could not be created'], 404);
    }

    return response()->json(['message' => 'Not found name'], 404);
});

Route::put('/tags/edit/{id}', function (int $id, Request $request, Response $response) {

    if(!is_numeric($id)) {
        return response()->json(['message' => 'Is not number'], 409);
    }

    if($request->name) {
        $findTag = Tag::find($id);

        $findTag->update([
            'name' => $request->name
        ]);

        return response()->json(['content' => $findTag]);
    }

    return response()->json([], 409);

});
