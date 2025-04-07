<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function contact()
  {
    return view('contact');
  }

    public function confirm(ContactRequest $request)
     { 
        $contact = $request->validated();
         return view('confirm', compact('contact'));
     }

    public function store(Request $request){
        if($request->input('back') == 'back'){
            return redirect('/')
                        ->withInput();
        }else{
         
        $contactData = $request->all();
        $gender = $contactData['gender'] == '男性' ? 1 : ($contactData['gender'] == '女性' ? 2 : 3);


        $category = Category::create([
        'content' => $contactData['content']
        ]);

        Contact::create([
        'last_name'   => $contactData['last_name'],
        'first_name'  => $contactData['first_name'],
        'gender'      => $gender,
        'email'       => $contactData['email'],
        'tel'         => $contactData['tel'],
        'address'     => $contactData['address'],
        'building'    => $contactData['building'] ?? null,
        'detail'      => $contactData['detail'],
        'category_id' => $category->id,
        ]);

        return redirect()->route('thanks');
        }
    }
}