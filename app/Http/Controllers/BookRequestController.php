<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use App\Http\Requests\StoreBookRequestRequest;
use App\Http\Requests\UpdateBookRequestRequest;
use App\Http\Resources\BookRequestResource;
use App\Helpers\ResponseHelper;

class BookRequestController extends Controller
{
    public function index()
    {
        $bookRequest=BookRequest::with('customers')->get();
        return ResponseHelper::success(BookRequestResource::collection($bookRequest),'all book requests with their customers');
    }
    public function store(StoreBookRequestRequest $request)
    {
        $bookRequest=BookRequest::create($request->validated());
        return ResponseHelper::success(new BookRequestResource($bookRequest),'added book request successfully');
    }
    public function show(BookRequest $bookRequest)
    {
        return ResponseHelper::success(new BookRequestResource($bookRequest),'book request details');
    }
    public function update(UpdateBookRequestRequest $request, BookRequest $bookRequest)
    {
        $bookRequest->update($request->validated());
        return ResponseHelper::success(new BookRequestResource($bookRequest),'updated book request successfully');
    }
    public function destroy(BookRequest $bookRequest)
    {
        $bookRequest->delete();
        return ResponseHelper::success('deleted book request successfully');
    }
}
