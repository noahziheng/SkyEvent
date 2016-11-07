## SkyEvent
![](http://7xksvs.com1.z0.glb.clouddn.com/images/skyevent2-preview.png)

> SkyEvent是VATPRC旗下的模拟飞行活动管理系统

**本项目已因实际需要废弃，主分支最后版本v1.1beta，开发分支最后版本v2.0 preview**

## 子系统构建方案

*  中心数据系统：开放API调用，子系统相互链接【Docker镜像PHP/Laravel项目，部署于镜像列表所列各数据站】
*  中心数据库：Docker Link到中心数据系统【Docker镜像MongoDb，部署于Vultr东京站】
*  访问前端子系统：提供前端访问，根据设备类型、网络环境选择数据系统源。【暂时部署在Coding Pages服务上，仅承担页面渲染，未来实现为Docker镜像Nodejs+Nginx项目承接前端访问与后端数据API】
*  用户验证子系统：与VATSIM SSO链接，中转用户数据【PHP项目，部属在LA的自有VPS上】
*  移动客户端:提供同网页版功能，SSO登陆后可扫码登陆网页端【同VATPRC其他开发者合作，计划尝试一简版WebApp作为补充】
 （待补充）

##镜像列表（16.6）
###前端
  - Coding Pages

###后端
  - 测试节点【天津，个人主机】
  - 核心节点【日本东京，Vultr VPS】
  - 中国大陆分流节点【中国北京，阿里云，单IP访问】
  - 美国分流节点【美国洛杉矶，AcrosVM VPS，即将到期】
