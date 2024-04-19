<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class OrdersController extends Controller
{
    public function orders(){

        $title = '';
        return view('admin.orders', [
        "title"  => "Orders" .$title,
        "pesanans" => pesanan::latest()->filter(request(['searchOrder']))->get()
    ]);
    }


    public function viewOrder(Pesanan $pesan) 
    {
        return view('admin.viewOrder', [ 
            "title" => "View Order",
            "pesan" => $pesan
            ]);
    }



    public function pesananSelesai(pesanan $pesan)
    {
        $psnselesai = Pesanan::where('id', $pesan->id)->first();
        $potostruk = pesanan::findOrFail($pesan->id)->only('image');


        // if($pesan->image) {
        //     Storage::delete($pesan->image);

         if($potostruk['image'] == 0){
            Alert::error('Gagal Mengembalikan Barang', 'Belum Mengupload Struk');
            return back();
        } 
        try{ 
            DB::beginTransaction();

                $psnselesai->belum_bayar = '0';
                $psnselesai->status_pesan = 'Lunas';
                $psnselesai->save();
                
                $post = Post::findOrFail($pesan->post_id);
                // $post->status = 'Tersedia';
                $post->jmlh_barang = $post->jmlh_barang + $psnselesai->jumlah_barang;
                $post->save();
                DB::commit();
                
                Alert::success('Berhasil', ' Pesanan Selesai');
                return redirect('/orders');
                
                // // $post = Post::findOrFail($pesan->post_id);
                // // $post->status = 'Tersedia';
                // // $post->save();
                // DB::commit();
                
                // Alert::success('Berhasil', 'Menghapus Pesanan');
                // return redirect ('/orders');

        }
        catch (\Throwable $th){
            DB::rollBack();
        }
                
    }



    public function update($id){

        $status_pesan = Pesanan::where('id', $id)->first();
        $image = pesanan::findOrFail($status_pesan->id)->only('image');
        $dp = pesanan::findOrFail($status_pesan->id)->only('dp');

        // if($image['image'] == 0){
        //     Alert::error('Gagal Konfirmasi Pesanan', 'Belum Mengupload Struk');
        //     return back();
        // }

        // if($dp['dp'] == null){
        //     $status_pesan->belum_bayar = '0';
        // }
        
        $status_pesan->status_pesan = 'Terkonfirmasi';
        $status_pesan->save();

        Alert::success('Berhasil', 'Mengkonfirmasi Pesanan');
        return back();
    }




    public function returndate(pesanan $pesan){

        $returndate = Pesanan::where('id', $pesan->id)->first();
        $status = Post::findOrFail($pesan->post_id)->only('status');
        $image = pesanan::findOrFail($pesan->id)->only('image');


        // if($image['image'] == 0){
        //     Alert::error('Gagal Mengembalikan Barang', 'Belum Mengupload Struk');
        //     return back();
        // }
        try{ 
            DB::beginTransaction();

            $currentDate = Carbon::now()->toDateString();
            $jumlah_hari = $returndate->jumlah_hari;

            if ($currentDate > $returndate->tanggal_pulang) {
                $daysLate = Carbon::parse($currentDate)->diffInDays(Carbon::parse($returndate->tanggal_pulang));
                $penaltyPerDay = 50000;
                $penalty = $penaltyPerDay * $daysLate;
                $returndate->denda = $returndate->denda + $penalty;
                $returndate->jumlah_harga = $returndate->jumlah_harga + $returndate->denda;
            } 
            else {
                
            }

                $returndate->tanggal_kembali = $currentDate;
                // $returndate->belum_bayar = '0';
                $returndate->status_pesan = 'Menunggu Pembayaran';
                $returndate->save();
                
                // $post = Post::findOrFail($pesan->post_id);
                // // $post->status = 'Tersedia';
                // // $post->jmlh_barang = $post->jmlh_barang + $returndate->jumlah_barang;
                // $post->save();
                DB::commit();
                
                Alert::success('Berhasil', 'Mengecek Pengembalian');
                return redirect('/orders');

        }catch (\Throwable $th){
            DB::rollBack();
        }
    }
}
