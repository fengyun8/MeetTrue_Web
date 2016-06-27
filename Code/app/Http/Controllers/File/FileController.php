<?php

namespace app\Http\Controllers\File;


use App\Http\Controllers\Controller;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function __construct()
    {
        // TODO 这里要先登录
//        $this->middleware('auth');
    }

    /**
     * Upload File
     * @param Request $request
     * @return array|string
     */
    public function postUpload(Request $request)
    {
        // check file
        $this->validate($request, [
            'file' => 'required|image'
        ]);
        $file = $request->file('file');

        if (!empty($file) && $file->isValid()) {
            // get file ext
            $ext = $file->getClientOriginalExtension() ?: $file->guessClientExtension();
            if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                return 'access denied';
            }

            // modify name(randomStr()-时间戳)
            $topath = strtolower(sprintf('%s%s/%s-%s.%s', gmdate('Y'), gmdate('m'), Str::quickRandom(), time(), $ext));
            // upload
            return UploadService::upload($topath, $file);
        }

        return 'error';
    }

    /**
     * Get Upload Progress
     * @param Request $request
     * @return mixed
     */
    public function getProgress(Request $request) {
        // TODO 获取上传进度, 此处的方法暂时还不能用


        $prefix = ini_get('session.upload_progress.prefix');
        $name = $request->get('name', '');
        return $_SESSION[$prefix.$name];
    }
}
