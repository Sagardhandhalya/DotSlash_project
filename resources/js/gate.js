export default class Gate {
    constructor(user) {
        this.user = user
    }

    isMaster() {
        return this.user.role === 'master';
    }

    isAdminOrTeacher() {
        return this.user.role === 'admin' || this.user.role === 'teacher';
    }

    isAdmin() {
        return this.user.role === 'admin';
    }

    isTeacher() {
        return this.user.role === 'teacher';
    }

    isStudent() {
        return this.user.role === 'student';
    }
}
