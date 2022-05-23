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
        return redirect()->action('InfosController@requetes',["id"=>$request->id, "status"=>"Message supprimé"]);
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


 


   public function delete(Request $request){
    
     $id = $request->id;
     
     $cotisation = Cotisation::findOrFail($id);
     
     if($cotisation->payements->count()>0)
     {
        return redirect()->back()->with("warning", "Pour supprimer cette cotisation, il faut d'abord supprimer les payements qui y sont liés");
     }

     

      $cotisation->delete();
        return redirect()->back()->with("status", "Cotisation supprimé!");

  }



  public function editaccount(Request $request) 
  {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string'],
            'adresse' => ['required', 'string', 'max:255'],
           
        ]);

        $id = Auth::user()->livreur_id;

        $livreur = Livreur::findOrFail($id);

        $livreur->nom = $request->name;
        $livreur->city = $request->city;
        $livreur->adresse = $request->adresse;
         
        $livreur->update();  

        return redirect()->back()
            ->with('status','Profile modifié.');

  } 


  public function editpassword(Request $request) 
  {
       $id = Auth::user()->livreur_id;

        $livreur = Livreur::findOrFail($id);

        



        $request->validate([

            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            
           
        ]);

        if( !Hash::check($request->current_password, Auth::user()->password))
        {
            
          $errors = new MessageBag();
           $errors->add('current_password', "Le mot de passe actuel n'est pas correct ");
          
           return back()->withErrors($errors);
        }

        Auth::user()->password = Hash::make($request->password);
        
         
        Auth::user()->update();  

        return redirect()->back()
            ->with('status','Mot de passe modifié.');

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