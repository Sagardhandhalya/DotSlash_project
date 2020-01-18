export default class Gate {
    constructor(user) {
        this.user = user
    }

    isMaster() {
        return this.user.role === 'master';
    }

    isAdmin() {
        return this.user.role === 'admin';
    }
}
