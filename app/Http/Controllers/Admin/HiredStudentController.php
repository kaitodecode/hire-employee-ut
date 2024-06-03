<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHiredStudentRequest;
use App\Http\Requests\StoreStudentPhotoRequest;
use App\Http\Requests\StoreStudentPhotoRequest;
use App\Imports\HiredStudentImport;
use App\Models\Branch;
use App\Models\HiredStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use ZipArchive;

class HiredStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = HiredStudent::with('branch');
        if ($request->has('query') && !empty($request->input('query'))) {
            $students->where('name', 'LIKE', '%' . $request->input('query') . '%');
        }

        if ($request->has('role') && !empty($request->input('role'))) {
            $students->where('role', $request->input('role'));
        }

        if ($request->has('hired') && !empty($request->input('hired'))) {
            $students->where('hasRecruit', $request->input('hired') == 'true' ? 1 : 0);
        }

        $students = $students->paginate(1);
        return view('admin.hired_student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch = Branch::all();
        return view('admin.hired_student.create', compact('branch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHiredStudentRequest $request)
    {
        try {
            DB::beginTransaction();

            $hs = new HiredStudent;

            if ($request->hasFile('photo')) {
                $fileName = $request->file('photo')->hashName();
                $path = $request->file('photo')->storeAs('photo_student', $fileName);

                $hs->photo = config('app.url') . '/storage/' . $path;
            }

            $branch = Branch::where('id', $request->branch)->first();
            if (!$branch) {
                toastr()->error("Branch ID not found!");
                return back()->withInput();
            }

            $hs->branch_id = $branch->id;
            $hs->name = $request->name;
            $hs->age = $request->age;
            $hs->height = $request->height;
            $hs->weight = $request->weight;
            $hs->experience = $request->experience;
            $hs->role = $request->role;
            $hs->save();

            DB::commit();

            toastr()->success("Successfully create student!");
            return to_route('admin.hired-students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = HiredStudent::with('branch')->where('id', $id)->first();
        if (!$student) {
            toastr()->error("Student ID not found!");
            return back();
        }
        $branch = Branch::all();
        return view('admin.hired_student.edit', compact('student', 'branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreHiredStudentRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $hs = HiredStudent::where('id', $id)->first();
            if (!$hs) {
                toastr()->error("Student ID not found!");
                return back()->withInput();
            }

            if ($request->hasFile('photo')) {
                if (Storage::exists(explode('storage/', $hs->photo)[1])) {
                    Storage::delete(explode('storage/', $hs->photo)[1]);
                }
                $fileName = $request->file('photo')->hashName();
                $path = $request->file('photo')->storeAs('photo_student', $fileName);

                $hs->photo = config('app.url') . '/storage/' . $path;
            }

            $branch = Branch::where('id', $request->branch)->first();
            if (!$branch) {
                toastr()->error("Branch ID not found!");
                return back()->withInput();
            }

            $hs->branch_id = $branch->id;
            $hs->name = $request->name;
            $hs->age = $request->age;
            $hs->height = $request->height;
            $hs->weight = $request->weight;
            $hs->experience = $request->experience;
            $hs->role = $request->role;
            $hs->hasRecruit = ($request->recruit == 'yes') ? true : (($request->recruit == 'no') ? false : null);
            $hs->save();

            DB::commit();

            toastr()->success("Successfully create student!");
            return to_route('admin.hired-students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();

            $hs = HiredStudent::where('id', $id)->first();
            if(!$hs){
                toastr()->error("Student ID not found!");
                return back();
            }


            if ((strpos($hs->photo, 'storage/') !== false) && (Storage::exists(explode('storage/', $hs->photo)[1]))) {
                Storage::delete(explode('storage/', $hs->photo)[1]);
            }

            $name = $hs->name;
            $hs->delete();
            DB::commit();

            toastr()->success("Successfully deleted student: $name");
            return back();
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_excel' => [
                'required',
                'file',
                'mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'mimes:xlsx',
            ],
        ]);

        if ($validator->fails()) {
            toastr()->error("Please enter .xlsx file!", "Error validation");
            return back();
        }

        try {
            $file = $request->file('file_excel');

            Excel::import(new HiredStudentImport, $file);

            toastr()->success("Successfully add data!");
            return to_route('admin.hired-students.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function uploadPhotoView()
    {
        return view('admin.hired_student.upload-photo');
    }
    public function uploadAndValidateZip(StoreStudentPhotoRequest $request)
    {
        $file = $request->file('archive');
        $filePath = $file->storeAs('temp', $file->getClientOriginalName());

        $isValid = $this->validateZipContent(storage_path('app/' . $filePath));

        if ($isValid) {
            Storage::move($filePath, 'public/archives/' . $file->getClientOriginalName());
            toastr()->error("File is valid and has been uploaded successfully");
            return back();
        } else {
            Storage::delete($filePath);
            toastr()->error("Invalid file structure!","The contents of the zip file must have a folder named “student_photo”");
            return back();
        }
    }

    private function validateZipContent($zipFilePath)
    {
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath) === TRUE) {
            $folderExists = false;
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $stat = $zip->statIndex($i);
                if (strpos($stat['name'], 'photo_students/') === 0) {
                    $folderExists = true;
                    break;
                }
            }
            $zip->close();
            return $folderExists;
        }
        return false;
    }
}
