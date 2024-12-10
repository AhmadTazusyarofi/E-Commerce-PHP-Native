// tombol btn-menu diklik
const navbarMenu = document.querySelector(".navbar-menu");
document.querySelector("#btn-menu").onclick = () => {
  navbarMenu.classList.toggle("active");
};

// onclick sidebar hide
const btnMenu = document.querySelector("#btn-menu");
document.addEventListener("click", function (e) {
  if (!btnMenu.contains(e.target) && !navbarMenu.contains(e.target)) {
    navbarMenu.classList.remove("active");
  }
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

// // pagination
// function getPageList(totalPage, page, maxLength) {
//   function rage(start, end) {
//     return Array.from(Array(end - start + 1), (_, i) => i + start);
//   }

//   var sideWith = maxLength < 9 ? 1 : 2;
//   var leftWIdth = (maxLength - sideWith * 2 - 3) >> 1;
//   var rightWIdth = (maxLength - sideWith * 2 - 3) >> 1;

//   if (totalPage <= maxLength) {
//     return rage(1, totalPage);
//   }

//   if (page <= maxLength - sideWith - 1 - rightWIdth) {
//     return rage(1, maxLength - sideWith - 1).concat(
//       0,
//       rage(totalPage - sideWith + 1, totalPage)
//     );
//   }

//   if (page >= totalPage - sideWith - 1 - rightWIdth) {
//     return rage(1, sideWith).concat(
//       0,
//       rage(totalPage - sideWith - 1 - rightWIdth - leftWIdth, totalPage)
//     );
//   }

//   return rage(q, sideWith).concat(
//     0,
//     rage(page - leftWIdth, page + rightWIdth),
//     0,
//     rage(totalPage - sideWith + 1, totalPage)
//   );
// }

// $(function () {
//   var numberOfItems = $(".card-produk .card").length;
//   var limitPerPage = 6; //jumlah produk dalam halaman produk
//   var totalPage = Math.ceil(numberOfItems / limitPerPage);
//   var paginationSize = 5; //jumlah angka didalam pagination
//   var currentPage;

//   function showPage(whichPage) {
//     if (whichPage < 1 || whichPage > totalPage) return false;
//     currentPage = whichPage;

//     $(".card-produk .card")
//       .hide()
//       .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
//       .show();

//     $(".pagination li").slice(1, -1).remove();

//     getPageList(totalPage, currentPage, paginationSize).forEach((item) => {
//       $("<li>")
//         .addClass("page-item")
//         .addClass(item ? "halaman" : "dots")
//         .toggleClass("active", item === currentPage)
//         .append(
//           $("<a>")
//             .addClass("page-link")
//             .attr({ href: "javascript:void(0)" })
//             .text(item || "...")
//         )
//         .insertBefore(".next");
//     });

//     $(".prev").toggleClass("disabled", currentPage === 1);
//     $(".next").toggleClass("disabled", currentPage === totalPage);

//     return true;
//   }

//   $(".pagination").append(
//     $("<li>")
//       .addClass("page-item")
//       .addClass("prev")
//       .append(
//         $("<a>")
//           .addClass("page-link")
//           .attr({
//             href: "javascript:void(0)",
//           })
//           .text("prev")
//       ),

//     $("<li>")
//       .addClass("page-item")
//       .addClass("next")
//       .append(
//         $("<a>")
//           .addClass("page-link")
//           .attr({
//             href: "javascript:void(0)",
//           })
//           .text("next")
//       )
//   );

//   $(".card-produk").show();
//   showPage(1);
// });
