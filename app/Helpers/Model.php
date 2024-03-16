<?php
use App\Models\{harga, Notification, User,notifications_setting, PageSettings, transaksi};
use PhpParser\Node\Stmt\Return_;

class Rupiah {
    public static function getRupiah($value) {
        $format = "Rp " . number_format($value,0,',','.');
        return $format;
    }
}

if (! function_exists('get_harga_by_id'))
{
    function get_harga_by_id($id=0)
    {
      $model = new harga();
      $data  = $model::where('id',$id)->first();
      $harga = !empty($data) ? $data: 'Not Found';
      return $harga;
    }
}


// Get Email Customer by id
if (! function_exists('email_customer'))
{
    function email_customer($id=0)
    {
      $model = new User;
      $data  = $model::where('id',$id)->first();
      $email_customer = !empty($data) ? $data->email : 'Not Found';
      return $email_customer;
    }
}

if (! function_exists('nama_laundry'))
{
    function nama_laundry($id=0)
    {
      $model = new PageSettings();
      $data  = $model::where('id',$id)->first();
      $nama_laundry = !empty($data) ? $data->judul : 'Not Found';
      return $nama_laundry;
    }
}

if (! function_exists('alamat_laundry'))
{
    function alamat_laundry($id=0)
    {
      $model = new User();
      $data  = $model::where('id',$id)->first();
      $alamat_laundry = !empty($data) ? $data->alamat_cabang : 'Not Found';
      return $alamat_laundry;
    }
}

if (! function_exists('noTelp_laundry'))
{
    function noTelp_laundry($id=0)
    {
      $model = new User();
      $data  = $model::where('id',$id)->first();
      $noTelp_laundry = !empty($data) ? $data->no_telp : 'Not Found';
      return $noTelp_laundry;
    }
}

// Get Nama Customer by id
if (! function_exists('namaCustomer'))
{
    function namaCustomer($id=0)
    {
        $model = new User;
        $data  = $model::where('id',$id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        return $name;
    }
}

// Setting Email Notifications
if (! function_exists('setNotificationEmail'))
{
    function setNotificationEmail($id='')
    {
        $model = new notifications_setting;
        $data  = $model::where('email',$id)->first();
        $email = $data ? $data->email : 'Email Notification Aktif Tidak';
        return $email;
    }
}

// Setting Telegram Order Masuk Notifications
if (! function_exists('setNotificationTelegramIn'))
{
    function setNotificationTelegramIn($id='')
    {
        $model = new notifications_setting;
        $data  = $model::where('telegram_order_masuk',$id)->first();
        $teleIn = $data ? $data->telegram_order_masuk : 'Telegram Notification Order Masuk Tidak Aktif';
        return $teleIn;
    }
}

// Setting Telegram Order Selesai Notifications
if (! function_exists('setNotificationTelegramFinish'))
{
    function setNotificationTelegramFinish($id='')
    {
        $model = new notifications_setting;
        $data  = $model::where('telegram_order_selesai',$id)->first();
        $teleFininsh = $data ? $data->telegram_order_selesai : 'Telegram Notification Order Selesai Tidak Aktif';
        return $teleFininsh;
    }
}

// Get Telegram Channel untuk order masuk
if (! function_exists('telegram_channel_masuk'))
{
    function telegram_channel_masuk()
    {
        $model = new notifications_setting;
        $data  = $model::first();
        $channel_masuk = $data ? $data->telegram_channel_masuk : NULL;
        return $channel_masuk;
    }
}

// Get Telegram Channel untuk order selesai
if (! function_exists('telegram_channel_selesai'))
{
    function telegram_channel_selesai()
    {
        $model = new notifications_setting;
        $data  = $model::first();
        $channel_selesai = $data ? $data->telegram_channel_selesai : NULL;
        return $channel_selesai;
    }
}

// Setting WhatsApp Notification order selesai
if (! function_exists('setNotificationWhatsappOrderSelesai'))
{
    function setNotificationWhatsappOrderSelesai($id='')
    {
        $model = new notifications_setting;
        $data  = $model::where('wa_order_selesai',$id)->first();
        $whatsappFinish = $data ? $data->wa_order_selesai : 'WhatsApp Notification Order Selesai Tidak Aktif';
        return $whatsappFinish;
    }
}

// Get WhatsApp Notifikasi order selesai
if (! function_exists('wa_order_selesai'))
{
    function wa_order_selesai()
    {
        $model = new notifications_setting;
        $data  = $model::first();
        $channel_selesai = $data ? $data->wa_order_selesai : NULL;
        return $channel_selesai;
    }
}

// Get Token WhatsApp
if (! function_exists('getTokenWhatsapp'))
{
    function getTokenWhatsapp()
    {
        $model = new notifications_setting;
        $data  = $model::first();
        $channel_selesai = $data ? $data->wa_token : NULL;
        return $channel_selesai;
    }
}

// Notifikasi Whatsapp
if (! function_exists('notificationWhatsapp'))
{
    function notificationWhatsapp($token,$waphone,$pesan)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => $waphone,
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token  //change TOKEN to your actual token
        ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        }

        curl_close($curl);

        if (isset($error_msg)) {
        echo $error_msg;
        }
        echo $response;
    }
}

// Get Notifikasi
function getNotifikasi($user_id)
{
    $model = new Notification;
    $data = $model::where('user_id',$user_id)->where('is_read',0)->orderBy('created_at','desc')->get();
    return $data;
}

// Send Notif
function sendNotification($id=null, $user_id=null, $kategori=null, $title=null, $body=null)
{
    $notif = new Notification;
    $notif->transaksi_id    = $id ?? null;
    $notif->user_id         = $user_id ?? null;
    $notif->kategori        = $kategori;
    $notif->title           = $title;
    $notif->body            = $body;
    $notif->save();

    return $notif;
}
