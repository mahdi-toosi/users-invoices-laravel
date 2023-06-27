<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;

class InvoiceController extends Controller
{
    public function index()
    {
        $keyword = request()->input('keyword');

        $invoices = Invoice::query()
            ->with('user')
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            });

        if (request()->has('user_id')) {
            $invoices = $invoices->where('user_id', request()->input('user_id'));
        }

        $invoices = $invoices->orderByDesc('id')->paginate(10);
        $invoices->appends(request()->query());

        return view('invoices.index', compact('invoices', 'keyword'));
    }

    public function products(Invoice $invoice) {
        $keyword = request()->input('keyword');

        $products = Product::query()
            ->where('invoice_id', $invoice->id)
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            });

        $products = $products->orderByDesc('id')->paginate(10);
        $products->appends(request()->query());

        return view('invoices.products', compact('products', 'invoice', 'keyword'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(StoreInvoiceRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['date'] = $this->convertDateToMiladi($validatedData['date']);
        $invoice = Invoice::query()->create($validatedData);

        return redirect()
            ->route('users.invoices', $invoice->user_id)
            ->with('success', __('messages.Invoice created successfully.'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice = $invoice->with('user')->findOrFail($invoice->id);

        return view('invoices.edit', compact('invoice'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {

        $validatedData = $request->validated();
        $validatedData['date'] = $this->convertDateToMiladi($validatedData['date']);
        $invoice = $invoice->update($validatedData);

        return redirect()
            ->route('users.invoices', $invoice->user_id)
            ->with('success', __('messages.Invoice updated successfully.'));
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        if ($invoice->products()->exists()) {
            return redirect()->back()->with('error', __('messages.Invoice cannot be deleted because it has associated products.'));
        }

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', __('messages.Invoice deleted successfully.'));
    }

    public function search(Request $request)
    {
        $invoice = Invoice::query()->limit(4)->select('id', 'name');

        if ($request->has('search') && $request->search != '') {
            $invoice = $invoice->where('full_name', 'like', '%'.$request->search.'%');
        }

        $invoice = $invoice->get();

        return response()->json($invoice->toArray());
    }

    private function convertDateToMiladi($date)
    {
        return CalendarUtils::createCarbonFromFormat('Y/m/d', $date)->format('Y-m-d');
    }
}
