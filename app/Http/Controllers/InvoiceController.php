<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $keyword = request()->input('keyword');

        $invoices = $this->getInvoicesQuery();
        $invoices = $this->filterInvoices($invoices);

        $invoices = $invoices->orderByDesc('id')->paginate(10);
        $invoices->appends(request()->query());

        return view('invoices.index', compact('invoices', 'keyword'));
    }

    public function products(Invoice $invoice)
    {
        $keyword = request()->input('keyword');

        $products = $this->getProductsQuery($invoice);
        $products = $this->filterProducts($products);

        $products = $products->orderByDesc('id')->paginate(10);
        $products->appends(request()->query());

        return view('invoices.products',
            compact('products', 'invoice', 'keyword'));
    }

    public function getMyInvoices()
    {
        $keyword = request()->input('keyword');

        $invoices = $this->getInvoicesQuery()->where('user_id', auth()->id());
        $invoices = $this->filterInvoices($invoices);

        $invoices = $invoices->orderByDesc('id')->paginate(10);
        $invoices->appends(request()->query());

        return view('me.invoices', compact('invoices', 'keyword'));
    }

    public function getMyInvoiceProduct(Invoice $invoice)
    {
        $keyword = request()->input('keyword');

        $products = $this->getProductsQuery($invoice)
            ->where('user_id', auth()->id());
        $products = $this->filterProducts($products);

        $products = $products->orderByDesc('products.id')->paginate(10);
        $products->appends(request()->query());

        return view('me.invoices-products',
            compact('products', 'invoice', 'keyword'));
    }

    public function create(Request $request)
    {
        $user_id = $request->query->getInt('user_id');
        $user = null;

        if ($user_id) {
            $user = User::query()->findOrFail($user_id);
        }

        return view('invoices.create', ['user' => $user]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $validatedData = $request->validated();
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
        $invoice->update($validatedData);

        return redirect()
            ->route('users.invoices', $invoice->user_id)
            ->with('success', __('messages.Invoice updated successfully.'));
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        if ($invoice->products()->exists()) {
            return redirect()->back()->with('error',
                __('messages.Invoice cannot be deleted because it has associated products.'));
        }

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success',
            __('messages.Invoice deleted successfully.'));
    }

    public function search(Request $request)
    {
        $invoice = Invoice::query()->limit(4)->select('id', 'name');

        if ($request->has('search') && $request->search != '') {
            $invoice = $invoice->where('name', 'like',
                '%'.$request->search.'%');
        }

        $invoice = $invoice->get();

        return response()->json($invoice->toArray());
    }

    private function getInvoicesQuery()
    {
        $keyword = request()->input('keyword');

        return Invoice::query()
            ->with('user')
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            });
    }

    private function getProductsQuery(Invoice $invoice)
    {
        $keyword = request()->input('keyword');

        return Product::query()
            ->leftJoin('invoices', 'invoices.id',
                'products.invoice_id')
            ->where('invoice_id', $invoice->id)
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            })->select('products.*');
    }

    private function filterInvoices($invoices)
    {
        if (request()->has('user_id')) {
            $invoices = $invoices->where('user_id',
                request()->input('user_id'));
        }

        return $invoices;
    }

    private function filterProducts($products)
    {
        // No filtering implemented for products at the moment,
        // but this function can be used to add filters if needed in the future

        return $products;
    }
}
