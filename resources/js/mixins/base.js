import axios from 'axios';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
export default {
    methods: {
        toast (message, type)
        {
            const $toast = useToast();
            switch (type) {
                case 'error':
                    $toast.error(message)
                    break;
            
                default:
                    $toast.success(message)
                    break;
            }
        },
        http () {
            let instance = axios.create({
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-QUEEN-TECH-AUTHORIZATION': window.apiKey,
                },
            });

            instance.interceptors.response.use(
                (response) => {
                    return response;
                },
                (error) => {
                    return Promise.reject(error);
                }
            );

            return instance;
        },
    },
};