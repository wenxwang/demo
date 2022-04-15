### 简介

简易mvc框架

### 目录结构

```
mvc
├─ README.md
├─ app
│  ├─ controllers
│  ├─ models
│  └─ views
├─ config
├─ data
├─ index.php
├─ static
└─ vendor
   └─ mvc

```

### 环境配置

- nginx

  ```nginx
  # server 80端口添加如下配置
  location / {
              try_files $uri $uri/ /index.php?$query_string;
  		}
  ```

- mysql

  1. 配置文件：config/config.php

### 测试

测试数据：data/test.sql

测试链接：localhost

### 参考

https://github.com/yeszao/fastphp