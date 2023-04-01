<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .card {
            border-radius: 24px 4px;
            box-shadow: 0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12)!important;
            transition: all .5s;
        }
        .card:hover {
            /* margin-top: -15px; */
            scale: 1.1;
        }
        .footer {
            /* background:  */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="#" >Liên hệ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/login" >{{ Auth::check() ? Auth::user()->name : 'Đăng nhập' }}</a>
              </li>
          </ul>
        </div>
    </nav>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('mail-server.jpg') }}" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('icon1.png') }}" style="width: 50%">
                        <h4>Nhanh chóng</h4>
                        <p>Hệ thống mail server đạt chuẩn tốc độ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('icon1.png') }}" style="width: 50%">
                        <h4>An toàn</h4>
                        <p>Hoàn toàn bảo mật, không mất dữ liệu.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('icon1.png') }}" style="width: 50%">
                        <h4>Dễ dàng</h4>
                        <p>Dễ dàng sử dụng chỉ với vài cú click.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark p-3 text-center">
        <strong class="text-white">@2023<a href="https://hiblue.vn/"> Hi-blue JSC</a> </strong>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>