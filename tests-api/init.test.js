// Import axios
const axios = require('axios'); 





const Axios = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        Accept: 'application/json',
    },
});

const user = {};

describe("User Login", () => {
    test("Vérification de l'authentification", async () => {
            await login(user, {
                    email: 'user@user.fr',
                    password: 'User2025!'
            });
    });
});





async function login(user, credentials) {

    // On s'assure d'abord que l'utilisateur est déconnecté
    await Axios.post('/logout', {
        baseURL: 'http://localhost:8000'
    });

    // On récupère le token CSRF
    const res = await Axios.get('/sanctum/csrf-cookie', {
        baseURL: 'http://localhost:8000'
    });

    Axios.defaults.headers.cookie = res.headers['set-cookie'];
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = parseCSRFToken(res.headers['set-cookie']);
    Axios.defaults.headers.common['Origin'] = 'http://localhost:8000';
    Axios.defaults.headers.common['Referer'] = 'http://localhost:8000';

    const auth = await Axios.post('/login', credentials, {
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        baseURL: 'http://localhost:8000',
    });

    Axios.defaults.headers.common = auth.headers['set-cookie'];
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = parseCSRFToken(auth.headers['set-cookie']);

    for (let key in auth.data.user) {
        user[key] = auth.data.user[key];
    };

};

function parseCSRFToken(cookies) {
    const startAt = cookies[0].indexOf('=');
    const endAt = cookies[0].indexOf(';');
    const csrf = cookies[0].substring(startAt + 1, endAt -3);
    return csrf;
};