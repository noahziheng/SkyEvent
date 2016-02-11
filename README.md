## SkyEvent
![](http://7xksvs.com1.z0.glb.clouddn.com/images/skyevent2-preview.png)

> SkyEvent是VATPRC旗下的模拟飞行活动管理系统

## 子系统构建方案

* 中心数据系统：开放API调用，子系统相互链接【Docker镜像MEAN项目，部署在新浪EC2/DaoCloud】
*  访问前端子系统：提供前端访问，根据设备类型、网络环境选择数据系统源。【暂时部署在数据系统同镜像中，未来根据访问量分发到更多服务器做镜像】
*  用户验证子系统：与VATSIM SSO链接，中转用户数据【Python项目，部属在LA的自有VPS上】
*  移动客户端:提供同网页版功能，SSO登陆后可扫码登陆网页端【同VATPRC其他开发者合作，计划尝试一简版WebApp作为补充】
 （待补充）
