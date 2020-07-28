# TP-admin

Y-admin后台权限管理系统

## 项目介绍
Yuan-Admin是基于ThinkPHP5开发的后台框架，目前完成了用户管理、权限管理功能，权限管理功能使用ThinkPHP5的Auth验证方式，有很高的扩展性

##安装步骤
1. 执行项目`sql`目录下的两个脚本文件,将数据库结构及初始数据恢复的你的数据库中，`tp_admin.sql`文件为数据库结构脚本
2. 修改`config/database.php`中的数据库连接信息
3. 建立站点，将站点的根目录指向`public`目录
4. 访问网站，初始的帐号密码均为`yuanbe`


## 更新日志
### 2019-12-20
- 精简基类BaseController代码
- 更改视图文件夹及文件名为全小写
- 添加Crypt加密类库及RSS类库
