<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
    $categories = Category::all(); 
    $query = Contact::with('category'); 
    
    if ($request->filled('keyword')) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', "%{$request->keyword}%")
              ->orWhere('last_name', 'like', "%{$request->keyword}%")
              ->orWhere('email', 'like', "%{$request->keyword}%");
        });
    }
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }
    if ($request->filled('content')) {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('content', $request->content); 
        });
    }
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }
    
    $contacts = $query->paginate(7);
    return view('admin', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin_detail', compact('contact'));
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', "%{$request->keyword}%")
              ->orWhere('last_name', 'like', "%{$request->keyword}%")
              ->orWhere('email', 'like', "%{$request->keyword}%");
        });
         }
        if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
        }
        if ($request->filled('content')) {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('content', $request->content); 
        });
        }
        if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get(); 

        $csvData = [];
        $csvData[] = ['名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容','作成日'];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->last_name,
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                $contact->email,
                optional($contact->category)->content,
                $contact->detail,
                $contact->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $response = new StreamedResponse(function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment;filename="contacts_export.csv"');

        return $response;
     }

     public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();
    return redirect()->route('admin.index')->with('success', '削除しました');
}
    
}
