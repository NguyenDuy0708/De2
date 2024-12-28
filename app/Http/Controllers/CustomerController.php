<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'account_type' => 'required',
            'password' => 'required|min:6',
        ]);

        Customer::create([
            'email' => $request->email,
            'account_type' => $request->account_type,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/customers')->with('success', 'Thêm khách hàng thành công!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'account_type' => 'required',
        ]);

        $customer->update([
            'email' => $request->email,
            'account_type' => $request->account_type,
            'status' => $request->status,
            'password' => $request->password ? bcrypt($request->password) : $customer->password,
        ]);

        return redirect('/customers')->with('success', 'Cập nhật khách hàng thành công!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/customers')->with('success', 'Xóa khách hàng thành công!');
    }
}
