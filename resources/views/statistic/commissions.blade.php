<!doctype html>
<html lang="en">
<head>
    <title>Komissiya azolari</title>
    <link href="{{asset('/img/logo.png')}}" rel="icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('statistic/css/style.css') }}">

</head>
<body>
<div class="" style=" background-color: #0a4275 !important; color: white">
    <div class="raw pl-5">
        <h1 class="ml-5 text-white"><i class="fa fa-briefcase  mr-2"></i>A1Portfolio</h1>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="float-left" ><b>Tanlov: {{ $name }}</b></p>
            </div>
            <div class="card-body">
            <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr >
                            <th style="width: 150px; ">T/R</th>
                            <th >Komissiya azolari</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commissions as $item)
                        <tr>
                            <th scope="row" class="scope" >{{ $loop->index+1 }}</th>
                            <td > <b>{{ $item->name }}</b> </td>


                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>

<!-- Remove the container if you want to extend the Footer to full width. -->


<section class="" style="
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #0a4275;
            color: white;
            padding: 10px 0;">
    <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #0a4275;">
        <!-- Grid container -->

        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © {{ date('Y')}}
            <a class="text-white" href="https://a1tech.uz/">A1TECH</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</section>
</body>
</html>

