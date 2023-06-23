<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<style>
    .form-control-borderless {
        border: none;
    }

    .form-control-borderless:hover,
    .form-control-borderless:active,
    .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }
</style>

<!DOCTYPE html>
<html>

<head>
    <title>Top Page 01</title>
</head>

<body>
    <!------ Include the above in your HEAD tag ---------->
    <div class="container">
        <br />
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form class="card card-sm">
                    <div class="card-body row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-search h4 text-body"></i>
                        </div>
                        <!--end of col-->
                        <div class="col">
                            <input class="form-control form-control-lg form-control-borderless" type="search"
                                placeholder="Search computer">
                        </div>
                        <!--end of col-->
                        <div class="col-auto">
                            <button class="btn btn-lg btn-success" type="submit">Search</button>
                        </div>
                        <!--end of col-->
                    </div>
                </form>
            </div>
            <!--end of col-->
        </div>
        <div>
            <a href="/login">Login</a>
        </div>
    </div>
   </div>
   <div>
      <table class="table table-bordered">
         <tr>
             <th>No</th>
             <th>Name</th>
             <th>Email</th>
         </tr>
         @foreach ($users as $user)
         <tr>
             <td>{{ ++$i }}</td>
             <td>{{ $user->name }}</td>
             <td>{{ $user->email }}</td>    
         </tr>
         @endforeach
     </table>
   </div>
</body>
</html>
