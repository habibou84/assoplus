<!doctype html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Info - {{$info->titre}}</title>
    <meta name="description" content="{{$info->title}}">
    <meta name="keywords" content="" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<body class="bg-white">
     @include('includes.rightmenumodal')

    
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Info
        </div>
        @include("includes.rightmenu")
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

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
      
        <div class="section mt-2">
             <div class="card">
                    <div class="card-body">
            
            @if($info->user_id == Auth()->user()->id || Auth()->user()->usertype == "manager")
               <div class="row">
                <div class="col">
                
              <button data-desc="Modifier information {{$info->titre}}" data-titre="{{$info->titre}}" data-category="{{$info->category}}" data-details="{{$info->details}}" onclick="edit([$(this).data('titre'), $(this).data('details'),$(this).data('category'), '{{$info->id}}', '{{$info->status}}'],['titre', 'details', 'categorie', 'info_id', 'status'], $(this).data('desc'), 'info_edit');" 
              class="btn btn-primary btn-sm stretched-link edit"><ion-icon name="pencil-outline"></ion-icon>Modifier</button>

              <button class="btn btn-danger btn-sm delete" ><ion-icon name="trash-outline"></ion-icon> </button>
          
               
  
             </div>
             </div>
             @endif

             @if(Auth()->user()->usertype == "manager")
             <div class="row mt-2">
                 <div class="col">
                  Status: @if($info->status == "pending") En attente @endif
                          @if($info->status == "active") Diffusée @endif
                          @if($info->status == "terminated") Archive @endif
                          @if($info->status == "refused") Rejetée @endif
                        .   
                          <form method="POST" action="editinfostatus" class="form-inline">
                            @csrf
                            <input hidden type="" value="{{$info->id}}" name="id">
                              <div class="form-group basic  ">
                      
                            <div class="input-wrapper  @error('status') alert alert-outline-danger @enderror">
                                <label for="status" class="label">Modifier status</label>
                                <select    id="status" class="form-control status" name="status"  required  >
                                 
                                 <option value="">Choisir un status</option>
                                 <option  value="pending">En attente</option>
                                 <option  value="active">Difusée</option>
                                 <option value="terminated">Archive</option>
                                 <option value="rejected">Rejectée</option>
                                 
                               </select>

                               @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-success btn-sm mb-2" type="submit">Valider</button>
                          </form>


                 </div>
             </div>

             @endif
              
                       
             
          </div>  
          </div>  
        </div>
       


        <div class="section mt-2">
            <h1>
                {{$info->titre}}
            </h1>
            <div class="blog-header-info mt-2 mb-2">
                <div>
                    <img 
                      

                    @if(Storage::disk('s3')->exists($info->user->membre->photo))
                            src="{{Storage::disk('s3')->url($info->user->membre->photo)}}" 
                             @else
                src="assets/img/sample/photo/3.jpg"
                 @endif
                    

                     alt="img" class="imaged w24 rounded me-05">
                    by <a href="#">{{$info->user->membre->nom}}</a><br>
                    {{$info->status}}
                </div>
                <div>
                    {{$info->created_at->format('d-m-Y')}}<br>
                    {{$info->category}}
                </div>
            </div>
            <div class="lead">
                {{$info->details}}
            </div>
        </div>

        <div class="section mt-2">
            
            <figure>
                <img 

              @if(Storage::disk('s3')->exists($info->image))
                            src="{{Storage::disk('s3')->url($info->image)}}" 
                             @else
                src="assets/img/sample/photo/3.jpg"
                 @endif

                 alt="image" class="imaged img-fluid">
            </figure>
           
            
        </div>

        <div class="section">
            <button id="shareBtn" class="btn btn-block btn-primary" >
                <ion-icon name="share-outline"></ion-icon>Partager
            </button>
        </div>


        <div class="section mt-3">
            <h2>De la même caégorie</h2>
            <div class="row mt-3">
                @if($association->infos->where('id', '!=', $info->id)->where('category', $info->category)->count()>0)
                @foreach($association->infos->where('id', '!=', $info->id)->where('category', $info->category) as $related)
                <div class="col-6 mb-2">
                    <a href="info?id={{$association->id}}&info_id={{$related->id}}">
                        <div class="blog-card">
                            <img src="assets/img/sample/photo/1.jpg" alt="image" class="imaged w-100">
                            <div class="text">
                                <h4 class="title">{{$related->titre}}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
               
                
               
            </div>
        </div>


    </div>
    <!-- * App Capsule -->

    <!-- Share Action Sheet -->
    <div class="modal fade action-sheet inset" id="actionSheetShare" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Partager sur</h5>
                </div>
                <div class="modal-body">
                    <ul class="action-button-list">
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fparse.com" target="_blank" class="btn btn-list" data-bs-dismiss="modal">
                                <span>
                                    <ion-icon name="logo-facebook"></ion-icon>
                                    Facebook
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="whatsapp://send?text={{$info->titre}}-{{$info->details}}" class="btn btn-list" data-bs-dismiss="modal">
                                <span>
                                    <ion-icon name="logo-whatsapp"></ion-icon>
                                    Whatsapp
                                </span>
                            </a>
                        </li>
                        
                    </ul>
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
                     Souhaitez vous vraiment supprimer cette info?
                        <form class="confirmForm" method="POST" action="info_delete">
                          @csrf
                          <input value="{{$info->id}}" type="" hidden name="id">
                          <button class='btn btn-success'  type="submit">Confirmer</button><button type='button' class='btn btn-secondary' class='close' data-dismiss='modal'>Annuler</button>
                        </form>
                      
                        
                    </div>
                   
                </div>
            </div>
        </div>




@include("includes.infos_modal")




    <!-- * Share Action Sheet -->


   
    <!-- * App Bottom Menu -->

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
   <script src="../assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="../assets/js/lib/popper.min.js"></script>
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    
    <!-- Base Js File -->
    <script src="../assets/js/base.js"></script>
    <script type="text/javascript">
        $(".delete").click(function(){
      var id = $(this).val();  
     $("#confirmModal").modal("show");
     $("#confirmModalBody").html("Souhaitez-vous vraiment supprimer Cette info");


});


function edit(data=array(), fields=array(), title, link){for ( i = 0; i < data.length; i++)
    {
        $("."+fields[i]).val(data[i]);
    }

         $(".title").html(title);
         $(".tableForm").attr("action", link);
         $("#tableModal").modal("show");

}



shareButton = document.getElementById("shareBtn");


shareButton.addEventListener('click', event => {
  if (navigator.share) {
    navigator.share({
      title: $('.edit').data('titre'),
      text: $('.edit').data('titre') + $('.edit').data('details'),
      
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(console.error);
  } else {
    shareDialog.classList.add('is-open');
  }
});





    </script>

</body>

</html>