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

    // Récupérer le cookie CSRF avec les credentials
    const res = await Axios.get('/sanctum/csrf-cookie', {
        baseURL: 'http://localhost:8000',
        withCredentials: true,
    });

    // Mettre à jour le header CSRF avec le token extrait
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = parseCSRFToken(res.headers['set-cookie']);
    Axios.defaults.headers.common['Origin'] = 'http://localhost:8000';
    Axios.defaults.headers.common['Referer'] = 'http://localhost:8000';

    // Appeler /login avec l'option withCredentials
    const auth = await Axios.post('/login', credentials, {
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        baseURL: 'http://localhost:8000',
        withCredentials: true,
    });

    // Vous pouvez ensuite stocker les cookies de la réponse si nécessaire
    for (let key in auth.data.user) {
        user[key] = auth.data.user[key];
    }

};

function parseCSRFToken(cookies) {
    // Extrait la valeur entre "=" et ";" sans soustraction arbitraire
    const cookieValue = cookies[0].split(';')[0];
    return cookieValue.split('=')[1];
};