export default class Gate {
    constructor(user) {
        user = user;
    }

    isDev() {
        return window.user.type === 'dev';
    }
    isSupAdmin() {
        return window.user.type === 'supadmin';
    }
    isAdmin() {
        return window.user.type === 'admin';
    }
    isUser() {
        return window.user.type === 'user';
    }
    isDevOrAdmin() {
        if (window.user.type === 'supdev' || window.user.type === 'dev' || window.user.type === 'supadmin' || window.user.type === 'admin') {
            return true;
        }
    }
    isAuthorized() {
        if (window.user.type === 'supdev' || window.user.type === 'dev' || window.user.type === 'supadmin' || window.user.type === 'admin' || window.user.type === 'editor') {
            return true;
        }
    }

    isSupDevOrDev() {
        if (window.user.type === 'supdev' || window.user.type === 'dev') {
            return true;
        }

    }

}