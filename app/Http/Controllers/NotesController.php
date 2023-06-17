<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        return view('home', ['notes' => Note::all()]);
    }

    public function add(Request $request)
    {
        $note = new Note();
        $note->title  = $request->title;
        $note->body = $request->body;
        $note->is_fav = false;
        $note->save();

        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        Note::whereId($id)->update(['title' => $request->title, 'body' => $request->body,]);

        return redirect('/');
    }

    public function remove($id)
    {
        Note::destroy($id);

        return redirect('/');
    }
}
