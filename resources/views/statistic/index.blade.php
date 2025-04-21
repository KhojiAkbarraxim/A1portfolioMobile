<!doctype html>
<html lang="en">
<head>
    <title>Tanlovlar</title>
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

            <div class="card-body">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>T/R</th>
                                    <th>Tanlovlar ro'yxati</th>
                                    <th style="transform: translateX(30deg);">Ishtirokchilar </th>
                                    <th>Mezonlar</th>
                                    <th>Komissiya azolari</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($announcements as $item)
                                    <tr>

                                        <th scope="row" class="scope" >{{ $loop->index+1 }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td><a href="{{ route('statistic.applications', $item->id) }}" class="btn btn-primary">{{ $item->announcementCount }} ta
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="margin-left: 5px;" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                                </svg>
                                            </a></td>
                                        <td><a href="{{ route('statistic.criteria', $item->id) }}" class="btn btn-primary">{{ $item->criteriaCount }} ta
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="margin-left: 5px;" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                                </svg>
                                            </a></td>
                                        <td><a href="{{ route('statistic.commissions', $item->id) }}" class="btn btn-primary">{{ $item->commissionsCount }} ta
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="margin-left: 5px;" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                                </svg>
                                            </a></td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
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


<!-- End of .container -->



</body>
</html>

