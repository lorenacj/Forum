<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::with(['posts','replies'])->paginate(2); //busca en Forum, los ultimos que por fecha son los ultimos y los pagina en 5
        return view('foros.index', compact('forums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Forum::create($request()->all());
        Forum::create(request()->all());
        return back()->with('message',['success', __("Foro creado correctamente")]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        //Post::Where('forum_id', '=', $forum);
        //SELECT * FROM post WHERE forum_id=$forum;
        //$forums = Forum::with(['replies', 'posts'])->paginate(2);
        $posts = $forum->posts()->with(['owner'])->paginate(2); //Nos muestra los foros, del foro ese y el usuario de ese post y los pagina
        return view('foros.detail', compact('forum','posts')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        //
    }
}
