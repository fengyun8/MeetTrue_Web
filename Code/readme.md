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
        配置：
            1). .env文件里配置BEARYCHAT_HOOK 和 BEARYCHAT_ERROR_HOOK，参考.env.example文件
            2). 在 bootstrap/app.php 文件里配置$app->configureMonologUsing(Closure $closure)。此处的目的是接管 monolog, 即配置文件(config/app.php)里的配置不再起作用
            3). 添加 BearyChatHandle 类，在 App\Libraries\BearyChat\BearyChatHandler 里
        使用：
            第1种: Exceptions/Handler.php 里
            第2种: Log::error('error message');
        发送日志格式：
            Datetime - Log_Level - Hostname


    2. BearyChatRobot消息通知
        作用：
            通知消息到 BearyChat聊天组里
        配置：
            添加 BearyChatRobot 类，在 App\Libraries\BearyChat\BearyChatRobot 里
        使用例子：
            $notify_title   = '这是标题 - 周大哥';
            $notify_content = '这是内容 - 啊啊啊啊';
            App\Libraries\BearyChatRobot::notify($notify_title, $notify_content);

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
            toplan/laravel-sms
            toplan/phpsms
        验证码模块:
            /**
             * 验证码发送
             * 参考:Toplan\Sms\SmsController  =>  postSendCode()
             */
            $to = '15088692749';
            $result = SmsManager::requestVerifySms($to, 60);



            /**
             * 验证验证码
             */
            use SmsManager;
            ...

            //验证数据
            $validator = Validator::make($request->all(), [
                'mobile'     => 'required|confirm_mobile_not_change',
                'verifyCode' => 'required|verify_code|confirm_rule:mobile,mobile_required',
                //more...
            ]);
            if ($validator->fails()) {
               //验证失败后建议清空存储的发送状态，防止用户重复试错
               SmsManager::forgetState();
               return redirect()->back()->withErrors($validator);
            }

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