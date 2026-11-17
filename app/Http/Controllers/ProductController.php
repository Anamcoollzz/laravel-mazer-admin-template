<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\ProductsTemplateExport;
use App\Http\Requests\ImportProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the products in a DataTable.
     */
    public function index(): View
    {
        $products = Product::query()
            ->latest('id')
            ->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('products.create', [
            'product' => new Product(['price' => 0, 'stock' => 0, 'is_active' => true]),
        ]);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::query()->create($request->validated());

        return to_route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return to_route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Duplicate the specified product.
     */
    public function duplicate(Product $product): RedirectResponse
    {
        $copy = $product->duplicate();

        return to_route('products.index')
            ->with('success', "Produk berhasil diduplikasi menjadi {$copy->name} ({$copy->sku}).");
    }

    /**
     * Download the Excel import template for products.
     */
    public function template(): BinaryFileResponse
    {
        return Excel::download(
            new ProductsTemplateExport,
            'products-import-template.xlsx',
        );
    }

    /**
     * Export products to an Excel file.
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(
            new ProductsExport,
            'products-'.now()->format('Y-m-d').'.xlsx',
        );
    }

    /**
     * Import products from an uploaded Excel file.
     */
    public function import(ImportProductRequest $request): RedirectResponse
    {
        try {
            Excel::import(new ProductsImport, $request->file('file'));
        } catch (ValidationException $exception) {
            $failures = collect($exception->failures())
                ->map(fn ($failure): string => "Baris {$failure->row()}: ".implode(', ', $failure->errors()))
                ->take(5)
                ->implode(' | ');

            return to_route('products.index')
                ->with('error', "Gagal import Excel. {$failures}");
        }

        return to_route('products.index')
            ->with('success', 'Data produk berhasil diimport dari Excel.');
    }
}
