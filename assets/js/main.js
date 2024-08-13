// tombol btn-menu diklik
const navbarMenu = document.querySelector(".navbar-menu");
document.querySelector("#btn-menu").onclick = () => {
  navbarMenu.classList.toggle("active");
};

// tombol btn-user diklik
const btnUser = document.querySelector(".user");
document.querySelector("#btn-user").onclick = (e) => {
  btnUser.classList.toggle("active");
  e.preventDefault();
};

// onclick sidebar hide
const btnMenu = document.querySelector("#btn-menu");
document.addEventListener("click", function (e) {
  if (!btnMenu.contains(e.target) && !navbarMenu.contains(e.target)) {
    navbarMenu.classList.remove("active");
  }
});

// animasi typing hero section
document.addEventListener("DOMContentLoaded", (event) => {
  const text = "Belanja Dari Rumah Aja ...";
  let index = 0;
  const typingElement = document.getElementById("typing-text");

  function type() {
    if (index < text.length) {
      typingElement.innerHTML += text.charAt(index);
      index++;
      setTimeout(type, 100);
    } else {
      setTimeout(erase, 2000);
    }
  }

  function erase() {
    if (index > 0) {
      typingElement.innerHTML = text.substring(0, index - 1);
      index--;
      setTimeout(erase, 50);
    } else {
      setTimeout(type, 2000);
    }
  }

  type();
});

// api rajaongkir
$(document).ready(function () {
  $.ajax({
    url: "../api/data_provinsi.php",
    type: "post",
    success: function (data_provinsi) {
      $("select[name=provinsi]").html(data_provinsi);
    },
  });

  // district
  $("select[name=provinsi").on("change", function () {
    var id_provinsi = $("option:selected", this).attr("id_provinsi");
    $.ajax({
      url: "../api/data_district.php",
      type: "post",
      data: "id_provinsi=" + id_provinsi,
      success: function (data_district) {
        $("select[name=district]").html(data_district);
      },
    });
  });

  // ekspedisi
  $.ajax({
    url: "../api/data_ekspedisi.php",
    type: "post",
    success: function (data_ekspedisi) {
      $("select[name=ekspedisi]").html(data_ekspedisi);
    },
  });

  $("select[name=ekspedisi]").on("change", function () {
    var nama_ekspedisi = $("select[name=ekspedisi]").val();
    var data_district = $("option:selected", "select[name=district]").attr(
      "id_district"
    );
    var total_berat = $("input[name=total_berat]").val();

    $.ajax({
      url: "../api/data_paket.php",
      type: "post",
      data:
        "ekspedisi=" +
        nama_ekspedisi +
        "&district=" +
        data_district +
        "&berat=" +
        total_berat,
      success: function (data_paket) {
        $("select[name=paket]").html(data_paket);
        $("input[name=nama_ekspedisi]").val(nama_ekspedisi);
      },
    });
  });

  $("select[name=district]").on("change", function () {
    var prov = $("option:selected", this).attr("nama_provinsi");
    var dist = $("option:selected", this).attr("nama_district");
    var type = $("option:selected", this).attr("type_district");
    var pos = $("option:selected", this).attr("kode_pos");

    $("input[name=nama_provinsi]").val(prov);
    $("input[name=nama_district]").val(dist);
    $("input[name=type_district]").val(type);
    $("input[name=kode_pos]").val(pos);
  });

  $("select[name=paket]").on("change", function () {
    var paket = $("option:selected", this).attr("paket");
    var ongkir = $("option:selected", this).attr("ongkir");
    var etd = $("option:selected", this).attr("etd");

    $("input[name=paket]").val(paket);
    $("input[name=ongkir]").val(ongkir);
    $("input[name=estimasi]").val(etd);
  });
});
