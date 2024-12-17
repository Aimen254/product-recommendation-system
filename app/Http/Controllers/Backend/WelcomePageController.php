<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WelcomePageRequest;
use App\Models\WelcomePage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WelcomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = getActiveProject();
        $page_data = $project->welcomePage;
        return view('welcome_page.index', compact('page_data'));
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
    public function store(WelcomePageRequest $request, $uuid)
    {
        try {
            $account = getActiveAccount();
            $project = getActiveProject();
            $validated = $request->validated();
            $product = WelcomePage::updateOrCreate(
                [
                    'project_id' => $project->id,
                ],
                [
                    'uuid' => Str::uuid(),
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'button_text' => $validated['button_text'],
                ]
            );

            if ($request->has('img')) {
                $image = $request->file('img');
                $product->update(['image' => time() . $image->getClientOriginalName()]);
                $image->storeAs('public/images', time() . $image->getClientOriginalName());
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Welcome Page Updated Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
