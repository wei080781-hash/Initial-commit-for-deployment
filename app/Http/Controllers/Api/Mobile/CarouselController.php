<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\JsonResponse;

class CarouselController extends Controller
{
    /**
     * 取得手機版輪播圖清單
     */
    public function index(): JsonResponse
    {
        $carousels = Carousel::orderBy('order', 'asc')->get()->map(function ($carousel) {
            return [
                'id' => $carousel->id,
                'title' => $carousel->title,
                'description' => $carousel->description,
                'image_url' => url('storage/' . $carousel->image_path),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $carousels
        ]);
    }
}
