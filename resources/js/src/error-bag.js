import _ from 'lodash';

export default class ErrorBag {
    constructor(errors = {}) {
        this.errors = errors;
    }

    has(field) {
        return _.has(this.errors, field);
    }

    get(field) {
        if (this.has(field)) {
            return this.errors[field];
        } else {
            return [];
        }
    }

    set(errors = {}) {
        this.errors = errors;
    }

    forget() {
        this.errors = {};
    }
}
