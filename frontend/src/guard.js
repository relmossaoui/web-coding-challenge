import store from "./store";

export default (to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (! store.state.isLogged) {
            next('/signin')
        } else {
            next()
        }
    } else {
        next()
    }

    if (to.matched.some(record => record.meta.notRequiresAuth)) {
        if (store.state.isLogged) {
            next('/shops')
        } else {
            next()
        }
    } else {
        next()
    }
}