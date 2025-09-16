<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        /*if($request->has('search')){
            // when(condtion, function)
            $customers = Customer::when($request->has('search'), function($query) use($request){
                //
                $query->where('first_name', 'LIKE', "%$request->search%")
                      ->orWhere('last_name', 'LIKE', "%$request->search%")
                      ->orWhere('email', 'LIKE', "%$request->search%")
                      ->orWhere('phone', 'LIKE', "%$request->search%")
                      ->orWhere('bank_account_number', 'LIKE', "%$request->search%");
            })->get();
            //
            return view('customer.index', compact('customers'));
        }else{
            //
            $customers = Customer::all();
            //
            return view('customer.index', compact('customers'));
        }*/
        //
        $customers = Customer::query()->when($request->filled('search'), function($query) use($request){
            $query->where('first_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%")
                  ->orWhere('phone', 'LIKE', "%{$request->search}%")
                  ->orWhere('bank_account_number', 'LIKE', "%{$request->search}%");
        })->/*orderBy('id', 'DESC')->*/
        orderBy('id', $request->has('order') && $request->order == 'asc' ? 'ASC' : 'DESC')
        ->get();
        //
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        //
        //dd($request->all());
        //
        /*$customer = new Customer();
        //
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;
        //
        $customer->save();*/
        //
        $data = $request->validated();
        //
        if($request->hasFile('image')){
            //
            //$imagePath = $request->file('image')->store('default_images', 'public');
            //
            /*$request->merge([
                'image' => $imagePath,
            ]);*/
            //
            //$data['image'] = $request->file('image')->store('default_image', 'public');
            //
            //$data['image'] = $request->file('image')->store('', 'public');
            //
            $file = $request->file('image');
            //
            //$fileName = time().'.'.$file->getClientOriginalExtension();
            //
            //$fileName = uniqid().'.'.$file->getClientOriginalExtension();
            //
            $fileName = $file->hashName();
            //
            $file->move(public_path('default_image/'), $fileName);
            //
            $data['image'] = $fileName;
        }
        //
        Customer::create($data);
        //
        //return view('customer.index');
        //
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        //
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $customer = Customer::find($id);
        //
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        //
        //dd($request->all());
        $data = $request->validated();
        //
        $customer = Customer::findOrFail($id);
        //
        if($request->hasFile('image')){
            //
            //File::delete(public_path($customer->image));
            //
            if($customer->image && File::exists(public_path('default_image/'.$customer->image))){
                //
                File::delete(public_path('default_image/'.$customer->image));
            }
            //
            //$customer['image'] = $request->file('image')->store('', 'public');
            //
            //$customer->image = $request->file('image')->store('', 'public');
            //
            $file = $request->file('image');
            //
            $fileName = $file->hashName();
            //
            $file->move(public_path('default_image/'), $fileName);
            //
            $data['image'] = $fileName;
        }
        //
        /*$customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_account_number = $request->bank_account_number;
        $customer->about = $request->about;
        //
        $request->save();*/
        //
        $customer->update($data);
        //
        //$customers = Customer::all();
        //
        //return view('customers.index', compact('customers'));
        //
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        // if present in db and exists in folder then delete
        if($customer->image && File::exists(public_path('default_image/'.$customer->image))){
            //
            //File::delete(public_path('default_image/'.$customer->image));
        }
        //
        //File::delete(public_path('default_image/'.$customer->image));
        //
        //$customer->delete();
        //
        Customer::where('id', $id)->delete();
        //
        return redirect()->route('customers.index');
    }
    /**
     * Trash the specified resource from storage.
     */
    public function trashStore(Request $request){
        //
        $customers = Customer::query()->when($request->filled('search'), function($query) use($request){
            $query->where('first_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%")
                  ->orWhere('phone', 'LIKE', "%{$request->search}%")
                  ->orWhere('bank_account_number', 'LIKE', "%{$request->search}%");
        })->/*orderBy('id', 'DESC')->*/
        orderBy('id', $request->has('order') && $request->order == 'asc' ? 'ASC' : 'DESC')
        ->onlyTrashed()->get();
        //
        return view('customer.trash', compact('customers'));
    }
    /**
     * Restore the specified resource from storage.
    */
    public function restoreStore(string $id){
        //
        $customer = Customer::onlyTrashed()->findOrFail($id);
        //
        $customer->restore();
        //
        return redirect()->back();
    }
    /**
     * Force Destroy the specified resource from storage.
    */
    public function forceDestroy(string $id){
        //
        $customer = Customer::onlyTrashed()->findOrFail($id);
        //
        if($customer->image && File::exists(public_path('default_image/'.$customer->image))){
            //
            File::delete(public_path('default_image/'.$customer->image));
        }
        //
        $customer->forceDelete();
        //
        return redirect()->back();
    }
}
    
