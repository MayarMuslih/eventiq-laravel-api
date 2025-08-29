<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\CompanyEvent;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function ShowServices(Request $request)
    {
        $validatedData = $request->validate([
            'company_event_id' => 'required|integer',
        ]);

        $services = Service::where('company_event_id', $validatedData['company_event_id'])->get();

        if ($services->isEmpty()) {
            return response()->json([
                'message' => 'No services found for the given company_event_id'
            ], 404);
        }

        return response()->json([
            'services' => $services
        ]);
    }


    public function store(StoreServiceRequest $request)
    {
        $user = Auth::user();

        $company = $user->company;

        if (!$company) {
            return response()->json(['message' => __('service.You don\'t have a Company')], 400);
        }


        $companyEvent = $company->companyEvents()->find($request->company_event_id);

        if (!$companyEvent) {
            return response()->json(['message' => __('service.Not your Company')], 403);
        }

        $service = Service::create($request->validated());

        return response()->json(['message' => __('service.You Added the Service Successfully'), 'service' => $service], 201);
    }

    public function addImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('image')->store('service_images', 'public');

        ServiceImage::create([
            'service_id' => $validated['service_id'],
            'image_url' => $path,
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully',
            'image' => $path,
        ]);
    }

    public function getImages(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $images = ServiceImage::where('service_id', $validated['service_id'])->get();

        return response()->json([
            'images' => $images,
        ], 200);
    }
    public function update(UpdateServiceRequest $request, $id)
    {
        $user = Auth::user();
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'this service doesn\'t exist.'], 404);
        }

        $company = $user->company;
        if (!$company) {
            return response()->json(['message' => ('service.You don\'t have a Company')], 400);
        }

        if ($service->companyEvent->company->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $duplicate = Service::where('company_events_id', $service->company_events_id)
            ->where('service_name', $request->service_name)
            ->where('id', '!=', $service->id)
            ->exists();

        if ($duplicate) {
            return response()->json(['message' => 'this service already exists.'], 409);
        }

        // $companyEvent = $company->companyEvents()->find($request->company_event_id);
        // if (!$companyEvent) {
        //     return response()->json(['message' => ('service.Not your Company')], 403);
        // }

        // check for changes
        $service->fill($request->validated());
        if (!$service->isDirty()) {
            return response()->json(['message' => 'No changes detected.'], 200);
        }

        $service->save();

        return response()->json([
            'message' => 'updated successfully.',
            'service' => $service
        ], 200);
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $service = Service::findOrFail($id);

        $companyEvent = $service->companyEvent;

        if (!$companyEvent || !$companyEvent->company) {
            return response()->json([
                'message' => 'Invalid service or data not linked correctly.'
            ], 400);
        }

        if ($companyEvent->company->user_id !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully.'
        ], 200);
    }



}
