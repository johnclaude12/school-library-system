class Gate {
    constructor(useRole) {
        this.useRole = useRole;
    }

    isAdmin() {
        return this.useRole === 'admin';
    }

    isAdminLibr() {
        return this.useRole === 'libr' || this.useRole === 'admin';
    }
}

export default Gate;
