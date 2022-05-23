<div class="modal fade modalbox" id="tableModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title titre">Nouvelle informations</h5>
                    <a href="javascript:;" data-dismiss="modal">Fermer</a>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" class="tableForm" action="addinfo" >
                        @csrf

                        <input  hidden type="" value="{{$association->id}}" name="id">
                         <input class="requete_id" hidden type=""  name="requete_id">
                        <input hidden type="" name="oldadd" value="oldadd">

                       <div class="form-group basic ">
                      
                            <div class="input-wrapper  @error('titre') alert alert-outline-danger @enderror">
                                <label for="titre" class="label">Titre</label>
                                <input   placeholder="" id="titre" type="text" class="form-control titre" name="titre" value="{{ old('titre') }}" required  autofocus>

                               @error('titre')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group basic ">
                            

                            <div class="input-wrapper @error('info') alert alert-outline-danger @enderror">
                                <label for="detail" class="label">Message</label>

                                
                                <textarea  rows="4" cols="50" required class="form-control border detail" name="detail"></textarea>

                                @error('detail')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        
                          @if(Auth()->user()->usertype == "manager" )
                         <div class="form-group basic ">
                      
                            <div class="input-wrapper  @error('status') alert alert-outline-danger @enderror">
                                <label for="name" class="label">Status</label>
                                <select    id="status" class="form-control status" name="status"  required  >
                                 
                                 <option value="">Choisir un status</option>
                                 <option  value="en attente">En attente</option>
                                 <option  value="encours">Encours</option>

                                  <option value="accepte">Accepté</option>
                                 
                                 <option value="refuse">Rejeté</option>



                                 <option value="termine">Terminé</option>

                                 
                                 
                                 
                                 
                               </select>




                               @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif


                               @if(Auth()->user()->usertype == "membre" || Auth()->user()->usertype == "bureau")

                                 <input hidden value="pending" type="" class="status" id="status" name="status">
                                 @endif




                          <div class="form-group basic ">
                          <?php $categories = array("aide", "financement", "autre"); sort($categories); ?>
                            <div class="input-wrapper  @error('category') alert alert-outline-danger @enderror">
                                <label for="name" class="label">Category</label>
                                <select   id="categorie" class="form-control categorie" name="category"  required  >
                                 <option value="">Choisir une catégorie</option>
                                 @foreach($categories as $category)
                                 <option value="{{$category}}">{{$category}}</option>
                                 @endforeach
                               </select>


                               @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                    

     <button class="btn btn-block btn-primary" type="submit">Enregistrer</button>
                      
        </form>
                       
        
                      
                </div>
            </div>
        </div>
    </div>