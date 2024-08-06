<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditCustomerRequest;
use Illuminate\Support\Facades\Session;
use ErrorException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
  // index
  public function index()
  {
    $customer = User::where('karyawan_id', Auth::user()->id)
      ->where('auth', 'Customer')
      ->orderBy('id', 'DESC')->get();
    return view('karyawan.customer.index', compact('customer'));
  }

  // Detail Customer
  public function detail($id)
  {
    $customer = User::with('transaksiCustomer')
      ->where('karyawan_id', Auth::user()->id)
      ->where('id', $id)->first();
    return view('karyawan.customer.detail', compact('customer'));
  }

  public function edit($id)
  {
    $customer = User::where('id', $id)->first();
    return view('karyawan.customer.edit', compact('customer'));
  }

  // Create
  public function create()
  {
    return view('karyawan.customer.create');
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
      return redirect('customers');
    } catch (ErrorException $e) {
      DB::rollback();
      throw new ErrorException($e->getMessage());
    }
  }

  // Store
  public function store(AddCustomerRequest $request)
  {

    try {
      DB::beginTransaction();


      $phone_number = preg_replace('/^0/', '62', $request->no_telp);
      $password = str::random(8);

      $addCustomer = User::create([
        'karyawan_id' => Auth::id(),
        'name'        => $request->name,
        'email'       => $request->email,
        'auth'        => 'Customer',
        'status'      => 'Active',
        'no_telp'     => $phone_number,
        'alamat'      => $request->alamat,
        'password'    => Hash::make($password)
      ]);

      $addCustomer->assignRole($addCustomer->auth);

      if ($addCustomer) {
        // Menyiapkan data Email
        $data = array(
          'name'            => $addCustomer->name,
          'no_hp'           => $phone_number,
          'password'        => $password,
          'url_login'       => url('/login'),
          'nama_laundry'    => Auth::user()->nama_cabang,
          'alamat_laundry'  => Auth::user()->alamat_cabang,
        );
        // Kirim email
        if (setNotificationWhatsappOrderSelesai(1) == 1) {
          if (setNotificationWhatsappOrderSelesai(1) == 1 && getTokenWhatsapp() != null) {
            $waCustomer = $addCustomer->no_telp; // get nomor whatsapp customer
            $nameCustomer = $addCustomer->name; // get name customer
            $message = "Halo " . $nameCustomer . ", Selamat datang di " . Auth::user()->nama_cabang . " \n\n" . "Berikut adalah password anda : " . $password . "\n\n" . "Silahkan login ke " . url('/login') . " untuk melanjutkan.";
            notificationWhatsapp(getTokenWhatsapp(), $waCustomer, $message);
          }
        }
      }
      DB::commit();
      Session::flash('success', 'Customer Berhasil Ditambah !');
      return redirect('customers');
    } catch (ErrorException $e) {
      DB::rollback();
      throw new ErrorException($e->getMessage());
    }
  }
}
