<?php

namespace App\Http\Controllers\Shop\BackEnd;

use App\Http\Controllers\Shop\BackEnd\BackEndController;
use App\Services\SeoScoreAnalyzer;
use App\Services\ArticleSeoScoreAnalyzer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeoScoreController extends BackEndController
{
    public function analyze(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'keyword'          => 'nullable|string|max:255',
            'title'            => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:1000',
            'slug'             => 'nullable|string|max:255',
            'content'          => 'nullable|string',
            'alt_image'        => 'nullable|string|max:255',
            'title_image'      => 'nullable|string|max:255',
        ));

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->errors()), 422);
        }

        $data = $request->all();

        $analyzer = new SeoScoreAnalyzer(
            isset($data['keyword']) ? $data['keyword'] : '',
            isset($data['title']) ? $data['title'] : '',
            isset($data['meta_description']) ? $data['meta_description'] : '',
            isset($data['slug']) ? $data['slug'] : '',
            isset($data['content']) ? $data['content'] : '',
            $request->getHost(),
            isset($data['alt_image']) ? $data['alt_image'] : '',
            isset($data['title_image']) ? $data['title_image'] : ''
        );
        return response()->json($analyzer->analyze());
    }
    public function analyzeArticle(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'keyword'          => 'nullable|string|max:255',
            'title'            => 'nullable|string|max:500',
            'meta_description' => 'nullable|string|max:1000',
            'slug'             => 'nullable|string|max:255',
            'content'          => 'nullable|string',
            'alt_image'        => 'nullable|string|max:255',
            'title_image'      => 'nullable|string|max:255',
        ));

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->errors()), 422);
        }

        $data = $request->all();

        $analyzer = new ArticleSeoScoreAnalyzer(
            isset($data['keyword']) ? $data['keyword'] : '',
            isset($data['title']) ? $data['title'] : '',
            isset($data['meta_description']) ? $data['meta_description'] : '',
            isset($data['slug']) ? $data['slug'] : '',
            isset($data['content']) ? $data['content'] : '',
            $request->getHost(),
            isset($data['alt_image']) ? $data['alt_image'] : '',
            isset($data['title_image']) ? $data['title_image'] : ''
        );
        return response()->json($analyzer->analyze());
    }
}