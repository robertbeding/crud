<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use App\Models\Pegawais;
use Illuminate\Http\Request;
use PDF;
use Excel;



class PegawaiController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Pegawais::where('nama', 'LIKE', '%'.$request->search.'%')->paginate(5);
        }else{
            $data = Pegawais::paginate(5);
        }
        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        // dd($request->all());
        $data = Pegawais::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhasili ditambahkan');
    }

    public function tampildata($id){
        $data = Pegawais::find($id);
        // dd($data);
        return view('tampilpegawai', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Pegawais::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success','Data Berhasili di Update');
    }

    public function delete ($id){
        $data = Pegawais::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success','Data Berhasili di Hapus');
    }

    public function exportpdf(){
        $data = Pegawais::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('datapegawai.pdf');
    }

    public function exportexcel(){
        return Excel::download(new PegawaiExport, 'datapegawai.xlsx');
    }

    public function importexcel(){
        $data = $request->file('file');


        $namafile = $data->getClientOriginalName();
        $data->move('PegawaiData', $namafile);

        Excel::import(new PegawaiImport, \public_path('/PegawaiData/'.$namafile));
        return \redirect()->back();
    }
}
