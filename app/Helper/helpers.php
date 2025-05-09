<?php
// function demo(){
//     return'Iam working';
// }
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

// function handleUpload($inputName ,$model=null){
//     if(request()->hasFile($inputName)){

//         if($model && File::exists(public_path($model->{$inputName}))){
//             File::delete(public_path($model->image));
//         }
//         $file = request()->file($inputName);
//         $fileName =rand().$file->getClientOriginalName();
//         $file->move(public_path('/uploads'),$fileName);
//         $filePath = "/uploads/".$fileName;
//       return $filePath;
//     //
// }
// }

use Illuminate\Support\Facades\Storage;

function handleUpload($inputName, $model = null)
{
    if (request()->hasFile($inputName)) {

        // Delete the old file if it exists
        if ($model && File::exists(storage_path('app/public/' . $model->{$inputName}))) {
            Storage::delete('public/' . $model->{$inputName});
        }

        $file = request()->file($inputName);
        $fileName = rand() . $file->getClientOriginalName();

        // Store the file in storage/app/public/uploads
        $filePath = $file->storeAs('public/uploads', $fileName);
        Log::info('File uploaded successfully: ' );

        // Return the file path for database storage (public/storage/uploads)
        return str_replace('public/', 'storage/', $filePath);
    }
}
    function handleMultipleUploads(array $inputNames, $model = null)
{
    $uploadedFiles = [];

    foreach ($inputNames as $inputName) {
        if (request()->hasFile($inputName)) {

            // Delete the old file if it exists
            if ($model && File::exists(storage_path('app/public/' . $model->{$inputName}))) {
                Storage::delete('public/' . $model->{$inputName});
            }

            $file = request()->file($inputName);
            $fileName = rand() . '_' . $file->getClientOriginalName();

            // Store the file in storage/app/public/uploads
            $filePath = $file->storeAs('public/uploads', $fileName);
            Log::info("File uploaded for {$inputName}: {$fileName}");

            // Store the new file path (convert to public path)
            $uploadedFiles[$inputName] = str_replace('public/', 'storage/', $filePath);
        }
    }

    return $uploadedFiles;
}
