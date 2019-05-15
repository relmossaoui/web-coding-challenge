import axios from 'axios'

export const API_ENDPOINT_BASE = "http://dev.remote-backend.com/api/"

export const http = (method, path, data = {}) => {

    return axios[method](`${API_ENDPOINT_BASE}${path}`, data, {
        headers : {
            'Content-type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
}
