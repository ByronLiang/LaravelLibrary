# 目录结构

- assets 静态资源
    - images 图片
    - scss 样式表
- components 组件，不包含其他组件，可根据组件类型建立文件夹
- config 全局配置
    - bootstrap.js 全局依赖配置
    - router.js 路由配置
    - parameter.js 全局参数配置，如男:m,女:f
- directives 指令
- modules 模块，多个组件组合体
- pages 路由展示的页面
    - index.vue 无样式路由入口
- store 全局状态控制(需要vuex)
- app.js 程序入口
- app.vue 路由入口


# 注意事项

- 为避免组件过于复杂，不方便后期维护，避免往组件传数组且在组件里循环
- 基于js语言特性，应避免过长的变量 如：bad => a.b.c