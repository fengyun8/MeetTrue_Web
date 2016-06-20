### 项目说明
    1. Log模块
        配置：
            - .env文件里配置BEARYCHAT_HOOK 和 BEARYCHAT_ERROR_HOOK，参考.env.example文件
            - 在 bootstrap/app.php 文件里配置$app->configureMonologUsing(Closure $closure)。此处的目的是接管 monolog, 即配置文件(config/app.php)里的配置不再起作用
            - 添加 BearyChatHandle 类，在 App\Libraries\BearyChat\BearyChatHandler 里
        使用：
            * Exceptions/Handler.php 里
            * Log::error('error message');


    2. BearyChatRobot消息通知
        作用：
            通知消息到 BearyChat聊天组里
        配置：
            添加 BearyChatRobot 类，在 App\Libraries\BearyChat\BearyChatRobot 里
        使用例子：
            $notify_title   = '这是标题 - 周大哥';
            $notify_content = '这是内容 - 啊啊啊啊';
            App\Libraries\BearyChatRobot::notify($notify_title, $notify_content);


### 相关技术
    1. BearyChat 通知：
        * [制作一个 BearyChat 的 Laravel 项目错误日志通知机器人](https://phphub.org/topics/2190)
        * [Laravel 项目集成 BearyChat](https://phphub.org/topics/2236)

### 相关文档：
    1. 修改主机hostname
        * [ECS Linux主机修改主机名](https://help.aliyun.com/knowledge_detail/5988691.html?pos=2)