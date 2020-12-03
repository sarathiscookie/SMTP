<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('list', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $category = new Category;

            $category->category_name = $request->category_name;

            $category->category_url = env('APP_URL') . '/' . str_replace(' ', '-', strtolower($request->category_name));

            $category->save();

            return redirect()->back()->with('statusCategory', 'Well Done! Category created successfully!');
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubCategory(Request $request)
    {
        $category = Category::find($request->categoryId);

        if ($category) {
            $subCategory = new SubCategory;

            $subCategory->category_id = $request->categoryId;

            $subCategory->subcategory_name = $request->subcategory_name;

            $subCategory->subcategory_url = $category->category_url . '/' . str_replace(' ', '-', strtolower($request->subcategory_name));

            $subCategory->save();

            return redirect()->back()->with('statusSubcategory', 'Well Done! Subcategory created successfully!');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduct(Request $request)
    {
        $subcategory = SubCategory::find($request->subcategoryId);

        if ($subcategory) {
            $product = new Product;

            $product->subcategory_id = $request->subcategoryId;

            $product->product_name = $request->product_name;

            $product->product_url = $subcategory->subcategory_url . '/' . str_replace(' ', '-', strtolower($request->product_name));

            $product->save();

            return redirect()->back()->with('statusProduct', 'Well Done! Product created successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if ($category) {
            return view('edit', ['category' => $category]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Category update
        $category = Category::find($request->id);
        $category->category_name = $request->category_name;
        $category->category_url = env('APP_URL') . '/' . str_replace(' ', '-', strtolower($request->category_name));
        $category->save();

        // Sub category update
        $subcategories = SubCategory::where('category_id', $request->id)->get();

        if($subcategories) {
            foreach ($subcategories as $sub) {
                $subcategory = SubCategory::find($sub->id);
                $subcategory->subcategory_url = $category->category_url . '/' . str_replace(' ', '-', strtolower($subcategory->subcategory_name));
                $subcategory->save();
    
                // Product update
                $products = Product::where('subcategory_id', $subcategory->id)->get();
    
                if($products) {
                    foreach ($products as $prod) {
                        $product = Product::find($prod->id);
                        $product->product_url = $subcategory->subcategory_url . '/' . str_replace(' ', '-', strtolower($product->product_name));
                        $product->save();
                    }
                }
                
            }
        }
        

        return redirect('/')->with('update', 'Well Done! Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
