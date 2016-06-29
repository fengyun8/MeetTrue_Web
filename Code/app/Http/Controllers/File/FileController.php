<?php

namespace app\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Enums\StatusCodeEnum;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Upload File
     * @param Request $request
     * @return array|string
     */
    public function postUpload(Request $request)
    {
        // Check Permission
        if (!auth()->user()->can('file.upload')) {
            return $this->jsonReturn(
                    StatusCodeEnum::NO_PERMISSION_CODE,
                    $this->sysMessage(StatusCodeEnum::NO_PERMISSION_CODE)
            );
        }


        // Check File
        $this->validate($request, [
            'file' => 'required|image'
        ]);
        $file = $request->file('file');


        // Upload File
        if (!empty($file) && $file->isValid()) {
            // Get File Ext
            $ext = $file->getClientOriginalExtension() ?: $file->guessClientExtension();

            // File not allowed
            if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, '文件格式不合法');
            }

            // Modify name(randomStr()-时间戳) and Upload
            $toPath = strtolower(sprintf('%s%s/%s-%s.%s', gmdate('Y'), gmdate('m'), Str::quickRandom(), time(), $ext));
            return UploadService::upload($toPath, $file);
        }


        // File is invalid
        return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, '文件不能为空');
    }
}
