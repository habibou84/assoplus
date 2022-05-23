<!doctype html>
<html lang="fr">

<head>
     <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Menu - Association</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Association">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="tontine, epargne" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

     <link rel = " manifest " href="../assets/manifest/livreur.json">

   <!-- ios support -->
    <link rel="apple-touch-icon" href="../assets/manifest/img/logo.png" />
    
    <meta name="apple-mobile-web-app-status-bar" content="#db4938" />

    
</head>

<body>


@include("includes.rightmenumodal")


    <div class="modal fade dialogbox add-modal" id="InstalAppModal"  data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="pt-3 text-center">
                        <img src="../assets/img/logo-icon.png" alt="image" class="imaged w48  mb-1">
                    </div>
                    <div class="modal-header pt-2">
                        <h5 class="modal-title">Installer l'application Asso+</h5>
                    </div>
                    <div class="modal-body">
                        Accedez a asso+!
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary " data-dismiss="modal">Plus tard</a>
                            <a href="#" class="btn btn-text-success add-button" data-dismiss="modal">Installer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- loader -->
    <!-- <div id="loader">
        <img src="assets/img/logo-icon.png" alt="icon" class="loading-icon">
    </div> -->
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader">

        <div class="pageTitle">
            {{$association->nom}}
        </div>
         @include('includes.rightmenu')
        
        
    </div>

    
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        @include("includes.assinfo")

         

        <div class="section mt-2">
                  
            <div class="section-title"></div>
             
            <div class="row">
             
                <div  class="col-6">
                    <a href="membres?id={{$association->id}}">
                    <div class="card text-white bg-primary text-center">
                <div class="card-header">Membres({{$association->membres->count()}})</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px" name="people-outline"></ion-icon>
                </div>
            </div>
            </a>
                  
                </div>
                 
                <div class="col-6">
                    <a href="bureau?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Bureau</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="business-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>
                
            </div>
           @if(Auth()->user()->usertype == "manager" || Auth()->user()->usertype == "bureau")

            <div class="row mt-2">
             
                <div  class="col-6">
                    <a href="cotisations?id={{$association->id}}">
                    <div class="card text-white bg-primary text-center">
                <div class="card-header">Cotisations</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px" name="enter-outline"></ion-icon>
                </div>
            </div>
            </a>
                  
                </div>


                 <div  class="col-6">
                    <a href="payements?id={{$association->id}}">
                    <div class="card text-white bg-primary text-center">
                <div class="card-header">Payements</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px" name="enter-outline"></ion-icon>
                </div>
            </div>
            </a>
                  
                </div>
               </div> 
                 <div class="row mt-2">
                <div class="col-6">
                    <a href="depanses?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Depanses</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="exit-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>


                <div class="col-6">
                    <a href="rapport?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Rapport</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="stats-chart-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>
                
            </div>


            <div class="row mt-2">
             
                
                <div class="col-6">
                    <a href="infos?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Infos</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="Information-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>



                 <div class="col-6">
                    <a href="requetes?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Requêtes</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="mail-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>

              </div>  

                @if(Auth()->user()->usertype == "manager" )
                <div class="row mt-2">
                 <div class="col-6">
                    <a href="demandes?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Demandes @if($association->incomings->where("status", "pending")->count() >0)<span class="badge badge-rounded alert-danger"> {{$association->incomings->count()}} </span>@endif</div>
                <div class="card-body">

                    <ion-icon style="width: 100px; height: 100px"  name="document-text-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>
                </div>
               @endif

                @endif

                @if(Auth()->user()->usertype == "membre" )


                 
                 <div class="row mt-2">
                <div class="col-6">
                    <a href="mespayements?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Mes payements</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="cash-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>


                <div class="col-6">
                    <a href="cotisations?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Cotisations</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="enter-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>
                
            </div>


                 <div class="row mt-2">
                <div class="col-6">
                    <a href="depanses?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Depanses</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="exit-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>


                <div class="col-6">
                    <a href="rapport?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Rapport</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="stats-chart-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>
                
            </div>


            
                 <div class="row mt-2">
                <div class="col-6">
                    <a href="infos?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Informations</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="exit-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>



                <div class="col-6">
                    <a href="requetes?id={{$association->id}}">
                     <div class="card text-white bg-primary text-center">
                 <div class="card-header">Requêtes</div>
                <div class="card-body">
                    <ion-icon style="width: 100px; height: 100px"  name="exit-outline"></ion-icon>
                </div>
            </div>
            </a>
                   

                </div>


                
                
            </div>


                @endif





            
                
            </div>


        </div>




       

     



      @if (session('status'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

    </div>
    <!-- * App Capsule -->

   

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
   <script src="../assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="../assets/js/lib/popper.min.js"></script>
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
   <script src="../assets/js/owl.carousel.min.js"></script>
    <!-- Base Js File -->
    <script src="../assets/js/base.js"></script>
    
    <script src="../assets/manifest/js/app.js"></script>
    
    <!-- Base Js File -->
    
<script type="text/javascript">
  

 $('.locate').click(function(){
    $("#domModal").modal("show");
   if (navigator.geolocation) {  
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;
   },
    function error(msg) {},
    {maximumAge:10000, timeout:5000, enableHighAccuracy: true});
} else {
    alert("Geolocation API is not supported in your browser.");
}
       
  });         


function setdom(){
 
   if (navigator.geolocation) {  
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;
        
      
         
        
 $.ajax({
      url: 'setdom',
      type: 'post',
      data: {_token: CSRF_TOKEN,lat: lat, long:long},
      success: function(response){
         location.reload();
      },

     error: function(response){
     alert("une erreur s'est produite");
     }        

            
    });
       
    },
    function error(msg) {},
    {maximumAge:10000, timeout:5000, enableHighAccuracy: true});
} else {
    alert("Geolocation API is not supported in your browser.");
}

 
}

  
    


</script>

</body>

</html>