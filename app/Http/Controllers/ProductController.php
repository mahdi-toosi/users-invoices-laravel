<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $keyword = request()->input('keyword');

        $products = Product::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            });

        if (request()->has('invoice_id')) {
            $products = $products->where('invoice_id',
                request()->input('invoice_id'));
        }

        $products = $products->orderByDesc('id')->paginate(10);
        $products->appends(request()->query());

        return view('products.index', compact('products', 'keyword'));
    }

    public function create(Request $request)
    {
        $invoice_id = $request->query->getInt('invoice_id');
        $invoice = null;

        if ($invoice_id) {
            $invoice = Invoice::query()->findOrFail($invoice_id);
        }

        return view('products.create', ['invoice' => $invoice]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::query()->create($request->validated());

        return redirect()
            ->route('invoices.products', $product->invoice_id)
            ->with('success', __('messages.Product created successfully.'));
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $product = $product->with('invoice.user')->findOrFail($product->id);

        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()
            ->route('invoices.products', $product->invoice_id)
            ->with('success', __('messages.Product updated successfully.'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success',
            __('messages.Product deleted successfully.'));
    }
}
