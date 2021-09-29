<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;
use Session;




class MembreController extends Controller
{




    public function AddMembre()
    {
        $members = array();

        Session()->put('mbr', $members);
        return view('admin.membre.create');
    }

    public function StoreMembre(Request $request)
    {
        // Session::get('membre');
        // Session()->forget('membre');


        $request->validate([
            'photo_membre' => 'required|mimes:jpg,jpeg,png',
        ]);
        // dd('check');

        $membre_image = $request->file('photo_membre');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($membre_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'images/membres/';
        $last_img = $up_location . $img_name;
        $membre_image->move($up_location, $img_name);

        $membre = new Membre;


        $membre->nom_membre = $request->nom_membre;
        $membre->email_membre = $request->email_membre;
        $membre->telephone_membre = $request->telephone_membre;
        $membre->photo_membre = $last_img;
        $membre->cni_membre = $request->cni;
        $membre->pays_membre = $request->pays_residence;
        $membre->ville_membre = $request->ville_residence;
        $membre->profession_membre = $request->profession;
        $membre->date_naissance_membre = $request->date_naissance;

        $membre->save();
        // array_push($members, $membre);

    //     if (Session::has('mbr')) {
    //         Session::push('mbr', $membre);

    //         $array = Session::get('items');

    //   foreach ($array as $key => $value) {

    //       $id = $value['item_id'];
    //       $quantity = $value['item_quantity'];

    //       if (!isset($total[$id])) {
    //         $total[$id] = 0;
    //       }

    //       $total[$id] += $quantity;
    //       echo $total[$id];
    //   }
    //     } else {
    //         Session::put('mbr', $membre);
    //     }



        // print_r(Session()->get('mbr'));

        foreach (Session()->get('mbr') as $mbr) {
            echo '<pre>';
            var_dump($mbr);
            echo '</pre>';
        }

        // return Redirect()->route('add.project')->with('success', 'Member inserted succesfully');
    }

    // public function EditSlide($id)
    // {
    //     $equipes = DB::table('equipes')->where('id', $id)->first();
    //     return view('admin.projet.create', compact('equipes'));
    // }

    // public function UpdateSlide(Request $request, $id)
    // {
    //     $data = array();
    //     $data['nom'] = $request->nom_equipe;
    //     $data['email'] = $request->email_equipe;
    //     $data['telephone'] = $request->telephone_equipe;
    //     DB::table('sliders')->where('id', $id)->update($data);

    //     $oldimage = $request->oldimage;
    //     $image = $request->image;
    //     if ($image) {
    //         $name_gen = hexdec(uniqid());
    //         $img_ext = strtolower($image->getClientOriginalExtension());
    //         $img_name = $name_gen.'.'.$img_ext;
    //         $up_location = 'images/equipes/';
    //         $last_img = $up_location.$img_name;
    //         $image->move($up_location, $img_name);

    //         $data['image'] = $last_img;

    //         unlink($oldimage);
    //         DB::table('equipes')->where('id', $id)->update($data);


    //         // return Redirect()->route('home.slider')->with('success', 'Slide updated succesfully');
    //     } else {

    //         $data['image'] = $oldimage;
    //         DB::table('equipes')->where('id', $id)->update($data);
    //         // return Redirect()->route('home.slider')->with('success', 'Slide updated succesfully');
    //     }
    // }

    // public function DeleteSlide($id)
    // {

    //     $slider = DB::table('equipes')->where('id', $id)->first();
    //     unlink($slider->image);

    //     DB::table('equipes')->where('id', $id)->delete();

    //     // return Redirect()->route('home.slider')->with('success', 'Slide deleted succesfully');;
    // }
}
