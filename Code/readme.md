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



### 部署说明
    暂时还没有


### 相关技术
    1. BearyChat 通知：
        * [制作一个 BearyChat 的 Laravel 项目错误日志通知机器人](https://phphub.org/topics/2190)
        * [Laravel 项目集成 BearyChat](https://phphub.org/topics/2236)

### 相关文档：
    1. 修改主机hostname
        * [ECS Linux主机修改主机名](https://help.aliyun.com/knowledge_detail/5988691.html?pos=2)