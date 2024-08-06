<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditCustomerRequest;
use Illuminate\Support\Facades\Session;
use ErrorException;
use Illuminate\Support\Facades\Auth; // Add this line to import the Auth class
class CustomerController extends Controller
{

    public function index()
    {
      $customer = User::where('auth','Customer')->get();
      return view('modul_admin.customer.index', compact('customer'));
    }

    public function show($id)
    {
      $customer = User::with('transaksiCustomer')->where('id',$id)->first();
      return view('modul_admin.customer.infoCustomer', compact('customer'));
    }

    public function edit($id)
    {
      $customer = User::where('id',$id)->first();
        return view('modul_admin.customer.edit', compact('customer'));
    }

    
  // Edit
  public function update(EditCustomerRequest $request, $id)
  {

    try {
      DB::beginTransaction();

      $phone_number = preg_replace('/^0/', '62', $request->no_telp);

      if ($id) {
        // Update existing customer
        $customer = User::findOrFail($id);
        $customer->update([
          'karyawan_id' => Auth::id(),
          'name'        => $request->name,
          'email'       => $request->email,
          'auth'        => 'Customer',
          'status'      => 'Active',
          'no_telp'     => $phone_number,
          'alamat'      => $request->alamat,
          'jenis_kelamin' => $request->jenis_kelamin
        ]);
      }
      DB::commit();
      Session::flash('success', 'Customer Berhasil Diperbarui!');
      return redirect('customer');
    } catch (ErrorException $e) {
      DB::rollback();
      throw new ErrorException($e->getMessage());
    }
  }
}
