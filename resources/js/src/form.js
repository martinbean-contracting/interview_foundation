import ErrorBag from './error-bag';

export default class Form {
    constructor(data = {}) {
        this.busy = false;
        this.data = data;
        this.errors = new ErrorBag({});
        this.successful = false;
    }

    startProcessing() {
        this.busy = true;
        this.errors.forget();
        this.successful = false;
    }

    finishProcessing() {
        this.busy = false;
        this.errors.forget();
        this.successful = true;
    }

    setErrors(errors) {
        this.busy = false;
        this.errors.set(errors);
        this.successful = false;
    }
}
