<?php

namespace App\Http\Controllers;

use auth;
use Illuminate\Support\Facades\session;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.dashboard', [
            'title' => 'Dashboard',
            'posts' => Post::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create', [
            'title' => 'Tambah Data',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasidata = $request->validate([
            'name' => 'required|max:20',
            'image' => 'image|file',
            'jmlh_barang' => 'required',
            'harga' => 'required',
        ]);

        if($request->file('image')){
            $validasidata['image'] = $request->file('image')->store('post-images');
        }
        
            $validasidata['user_id'] = auth()->user()->id;
            $validasidata['status'] = 'Tersedia';

            Post::create($validasidata);
            Alert::success('Berhasil', 'Menyimpan Data');
            return redirect ('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $id)
    {

        $edit = Post::where('id',$id )->first();

        return view('admin.edit' ,[
            'post' => $edit,
            'title' => 'Edit Data'
        ]);
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post, $id)
    {

        $update = Post::where('id',$id )->first();
        $status = Post::findOrFail($update->id)->only('status');

        if($status['status'] != 'Tersedia') {
            Alert::error('Gagal Update', 'Barang Sedang Disewa');
            return redirect('/admin');
        }
        else{
                $validasidata = $request->validate([
                    // 'name' => 'required|max:20',
                    'image' => 'image|file',
                    'harga' => 'required',
                    'jmlh_barang' => 'required',
                    'status' => $update->status
                ]);

                if($request->file('image')) {
                    if($request->oldImage) {
                        Storage::delete($request->oldImage);
                    }
                        $validasidata['image'] = $request->file('image')->store('post-images');
                }

                $validasidata['user_id'] = auth()->user()->id;
        
                Post::where('id', $update->id)
                    ->update($validasidata);
                
                Alert::success('Berhasil', 'Update Data');
                return redirect ('/admin');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {
        $delete = Post::where('id',$id )->first();
        $status = Post::findOrFail($delete->id)->only('status');

        if($status['status'] != 'Tersedia') {
            Alert::error('Gagal Hapus', 'Barang Sedang Disewa');
            return redirect('/admin');
        }
        else{
            if($delete->image) {
                Storage::delete($delete->image);
            }
                Post::destroy($delete->id);
                Alert::success('Berhasil', 'Hapus Data');
                return redirect ('/admin');
        }
    }
}
