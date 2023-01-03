<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Session;
use File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Image::all();
        return view('Pages.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
         'name'=>'required',
         'image'=>'required|mimes:jpeg,png,jpg',
       ]);
        
       $imageName='';
       if($image=$request->file('image'))
       {
       $imageName = time().''.uniqid().''.$image->getClientOriginalExtension();
       $image->move('images/products',$imageName);
       }
       Image::create([
        'name'=>$request->name,
        'image'=>$imageName
       ]);
       Session::flash('msg','Successfuly Product Uploaded');
       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Image::where('id',$id)->first();
        return view('pages.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
           
          ]);
          $product = Image::where('id',$id)->first();
           
          $imageName='';
          $oldImage = 'images/products/'.$product->image;
          if($image=$request->file('image'))
          {
            if(file_exists($oldImage))
            {
                File::delete($oldImage);
            }
          $imageName = time().''.uniqid().''.$image->getClientOriginalExtension();
          $image->move('images/products',$imageName);
          }
          else
          {
            $imageName = $product->image;
          }
          Image::where('id',$id)->update([
           'name'=>$request->name,
           'image'=>$imageName
          ]);
          Session::flash('msg','Successfuly Product Updated');
          return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Image::where('id',$id)->first();
        $oldImage = 'images/products/'.$product->image;
       File::delete($oldImage);
      
        $product->delete();
        Session::flash('msg',' Deleted');
          return back();
       
    }
}
