export default class Gate {
    constructor(user) {
        user = user;
    }

    isDev() {
        return user.type === 'dev';
    }
    isSupAdmin() {
        return user.type === 'supadmin';
    }
    isAdmin() {
        return user.type === 'admin';
    }
    isUser() {
        return user.type === 'user';
    }
    isDevOrAdmin() {
        if (user.type === 'supdev' || user.type === 'dev' || user.type === 'supadmin' || user.type === 'admin') {
            return true;
        }
    }
    isAuthorized() {
        if (user.type === 'supdev' || user.type === 'dev' || user.type === 'supadmin' || user.type === 'admin' || user.type === 'editor') {
            return true;
        }
    }

    isSupDevOrDev() {
        if (user.type === 'supdev' || user.type === 'dev') {
            return true;
        }

    }

}