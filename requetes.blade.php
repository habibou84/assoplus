<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Message</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Association">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="" />
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


      <div class="modal fade dialogbox" id="codeModal" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Créer un code d'adhésion</h5>
                       

                    </div>
                    
                    <div class="modal-body"  >
                      
                        <form action="addcode" class="" method="POST">
                          @csrf
                          <input hidden value="{{$association->id}}" type="" name="id">
                          <div class="form-group mb-2">
                            <label class="form-label">Contact de l'adhérant</label>
                              <input required class="form-control" type="" name="contact">
                          </div>

                          <button type="submit" class="btn btn-primary btn-block">Créer</button>
                        </form>
                      
                        
                    </div>
                   
                </div>
            </div>
        </div>


         <div class="modal fade dialogbox" id="confirmModal" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"></h5>
                       

                    </div>
                    
                    <div class="modal-body" >
                      <div id="confirmModalBody">

                      </div>  
                        <form class="confirmForm" method="POST">
                          @csrf
                          <div class="confirmField">
                            
                          </div>
                        </form>
                      
                        
                    </div>
                   
                </div>
            </div>
        </div>




    <!-- loader -->
    <div id="loader">
        <img src="assets/img/logo-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Messages
        </div>
        @include('includes.rightmenu')
    </div>
    <!-- * App Header -->


    <!-- App Capsule -->
    <div id="appCapsule">
        
        <div class="section-full mt-1">
             @if (session('status') )
      <div class="alert alert-success mb-1" role="alert">
      {{ session('status') }}
      </div>
      @endif


         @if (session('warning') )
      <div class="alert alert-danger mb-1" role="alert">
      {{ session('warning') }}
      </div>
      @endif
            <div class="section-title"></div>
            

                    <ul class="nav nav-tabs lined" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview2" role="tab">
                                Envoyer un message
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#cards2" role="tab">
                                Mes messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings2" role="tab">
                                 Membres
                            </a>
                        </li>
                    </ul>
                  </div>   
                 <div class="card  mt-1">
                <div class="card-body pt-0">   
                    <div class="tab-content mt-2">
                        <div class="tab-pane fade show active" id="overview2" role="tabpanel">
                            <form method="post" action="sendmessage">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Titre</label>
                                    <input type="" name="titre" class="form-control">
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Titre</label>
                                    <select  name="categorie" class="form-control">
                                        <option value="">Choisir une catégorie</option>
                                        <option @if(old('catégorie') == 'aide') selected @endif value="aide">Demande d'aide</option>
                                        <option @if(old('catégorie') == 'financement') selected @endif value="financement">Demande de financement</option>
                                        <option @if(old('catégorie') == 'autre') selected @endif value="autre">Autres</option>
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Détail</label>
                                    <textarea value="{{old('detail')}}" name="detail" class="form-control"></textarea>
                                    
                                </div>

                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="cards2" role="tabpanel">
                            @if(Auth::user()->membre->requetes->count() > 0)
                            @foreach(Auth::user()->membre->requetes as $requete)

            <a  href="requete?id={{$association->id}}&requete_id={{$requete->id}}" class="item mb-2 ">
                           <div class="detail">
                       
                        <div>
                            <strong>{{$requete->titre}}</strong>
                            <p>{{substr($requete->detail, 0, 40)}}@if(strlen($requete->detail)>40)...  @endif</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-danger">{{$requete->status}}</div>
                    </div>
                </a>
                            @endforeach
                            @endif
                        </div>
                        <div class="tab-pane fade" id="settings2" role="tabpanel">
                            Autres requêtes
                        </div>
                    </div>
                </div>
            </div>
        

       

        <!-- Transactions -->
        <div class="section mt-2">

            
                
            </div>
      
        <!-- * Transactions -->




    </div>
    <!-- * App Capsule -->




    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <script >
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function del(id){
           $.ajax({
            url: 'deletecode',
            type: 'post',
            data: {_token: CSRF_TOKEN,id: id},
        
            success: function(response){
              $('#code'+id).css('display', 'none');
            },
        error: function(response){
                    
                      alert("erreur");
                   }
                  
          });

        }
    </script>

</body>

</html>