<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk\Poduk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function getproduk()
    {
        $data = Poduk::all();
        return new JsonResponse($data);
    }

    public function simpan(Request $request)
    {
        // $filename = time() . '.' . $request->photos->extension();

        // $request->photos->move(public_path('images/produk'), $filename);
        $files = $request->file('photos');
        for ($i = 0; $i < count($files); $i++) {
            $file = $files[$i];
            $originalname = $file->getClientOriginalName();
            $penamaan = date('YmdHis') . '.' .$file->getClientOriginalExtension();
            $path = $file->storeAs('images/produk', $penamaan);
            $file->move(public_path('images/produk'), $penamaan);
        }

        $simpan = Poduk::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'group' => $request->jenis,
                'originalname' => $originalname,
                'penamaan' => $penamaan,
                'location' => $path,
            ]
        );
        return new JsonResponse(['message' => 'Data Berhasil Disimpan...!!!','result' =>$simpan],200);
    }

}
