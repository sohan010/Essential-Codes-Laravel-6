
<?php

//Image Store
public function store(Request $request)
    {
      $this->validate($request,[
        'product_code'=>'required',
        'product_name'=>'required|max:50',
        'product_qty'=>'required',
        'purchase_price'=>'required',
        'selling_price'=>'required'
        ]);

      $data = $request->all();

      $image1 = $request->file('image_one');
      $image2 = $request->file('image_two');
      $image3 = $request->file('image_three');

  if(isset($image1) && isset($image2) && isset($image3)){
    //Image1
    $imageName1 = 'product'.'-'.uniqid().'.'.$image1->getClientOriginalExtension();
    if(!Storage::disk('public')->exists('product')){
        Storage::disk('public')->makeDirectory('product');
    }
    $ProductImage1 = Image::make($image1)->resize(300,350)->save('jpg');
      Storage::disk('public')->put('product/'.$imageName1,$ProductImage1);
      $data['image_one'] = $imageName1;

      //Image2
      $imageName2 = 'product'.'-'.uniqid().'.'.$image2->getClientOriginalExtension();
      if(!Storage::disk('public')->exists('product')){
          Storage::disk('public')->makeDirectory('product');
      }
      $ProductImage2 = Image::make($image2)->resize(300,350)->save('jpg');
        Storage::disk('public')->put('product/'.$imageName2,$ProductImage2);
        $data['image_two'] = $imageName2;

        //Image3
        $imageName3 = 'product'.'-'.uniqid().'.'.$image3->getClientOriginalExtension();
        if(!Storage::disk('public')->exists('product')){
            Storage::disk('public')->makeDirectory('product');
        }
        $ProductImage3 = Image::make($image3)->resize(300,350)->save('jpg');
          Storage::disk('public')->put('product/'.$imageName3,$ProductImage3);
          $data['image_three'] = $imageName3;
  }

      Product::create($data);
      Toastr::success('Product Add Success','Success');
      return redirect()->back();

  }


  // Images Update
  public function update(Request $request, $id)
    {
      $product = Product::findOrFail($id);

       $data['category_id'] = $request->category_id;
       $data['brand_id'] = $request->brand_id;
       $data['product_code'] = $request->product_code;
       $data['product_name'] = $request->product_name;
       $data['product_qty'] = $request->product_qty;
       $data['product_details'] = $request->product_details;
       $data['product_color'] =$request->product_color;
       $data['product_size'] =$request->product_size;
       $data['purchase_price'] = $request->purchase_price;
       $data['selling_price'] = $request->selling_price;

       $image1 = $request->file('image_one');
       $image2 = $request->file('image_two');
       $image3 = $request->file('image_three');

       if(isset($image1)){
         $imageName1 = 'product'.'-'.uniqid().'.'.$image1->getClientOriginalExtension();
         if(!Storage::disk('public')->exists('product')){
             Storage::disk('public')->makeDirectory('product');
         }
         // Delete Old Image-1 Here
          if(Storage::disk('public')->exists('product/'.$product->image_one)){
              Storage::disk('public')->delete('product/'.$product->image_one);
          }
         $ProductImage1 = Image::make($image1)->resize(300,350)->save('jpg');
           Storage::disk('public')->put('product/'.$imageName1,$ProductImage1);
           $data['image_one'] = $imageName1;
           Product::where('id',$id)->update($data);
           Toastr::success('Product Update Success','Success');
           return redirect()->back();
       }

       if(isset($image2)){
         $imageName2 = 'product'.'-'.uniqid().'.'.$image2->getClientOriginalExtension();
         if(!Storage::disk('public')->exists('product')){
             Storage::disk('public')->makeDirectory('product');
         }
         // Delete Old Image-2 Here
          if(Storage::disk('public')->exists('product/'.$product->image_two)){
              Storage::disk('public')->delete('product/'.$product->image_two);
          }
         $ProductImage2 = Image::make($image2)->resize(300,350)->save('jpg');
           Storage::disk('public')->put('product/'.$imageName2,$ProductImage2);
           $data['image_two'] = $imageName2;
           Product::where('id',$id)->update($data);
           Toastr::success('Product Update Success','Success');
           return redirect()->back();
       }

       if(isset($image3)){
         $imageName3 = 'product'.'-'.uniqid().'.'.$image3->getClientOriginalExtension();
         if(!Storage::disk('public')->exists('product')){
             Storage::disk('public')->makeDirectory('product');
         }
         // Delete Old Image-3 Here
          if(Storage::disk('public')->exists('product/'.$product->image_three)){
              Storage::disk('public')->delete('product/'.$product->image_three);
          }
         $ProductImage3 = Image::make($image3)->resize(300,350)->save('jpg');
           Storage::disk('public')->put('product/'.$imageName3,$ProductImage3);
           $data['image_three'] = $imageName3;
           Product::where('id',$id)->update($data);
           Toastr::success('Product Update Success','Success');
           return redirect()->back();
       }

       if(isset($image1) && isset($image2) && isset($image3)){
         //Image1
         $imageName1 = 'product'.'-'.uniqid().'.'.$image1->getClientOriginalExtension();
         if(!Storage::disk('public')->exists('product')){
             Storage::disk('public')->makeDirectory('product');
         }
         // Delete Old Image-1 Here
          if(Storage::disk('public')->exists('product/'.$product->image_one)){
              Storage::disk('public')->delete('product/'.$product->image_one);
          }
         $ProductImage1 = Image::make($image1)->resize(300,350)->save('jpg');
           Storage::disk('public')->put('product/'.$imageName1,$ProductImage1);
           $data['image_one'] = $imageName1;

           //Image2
           $imageName2 = 'product'.'-'.uniqid().'.'.$image2->getClientOriginalExtension();
           if(!Storage::disk('public')->exists('product')){
               Storage::disk('public')->makeDirectory('product');
           }
           // Delete Old Image-2 Here
            if(Storage::disk('public')->exists('product/'.$product->image_two)){
                Storage::disk('public')->delete('product/'.$product->image_two);
            }
           $ProductImage2 = Image::make($image2)->resize(300,350)->save('jpg');
             Storage::disk('public')->put('product/'.$imageName2,$ProductImage2);
             $data['image_two'] = $imageName2;

             //Image3
             $imageName3 = 'product'.'-'.uniqid().'.'.$image3->getClientOriginalExtension();
             if(!Storage::disk('public')->exists('product')){
                 Storage::disk('public')->makeDirectory('product');
             }
             // Delete Old Image-2 Here
              if(Storage::disk('public')->exists('product/'.$product->image_three)){
                  Storage::disk('public')->delete('product/'.$product->image_three);
              }
             $ProductImage3 = Image::make($image3)->resize(300,350)->save('jpg');
               Storage::disk('public')->put('product/'.$imageName3,$ProductImage3);
               $data['image_three'] = $imageName3;

       }else{
           $data['image_one'] = $product->image_one;
           $data['image_two'] = $product->image_two;
           $data['image_three'] = $product->image_three;
            Product::where('id',$id)->update($data);
            Toastr::success('Product Update Success','Success');
            return redirect()->route('product.index');
       }

       Product::where('id',$id)->update($data);
       Toastr::success('Product Update Success','Success');
       return redirect()->route('product.index');
    }
			


    //Images Delete
    public function destroy($id)
    {
      $product = Product::findOrFail($id);
      //Deleting old image-1
       if(Storage::disk('public')->exists('product/'.$product->image_one))
       {
         Storage::disk('public')->delete('product/'.$product->image_one);
       }

       //Deleting old image-2
      if(Storage::disk('public')->exists('product/'.$product->image_two))
      {
        Storage::disk('public')->delete('product/'.$product->image_two);
      }

      //Deleting old image-3
     if(Storage::disk('public')->exists('product/'.$product->image_three))
     {
       Storage::disk('public')->delete('product/'.$product->image_three);
     }

       Product::where('id',$id)->delete();
       Toastr::success('Product Delete Success','Success');
       return redirect()->back();
    }



