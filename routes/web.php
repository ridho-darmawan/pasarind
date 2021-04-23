<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/v1'], function() use($router){  

    $router->get('upload-file/{folder}/{nama}', 'UploadFileController@get_file');
    $router->get('upload-file/{folder}/{nama}/hapus', 'UploadFileController@destroy_file');
    $router->post('upload-file/{folder}', 'UploadFileController@store');
    $router->post('upload-file-multiple/{folder}', 'UploadFileController@storeMultiple');
    $router->get('select-enum/{table}/{field}', 'UploadFileController@selectEnum');
   
    $router->group(['prefix'=>'web'], function() use($router){

        //client katalog mobil
        $router->get('/mobil','client\KatalogMobilController@index');
        $router->post('/mobil/search','client\KatalogMobilController@index');
        $router->get('/mobil/filter','client\KatalogMobilController@filterMobil');

         //client katalog bus
         $router->get('/bus','client\KatalogBusController@index');
         $router->get('/detail-bus/{detail_uuid}','client\KatalogBusController@detailKatalogBus');
         $router->post('/bus/search','client\KatalogBusController@index');
         $router->get('/bus/filter/{jenis_bus_uuid}','client\KatalogBusController@filterByjenisBus');

         $router->get('jenis-bus','client\MasterJenisBusController@index');
         $router->get('jenis-bus/{uuid}','client\MasterJenisBusController@show');

         //client katalog wisata
         $router->get('/wisata','client\KatalogWisataController@index');
         $router->get('/detail-wisata/{detail_uuid}','client\KatalogWisataController@detailKatalogWisata');
         $router->post('/wisata/search','client\KatalogWisataController@index');
         //$router->get('/wisata/filter/{jenis_bus_uuid}','client\KatalogBusController@filterByjenisBus');

         // kelola data user
         $router->get('/user','KelolaUserController@index');
         $router->get('/user/{uuid}','KelolaUserController@show');
         $router->post('/user/search','KelolaUserController@index');
         $router->patch('/user/{uuid}','KelolaUserController@update');
         $router->patch('/user/ubah-password/{uuid}','KelolaUserController@ubahPassword');
         $router->patch('/user/update-foto/{uuid}','KelolaUserController@updateFoto');
         $router->patch('/user/update-foto-ktp/{uuid}','KelolaUserController@updateFotoKtp');
         $router->patch('/user/reset-password/{uuid}','KelolaUserController@resetPassword');
         
        //user
        $router->group(['prefix'=>'user'], function() use($router){
            $router->post('/register','UserController@register');
            $router->post('/login','UserController@login');
        });

        //master merk mobil
        $router->group(['prefix'=>'master-merk-mobil'], function() use($router){
            $router->get('/merk-mobil','MasterMerkMobilController@index');
            $router->post('/merk-mobil/search','MasterMerkMobilController@index');
            $router->post('/merk-mobil','MasterMerkMobilController@store');
            $router->patch('/merk-mobil/{uuid}','MasterMerkMobilController@update');
            $router->delete('/merk-mobil/{uuid}','MasterMerkMobilController@destroy');
            $router->get('/merk-mobil/{uuid}','MasterMerkMobilController@show');
        });

         //master jenis mobil
         $router->group(['prefix'=>'master-jenis-mobil'], function() use($router){
            $router->get('/jenis-mobil','MasterJenisMobilController@index');
            $router->post('/jenis-mobil/search','MasterJenisMobilController@index');
            $router->post('/jenis-mobil','MasterJenisMobilController@store');
            $router->patch('/jenis-mobil/{uuid}','MasterJenisMobilController@update');
            $router->delete('/jenis-mobil/{uuid}','MasterJenisMobilController@destroy');
            $router->get('/jenis-mobil/{uuid}','MasterJenisMobilController@show');
        });

        //katalog mobil
        $router->group(['prefix'=>'katalog-mobil'], function() use($router){
            $router->get('/mobil','KatalogMobilController@index');
            $router->post('/mobil/search','KatalogMobilController@index');
            $router->post('/mobil','KatalogMobilController@store');
            $router->patch('/mobil/{uuid}','KatalogMobilController@update');
            $router->delete('/mobil/{uuid}','KatalogMobilController@destroy');
            $router->get('/mobil/{uuid}','KatalogMobilController@show');
        });

         //transaksi-mobil
         $router->group(['prefix'=>'transaksi-mobil'], function() use($router){     
            $router->post('transaksi','TransaksiMobilController@store');
            $router->get('jadwal-mobil/{uuid_mobil}','TransaksiMobilController@jadwalMobil');
            $router->patch('bukti-pembayaran/{uuid}','TransaksiMobilController@uploadBuktiBayar');
            $router->patch('bukti-pembayaran-admin/{uuid}','TransaksiMobilController@uploadBuktiBayarByAdmin');
            $router->patch('status/{uuid}','TransaksiMobilController@updateStatusBayar');
            $router->patch('supir/{uuid}','TransaksiMobilController@updateSupir');
            $router->post('admin-transaksi','TransaksiMobilController@createTransaksiAdmin');
            $router->get('report','TransaksiMobilController@reportTransaksiMobil');
            $router->get('invoice/{uuid}','TransaksiMobilController@invoice');
            $router->get('','TransaksiMobilController@index');
            $router->post('','TransaksiMobilController@index');
            $router->get('/transaksi-by-user/{uuid_user}','TransaksiMobilController@show');
            $router->get('/transaksi/{uuid}','TransaksiMobilController@transaksiByUuid');
            $router->get('/transaksi-by-katalog/{katalog_uuid}','TransaksiMobilController@transaksiByKatalog');
            $router->get('/supir/{uuid_transaksi}','TransaksiMobilController@supir');
            $router->get('/riwayat-perjalanan-supir/{uuid_supir}','TransaksiMobilController@RiwayatPerjalananSupir');
            
            $router->patch('validasi-ktp/{uuid}','TransaksiMobilController@validasiKtp');
            $router->patch('validasi-bukti-bayar/{uuid}','TransaksiMobilController@validasiBuktiPembayaran');
        });

         //supir 
         $router->group(['prefix'=>'data-supir'], function() use($router){
            $router->get('supir','SupirController@index');
            $router->post('supir/search','SupirController@index');
            $router->post('supir','SupirController@store');
            $router->patch('supir/{uuid}','SupirController@update');
            $router->delete('supir/{uuid}','SupirController@destroy');
            $router->get('supir/{uuid}','SupirController@show');
        });

         //master jenis bus
         $router->group(['prefix'=>'master-jenis-bus'], function() use($router){
            $router->get('jenis-bus','MasterJenisBusController@index');
            $router->post('jenis-bus/search','MasterJenisBusController@index');
            $router->post('jenis-bus','MasterJenisBusController@store');
            $router->patch('jenis-bus/{uuid}','MasterJenisBusController@update');
            $router->delete('jenis-bus/{uuid}','MasterJenisBusController@destroy');
            $router->get('jenis-bus/{uuid}','MasterJenisBusController@show');
        });

        //katalog bus
        $router->group(['prefix'=>'katalog-bus'], function() use($router){
            $router->get('bus','KatalogBusController@index');
            $router->post('bus/search','KatalogBusController@index');
            $router->post('bus','KatalogBusController@store');
            $router->patch('bus/{uuid}','KatalogBusController@update');
            $router->patch('bus-detail/{uuid}','KatalogBusController@updateDetail');
            $router->delete('bus/{uuid}','KatalogBusController@destroy');
            $router->get('bus/{uuid}','KatalogBusController@show');
        });

        //detail katalog bus
        $router->group(['prefix'=>'detail-katalog-bus'], function() use($router){
            $router->get('detail-bus','DetailKatalogBusController@index');
            //$router->post('detail-bus/search','DetailKatalogBusController@index');
            $router->post('detail-bus','DetailKatalogBusController@store');
            $router->patch('detail-bus/{uuid}','DetailKatalogBusController@update');
            $router->delete('detail-bus/{uuid}','DetailKatalogBusController@destroy');
            $router->get('detail-bus/{uuid}','DetailKatalogBusController@show');
        });

        //transaksi-bus
        $router->group(['prefix'=>'transaksi-bus'], function() use($router){     
            $router->post('/transaksi','TransaksiBusController@store');
            $router->patch('/bukti-pembayaran/{uuid}','TransaksiBusController@uploadBuktiBayar');
            $router->patch('/status/{uuid}','TransaksiBusController@updateStatusBayar');
            $router->post('admin-transaksi','TransaksiBusController@createTransaksiAdmin');
            $router->get('report','TransaksiBusController@reportTransaksiBus');
            $router->get('invoice/{uuid}','TransaksiBusController@invoice');
            $router->get('','TransaksiBusController@index');
            $router->post('','TransaksiBusController@index');
            $router->patch('bukti-pembayaran-admin/{uuid}','TransaksiBusController@uploadBuktiBayarByAdmin');
            $router->get('/transaksi-by-user/{uuid_user}','TransaksiBusController@show');
            $router->get('/transaksi/{uuid}','TransaksiBusController@transaksiByUuid');
            $router->get('/transaksi-by-katalog/{katalog_uuid}','TransaksiBusController@transaksiByKatalog');
            $router->get('jadwal-bus/{uuid_bus}','TransaksiBusController@jadwalBus');
            $router->patch('validasi-bukti-bayar/{uuid}','TransaksiBusController@validasiBuktiPembayaran');
        
        });

         //katalog wisata
         $router->group(['prefix'=>'katalog-wisata'], function() use($router){
            $router->get('wisata','KatalogWisataController@index');
            $router->post('wisata/search','KatalogWisataController@index');
            $router->post('wisata','KatalogWisataController@store');
            $router->delete('wisata/{uuid}','KatalogWisataController@destroy');
            $router->patch('wisata/{uuid}','KatalogWisataController@update');
            $router->patch('wisata-detail/{uuid}','KatalogWisataController@updateDetail');
            $router->get('wisata/{uuid}','KatalogWisataController@show');
        });

         //detail katalog wisata
         $router->group(['prefix'=>'detail-katalog-wisata'], function() use($router){
            $router->get('detail-wisata','DetailKatalogWisataController@index');
            //$router->post('detail-bus/search','DetailKatalogWisataController@index');
            $router->post('detail-wisata','DetailKatalogWisataController@store');
            $router->patch('detail-wisata/{uuid}','DetailKatalogWisataController@update');
            $router->delete('detail-wisata/{uuid}','DetailKatalogWisataController@destroy');
            $router->get('detail-wisata/{uuid}','DetailKatalogWisataController@show');
        });

         //transaksi-wisata
         $router->group(['prefix'=>'transaksi-wisata'], function() use($router){     
            $router->post('/transaksi','TransaksiWisataController@store');
            $router->patch('/bukti-pembayaran/{uuid}','TransaksiWisataController@uploadBuktiBayar');
            $router->patch('/status/{uuid}','TransaksiWisataController@updateStatusBayar');
            $router->post('admin-transaksi','TransaksiWisataController@createTransaksiAdmin');
            $router->get('report','TransaksiWisataController@reportTransaksiWisata');
            $router->get('invoice/{uuid}','TransaksiWisataController@invoice');
            $router->get('','TransaksiWisataController@index');
            $router->post('','TransaksiWisataController@index');
            $router->patch('bukti-pembayaran-admin/{uuid}','TransaksiWisataController@uploadBuktiBayarByAdmin');
            $router->get('/transaksi-by-user/{uuid_user}','TransaksiWisataController@show');
            $router->get('/transaksi/{uuid}','TransaksiWisataController@transaksiByUuid');
            $router->get('/transaksi-by-katalog/{katalog_uuid}','TransaksiWisataController@transaksiByKatalog');
            $router->patch('validasi-bukti-bayar/{uuid}','TransaksiWisataController@validasiBuktiPembayaran');
        });

         //detail mobil
         $router->group(['prefix'=>'detail-mobil'], function() use($router){
            //$router->get('mobil','DetailMobilController@index');
            //$router->post('mobil/search','DetailMobilController@index');
            $router->post('mobil','DetailMobilController@store');
            $router->patch('mobil/{uuid}','DetailMobilController@update');
            $router->delete('mobil/{uuid}','DetailMobilController@destroy');
            $router->get('mobil/{uuid}','DetailMobilController@show');
        });


        //chart transaksi mobil
        $router->group(['prefix'=>'chart-mobil'], function() use($router){     
            
            $router->get('perbulan','ChartTransaksiMobilController@pendapatanPerbulan');
            $router->get('pertahun','ChartTransaksiMobilController@pendapatanPertahun');
            $router->get('all','ChartTransaksiMobilController@pendapatanAll');
            
            //$router->get('invoice/{uuid}','ChartTransaksiMobilController@invoice');
        });


        //chart transaksi bus
        $router->group(['prefix'=>'chart-bus'], function() use($router){     
            
            $router->get('perbulan','ChartTransaksiBusController@pendapatanPerbulan');
            $router->get('pertahun','ChartTransaksiBusController@pendapatanPertahun');
            $router->get('all','ChartTransaksiBusController@pendapatanAll');
            //$router->get('invoice/{uuid}','ChartTransaksiMobilController@invoice');
        });

         //chart transaksi Wisata
         $router->group(['prefix'=>'chart-wisata'], function() use($router){     
            
            $router->get('perbulan','ChartTransaksiWisataController@pendapatanPerbulan');
            $router->get('pertahun','ChartTransaksiWisataController@pendapatanPertahun');
            $router->get('all','ChartTransaksiWisataController@pendapatanAll');
            //$router->get('invoice/{uuid}','ChartTransaksiMobilController@invoice');
        });


         //wilayah tujuan 
         $router->group(['prefix'=>'wilayah-tujuan'], function() use($router){
            $router->get('tujuan','WilayahTujuanController@index');
            $router->post('tujuan/search','WilayahTujuanController@index');
            $router->post('tujuan','WilayahTujuanController@store');
            $router->patch('tujuan/{uuid}','WilayahTujuanController@update');
            $router->delete('tujuan/{uuid}','WilayahTujuanController@destroy');
            $router->get('tujuan/{uuid}','WilayahTujuanController@show');
        });


         //sosmed 
         $router->group(['prefix'=>'data-sosmed','middleware'=>'jwt.auth'], function() use($router){
            // $router->get('','MasterSosmedController@index');
            $router->post('sosmed/search','MasterSosmedController@index');
            $router->post('sosmed','MasterSosmedController@store');
            $router->patch('sosmed/{uuid}','MasterSosmedController@update');
            $router->delete('sosmed/{uuid}','MasterSosmedController@destroy');
            // $router->get('sosmed/{uuid}','MasterSosmedController@show');
        });
        $router->group(['prefix'=>'sosmed'], function() use($router){
            $router->get('','MasterSosmedController@index');
            $router->get('sosmed/{uuid}','MasterSosmedController@show');
        });

        //bank 
        $router->group(['prefix'=>'data-bank','middleware'=>'jwt.auth'], function() use($router){
            // $router->get('','MasterBankController@index');
            $router->post('bank/search','MasterBankController@index');
            $router->post('bank','MasterBankController@store');
            $router->patch('bank/{uuid}','MasterBankController@update');
            $router->delete('bank/{uuid}','MasterBankController@destroy');
            // $router->get('bank/{uuid}','MasterBankController@show');
        });

        $router->group(['prefix'=>'bank'], function() use($router){
            $router->get('','MasterBankController@index');
            $router->get('bank/{uuid}','MasterBankController@show');
        });

         //profile-web 
         $router->group(['prefix'=>'data-profile','middleware'=>'jwt.auth'], function() use($router){
            // $router->get('','ProfileWebController@index');
            $router->post('profile/search','ProfileWebController@index');
            $router->post('profile','ProfileWebController@store');
            $router->patch('profile/{uuid}','ProfileWebController@update');
            $router->delete('profile/{uuid}','ProfileWebController@destroy');
            // $router->get('bank/{uuid}','MasterBankController@show');
        });

        $router->group(['prefix'=>'profile'], function() use($router){
            $router->get('','ProfileWebController@index');
            // $router->get('bank/{uuid}','MasterBankController@show');
        });

         //telegram 
         $router->group(['prefix'=>'data-telegram'], function() use($router){
            $router->get('','MasterTelegramController@index');
            $router->post('telegram/search','MasterTelegramController@index');
            $router->post('telegram','MasterTelegramController@store');
            $router->patch('telegram/{uuid}','MasterTelegramController@update');
            $router->delete('telegram/{uuid}','MasterTelegramController@destroy');
            $router->get('telegram/{uuid}','MasterTelegramController@show');
        });


       
   });
});
    
    
