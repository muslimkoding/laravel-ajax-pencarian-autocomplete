<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Kode CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel Ajax Autocomplete</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


<!-- Kode form pencarian -->
<div class="px-4 py-5 my-5 text-center">
  <img class="d-block mx-auto mb-4" src="https://laravel.com/img/logotype.min.svg" alt="" height="70">
  <h3 class="fw-bold mb-3">Laravel Ajax Pencarian Autocomplete</h3>
  <div class="col-lg-6 mx-auto">
      <div class="bg-white p-4 shadow border-0 rounded-4 mb-3">
          <input type="text" name="nama_barang" id="nama_barang" class="form-control"
              placeholder="Ketik nama barang" required />
          <div id="barangList"></div>
      </div>
  </div>
</div>


  <!-- Kode Jquery sebelum tag </body> -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- kode js search autocomplete --}}
    <script type="text/javascript">
      $(document).ready(function() {

          $('#nama_barang').keyup(function() {
              var query = $(this).val();
              if (query != '') {
                  var _token = $('input[name="csrf-token"]').val();
                  $.ajax({
                      url: '/ajax-autocomplete',
                      method: "GET",
                      data: {
                          query: query,
                          _token: _token
                      },
                      success: function(data) {
                          $('#barangList').fadeIn();
                          $('#barangList').html(data);
                      }
                  });
              }
          });

          $(document).on('click', 'li', function() {
              $('#nama_barang').val($(this).text());
              $('#barangList').fadeOut();
          });

      });

</script>
</body>

</html>
