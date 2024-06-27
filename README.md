<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# laravel-ajax-pencarian-autocomplete

## Berikut Tata Cara Membuat Fitur Search Autocomplete dengan Laravel 11 dan Jquery
## Langkah 1 : Install Laravel 
```
composer create-project laravel/laravel laravel-ajax-pencarian-autocomplete
```

## Langkah 2 : Buat Database : laravel-ajax-pencarian-autocomplete
## Langkah 3 : Buat Model Barang & Migrasi
```
php artisan make:model Barang -m

tambahkan 1 kolom nama_barang pada tabel migrasi barang :

Schema::create('barangs', function (Blueprint $table) {
   $table->id();
   $table->string('nama_barang');
   $table->timestamps();
});
```

## Langkah 4 : Buat BarangSeeder
```
php artisan make:seeder BarangSeeder
```
Masukan data barang di BarangSeeder pada fungsi `run()` : 

```
$barang = [
            [
                'nama_barang' => 'Laptop Asus'
            ],
            [
                'nama_barang' => 'Laptop Acer'
            ],
            [
                'nama_barang' => 'Laptop Macbook'
            ],
            [
                'nama_barang' => 'Mouse Gaming'
            ],
            [
                'nama_barang' => 'Keyboard Mekanik'
            ],
            [
                'nama_barang' => 'Kopi Expresso'
            ],
            [
                'nama_barang' => 'Indomie Ayam Bawang'
            ],
];

Barang::insert($barang);
```

## Langkah 5 : Lalu Daftarkan BarangSeeder di DatabaseSeeder pada fungsi `run()`
```
public function run()
{ 
	$this->call([
	    BarangSeeder::class
	]);
}
```

## Langkah 6 : Jalankan perintah
```
php artisan migrate
```
Lanjutkan :
```
php artisan db:seed
```

## Langkah 6 : Buat Controller 
```
php artisan make:controller SearchController
```

Buat function `cari` di dalam controller `App\Http\Controller\SearchController`:
Buat fungsi cari di dalam SearchController

```
function cari(Request $request)
  {
    if($request->get('query'))
    {
        $query = $request->get('query');
        $data = DB::table('barangs')
        ->where('nama_barang', 'LIKE', "%{$query}%")
        ->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
        $output .= '
        <li><a href="#">'.$row->nama_barang.'</a></li>
        ';
        }
        $output .= '</ul>';
        echo $output;
    }
  }
```

## Langkah 7 : Buat rute 
```
Route::get('/ajax-autocomplete', [SearchController::class, 'cari']);
```

## Langkah 7 : Buat halaman view 
```
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
```

## Langkah 8 : Jalankan perintah
```
php artisan serve
``` 
