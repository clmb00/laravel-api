<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){

        $projects = Project::with(['technologies', 'type'])->paginate(5);

        return response()->json(compact('projects'));
    }

    public function show($slug){
        $project = Project::where('slug', $slug)->with(['technologies', 'type'])->first();

        if($project->cover_image){
            $project->cover_image = url("storage/" . $project->cover_image);
        } else {
            $project->cover_image = url("storage/uploads/placeholder.jpg");
        }

        return response()->json($project);
    }

    public function search(){

        $projects = Project::where($_GET['where'], 'like', '%' . $_GET['what'] . '%')->with(['technologies', 'type'])->paginate(5);

        return response()->json(compact('projects'));
    }
}
