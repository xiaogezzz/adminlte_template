#### 开箱步骤
下载压缩包并解压到工作区
```shell script
# 安装依赖文件
composer install

# 修改配置文件，并新建数据库
cp .env.example .env

# 安装静态资源文件
php artisan adminlte:update
php artisan adminlte:plugins install

# 执行数据库迁移和初始化数据填充
php artisan migrate --seed
```

现在可以修改 `config/adminlte.php` 进行一些基本的配置，详见[英文文档](https://github.com/jeroennoten/Laravel-AdminLTE/blob/master/README.md)

最后初始化仓库
```shell script
git init
```
