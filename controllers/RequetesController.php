<?php

namespace App\Http\Controllers;
use App\User;
use App\Association;
use App\Requete;

use App\Membre;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Helpers\Sms;
class RequetesController extends Controller
{
  

  public function requetes(Request $request){

    $id = $request->id;
     if(Auth()->user()->usertype != "manager")
{
    $id = Auth()->user()->membre->association_id;
}
  $association = Association::findOrFail($id);  


    
    return view("requetes")->with("association", $association);
  }





 


  public function sendmessage(Request $request){
     $request->validate([
            'titre' => 'required',
            'detail' => 'required| string| max:2000',
            'categorie' => 'required',
            
        ]);

     $membre = Auth::user()->membre;

     $requete = new Requete;
     $titre = $request->titre;
     $detail = $request->detail;
     $categorie = $request->categorie;
     
     $requete->titre = $titre;
     $requete->detail = $detail;
     $requete->categorie = $categorie;
     $requete->membre_id = $membre->id;
     $requete->association_id = $membre->association_id;
     $requete->status = "en attente";
     
        $requete->save();


  

        return redirect()->back()->with("status", "Message envoyé");

  }



  public function requete(Request $request){
    $id = $request->id;
    $requete_id = $request->requete_id;

    $requete = Requete::find($requete_id);


    $association = Association::findOrFail($id);

   if($requete)
    {return view('requete')->with('requete', $requete)->with("association", $association);}
     else{
        return redirect()->action('RequetesController@requetes',["id"=>$request->id, "status"=>"Message supprimé"]);
       }

  }

 




 


  public function edit(Request $request){
     $request->validate([
            'titre' => 'required|max:225',
            'detail' => 'required|max:2000',
            'id' => 'required',
            'status' => 'required',
            'category' => 'required'
            
        ]);
      
     $info_id = $request->requete_id;  
     $info = Requete::findOrFail($info_id);
     $category = $request->category;
     $titre = $request->titre;
     $detail = $request->detail;
     $id = $request->id;
     $status = $request->status;

     $info->titre  = $titre;
     $info->categorie = $category;
     $info->detail = $detail;
     $info->association_id = $id;
     $info->membre_id = auth()->user()->membre_id;


     if($request->file()) { 

        $path = Storage::disk('s3')->put('image',$request->file, 'public');
        
            
            $info->image = $path;
            
        }
     


        $info->update();

        return redirect()->back()->with("status", "Message Modifiée");

  }


 


 



  public function editrequetestatus(Request $request){

    $request->validate([
            'status' => 'required',
            
            
        ]);
      
     
     $id = $request->id;
     $info = Requete::findOrFail($id);
     $status = $request->status;

     $info->status  = $status;
     


     

        $info->update();

        return redirect()->back()->with("status", "Stutus Modifiée");


  }



  public function delete(Request $request){
    
     $id = $request->id;
     
     $info = Requete::findOrFail($id);
     
     

     

      $info->delete();
        return redirect()->back()->with("status", "Message supprimé!");

  }


  public function compte(){
    $id = Auth::user()->livreur_id;

    $communes = array("Adjamé", "Cocody", "Attécoubé", "Bingerville", "Anyama", "Koumassi", "Plateau", "Treichville", "Marcory", "Port-Bouet", "Bassam", "Songon", "Abobo", "Yopougon" );

        sort($communes);

    $livreur = Livreur::findOrFail($id);
    return view('compte')->with('livreur', $livreur)->with("communes", $communes);
  } 

  public function photoupload(Request $req){
        $req->validate([
        'file' => 'required|mimes:jpeg,png|max:2048'
        ]);
        
        $id = Auth::user()->livreur_id;
        
        $fileModel = Livreur::findOrFail($id);

        if($req->file()) { 
            
            $path = Storage::disk('s3')->put('image',$req->file, 'public');
            
            
            
            
            $fileModel->photo = $path;
            $fileModel->update();

            return redirect()->back()
            ->with('status','Photo enregistrée.');
        }
   }






}