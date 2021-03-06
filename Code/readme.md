### 项目自定义文件夹说明
    1. Enums:
        枚举类文件夹
    2. Utils:
        1). 工具类文件夹
        2). Trait类文件夹
    3. Libraries:
        第三方工具包文件夹

### 项目命名说明
    Enum：
        方法: 以Enum后缀结尾
        例如: StatusCodeEnum
    Trait：
        方法: 以Trait后缀结尾
        例如: ReturnTrait       


### 项目说明
    1. Log模块
        封装:
            类：App\Utils\LogUtil
        使用:
            info:
                App\Utils\LogUtil::info($message, $params);
            warning:
                App\Utils\LogUtil::warning($message, $params);
            error:
                App\Utils\LogUtil::error($message, $params);
        BearyChat:
            通知配置：
                1). .env文件里配置BEARYCHAT_HOOK 和 BEARYCHAT_ERROR_HOOK，参考.env.example文件
                2). 在 bootstrap/app.php 文件里配置$app->configureMonologUsing(Closure $closure)。此处的目的是接管 monolog, 即配置文件(config/app.php)里的配置不再起作用
                3). 添加 BearyChatHandle 类，在 App\Services\BearyChat\BearyChatHandler 里
            使用：
                第1种: Exceptions/Handler.php 里
                第2种: App\Utils\LogUtil::error('error message');
            发送日志格式：
                Datetime - Log_Level - Hostname


    2. BearyChatRobot消息通知
        作用：
            通知消息到 BearyChat聊天组里
        配置：
            添加 BearyChatRobot 类，在 App\Services\BearyChat\BearyChatRobot 里
        使用例子：
            $notify_title   = '这是标题 - 周大哥';
            $notify_content = '这是内容 - 啊啊啊啊';
            App\Services\BearyChatRobot::notify($notify_title, $notify_content);

    3. JSON格式返回
        作用:
            返回格式统一
        作用域:
            Controller里
        配置:
            基础Controller里, use ReturnTrait;
        使用例子:
            正常情况:
                return $this->jsonReturn(
                    StatusCodeEnum::SUCCESS_CODE,       // status_code
                    '注册成功',                         // msg
                    compact('user1','user2')            // data
                );
            异常情况:
                $validator = $this->validator($request->all());
                // 验证失败
                if ($validator->fails()) {
                    return $this->jsonReturn(
                        StatusCodeEnum::ERROR_CODE,     // status_code
                        $this->formatErrors($validator) // msg
                    );
                }

    4. 短信发送模块
        作用:
            发送短信
        使用包:
            toplan/phpsms
        验证码模块:
            SMS Module:
                1. 短信发送的配置文件在config/laravel-sms中
                2. 控制器层：App\Http\Controllers\Utils\SmsController
                3. 发送的主要文件：App\Services\Sms\SmsManager.php
                4. 使用SmsManager门面，在App\Facades\SmsManager
                5. 扩张的验证写在：App\Services\Sms\Validations.php
                6. 验证的中文信息在：resources\lang\zh-Hans\validation
                7. 服务提供者在 App\Providers\中
                8. 短信的验证码是放在cache中的，接口：App\Contracts\Storage,实现的两个类在App\Services\Storage中
                9. 发送短信路由：sms/send-code
                10. 查看cache的信息   sms/info
        普通短信发送
            云片:
                // 接收人手机号
                $to = '1828****349';
                // 短信内容(内容须是云片提前审核过的模板)
                $content = '【签名】这是短信内容...';
                // 只希望使用内容方式放送,可以不设置模板id和模板data(如:云片、luosimao)
                PhpSms::make()->to($to)->content($content)->send();
            其他:
                看看phpsms是用模板，还是直接发送内容

    5. 队列:
        作用:
            处理耗时操作 / 延时操作
        驱动:
            服务器上: redis，暂时不研究 beanstalkd
            本地开发: sync模式
        教程:
            [Laravel 5.1版本--队列](http://laravel-china.org/docs/5.1/queues)

    6. Aliyun-Oss 存储:
        作用:
            存储文件到 阿里云oss
        配置:
            1). 安装orzcc/aliyun-oss包( composer require "orzcc/aliyun-oss:dev-master" ), git地址:https://github.com/orzcc/aliyun-oss
        使用:
            参考: http://laravel-china.org/docs/5.1/filesystem
            存储:
                // 上传文件到 oss
                $file = $request->file('file');
                $result = Storage::disk('oss')->put('1.jpg', file_get_contents($file));

    7. Api 接口使用说明
        配置:
            位置:
                1. clients 配置在 config/app.php的 clients节点数组
            说明:
                app_key: 客户端每次请求需要携带
                app_secret: 客户端对链接进行签名需要的密钥
                expired_time: 过期时间

        接口:
            接口位置:
                基础接口: App\Http\Api\V1\BaseApi
                V1版本: App\Http\Api\V1\...
            参数:
                _device: 设备类型(目前只有 ios)
                _t: 访问时间戳
                _appkey: 设备对应的app key
                _sign: 签名
                api: 需要调用的接口
                data: 具体的参数
            参数示例:
                {
                    "api": "auth.login",
                    "data": "{\"key\" : \"value\",\"ming\" : \"sss\"}",
                    "_appkey": "eN3AQjZp2O2TUSnyQpJ1G9Ckzo9SQcqx",
                    "_v": "1",
                    "_device": "ios",
                    "_t": "1466759459",
                    "_sign": "fe01bd4c3dda90ed757bcbac5f075b9ccbde4a44"
                }
        异常:
            枚举类:
                App\Enums\ApiExceptionEnum
            处理类:
                App\Exceptions\ApiHandler
            自定义异常类:
                App\Exceptions\SelfExceptions\...

    8. 阿里云图片处理服务
        模块:
            Facade / Contract / Service
        使用:
            $src = \ImageStrategy::process('http://hostname/*.jpg', 'avatar');
        配置详情:
            1. Constracts层(接口层):
                图片处理: 
                    abstract App\Contracts\Image\ImageBuilder
                图片策略: 
                    interface App\Contracts\Image\Strategy
            2. Service 层(实现层):
                图片处理:
                    App\Services\Image\AliyunOss\ImageBuilder extends App\Contracts\Image\ImageBuilder(继承于 Constracts层的抽象类: ImageBuilder)
                图片策略:
                    App\Services\Image\AliyunOss\Strategy 继承于上层的Strategy, 继而实现了上层实现的Contracts层的Strategy层接口
            3. 绑定:
                1). providers实现:
                    Provider类: App\Providers\ImageServiceProvider,其对StrategyContract 和 App\Services\Image\AliyunOss\Strategy绑定
                2). 配置provider
                    config/app.php 文件里providers数组里配置: App\Providers\ImageServiceProvider::class
            4. Facade层:
                1). Facade实现:
                    Facade类: App\Facades\ImageStrategy, 其对应的是Contract接口里的App\Contracts\Image\Strategy, 然后在 App 服务容器里寻找已注册的相应的实现类.(此处是在 App\Providers\ImageServiceProvider里绑定的)

    9. UploadService
        作用：
            1.上传: 
                上传按规则命名后的文件
            2.解析: 
                按规则解析生成可访问url
        位置:
            App\Services\UploadService
        使用:
            上传本地:
                UploadService::upload($topath, $file, 'local');
            上传oss:
                UploadService::upload($topath, $file);
            解析:
                $tt = UploadService::parse('oss:201511/0zv3vre6horj7lc9.jpg');

    10. Excel工具
        作用:
            Excel导入导出
        参考文档:
            官方:
                http://www.maatwebsite.nl/laravel-excel/docs
            github:
                https://github.com/Maatwebsite/Laravel-Excel
        使用:
            导入:
                // 1. 读取用户传入的文件(参数文件直接读取)
                $file = $request->file('excel');
                \Excel::load($file->getRealPath(), function($reader) {

                    // reader methods
                    dd($reader->get());
                });
            导出:
                // 1. 数组导出方式
                $data = array(
                    array('data1', 'data2'),
                    array('data3', 'data4')
                );

                \Excel::create('Filenamess', function($excel) use($data) {

                    $excel->sheet('Sheetname', function($sheet) use($data) {
                        $sheet->fromArray($data);
                    });
                })->export('xls');

    11. 权限管理
        扩展:
            zizaco/entrust:5.2.x-dev
        文档:
            https://github.com/Zizaco/entrust
        使用:
            参考:
                 FileController 的 postUpload()方法
            代码:
                // Check Permission
                if (!auth()->user()->can('file.upload')) {
                    return $this->jsonReturn(
                            StatusCodeEnum::NO_PERMISSION_CODE,
                            $this->sysMessage(StatusCodeEnum::NO_PERMISSION_CODE)
                    );
                }
        注意:
            1. 具体权限在数据库的permissions表里配置, 相关表也需配置
            2. 权限设置了缓存, 缓存时间为: config/cache.php -> 'ttl'配置项配置, 读取.env文件里的CACHE_TTL 时间, 默认最低缓存1分钟
            3. 如果手动在数据库里设置权限，需等缓存到期后方能看到权限改变.如需及时看到, 可以及时清除缓存. 或采用接口管理权限列表.

    12. 操作日志
        参考文档:
            http://laravel-china.org/docs/5.1/events
        表:
            operator_log
        实现方式:
            1. Event绑定「App\Listeners\OperateLogEventListener」
            2. Event里添加参数「operateLog」
                结构: 
                    参考:
                        「App\Events\LoginEvent」
                    形式:
                        // Operate Log Data
                        $this->operateLog['operator_id'] = $user['id'];
                        $this->operateLog['user_id'] = $user['id'];
                        $this->operateLog['type'] = OperateLogTypeEnum::LOGIN;
                        $this->operateLog['ip'] = $request->ip();
                        // $this->operateLog['extra'] = $request->all();     // 不要包含敏感的数据
        使用:
            「Controller」: \Event::fire(new LoginEvent(auth()->user()));

    13. 邮件
        作用:
            1. 找回密码(因为使用Send Cloud,故无需使用队列)
            2. 普通发邮件功能
        包:
            "naux/sendcloud": "^1.1"
        表:
            mt_password_resets
        实现方式:
            1. 配置.env 文件, Email 和 Send Cloud部分
            2. 路由:
                GET password/email                  // 通过邮箱找回密码页面
                POST password/email                 // 通过邮箱提交找回密码
                GET password/reset                  // 通过邮箱重置秘密页面
                POST password/reset/{token}         // 通过邮箱重置密码真实操作
            3. PasswordController里使用了 ResetsPasswords trait
        使用:
            普通邮件:
                \Mail::send('emails.password', [], function ($message) {
                    $message->subject('觅处｜Meet－True密码取回 ');
                    $message->to('2773630878@qq.com');
                });
        说明:
            1. .env文件里设置 MAIL_DRIVER, 不同模式值:
                dev: log
                    说明:
                        1. 此时邮件发送到日志里, 需要到日志里查看
                pre / prd: sendcloud










### 部署说明
    暂时还没有


### 相关技术
    1. BearyChat 通知：
        * [制作一个 BearyChat 的 Laravel 项目错误日志通知机器人](https://phphub.org/topics/2190)
        * [Laravel 项目集成 BearyChat](https://phphub.org/topics/2236)

### 相关文档：
    1. 修改主机hostname
        * [ECS Linux主机修改主机名](https://help.aliyun.com/knowledge_detail/5988691.html?pos=2)

### TODO
    1. 队列驱动:
        - Beanstalks