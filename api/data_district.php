<?php

$id_provinsi = $_POST['id_provinsi'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 3029ffcd8e836e53d704f34caac3fc69"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $array_response = json_decode($response, true);
    $data_district = $array_response["rajaongkir"]["results"];


    echo "<option>Pilih Kabupaten/Kota</option>";

    foreach ($data_district as $key => $value) {
        echo "<option
        id_district='".$value["city_id"]."'
        nama_provinsi='".$value["province"]."'
        nama_district='".$value["city_name"]."'
        type_district='".$value["type"]."'
        kode_pos='".$value["postal_code"]."'
        >";

        echo $value["type"]. " ";
        echo $value["city_name"];
        echo "</option>";
    }
}