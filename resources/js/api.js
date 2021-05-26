import { HttpRequest } from './http'

let product = {
    inventoryPost(data) {
        return HttpRequest.getRequest({
            method: 'POST',
            url: 'inventoryPost',
            data: data
        });
    },
};

export { product }
