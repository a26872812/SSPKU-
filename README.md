# SSPKU-互联网软件开发技术与实践课程期末大作业
# 商城订单系统

## 环境

* php5.6 + phpredis扩展
* redis服务
* apache2
* mysql：table 商品表（goods）+ 订单表（order）+ 用户登录管理表（crm_user） + 用户信息表（user）
* RabbitMQ（待完善）

## 包含模块

* 用户登录
  * 基于Session+Cookie实现的七天免登录
  * 基于token机制的用户访问
  * 使用了RBAC
* 超级用户模块（后台管理）
  * 修改库存
  * 查看订单
* 普通用户模块（待拓展）

## 安全性

- 密码输入框密文保护
- 前端输入合法性校验
- redis记录输错登录信息次数，超过5次暂停服务5分钟
- token机制验证后才能进行功能页面的跳转访问
  - 登录成功设置新token值，和username一起MD5加密后存入数据库，并返回给客户端用户，客户端将其存入localStorage
  - 在各个页面跳转到总入口时，使用localStorage获取token值，模拟表单提交发送POST请求给总入口，验证token值，如果是不存在的token值，直接跳转到首页。如果是存在的token值，解析出用户名，并以此标识用户

## 性能

- 读取商品信息时先从redis读，提升性能；写入修改信息时再更新redis


