<?php


namespace App\Helper;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class CustomController extends Controller
{
    /** @var Request  */
    protected $request;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    public function postField($key)
    {
        return $this->request->request->get($key);
    }

    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    public function uploadImage($field, $targetName = '', $disk = 'upload')
    {
        $file = $this->request->file($field);

        return Storage::disk($disk)->put($targetName, File::get($file));
    }

    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }

    public function convertToPdf($viewRender, $data = [])
    {
        $html = view($viewRender)->with($data);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}
