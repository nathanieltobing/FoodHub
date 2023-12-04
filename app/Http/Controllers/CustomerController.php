<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function viewCustomerProfile(Customer $c){
        $editmode = false;
        $editprofpic = false;
        return view('profile',[
            'customer' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic
        ]);
    }

    public function enableEdit(Customer $c){
        $editmode = true;
        $editprofpic = false;
        return view('profile',[
            'customer' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic
        ]);
    }

    public function showEditPict(Customer $c){
        $editmode = true;
        $editprofpic = true;
        return view('profile',[
            'customer' => $c,
            'editMode' => $editmode,
            'editprofpic' => $editprofpic
        ]);
    }

    public function editProfile(Request $request, Customer $c)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'nullable|date',
            'phone' => 'nullable',
            'password' => 'nullable'
        ]);

        if(empty($validated['password'])){
            unset($validated['password']);
        }

        DB::table('customers')->where('id', $c->id)->update($validated);
        return redirect('profile/'.$c->id)->with('message','Profile edited successfully');
    }

    public function editPicture(Request $request, Customer $c)
    {

        if($request->hasFile('image')){
            $fileImage = $request->file('image');
            $imageName ='user '.$c->name.'.'.$fileImage->getClientOriginalExtension();
            Storage::putFileAs('public/images', $fileImage, $imageName);
        }
        else{
            $imageName = $c->image;
        }

        DB::table('customers')->where('id', $c->id)->update([
            'image' => $imageName
        ]);

        return redirect('profile/'.$c->id)->with('message','Profile picture edited succesfully');
    }

    public function removePicture(Customer $c)
    {
        Storage::delete ('public/image/'.$c->image);
        DB::table('customers')->where('id', $c->id)->update([
            'image' => NULL
        ]);

        return redirect('profile/'.$c->id)->with('message','Profile picture removed!');
    }
}
