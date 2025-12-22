<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsServicesController extends Controller
{
    public function index()
    {
        return view('pages.products-services.index');
    }

    public function requestQuote($productId)
    {
        $products = [
            1 => [
                'id' => 1,
                'badge' => 'High Power',
                'title' => 'CB Generating Set-Perkins',
                'image' => 'images/Product_Services/1-4-1-1.png',
                'description' => 'Includes standard diesel generators, ATS panels, automatic starting diesel generators, fully automatic generators, tower lights, silent with soundproof diesel generators & weatherproof diesel generators.',
                'features' => [
                    'Power range: 1000 kVA - 5000 kVA',
                    'Fuel efficiency optimization',
                    'Advanced control systems',
                    'Low emissions technology'
                ]
            ],
            2 => [
                'id' => 2,
                'badge' => 'Industrial',
                'title' => 'CBG-5220 Control System',
                'image' => 'images/Product_Services/3-2-1-1.png',
                'description' => 'CBG-5220 generator controller uses micro-processing technique which can carry out precision measure, constant value adjustment, timing and threshold setting, etc. multi-parameters.',
                'features' => [
                    'Power range: 45 kVA - 2500 kVA',
                    'Customizable configurations',
                    'Weatherproof enclosures',
                    'Remote monitoring capabilities'
                ]
            ],
            3 => [
                'id' => 3,
                'badge' => 'Commercial',
                'title' => 'CBG-5220 Control System',
                'image' => 'images/Product_Services/2-3-1-1.png',
                'description' => 'CBG-5220 generator controller uses micro-processing technique which can carry out precision measure, constant value adjustment, timing and threshold setting, etc. multi-parameters.',
                'features' => [
                    'Power range: 20 kVA - 500 kVA',
                    'Quiet operation',
                    'Compact design',
                    'Quick start capability'
                ]
            ]
        ];

        $product = $products[$productId] ?? $products[1];

        return view('pages.products-services.quote-request', compact('product'));
    }
}
