<?php
namespace Appmax\Http\Controllers\Admin;

use Appmax\Http\Controllers\Controller;
use Appmax\Models\Product;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index() {

        $now = Carbon::now();
        $dateNowBtBr = date('d/m/Y', strtotime($now->toDateString()));
        $dateStart = $now->toDateString()." 00:00:00";
        $dateEnd = $now->toDateString()." 23:59:59";

        $productsReportA = Product::whereBetween('CreatedAt', [$dateStart, $dateEnd])->where('IsActive', 1)->withTrashed()->get();
        $totalProductsReportA = $productsReportA->count();

        $productsReportB = Product::whereBetween('DeletedAt', [$dateStart, $dateEnd])->withTrashed()->get();
        $totalProductsReportB = $productsReportB->count();

        $productsReportC = Product::whereBetween('CreatedAt', [$dateStart, $dateEnd])->where('IsActive', 1)->where('MethodInsert', 1)->withTrashed()->get();
        $totalProductsReportC = $productsReportC->count();

        $productsReportD = Product::whereBetween('CreatedAt', [$dateStart, $dateEnd])->where('IsActive', 1)->where('MethodInsert', 2)->withTrashed()->get();
        $totalProductsReportD = $productsReportD->count();

        $productsReportE = Product::where('Amount', '<=', 100)->withTrashed()->get();
        $totalProductsReportE = $productsReportE->count();

        $reports = collect([
            "reportA" => collect([
                "description" => "Produtos que foram cadastrados no estoque.",
                "products" => $productsReportA,
                "total" => $totalProductsReportA
            ]),
            "reportB" => collect([
                "description" => "Produtos que foram removidos do estoque.",
                "products" => $productsReportB,
                "total" => $totalProductsReportB
            ]),
            "reportC" => collect([
                "description" => "Produtos que foram cadastrados no estoque via sistema.",
                "products" => $productsReportC,
                "total" => $totalProductsReportC
            ]),
            "reportD" => collect([
                "description" => "Produtos que foram cadastrados no estoque via API.",
                "products" => $productsReportD,
                "total" => $totalProductsReportD
            ]),
            "reportE" => collect([
                "description" => "Produtos que possuem uma quantidade menor ou igual a 100 unidades.",
                "products" => $productsReportE,
                "total" => $totalProductsReportE
            ]),
        ]);

        return view('admin.produtos.report', ['reports' => $reports, 'date' => $dateNowBtBr]);
    }
}