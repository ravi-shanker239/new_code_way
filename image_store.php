// app/Http/Controllers/ImageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public'); // Save the image in the "public/images" folder

            // Save the image's path in the database if needed
            // Example: $model->image_path = 'images/' . $imageName;
            // $model->save();

            // Redirect or do something else after the upload is successful
        }

        // Handle errors or other logic if needed
    }
}
// config file 
// config/filesystems.php
'disks' => [
    // ...
    'public' => [
        'driver' => 'local',
        'root' => public_path(),
        'url' => env('APP_URL').'/public',
        'visibility' => 'public',
    ],
],
public function show($imageName)
    {
        $imagePath = 'images/' . $imageName;
        
        if (Storage::disk('public')->exists($imagePath)) {
            return response()->file(storage_path('app/public/' . $imagePath));
        }

        // Handle the case when the image is not found (e.g., return a default image or a 404 response)
    }