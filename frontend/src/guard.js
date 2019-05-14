import store from "./store";

export const loggedGuard = (to, from, next) => {
    if(store.state.isLogged) {
        next();
    } else{
        next('/signin');
    }
}

export const NotLoggedGuard = (to, from, next) => {
    if(! store.state.isLogged) {
        next();
    } else{
        next('/shops');
    }
}