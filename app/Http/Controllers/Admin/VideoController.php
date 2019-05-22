<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Videos;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Videos::all();
        return view('admin.videos.index', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('vid_src'))
        {
            $file = $request->file('vid_src');
            $ext = $file->getClientOriginalExtension();

            $dateTime = date('Ymdhis');
            $newName = 'video_'.$dateTime.'.'.$ext;

            $file->move(storage_path(env('PATH_VIDEO')), $newName);
            $input = $request->all();
            $input['src'] = $newName;
            Videos::create($input);

            return redirect('admin/videos')->with('success', 'Video tersimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewVideo($fileVideo)
    {
        return response()->file(storage_path(env('PATH_VIDEO'). $fileVideo),[
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline; filename="Lesson-file"'
        ]);

        return false;
    }
}
