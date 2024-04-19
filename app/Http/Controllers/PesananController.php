<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class PesananController extends Controller
{
    public function cekout()
    {

        return view('cekout',[
            'title'=> 'Cekout',
            'active' => 'cekout',
            'pesanans' => Pesanan::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

     //pesanan
    public function pesanan(Request $request, $id )
    {
        $barang = Post::where('id',$id )->first();
        $status = Post::findOrFail($barang->id)->only('status');

        //pengkondisian status barang
        // if($status['status'] != 'Tersedia') {
        //     Alert::error('Gagal Membuat Pesanan', 'Barang Sedang Disewa');
        //     return redirect('/post');
        // }
        // else{
            try{
                DB::beginTransaction();

                $pesanan                  = new Pesanan;
                $pesanan->post_id         = $barang->id;
                $pesanan->user_id         = Auth::user()->id;
                $pesanan->token           = mt_rand(100, 999999);
                $pesanan->nama_acara      = $request->nama_acara;
                $pesanan->status_pesan    = 'Belum Terkonfirmasi';
                $pesanan->alamat_acara    = $request->alamat_acara; 
                $pesanan->no_hp           = $request->no_hp;
                $pesanan->jumlah_hari     = $request->jumlah_hari;
                $pesanan->jumlah_barang   = $request->jumlah_barang;
                $pesanan->tanggal_pinjam  = Carbon::now()->toDateString();
                $pesanan->tanggal_pulang  = Carbon::now()->addDay($request->jumlah_hari)->toDateString();
                $pesanan->jumlah_harga    = $request->jumlah_barang * $barang->harga * $request->jumlah_hari;
                $pesanan->dp              = $request->dp;
                $pesanan->belum_bayar     = $pesanan->jumlah_harga - $request->dp;
                $pesanan->save();

                $cekstok = Post::find($barang->id);
                if ($request->jumlah_barang > $cekstok->jmlh_barang) {
                    DB::rollBack();
                    Alert::error('Gagal Membuat Pesanan', 'Stok Tidak Tersedia');
                    return redirect('/post');
                }
                // if ($cekstok->jmlh_barang = 0) {
                //     DB::rollBack();
                //     Alert::error('Gagal Membuat Pesanan', 'Stok Tidak Tersedia');
                //     return redirect('/post');
                // }
        
                    $post = Post::findOrFail($barang->id);
                    // $post->status = 'Sedang Di Sewa';
                    $post->jmlh_barang -= $request->jumlah_barang;
                    $post->save();
                    DB::commit();
            
                    Alert::success('Berhasil', 'Membuat Pesanan');
                    return redirect('/post');

            }catch (\Throwable $th){
                DB::rollBack();
            }
        // }
    }


    public function storepesan(Request $request, $id){

        $store = Pesanan::where('id', $id)->first();

        return view('storepesan',[
        'title'=> 'Upload Image',
        'active'=> 'cekout',
        'pesan' => $store
        ]);
    }

    public function storeupdate(Request $request, $id){

        $store = Pesanan::where('id', $id)->first();

        $storeupdate = $request->validate([

            'nama_acara'        => 'required',
            'image'             => 'image|file',
            'alamat_acara'      => 'required',
            'no_hp'             => 'required',
            'jumlah_hari'       => 'required',
            'tanggal_pinjam'    => 'required',
            'tanggal_pulang'    => 'required',
            'jumlah_harga'      => 'required',
        ]); 

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $storeupdate['image'] = $request->file('image')->store('struk-images');
        }

        $storeupdate['user_id'] = auth()->user()->id;

        Pesanan::where('id', $store->id)
            ->update($storeupdate);
        
        Alert::success('Berhasil', 'Upload Struk');
        return back();
    }



    public function batalpesan(Pesanan $pesan){

        $status = pesanan::findOrFail($pesan->id)->only('status_pesan');
        $status_barang = Post::findOrFail($pesan->post_id)->only('status'); 
        $returndate = Pesanan::where('id', $pesan->id)->first();

        if($status['status_pesan'] != 'Belum Terkonfirmasi') {
            Alert::error('Gagal Membatalkan Pesanan', 'Silahkan Hubungi Admin');
            return back();

        }
        try{ 
            DB::beginTransaction();

                if($pesan->image) {
                    Storage::delete($pesan->image);
                }
                pesanan::destroy($pesan->id);
                
                $post = Post::findOrFail($pesan->post_id);
                // $post->status = 'Tersedia';
                $post->jmlh_barang = $post->jmlh_barang + $returndate->jumlah_barang;
                $post->save();
                DB::commit();
                
                Alert::success('Berhasil', 'Membatalkan Pesanan');
                return redirect ('/cekout');

        }catch (\Throwable $th){
            DB::rollBack();
        }
    }

    public function kondisi(Request $request, $id) {

        $kondisi = Pesanan::where('id', $id)->first();

        $barangId= $kondisi->post_id;

        $barang = Post::where('id',$barangId)->first();

        $data = $request->all();

            if($kondisi['status_pesan'] == 'Menunggu Pembayaran') {
                $kondisi->hilang_rusak = $request->hilang_rusak;
                $kondisi->keterangan   = $request->keterangan;
                $kondisi->denda        = $request->hilang_rusak * $barang->harga;
                $kondisi->jumlah_harga = $kondisi->jumlah_harga + $kondisi->denda;
                $kondisi->belum_bayar  = $kondisi->belum_bayar + $kondisi->denda;
                $kondisi->save();
                
                Alert::success('Berhasil', 'Menyimpan Data');
                return back();
            }
            
            if($kondisi['status_pesan'] != 'Terkonfirmasi') {
                Alert::error('Gagal Melakukan aksi', 'Silahkan Hubungi Admin');
                return back();

        }
        
    }
}
