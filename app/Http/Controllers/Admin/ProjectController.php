<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $form_data = $this->validation($request->all());

        $form_data['slug'] = Project::generateSlug($request->title);
        $newProject = Project::create($form_data);

        $checkPost = Project::where('slug', $form_data['slug'])->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug])->with('status', 'Project aggiunto con successo');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $form_data = $request->all();
        $form_data = $this->validation($request->all());
        $form_data['slug'] = Project::generateSlug($request->title);

        $checkPost = Project::where('slug', $form_data['slug'])->where('id','<>',$project->id)->first();
        if ($checkPost) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }
        
        $project->update($form_data);

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('status', 'Project Aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index', ['project' => $project->slug]);
    }

    private function validation($data) {

        $validator = Validator::make(
            $data,
            [
                'title'=>'required|max:150',
                'content'=>'nullable|max:1000',
                'cover_image'=>'required|url|max:255',
                'slug'=>'required',
            ],
            [
                'title.required' => "Titolo richiesto",
                'title.max' => "Deve aver massimo 50 caratteri di lunghezza",
                'content.max' => "Deve aver massimo 255 caratteri di lunghezza",
                'cover_image.required' => "L'url dell'immagine è richiesta",
                'cover_image.url' => "Deve essere un url valida (ex. https://.....)",
                'cover_image.max' => "Deve aver massimo 255 caratteri di lunghezza",
                'slug.required' => "Slug richiesto",
            ]
        )->validate();

        return $validator;

    }
}
