<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = DB::table('sliders')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlide()
    {
        return view('admin.slider.create');
    }

    public function StoreSlide(Request $request)
    {
        // $validated = $request->validate([
        //     'brand_name' => 'required|unique:brands|min:4',
        //     'image' => 'required|mimes:jpg,jpeg,png',
        // ],

        // [
        //     'brand_name.required' => 'Please Input Brand Name',
        //     'brand_image.min' => 'Brand longer than 4 characters',
        // ]);

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('images/slides/' . $name_gen);

        $last_img = 'images/slides/' . $name_gen;

        $data = array();
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['image'] = $last_img;
        $data['created_at'] = Carbon::now();
        DB::table('sliders')->insert($data);

        return Redirect()->route('home.slider')->with('success', 'Slide inserted succesfully');
    }

    public function EditSlide($id)
    {
        $slider = DB::table('sliders')->where('id', $id)->first();
        return view('admin.slider.edit', compact('slider'));
    }

    public function UpdateSlide(Request $request, $id)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        DB::table('sliders')->where('id', $id)->update($data);

        $oldimage = $request->oldimage;
        $image = $request->image;
        if ($image) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save('images/slides/' . $image_one);
            $data['image'] = 'images/slides/' . $image_one;
            DB::table('sliders')->where('id', $id)->update($data);
            unlink($oldimage);

            return Redirect()->route('home.slider')->with('success', 'Slide updated succesfully');
        } else {

            $data['image'] = $oldimage;
            DB::table('sliders')->where('id', $id)->update($data);
            return Redirect()->route('home.slider')->with('success', 'Slide updated succesfully');
        }
    }

    public function DeleteSlide($id)
    {

        $slider = DB::table('sliders')->where('id', $id)->first();
        unlink($slider->image);

        DB::table('sliders')->where('id', $id)->delete();

        return Redirect()->route('home.slider')->with('success', 'Slide deleted succesfully');;
    }


    public function HomePartenaires()
    {
        $partenaires = DB::table('partenaires')->get();
        return view('admin.partenaire.index', compact('partenaires'));
    }

    public function StorePartenaires(Request $request)
    {

        $image = $request->file('image');

        foreach ($image as $multi) {


            $name_gen = hexdec(uniqid()) . '.' . $multi->getClientOriginalExtension();
            Image::make($multi)->resize(300, 300)->save('images/partenaires/' . $name_gen);

            $last_img = 'images/partenaires/' . $name_gen;

            $data = array();
            $data['image'] = $last_img;
            $data['created_at'] = Carbon::now();
            DB::table('partenaires')->insert($data);
        }  //end of the foreach

        return Redirect()->back()->with('success', 'Partenaires inserted succesfully');
    }

    public function DeletePartenaire($id)
    {

        $partenaires = DB::table('partenaires')->where('id', $id)->first();
        unlink($partenaires->image);

        DB::table('partenaires')->where('id', $id)->delete();

        return Redirect()->route('home.partenaire')->with('success', 'Partenaire deleted succesfully');
    }



    public function HomeChiffre()
    {

        $chiffres = DB::table('chiffres')->first();
        return view('admin.chiffre.index', compact('chiffres'));
    }

    public function EditChiffre($id)
    {
        $chiffre = DB::table('chiffres')->where('id', $id)->first();
        return view('admin.chiffre.edit', compact('chiffre'));
    }

    public function UpdateChiffre(Request $request, $id)
    {

        $data = array();
        $data['title'] = $request->title;
        $data['description'] = $request->description;

        $oldimage = $request->oldimage;
        $image = $request->image;
        if ($image) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 300)->save('images/chiffres/' . $image_one);
            $data['image'] = 'images/chiffres/' . $image_one;
            DB::table('chiffres')->where('id', $id)->update($data);
            unlink($oldimage);

            return Redirect()->route('home.chiffre')->with('success', 'Chiffres updated succesfully');
        } else {

            $data['image'] = $oldimage;
            DB::table('chiffres')->where('id', $id)->update($data);
            return Redirect()->back()->with('success', 'Chiffres updated succesfully');
        }

    }
}
