<?php

namespace app\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Services\UploadService;
use App\Utils\ValidateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Enums\StatusCodeEnum;

class FileController extends Controller
{
    use ValidateTrait;

    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Upload Picture
     * @param Request $request
     * @return array|string
     */
    public function uploadPicture(Request $request)
    {
        $toPath = strtolower(sprintf('%s%s', gmdate('Y'), gmdate('m')));
        return $this->uploadFile($request, $toPath);
    }

    /**
     * Upload Avatar
     * @param Request $request
     * @return array|string
     */
    public function uploadAvatar(Request $request)
    {
        $toPath = 'avatars';
        return $this->uploadFile($request, $toPath);
    }

    /**
     * Upload user-banner
     * @param Request $request
     * @return array|string
     */
    public function uploadUserBanner(Request $request)
    {
        $toPath = 'user_banners';
        return $this->uploadFile($request, $toPath);
    }

    /**
     * 上传 处理类
     * 说明:
     *      文件名为 sha1_file($file), 可以防止重复图片
     */
    private function uploadFile($request, $toPath)
    {
        if (empty($request) || empty($toPath)) {
            return null;
        }

        // Check File
        $this->validateForApi($request, [
            'file' => 'required|image'
        ]);
        $file = $request->file('file');

        // Upload File
        if (!empty($file) && $file->isValid()) {
            // Get File Ext
            $ext = $file->getClientOriginalExtension() ?: $file->guessClientExtension();

            // File not allowed
            if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['file' => '文件格式不合法']);
            }

            // Get Path
            $toPath = strtolower(sprintf('%s/%s.%s', $toPath, sha1_file($file), $ext));
            return UploadService::upload($toPath, $file);
        }

        // File is invalid
        return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['file' => '文件不能为空']);
    }
}
