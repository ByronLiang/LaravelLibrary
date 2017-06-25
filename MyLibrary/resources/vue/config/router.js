const lazyLoading = (name, index = false) => () => System.import(`../pages/${name}${index ? (name?'/':'')+'index' : ''}.vue`);
// const Loading = (name, index = false) => require(`../pages/${name}${index ? '/index' : ''}.vue`);

module.exports = {
    base: '/',
    mode: 'hash', //history
    routes: [
        {
            path: '/',
            component: lazyLoading('', true),
            redirect: {
              name: 'Default'
            },
            children: [
                {
                    name: 'Default',
                    path: '/',
                    component: lazyLoading('Home/Default'),
                },
                {
                    name: 'Demo',
                    path: 'demo',
                    component: lazyLoading('Home/Demo'),
                },
            ]
        },

        {
            path: '*',
            redirect: '/'
        }
    ]
};
