<?php

namespace App\Http\Controllers;

use App\Http\Requests\Candidate\CandidateDescriptionRequest;
use App\Http\Requests\Candidate\CandidateExperienceRequest;
use App\Http\Requests\Candidate\CandidateSkillRequest;
use App\Http\Requests\Candidate\CandidateStudyRequest;
use App\Models\CandidateDescription;
use App\Models\CandidateExperience;
use App\Models\CandidateSkill;
use App\Models\CandidateStudie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class CandidateController extends Controller
{
    /**
     * @Studies
     */

    public function candidateStudyAll(): JsonResponse {
        return response()->json(CandidateStudie::all());
    }

    public function candidateStudyCreated(CandidateStudyRequest $request): Response {
        $studies = new CandidateStudie([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'start_date'        => date('Y-m-d H:i:s', strtotime($request->start_date)),
            'finish_date'       => date('Y-m-d H:i:s', strtotime($request->finish_date))
        ]);
        $studies->save();

        return response()->noContent();
    }

    public function candidateStudyEdited(CandidateStudyRequest $request, int $id): Response {
        $updatedStudies = CandidateStudie::find($id);

        if(!$updatedStudies) {
            return response()->noContent(404);
        }

        $updatedStudies->update([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'start_date'        => date('Y-m-d H:i:s', strtotime($request->start_date)),
            'finish_date'       => date('Y-m-d H:i:s', strtotime($request->finish_date))
        ]);

        return response()->noContent(201);
    }

    public function candidateStudyDeleted(int $id): JsonResponse {
        $deletedStudies = CandidateStudie::find($id);
        $deletedStudies->delete();

        return response()->json(['message' => 'Study Deleted'], 201);
    }


    /**
     * @Description
     */

    public function candidateDescriptionCreated(CandidateDescriptionRequest $request): Response {

        $descriptionCreated = new CandidateDescription($request->all());
        $descriptionCreated->save();

        return response()->noContent();
    }

    public function candidateDescriptionEdited(CandidateDescriptionRequest $request, int $id): Response {

        $descriptionUpdated = CandidateDescription::find($id);

        if(!$descriptionUpdated) {
            return response()->noContent(404);
        }

        $descriptionUpdated->update($request->all());

        return response()->noContent(201);
    }

    public function candidateDescriptionDeleted(int $id): JsonResponse {

        $descriptionDeleted = CandidateDescription::find($id);
        $descriptionDeleted->delete();

        return response()->json(['message' => 'Description Deleted'], 201);
    }


    /**
     * @Experience
     */

    public function candidateExperienceAll(Request $request): JsonResponse {
        //$request->user()->id
        return response()->json(CandidateExperience::all(), 200);
    }
    public function candidateExperienceCreated(CandidateExperienceRequest $request): Response {
        $experience = new CandidateExperience([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'start_date'        => date('Y-m-d H:i:s', strtotime($request->start_date)),
            'finish_date'       => date('Y-m-d H:i:s', strtotime($request->finish_date))
        ]);
        $experience->save();

        return response()->noContent();
    }
    public function candidateExperienceEdited(CandidateExperienceRequest $request, int $id): Response {
        $updatedExperience = CandidateExperience::find($id);

        if(!$updatedExperience) {
            return response()->noContent(404);
        }

        $updatedExperience->update([
            'user_id'           => $request->user_id,
            'name'              => $request->name,
            'description'       => $request->description,
            'start_date'        => date('Y-m-d H:i:s', strtotime($request->start_date)),
            'finish_date'       => date('Y-m-d H:i:s', strtotime($request->finish_date))
        ]);

        return response()->noContent(201);
    }
    public function candidateExperienceDeleted(int $id): JsonResponse {
        $deletedExperience = CandidateStudie::find($id);
        $deletedExperience->delete();

        return response()->json(['message' => 'Experience Deleted'], 201);
    }

    /**
     * @Skills
     */

    public function candidateSkillAll(Request $request): JsonResponse {
        //$request->user()->id
        return response()->json(CandidateSkill::all(), 201);
    }

    public function candidateSkillCreated(CandidateSkillRequest $request): Response {

    $createdSkill = new CandidateSkill($request->all());
    $createdSkill->save();

    return response()->noContent();
}

    public function candidateSkillDeleted(int $id): JsonResponse {

        $deletedSkill = CandidateSkill::find($id);
        $deletedSkill->delete();

        return response()->json(['message' => 'Experience Deleted'], 201);
    }

}
